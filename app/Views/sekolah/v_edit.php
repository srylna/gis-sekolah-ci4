
<!-- Tampilkan Pesan Validasi Error jika Ada -->
<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <h5><i class="icon fas fa-ban"></i> Terjadi Kesalahan Input!</h5>
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<div class="col-md-12">
        <div class="card card-outline card-success mb-4">
         <div class="card-header">
            <h3 class="card-title"><?php echo $title; ?></h3>
</div>

      <div class="card-body">
        <php 
        session();
        $validation = \Config\Services::validation();
        ?>

      <?php echo form_open_multipart('sekolah/UpdateData/' . $sekolah['id_sekolah']) ?>
      
      <div class="row">
  <div class="col-sm-6">
    <div class="form-group mb-3">
      <label class="form-label fw-bold">Nama Sekolah</label>
      <input name="nama_sekolah" value="<?= old('nama_sekolah', $sekolah['nama_sekolah']) ?>" class="form-control" placeholder="Nama Sekolah">
      <p class="text-danger"><?= validation_show_error('nama_sekolah') ?></p>
    </div>
  </div>

  <div class="col-sm-2">
    <div class="form-group mb-3">
      <label class="form-label fw-bold">Akreditasi</label>
      <input type="text" name="akreditasi" value="<?= old('akreditasi', $sekolah['akreditasi']) ?>" class="form-control" placeholder="Akreditasi">
      <p class="text-danger"><?= validation_show_error('akreditasi') ?></p>
    </div>
  </div>

  <div class="col-sm-2">
    <div class="form-group mb-3">
      <label class="form-label fw-bold">Status</label>
      <select name="status" class="form-select">
        <option value="">-- Pilih Status --</option>
        <option value="Negeri" <?= old('status', $sekolah['status']) == 'Negeri' ? 'selected' : '' ?>>Negeri</option>
        <option value="Swasta" <?= old('status', $sekolah['status']) == 'Swasta' ? 'selected' : '' ?>>Swasta</option>
      </select>
      <p class="text-danger"><?= validation_show_error('status') ?></p>
    </div>
  </div>

  <div class="col-sm-2">
    <div class="form-group mb-3">
      <label class="form-label fw-bold">Jenjang</label>
      <select name="id_jenjang" class="form-select">
        <option value="">-- Pilih Jenjang --</option>
        <?php foreach ($jenjang as $key => $value) : ?>
          <option value="<?= $value['id_jenjang'] ?>" <?= old('id_jenjang', $sekolah['id_jenjang']) == $value['id_jenjang'] ? 'selected' : '' ?>><?= $value['jenjang'] ?></option>
        <?php endforeach; ?>
      </select>
      <p class="text-danger"><?= validation_show_error('id_jenjang') ?></p>
    </div>
  </div>
</div>


       <div class="form-group mb-3">
            <label class="form-label fw-bold">Coordinat Sekolah</label>
            <div id="map" style="width: 100%; height: 500px;"></div>
            <input 
              name="coordinat" 
              id="coordinat"
              value="<?= old('coordinat', $sekolah['coordinat']) ?>"
              class="form-control"
              placeholder="Coordinat Sekolah">
              <p class="text-danger"><?= validation_show_error('coordinat') ?></p>
        </div>

        <!-- Baris 1: Provinsi, Kabupaten, Kecamatan -->
     <div class="row">
       <!-- Provinsi -->
       <div class="col-sm-4">
         <div class="form-group mb-3">
           <label class="form-label fw-bold">Provinsi</label>
           <select name="id_provinsi" id="id_provinsi" class="form-select select2">
             <option value="">--Pilih Provinsi--</option>
             <?php foreach ($provinsi as $key => $value) : ?>
               <option value="<?= $value['id_provinsi'] ?>" <?= old('id_provinsi', $sekolah['id_provinsi']) == $value['id_provinsi'] ? 'selected' : '' ?>>
                 <?= $value['nama_provinsi'] ?>
               </option>
             <?php endforeach; ?>
           </select>
           <p class="text-danger"><?= validation_show_error('id_provinsi') ?></p>
         </div>
       </div>
     
       <!-- Kabupaten -->
       <div class="col-sm-4">
         <div class="form-group mb-3">
           <label class="form-label fw-bold">Kabupaten</label>
           <select name="id_kabupaten" id="id_kabupaten" class="form-select select2">
             <option value="">--Pilih Kabupaten--</option>
             <option value="<?= $sekolah['id_kabupaten'] ?>" selected><?= $sekolah['nama_kabupaten'] ?></option>
           </select>
           <p class="text-danger"><?= validation_show_error('id_kabupaten') ?></p>
         </div>
       </div>
     
       <!-- Kecamatan -->
       <div class="col-sm-4">
         <div class="form-group mb-3">
           <label class="form-label fw-bold">Kecamatan</label>
           <select name="id_kecamatan" id="id_kecamatan" class="form-select select2">
             <option value="">--Pilih Kecamatan--</option>
                  <option value="<?= $sekolah['id_kecamatan'] ?>" selected><?= $sekolah['nama_kecamatan'] ?></option>
           </select>
           <p class="text-danger"><?= validation_show_error('id_kecamatan') ?></p>
         </div>
       </div>
     </div>

          <div class="row">
     <!-- Alamat (col-sm-8) -->
     <div class="col-sm-8">
       <div class="form-group mb-3">
         <label class="form-label fw-bold">Alamat</label>
         <input type="text" name="alamat" value="<?= old('alamat', $sekolah['alamat']) ?>" class="form-control" placeholder="Alamat Sekolah">
         <p class="text-danger"><?= validation_show_error('alamat') ?></p>
       </div>
     </div>
   
     <!-- Wilayah Administrasi (col-sm-4) MASUK DI DALAM ROW YANG SAMA -->
     <div class="col-sm-4">
       <div class="form-group mb-3">
         <label class="form-label fw-bold">Wilayah Administrasi</label>
         <select name="id_wilayah" class="form-select select2">
           <option value="">--Pilih Wilayah Administrasi--</option>
           <?php foreach ($wilayah as $key => $value): ?>
             <option value="<?= $value['id_wilayah'] ?>" <?= old('id_wilayah', $sekolah['id_wilayah']) == $value['id_wilayah'] ? 'selected' : '' ?>>
               <?= $value['nama_wilayah'] ?>
             </option>
           <?php endforeach; ?>
         </select>
         <p class="text-danger"><?= validation_show_error('id_wilayah') ?></p>
       </div>
     </div>
   </div>
   
  <div class="row">
  <div class="col-sm-12">
    <div class="form-group mb-3">
   <label class="form-group fw-bold">Ganti Foto Sekolah</label>
         <input type="file" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" name="foto" class="form-control">
         <p class="form select"><?= validation_show_error('foto') ?></p>
       </div>

         <div class="mb-3">
            <button class="btn btn-primary" type="submit">Simpan</button>
            <a href="<?php echo base_url('Sekolah') ?>" class="btn btn-success" >Kembali</a>
       </div>


           <?php echo form_close() ?>
      </div>
   </div>
</div>

<script>
  $(document).ready(function() {
    // Inisialisasi Select2 dengan pencarian untuk AdminLTE 4 / Bootstrap 5
   $('.select2').select2({
      theme: 'bootstrap-5',
      width: '100%' 
    });

   // 2. Ketika Provinsi Dipilih -> Load Kabupaten via AJAX
    $('#id_provinsi').on('change select2:select', function() {
      var id_provinsi = $(this).val();

      if (id_provinsi != '' && id_provinsi != null) {
        $.ajax({
          type: "POST",
          url: "<?= base_url('Sekolah/Kabupaten') ?>",
          data: { id_provinsi: id_provinsi },
          dataType: "html",
          success: function(response) {
            // Masukkan pilihan kabupaten baru
            $('#id_kabupaten').html(response);
            
            // Inisialisasi ulang Select2 Kabupaten
            $('#id_kabupaten').select2({
              theme: 'bootstrap-5',
              width: '100%'
            });

            // Reset dropdown Kecamatan dengan benar
            $('#id_kecamatan').html('<option value="">--Pilih Kecamatan--</option>');
            $('#id_kecamatan').select2({
              theme: 'bootstrap-5',
              width: '100%'
            });
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error Kabupaten:", error);
          }
        });
      } else {
        $('#id_kabupaten').html('<option value="">--Pilih Kabupaten--</option>').select2({
          theme: 'bootstrap-5',
          width: '100%'
        });
        $('#id_kecamatan').html('<option value="">--Pilih Kecamatan--</option>').select2({
          theme: 'bootstrap-5',
          width: '100%'
        });
      }
    });

    // 3. Ketika Kabupaten Dipilih -> Load Kecamatan via AJAX
    $('#id_kabupaten').on('change select2:select', function() {
      var id_kabupaten = $(this).val();

      if (id_kabupaten != '' && id_kabupaten != null) {
        $.ajax({
          type: "POST",
          url: "<?= base_url('Sekolah/Kecamatan') ?>",
          data: { id_kabupaten: id_kabupaten },
          dataType: "html",
          success: function(response) {
            // Masukkan pilihan kecamatan baru
            $('#id_kecamatan').html(response);

            // Inisialisasi ulang Select2 Kecamatan
            $('#id_kecamatan').select2({
              theme: 'bootstrap-5',
              width: '100%'
            });
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error Kecamatan:", error);
          }
        });
      }
    });


       });
</script>

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

    const map = L.map('map', {
	center: [<?= $sekolah['coordinat'] ?>],
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
// 2. Setting Ikon Marker Biru (Mengatasi gambar ikon yang hilang/broken)
  var defaultIcon = L.icon({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
  });

  // 3. Ambil koordinat awal
  var curlocation = [<?= $sekolah['coordinat'] ?>];
  var coordinatInput = document.getElementById('coordinat');

  // 4. Buat Marker Biru Awal (bisa digeser) & Tampilkan ke Peta
  var marker = L.marker(curlocation, {
    icon: defaultIcon,
    draggable: true
  }).addTo(map);

  // Set nilai awal koordinat ke kotak input
  if (coordinatInput) {
    coordinatInput.value = curlocation[0] + "," + curlocation[1];
  }

  // 5. Update koordinat saat marker DIGESER
  marker.on('dragend', function (e) {
    var position = marker.getLatLng();
    marker.setLatLng(position);
    if (coordinatInput) {
      coordinatInput.value = position.lat + "," + position.lng;
    }
  });

  // 6. Update koordinat saat peta DIKLIK
  map.on("click", function (e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;

    if (!marker) {
      marker = L.marker(e.latlng, { icon: defaultIcon, draggable: true }).addTo(map);
    } else {
      marker.setLatLng(e.latlng);
    }

    if (coordinatInput) {
      coordinatInput.value = lat + "," + lng;
    }
  });
  });
map.addLayer(marker);
</script>

