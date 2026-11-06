<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah User</h3>
        </div>
        <form action="<?= base_url('User/insertData') ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="fw-bold">Nama User</label>
                    <input type="text" name="nama_user" class="form-control" placeholder="Nama User" required>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-bold">E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-bold">Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-bold">Foto User</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('User') ?>" class="btn btn-success">Kembali</a>
            </div>
        </form>
    </div>
</div>