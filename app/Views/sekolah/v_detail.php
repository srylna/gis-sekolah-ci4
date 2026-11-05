
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
        <div class="row">
            <div class="col-sm-6">
                 <div id="map" style="width: 100%; height: 500px;"></div>
                </div>

            <div class="col-sm-6">
                
            </div>
            </div>

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


  // Set nilai awal koordinat ke kotak input
  if (coordinatInput) {
    coordinatInput.value = curlocation[0] + "," + curlocation[1];
  }

  
  });
L.marker(<?= $sekolah['coordinat'] ?>).addTo(map);
  
</script>

