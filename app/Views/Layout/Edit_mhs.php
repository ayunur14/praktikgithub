<?= $this->extend('Layout/Template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <form action="<?php echo site_url('dash/update_data/' . $tbl_mahasiswa['id_mhs']); ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?= set_value('nim', $tbl_mahasiswa['nim']); ?>" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama', $tbl_mahasiswa['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required><?= set_value('alamat', $tbl_mahasiswa['alamat']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir', $tbl_mahasiswa['tgl_lahir']); ?>" required>
        </div>
        <div class="form-group">
            <label for="jk">Jenis Kelamin</label>
            <select class="form-control" id="jk" name="jk" required>
                <option value="Laki-laki" <?= ($tbl_mahasiswa['jk'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?= ($tbl_mahasiswa['jk'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email', $tbl_mahasiswa['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control-file" id="foto" name="foto">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>
