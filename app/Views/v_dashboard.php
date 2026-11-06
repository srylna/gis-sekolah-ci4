<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-map-marked-alt"></i> Peta Persebaran Sekolah</h3>
        </div>
        <div class="card-body">
            <!-- Container Peta Leaflet -->
            <div id="map" style="width: 100%; height: 500px; border-radius: 8px;"></div>
        </div>
    </div>
</div>

<!-- Include Leaflet CSS & JS di template backend jika belum ada -->
<script>
   // Menggunakan nama kolom coordinat_wilayah & zoom_view dari tbl_setting
var map = L.map('map').setView([<?= $setting['coordinat_wilayah'] ?>], <?= $setting['zoom_view'] ?>);

    // 2. Definisi Layer Peta (Osm & Satelit Esri)
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    });

    var satelit = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 19,
        attribution: 'Tiles © Esri'
    }).addTo(map); // Default pakai Satelit

    var baseMaps = {
        "Peta Satelit": satelit,
        "OpenStreetMap": osm
    };

    L.control.layers(baseMaps).addTo(map);

    // 3. Render Polygon Wilayah / Kecamatan (jika ada data GeoJSON)
    <?php foreach ($wilayah as $w) : ?>
        $.getJSON("<?= base_url('geojson/' . $w['geojson']) ?>", function(data) {
            L.geoJson(data, {
                style: {
                    color: 'white',
                    fillColor: '<?= $w['warna'] ?>',
                    fillOpacity: 0.6,
                    weight: 1.5
                }
            }).bindPopup("<b style='color:<?= $w['warna'] ?>;'><?= $w['nama_wilayah'] ?></b>").addTo(map);
        });
    <?php endforeach; ?>

    // 4. Custom Icon Marker Sekolah (Opsional / Marker Standar)
    var iconSekolah = L.icon({
        iconUrl: '<?= base_url('icon/marker.png') ?>', // Sesuaikan folder icon kamu jika ada
        iconSize: [30, 40],
        iconAnchor: [15, 40],
        popupAnchor: [0, -35]
    });

    // 5. Looping Marker Semua Sekolah dari Database
    <?php foreach ($sekolah as $s) : ?>
        <?php if (!empty($s['coordinat'])) : ?>
            var marker = L.marker([<?= $s['coordinat'] ?>], {
                // icon: iconSekolah // Hapus komen ini jika menggunakan icon kustom
            }).addTo(map);

            // Isi Popup Marker (Sama persis seperti di video tutorial)
            var popupContent = `
                <div class="text-center" style="max-width: 200px;">
                    <img src="<?= base_url('foto/' . $s['foto']) ?>" width="100%" height="120px" style="object-fit:cover; border-radius: 5px; margin-bottom:5px;">
                    <h6 class="fw-bold mb-1" style="font-size:13px;"><?= $s['nama_sekolah'] ?></h6>
                    <p class="mb-1 text-muted" style="font-size:11px;">Akreditasi: <b><?= $s['akreditasi'] ?></b> | Status: <b><?= $s['status'] ?></b></p>
                    <a href="<?= base_url('Sekolah/Detail/' . $s['id_sekolah']) ?>" class="btn btn-sm btn-primary w-100 mt-1" style="font-size:11px;">Detail</a>
                </div>
            `;

            marker.bindPopup(popupContent);
        <?php endif; ?>
    <?php endforeach; ?>
</script>