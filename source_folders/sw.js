const cacheName = "rmoe1";
var cacheassets = [
  "/css/headre.css",
  "/css/profilee.css",
  "/css/rmdoprld.css",
  "/css/rpstrept.css",
  "/css/cmonn.css",
  "/css/editprofilee.css",
  "/css/cameds.css",
  "/css/hmnfcn.css",
  "/css/prdtstss.css",
  "/css/strspgsess.css",
  "/css/login1.css",
  "/css/pdtlbx.css",
  "/css/pdctss.css",
  "/models/remindoIconHeader.css",
  "/header?gthdrfpg=trys",
  "/home",
  "/signin",
  "/home?shmpgrm=yshm",
  "/includes/fn_img/alarmclock.png",
  "/includes/fn_img/dsktop-sginbckig.jpg",
  "/js/cobnfn.js",
  "/js/cmdtr.js",
  "/js/hme.js",
  "/js/hdree.js",
  "/js/htoc.js",
  "/js/srg.js",
  "/js/shrd.js",
  "/profile?nvprfpg=trys",
  "/profile",
  "/profilepgs/js/poflee.js",
  "/stores.php",
  "/stores.php?sstrsnm=treshw",
];
self.addEventListener("install", (e) => {
  e.waitUntil(
    caches
      .open(cacheName)
      .then((cache) => {
        cache.addAll(cacheassets);
      })
      .then(() => {
        self.skipWaiting();
      })
  );
});
self.addEventListener("activate", (e) => {
  e.waitUntil(
    caches.keys().then((cnms) => {
      return Promise.all(
        cnms.map((cach) => {
          if (cach != cacheName) {
            return caches.delete(cach);
          }
        })
      );
    })
  );
});

self.addEventListener("fetch", function (event) {
  event.respondWith(
    caches.match(event.request).then(function (response) {
      // Cache hit - return response
      if (response) {
        return response;
      }
      return fetch(event.request).then(function (response) {
        if (!response || response.status !== 200 || response.type !== "basic") {
          return response;
        }
        return response;
      });
    })
  );
});
