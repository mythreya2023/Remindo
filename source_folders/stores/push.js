push();
function push() {
  OneSignal.push(function () {
    /* These examples are all valid */
    var isPushSupported = OneSignal.isPushNotificationsSupported();
    if (isPushSupported) {
      // Push notifications are supported
      OneSignal.isPushNotificationsEnabled().then(function (isEnabled) {
        $(".disalwtsndpshntfcnsasntfies").change(() => {
          $(".onesignal-customlink-subscribe").click();
        });
        OneSignal.on("subscriptionChange", function (isSubscribed) {
          if (isSubscribed) {
            $(".disalwtsndpshntfcnsasntfies").prop("checked", true);
          } else {
            $(".disalwtsndpshntfcnsasntfies").prop("checked", false);
          }
          $(".allowpushprompt").slideUp(200);
          var usrid = "";
          OneSignal.getUserId(function (userId) {
            if (isSubscribed) {
              usrid = userId;
            } else {
              usrid = 0;
            }
            $.ajax({
              url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
              method: "post",
              data: { usrpdtre: "pshidtre", puid: usrid },
            });
          });
        });
        if (isEnabled) {
          $(".disalwtsndpshntfcnsasntfies").prop("checked", true);
        } else {
          $(".onesignal-customlink-subscribe").click(() => {
            $(".allowpushprompt").slideUp(200);
            push();
          });
          $(".allowpushprompt").css("display", "flex");
          $(".disalwtsndpshntfcnsasntfies").prop("checked", false);
          OneSignal.push(function () {
            // OneSignal.showHttpPrompt();
          });
        }
      });
    } else {
      // Push notifications are not supported
    }
  });
}
