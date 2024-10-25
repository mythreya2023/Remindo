$(document).ready(() => {
  if (window.innerWidth > 420) {
    if ($(".remindomainheaderlptpvsn").html("")) {
      $.ajax({
        url: "http://localhost/remindo/header.php",
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
      url: "http://localhost/remindo/header.php",
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
  $(".strpgmdbdyofodrlstscntnrdvbx").unbind();
  $(".remindobackbtnuname").click((e) => {
    var sunm = new URL(window.location.href).searchParams.get("s");
    var s = $("#hnitsidval").val();
    $.ajax({
      url: "store.php",
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
          "http://localhost/remindo/stores/store?s=" + sunm
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
});
$(document).ready(() => {
  var os = 0;
  var lt = 5;
  var ishd = false;
  var hsda = false;
  fchalprdts("", false, os, lt);
  $("#srchprdtsinstrtostronr").keyup(() => {
    os = 0;
    lt = 5;
    ishd = true;
    hsda = false;
    fchalprdts($("#srchprdtsinstrtostronr").val(), true, os, lt);
  });
  $(document).on("touchmove", scrlfun);
  $(window).scroll(scrlfun);
  function scrlfun() {
    if (
      $(window).scrollTop() + $(window).height() + 10 >
      $(".remindochildboxycontainer").height()
    ) {
      os += lt;
      if (!ishd || $("#srchprdtsinstrtostronr").val() == "") {
        if (!hsda) {
          fchalprdts("", false, os, lt);
        }
      } else {
        if (!hsda) {
          fchalprdts($("#srchprdtsinstrtostronr").val(), false, os, lt);
        }
      }
    }
  }
  function fchalprdts(sw, ish, os, lt) {
    var sd = $("#hnitsidval").val();
    $.ajax({
      url: "../stsupsflr/rtvpds",
      method: "post",
      data: {
        fhpdts: "trefhspts",
        sw: sw,
        sd: sd,
        os: os,
        lt: lt,
      },
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        if (data == 0) {
          hsda = true;
          if (ish) {
            $(".prdtsdsplngwall").html(
              "<center><h5 style='color:gray;'>Add a new product to your store by clicking on 'Add Item' button on top right corner of the page.</h5></center>"
            );
          } else {
            $(".prdtspgldrmsgdvbx").html(
              "<center><h5 style='color:gray;'>Add a new product to your store by clicking on 'Add Item' button on top right corner of the page.</h5></center>"
            );
          }
        } else if (data == "f0") {
          $(".prdtspgldrmsgdvbx").html(
            "<center><h2 style='color:gray;'>Failed to load the products. Try again later.</h2></center>"
          );
        } else if (data == "n0") {
          $(".prdtspgldrmsgdvbx").html(
            "<center><h2 style='color:gray;'>This page is no longer available.</h2><br><div class='rmdobctostrbtn blewhtbns'><i class='fas fa-arrow-left remindosymbols' style='color:white; font-size:14px;'></i>Back to Store</div><br></center>"
          );
        } else if (ish) {
          $(".prdtsdsplngwall").html(data);
          opndsply(false, false);
        } else {
          $(".prdtsdsplngwall").append(data);
          opndsply(false, false);
        }
        if ($(".strsallprdtelmscntngdvbx").attr("data-srl") == "ebd") {
          $(
            ".strprdtedtinstkstsdvbxbtn,.strsprdtnofbyeddvbx,#stpdtdltprdts"
          ).remove();
        }
        reusblmnfn();
        stkupdbns();
        thenewera();
      },
    });
  }
});
$(document).ready(() => {
  $(".straddprdtsbtn").click((e) => {
    $(".cmn-lbx-bckgrond-cntngdvbx,.cmn-lbx-pdt-dsplyr-cntngdvbx").show();
    $(
      ".lbx-iothpcs-rltosldsh-pxs,.lbx-lrgdsplyprvig-tg,.lbx-szes-slctn-dsply,.lbx-pdt-dnmc-cntetbls"
    ).html("");
    $(".lbx-pdt-lvpc").html(
      "<div class='lbx-pdtlvig-prvwicn'><i class='fas fa-eye remindosymbols lbx-lvmdleysmblicn'></i></div>"
    );
    $(".lbx-dsplr-nxpvbtns-dvbx").hide();
    $(
      ".lbx-pdtprce-dsply,.lbx-pdtisgts-sld-spn,.lbx-pdtisgts-viws-spn,.lbx-pdtisgts-mchme-spn"
    ).text(0);
    $(".lbx-pdtlst-updt-tmshwn").text("Just now");
    $(".lbx-pn-shwedls-icnbtn,.lbx-pdt-edbns-cntng-dvbx").hide();
    $(".lbx-pdt-dnmc-cntetbls")
      .addClass("edtbltgs")
      .attr("contenteditable", "true");
    $(".rmvftchr").css("display", "flex");
    $(".lbx-sktlbn-iptdvbx .switch").html(
      `<input type='checkbox' id='lbx-adnwpdt-stkstsipt' checked><span class='slider round'></span>`
    );
    $(".lbx-adptobn")
      .removeClass("lbx-ptpto-cmbntocng-pic")
      .addClass("lbx-adnwpdt-adptobtn");
    $(".lbx-rmvptobtn")
      .removeClass("lbx-pdto-rmvpic-btn")
      .addClass("lbx-adnwpdt-rmvpicbn");
    $(".lbx-picfle")
      .addClass("lbx-adnwig-fleipt")
      .removeClass("lbx-rmdpdtpc-flipt");
    $(
      ".lbx-adpdt-andls-btn,.lbx-pdt-adszbtninszedsply-dvbx,.rmvaddsze,.lbx-dvedbl-mntrng-spntgs"
    ).show();
    cngigprv = document.querySelector(".lbx-iothpcs-rltosldsh-pxs");
    previmg = document.querySelectorAll(".lbx-sld-shw-imgprevw-img");
    adnwpdttostr();
  });
});
function lvupdtedtdpdt(ix, $pto, $pnm, $pqt, $pql, $isk, pz, tm) {
  var pds = document.querySelectorAll(".strprdtdtlsandupdtbtnscntngdvbx")[ix];

  if ($(".prdtppuldsplybximg").attr("src", "")) {
    $(".prdtpicdsplydvbx").html("<img class='prdtppuldsplybximg'>");
  }
  $(pds).children().children().children(".prdtditmnmcntnrdvbx").text($pnm);
  $(pds)
    .children()
    .children()
    .children()
    .children()
    .children(".prdtsrditmpcdorlscntnrdvbx")
    .text($pql);
  $(pds)
    .children()
    .children()
    .children()
    .children()
    .children(".prdtsrditmqtycntnrdvbx")
    .text($pqt);
  $(pds)
    .children()
    .children()
    .children()
    .children()
    .children(".istksptg")
    .text($isk)
    .css("color", $isk == "In stock" ? "green" : "red");
  $(pds).children().children().children(".prdtprcecstinnm").text(pz);

  $(pds).siblings().children(".pdtstmstp").text(tm);
  if ($pto != "") {
    $(pds)
      .children()
      .children()
      .children(".prdctsdsplypctre")
      .attr("src", "../strpdtspcs/" + $pto);
  }
}
function reusblmnfn() {
  document.querySelectorAll("#stpdtdltprdts").forEach((dltbtn) => {
    $(dltbtn).click(() => {
      showsnackpopup(
        "Do you really want to delete?",
        false,
        "non",
        true,
        "No/Yes",
        () => {
          Dltprts(dltbtn);
        }
      );
    });
  });
}
$(document).ready(() => {
  $("#lbx-strpdtstksts").change((e) => {
    updtstcksts(e.target);
  });
});
function stkupdbns() {
  document.querySelectorAll("#strprdtstksts").forEach((sbtn) => {
    $(sbtn).click(() => {
      updtstcksts(sbtn);
    });
  });
}
function updtstcksts(stk) {
  var sd = $(stk).attr("data-sd");
  var pd = $(stk).attr("data-pd");
  var ud = $(stk).attr("data-ud");
  $.ajax({
    url: "../stsupsflr/strprdts.php",
    method: "post",
    data: { istk: "edisktre", sd: sd, pd: pd, ud: ud },
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $("div.pageloader").hide();
      if (data == 1) {
        var sks = ud == "tre" ? "In stock" : "Out of stock";
        var sksclr = ud == "tre" ? "green" : "red";
        $(stk)
          .attr("data-ud", ud == "tre" ? "fs" : "tre")
          .attr("checked", ud == "tre" ? true : false);

        $(".lbx-pdsts-updtyp-stks").text(sks).css("color", sksclr);
        if ($(stk).attr("id") == "lbx-strpdtstksts") {
          $(document.querySelector(`[data-pid="${pd}"]`))
            .attr("data-istk", sks)
            .siblings(".prdtsrditmothdtlscntngdvbx")
            .children(".prdtstckstsdvbx")
            .children(".istksptg")
            .text(sks)
            .css("color", sksclr);
          $(document.querySelector(`[data-pid="${pd}"]`))
            .parent()
            .parent()
            .siblings(".strsprdtupdtbtns")
            .children(".strprdtedtinstkstsdvbxbtn")
            .children()
            .children()
            .children("#strprdtstksts")
            .parent()
            .html(
              `<input type="checkbox" id="strprdtstksts" data-pd="${pd}" data-sd="${sd}" data-ud="${
                ud == "tre" ? "fs" : "tre"
              }" checked="${
                ud == "tre" ? true : false
              }"><span class="slider round"></span>`
            )
            .click((e) => {
              updtstcksts(e.target);
            });
        } else {
          $(stk)
            .parent()
            .parent()
            .parent()
            .parent()
            .siblings(".strsprdtupdtddtlsdvbx")
            .children()
            .children(".prdtditmnmcntnrdvbx")
            .attr("data-istk", sks);
          $(stk)
            .parent()
            .parent()
            .parent()
            .parent()
            .siblings(".strsprdtupdtddtlsdvbx")
            .children()
            .children()
            .children()
            .children(".istksptg")
            .text(sks)
            .css("color", sksclr);
        }
        showsnackpopup("Status update!", true, true);
      } else {
        showsnackpopup(
          "Failed to update status. Try again later.",
          true,
          false
        );
      }
    },
  });
  return false;
}
function Dltprts(dpdt) {
  var s = $(dpdt).attr("data-sd");
  var p = $(dpdt).attr("data-pd");
  var pi = $(dpdt).attr("data-pi");
  var lpc = $(dpdt).attr("data-lpc");
  $.ajax({
    url: "../stsupsflr/strprdts.php",
    method: "post",
    data: { dtpdt: "dtpdtre", s: s, p: p, pi: pi, lpc: lpc },
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $("div.pageloader").hide();
      if (data == 1) {
        var tm = 200;
        var par = $(dpdt).parent().parent().parent();
        par.slideUp(tm);
        setTimeout(() => {
          par.remove();
        }, 200);
        showsnackpopup("Product deleted successfully.", true, true);
      } else {
        showsnackpopup(
          "Falied to delete product. Try again later.",
          true,
          false
        );
      }
    },
  });
}
// ----------- The new era code------
function thenewera() {
  $(".strprdtedtdvbxbtn").click((e) => {
    $(".lbx-adpdt-andls-btn").hide();
    $(
      ".cmn-lbx-bckgrond-cntngdvbx,.cmn-lbx-pdt-dsplyr-cntngdvbx,.lbx-pn-shwedls-icnbtn"
    ).show();
    $(".lbx-pdt-stketandothbns-cntngdvbx").hide();
    $(".lbx-pdt-edbns-cntng-dvbx").css({ display: "flex" });
    $(".lbx-pdt-dnmc-cntetbls")
      .addClass("edtbltgs")
      .attr("contenteditable", "true");
    $(".rmvftchr").css("display", "flex");
    $(
      ".lbx-pdt-adszbtninszedsply-dvbx,.rmvaddsze,.lbx-dvedbl-mntrng-spntgs"
    ).show();
    var lbxcnts = (e) => {
      var lbximt = $(e).closest(".prdtditmnmcntnrdvbx");
      $(".lbx-pdt-nmdsplydvbx").text($(lbximt).attr("data-tle"));
      $(".lbx-pdtprce-dsply").text($(lbximt).attr("data-pce"));
      $(".lbx-pdtmr-dls-dsplybx").text($(lbximt).attr("data-dcptn"));
      $(".lbx-pdtisgts-sld-spn").text($(lbximt).attr("data-slds"));
      $(".lbx-pdsts-updtyp-stks")
        .text($(lbximt).attr("data-istk"))
        .css(
          "color",
          `${$(lbximt).attr("data-istk") == "In stock" ? "green" : "red"}`
        );
      $(".lbx-pdtlst-updt-tmshwn").text($(lbximt).attr("data-luptd"));
      var pigs = document.querySelectorAll(".lbx-iothpcs-rltosldsh-pxs");
      for (var i = 0; i <= pigs.length - 1; i++) {
        $(pigs[i]).html(
          `<img src='../strpdtspcs/${$(lbximt).attr(
            "data-rpigs"
          )}' class='lbx-sld-shw-imgprevw-img'/>`
        );
      }
      rptigvwr();
    };
    lbxcnts(e.target);
    var lbximt = $(e.target).closest(".prdtditmnmcntnrdvbx");
    pnm = $(lbximt).attr("data-tle");
    sze = $(".lbx-szes-slctn-dsply").html();
    frs = $(".lbx-pdt-fchrswrtn-dvbx").html();
    prc = $(lbximt).attr("data-pce");
    mabt = $(lbximt).attr("data-dcptn");
    mbthscrvdn(e);
    addszebns(false);

    var ptnm = $(".lbx-pdt-nmdsplydvbx").text();
    $(".lbx-ptnme-cotmnrtngdvbx .lbx-alnmctrs-mnrtd-spn").text(
      `${ptnm.length}/100`
    );
  });
}
adrmptig();
function adnwpdttostr() {
  $(
    ".lbx-adpdt-andls-btn,.lbx-adnwpdt-adptobtn,.lbx-adnwig-fleipt,.lbx-adnwpdt-rmvpicbn"
  ).unbind();
  var adpdtfrmdta = new FormData();
  var itrt = 0;
  $(".lbx-adpdt-andls-btn").click(adnwpditm);
  $(".lbx-adnwpdt-adptobtn").click(adnwpdtigs);
  function adnwpdtigs() {
    itrt = 0;
    $(document).on("change", ".lbx-adnwig-fleipt", function (e) {
      $(".lbx-adnwig-fleipt").unbind();
      e.preventDefault();
      if (itrt > 0) {
        return false;
      }
      var property = document.querySelector(".lbx-adnwig-fleipt").files[0];
      if (property != undefined) {
        var image_name = property.name;
        var extension = image_name.split(".").pop().toLowerCase();
        if ($.inArray(extension, ["png", "jpeg", "jpg"]) == -1) {
          alert("Invalid File");
        } else {
          var gmi = document.createElement("img");
          gmi.src = URL.createObjectURL(property);
          gmi.onload = () => {
            var cnvs = picrszr(gmi);
            cnvs.toBlob(
              function (blob) {
                property = new File(
                  [blob],
                  `${image_name.split(".")[0]}.jpeg`,
                  {
                    type: "image/jpeg",
                    lastModified: new Date(),
                  }
                );
                var img_size = property.size;
                if (img_size > 1000000) {
                  alert("File is too big");
                } else {
                  var src = URL.createObjectURL(property);
                  if ($(cngigprv).hasClass("lbx-pdt-lvpc")) {
                    adpdtfrmdta.delete("lvmdl");
                    adpdtfrmdta.append("lvmdl", property);
                    $(".mhmebtn").attr("data-m", src);
                    $(cngigprv).html(
                      `<div class='lbx-pdtlvig-prvwicn'><i class='fas fa-eye remindosymbols lbx-lvmdleysmblicn'></i></div><img src='${src}' class='lbx-sld-shw-imgprevw-img'>`
                    );
                  } else {
                    var files = adpdtfrmdta.getAll("file[]");
                    var isthr = false,
                      exrplc = false;
                    adpdtfrmdta.delete("file[]");
                    $.each(files, function (i, v) {
                      if (v.name == property.name) {
                        files.splice(i, 1, property);
                        adpdtfrmdta.append("file[]", property);
                        isthr = true;
                      } else if (
                        $(cngigprv)
                          .children(".lbx-sld-shw-imgprevw-img")
                          .attr("data-pignm") == v.name &&
                        !isthr
                      ) {
                        files.splice(i, 1, property);
                        adpdtfrmdta.append("file[]", property);
                        exrplc = true;
                      } else {
                        adpdtfrmdta.append("file[]", v);
                      }
                    });
                    if (!isthr) {
                      if (!exrplc) {
                        adpdtfrmdta.append("file[]", property);
                      }
                      $(cngigprv).html(
                        `<img src='${src}' class='lbx-sld-shw-imgprevw-img' data-pignm='${property.name}'>`
                      );
                    }
                  }
                  $(`.lbx-lrgdsplyprvig-tg`).html(
                    `<img src='${src}' class='lbx-sld-shw-dsply-img' >`
                  );
                  previmg = document.querySelectorAll(
                    ".lbx-sld-shw-imgprevw-img"
                  );
                }
              },
              "image/jpeg",
              0.899
            );
          };
        }
      }
      itrt++;
      return false;
    });
    $(".lbx-adnwpdt-rmvpicbn").click((e) => {
      if (itrt > 0) {
        itrt = 0;
        return false;
      }
      if ($(cngigprv).hasClass("lbx-pdt-lvpc")) {
        adpdtfrmdta.delete("lvmdl");
        $(cngigprv).html(
          `<div class='lbx-pdtlvig-prvwicn'><i class='fas fa-eye remindosymbols lbx-lvmdleysmblicn'></i></div>`
        );
      } else {
        var files = adpdtfrmdta.getAll("file[]");
        adpdtfrmdta.delete("file[]");
        $.each(files, function (i, v) {
          if (
            v.name ==
            $(cngigprv).children(".lbx-sld-shw-imgprevw-img").attr("data-pignm")
          ) {
            files.splice(i, 1);
          } else {
            adpdtfrmdta.append("file[]", v);
          }
        });
        $(cngigprv).html("");
      }
      $(`.lbx-lrgdsplyprvig-tg`).html("");
      previmg = document.querySelectorAll(".lbx-sld-shw-imgprevw-img");
      itrt++;
      return false;
    });
  }
  $("#lbx-adnwpdt-stkstsipt").change((e) => {
    $(".lbx-pdsts-updtyp-stks")
      .text($(e.target).is(":checked") ? "In stock" : "Out of stock")
      .css("color", $(e.target).is(":checked") ? "green" : "red");
  });
  function adnwpditm() {
    if (!dlsvng) {
      var pdnm = $(".lbx-pdt-nmdsplydvbx").text(),
        pzes = document
          .querySelector(".lbx-szes-slctn-dsply")
          .querySelectorAll(".lbx-pdt-szeaded-spntg"),
        pszes = "",
        pfhr = document
          .querySelector(".lbx-pdt-fchrswrtn-dvbx")
          .querySelectorAll(".lbx-pdt-fchrspns"),
        pfhrs = "",
        prcs = "",
        tsds = "",
        mabths = $(".lbx-pdtmr-dls-dsplybx").text();
      pzes.forEach((psze, idx) => {
        if (idx > 0) {
          pszes += "/," + $(psze).children(".spnedtblsze").text().trim();
          prcs += "," + $(psze).attr("data-pce");
          tsds +=
            "," +
            $(psze).children(".spnedtblsze").text().trim() +
            ":" +
            $(psze).attr("data-slds");
        } else {
          pszes = $(psze).children(".spnedtblsze").text();
          prcs = $(psze).attr("data-pce");
          tsds =
            $(psze).children(".spnedtblsze").text() +
            ":" +
            $(psze).attr("data-slds");
        }
      });
      if (prcs == "") {
        prcs = $(".lbx-pdtprce-dsply").text();
      }
      if (tsds == "") {
        tsds = 0;
      }
      pfhr.forEach((pfr, idx) => {
        if (idx > 0) {
          pfhrs += "," + $(pfr).text().trim();
        } else {
          pfhrs = $(pfr).text().trim();
        }
      });
      var lu = new Date(),
        ludt =
          lu.getFullYear() +
          "-" +
          (lu.getMonth() + 1) +
          "-" +
          lu.getDate() +
          " " +
          lu.getHours() +
          ":" +
          lu.getMinutes() +
          ":" +
          lu.getSeconds();
      var objadpds = {
        adnwptdls: "adnwpdt",
        sid: $("#hnitsidval").val(),
        pdtnm: pdnm,
        pdsksts: $(".lbx-adnwpdt-stkstsipt").is(":checked") ? 1 : 0,
        ptqny: pszes,
        pfrs: pfhrs,
        pz: prcs,
        nmslds: tsds,
        pmabs: mabths,
        lstuts: ludt,
        tz: $("#ustzhnipt").val(),
      };
      Object.keys(objadpds).forEach((key) => {
        adpdtfrmdta.delete(key);
        adpdtfrmdta.append(key, objadpds[key]);
      });
      $.ajax({
        url: "../stsupsflr/strprdts.php",
        method: "post",
        data: adpdtfrmdta,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: () => {
          $(".lbx-adpdt-andls-btn").text("Adding...");
          dlsvng = true;
        },
        success: (data) => {
          if (data == 0) {
            showsnackpopup("Failed to add product!", true, false);
          } else if (data == "pm0") {
            showsnackpopup("Enter product name of your product!", true, "non");
            setTimeout((e) => {
              $(".lbx-adpdt-andls-btn").text("Add");
              dlsvng = false;
            }, 1500);
          } else if (data == "noacc") {
            $(".lbx-adpdt-andls-btn").text("Failed to add");
            setTimeout((e) => {
              $(".lbx-adpdt-andls-btn").text("Add");
              dlsvng = false;
            }, 1500);
            showsnackpopup(
              "You have no business account to add product!",
              true,
              false
            );
          } else {
            $(".lbx-adpdt-andls-btn").text("Added");
            showsnackpopup("Product added successfully!", true, true);
            $(".lbx-dsplr-bckbtn-dvbx").click((e) => {
              $(".lbx-adpdt-andls-btn").text("Add");
              dlsvng = false;
            });
            $.post("../stsupsflr/strprdts.php", {
              pdtad: "pshnfypdtmsg",
              s: $("#hnitsidval").val(),
              p: data.split("//(//")[1],
            });
          }
        },
        error: (data) => {
          $(".lbx-adpdt-andls-btn").text("Add");
          showsnackpopup("Sorry, Failed to add!", true, "non");
          dlsvng = false;
        },
      });
    }
  }
}
function picrszr(img) {
  var cnvs = document.createElement("canvas");
  var MAX_WIDTH = 800;
  var MAX_HEIGHT = 800;
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
function adrmptig() {
  $(document).on("change", ".lbx-rmdpdtpc-flipt", function (e) {
    e.preventDefault();
    var pstpc = $(".lbx-lrgdsplyprvig-tg .lbx-sld-shw-dsply-img"),
      psctc = $(pstpc).length ? $(pstpc).attr("src") : "";
    var property = document.querySelector(".lbx-rmdpdtpc-flipt").files[0];
    var image_name = property.name;
    var extension = image_name.split(".").pop().toLowerCase();
    if ($.inArray(extension, ["png", "jpeg", "jpg"]) == -1) {
      alert("Invalid File");
    } else {
      var gmi = document.createElement("img");
      gmi.src = URL.createObjectURL(property);
      gmi.onload = () => {
        var cnvs = picrszr(gmi);
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
              form_data.append("file", property);
              var obj1 = {
                udtpdtpcs: "treuppdtpcs",
                igtp: $(cngigprv).hasClass("lbx-pdt-lvpc")
                  ? "igfrlvml"
                  : "csulptig",
                pdpstpc: psctc,
                pdtid: $("#hdnpdvlitbx").val(),
                srid: $("#hnitsidval").val(),
              };
              Object.keys(obj1).forEach((key) =>
                form_data.append(key, obj1[key])
              );
              var adptig = (src, dtaig, isb) => {
                //   if (isb) {
                // $(".lbx-dsplr-igvwrdvbx .lbx-pdtpto-udtbns-cntngdbx").css({
                //   bottom: "633px",
                // });
                //   } else {
                $(".lbx-dsplr-igvwrdvbx .lbx-pdtpto-udtbns-cntngdbx").css({
                  bottom: "310px",
                });
                //   }
                $(`.lbx-lrgdsplyprvig-tg`).html(
                  `<img src='${src}' class='lbx-sld-shw-dsply-img'>`
                );
                if (!isb) {
                  if ($(cngigprv).attr("class") == "lbx-sld-shw-imgprevw-img") {
                    $(cngigprv).attr("src", src);
                  } else {
                    if ($(cngigprv).hasClass("lbx-pdt-lvpc")) {
                      $(
                        document.querySelector(
                          `.prdtditmnmcntnrdvbx[data-pid="${$(
                            "#hdnpdvlitbx"
                          ).val()}"]`
                        )
                      ).attr("data-lmig", src);
                      $(cngigprv).html(
                        `<div class='lbx-pdtlvig-prvwicn'><i class='fas fa-eye remindosymbols lbx-lvmdleysmblicn'></i></div><img src='${src}' class='lbx-sld-shw-imgprevw-img'>`
                      );
                    } else {
                      var upd = document.querySelector(
                        `.prdtditmnmcntnrdvbx[data-pid="${$(
                          "#hdnpdvlitbx"
                        ).val()}"]`
                      );
                      $(upd).attr("data-rpigs", dtaig);
                      $(cngigprv).html(
                        `<img src='${src}' class='lbx-sld-shw-imgprevw-img'>`
                      );
                    }
                  }
                  rptigvwr();
                  $(`.lbx-lrgdsplyprvig-tg`).html(
                    `<img src='${src}' class='lbx-sld-shw-dsply-img'>`
                  );
                }
              };
              $.ajax({
                url: "../stsupsflr/strprdts.php",
                type: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function (data) {
                  adptig(URL.createObjectURL(property), "", true);
                  $(".lbx-lrdpy-bkdrpftr-nuldvbx")
                    .text("Adding...")
                    .css("display", "flex");
                },
                success: function (data) {
                  console.log(data);
                  $(".lbx-lrdpy-bkdrpftr-nuldvbx").hide();
                  if (data.includes("e0")) {
                    alert("Select a photo to set you a pic.");
                  } else if (data.includes("e1")) {
                    alert("Please choose a valid pic.");
                  } else {
                    adptig(data.split("/|/")[0], data.split("/|/")[1], false);
                  }
                },
              });
            }
          },
          "image/jpeg",
          0.899
        );
      };
    }
  });
  $(".lbx-pdto-rmvpic-btn").click((e) => {
    var pstpc = $(".lbx-lrgdsplyprvig-tg .lbx-sld-shw-dsply-img"),
      psctc = $(pstpc).length ? $(pstpc).attr("src") : "";
    if (psctc != "") {
      $.ajax({
        url: "../stsupsflr/strprdts.php",
        type: "POST",
        data: {
          udtptrmvpcs: "trervuppdtpcs",
          pigtp: $(cngigprv).hasClass("lbx-pdt-lvpc") ? "igfrlvml" : "csulptig",
          pdpstpc: psctc,
          pdtid: $("#hdnpdvlitbx").val(),
          srid: $("#hnitsidval").val(),
        },
        beforeSend: function () {
          $(".lbx-dsplr-igvwrdvbx .lbx-pdtpto-udtbns-cntngdbx").css({
            bottom: "633px",
          });
          $(".lbx-lrdpy-bkdrpftr-nuldvbx")
            .text("Removing...")
            .css("display", "flex");
        },
        success: function (data) {
          $(".lbx-dsplr-igvwrdvbx .lbx-pdtpto-udtbns-cntngdbx").css({
            bottom: "310px",
          });
          $(".lbx-lrdpy-bkdrpftr-nuldvbx").hide();
          if (data == 0) {
            showsnackpopup(
              "Failed to remove pic! Try again later.",
              true,
              false
            );
          } else {
            if ($(cngigprv).hasClass("lbx-pdt-lvpc")) {
              $(cngigprv).html(
                "<div class='lbx-pdtlvig-prvwicn'><i class='fas fa-eye remindosymbols lbx-lvmdleysmblicn'></i></div>"
              );
              $(
                document.querySelector(
                  `.prdtditmnmcntnrdvbx[data-pid="${$("#hdnpdvlitbx").val()}"]`
                )
              ).attr("data-lmig", "");
            } else {
              $(cngigprv).html("");
              var upd = document.querySelector(
                `.prdtditmnmcntnrdvbx[data-pid="${$("#hdnpdvlitbx").val()}"]`
              );
              $(upd).attr("data-rpigs", data);
            }
            $(".lbx-lrgdsplyprvig-tg .lbx-sld-shw-dsply-img").remove();
            previmg = document.querySelectorAll(".lbx-sld-shw-imgprevw-img");
          }
        },
      });
    }
  });
}
$(".prewvdobtn").click((e) => {
  ebdyt("prv");
  $(".strwchvdoytb").show();
});
$(".stpvdocncl").click(() => {
  $(".strwchvdoytb .popupcontentcontainerbox").html("");
});
var $adclck = false;
$(".adebdlnkbn").click(() => {
  ebdyt("adlnk");
});
function ebdyt($acbn) {
  var lnk = $("#ytblnkipt").val();
  var ylnk = lnk
    .replace("youtu.be", "youtube.com/embed")
    .replace("watch?v=", "embed/")
    .replace("//m.", "//")
    .replace("?t=", "?start=");
  var ytvsrt = $("#ytvdostrtatipt").val();
  ytvsrt = ytvsrt.split(":");
  ytvsrt = parseInt(ytvsrt[0]) * 60 + parseInt(ytvsrt[1]);
  ylnk = ylnk + "?start=" + ytvsrt;
  var w = window.innerWidth < 600 ? window.innerWidth - 60 : 600;
  var h = (w * 9) / 16;
  if ($acbn == "prv") {
    $(".strwchvdoytb .popupcontentcontainerbox").html(
      `<iframe width='${w}' height='${h}' src='${ylnk}' id='myFrame' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>`
    );
  } else if ($acbn == "adlnk") {
    if (!$adclck) {
      $.ajax({
        url: "http://localhost/remindo/stsupsflr/strprdts",
        method: "post",
        data: {
          udtedslks: "treysulks",
          p: $("#hdnpdvlitbx").val(),
          s: $("#hnitsidval").val(),
          l: ylnk,
        },
        beforeSend: () => {
          $adclck = true;
          $(".adebdlnkbn").text("Adding...");
        },
        success: (data) => {
          if (data == "1") {
            $(".adebdlnkbn").text("Added");
            showsnackpopup("Added successfully!", true, true);
            setTimeout(() => {
              $(".adebdlnkbn").text("Add");
              $adclck = false;
            }, 3000);
          } else {
            $adclck = false;
            showsnackpopup("Something went wrong! Failed to add.", true, "non");
            $(".adebdlnkbn").text("Add");
          }
        },
        error: () => {
          $adclck = false;
          $(".adebdlnkbn").text("Add");
          showsnackpopup("Something went wrong! Failed to add.", true, "non");
        },
      });
    }
  }
}
//ytp-time-current - for getting current time. - class
//video-stream html5-main-video - for video -class
//https://youtu.be/QqBdOmOU0fk
