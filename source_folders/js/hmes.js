$(document).ready(function () {
  if ($("body").attr("class") == "storecustmrpgbdy") {
    $("body").removeClass("storecustmrpgbdy");
  }
  $.ajax({
    url: "header.php",
    method: "get",
    data: { gthdrfpg: "trys" },
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $("div.pageloader").hide();
      $("div.remindomainheaderlptpvsn").html(data);
    },
  });
  //fed
  var pdsrs = true;
  var updsfmsrs = true;
  var mybsns = true;
  rmdofeedinhmpg();
  function rmdofeedinhmpg(e) {
    $.ajax({
      url: "prslsgns/psnlsgsns.php",
      method: "post",
      data: { gtusrsuggsts: "ftchrqst" },
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $("div.pageloader").hide();
        if (data != "") {
          pdsrs = true;
          $(".rmdomcntpndppldvbx").html(data);
        } else {
          pdsrs = false;
          vrfynw();
        }
      },
    });
  }
  function vrfynw() {
    if (!mybsns && !pdsrs && !updsfmsrs) {
      $(".rmdohmpgitrctivdvbx").show();
    } else {
      $(".rmdohmpgitrctivdvbx").hide();
    }
  }
  var os = 0;
  var lt = 5;
  var srq = false;
  var ndta = false;
  hmpgprflesugsts(true, os, lt);
  rmhfd(true, os, lt);
  $(document).on("touchmove", scrlfun);
  $(window).scroll(scrlfun);
  function scrlfun() {
    if (
      $(window).scrollTop() + $(window).height() + 10 >
      $(".remindochildboxycontainer").height()
    ) {
      os += lt;
      if (updsfmsrs && !srq && !ndta) {
        rmhfd(false, os, lt);
      }
    }
  }
  function hmpgprflesugsts(f, os, lt) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/odrvtrngs.php",
      method: "post",
      data: { gthmdshbrd: "ystrehmpgdshbrdshw", os: os, lt: lt },
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $("div.pageloader").hide();
        if (data == "" || data == 0) {
          mybsns = false;
          vrfynw();
        } else {
          mybsns = true;
          $(".strdshbrddvbx").html(data);
          gtstr();
          ysnofun();
        }
      },
    });
  }
  function rmhfd(f, os, lt) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/hfd.php",
      method: "post",
      data: { dphfd: "tredphf", os: os, lt: lt },
      beforeSend: function () {
        srq = true;
        $("div.pageloader").show();
        preloaderon();
        // $(".sctnlstupdtsbdydvbx").append(
        // "<div class='prldrspnr'><center><div style='color:#ff8d00;'><i class='fas fa-circle-notch fa-spin' style='font-weight:900;'></i></div></center></div>"
        // );
      },
      success: function (data) {
        $("div.pageloader").hide();
        srq = false;
        if (data != "" && data != 0) {
          if (f) {
            $(".sctnlstupdtsbdydvbx").html(data);
          } else {
            $(".sctnlstupdtsbdydvbx").append(data);
          }
          gtstr();
          rmdoshre();
          // srtlvmdl();
          opndsply(false, false);
          $(".coumhebn").click((e) => {
            uvm(
              "m",
              $(e.target).attr("data-sid"),
              $(e.target).attr("data-pid")
            );
          });
        } else {
          $(".sctnlstupdsttledvbx").hide();
          ndta = true;
          if (f) {
            updsfmsrs = false;
            // $(".sctnlstupdtsbdydvbx").html(
            // "<center><h3 style='color:gray;'>You have no new updates.</h3></center>"
            // );
          }
          vrfynw();
        }
      },
    });
  }
  $(".pdtbuynvgtosrpg").click((e) => {
    e.preventDefault();
    var gst = $(".lbx-srcmr-pfunm").text().substr(1);
    $.ajax({
      url: "http://localhost/remindo/stores/store",
      method: "post",
      data: { s: gst },
      dataType: "json",
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $(".remindomainheaderlptpvsn").html("");
        $("body").addClass("storecustmrpgbdy");
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer")
          .html(data.body)
          .addClass("rmdchldbxstrecustmruidvbx");
        window.history.pushState(
          {},
          {},
          "http://localhost/remindo/stores/store?s=" + gst
        );
      },
    });
  });
  function gtstr() {
    document.querySelectorAll(".gtstrpgclstrngtr").forEach((gst) => {
      $(gst).click((e) => {
        e.preventDefault();
        $.ajax({
          url: "http://localhost/remindo/stores/store",
          method: "post",
          data: { s: $(gst).attr("data-pt") },
          dataType: "json",
          beforeSend: () => {
            $("div.pageloader").show();
            preloaderon();
          },
          success: (data) => {
            $("div.pageloader").hide();
            $(".remindomainheaderlptpvsn").html("");
            $("body").addClass("storecustmrpgbdy");
            $(document).attr("title", data.title);
            $("div.remindochildboxycontainer")
              .html(data.body)
              .addClass("rmdchldbxstrecustmruidvbx");
            window.history.pushState(
              {},
              {},
              "http://localhost/remindo/stores/store?s=" +
                $(gst).attr("data-unm")
            );
          },
        });
      });
    });
  }
  function ysnofun() {
    document.querySelectorAll(".pmtsnovfybtn").forEach((dlbn) => {
      $(dlbn).click(() => {
        delysptfcn(
          dlbn,
          $(dlbn).attr("data-n"),
          $(dlbn).attr("data-s"),
          $(dlbn).attr("data-r")
        );
      });
    });
    document.querySelectorAll(".pmtsystrevfybtns").forEach((dlbn) => {
      $(dlbn).click(() => {
        uspmtrvd(
          dlbn,
          $(dlbn).attr("data-n"),
          $(dlbn).attr("data-r"),
          $(dlbn).attr("data-s")
        );
        $(dlbn).parent().parent().parent().slideUp(200);
        setTimeout(() => {
          $(dlbn).parent().parent().parent().remove();
        }, 200);
      });
    });
  }
  function uspmtrvd(g, $n, $sid, $cid) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/srcritrxnnts.php",
      method: "post",
      data: {
        nfupd1: "ysnfup1tre",
        n: $n,
        s: $sid,
        c: $cid,
        tp: "fhmpg",
      },
    });
  }
  function delysptfcn(g, n, s, r) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/srcritrxnnts.php",
      method: "post",
      data: { dlysn: "ystrdlnysnotfcn", n: n, s: s, r: r },
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        if (data == 1) {
          $(g).parent().parent().parent().slideUp(200);
          setTimeout(() => {
            $(g).parent().parent().parent().remove();
          }, 200);
        }
      },
    });
  }
});
$(".istlhdppupdvbx").click(() => {
  $(".istlapprmptppupdvbx").remove();
});
if (checkCookie("_hpa_") !== "isladpwa" && checkCookie("_hpa_") !== "") {
  setTimeout(() => {
    $(".istlapprmptppupdvbx").slideDown(800);
    $(".istlapprmptppupdvbx").show();
  }, 3000);
}
function checkCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
