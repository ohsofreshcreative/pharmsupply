// Mapa per kantor – wszystkie pinezki widoczne, mapa wyśrodkowana na danym punkcie.
document.querySelectorAll('.js-cantor-map').forEach(function (mapEl) {
  if (typeof L === 'undefined') return;

  let locations = [];
  try { locations = JSON.parse(mapEl.dataset.locations || '[]'); } catch (e) {}
  if (!locations.length) return;

  const zoom = parseInt(mapEl.dataset.zoom || '15', 10);
  const focusLat = parseFloat(mapEl.dataset.focusLat);
  const focusLng = parseFloat(mapEl.dataset.focusLng);

  const map = L.map(mapEl, { scrollWheelZoom: false });
  L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://cartodb.com/attributions">CARTO</a>'
  }).addTo(map);

  let focusedMarker = null;

  locations.forEach(function (loc) {
    const lat = parseFloat(String(loc.lat).trim());
    const lng = parseFloat(String(loc.lng).trim());
    if (isNaN(lat) || isNaN(lng)) return;

    const marker = L.marker([lat, lng]).addTo(map);
    const popupHtml = (loc.address || loc.label || '').replace(/\n/g, '<br>');
    if (popupHtml) marker.bindPopup(popupHtml);

    if (!isNaN(focusLat) && !isNaN(focusLng) &&
        Math.abs(lat - focusLat) < 1e-5 && Math.abs(lng - focusLng) < 1e-5) {
      focusedMarker = marker;
    }
  });

  if (!isNaN(focusLat) && !isNaN(focusLng)) {
    map.setView([focusLat, focusLng], zoom);
    if (focusedMarker) focusedMarker.openPopup();
  } else {
    const bounds = locations
      .map(l => [parseFloat(l.lat), parseFloat(l.lng)])
      .filter(c => !isNaN(c[0]) && !isNaN(c[1]));
    if (bounds.length === 1) map.setView(bounds[0], zoom);
    else if (bounds.length > 1) map.fitBounds(L.latLngBounds(bounds), { padding: [30, 30] });
  }

  setTimeout(() => map.invalidateSize(), 50);
});
