var nosrpns = false;
var dvrstrall = false;
$(document).ready(function () {
  if ($("body").attr("class") == "storecustmrpgbdy") {
    $("body").removeClass("storecustmrpgbdy");
  }
  $(".stupastreinstrspgbtndvbx").click(() => {
    $(".spedsppupdvbx").show();
  });
  var os = 0;
  var lt = 5;
  var ps = true;
  pndppldsply(true, 0, 5);
  $("div.rmddiscovdivbox").click(() => {
    // $(".rmdohmpgitrctivdvbx,.str_grw_bsn_dvbx").hide();
    $(".rmdo_shw_pd_ppl").hide();
    $(".rmdo_shw_ppl_to_pn").show();
    $(".discoverusericon").css("color", "#575775").css("font-weight", "900");
    $(".rdusrpnpllicon").css("color", "").css("font-weight", "300");
    if (!$(".rmdo_shw_ppl_to_pn,.rmostrsgnsdvbx").length || !dvrstrall) {
      strsgnsfn(true, 0, 5);
      ps = false;
    }
  });
  $("div.rmdpinppledivbox").click(() => {
    $(".rmdo_shw_ppl_to_pn").hide();
    $(".rmdo_shw_pd_ppl").show();
    $(".discoverusericon").css("color", "").css("font-weight", "300");
    $(".rdusrpnpllicon").css("color", "#575775").css("font-weight", "900");
    if (!$(".rmdo_shw_pd_ppl .rmostrsgnsdvbx").length || !nosrpns) {
      pndppldsply(true, 0, 5);
      ps = true;
    }
  });

  $(document).on("touchmove", scrlfun);
  $(window).scroll(scrlfun);
  function scrlfun() {
    if (
      $(window).scrollTop() + $(window).height() + 10 >
      $(".remindochildboxycontainer").height()
    ) {
      os += lt;
      if (!ps) {
        if (!dvrstrall) strsgnsfn(false, os, lt);
      } else {
        if (!nosrpns) pndppldsply(false, os, lt);
      }
    }
  }
});
var nopsrs = `<div class='rmdohmpgitrctivdvbx'>
    <div class='itrctiv_pg_bdy'>
    <div class='str_grw_bsn_dvbx'>
    <div class='rmoditrctivdvbximgctng' style='margin:20px;'>
        <img src='includes/fn_img/pin_str_illu_typ.jpg' style='
        width: 286px;
        box-shadow: 0 0 41px -21px #585151;' class='itrrctiv_illstn'>
    </div>
    <div class='rmoditrctivdvbxtxtctng' style='color:gray;'>You haven't pinned a store yet! Click on <i class='fas fa-store storBtnSgnIcn'></i> <strong>Discover</strong> button to find and pin stores near you!</div>
    </div>
    </div>
</div>`;
var nosrstodsvr = `<div class='rmdohmpgitrctivdvbx'>
    <div class='itrctiv_pg_bdy'>
    <div class='str_grw_bsn_dvbx'>
    <div class='rmoditrctivdvbximgctng' style='margin:20px;'>
        <i class='fas fa-store' style='font-size: 80px;color: gray;'></i>
        <i class='fas fa-slash' style='font-size: 80px;color: gray;transform: rotate( 272deg);margin-top: -4px;margin-left: -110px;'></i>
    </div>
    <div class='rmoditrctivdvbxtxtctng' style='color:gray;'><span>No businesses found near you! ${
      $(".stupastreinstrspgbtndvbx").length
        ? "If you have a business, you can <strong>Set up and grow your business</strong> on Remindo!</span><br><span>Click on <strong>Set up A Business</strong> to Setup your's!</span>"
        : "Suggest someone you know who has a business like grocery/general store or supermart to have their business on Remindo!"
    }</div>
    </div>
    </div>
</div>`;
function pndppldsply($f, os, lt) {
  $.ajax({
    url: "stsupsflr/strcmspns",
    method: "post",
    data: { strpnds: "trepnssrs", os: os, lt: lt },
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $("div.pageloader").hide();
      $(".discoverusericon").css("color", "").css("font-weight", "300");
      $(".rdusrpnpllicon").css("color", "#575775").css("font-weight", "900");
      if (data == 0) {
        if ($f) {
          $(".rmdo_shw_pd_ppl").html(nopsrs);
        }
        nosrpns = true;
      } else if (data == "q0") {
        $(".rmdo_shw_pd_ppl").html(
          "<center><h5 style='color:gray;'>Failed to fetch businesses. Try again later</h5></center>"
        );
      } else {
        if ($f) {
          $(".rmdo_shw_pd_ppl").html(data);
        } else {
          $(".rmdo_shw_pd_ppl").append(data);
        }
        gtstr();
      }
    },
  });
}
function strsgnsfn($f, os, lt) {
  $.ajax({
    url: "stsupsflr/strcmspns",
    method: "post",
    data: { strsgns: "tresgnssrs", os: os, lt: lt },
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $("div.pageloader").hide();
      if (data == 0) {
        if ($f) {
          $(".rmdo_shw_ppl_to_pn").html(nosrstodsvr);
        }
        dvrstrall = true;
      } else if ($(data).text() == "") {
        if ($f) {
          $(".rmdo_shw_ppl_to_pn").html(nosrstodsvr);
        }
      } else if (data == "q0") {
        $(".rmdo_shw_ppl_to_pn").html(
          "<center><h5 style='color:gray;'>Failed to fetch businesses. Try again later</h5></center>"
        );
      } else {
        if ($f) {
          $(".rmdo_shw_ppl_to_pn").html(data);
        } else {
          $(".rmdo_shw_ppl_to_pn").append(data);
        }
        gtstr();
      }
      curpos();
    },
  });
}
function gtstr() {
  document.querySelectorAll(".gtstrpgclstrngtr").forEach((gst) => {
    $(gst).click((e) => {
      $.ajax({
        url: "http://localhost/remindo/stores/store",
        method: "post",
        data: { s: $(gst).attr("data-u") },
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
            "http://localhost/remindo/stores/store?s=" + $(gst).attr("data-u")
          );
        },
        complete: (data) => {
          data = data.responseText;
          $("div.pageloader").hide();
          $(".remindomainheaderlptpvsn").html("");
          $("body").addClass("storecustmrpgbdy");
          $(document).attr("title", $(gst).attr("data-u") + " | Remindo");
          $("div.remindochildboxycontainer")
            .html(data)
            .addClass("rmdchldbxstrecustmruidvbx");
          window.history.pushState(
            {},
            {},
            "http://localhost/remindo/stores/store?s=" + $(gst).attr("data-u")
          );
        },
        error: () => {
          showsnackpopup(
            "Something went wrong to open this store! Try opening other store."
          );
        },
      });
      e.stopImmediatePropagation();
      return false;
    });
  });
}
function gtstre(str) {
  return false;
}
function curpos() {
  document
    .querySelectorAll(".strprfnmcntngdvbx,.strprfpcctngdvbx")
    .forEach((tps) => {
      var pw =
        // $(tps).parent().parent().siblings(".rmracontprewvttlsetctngdvbx") ||
        $(tps).parent().siblings(".rmracontprewvttlsetctngdvbx");
      var ad = "";
      $(tps).hover(
        () => {
          $(".rmracontprewvttlsetctngdvbx").hide();
          pw.fadeIn(500);
        },
        () => {
          ad = setTimeout(() => {
            pw.hide();
          }, 500);
        }
      );
      $(pw).hover(
        () => {
          clearTimeout(ad);
          pw.show();
        },
        () => {
          pw.fadeOut(500);
        }
      );
    });

  document.querySelectorAll(".strathmbnldtlscntngdvbx").forEach((gtpns) => {
    gtpns.querySelectorAll(".pnstrbtndvbx").forEach((pn) => {
      $(pn).click((e) => {
        $.ajax({
          url: "http://localhost/remindo/stsupsflr/strdtlsupdt",
          method: "post",
          data: {
            pnsr: "trepnstr",
            sd: $(pn).attr("data-p"),
          },
          beforeSend: function () {
            $("div.pageloader").show();
            preloaderon();
          },
          success: function (data) {
            $("div.pageloader").hide();
            if (data == 1) {
              $(pn).remove();
              $(pn).parent(".strpnunpnspnbtndvbx").html("");
              $(gtpns).find(".pnstrbtndvbx").remove();
              nosrpns = false;
              dvrstrall = false;
              showsnackpopup(
                `<i class='fas fa-thumbtack remindosymbols' style='color:white;transform:rotate(45deg);'></i>You have pinned the ${$(
                  pn
                ).attr("data-c")}`,
                true,
                true
              );
            } else {
              showsnackpopup(
                `<i class='fas fa-thumbtack remindosymbols' style='color:white;transform:rotate(45deg);'></i>Failed to pinned the ${$(
                  pn
                ).attr("data-c")}. Try again later`,
                true,
                false
              );
            }
          },
        });
        e.stopImmediatePropagation();
        return false;
      });
    });
  });
}
