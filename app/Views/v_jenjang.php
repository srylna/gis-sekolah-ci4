    <div class="col-md-12">
        <div class="card card-outline card-success mb-4">
         <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?></h3>
           

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
             if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-primary alert-dismissible fade show d-flex align-items-center" role="alert" style="background-color: #28a745; color: #fff; border: none; padding: 12px 20px;">
        <h5 class="m-0 d-flex align-items-center" style="color: #fff; font-size: 1rem; font-weight: 500;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" viewBox="0 0 16 16" style="margin-right: 10px;">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
            </svg>
            <?= session()->getFlashdata('pesan') ?>
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

        <table id="example1" class="table table-bordered table-striped align-middle">
            <thead>
                <tr class="text-center">
                    <th width="50px">No</th>
                    <th>Jenjang</th>
                    <th>Marker</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                
      <?php $no = 1; 
      foreach ($jenjang as $key => $value) { ?>
      <tr class="text-center">
          <td><?= $no++; ?></td>
          <td><?= $value['jenjang'] ?></td>
          <td><img src="<?= base_url('marker/' . $value['marker']) ?>" alt="Marker" width="70"></td>
          <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_jenjang'] ?>">
        <i class="bi bi-geo-alt-fill"></i> Ganti Marker
      </button>
                    </td>
                </tr>
                

      <!-- /.card-body -->
         </div>
       <!-- /.card -->
          </div>

    <!-- POP-UP CENTERED MODAL BOOTSTRAP 5 -->
            <div class="modal fade" id="edit<?= $value['id_jenjang'] ?>" tabindex="-1" aria-labelledby="labelModal<?= $value['id_jenjang'] ?>" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  
                  <!-- Header Modal -->
                  <div class="modal-header">
                    <h5 class="modal-title fs-5" id="labelModal<?= $value['id_jenjang'] ?>">Ganti Marker - <?= $value['jenjang'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <!-- Form Update Data (Marker) -->
                  <form action="<?= base_url('Jenjang/UpdateData/' . $value['id_jenjang']) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body text-center">
                      <div class="mb-3">
                        <label class="form-label d-block fw-bold">Marker Saat Ini</label>
                        <img src="<?= base_url('marker/' . $value['marker']) ?>" width="50px" class="mb-2">
                      </div>

                      <div class="mb-3 text-start">
                        <label class="form-label fw-bold">Pilih Marker Baru (.png)</label>
                        <input type="file" name="marker" class="form-control" accept="image/png" required>
                      </div>
                    </div>

                    <!-- Footer / Tombol Aksi -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary"> Simpan </button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
         <?php } ?>
      </tbody>
       </table>
        <!-- END MODAL -->