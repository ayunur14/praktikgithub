<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Table Mahasiswa</h1>
  <p class="mb-4">Pada tabel ini di tampilkan data mahasiswa yang aktif menjalani perkuliahan</p>

  <!-- DataTables -->
  <div class="card mb-3">
    <div class="card-header">
      <a href="<?php echo site_url('dash/form_mhs') ?>"><i class="fas fa-plus"></i> Tambah</a>
      <a href="/mahasiswa/export" style="margin-bottom: 10px; display: inline-block;">Export ke Excel</a>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 1;
              foreach ($tbl_mahasiswa as $key) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td>
                  <img style="width:40px; height:40px; border-radius:100%;" src="<?php echo base_url($key['foto']); ?>" />
                  </td>
                  <td><?php echo $key['nim']; ?></td>
                  <td><?php echo $key['nama']; ?></td>
                  <td><?php echo $key['email']; ?></td>

                  <td>
                    <a href="<?php echo site_url('dash/edit_data/' . $key['id_mhs']); ?>" class="btn btn-warning btn-circle btn-sm">
                      <i class="fas fa-exclamation-triangle"></i>
                    </a>
                    <a href="<?php echo site_url('dash/delete/' . $key['id_mhs']); ?>" class="btn btn-danger btn-circle btn-sm" onclick="myFunction();">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<script>
  function myFunction() {
    if (!confirm('Are you sure to delete this item! ?')) {
      event.preventDefault();
      return;
    }
    return true;
  }
</script>


<?= $this->endSection() ?>