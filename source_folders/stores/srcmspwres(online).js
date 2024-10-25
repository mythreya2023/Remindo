$(document).ready(() => {
  if (window.innerWidth > 420) {
    if ($(".remindomainheaderlptpvsn").html("")) {
      $.ajax({
        url: "https://remindo.in/header",
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
    }
  } else {
    $.ajax({
      url: "https://remindo.in/header",
      method: "get",
      data: { olscrpts: "trescrpts" },
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $(".dvsrpts").html(data);
      },
    });
  }
  if (window.innerWidth < 600) {
    $(".stronrpgtphdr").width($(window).width());
  }
  $(".bcktopndstrspgbtndvbx").click((e) => {
    $.ajax({
      url: "https://remindo.in/stores",
      method: "get",
      data: { sstrsnm: "treshw" },
      dataType: "json",
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $("body").addClass("storeedtspgbdy").removeClass("storecustmrpgbdy");
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer")
          .html(data.body)
          .addClass("rmdchldbxstrecustmruidvbx");
        window.history.pushState({}, {}, "https://remindo.in/stores");
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
});
var $nwlst = false;
crtnwordr();
function crtnwordr() {
  if (!$(document).find(".sdordrtostrbtn").length) {
    $(".stnwodrtostrbtn").css("opacity", "1");
    $(".stnwodrtostrbtn,.lbx-adto-lst-btn,.ctrnwlstbnivsbl").click(() => {
      $nwlst = true;
      if (!$(document).find(".sdordrtostrbtn").length) {
        $(".stnwodrtostrbtn").css("opacity", "1");
        var tt = new Date();
        var pt =
          tt.getDate() +
          " " +
          tt.toLocaleString("default", { month: "short" }) +
          " at " +
          formatAMPM(tt);
        $(".strpgmdbdyofodrlstscntnrdvbx").prepend(
          `<div class='odrdlsttostrcntnrdvbx'><article class='ordrdlstartletgcntnrdvbox'><div class='relordlstdvbx'><div class='ordrlsthdrcntnrdvbx'><div class='odrdtmeothoptnstphdrcntnrdvbx'><div class='odrddtmecntnrdvbx'><strong>Orderd On :</strong><span class='odrplcdtmstmpspntg'>${pt}</span></div><div class='mroptstothsodrcntnrdvbx'><div class='mroptsdvbxbtn' role='button'><i class='fas fa-ellipsis-h'></i></div></div></div><div class='noitmsinlstbtmhrctnrdvbx'><span class='tnmofitmsinthelstcntnrspntg'>0</span><span> Items</span></div></div><div class='ordrlstbdycntnrdvbx'><div class='lstditmsinodrlstcntnrdvbx nwryllstofnwodr'></div><div class='odrsadngnwitmtolscntngdvbx'><div class='nwitmsiptandiptsgnscntnrdvbx' style='display: none;'><div class='itmsiptdvbxctnr'><div class='iptbxctnrhdebtn' role='button'><i class='fas fa-arrow-left remindosymbols'></i></div><div class='iptbxcntngbox'><input type='text' class='srchiptfritmstoadtolst' placeholder='Search Item'></div><div class='clraltxtiniptbtn' role='button'><i class='fas fa-times remindosymbols'></i></div></div><div class='nwlstitmssgnscntnrdvbx'></div></div><div class='adnwitmbtn' role='button' style='><i class='fas fa-plus remindosymbols'></i>New Item</div></div><div class='ttlamtofalllsttopycntnrdvbx' style='display: none;'><div class='ttlamtttlecntnrdvbx'><strong>Total Ammount :</strong></div><div class='amtcnrcycntnrdvbx'><span class='ttlamntwthcrncyspntg'>0</span><span class='crcysmblspntg'>₹</span></div></div></div><div class='ordrlstftrcntnrdvbox' style='display: none;'><div class='sdordrtostrbtn' id='strodrnsdtosrbn'>Order</div></div></div></article></div>`
        );
        $(".srchiptfritmstoadtolst").val("");
        $(".strpgftrtoshwppupsdvbx").slideUp(200);
        $(".nwitmsiptandiptsgnscntnrdvbx").hide();
        $(".adnwitmbtn").show();
        otherjs();
        $(".stnwodrtostrbtn").css("opacity", "0.6");
      } else {
        $(".stnwodrtostrbtn").css("opacity", "0.6");
      }
    });
  } else {
    $(".stnwodrtostrbtn").css("opacity", "0.6");
  }
}
var s = $("#ithnthssmrcls").val();
function otherjs() {
  document.querySelectorAll(".ordrdlstartletgcntnrdvbox").forEach((odr) => {
    odr.querySelectorAll(".srchiptfritmstoadtolst").forEach((pdts) => {
      $(pdts).keyup(() => {
        $.ajax({
          url: "../stsupsflr/rtvpds",
          method: "post",
          data: { shpdts: "spdstretre", qp: $(pdts).val(), s: s },
          beforeSend: () => {
            $("div.pageloader").show();
            preloaderon();
          },
          success: (data) => {
            $("div.pageloader").hide();
            if (data == 0) {
              $(pdts)
                .parent()
                .parent()
                .siblings(".nwlstitmssgnscntnrdvbx")
                .html(
                  "<center><p style='color:gray;'>No such product found.</p></center>"
                );
            } else {
              $(pdts)
                .parent()
                .parent()
                .siblings(".nwlstitmssgnscntnrdvbx")
                .html(data);
              adpdttolstodr(pdts);
            }
          },
        });
      });
    });
  });
  document.querySelectorAll(".itmsiptdvbxctnr").forEach((btns) => {
    $(btns)
      .parent()
      .siblings(".adnwitmbtn")
      .click(function () {
        $(btns).parent(".nwitmsiptandiptsgnscntnrdvbx").show();
        $(btns)
          .children(".iptbxcntngbox")
          .children(".srchiptfritmstoadtolst")
          .focus();
        $(btns).parent().siblings(".adnwitmbtn").hide();
      });
    $(btns)
      .children(".clraltxtiniptbtn")
      .click(function () {
        $(btns)
          .children(".iptbxcntngbox")
          .children(".srchiptfritmstoadtolst")
          .val("")
          .focus();
      });
    $(btns)
      .children(".iptbxctnrhdebtn")
      .click(function () {
        $(btns)
          .children(".iptbxcntngbox")
          .children(".srchiptfritmstoadtolst")
          .val("");
        $(btns).parent(".nwitmsiptandiptsgnscntnrdvbx").hide();
        $(btns).parent().siblings(".adnwitmbtn").show();
        $(btns).siblings(".nwlstitmssgnscntnrdvbx").html("");
      });
  });
  rmvdelbnsfuncg();
  plcngodr();
}
$(document).ready(() => {
  $(".shwalpdtsinstrbtn").click((e) => {
    $(".stralpdtsdsplydvbxctnrdvbx").show();
    $(".strpgmdbdyofodrlstscntnrdvbx").hide();
  });
  $(".stnwodrtostrbtn,.lbxdspd-shwmy-odr-btn").click(() => {
    $(".strpgmdbdyofodrlstscntnrdvbx").show();
    $(".stralpdtsdsplydvbxctnrdvbx").hide();
    $(".cmn-lbx-bckgrond-cntngdvbx,.cmn-lbx-pdt-dsplyr-cntngdvbx").hide();
  });
  $(".lbx-dply-pdtpic-mainig").click(() => {
    var ttligs = document.querySelectorAll(".lbxftr-pdtaded-pc").length;
    var ttl = document.querySelector(".lstditmsinodrlstcntnrdvbx");
    ttl = ttl.querySelectorAll(".odrditmartclcntnrdvbx").length;
    if (ttl == "" || ttl == undefined || ttl == 0) {
      $(".lbx-ftrdsply-shld-ctngbx").hide();
    }
  });

  var hspn = true,
    cktopn = false;
  if ($(".pinstrtbtn").length) {
    hspn = false;
    if (!hspn) {
      $(".pinstrtbtn").click(() => {
        if (!hspn && !cktopn) {
          psr();
        }
        cktopn = true;
      });
    }
  }

  $(".lbx-adto-lst-btn").click((e) => {
    if ($(".strpgmdbdyofodrlstscntnrdvbx").length) {
      var dpc = $(".lbx-sld-shw-imgprevw-img").attr("src");
      var dpnm = $(".lbx-pdt-nmdsplydvbx").text();
      var prc = $(".lbx-pdtprce-dsply").text();
      var qnty = $(".rdo-sze-slct").val();
      var qty = $(".lbx-nedqty-bx").val();
      var stksts = $(".lbx-pdsts-updtyp-stks").text();
      var pdck = $(".lbx-dsplyr-tphdr-ctngdvbx").attr("data-adpd");
      var relpd = $(".lbx-dsplyr-tphdr-ctngdvbx").attr("data-pd");
      $(`.lbx-shtpdtigdsplycntng-dvbx[data-adpdck='${pdck}']`)
        .siblings(".lbx-dsply-shtdls-pdtpcandadbtn")
        .children(".lbx-dsply-adbtn")
        .html(
          "<i class='fas fa-check remindosymbols' style='color: white;font-size: 9px;padding: 0;margin-right: 3px;'></i>Added"
        );

      $(e.target).closest(".lbx-adto-lst-btn").html("Remove");
      apndpdtlst(e, "inlbx", pdck, dpnm, dpc, qnty, stksts, qty, relpd, prc);
    } else {
      showsnackpopup(
        "Pin the shop to add the product!",
        false,
        "non",
        true,
        "Cancle/Pin",
        () => {
          if (!hspn && !cktopn) {
            psr();
          }
        }
      );
    }
  });
});
function pwrngpdtbns() {
  $(".lbx-dsply-shdls-ptpc-dvbx,.lbx-dsply-rltdpdsnm").click((e) => {
    $(e.target)
      .closest(".lbx-dsply-pdts-nd-dtls-cntngdvbx")
      .children(".prdtditmnmcntnrdvbx")
      .click();
  });
  $(".lbx-dsply-shtdls-pdtpcandadbtn .lbx-dsply-adbtn").click((e) => {
    $(".ctrnwlstbnivsbl").click();
    if ($(".strpgmdbdyofodrlstscntnrdvbx").length) {
      var pdt = $(e.target)
        .closest(".lbx-dsply-adbtn")
        .parent()
        .siblings(".prdtditmnmcntnrdvbx");
      var dpc = $(e.target)
        .closest(".lbx-dsply-adbtn")
        .parent(".lbx-dsply-shtdls-pdtpcandadbtn")
        .siblings(".lbx-shtpdtigdsplycntng-dvbx")
        .children(".lbx-dply-pdtpic-mainig")
        .attr("src");
      var dpnm = $(pdt).attr("data-tle");
      var prc = $(e.target)
        .closest(".lbx-dsply-adbtn")
        .siblings(".lbx-dsply-shdls-ptpc-dvbx")
        .children(".pdtrlpcspntg")
        .text();
      var qnty = $(e.target)
        .closest(".lbx-dsply-adbtn")
        .parent()
        .siblings(".lbx-dsply-shtdls-pdtpcandadbtn")
        .children(".lbx-dsply-shdls-ptpc-dvbx")
        .children(".pdtrlsbqtyspntg")
        .text();
      var qty = 1;
      var stksts = $(pdt).attr("data-istk");
      var pdck = $(pdt).attr("data-adpdck");
      var relpd = $(pdt).attr("data-pid");
      $(`.lbx-shtpdtigdsplycntng-dvbx[data-adpdck='${pdck}']`)
        .siblings(".lbx-dsply-shtdls-pdtpcandadbtn")
        .children(".lbx-dsply-adbtn")
        .html(
          "<i class='fas fa-check remindosymbols' style='color: white;font-size: 9px;padding: 0;margin-right: 3px;'></i>Added"
        );
      apndpdtlst(e, "inshtdp", pdck, dpnm, dpc, qnty, stksts, qty, relpd, prc);
    } else {
      showsnackpopup(
        "Pin the shop to add the product!",
        false,
        "non",
        true,
        "Cancle/Pin",
        () => {
          if (!hspn && !cktopn) {
            psr();
          }
        }
      );
    }
  });
  document.querySelectorAll(".lbx-shtpdtigdsplycntng-dvbx").forEach((itm) => {
    var pdck = $(itm).attr("data-adpdck");
    if ($(`.nwryllstofnwodr [data-pd="${pdck}"]`).length) {
      $(itm)
        .siblings(".lbx-dsply-shtdls-pdtpcandadbtn")
        .children(".lbx-dsply-adbtn")
        .html(
          "<i class='fas fa-check remindosymbols' style='color: white;font-size: 9px;padding: 0;margin-right: 3px;'></i>Added"
        );
    }
  });
}
function psr() {
  $.ajax({
    url: "https://remindo.in/stsupsflr/strdtlsupdt",
    method: "post",
    data: {
      pnsr: "trepnstr",
      sd: $("#ithnthssmrcls").val(),
    },
    beforeSend: function () {
      $("div.pageloader").show();
      $(".stackbtnyes").text("Pinning...");
      preloaderon();
    },
    success: function (data) {
      $("div.pageloader").hide();
      if (data == 1) {
        hspn = true;
        $(".stackbtnyes").text("Pinned!");
        showsnackpopup(
          "<i class='fas fa-thumbtack remindosymbols' style='color:white;transform:rotate(45deg);'></i>You have pinned the store",
          true,
          true
        );
        var sunm = new URL(window.location.href).searchParams.get("s");
        var s = $("#ithnthssmrcls").val();
        $.ajax({
          url: "store",
          method: "post",
          data: { s: s },
          dataType: "json",
          beforeSend: () => {
            $("div.pageloader").show();
            preloaderon();
          },
          success: (data) => {
            $("div.pageloader").hide();
            $("body").addClass("storecustmrpgbdy");
            $(document).attr("title", data.title);
            $("div.remindochildboxycontainer").html(data.body);
            window.history.pushState(
              {},
              {},
              "https://remindo.in/stores/store?s=" + sunm
            );
          },
        });
      } else {
        hspn = false;
        showsnackpopup(
          "<i class='fas fa-thumbtack remindosymbols' style='color:white;transform:rotate(45deg);'></i>Failed to pinned the store. Try again later",
          true,
          false
        );
      }
    },
  });
  return false;
}
function apndpdtlst(e, whrbtn, pdck, dpnm, dpc, qnty, stksts, qty, relpd, prc) {
  if ($(`.nwryllstofnwodr [data-pd="${pdck}"]`).length) {
    if (whrbtn == "inlbx") {
      $(`.lbx-shtpdtigdsplycntng-dvbx[data-adpdck='${pdck}']`)
        .siblings(".lbx-dsply-shtdls-pdtpcandadbtn")
        .children(".lbx-dsply-adbtn")
        .html("Add");
      $(e.target).closest(".lbx-adto-lst-btn").html("Add");
    } else if (whrbtn == "inshtdp") {
      $(e.target).closest(".lbx-dsply-adbtn").html("Add");
    }
    $(document.querySelector(".nwryllstofnwodr"))
      .children(`.odrditmartclcntnrdvbx[data-pd='${pdck}']`)
      .remove();
    $(
      document.querySelector(`.lbxftr-pdtaded-pc[data-pdck='${pdck}']`)
    ).remove();
    chckifpdsinodr();
    aladonsofths();
    return;
  }
  var ttligs = document.querySelectorAll(".lbxftr-pdtaded-pc").length;
  var ttl = document.querySelector(".lstditmsinodrlstcntnrdvbx");
  ttl = ttl.querySelectorAll(".odrditmartclcntnrdvbx").length + 1;
  if (ttligs < 5) {
    $(".lbxftr-thsshws-ttlims-inlst").hide();
    $(".lbxftr-thshws-pdtigs-dsplrbx").append(
      `<img src="${dpc}" class="lbxftr-pdtaded-pc" data-pdck=${pdck}>`
    );
  } else {
    $(".lbxftr-thsshws-ttlims-inlst")
      .text(`..+${ttl - ttligs} More`)
      .show();
  }
  $(document.querySelector(".nwryllstofnwodr")).append(
    `<div class='odrditmartclcntnrdvbx' data-pd='${pdck}' data-tq='1'><div class='ordditmimgcntngdvbx'><img class='strcntngitmimg' src='${dpc}'></div><div class='strcntngordritmdtlscntngdvbx'><div class='onetxtelpss cmrsdsrditmnmcntnrdvbx'>${dpnm}</div><div class='cmrdsrditmothdtlscntngdvbx'><div class='cmrdsrditmqntycntnrdvbx'>.${qnty}</div><div class='cmrdsrditmpstkstscntnrdvbx'>.<span class='istksptg'>${stksts}</span></div><div class='cmrdsrditmpcdorlscntnrdvbx'>.Packed</div></div></div><div class='odrngitmsqntyandprccntngdvbx'><div class='odrditmqntyicordcandiptctnrdvbx'><div class='icodrditmqtydvbtn' role='button'><i class='fas fa-plus remindosymbols'></i></div><span class='odrditmqtydsplyiptcntngdvbbx'><input type='number' class='odrditmnumquntyiptbx' value='${qty}'></span><div class='decodrditmqtydvbtn' role='button'><i class='fas fa-minus remindosymbols'></i></div></div><div class='odritmsprcandqtyctngdvbx'><div class='stronrpgitmsqntyctnrdvbx'><span class='qntyhdngofitmspntgasbx'><strong>Qty:</strong></span><span class='qntinnmofthsitmbxnspng'>${qty}</span></div><div class='ordrditmsprceandcrncycntnrdvbx'><div class='ordrditmprccntnrdvbx odritmcstdtatcnttl' data-qny='${qnty}' data-pd='${relpd}' data-cst='${prc}'>${
      prc * qty
    }</div><div class='ordrditmcrncycntngdvbx'>₹</div></div></div></div></div>`
  );
  chckifpdsinodr();
  aladonsofths();

  function aladonsofths() {
    chckitms();
    $(".icodrditmqtydvbtn,.decodrditmqtydvbtn").unbind();
    pdtsincmspgmtrng();
    rmvdelbnsfuncg();
    ttlamt();
    ttitms();
  }
  function chckifpdsinodr() {
    if ($(".nwryllstofnwodr").children(".odrditmartclcntnrdvbx").length > 0) {
      $(".lbx-rltd-pdts-dsply-cntngbx").css(
        "margin-bottom",
        parseInt($(".lbx-ftrdsply-shld-ctngbx").css("height")) + 50 + "px"
      );
      $(".lbx-ftrdsply-shld-ctngbx").show();
    } else {
      $(".lbx-ftrdsply-shld-ctngbx").hide();
    }
  }
}
function adpdttolstodr(p) {
  document.querySelectorAll(".shprdtsinstrcstmrsspg").forEach((adpdt) => {
    $(adpdt).click((e) => {
      if (!$(adpdt).children(".pdtotofstkstsptg").length) {
        var itms = $(adpdt)
          .parent()
          .parent()
          .parent()
          .siblings(".lstditmsinodrlstcntnrdvbx");
        if (
          $(itms).children(
            `.odrditmartclcntnrdvbx[data-pd="${$(adpdt)
              .children(".odrditmartclcntnrdvbx")
              .attr("data-pd")}"]`
          ).length
        ) {
          showsnackpopup("You already added the item!", true, true);
          return;
        }
        $(
          `.lbx-shtpdtigdsplycntng-dvbx[data-adpdck='${$(adpdt)
            .children(".odrditmartclcntnrdvbx")
            .attr("data-pd")}']`
        )
          .siblings(".lbx-dsply-shtdls-pdtpcandadbtn")
          .children(".lbx-dsply-adbtn")
          .html(
            "<i class='fas fa-check remindosymbols' style='color: white;font-size: 9px;padding: 0;margin-right: 3px;'></i>Added"
          );
        var ttligs = document.querySelectorAll(".lbxftr-pdtaded-pc").length;
        var ttl = document.querySelector(".lstditmsinodrlstcntnrdvbx");
        ttl = ttl.querySelectorAll(".odrditmartclcntnrdvbx").length + 1;
        if (ttligs < 5) {
          $(".lbxftr-thsshws-ttlims-inlst").hide();
          $(".lbxftr-thshws-pdtigs-dsplrbx").append(
            `<img src="${$(adpdt)
              .children(".odrditmartclcntnrdvbx")
              .children(".ordditmimgcntngdvbx")
              .children(".strcntngitmimg")
              .attr("src")}" class="lbxftr-pdtaded-pc" data-pdck=${$(adpdt)
              .children(".odrditmartclcntnrdvbx")
              .attr("data-pd")}>`
          );
        } else {
          $(".lbxftr-thsshws-ttlims-inlst")
            .text(`..+${ttl - ttligs} More`)
            .show();
        }
        $(adpdt)
          .children(".odrditmartclcntnrdvbx")
          .children(".odrngitmsqntyandprccntngdvbx")
          .children(".odrditmqntyicordcandiptctnrdvbx")
          .removeClass("hdqtyincdcaditvldvbx");
        $(adpdt)
          .children(".odrditmartclcntnrdvbx")
          .children(".odrngitmsqntyandprccntngdvbx")
          .children(".odritmsprcandqtyctngdvbx")
          .children(".stronrpgitmsqntyctnrdvbx")
          .css({ display: "flex" });
        $(p)
          .parent()
          .parent()
          .parent()
          .parent()
          .siblings(".lstditmsinodrlstcntnrdvbx")
          .append($(adpdt).html());
        $(adpdt).html("");
        chckitms();
        $(".icodrditmqtydvbtn,.decodrditmqtydvbtn").unbind();
        pdtsincmspgmtrng();
        ttlamt();
        ttitms();
      } else {
        showsnackpopup("You cannot add item out of stock!", true, false);
      }
    });
  });
}
var vosts = [];
var $rvodrs = true;
function plcngodr() {
  var tgstosnd = [];
  var ormded = false;
  var isrtodr = (e, t) => {
    if (!ormded) {
      var sid = $("#ithnthssmrcls").val();
      $.ajax({
        url: "https://remindo.in/stsupsflr/srcritrxnnts",
        method: "post",
        data: {
          plcnwodr: "ystreplcngodr",
          sid: sid,
          tim: t[0],
          ocnt: t[1],
          odsts: t[2],
          pmsts: t[3],
        },
        beforeSend: () => {
          $("div.pageloader").show();
          preloaderon();
        },
        dataType: "JSON",
        success: (data) => {
          $("div.pageloader").hide();
          $(".vrfypmtsbtninppup").attr("data-vo", data.l);
          if (data.d == 1) {
            ormded = true;
            $nwlst = false;
            $(
              ".odrsadngnwitmtolscntngdvbx,.odrditmqntyicordcandiptctnrdvbx"
            ).remove();
            if (data.os == 1) {
              $(".strprsntopnorclsstsdvbx").html(
                '<div class="strstsdvbxopn">.Open</div>'
              );
            } else {
              $(".strprsntopnorclsstsdvbx").html(
                '<div class="strstsdvbxcls">.Close</div>'
              );
            }
            if (data.rs == 1) {
              $rvodrs = true;
              $(".lstditmsinodrlstcntnrdvbx").removeClass("nwryllstofnwodr");
              $(".strprsntrcvngordrsorntstsdvbx").html(
                '<div class="strstsdvbxrcvngords">.Receiving Orders</div>'
              );
              $(".streppupbx").show();
            } else {
              $rvodrs = false;
              $(".strprsntrcvngordrsorntstsdvbx").html(
                '<div class="strstsnonrcvngordsdvbx">.Not Available</div>'
              );
              showsnackpopup(
                "This store is not receving orders now! Please order again later.",
                true,
                "non"
              );
            }
          } else {
            ormded = false;
            showsnackpopup(
              "Sorry! some error occured. Try again later.",
              true,
              false
            );
          }
        },
      });
      e.stopImmediatePropagation();
      return false;
    }
  };
  document.querySelectorAll(".lstditmsinodrlstcntnrdvbx").forEach((sbn) => {
    var imscnt = [];
    $(sbn)
      .parent()
      .siblings(".ordrlstftrcntnrdvbox")
      .children(".sdordrtostrbtn")
      .click((snd) => {
        sbn.querySelectorAll(".odrditmartclcntnrdvbx").forEach((pds) => {
          var pprc = $(pds)
            .children(".odrngitmsqntyandprccntngdvbx")
            .children(".odritmsprcandqtyctngdvbx")
            .children(".ordrditmsprceandcrncycntnrdvbx")
            .children(".odritmcstdtatcnttl")
            .attr("data-cst");
          var qnty = $(pds)
            .children(".odrngitmsqntyandprccntngdvbx")
            .children(".odritmsprcandqtyctngdvbx")
            .children(".ordrditmsprceandcrncycntnrdvbx")
            .children(".odritmcstdtatcnttl")
            .attr("data-qny");
          var pid = $(pds)
            .children(".odrngitmsqntyandprccntngdvbx")
            .children(".odritmsprcandqtyctngdvbx")
            .children(".ordrditmsprceandcrncycntnrdvbx")
            .children(".odritmcstdtatcnttl")
            .attr("data-pd");
          var qty = $(pds)
            .children(".odrngitmsqntyandprccntngdvbx")
            .children(".odrditmqntyicordcandiptctnrdvbx")
            .children(".odrditmqtydsplyiptcntngdvbbx")
            .children(".odrditmnumquntyiptbx")
            .val();

          imscnt.push(`pid:${pid},qnty:${qnty},qty:${qty},pprc:${pprc}/`);
        });
        $("#ttlodritmplcdbycmr").text(
          $(sbn)
            .parent()
            .siblings(".ordrlstftrcntnrdvbox")
            .children(".sdordrtostrbtn")
            .parent()
            .siblings(".ordrlstbdycntnrdvbx")
            .children(".ttlamtofalllsttopycntnrdvbx")
            .children("#ttlamtinnmrssptg")
            .text()
        );
        var tmg = $(sbn)
          .parent()
          .siblings(".ordrlsthdrcntnrdvbx")
          .children(".odrdtmeothoptnstphdrcntnrdvbx")
          .children(".odrddtmecntnrdvbx")
          .children(".odrplcdtmstmpspntg")
          .text();
        var odrcnt = imscnt.toString();
        tgstosnd.push(tmg, odrcnt.slice(0, -1));
        tgstosnd.push(-1, "");
        var fsndclc = false;
        $("#strodrnsdtosrbn").click((e) => {
          if (!fsndclc && !ormded) {
            showsnackpopup(
              "Do you really want to place order?",
              false,
              "non",
              true,
              "No/Yes",
              () => {
                isrtodr(e, tgstosnd);
              }
            );
          } else {
            if ($rvodrs) {
              $(".streppupbx").show();
            } else {
              showsnackpopup(
                "This store is not receving orders now! Please order again later.",
                true,
                "non"
              );
            }
          }
        });
        $(sbn)
          .parent()
          .siblings(".ordrlstftrcntnrdvbox")
          .children(".sdordrtostrbtn")
          .click((e) => {
            if ($(".sdordrtostrbtn").attr("id") != "strodrnsdtosrbn") {
              if ($(".sdordrtostrbtn").attr("data-p") == "vfyptmsidtre") {
                $(".streppupbx").show();
              } else if ($rvodrs) {
                vfyodravblty(e);
              } else {
                showsnackpopup(
                  "This store is not receving orders now! Please order again later.",
                  true,
                  "non"
                );
              }
            }
          });
      });
  });
  var vs = -1,
    osnd = false;
  $(".usecasoptionbtn").click((e) => {
    if ($rvodrs) {
      vfpmupsts(e, 1, "CAS");
    } else {
      showsnackpopup(
        "This store is not receving orders now! Please order again later.",
        true,
        "non"
      );
    }
  });
  $(".vrfypmtsbtninppup").click((e) => {
    if (!$(".vrfypmtsbtninppup").attr("id")) {
      if ($rvodrs) {
        vfptsfun(e);
        $(".usecasoptionbtn").hide();
      } else {
        showsnackpopup(
          "This store is not receving orders now! Please order again later.",
          true,
          "non"
        );
      }
    }
  });
}
function vfyodravblty(e) {
  $.ajax({
    url: "https://remindo.in/stsupsflr/srcritrxnnts",
    method: "post",
    data: {
      strcvsts: "ystrvforcvgsts",
      s: $("#ithnthssmrcls").val(),
    },
    dataType: "JSON",
    beforeSend: () => {
      $("div.pageloader").show();
      preloaderon();
    },
    success: (data) => {
      $("div.pageloader").hide();
      if (data.os == 1) {
        $(".strprsntopnorclsstsdvbx").html(
          '<div class="strstsdvbxopn">.Open</div>'
        );
      } else {
        $(".strprsntopnorclsstsdvbx").html(
          '<div class="strstsdvbxcls">.Close</div>'
        );
      }
      if (data.rs == 1) {
        $rvodrs = true;
        $(".strprsntrcvngordrsorntstsdvbx").html(
          '<div class="strstsdvbxrcvngords">.Receiving Orders</div>'
        );
        $(".streppupbx").show();
      } else {
        $rvodrs = false;
        $(".strprsntrcvngordrsorntstsdvbx").html(
          '<div class="strstsnonrcvngordsdvbx">.Not Available</div>'
        );
        showsnackpopup(
          "This store is not receving orders now! Please order again later.",
          true,
          "non"
        );
      }
    },
  });
  e.stopImmediatePropagation();
  return false;
}
var vfpmtsts = false;
function vfpmupsts(e, $sts, $pts) {
  $.ajax({
    url: "https://remindo.in/stsupsflr/srcritrxnnts",
    method: "post",
    data: {
      afvuosts: "ystrvfafsts",
      od: $(".vrfypmtsbtninppup").attr("data-vo"),
      sd: $("#ithnthssmrcls").val(),
      ots: $sts,
      opts: $pts,
    },
    beforeSend: () => {
      $("div.pageloader").show();
      preloaderon();
    },
    success: (data) => {
      console.log(data);
      $("div.pageloader").hide();
      if (data == 1) {
        if ($pts == "CAS" && $sts == 1) {
          $(".streppupbx").hide();
          showsnackpopup("Your order placed!", true, true);
          $(".sdordrtostrbtn")
            .parent()
            .html(
              "<div class='sntrmrodraspndng' id='undne'><i class='fas fa-clock remindosymbols'></i>Pending</div>"
            );
          knwpkgng();
        }
        vfpmtsts = true;
      } else {
        $(".streppupbx").hide();
        if ($pts == "CAS" && $sts == 1) {
          showsnackpopup("Failed to place the order!", true, false);
        }
        vfpmtsts = false;
      }
    },
  });
  e.stopImmediatePropagation();
  return false;
}
var $vfpts = false;
function vfptsfun(e) {
  if (!$vfpts) {
    var pmn = $("#treptnmitbxval").val();
    if (pmn == "") {
      alert(
        "Please enter your payment method and its profile name. To know who paid to the store owner. Eg: Ravi via Paytm."
      );
      $("#treptnmitbxval").css("border", "2px solid red");
    } else if (!pmn.includes("via")) {
      alert(
        "Please enter your payment method and don't forget to use word 'via' before payment method name. To know the payment method you choosen to the store owner. Eg: Ravi via Paytm."
      );
      $("#treptnmitbxval").css("border", "2px solid red");
    } else {
      $vfpts = true;
      $(".vrfypmtsbtninppup")
        .css({ opacity: "0.4", "background-color": "#9e9e9e" })
        .text("Asking to store for verification...");
      var cnt =
        $("#treptnmitbxval").siblings("#ttlodritmplcdbycmr").text() +
        " from " +
        $("#treptnmitbxval").val();
      $.ajax({
        url: "https://remindo.in/stsupsflr/srcritrxnnts",
        method: "post",
        data: {
          ntfisask: "ysaskpttre",
          s: $("#ithnthssmrcls").val(),
          c: cnt,
        },
        beforeSend: () => {
          $("div.pageloader").show();
          preloaderon();
        },
        success: (data) => {
          if (data == 1) {
            $(".vrfypmtsbtninppup").attr("data-vop", 1);
            $(".usecasoptionbtn").hide();
            $vfpts = true;
            $("#treptnmitbxval").hide();
            $(".vrfypmtsbtninppup")
              .css({ opacity: "1", "background-color": "green" })
              .text("Asked! Waiting for reply from store...");
            vfpmupsts(e, 0, "ppd");
            vrfpmts();
            setInterval(() => {
              vrfpmts();
            }, 20000);
          } else {
            $vfpts = false;
            $(".usecasoptionbtn").show();
            $(".vrfypmtsbtninppup").attr("data-vop", 0);
            $(".vrfypmtsbtninppup").text(
              "Sorry! Failed to verify. Try again later."
            );
            setTimeout(() => {
              $(".vrfypmtsbtninppup")
                .css({ opacity: "1", "background-color": "green" })
                .text("Verify payment");
            }, 4000);
          }
        },
      });
      e.stopImmediatePropagation();
      return false;
    }
  }
}
function getnxtsbls(elem, filter) {
  var sibs = [];
  while ((elem = elem.nextSibling)) {
    if (elem.nodeType === 3) continue; // text node
    if (!filter || filter(elem)) sibs.push(elem);
  }
  return sibs;
}
function pdtsincmspgmtrng() {
  $(".icodrditmqtydvbtn").click(function (e) {
    var itms = $(e.target).closest(".odrngitmsqntyandprccntngdvbx");
    var i = parseInt(
      $(itms)
        .children(".odrditmqntyicordcandiptctnrdvbx")
        .children(".odrditmqtydsplyiptcntngdvbbx")
        .children(".odrditmnumquntyiptbx")
        .val()
    );
    if (i == "") {
      i = 1;
      $(itms).children().children().children(".odrditmnumquntyiptbx").val(1);
      $(itms)
        .children(".odritmsprcandqtyctngdvbx")
        .children(".stronrpgitmsqntyctnrdvbx")
        .children(".qntinnmofthsitmbxnspng")
        .text(1);
    }
    var q = parseInt(i) + 1;
    if (q <= 0) {
      q = 1;
    }
    $(itms).children().children().children(".odrditmnumquntyiptbx").val(q);
    $(itms)
      .children(".odritmsprcandqtyctngdvbx")
      .children(".stronrpgitmsqntyctnrdvbx")
      .children(".qntinnmofthsitmbxnspng")
      .text(q);
    $(itms)
      .children()
      .children()
      .children(".ordrditmprccntnrdvbx")
      .text(
        parseInt(
          $(itms)
            .children()
            .children()
            .children(".ordrditmprccntnrdvbx")
            .attr("data-cst")
        ) * q
      );
    ttlamt();
  });
  $(".decodrditmqtydvbtn").click(function (e) {
    var itms = $(e.target).closest(".odrngitmsqntyandprccntngdvbx");
    var i = $(itms)
      .children(".odrditmqntyicordcandiptctnrdvbx")
      .children(".odrditmqtydsplyiptcntngdvbbx")
      .children(".odrditmnumquntyiptbx")
      .val();
    if (i == "") {
      i = 1;
      $(itms).children().children().children(".odrditmnumquntyiptbx").val(1);
    }
    var q = parseInt(i) - 1;
    if (q <= 0) {
      q = 1;
    }
    $(itms).children().children().children(".odrditmnumquntyiptbx").val(q);
    $(itms)
      .children(".odritmsprcandqtyctngdvbx")
      .children(".stronrpgitmsqntyctnrdvbx")
      .children(".qntinnmofthsitmbxnspng")
      .text(q);
    $(itms)
      .children()
      .children()
      .children(".ordrditmprccntnrdvbx")
      .text(
        parseInt(
          $(itms)
            .children()
            .children()
            .children(".ordrditmprccntnrdvbx")
            .attr("data-cst")
        ) * q
      );
    ttlamt();
  });
  $(".odrditmnumquntyiptbx").keyup(function (e) {
    var itms = $(e.target).closest(".odrngitmsqntyandprccntngdvbx");
    var i = $(itms)
      .children(".odrditmqntyicordcandiptctnrdvbx")
      .children(".odrditmqtydsplyiptcntngdvbbx")
      .children(".odrditmnumquntyiptbx")
      .val();
    if (i == "") {
      i = 1;
      $(itms).children().children().children(".odrditmnumquntyiptbx").val(1);
    }
    var q = parseInt(i);
    if (q <= 0) {
      q = 1;
    }
    console.log(q);
    $(itms).children().children().children(".odrditmnumquntyiptbx").val(q);
    $(itms)
      .children(".odritmsprcandqtyctngdvbx")
      .children(".stronrpgitmsqntyctnrdvbx")
      .children(".qntinnmofthsitmbxnspng")
      .text(q);
    $(itms)
      .children()
      .children()
      .children(".ordrditmprccntnrdvbx")
      .text(
        parseInt(
          $(itms)
            .children()
            .children()
            .children(".ordrditmprccntnrdvbx")
            .attr("data-cst")
        ) * q
      );
    ttlamt();
  });
}
function rmvdelbnsfuncg() {
  var optbx = false;
  var mropns = document.querySelectorAll(".mroptsdvbxbtn");
  mropns.forEach((mropt) => {
    $(mropt).click((e) => {
      $("#hndlbnornmridpt").val($(mropt).attr("data-or"));
      if (
        !$(mropt)
          .parent()
          .parent()
          .parent()
          .siblings(".ordrlstbdycntnrdvbx")
          .children()
          .children()
          .children(".odrngitmsqntyandprccntngdvbx").length
      ) {
        $(".rmvitmfrmodrinstrbtndvbx").hide();
      } else {
        $(".rmvitmfrmodrinstrbtndvbx").show();
      }
      if (optbx) {
        $(".strpgftrtoshwppupsdvbx").slideUp(200);
        optbx = false;
      } else {
        $(".strpgftrtoshwppupsdvbx").slideDown(200);
        optbx = true;
      }
      $(".dlodrfrmstreoptnbtndvbx")
        .children(".dltodroptnicnasbtn")
        .click((e) => {
          if ($nwlst) {
            $(mropt)
              .parent()
              .parent()
              .parent()
              .parent()
              .parent()
              .parent(".odrdlsttostrcntnrdvbx")
              .remove();
            crtnwordr();
            chckitms();
            $(".strpgftrtoshwppupsdvbx").slideUp(200);
            optbx = false;
          } else {
            $.ajax({
              url: "https://remindo.in/stsupsflr/srcritrxnnts",
              method: "post",
              data: {
                dlorscmr: "ystrdlor",
                o: $("#hndlbnornmridpt").val(),
                s: $("#ithnthssmrcls").val(),
              },
              beforeSend: () => {
                $("div.pageloader").show();
                preloaderon();
              },
              success: (data) => {
                $("div.pageloader").hide();
                if (data == 1) {
                  $(mropt)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent(".odrdlsttostrcntnrdvbx")
                    .remove();
                  crtnwordr();
                  chckitms();
                  $(".strpgftrtoshwppupsdvbx").slideUp(200);
                  optbx = false;
                }
              },
            });
          }
        });
      var rclck = false;
      $(".rmvtmsodroptnicnasbtn").click(() => {
        if (
          !rclck &&
          !$(".rmvitmfrmlstbtn").length &&
          $(mropt)
            .parent()
            .parent()
            .parent()
            .siblings(".ordrlstbdycntnrdvbx")
            .children()
            .children()
            .children(".odrngitmsqntyandprccntngdvbx").length
        ) {
          $(".dlodrfrmstreoptnbtndvbx").hide();
          rclck = true;
          $(mropt)
            .parent()
            .parent()
            .parent()
            .siblings(".ordrlstbdycntnrdvbx")
            .children()
            .children()
            .children(".odrngitmsqntyandprccntngdvbx")
            // .forEach((rvbn) => {
            .append(
              "<div class='rem-badge rmvitmfrmlstbtn' onclick='rmthsitm(this)' role='button'><i class='fas fa-times remindosymbols rmvitmfrmlsttmsicn'></i></div>"
            );
          // });
        } else {
          rclck = false;
          $(".dlodrfrmstreoptnbtndvbx").show();
          document
            .querySelectorAll(".odrngitmsqntyandprccntngdvbx")
            .forEach((rvbn) => {
              $(rvbn).children(".rmvitmfrmlstbtn").remove();
            });
        }
      });
    });
  });
  $("div").click((e) => {
    if (optbx && e.target === e.currentTarget) {
      optbx = false;
      $(".strpgftrtoshwppupsdvbx").slideUp(200);
    }
  });
  $(".strpgftrtoshwppupsdvbx").click((e) => {
    if (e.target === e.currentTarget) {
      $(".strpgftrtoshwppupsdvbx").slideUp(200);
    }
  });
}
function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? "pm" : "am";
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? "0" + minutes : minutes;
  var strTime = hours + ":" + minutes + " " + ampm;
  return strTime;
}
$(document).ready(function () {
  $(".strpgtphdrcntnrdvbx").css(
    "background-image",
    'url("' + $(".strpgtphdrcntnrdvbx").attr("data-big") + '")'
  );
  otherjs();
  var ad = false;
  var ps = false;
  $(".strdsplyadrsdvasbtn").click(function () {
    if (ad) {
      $(".stradrsbdydvbx").slideUp(200);
      ad = false;
    } else {
      $(".stradrsbdydvbx").slideDown(200);
      ad = true;
    }
  });
  $(".strdsplypvtdvasbtn").click(function () {
    if (ps) {
      $(".strpvtcntrbdydvbx").slideUp(200);
      ps = false;
    } else {
      $(".strpvtcntrbdydvbx").slideDown(200);
      ps = true;
    }
  });
  $(".pywhqrsnupioptnbtnbx").click(function () {
    $(".streupippupbx").show();
  });
  $(".streownrpgupdtstrscvrpicbtn").click(() => {
    $(".updstrdpsbx").show();
    $(".updstrhdrttle").text("Edit cover page");
    $("#strprpicchngipt")
      .attr("data-oi", $(".streownrpgupdtstrscvrpicbtn").attr("data-o"))
      .attr("data-tp", $(".streownrpgupdtstrscvrpicbtn").attr("data-t"));
  });
  $("#cngpfrmglrybtn").click(() => {
    $(".updstrdpsbx").show();
    $(".updstrhdrttle").text("Edit profile pic");
    $("#strprpicchngipt")
      .attr("data-oi", $("#cngpfrmglrybtn").attr("data-o"))
      .attr("data-tp", $("#cngpfrmglrybtn").attr("data-t"));
  });
  $(".strspywhqrsnupiopnetbnbx").click(() => {
    $(".streqrppupbx").show();
    $("#strprpicchngipt")
      .attr("data-oi", $(".strspywhqrsnupiopnetbnbx").attr("data-o"))
      .attr("data-tp", $(".strspywhqrsnupiopnetbnbx").attr("data-t"));
  });
  $(".rmvstrdpcspicbtndvbx,.rmvqrscnigbtn").click((e) => {
    var s = $("#stropnbtn").attr("data-s");
    var t = $(e).attr("class", "rmvstrdpcspicbtndvbx")
        ? $("#strprpicchngipt").attr("data-tp")
        : $("#strqrpiccngipt").attr("data-tp"),
      $tp = "";
    if (t == "bnstrcvpt") {
      $tp = "rmvbncv";
    } else if (t == "bnstrpfpt") {
      $tp = "rmvbnpfpc";
    } else if (t == "bnstrppt") {
      $tp = "rmvbnuppc";
    }
    $.ajax({
      url: "../stsupsflr/pcsfls",
      method: "POST",
      data: {
        s: s,
        prigtcg: $("#strprpicchngipt").attr("data-oi"),
        nwignm: "",
        ptp: $tp,
      },
      success: function (data) {
        if (data != "n0" && data != "") {
          if (t == "bnstrpfpt") {
            $(".streownrpgupdtstrsprflpicbtn").attr("data-o", "");
            $(".strebsprfpcigcntrnrdvbx").html("");
            $(".updstrdpsbx").hide();
          } else if (t == "bnstrcvpt") {
            $(".streownrpgupdtstrscvrpicbtn").attr("data-o", "");
            $(".strbsncvrpicdsplybx").html("");
            $(".updstrdpsbx").hide();
          } else if (t == "bnstrppt") {
            $(".strspywhqrsnupiopnetbnbx").attr("data-o", "");
            $(".stravblupqrsndsplyctnrdvbx").html("");
            $(".streqrppupbx").hide();
          }
          showsnackpopup("Pic updated successfully.", true, true);
        } else {
          showsnackpopup("Failed to update pic. Try again later.");
        }

        $(".updstrdpsbx").hide();
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  chckitms();
  $(".bckbtntogstrbtn").click(function () {
    $(".strebsnsprfdtlscntrdvbox").slideUp(200);
    $(".strepgstordscntnrdivbox").slideDown(200);
  });
  $(".shpsdtlsbtncntnrdvbx,.streownrsprfldtlspgbtn").click(function () {
    $(".strepgstordscntnrdivbox").slideUp(200);
    $(".strebsnsprfdtlscntrdvbox").slideDown(200);
  });
  ttlamt();
  ttitms();
});
function orgptamt() {
  var alitscst = document.querySelectorAll(".ordrdlstartletgcntnrdvbox");
  alitscst.forEach((nt) => {
    var tamt = 0;
    nt.querySelectorAll(".lstditmsinodrlstcntnrdvbx").forEach((ims) => {
      ims.querySelectorAll(".odritmcstdtatcnttl").forEach((amt) => {
        $(amt).text(
          parseInt($(amt).attr("data-cst")) *
            parseInt(
              $(amt)
                .parent()
                .siblings(".stronrpgitmsqntyctnrdvbx")
                .children(".qntinnmofthsitmbxnspng")
                .text()
            )
        );
      });
    });
  });
}
function ttlamt() {
  var alitscst = document.querySelectorAll(".ordrdlstartletgcntnrdvbox");
  alitscst.forEach((nt) => {
    var tamt = 0;
    nt.querySelectorAll(".lstditmsinodrlstcntnrdvbx").forEach((ims) => {
      ims.querySelectorAll(".odritmcstdtatcnttl").forEach((amt) => {
        tamt += parseInt($(amt).text());
      });
    });
    $(nt)
      .children()
      .children()
      .children(".ttlamtofalllsttopycntnrdvbx")
      .html(
        "<span><strong>Total Amount :</strong></span><span id='ttlamtinnmrssptg'>" +
          tamt +
          "₹</span>"
      );
  });
}
function ttitms() {
  var alitscst = document.querySelectorAll(".ordrdlstartletgcntnrdvbox");
  alitscst.forEach((nt) => {
    var tam = 0;
    nt.querySelectorAll(".lstditmsinodrlstcntnrdvbx").forEach((ims) => {
      ims.querySelectorAll(".odrditmartclcntnrdvbx").forEach(() => {
        tam += 1;
      });
    });
    var iw = tam == 1 ? " Item" : "Items";
    $(nt)
      .children()
      .children()
      .children(".noitmsinlstbtmhrctnrdvbx")
      // .children(".tnmofitmsinthelstcntnrspntg")
      .text(tam + " " + iw);
  });
}

function rmthsitm(t) {
  $(t).parent().parent().remove();
  ttlamt();
  chckitms();
  ttitms();
}
function chckitms() {
  if ($(".lstditmsinodrlstcntnrdvbx").text().trim() === "") {
    $(
      ".ttlamtofalllsttopycntnrdvbx,.ordrlstftrcntnrdvbox,.rmvitmfrmodrinstrbtndvbx"
    ).hide();
    $(".strpgftrtoshwppupsdvbx").slideUp(200);
    $(".dlodrfrmstreoptnbtndvbx").show();
  } else {
    $(
      ".ttlamtofalllsttopycntnrdvbx,.ordrlstftrcntnrdvbox,.rmvitmfrmodrinstrbtndvbx"
    ).show();
  }
}
$(document).ready(() => {
  $("#strsedtprfdtlsbtn,#edtlcnmps").click((e) => {
    var sunm = $("#strsedtprfdtlsbtn").attr("data-sn");
    var s = $("#strsedtprfdtlsbtn").attr("data-si");
    $.ajax({
      url: "storeedits",
      method: "post",
      data: { s: s },
      dataType: "json",
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $("body").removeClass("storecustmrpgbdy").addClass("storeedtspgbdy");
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer").html(data.body);
        window.history.pushState(
          {},
          {},
          "https://remindo.in/stores/storeedits?s=" + sunm
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  $("#prdtsnvgtbtn").click((e) => {
    var sunm = $("#prdtsnvgtbtn").attr("data-sn");
    var s = $("#prdtsnvgtbtn").attr("data-si");
    $.ajax({
      url: "pdts",
      method: "post",
      data: { s: s },
      dataType: "json",
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $("body").removeClass("storecustmrpgbdy");
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer").html(data.body);
        window.history.pushState(
          {},
          {},
          "https://remindo.in/stores/pdts?s=" + sunm
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  $(".pndcstmrsnvgtnbtndvbx").click((e) => {
    var sunm = $("#strsedtprfdtlsbtn").attr("data-sn");
    var s = $("#strsedtprfdtlsbtn").attr("data-si");
    $.ajax({
      url: "pdctmrs",
      method: "post",
      data: { s: s },
      dataType: "json",
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $("body").removeClass("storecustmrpgbdy");
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer").html(data.body);
        window.history.pushState(
          {},
          {},
          "https://remindo.in/stores/pdctmrs?s=" + sunm
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
});
$(document).ready(() => {
  $("#stropnbtn").click(() => {
    onrvstsfun(
      $("#stropnbtn").attr("data-s"),
      "onsts",
      $("#stropnbtn").attr("data-ud")
    );
  });
  $("#strodrrcvngbtn").click(() => {
    onrvstsfun(
      $("#strodrrcvngbtn").attr("data-s"),
      "rvabl",
      $("#strodrrcvngbtn").attr("data-ud")
    );
  });
});
function onrvstsfun(s, tp, ud) {
  $.ajax({
    url: "https://remindo.in/stsupsflr/strdtlsupdt",
    method: "post",
    data: { onrvsts: "udttre", s: s, tp: tp, ud: ud },
    beforeSend: () => {
      $("div.pageloader").show();
      preloaderon();
    },
    success: (data) => {
      $("div.pageloader").hide();
      if (data == 1) {
        if (tp == "onsts") {
          if (ud == "tre") {
            $("#stropnbtn").attr("data-ud", "fs");
            $(".strprsntopnorclsstsdvbx").html(
              "<div class='strstsdvbxopn'>.Open</div>"
            );
          } else {
            $("#stropnbtn").attr("data-ud", "tre");
            $(".strprsntopnorclsstsdvbx").html(
              "<div class='strstsdvbxcls'>.Close</div>"
            );
          }
        } else if (tp == "rvabl") {
          if (ud == "tre") {
            $("#strodrrcvngbtn").attr("data-ud", "fs");
            $(".strprsntrcvngordrsorntstsdvbx").html(
              "<div class='strstsdvbxrcvngords'>.Receiving Orders</div>"
            );
          } else {
            $("#strodrrcvngbtn").attr("data-ud", "tre");
            $(".strprsntrcvngordrsorntstsdvbx").html(
              "<div class='strstsnonrcvngordsdvbx'>.Not Available</div>"
            );
          }
        }
        showsnackpopup("Status updated!", true, true);
      } else {
        showsnackpopup(
          "Failed to update status. Please try again after sometime!",
          true,
          false
        );
      }
    },
  });
}
$("#stravblcasbtn").click((e) => {
  csavbltoevyonsts($(e.target).attr("data-s"), $(e.target).attr("data-ud"));
});
function csavbltoevyonsts(s, ud) {
  $.ajax({
    url: "https://remindo.in/stsupsflr/strdtlsupdt",
    method: "post",
    data: { csavlsts: "udcsttre", s: s, ud: ud },
    beforeSend: () => {
      $("div.pageloader").show();
      preloaderon();
    },
    success: (data) => {
      $("div.pageloader").hide();
      if (data == 1) {
        showsnackpopup("Status updated!", true, true);
      } else {
        showsnackpopup(
          "Failed to update status. Please try again after sometime!",
          true,
          false
        );
      }
    },
  });
}

function picrszr(img, tp) {
  var cnvs = document.createElement("canvas");
  var MAX_WIDTH = 600;
  var MAX_HEIGHT = 600;
  if (tp == "pf") {
    MAX_WIDTH = 400;
    MAX_HEIGHT = 400;
  }
  var width = img.width;
  var height = img.height;
  if (width > height) {
    if (width > MAX_WIDTH) {
      height *= MAX_WIDTH / width;
      width = MAX_WIDTH;
    }
  } else {
    if (height > MAX_HEIGHT) {
      width *= MAX_HEIGHT / height;
      height = MAX_HEIGHT;
    }
  }
  cnvs.width = width;
  cnvs.height = height;
  var ctx = cnvs.getContext("2d");
  ctx.drawImage(img, 0, 0, cnvs.width, cnvs.height);
  return cnvs;
}
pdtpmg();
function pdtpmg() {
  $(document).on("change", ".chngnwrmdoprflpicdvbx,.cngqrscnigbtn", (e) => {
    e.preventDefault();
    var funvn = $("#strprpicchngipt").attr("data-oi");
    funvn = funvn == "" ? "" : funvn;
    var s = $("#stropnbtn").attr("data-s");
    var $tp = $("#strprpicchngipt").attr("data-tp");
    var $q = false;
    if ($tp == "bnstrpfpt") {
      $q = false;
    } else if ($tp == "bnstrcvpt") {
      $q = false;
    } else if ($tp == "bnstrppt") {
      $q = true;
    }
    var property = $q
      ? document.querySelector("#strqrpiccngipt").files[0]
      : document.querySelector("#strprpicchngipt").files[0];
    var image_name = property.name;
    var extension = image_name.split(".").pop().toLowerCase();
    if ($.inArray(extension, ["png", "jpeg", "jpg"]) == -1) {
      alert("Invalid File");
    } else {
      var gmi = document.createElement("img");
      gmi.src = URL.createObjectURL(property);
      gmi.onload = () => {
        var cnvs = picrszr(gmi, $tp == "bnstrpfpt" ? "pf" : "");
        cnvs.toBlob(
          function (blob) {
            property = new File([blob], `${new Date()}.jpeg`, {
              type: "image/jpeg",
              lastModified: new Date(),
            });
            var img_size = property.size;
            if (img_size > 1000000) {
              alert("File is too big");
            } else {
              var form_data = new FormData();
              form_data.append("s", s);
              form_data.append("prigtcg", funvn);
              form_data.append("ptp", $tp);
              form_data.append("file", property);
              $.ajax({
                url: "../stsupsflr/strdtlsupdt",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                  $("div.pageloader").show();
                  preloaderon();
                },
                success: function (data) {
                  $("div.pageloader").hide();
                  if (data.includes("e0")) {
                    alert("Select a photo to set you a pic.");
                  } else if (data.includes("e1")) {
                    alert("Please choose a valid pic.");
                  } else if (data != "n0" && data != "") {
                    if ($tp == "bnstrpfpt") {
                      $(".streownrpgupdtstrsprflpicbtn").attr("data-o", data);
                      $(".strebsprfpcigcntrnrdvbx").html(
                        `<img src='${data}' class='strbsnsprfpc'>`
                      );
                    } else if ($tp == "bnstrcvpt") {
                      $(".streownrpgupdtstrscvrpicbtn").attr("data-o", data);
                      $(".strbsncvrpicdsplybx").html(
                        `<img src='${data}' class='strbsnsprfcvrpc'>`
                      );
                    } else if ($tp == "bnstrppt") {
                      $(".strspywhqrsnupiopnetbnbx").attr("data-o", data);
                      $(".stravblupqrsndsplyctnrdvbx").html(
                        `<img src='${data}' class='srupqrig'>`
                      );
                    }
                    showsnackpopup("Pic updated successfully.", true, true);
                  } else {
                    showsnackpopup(
                      "Failed to update pic. Try again later.",
                      true,
                      false
                    );
                  }

                  $(".updstrdpsbx").hide();
                  $(".streqrppupbx").hide();
                },
              });
              e.stopImmediatePropagation();
              return false;
            }
          },
          "image/jpeg",
          0.899
        );
      };
    }
  });
}
$("#usrcstmrunpnshpbtn").click((e) => {
  var s = $("#usrcstmrunpnshpbtn").attr("data-s");
  $.ajax({
    url: "https://remindo.in/stsupsflr/srcritrxnnts",
    method: "post",
    data: { unpnstr: "trestrupn", s: s },
    beforeSend: () => {
      $("div.pageloader").show();
      preloaderon();
    },
    success: (data) => {
      $("div.pageloader").hide();
      showsnackpopup(
        "<i class='fas fa-thumbtack remindosymbols' style='color:white;transform:rotate(180deg);'></i> You have successfully unpinned.",
        true,
        true
      );
      if (data == 1) {
        $.ajax({
          url: "https://remindo.in/stores",
          method: "get",
          data: { sstrsnm: "treshw" },
          dataType: "json",
          beforeSend: () => {
            $("div.pageloader").show();
            preloaderon();
          },
          success: (data) => {
            $("div.pageloader").hide();
            $("body").removeClass("storecustmrpgbdy");
            $(document).attr("title", data.title);
            $("div.remindochildboxycontainer")
              .html(data.body)
              .addClass("rmdchldbxstrecustmruidvbx");
            window.history.pushState({}, {}, "https://remindo.in/stores");
          },
        });
      } else {
        showsnackpopup(
          "<i class='fas fa-thumbtack remindosymbols' style='color:white;transform:rotate(180deg);'></i> Failed to unpin. Try again later.",
          true,
          false
        );
      }
    },
  });
});
