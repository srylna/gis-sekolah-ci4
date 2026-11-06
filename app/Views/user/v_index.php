<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data User</h3>
            <div class="card-tools">
                <a href="<?= base_url('User/Input') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check me-2"></i> <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="30px">No</th>
                        <th width="150px">Nama User</th>
                        <th width="170px">E-mail</th>
                        <th width="170px">Password</th>
                        <th width="80px">Foto</th>
                        <th width="80px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($user as $u) : ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $u['nama_user'] ?></td>
                            <td><?= $u['email'] ?></td>
                            <td><?= $u['password'] ?></td>
                            <td class="text-center">
                                <?php if (!empty($u['foto'])) : ?>
                                    <img src="<?= base_url('foto_user/' . $u['foto']) ?>" width="60px" height="60px" style="object-fit:cover; border-radius:50%;">
                                <?php else : ?>
                                    <span class="badge bg-secondary">No Photo</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('User/Edit/' . $u['id_user']) ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="<?= base_url('User/deleteData/' . $u['id_user']) ?>" onclick="return confirm('Apakah Yakin Ingin Menghapus Data Ini?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>