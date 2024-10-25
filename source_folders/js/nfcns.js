$(document).ready((e) => {
  var os = 0;
  var lt = 9;
  var stltr = true;
  $(document).on("touchmove", (e) => {
    scrlfun(e);
  });
  $(window).scroll((e) => {
    scrlfun(e);
  });
  ftchalntfcns(e, true, os, lt);
  function scrlfun(e) {
    if (
      $(window).scrollTop() + $(window).height() + 10 >
      $(".remindochildboxycontainer").height()
    ) {
      if (stltr) {
        os += lt;
        ftchalntfcns(e, false, os, lt);
      }
    }
  }
  function ftchalntfcns(e, isf, os, lt) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/odrvtrngs.php",
      method: "post",
      data: { alnfcns: "alnfcstredsply", os: os, lt: lt },
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $("div.pageloader").hide();
        if (data == "" || data == 0) {
          stltr = false;
          if (isf) {
            $(".ntfcnsshwmroptnsbtn").hide();
            $(".rmdalntfcns-dsply-dvbx").html(
              "<center style='margin:92px 0;'><i class='fas fa-bell-slash remindosymbols' style='font-size:100px;color:gray;'></i><h3 style='color:gray;'>You have no new updates.</h3></center>"
            );
          }
        } else {
          if (isf) {
            $(".rmdalntfcns-dsply-dvbx").html(data);
          } else {
            $(".rmdalntfcns-dsply-dvbx").append(data);
          }
          slctnfcs();
        }
      },
    });
    return false;
  }
  var slctd = [];
  var doslt = false;
  $(".ntfcnsshwmroptnsbtn").click(() => {
    doslt = true;
    $(".rmdusr-ntfcns-drucooptns-ddvbx").slideDown(200);
  });
  $(".mroptns-clsebtn").click(() => {
    slctd = [];
    doslt = false;
    $(".ttlntfcnsslctd").text(slctd.length);
    $(".rmdusr-orgnl-ntfcndvbx").css("background", "white");
    $(".rmdusr-ntfcns-drucooptns-ddvbx").slideUp(200);
  });
  function slctnfcs() {
    $(".rmdusr-orgnl-ntfcndvbx").unbind();
    document.querySelectorAll(".rmdusr-orgnl-ntfcndvbx").forEach((sel) => {
      $(sel)
        .children(".nfatgtonvgt")
        .children(".ntfcn-dtlsandotropns-cntngdvbx")
        .children(".ntfcn-cntnt-txtcntdvbx")
        .children(".ntfcns-ftr-othdls")
        .children(".ntfcn-insrttp")
        .click((e) => {
          e.preventDefault();
          if ($(e.target).hasClass("jininvtnbtn")) {
            acptivtn($(e.target), $(e.target).attr("data-s"), "a");
          } else if ($(e.target).hasClass("ignrinvtnbtn")) {
            acptivtn($(e.target), $(e.target).attr("data-s"), "i");
          }
          return false;
        });
      $(sel).click((e) => {
        e.preventDefault();
        if (doslt) {
          var uqd = $(sel)
            .children()
            .children()
            .children(".ntfcn-cntnt-txtcntdvbx")
            .attr("data-n");
          if (!slctd.includes(uqd)) {
            $(sel).css("background", "#dcf1f9");
            slctd.push(uqd);
          } else {
            slctd.splice(slctd.indexOf(uqd), 1);
            $(sel).css("background", "white");
          }
          $(".ttlntfcnsslctd").text(slctd.length);
        } else {
          if (
            $(sel)
              .children()
              .children()
              .children(".ntfcn-cntnt-txtcntdvbx")
              .attr("data-opd") == 0
          ) {
            var uqd = $(sel)
              .children()
              .children()
              .children(".ntfcn-cntnt-txtcntdvbx")
              .attr("data-n");
            if (!slctd.includes(uqd)) {
              slctd.push(uqd);
            }
            dlslctdnfcns(e, slctd.toString(), "upt");
          }
          htlnk(e, $(sel).children(".nfatgtonvgt").attr("href"));
        }
      });
      presshold(sel, () => {
        if (!doslt) {
          var uqd = $(sel)
            .children()
            .children()
            .children(".ntfcn-cntnt-txtcntdvbx")
            .attr("data-n");
          doslt = true;
          if (!slctd.includes(uqd)) {
            $(sel).css("background", "#dcf1f9");
            $(".rmdusr-ntfcns-drucooptns-ddvbx").slideDown(200);
            slctd.push(uqd);
            $(".ttlntfcnsslctd").text(slctd.length);
          }
        } else {
          return false;
        }
      });
    });
  }
  $(".mroptns-delntfs").click((e) => {
    dlslctdnfcns(e, slctd.toString(), "dlt");
  });
  $(".mroptns-mrkrd").click((e) => {
    dlslctdnfcns(e, slctd.toString(), "upt");
  });
  function dlslctdnfcns(e, $nds, $tp) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/srcritrxnnts.php",
      method: "post",
      data: { crdnfcs: "slnfcscrd", nd: $nds, uod: $tp },
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        if ($tp == "dlt") {
          showsnackpopup("Deleted Successfully!", true, true);
          slctd.forEach((sel) => {
            $(`.ntfcn-cntnt-txtcntdvbx[data-n='${sel}']`)
              .closest(".rmdusr-orgnl-ntfcndvbx")
              .slideUp(200);
            setTimeout(() => {
              $(`.ntfcn-cntnt-txtcntdvbx[data-n='${sel}']`)
                .closest(".rmdusr-orgnl-ntfcndvbx")
                .remove();
            }, 200);
          });
        } else if ($tp == "upt") {
          slctd.forEach((sel) => {
            $(`.ntfcn-cntnt-txtcntdvbx[data-n='${sel}']`)
              .siblings(".ntfcn-snsts-dvbx")
              .children(".fa-circle")
              .remove();
          });
        }
        slctd = [];
        doslt = false;
        $(".ttlntfcnsslctd").text(slctd.length);
        $(".rmdusr-orgnl-ntfcndvbx").css("background", "white");
        $(".rmdusr-ntfcns-drucooptns-ddvbx").slideUp(200);
      },
    });
    e.stopImmediatePropagation();
    return false;
  }
});
function acptivtn(b, s, aou) {
  $.ajax({
    url: "http://localhost/remindo/stsupsflr/strcmspns",
    method: "post",
    data:
      aou == "a"
        ? { acptstrtmbr: "treysacpt", s: s }
        : { igrstrtmbr: "treysigr", s: s },
    beforeSend: () => {
      if (aou == "a") {
        $(b).text("Joining...");
      } else {
        $(b).text("Ignoring...");
      }
    },
    success: (data) => {
      if (data == 1) {
        if (aou == "a") {
          $(b).text("Joined!").siblings(".ignrinvtnbtn").hide();
        } else {
          $(b).text("Ignored!").siblings(".jininvtnbtn").hide();
        }
        $(b)
          .closest(`.ntfcn-dtlsandotropns-cntngdvbx`)
          .children(".ntfcn-snsts-dvbx")
          .children(".fa-circle")
          .remove();
      } else if (data == 0) {
        showsnackpopup(
          "Sorry! Failed to join. Please try again later.",
          true,
          "non"
        );
      }
    },
    error: () => {
      $(b).text("Join");
      showsnackpopup(
        "Something went wrong! Please try again later.",
        true,
        "non"
      );
    },
  });
}
function htlnk(e, lnk) {
  $.ajax({
    url: `${lnk}`,
    method: "post",
    data: { ppsttevt: "frdppstt" },
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
      window.history.pushState({}, {}, lnk);
    },
  });
  e.stopImmediatePropagation();
  return false;
}
function presshold(elm, phfun) {
  var holdStarter = null;
  $(elm).mousedown(onMouseDown);
  function onMouseDown() {
    holdStarter = setTimeout(phfun, 3000);
  }
  $(elm).on("touchstart", onMouseDown).on("touchend", onMouseUp);
  $(elm).mouseup(onMouseUp);
  function onMouseUp() {
    if (holdStarter) {
      clearTimeout(holdStarter);
    }
  }
  $(elm).mouseout(function () {
    onMouseUp();
  });
}
