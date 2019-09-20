var CACHE_NAME = 'orderit-cache-v1';
var urlsToCache = [
  '/',
  '/js/app.css',
  '/css/algolia.css',
  '/css/main.css'
];

self.addEventListener('install', function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});