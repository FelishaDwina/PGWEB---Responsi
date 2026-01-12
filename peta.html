<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sultra Seaport WebGIS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <link rel="stylesheet" href="CSS/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">Sultra Seaport</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.html"><i class="bi bi-house-door"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="peta.html"><i class="bi bi-geo-alt"></i> Peta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tabel.html"><i class="bi bi-table"></i> Tabel Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="info.html"><i class="bi bi-info-circle"></i> Info</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid flex-grow-1">
<div class="container-fluid mt-2">
    <h4 class="text-center">Sultra Seaport WebGIS: Peta Persebaran Pelabuhan</h4>

    <!-- Map Search Control (Miniaturized and Positioned) -->
    <div id="map-search-control" class="map-control-container">
        <div class="input-group input-group-sm"> <!-- Smaller input group -->
            <input type="text" id="searchInput" class="form-control" placeholder="Cari..." aria-label="Search port">
            <button class="btn btn-primary" type="button" id="searchButton"><i class="bi bi-search"></i></button>
        </div>
    </div>

    <div id="map"></div>
</div>

<script>
    var map = L.map('map').setView([-4.0, 122.5], 7);


    // Basemaps
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'OpenStreetMap'
    });

    var cartoDB_DarkMatter = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    });

    var esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });

    // WMS GeoServer (Batas Administrasi)
    var batasAdmin = L.tileLayer.wms("http://localhost:8080/geoserver/wms", {
        layers: "responsi_pgweb:SULTRA",
        format: "image/png",
        transparent: true
    });
    
    // Custom Marker Icons
    var violetIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var blueIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var blackIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var greyIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-grey.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Function to get marker icon based on port type
    function getIcon(jenis) {
        const lowerJenis = jenis.toLowerCase();

        if (lowerJenis.includes('dermaga')) {
            return violetIcon; // purple
        } else if (lowerJenis.includes('penyeberangan')) { // ferry
            return blackIcon; // black/grey
        } else if (lowerJenis.includes('laut') || lowerJenis.includes('umum')) {
            return blueIcon;
        } else {
            return greyIcon; // Default icon
        }
    }

    // Layer Group for Pelabuhan markers
    var pelabuhanLayer = L.layerGroup();
    var allPelabuhanData = []; // PHP data passed to JS

    function createMarker(data) {
        var popupContent = "<div class='popup-content'>";
        if (data.Gambar) {
            popupContent += "<img src='img/" + data.Gambar + "' class='img-fluid mb-2 popup-img' alt='Gambar Pelabuhan " + data.Nama + "'>";
        }
        popupContent += "<b>" + data.Nama + "</b><br>";
        popupContent += "<small><i class='bi bi-geo-alt-fill me-1'></i>Lokasi: " + data.Lokasi + "</small><br>";
        popupContent += "<small><i class='bi bi-tag-fill me-1'></i>Jenis: " + data.Jenis + "</small><br>";
        if (data.Deskripsi) {
            popupContent += "<small class='text-muted d-block mt-1'>" + data.Deskripsi.substring(0, 100) + "...</small>";
        }
        popupContent += "<a href='detail.html?id=" + data.id + "' class='btn btn-info btn-xs mt-2'><i class='bi bi-info-circle me-1'></i> Detail</a>";
        popupContent += "</div>";

        var originalIcon = getIcon(data.Jenis); // Get original icon
        var marker = L.marker([data.Latitude, data.Longitude], {icon: originalIcon})
            .bindPopup(popupContent);
        
        marker.originalIcon = originalIcon; // Store original icon

        marker.on('popupopen', function() {
            var iconElement = this._icon;
            if (iconElement) {
                L.DomUtil.addClass(iconElement, 'marker-active');
            }
            this.setIcon(redIcon); // Change to red icon
        });
        marker.on('popupclose', function() {
            var iconElement = this._icon;
            if (iconElement) {
                L.DomUtil.removeClass(iconElement, 'marker-active');
            }
            this.setIcon(this.originalIcon);
        });

        return marker;
    }

    // Function to filter and display markers
    function filterMapMarkers() {
        pelabuhanLayer.clearLayers(); // Clear existing markers

        var searchTerm = document.getElementById('searchInput').value.toLowerCase();
        var filteredMarkers = [];
        var bounds = [];

        allPelabuhanData.forEach(function(data) {
            var name = data.Nama ? data.Nama.toLowerCase() : '';
            var lokasi = data.Lokasi ? data.Lokasi.toLowerCase() : '';
            var jenis = data.Jenis ? data.Jenis.toLowerCase() : '';
            var deskripsi = data.Deskripsi ? data.Deskripsi.toLowerCase() : '';

            if (searchTerm === '' || 
                name.includes(searchTerm) || 
                lokasi.includes(searchTerm) || 
                jenis.includes(searchTerm) ||
                deskripsi.includes(searchTerm)) {
                
                var marker = createMarker(data);
                pelabuhanLayer.addLayer(marker);
                filteredMarkers.push(marker);
                bounds.push([data.Latitude, data.Longitude]);
            }
        });

        pelabuhanLayer.addTo(map);

        // Adjust map view to filtered markers if any
        if (bounds.length > 0) {
            map.fitBounds(bounds, {padding: [50, 50]});
        } else if (searchTerm !== '') {
            // If search term but no results, maybe show a message or reset view
            // For now, it will just show an empty map, which is fine.
        } else {
            // No search term, show all by resetting view
            map.setView([-4.0, 122.5], 7);
        }
    }

    // Initial load of all markers
    filterMapMarkers();

    // Event listener for search input
    document.getElementById('searchInput').addEventListener('keyup', filterMapMarkers);
    document.getElementById('searchButton').addEventListener('click', filterMapMarkers);


    // Set default layers
    osm.addTo(map);
    batasAdmin.addTo(map);
    // pelabuhanLayer.addTo(map); // Added by filterMapMarkers()

    var baseMaps = {
        "OpenStreetMap": osm,
        "CartoDB Dark": cartoDB_DarkMatter,
        "Esri World Imagery": esri_WorldImagery
    };

    var pelabuhanLegend = "Titik Sultra Seaport <br>" +
        "&nbsp;&nbsp;<i class='legend-icon' style='background:blue'></i> Umum<br>" +
        "&nbsp;&nbsp;<i class='legend-icon' style='background:violet'></i> Dermaga<br>" +
        "&nbsp;&nbsp;<i class='legend-icon' style='background:black'></i> Ferry";

    var overlayMaps = {
        "Batas Administrasi": batasAdmin
    };
    overlayMaps[pelabuhanLegend] = pelabuhanLayer;

    L.control.layers(baseMaps, overlayMaps).addTo(map);
</script>
</div> <!-- /container-fluid -->

<footer class="footer mt-auto py-3 text-center">
  <p class="mb-0">© 2024 Sultra Seaport</p>
</footer>

</body>
</html>
