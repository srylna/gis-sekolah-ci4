       <div class="col-md-12">
        <div class="card card-success">
         <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
            <div class="card-tools">
               <button
                    type="button"
                    class="btn btn-tool"
                    data-lte-toggle="card-collapse"
                    aria-label="Collapse card"
                  >
           <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
        </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body">

      <?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert" style="background-color: #28a745; color: #fff; border: none; padding: 12px 20px;">
        <h5 class="m-0 d-flex align-items-center" style="color: #fff; font-size: 1rem; font-weight: 500;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" viewBox="0 0 16 16" style="margin-right: 10px;">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
            </svg>
            <?= session()->getFlashdata('pesan') ?>
        </h5>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="position: static; padding: 0; color: #fff; opacity: 0.8; background: none; border: none; font-size: 20px; line-height: 1; cursor: pointer;">&times;</button>
    </div>
<?php endif; ?>

          <?php echo form_open('Admin/UpdateSetting') ?>
          
          <div class="row">
            <!-- 1. Nama Website -->
            <div class="col-sm-4">
           <div class="mb-3">
             <label>Nama Website</label>
             <input
                name="nama_web"
                value="<?= $web['nama_web'] ?>"
                class="form-control"
                placeholder="Nama Website">
           </div>
         </div>

            <!-- 2. Coordinat Wilayah -->
            <div class="col-sm-4">
             <div class="mb-3">
             <label>Coordinat Wilayah</label>
             <input
                name="coordinat_wilayah"
                value="<?= $web['coordinat_wilayah'] ?>"
                class="form-control"
                placeholder="Coordinat Wilayah">
             </div>
          </div>

          <!-- 3. Zoom View -->
            <div class="col-sm-4">
            <div class="mb-3">
             <label>Zoom View</label>
             <input
                type="number" 
                name="zoom_view"
                value="<?= $web['zoom_view'] ?>"
                min="0" max="20"
                class="form-control"
                placeholder="Zoom View">
             </div>
           </div>
         </div>

         <!-- Tombol Simpan -->
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Simpan</button>
       </div>

        <!-- Wadah Peta Leaflet -->
          <div id="map" style="width: 100%; height: 500px;"></div>
      </div>

          <?php echo form_close() ?>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
     </div>


      <div class="col-md-12">
      <div id="map" style="width: 100%; height: 500px;"></div>
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
    layers: [peta1]
});

const baseMaps = {
	'OpenStreetMap': peta1,
	'satellite': peta2,
    'Streets': peta3,
    'Night': peta4,
};

L.control.layers(baseMaps).addTo(map);

setTimeout(function() {
        map.invalidateSize();
    }, 200);
});
</script>