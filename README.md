# ExploraMapa

Aplicación web sencilla para visualizar e interactuar con mapas de [OpenStreetMap](https://www.openstreetmap.org/). Permite buscar direcciones mediante Nominatim, hacer clic sobre el mapa y abrir las coordenadas directamente en OpenStreetMap.

## Tecnologías

- HTML y PHP para la vista y el endpoint de geocodificación.
- CSS responsive sin dependencias de build.
- JavaScript y [Leaflet](https://leafletjs.com/) para el mapa interactivo.
- Teselas y datos de OpenStreetMap; la búsqueda utiliza el servicio público Nominatim.

## Ejecutar localmente

Requiere PHP 8.0 o superior:

```bash
php -S localhost:8000
```

Abre <http://localhost:8000> en el navegador.

El endpoint `api/geocode.php` actúa como proxy para que la interfaz pueda consultar Nominatim con un `User-Agent` identificable. En producción, respeta la [política de uso de Nominatim](https://operations.osmfoundation.org/policies/nominatim/) y configura límites o caché apropiados.
