<script type="text/javascript" src="assets/geojson/jogja-lapangan.js"></script>
<script>
    var centerLatLong = [-7.782783602145651, 110.36706496627167];
    var mapOptions = {
        center: centerLatLong,
        zoom: 17
    }

    var map = L.map('map', mapOptions);

    var tileLayer = new L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
    tileLayer.addTo(map);

    var circleMarkerOptions = {
        radius: 6,
        fillColor: "#ff0004ff",
        color: "#000",
        weight: 1,
        opacity: 1,
        fillOpacity: 0.8
    };

    function setCircleMarker(feature, latlng) {
        return L.circleMarker(latlng, circleMarkerOptions);
    }

    function setPopupContent(feature, layer) {
        // does this feature have a property named nama_lapan?
        if (feature.properties && feature.properties.nama_lapan) {
            layer.bindPopup(feature.properties.nama_lapan);
        }
    }

    var showMancasanOnly = false;

    function showMancasanOnlyFilter(feature, layer) {
        var showOnMap = false;

        if (showMancasanOnly && feature.properties && feature.properties.nama_lapan) {
            if (feature.properties.nama_lapan == "Lapangan Mancasan") {
                showOnMap = true;
            }
        } else {
            showOnMap = true;
        }

        return showOnMap;
    }

    var geojsonOptions = {
        pointToLayer: setCircleMarker,
        onEachFeature: setPopupContent,
        filter: showMancasanOnlyFilter
    }

    L.geoJSON(data, geojsonOptions).addTo(map);

</script>