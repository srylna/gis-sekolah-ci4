 <div class="col-md-12">
        <div class="card card-outline card-success mb-4">
         <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?></h3>
           
            <div class="card-tools">
        <a href="<?= base_url('Sekolah/Input') ?>" class="btn btn-primary btn-sm">
          <i class="bi bi-plus-lg"></i> Tambah Data
        </a>
      </div>

    <!-- /.card-tools -->
      </div>
     <!-- /.card-header -->
        <div class="card-body">
            <?php
            // notif insert data
             if (session()->getFlashdata('insert')) : ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert" style="background-color: #28a745; color: #fff; border: none; padding: 12px 20px;">
        <h5 class="m-0 d-flex align-items-center" style="color: #fff; font-size: 1rem; font-weight: 500;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" viewBox="0 0 16 16" style="margin-right: 10px;">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
            </svg>
            <?= session()->getFlashdata('insert') ?>
        </h5>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="position: static; padding: 0; color: #fff; opacity: 0.8; background: none; border: none; font-size: 20px; line-height: 1; cursor: pointer;">&times;</button>
    </div>
<?php endif; ?>

             <?php
             // notif update data 
             if (session()->getFlashdata('update')) : ?>
    <div class="alert alert-primary alert-dismissible fade show d-flex align-items-center" role="alert" style="background-color: #28a745; color: #fff; border: none; padding: 12px 20px;">
        <h5 class="m-0 d-flex align-items-center" style="color: #fff; font-size: 1rem; font-weight: 500;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" viewBox="0 0 16 16" style="margin-right: 10px;">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
            </svg>
            <?= session()->getFlashdata('update') ?>
        </h5>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="position: static; padding: 0; color: #fff; opacity: 0.8; background: none; border: none; font-size: 20px; line-height: 1; cursor: pointer;">&times;</button>
    </div>
<?php endif; ?>

              <?php
            // notif delete data
             if (session()->getFlashdata('delete')) : ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" style="background-color: #dc3545; color: #fff; border: none; padding: 12px 20px;">
        <h5 class="m-0 d-flex align-items-center" style="color: #fff; font-size: 1rem; font-weight: 500;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" viewBox="0 0 16 16" style="margin-right: 10px;">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
            </svg>
            <?= session()->getFlashdata('delete') ?>
        </h5>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="position: static; padding: 0; color: #fff; opacity: 0.8; background: none; border: none; font-size: 20px; line-height: 1; cursor: pointer;">&times;</button>
    </div>
<?php endif; ?>

        <table id="example1" class="table table-sm table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th width="50px">No</th>
                    <th class="text-center">Nama Sekolah</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Akreditasi</th>
                    <th class="text-center">Jenjang</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center" width="135px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; 
                foreach ($sekolah as $key => $value) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $value['nama_sekolah'] ?></td>
                    <td class="text-center"><?= $value['status'] ?></td>
                    <td class="text-center"><?= $value['akreditasi'] ?></td>
                    <td class="text-center"><?= $value['jenjang'] ?></td>
                    <td><?= $value['alamat'] ?></td>
                    <td class="text-center"><img src="<?= base_url('foto/' . $value['foto']) ?>" width="150px height=150px"></td>
                    <td class="text-center">
                        <a href="<?= base_url('Sekolah/Detail/' . $value['id_sekolah']) ?>" class="btn btn-success btn-sm p-0 px-1"><i class="bi bi-eye"></i></a>
                        <a href="<?= base_url('Sekolah/Edit/' . $value['id_sekolah']) ?>" class="btn btn-warning btn-sm p-0 px-1"><i class="bi bi-pencil-square"></i></a>
                        <a href="<?= base_url('Sekolah/Delete/' . $value['id_sekolah']) ?>" class="btn btn-danger btn-sm p-0 px-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            </table>

      <!-- /.card-body -->
         </div>
       <!-- /.card -->
          </div>

<script>
      $(document).ready(function() {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true
        });
      });
  </script>