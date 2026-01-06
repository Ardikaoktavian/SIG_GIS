<script>
    var centerLatLong = [-6.362571301371958, 106.84438832207255];
    var mapOptions = {
        center: centerLatLong, // Map Options
        zoom: 17
    }

    var map = L.map('map', mapOptions);

    var tileLayer = new L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { // Memanggil API OpenStreetMap (Object Tile Layer)
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
    tileLayer.addTo(map);

    var marker = L.marker(centerLatLong).addTo(map); //Menambahkan Marker
    marker.bindPopup("<b>Hello world!</b><br>Koordinat: " + marker.getLatLng()); //Menambahkan Popup ke Marker

    var count = 0;
    var marker1;
    var marker2;
    var polyline;

    function onClick(e) { //Event Click pada Peta
        if (count == 2) {
            alert("Anda telah mengklik sebanyak 2 kali");
        } else {
            if (count == 0) {
                marker1 = L.marker(e.latlng);
                marker1.bindPopup("Location Marker1: " + e.latlng);
                marker1.addTo(map);
                document.getElementById("point1").innerHTML = "Point1: " + marker1.getLatLng();
            } else {
                marker2 = L.marker(e.latlng);
                marker2.bindPopup("Location Marker2: " + e.latlng);
                marker2.addTo(map);
                document.getElementById("point2").innerHTML = "Point2: " + marker2.getLatLng();

                var latlngs = [ // polyline
                    marker1.getLatLng(),
                    marker2.getLatLng()
                ];

                polyline = L.polyline(latlngs, {
                    color: 'red'
                }).addTo(map);

                //Zoom the map to the polyline
                map.fitBounds(polyline.getBounds());

                var dist = map.distance(marker1.getLatLng(), marker2.getLatLng()); //Mengukur jarak antara kedua marker
                document.getElementById("distance").innerHTML = "Distance: " + dist + " meter";
            }
            count++;
        }
    }
    map.on('click', onClick);

    function reset() { // Reset marker dan label
        count = 0;
        if (marker1) marker1.remove();
        if (marker2) marker2.remove();
        if (polyline) polyline.remove();
        document.getElementById("point1").innerHTML = "Point1: ";
        document.getElementById("point2").innerHTML = "Point2: ";
        document.getElementById("distance").innerHTML = "Distance: ";
    }
</script>