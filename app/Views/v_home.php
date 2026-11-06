
<div id="map" style="width: 1550px; height: 750px;"></div>

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

 
// 4. Render Marker Sekolah Sesuai Icon Jenjang
    <?php foreach ($sekolah as $s) : ?>
        <?php if (!empty($s['coordinat'])) : ?>
            <?php 
                $markerFile = !empty($s['marker']) ? $s['marker'] : 'marker.png'; 
            ?>
            var iconSekolah = L.icon({
                iconUrl: '<?= base_url('marker/' . $markerFile) ?>',
                iconSize: [30, 40],
                iconAnchor: [15, 40],
                popupAnchor: [0, -35]
            });

            var marker = L.marker([<?= $s['coordinat'] ?>], {
                icon: iconSekolah
            }).addTo(map);

            var popupContent = `
                <div class="text-center" style="max-width: 200px;">
                    <img src="<?= base_url('foto/' . $s['foto']) ?>" width="100%" height="120px" style="object-fit:cover; border-radius: 5px; margin-bottom:5px;">
                    <h6 class="fw-bold mb-1" style="font-size:13px;"><?= addslashes($s['nama_sekolah']) ?></h6>
                    <p class="mb-1 text-muted" style="font-size:11px;">Status: <b><?= $s['status'] ?></b></p>
                    <a href="<?= base_url('Sekolah/Detail/' . $s['id_sekolah']) ?>" class="btn btn-sm btn-primary w-100 mt-1" style="font-size:11px;">Detail</a>
                </div>
            `;
            marker.bindPopup(popupContent);
        <?php endif; ?>
    <?php endforeach; ?>
});
</script>
