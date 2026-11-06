<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <form action="<?= base_url('User/updateData/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="foto_lama" value="<?= $user['foto'] ?>">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="fw-bold">Nama User</label>
                    <input type="text" name="nama_user" value="<?= $user['nama_user'] ?>" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-bold">E-mail</label>
                    <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-bold">Password</label>
                    <input type="text" name="password" value="<?= $user['password'] ?>" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label class="fw-bold">Ganti Foto</label>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php if (!empty($user['foto'])) : ?>
                                <img src="<?= base_url('foto_user/' . $user['foto']) ?>" width="100px" height="100px" style="object-fit:cover; border-radius:8px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-9">
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('User') ?>" class="btn btn-success">Kembali</a>
            </div>
        </form>
    </div>
</div>