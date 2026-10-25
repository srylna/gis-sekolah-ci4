
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
	center: [-7.294856121608108, 109.04345927849569],
	zoom: 12,
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
