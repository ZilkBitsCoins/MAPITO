const DEFAULT_LOCATION = [40.4168, -3.7038];
const map = L.map('map', { zoomControl: false }).setView(DEFAULT_LOCATION, 13);
L.control.zoom({ position: 'bottomright' }).addTo(map);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

const form = document.querySelector('#search-form');
const input = document.querySelector('#search-input');
const button = document.querySelector('#search-button');
const status = document.querySelector('#search-status');
const locationCard = document.querySelector('#location-card');
const locationName = document.querySelector('#location-name');
const locationLat = document.querySelector('#location-lat');
const locationLon = document.querySelector('#location-lon');
const openOsm = document.querySelector('#open-osm');
let marker;

function showLocation({ lat, lon, name }) {
    const latitude = Number(lat);
    const longitude = Number(lon);
    if (!Number.isFinite(latitude) || !Number.isFinite(longitude)) return;

    if (marker) marker.remove();
    marker = L.marker([latitude, longitude]).addTo(map);
    map.setView([latitude, longitude], Math.max(map.getZoom(), 15), { animate: true });

    locationName.textContent = name || 'Ubicación seleccionada';
    locationLat.textContent = latitude.toFixed(5);
    locationLon.textContent = longitude.toFixed(5);
    openOsm.href = `https://www.openstreetmap.org/?mlat=${latitude}&mlon=${longitude}#map=17/${latitude}/${longitude}`;
    locationCard.hidden = false;
}

async function searchLocation(query) {
    button.disabled = true;
    status.textContent = 'Buscando ubicación…';
    try {
        const response = await fetch(`api/geocode.php?q=${encodeURIComponent(query)}`, {
            headers: { Accept: 'application/json' }
        });
        const data = await response.json();
        if (!response.ok) throw new Error(data.error || 'No se pudo completar la búsqueda.');
        if (!data.results.length) {
            status.textContent = 'No encontramos resultados. Prueba con otra búsqueda.';
            return;
        }
        const result = data.results[0];
        showLocation(result);
        status.textContent = data.results.length > 1
            ? `${data.results.length} resultados encontrados. Mostrando el primero.`
            : 'Ubicación encontrada.';
    } catch (error) {
        status.textContent = error.message;
    } finally {
        button.disabled = false;
    }
}

form.addEventListener('submit', (event) => {
    event.preventDefault();
    const query = input.value.trim();
    if (query.length >= 2) searchLocation(query);
});

map.on('click', (event) => {
    showLocation({
        lat: event.latlng.lat,
        lon: event.latlng.lng,
        name: 'Punto seleccionado en el mapa'
    });
    status.textContent = 'Punto seleccionado.';
});

document.querySelector('#close-location').addEventListener('click', () => {
    locationCard.hidden = true;
    if (marker) {
        marker.remove();
        marker = null;
    }
});
