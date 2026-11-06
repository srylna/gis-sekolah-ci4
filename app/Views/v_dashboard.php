<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-map-marked-alt me-2"></i> Peta Persebaran Sekolah</h3>
        </div>
        <div class="card-body">
            <!-- Container Peta Leaflet -->
            <div id="map" style="width: 100%; height: 500px; border-radius: 8px;"></div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // 1. Inisialisasi Peta
    <?php 
        $coordinat = isset($setting['coordinat_wilayah']) ? $setting['coordinat_wilayah'] : '-7.294856121608108,109.04345927849569';
        $zoom      = isset($setting['zoom_view']) ? $setting['zoom_view'] : '13';
    ?>

    var map = L.map('map').setView([<?= $coordinat ?>], <?= $zoom ?>);

    // 2. Layer Base Map (Osm & Satelit)
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    });

    var satelit = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 19,
        attribution: 'Tiles © Esri'
    }).addTo(map);

    var baseMaps = {
        "Peta Satelit": satelit,
        "OpenStreetMap": osm
    };
    L.control.layers(baseMaps).addTo(map);

    // 3. Render Wilayah (Aman Teks JSON & Nama File)
    <?php foreach ($wilayah as $w) : ?>
        <?php if (!empty($w['geojson'])) : ?>
            (function() {
                var rawData = <?= json_encode($w['geojson']) ?>;
                var warna = '<?= !empty($w['warna']) ? $w['warna'] : "#3388ff" ?>';
                var nama = '<?= addslashes($w['nama_wilayah']) ?>';

                // Jika data diawali { atau [, anggap string GeoJSON
                if (typeof rawData === 'string' && (rawData.trim().startsWith('{') || rawData.trim().startsWith('['))) {
                    try {
                        var geojsonParsed = JSON.parse(rawData);
                        L.geoJson(geojsonParsed, {
                            style: { color: 'white', fillColor: warna, fillOpacity: 0.5, weight: 1.5 }
                        }).bindPopup("<b style='color:" + warna + ";'>" + nama + "</b>").addTo(map);
                    } catch (e) {
                        console.error("Gagal parse GeoJSON:", nama, e);
                    }
                } else {
                    // Jika data berupa nama file (misal: paguyangan.geojson)
                    $.getJSON("<?= base_url('geojson/') ?>/" + rawData, function(data) {
                        L.geoJson(data, {
                            style: { color: 'white', fillColor: warna, fillOpacity: 0.5, weight: 1.5 }
                        }).bindPopup("<b style='color:" + warna + ";'>" + nama + "</b>").addTo(map);
                    }).fail(function() {
                        console.warn("File GeoJSON tidak ditemukan:", rawData);
                    });
                }
            })();
        <?php endif; ?>
    <?php endforeach; ?>

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