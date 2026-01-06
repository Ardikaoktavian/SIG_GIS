<script type="text/javascript" src="assets/geojson/jkt-kota.js"></script>
<style>
    .info {
        padding: 6px 8px;
        font: 14px/16px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .info h4 {
        margin: 0 0 5px;
        color: #777;
    }

    .legend {
        line-height: 18px;
        color: #555;
    }

    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }
</style>
<script>
    var centerLatLong = [-6.175126961906412, 106.82715350968249];
    var mapOptions = {
        center: centerLatLong,
        zoom: 10
    }

    var map = L.map('map', mapOptions);

    var tileLayer = new L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
    tileLayer.addTo(map);

    var geojson;
    var info;

    function getColor(populasi) {
        return populasi < 1000000 ? '#bedc37ff' :
            populasi < 1500000 ? '#ac6e10ff' :
                populasi < 2000000 ? '#8dee8aff' :
                    populasi < 2500000 ? '#3cadbaff' :
                        populasi < 3000000 ? '#d931dcff' :
                            '#e20f0fff';
    }

    function setStyle(feature) {
        return {
            fillColor: getColor(feature.properties.populasi),
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

    function highlightFeature(e) {
        var layer = e.target;
        info.update(layer.feature.properties);

        layer.setStyle({
            weight: 5,
            color: '#7d11a8e9',
            dashArray: '',
            fillOpacity: 0.7
        });

        layer.bringToFront();
    }

    // method yang dipanggil saat mouseout
    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        info.update();
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function setOnEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
        this.update();
        return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function (props) {
        this._div.innerHTML = '<h4>Populasi Kab/Kota DKI Jakarta</h4>' + (props ?
            '<b>' + props.NAME_2 + '</b><br />' + props.populasi + ' orang'
            : 'Hover over a city');
    };

    info.addTo(map);

    var legend = L.control({ position: 'bottomright' });

    legend.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, 1000000, 1500000, 2000000, 2500000, 3000000],
            labels = [];

        // loop through our population intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColor(grades[i]) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + (grades[i + 1] - 1) + '<br>' : '+');
        }

        return div;
    };

    legend.addTo(map);

    var geojsonOptions = {
        style: setStyle,
        onEachFeature: setOnEachFeature
    }

    geojson = L.geoJSON(data, geojsonOptions).addTo(map);

</script>