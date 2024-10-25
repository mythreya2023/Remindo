rswr();
function rswr() {
  if (navigator.serviceWorker) {
    window.addEventListener("load", () => {
      navigator.serviceWorker
        .register("http://localhost/remindo/sw.js")
        .then((reg) => {})
        .catch();
    });
  }
}
var deferredPrompt;
var button = document.querySelector(".istalrmoapbtn");
window.addEventListener("beforeinstallprompt", (e) => {
  e.preventDefault();
  deferredPrompt = e;
  button.addEventListener("click", (e) => {
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === "accepted") {
        var d = new Date();
        d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
        var expires = "expires=" + d.toUTCString();
        document.cookie = "_hpa_=isladpwa," + expires + ";";
      } else {
      }
      deferredPrompt = null;
    });
  });
});
window.addEventListener("appinstalled", () => {
  hideInstallPromotion();
  deferredPrompt = null;
});
window
  .matchMedia("(display-mode: standalone)")
  .addEventListener("change", (evt) => {
    let displayMode = "browser";
    if (evt.matches) {
      displayMode = "standalone";
    }
  });
