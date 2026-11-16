<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ExploraMapa | OpenStreetMap</title>
    <meta name="description" content="Explora ubicaciones con mapas libres de OpenStreetMap.">
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIINfQ3dM5s1b0xN4A7z3g2m6kK7R6nN7VQ="
        crossorigin="">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header class="topbar">
        <div class="brand">
            <span class="brand-mark" aria-hidden="true">⌖</span>
            <div>
                <strong>ExploraMapa</strong>
                <span>Mapas abiertos para todos</span>
            </div>
        </div>
        <a class="source-link" href="https://www.openstreetmap.org/" target="_blank" rel="noopener">
            Datos de OpenStreetMap
        </a>
    </header>

    <main class="app-shell">
        <section class="intro">
            <div>
                <p class="eyebrow">Descubre tu próximo destino</p>
                <h1>Encuentra cualquier lugar<br><em>sobre el mapa.</em></h1>
                <p class="intro-copy">Busca una dirección, explora el mapa y haz clic para consultar coordenadas.</p>
            </div>
            <form id="search-form" class="search-panel">
                <label for="search-input">Buscar una ubicación</label>
                <div class="search-row">
                    <input id="search-input" name="q" type="search" placeholder="Ej. Museo del Prado, Madrid" autocomplete="off" required>
                    <button type="submit" id="search-button">Buscar</button>
                </div>
                <p id="search-status" class="search-status" role="status"></p>
            </form>
        </section>

        <section class="map-card" aria-label="Mapa interactivo">
            <div id="map"></div>
            <div class="map-hint">Haz clic en el mapa para consultar una ubicación</div>
            <aside id="location-card" class="location-card" hidden>
                <button id="close-location" class="close-button" type="button" aria-label="Cerrar">×</button>
                <p class="card-label">Ubicación seleccionada</p>
                <h2 id="location-name">Ubicación</h2>
                <dl>
                    <div><dt>Latitud</dt><dd id="location-lat">—</dd></div>
                    <div><dt>Longitud</dt><dd id="location-lon">—</dd></div>
                </dl>
                <a id="open-osm" href="#" target="_blank" rel="noopener">Ver en OpenStreetMap ↗</a>
            </aside>
        </section>
    </main>

    <footer>
        <span>Construido con Leaflet y datos de OpenStreetMap</span>
        <span>© OpenStreetMap contributors</span>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
