<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Detail Sekolah: <b><?= $sekolah['nama_sekolah'] ?></b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Kolom Kiri: Peta Lokasi Sekolah & Polygon Wilayah -->
                <div class="col-md-6 mb-3">
                    <div id="map" style="width: 100%; height: 350px; border-radius: 8px; border: 1px solid #ddd;"></div>
                </div>

                <!-- Kolom Kanan: Foto Sekolah -->
                <div class="col-md-6 mb-3">
                    <img src="<?= base_url('foto/' . $sekolah['foto']) ?>" width="100%" height="350px" style="object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                </div>

                <!-- Bagian Bawah: Tabel Detail Informasi Sekolah -->
                <div class="col-md-12 mt-2">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="200px">Nama Sekolah</th>
                            <td width="30px" class="text-center">:</td>
                            <td><b><?= $sekolah['nama_sekolah'] ?></b></td>
                        </tr>
                        <tr>
                            <th>Jenjang Sekolah</th>
                            <td class="text-center">:</td>
                           <!-- Menggunakan Null Coalescing Operator (??) agar aman dari error -->
<td><?= $sekolah['nama_jenjang'] ?? $sekolah['jenjang'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Status Sekolah</th>
                            <td class="text-center">:</td>
                            <td><?= $sekolah['status'] ?></td>
                        </tr>
                        <tr>
                            <th>Akreditasi Sekolah</th>
                            <td class="text-center">:</td>
                            <td><?= $sekolah['akreditasi'] ?></td>
                        </tr>
                        <tr>
                            <th>Wilayah / Kecamatan</th>
                            <td class="text-center">:</td>
                            <td><?= $sekolah['nama_wilayah'] ?></td>
                        </tr>
                        <tr>
                            <th>Alamat Sekolah</th>
                            <td class="text-center">:</td>
                            <td><?= $sekolah['alamat'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Leaflet JS Khusus Detail -->
<script>
$(document).ready(function() {
    // 1. Inisialisasi Peta Langsung Berfokus pada Koordinat Sekolah Ini (Zoom 15)
    var map = L.map('map').setView([<?= $sekolah['coordinat'] ?>], 15);

    // 2. Base Map Satelit & Osm
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

    // 3. Render Polygon Wilayah Tempat Sekolah Berada (jika ada file GeoJSON)
    <?php if (!empty($sekolah['geojson'])) : ?>
        var rawData = <?= json_encode($sekolah['geojson']) ?>;
        var warna = '<?= !empty($sekolah['warna']) ? $sekolah['warna'] : "#ff7800" ?>';
        var namaWilayah = '<?= addslashes($sekolah['nama_wilayah']) ?>';

        if (typeof rawData === 'string' && (rawData.trim().startsWith('{') || rawData.trim().startsWith('['))) {
            var geojsonParsed = JSON.parse(rawData);
            L.geoJson(geojsonParsed, {
                style: { color: 'white', fillColor: warna, fillOpacity: 0.5, weight: 2 }
            }).bindPopup("<b>" + namaWilayah + "</b>").addTo(map);
        } else {
            $.getJSON("<?= base_url('geojson/') ?>/" + rawData, function(data) {
                L.geoJson(data, {
                    style: { color: 'white', fillColor: warna, fillOpacity: 0.5, weight: 2 }
                }).bindPopup("<b>" + namaWilayah + "</b>").addTo(map);
            });
        }
    <?php endif; ?>

    // 4. Marker Tempat Lokasi Sekolah dengan Icon Jenjang
    var iconSekolah = L.icon({
        iconUrl: '<?= base_url('marker/' . $sekolah['marker']) ?>',
        iconSize: [35, 45],
        iconAnchor: [17, 45],
        popupAnchor: [0, -40]
    });

    L.marker([<?= $sekolah['coordinat'] ?>], { icon: iconSekolah })
        .addTo(map)
        .bindPopup("<b><?= addslashes($sekolah['nama_sekolah']) ?></b><br><?= addslashes($sekolah['nama_wilayah']) ?>")
        .openPopup();
});
</script>