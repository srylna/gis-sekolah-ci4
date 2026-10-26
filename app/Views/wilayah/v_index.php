    <div class="col-md-12">
        <div class="card card-outline card-success mb-4">
         <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?></h3>
           
            <div class="card-tools">
        <a href="<?= base_url('Wilayah/Input') ?>" class="btn btn-primary btn-sm">
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

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="50px">No</th>
                    <th>Nama Wilayah</th>
                    <th>Warna</th>
                    <th width="100px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; 
                foreach ($wilayah as $key => $value) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $value['nama_wilayah'] ?></td>
                    <td style="background-color: <?= $value['warna'] ?> ;"></td>
                    <td>
                        <a href="<?= base_url('Wilayah/Edit/' . $value['id_wilayah']) ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="<?= base_url('Wilayah/Delete/' . $value['id_wilayah']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            </table>

      <!-- /.card-body -->
         </div>
       <!-- /.card -->
          </div>

    <div class="col-md-12">
      <div id="map" style="width: 100%; height: 500px;" ></div>
          </div>

 <script>
    document.addEventListener("DOMContentLoaded", function() {

    const myToken = 'pk.eyJ1Ijoic2FmYWVzaSIsImEiOiJjbXZiYzN6ZTYwZWhhMnlvbzd5em4zNGN3In0.7m7TNYJRhvyVnCqrcSe6MQ';

    peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + myToken, {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
        id: 'mapbox/streets-v11'
    });

    var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + myToken, {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
        id: 'mapbox/satellite-v9'
    });

    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=' + myToken, {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
        id: 'mapbox/dark-v10'
	});

  //  const map = L.map('map').setView([-7.294856121608108, 109.04345927849569], 12);

  //	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  //	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  //	}).addTo(map);

   const map = L.map('map', {
    center: [<?= $web['coordinat_wilayah'] ?>],
    zoom: <?= $web['zoom_view'] ?>,
    layers: [peta2]
   });

    const baseMaps = {
    	'OpenStreetMap': peta1,
    	'satellite': peta2,
        'Streets': peta3,
        'Night': peta4,
   };

    L.control.layers(baseMaps).addTo(map);
    
    <?php foreach ($wilayah as $key => $value) { ?>
      L.geoJSON(<?= $value['geojson'] ?>, {
        fillColor: "<?= $value['warna'] ?>",
        fillOpacity: 0.5,
      })
      .bindPopup("<b><?= $value['nama_wilayah'] ?></b>")
      .addTo(map);
    <?php } ?>
    
    setTimeout(function() {
            map.invalidateSize();
    }, 200);
  });
  </script>

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