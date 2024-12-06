<?php

namespace App\Controllers;

use App\Models\MMahasiswa;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;


class Dash extends Controller
{
    public function __construct()
{
    helper('form');
}
    public function index()
    {
        $model = new MMahasiswa();
        $data['tbl_mahasiswa'] = $model->findAll();

        // var_dump($data['tbl_mahasiswa']);

        return view('layout/crudview', $data); // Ganti dengan nama file view Anda
    }

    public function form_mhs()
    {
        return view('layout/form_mhs'); // Halaman form untuk tambah data mahasiswa
    }

    public function add_data()
{
    $model = new MMahasiswa();

    // Validasi data input
    $validation = \Config\Services::validation();
    if (!$this->validate([
        'nim' => 'required',
        'nama' => 'required',
        'alamat' => 'required',
        'tgl_lahir' => 'required',
        'jk' => 'required',
        'email' => 'required|valid_email',
        'foto' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
    ])) {
        // Jika validasi gagal, kembalikan ke form dengan error
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Ambil data dari form
    $data = [
        'nim' => $this->request->getPost('nim'),
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'tgl_lahir' => $this->request->getPost('tgl_lahir'),
        'jk' => $this->request->getPost('jk'),
        'email' => $this->request->getPost('email'),
        'foto' => $this->upload_foto(), // Upload foto
        'create_date' => date('Y-m-d H:i:s') // Menyimpan waktu pembuatan
    ];

    // Simpan data mahasiswa ke database
    $model->insert($data);

    // Redirect ke halaman daftar mahasiswa setelah berhasil disimpan
    return redirect()->to('dashboardcrud');
}


    public function edit_data($id)
    {
        $model = new MMahasiswa();
        $data['tbl_mahasiswa'] = $model->find($id);
        return view('layout/edit_mhs', $data); // Halaman untuk edit data mahasiswa
    }

    public function update_data($id)
    {
        $model = new MMahasiswa();
    
        // Validasi data input
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nim' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'email' => 'required|valid_email',
            'foto' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ])) {
            // Jika validasi gagal, kembalikan ke form dengan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        // Ambil data dari form
        $data = [
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'jk' => $this->request->getPost('jk'),
            'email' => $this->request->getPost('email'),
            'foto' => $this->upload_foto(),
        ];
    
        // Update data mahasiswa ke database berdasarkan ID
        $model->update($id, $data);
        return redirect()->to('dashboardcrud');
    }
    

    public function delete($id)
    {
        $model = new MMahasiswa();
        $model->delete($id);
        return redirect()->to('dashboardcrud');
    }

    private function upload_foto()
    {
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/foto', $fileName);
            return 'uploads/foto/' . $fileName;
        }
        return null; // Jika tidak ada foto yang diupload
    }
    public function exportExcel()
    {
        $model = new MMahasiswa();  // Correct model instantiation
    
        $mahasiswa = $model->findAll();  // Fetch data from the database
    
        // Load library PhpSpreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Foto');
    
        // Data
        $row = 2; // Start row for data
        foreach ($mahasiswa as $mhs) {
            $sheet->setCellValue('A' . $row, $mhs['id_mhs']);
            $sheet->setCellValue('B' . $row, $mhs['nama']);
            $sheet->setCellValue('C' . $row, $mhs['email']);
            $sheet->setCellValue('D' . $row, base_url('uploads/' . $mhs['foto']));
            $row++;
        }
    
        // Write to Excel file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    
        // Output file
        $fileName = 'Data_Mahasiswa.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
        exit;
    }
    public function exportPDF()
    {
        // Instantiate the mahasiswa model
        $model = new MMahasiswa();  // Make sure you are using the correct model
        $mahasiswa = $model->findAll();  // Fetch all mahasiswa data

        // Load library Dompdf
        $dompdf = new Dompdf();

        // Buat konten HTML untuk PDF
        $html = '
        <h1>Data Mahasiswa</h1>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($mahasiswa as $mhs) {
            // Ensure to escape any potential HTML
            $html .= '<tr>
                <td>' . esc($mhs['id_mhs']) . '</td>
                <td>' . esc($mhs['nama']) . '</td>
                <td>' . esc($mhs['email']) . '</td>
                <td><img src="' . base_url('uploads/' . $mhs['foto']) . '" width="50" /></td>
            </tr>';
        }

        $html .= '
            </tbody>
        </table>';

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF (this can take time if the document is large)
        $dompdf->render();

        // Output the generated PDF to browser
        $dompdf->stream('Data_Mahasiswa.pdf', ['Attachment' => true]);

        // Ensure no further code is executed after PDF output
        exit;
    }

    

}
