$(document).ready(() => {
  if (window.innerWidth <= 500) {
    $(".cmn-lbx-pdt-dsplyr-cntngdvbx").css("height", window.innerHeight);
  }
});
var cngigprv = "";
var previmg = document.querySelectorAll(".lbx-sld-shw-imgprevw-img");
rptigvwr();
function rptigvwr() {
  $(
    ".lbx-iothpcs-rltosldsh-pxs,.lbx-sld-shw-imgprevw-img,.lbx-sldshw-nt-chrvn-btn,.lbx-sldshw-pew-chrvn-btn"
  ).unbind();
  var pvigbx = document.querySelectorAll(".lbx-iothpcs-rltosldsh-pxs");
  previmg = document.querySelectorAll(".lbx-sld-shw-imgprevw-img");
  var nxtimg = document.querySelectorAll(".lbx-sldshw-nt-chrvn-btn");
  var lstimg = document.querySelectorAll(".lbx-sldshw-pew-chrvn-btn");
  var smligprvbx = $(".lbx-iothpcs-rltosldsh-pxs");
  var imgcont = 0;
  if (pvigbx.length == 5) {
    $(".lbx-iothpcs-rltosldsh-pxs").css("height", "53px");
  }
  if (previmg.length > 0) {
    $(".lbx-lrgdsplyprvig-tg").html(
      `<img src='${previmg[0].getAttribute(
        "src"
      )}' class='lbx-sld-shw-dsply-img'>`
    );
    $(".lbx-pdtpto-udtbns-cntngdbx").hide();
    cngigprv = $(pvigbx[0]);
  } else {
    cngigprv = $(pvigbx[0]);
    $(".lbx-lrgdsplyprvig-tg").html("");
    $(".lbx-pdtpto-udtbns-cntngdbx").show();
  }
  $(previmg[0]).parent().css("opacity", "1");
  pvigbx.forEach((ibox, idx) => {
    if (
      $(".lbx-sld-shw-dsply-img").attr("src") ==
      $(ibox).children(".lbx-sld-shw-imgprevw-img").attr("src")
    ) {
      cngigprv = ibox;
    }
    $(ibox).click((e) => {
      cngigprv = ibox;
      var iginbx = (img) => {
        $(".lbx-lrgdsplyprvig-tg").html(
          `<img src='${$(img).attr("src")}' class='lbx-sld-shw-dsply-img'>`
        );
        imgcont = idx;
        $(smligprvbx).css("opacity", "0.8");
        $(img).parent().css("opacity", "1");
        $(".lbx-pdtpto-udtbns-cntngdbx").hide();
        $(".lbx-pdtlvmdl-pto-txrdvbx").hide();
        if ($(ibox).hasClass("lbx-pdt-lvpc")) {
          $(".lbx-pdtlvmdl-pto-txrdvbx").show();
        }
      };
      var iginobx = () => {
        $(".lbx-lrgdsplyprvig-tg").html("");
        $(".lbx-pdtpto-udtbns-cntngdbx").show();
        $(".lbx-pdtlvmdl-pto-txrdvbx").hide();
        if ($(ibox).hasClass("lbx-pdt-lvpc")) {
          $(".lbx-pdtlvmdl-pto-txrdvbx").show();
        }
      };
      var img = $(e.target).children(".lbx-sld-shw-imgprevw-img");
      if ($(e.target).attr("class") == "lbx-sld-shw-imgprevw-img") {
        img = $(e.target);
        iginbx(img);
      } else if ($(e.target).hasClass("lbx-lvmdleysmblicn")) {
        img = $(e.target).parent().siblings(".lbx-sld-shw-imgprevw-img");
        if ($(img).length != 0) {
          iginbx(img);
        } else {
          iginobx();
        }
      } else {
        iginobx();
      }
    });
  });
  $(nxtimg).click(() => {
    if (previmg.length > 0) {
      if (imgcont >= previmg.length - 1) {
        imgcont = -1;
      }
      $(".lbx-lrgdsplyprvig-tg").html(
        `<img src='${previmg[imgcont + 1].getAttribute(
          "src"
        )}' class='lbx-sld-shw-dsply-img'>`
      );
      cngigprv = $(previmg[imgcont + 1]).parent();
      $(".lbx-pdtlvmdl-pto-txrdvbx").hide();
      if ($(cngigprv).hasClass("lbx-pdt-lvpc")) {
        $(".lbx-pdtlvmdl-pto-txrdvbx").show();
      }
      $(smligprvbx).css("opacity", "0.8");
      $(previmg[imgcont + 1])
        .parent()
        .css("opacity", "1");
      $(".lbx-pdtpto-udtbns-cntngdbx").hide();
      imgcont += 1;
    } else {
      $(".lbx-lrgdsplyprvig-tg").html("");
      $(".lbx-pdtpto-udtbns-cntngdbx").show();
    }
  });
  $(".lbx-pdtpto-udtbns-cntngdbx").click((e) => {
    $(".lbx-pdtpto-udtbns-cntngdbx").hide();
  });
  $(".lbx-lrgdsplyprvig-tg").click((e) => {
    $(".lbx-pdtpto-udtbns-cntngdbx").show();
  });
  $(".lbx-lrdpy-bkdrpftr-nuldvbx").click((e) => {
    $(".lbx-dsplr-igvwrdvbx .lbx-pdtpto-udtbns-cntngdbx").css({
      bottom: "633px",
    });
    $(".lbx-pdtpto-udtbns-cntngdbx").show();
  });
  $(".lbx-pdto-rmvpic-bt").click((e) => {
    $(cngigprv).html("");
    $(".lbx-lrgdsplyprvig-tg .lbx-sld-shw-dsply-img").remove();
    previmg = document.querySelectorAll(".lbx-sld-shw-imgprevw-img");
  });
  $(lstimg).click(() => {
    if (previmg.length > 0) {
      if (imgcont <= 0) {
        imgcont = previmg.length;
      }
      $(".lbx-lrgdsplyprvig-tg").html(
        `<img src='${previmg[imgcont - 1].getAttribute(
          "src"
        )}' class='lbx-sld-shw-dsply-img'>`
      );
      cngigprv = $(previmg[imgcont - 1]).parent();
      $(".lbx-pdtlvmdl-pto-txrdvbx").hide();
      if ($(cngigprv).hasClass("lbx-pdt-lvpc")) {
        $(".lbx-pdtlvmdl-pto-txrdvbx").show();
      }
      $(smligprvbx).css("opacity", "0.8");
      $(previmg[imgcont - 1])
        .parent()
        .css("opacity", "1");
      $(".lbx-pdtpto-udtbns-cntngdbx").hide();
      imgcont -= 1;
    } else {
      $(".lbx-lrgdsplyprvig-tg").html("");
      $(".lbx-pdtpto-udtbns-cntngdbx").show();
    }
  });
}

$(document).ready(() => {
  if (
    window.location.pathname == "/shared" ||
    window.location.pathname == "/shared.php"
  ) {
    opndsply(true, true);
  }
  $(".coumhebn").click((e) => {
    uvm("m", $(e.target).attr("data-sid"), $(e.target).attr("data-pid"));
  });
});
var dynmcpnmchngr = "",
  dmcmthschngr = "",
  dycfhrvldtr = "";
$(document).ready(() => {
  $(".cmn-lbx-pdt-dsplyr-cntngdvbx").append(`
 <div class="lbx-bg-igdsplyrdvbx">
   <div class="lbxbnstpnavbr">
     <div class="extlbxbtn">
       <i class="fas fa-chevron-left" style="font-size: 23px"></i>
       <span>Back</span>
     </div>
   </div>
   <div class="lbxmandsplypiccntngdvbx">
     <img
       class="mindsplyigdvb"
       id="target"
     />
   </div>
   <div class="lbxothrigscntngdvbx"></div>
 </div>`);
  $(".lbx-pdt-dnmc-cntetbls")
    .focus((e) => {
      $(e.target)
        .parent()
        .parent()
        .parent()
        .css("position", "absolute")
        .css("z-index", "100")
        .css("top", "100px")
        .css("background", "white")
        .css("box-shadow", "#00000078 0px 0px 0px 1000px")
        .css({ "min-width": "200px", "max-width": "100%" });
    })
    .blur((e) => {
      $(e.target)
        .parent()
        .parent()
        .parent()
        .css("position", "static")
        .css("z-index", "0")
        .css("box-shadow", "0 0 0 black")
        .css("top", "none")
        .css({ "min-width": "fit-content", "max-width": "100%" });
    });
  $(".lbx-dsplr-bckbtn-dvbx").click(() => {
    $(".cmn-lbx-pdt-dsplyr-cntngdvbx,.cmn-lbx-bckgrond-cntngdvbx").hide();
  });
  $(".lbx-adpdt-qty-inc-btn").click(() => {
    ckcknmrs("ic");
  });
  $(".lbx-adpdt-qty-dec-btn").click(() => {
    ckcknmrs("dc");
  });
  $(".lbx-nedqty-bx").keyup(() => {
    ckcknmrs("it");
  });
  function ckcknmrs(clktyp) {
    var itqy = parseInt($(".lbx-nedqty-bx").val());
    if (itqy == "" || itqy == undefined || isNaN(itqy)) {
      return $(".lbx-nedqty-bx").val(1);
    }
    if (clktyp == "ic") {
      var q = itqy + 1;
      if (q <= 0) {
        q = 1;
      }
    } else if (clktyp == "dc") {
      var q = itqy - 1;
      if (q <= 0) {
        q = 1;
      }
    } else if (clktyp == "it") {
      var q = itqy;
      if (q <= 0) {
        q = 1;
      }
    }
    return $(".lbx-nedqty-bx").val(q);
  }
  var pnm = "",
    sze = "",
    frs = "",
    prc = "",
    mabt = "";
  svpdls = null;
  dlsvng = false;
  $(".lbx-pn-shwedls-icnbtn").click((e) => {
    $(".lbx-pdt-stketandothbns-cntngdvbx").hide();
    $(".lbx-pdt-edbns-cntng-dvbx").css({ display: "flex" });
    $(".lbx-pdt-dnmc-cntetbls")
      .addClass("edtbltgs")
      .attr("contenteditable", "true");
    $(".rmvftchr").css("display", "flex");
    $(
      ".lbx-pdt-adszbtninszedsply-dvbx,.rmvaddsze,.lbx-dvedbl-mntrng-spntgs"
    ).show();
    pnm = $(".lbx-pdt-nmdsplydvbx").html();
    sze = $(".lbx-szes-slctn-dsply").html();
    frs = $(".lbx-pdt-fchrswrtn-dvbx").html();
    prc = $(".lbx-pdtprce-dsply").html();
    mabt = $(".lbx-pdtmr-dls-dsplybx").html();
    mbthscrvdn(e);
    pdtnmvldtn(e);
    addszebns(false);
  });
  $(".lbx-pdtls-dscrd-btn").click(() => {
    if (svpdls) {
      svpdls.abort();
      dlsvng = false;
    }
    $(".lbx-pdtls-sve-btn").text("Save");
    $(".lbx-pdt-nmdsplydvbx").html(pnm);
    $(".lbx-szes-slctn-dsply").html(sze);
    $(".lbx-pdt-fchrswrtn-dvbx").html(frs);
    $(".lbx-pdtprce-dsply").html(prc);
    $(".lbx-pdtmr-dls-dsplybx").html(mabt);
    $(".lbx-pdt-stketandothbns-cntngdvbx").css({ display: "flex" });
    $(".lbx-pdt-edbns-cntng-dvbx,.lbx-dvedbl-mntrng-spntgs").hide();
    $(".lbx-pdt-dnmc-cntetbls")
      .removeClass("edtbltgs")
      .attr("contenteditable", "false");
    $(".rmvftchr,.rmvaddsze,.lbx-pdt-adszbtninszedsply-dvbx").hide();
    addszebns(true);
  });
  $(".lbx-pdtls-sve-btn").click((e) => {
    var nrmlui = (svd) => {
      var edblbn = () => {
        $(".lbx-pdt-stketandothbns-cntngdvbx").css({ display: "flex" });
        $(".lbx-pdt-edbns-cntng-dvbx").hide();
      };
      if (svd) {
        $(".lbx-pdtls-dscrd-btn").hide();
        setTimeout(() => {
          edblbn();
          $(".lbx-pdtls-dscrd-btn").show();
        }, 1500);
      } else {
        edblbn();
      }
      $(".lbx-pdt-dnmc-cntetbls")
        .removeClass("edtbltgs")
        .attr("contenteditable", "false");
      $(
        ".lbx-dvedbl-mntrng-spntgs,.rmvftchr,.rmvaddsze,.lbx-pdt-adszbtninszedsply-dvbx"
      ).hide();
    };
    if (
      pnm == $(".lbx-pdt-nmdsplydvbx").html() &&
      sze == $(".lbx-szes-slctn-dsply").html() &&
      frs == $(".lbx-pdt-fchrswrtn-dvbx").html() &&
      prc == $(".lbx-pdtprce-dsply").html() &&
      mabt == $(".lbx-pdtmr-dls-dsplybx").html()
    ) {
      nrmlui(false);
      showsnackpopup("You have made no changes!", true, "non");
    } else {
      if (!dlsvng) {
        var pdnm = $(".lbx-pdt-nmdsplydvbx").text(),
          pzes = document
            .querySelector(".lbx-szes-slctn-dsply")
            .querySelectorAll(".lbx-pdt-szeaded-spntg"),
          pszes = "",
          tsds = "",
          pfhr = document
            .querySelector(".lbx-pdt-fchrswrtn-dvbx")
            .querySelectorAll(".lbx-pdt-fchrspns"),
          pfhrs = "",
          prcs = "",
          mabths = $(".lbx-pdtmr-dls-dsplybx").html();
        mabths = mabths
          .replace(/<\/?div[^>]*>/gi, "/br/")
          .replace(/<\/?li[^>]*>/gi, "/br/")
          .replace(/<div>/gi, "/br/")
          .replace(/<li>/gi, "/br/")
          .replace(/<\/?ul[^>]*>/gi, "")
          .replace(/<\/?span[^>]*>/g, "")
          .replace(new RegExp("</div>", "gi"), "")
          .replace(new RegExp("</li>", "gi"), "")
          .replace(new RegExp("</span>", "gi"), "")
          .replace(new RegExp("</ul>", "gi"), "")
          .replace(new RegExp("</br>", "gi"), "/br/")
          .replace(new RegExp("<br>", "gi"), "");
        console.log(mabths);
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
        svpdls = $.ajax({
          url: "../stsupsflr/strprdts.php",
          method: "post",
          data: {
            nwedtdpdls: "etpdls",
            pid: $("#hdnpdvlitbx").val(),
            sid: $("#hnitsidval").val(),
            pdtnm: pdnm,
            ptqny: pszes,
            pfrs: pfhrs,
            pz: prcs,
            nmslds: tsds,
            pmabs: mabths,
            lstuts: ludt,
            tz: $("#ustzhnipt").val(),
          },
          beforeSend: (prgrs) => {
            $(".lbx-pdtls-sve-btn").text("Saving...");
            dlsvng = true;
          },
          success: (data) => {
            var quantity = ["Variant", "Quantity", "Size"],
              ctg = $(".lbx-pdt-dls-dsplr-dvbx").attr("data-ctg"),
              $sctgs = ["Electronics", "Grocery Store", "Clothing & Textile"];
            if (data == "epty") {
              showsnackpopup(
                `Product name, ${
                  $sctgs.includes(ctg)
                    ? quantity[$sctgs.indexOf(ctg)]
                    : "Variant"
                }, price details cannot be empty!`,
                true,
                "non"
              );
              $(".lbx-pdtls-sve-btn").text("Save");
              dlsvng = false;
              showsnackpopup(
                "Product details updated successfully!",
                true,
                true
              );
            } else if (data != 0) {
              $(".lbx-pdtls-sve-btn").text("Saved");
              $(`.prdtditmnmcntnrdvbx[data-pid="${$("#hdnpdvlitbx").val()}"]`)
                .attr("data-tle", pdnm)
                .attr("data-pce", prcs)
                .attr("data-szs", pszes)
                .attr("data-pfcrs", pfhrs)
                .attr("data-dcptn", mabths)
                .text(pdnm)
                .parent()
                .parent()
                .parent(".strprdtdtlsandupdtbtnscntngdvbx")
                .siblings(".prdtlstupdttmpstbdvbx")
                .children(".pdtstmstp")
                .text("Just now");
              setTimeout((e) => {
                $(".lbx-pdtls-sve-btn").text("Save");
                dlsvng = false;
              }, 1500);
              nrmlui(true);
              showsnackpopup(
                "Product details updated successfully!",
                true,
                true
              );
            } else {
              showsnackpopup("Failed to update product details.", true, false);
            }
          },
        });
      }
    }
  });
  $(".lbx-pdt-fchrswrtn-dvbx").focus((e) => {
    if (!$(e.target).children(".lbx-fcs").length) {
      $(".lbx-pdt-fchrswrtn-dvbx").append("<span class='lbx-fcs'> </span>");
    }
  });
  $(".lbx-pdt-fchrswrtn-dvbx").blur((e) => {
    if ($(e.target).children(".lbx-fcs").length) {
      $(".lbx-pdt-fchrswrtn-dvbx .lbx-fcs").remove();
    }
  });
  $(".lbx-pdt-nmdsplydvbx")
    .keydown(pdtnmvldtn)
    .blur((e) => {
      if ($(".lbx-pdt-nmdsplydvbx").text().length > 100) {
        $(".lbx-pdt-nmdsplydvbx").text(dynmcpnmchngr);
      }
    });
  $(".lbx-pdtprce-dsply").keydown((e) => {
    var onm = e.which ? e.which : e.keyCode;
    if (
      onm == 190 ||
      onm == 37 ||
      onm == 39 ||
      onm == 8 ||
      (onm >= 48 && onm <= 57)
    ) {
      var ptpr = $(".lbx-pdtprce-dsply").text();
      ptprcvldtn();
      if (ptpr.length <= 7) {
        return true;
      } else {
        if (onm != 37 && onm != 39 && onm != 8) {
          showsnackpopup(
            "Your product price can not be more than 7 characters!",
            true,
            false
          );
          return false;
        } else {
          return true;
        }
      }
    }
    return false;
  });
  function ptprcvldtn() {
    var ptpr = $(".lbx-pdtprce-dsply").text();
    ptpr = ptpr.split(",");
    ptpc = "";
    ptpr.forEach((ppr) => {
      ptpc += ppr;
    });
    if (isNaN(ptpc)) {
      $(".lbx-pdtprce-dsply").text(0);
    }
  }
  function pdtnmvldtn(e) {
    var ptnm = $(".lbx-pdt-nmdsplydvbx").text();
    $(".lbx-ptnme-cotmnrtngdvbx .lbx-alnmctrs-mnrtd-spn").text(
      `${ptnm.length}/100`
    );
    if (ptnm.length >= 100) {
      if (e.keyCode != 8 || e.which != 8) {
        showsnackpopup(
          "Your product name reached 100 characters!",
          true,
          false
        );
        return false;
      } else {
        return true;
      }
    } else {
      dynmcpnmchngr = ptnm;
      return true;
    }
  }
  var fhrfst = true;
  $(".lbx-pdt-fchrswrtn-dvbx")
    .keyup((e) => {
      //   if (e.keyCode == 188 || e.which == 188) {
      //     fhrvldtn(e);
      //   }
      if ($(e.target).text().includes(",")) {
        return fhrvldtn(e);
      }
    })
    .focus((e) => {
      if (fhrfst) {
        fhrfst = false;
        fhrvldtn(e);
      }
    });
  function fhrvldtn(e) {
    var alftrs = document
      .querySelector(".lbx-pdt-fchrswrtn-dvbx")
      .querySelectorAll(".lbx-pdt-fchrspns");
    alftrs.forEach((ftg) => {
      $(ftg).text($(ftg).text() + ",");
    });
    var ttocnvrt = $(".lbx-pdt-fchrswrtn-dvbx").text().trim();
    var ttspn = ttocnvrt.split(",");
    if (ttspn.length > 11) {
      ttspn = dycfhrvldtr;
      showsnackpopup("You can only add 10 features to a product!", true, false);
    } else {
      dycfhrvldtr = ttspn;
    }
    $(".lbx-pdt-fchrswrtn-dvbx").html(
      `<span class='lbx-pdt-fchrspns'>${ttspn[0]}<i class='fas fa-times remindosymbols rmvftchr' contenteditable='false'></i></span>`
    );
    $(".lbx-ptfhrs-cotmnrtngdvbx .lbx-alfhrs-mnrtd-spn").text(
      `${ttspn.length - 1}/10`
    );
    for (var f = 1; f <= ttspn.length - 2; f++) {
      $(".lbx-pdt-fchrswrtn-dvbx").append(
        `<span class='lbx-pdt-fchrspns'>${ttspn[f]}<i class='fas fa-times remindosymbols rmvftchr' contenteditable='false'></i></span>`
      );
    }
    if (!$(".lbx-pdt-fchrswrtn-dvbx").children(".lbx-fcs").length) {
      $(".lbx-pdt-fchrswrtn-dvbx").append("<span class='lbx-fcs'> </span>");
    }
    $(".lbx-pdt-fchrspns .rmvftchr").css("display", "block");
    $(".rmvftchr").click((e) => {
      $(e.target).parent().remove();
      $(".lbx-ptfhrs-cotmnrtngdvbx .lbx-alfhrs-mnrtd-spn").text(
        `${
          $(".lbx-ptfhrs-cotmnrtngdvbx .lbx-alfhrs-mnrtd-spn")
            .text()
            .split("/")[0] - 1
        }/10`
      );
    });
  }
  $(".lbx-pdtmr-dls-dsplybx")
    .keydown(mbthscrvdn)
    .keyup(mbthscrvdn)
    .blur((e) => {
      var mrabths = $(".lbx-pdtmr-dls-dsplybx").text();
      if (mrabths.length > 1000) {
        $(".lbx-pdtmr-dls-dsplybx").text(dmcmthschngr);
      }
    });
});
function frmatfchrs($isgl, $ninf) {
  var ttocnvrt = $(".lbx-pdt-fchrswrtn-dvbx").text().trim();
  var ttspn = ttocnvrt.split(",");
  ttspn.forEach((ttsp, idx) => {
    if (idx > 0) {
      $(".lbx-pdt-fchrswrtn-dvbx").append(
        `<span class='lbx-pdt-fchrspns'>${ttsp}<i class='fas fa-times remindosymbols rmvftchr' contenteditable='false'></i></span>`
      );
    } else {
      $(".lbx-pdt-fchrswrtn-dvbx").html(
        `<span class='lbx-pdt-fchrspns'>${ttsp}<i class='fas fa-times remindosymbols rmvftchr' contenteditable='false'></i></span>`
      );
    }
  });
  var alpgs = $(".lbx-igpcs-rltdtosldshw-dsplr-dbx")
    .attr("data-pigs")
    .split("/,");
  var pvigbx = document.querySelectorAll(
    ".lbx-igpcs-rltdtosldshw-dsplr-dbx .lbx-pt-pvigs"
  );
  pvigbx.forEach((ig, idx) => {
    if (alpgs[idx] != undefined && alpgs[idx] != "") {
      $(ig).html(
        `<img src='${
          $ninf ? "strpdtspcs" : "http://localhost/remindo/strpdtspcs"
        }/${alpgs[idx]}' class='lbx-sld-shw-imgprevw-img' >`
      );
    } else {
      $(ig).html("");
    }
  });
  var tcnvrtsze = $(".lbx-szes-slctn-dsply")
    .attr("data-aszs")
    .trim()
    .split("/,");
  var cvrtprce = $(".lbx-szes-slctn-dsply")
    .attr("data-aspce")
    .trim()
    .split(",");
  var cnrtslds = $(".lbx-szes-slctn-dsply")
    .attr("data-tslds")
    .trim()
    .split(",");

  $(".lbx-dsplyr-tphdr-ctngdvbx").attr("data-csz", tcnvrtsze[0]);
  $(".lbx-pdtisgts-sld-spn").text(cnrtslds[0].split(":")[1]);
  tcnvrtsze.forEach((tcnvrtse, idx) => {
    var szehtg = `<span class='lbx-pdt-szeaded-spntg' data-pce='${
      cvrtprce[idx] == undefined ? 0 : cvrtprce[idx]
    }' data-slds='${
      cnrtslds[idx] != undefined
        ? cnrtslds[idx].split(":")[1] == undefined
          ? 0
          : cnrtslds[idx].split(":")[1]
        : ""
    }'><input type='radio' name='szerdo' class='rdo-sze-slct' value='${tcnvrtse}'><span class='spnedtblsze lbx-pdt-dnmc-cntetbls'>${tcnvrtse}</span><i class='fas fa-times remindosymbols rmvaddsze' style='display:none;'></i></span>`;
    if (idx > 0) {
      $(".lbx-szes-slctn-dsply").append(szehtg);
    } else {
      $(".lbx-szes-slctn-dsply").html(szehtg);
    }
  });
}
var aszes = document
  .querySelector(".lbx-szes-slctn-dsply")
  .querySelectorAll(".lbx-pdt-szeaded-spntg");
var atse = "";
$(document).ready(() => {
  $(".lbx-pdt-adszbtninszedsply-dvbx").click((e) => {
    $(".lbx-szes-slctn-dsply").append(
      `<span class='lbx-pdt-szeaded-spntg' data-pce='0' data-slds='0'><input type='radio' name='szerdo' class='rdo-sze-slct' value=''><span class='spnedtblsze lbx-pdt-dnmc-cntetbls edtbltgs' contenteditable='true'></span><i class='fas fa-times remindosymbols rmvaddsze' style='display:flex;'></i></span>`
    );
    $(".rdo-sze-slct").click();
    $(".spnedtblsze").focus();
    $(".lbx-pdtprce-dsply").text(0);
    atse = aszes.length;
    addszebns(false);
  });
  $(".lbx-pdtprce-dsply").keyup((e) => {
    var dtpc = $(".lbx-pdtprce-dsply").text();
    if (atse >= 0) {
      $(aszes[atse]).attr("data-pce", dtpc);
    }
  });
});
function addszebns(isfpt) {
  $(
    ".lbx-szes-slctn-dsply,.lbx-pdt-szeaded-spntg,.rmvaddsze,.rdo-sze-slct,.spnedtblsze"
  ).unbind();
  $(".spnedtblsze").keydown((e) => {
    var onm = e.which ? e.which : e.keyCode;
    if (onm != "186" && onm != "188") {
      if ($(e.target).text().length <= 20) {
        $(e.target).siblings(".rdo-sze-slct").val($(e.target).text());
        return true;
      } else {
        showsnackpopup(
          "You can not exceed more than 20 characters!",
          true,
          false
        );
        if (onm == "8" || onm == "37" || onm == "39") {
          $(e.target).siblings(".rdo-sze-slct").val($(e.target).text());
          return true;
        }
        return false;
      }
    } else {
      showsnackpopup(": and , These characters is invalid.", true, false);
      return false;
    }
    // return false;
  });
  aszes = document
    .querySelector(".lbx-szes-slctn-dsply")
    .querySelectorAll(".lbx-pdt-szeaded-spntg");
  aszes.forEach((sze, idx) => {
    $(sze)
      .click((e) => {
        atse = idx;
        $(e.target).children(".rdo-sze-slct").click();
        $(".lbx-pdtprce-dsply").text($(sze).attr("data-pce"));
        $(".lbx-pdtisgts-sld-spn").text($(sze).attr("data-slds"));
      })
      .children(".rdo-sze-slct,.spnedtblsze")
      .click((e) => {
        atse = idx;
        $(e.target).siblings(".rdo-sze-slct").click();
        $(".lbx-pdtprce-dsply").text($(sze).attr("data-pce"));
        $(".lbx-pdtisgts-sld-spn").text($(sze).attr("data-slds"));
        var ckpad = $(".lbx-dsplyr-tphdr-ctngdvbx").attr("data-adpd");
        var rplcsz = $(".lbx-dsplyr-tphdr-ctngdvbx").attr("data-csz");
        if ($(".nwryllstofnwodr").length) {
          if (
            $(
              `.nwryllstofnwodr [data-pd="${ckpad.replace(
                rplcsz,
                $(e.target)
                  .closest(".lbx-pdt-szeaded-spntg")
                  .children(".spnedtblsze")
                  .text()
              )}"]`
            ).length
          ) {
            $(".lbxpthlfcmncls.pdtadtolstbtn.lbx-adto-lst-btn").text("Remove");
          } else {
            $(".lbxpthlfcmncls.pdtadtolstbtn.lbx-adto-lst-btn").text("Add");
          }

          $(".lbx-dsplyr-tphdr-ctngdvbx").attr(
            "data-csz",
            $(e.target)
              .closest(".lbx-pdt-szeaded-spntg")
              .children(".spnedtblsze")
              .text()
          );
          $(".lbx-dsplyr-tphdr-ctngdvbx").attr(
            "data-adpd",
            ckpad.replace(
              rplcsz,
              $(e.target)
                .closest(".lbx-pdt-szeaded-spntg")
                .children(".spnedtblsze")
                .text()
            )
          );
        }
      });
    $(sze)
      .children(".rmvaddsze")
      .click((e) => {
        $(e.target).parent().remove();
        if (idx >= 0) {
          var trvs = idx - 1 > 0 ? idx - 1 : idx + 1;
          atse = trvs;
          $(aszes[trvs])
            .children(".spnedtblsze")
            .focus()
            .siblings(".rdo-sze-slct")
            .click();
        }
        szevldtn();
      });
  });
  if (!isfpt) {
    szevldtn();
  }
  function szevldtn() {
    var tlszes = document
      .querySelector(".lbx-szes-slctn-dsply")
      .querySelectorAll(".lbx-pdt-szeaded-spntg");
    $(".lbx-ptszes-cotmnrtngdvbx .lbx-alszes-mnrtd-spn").text(
      `${tlszes.length}/15`
    );
    if (tlszes.length >= 15) {
      $(".lbx-pdt-adszbtninszedsply-dvbx").hide();
    } else {
      $(".lbx-pdt-adszbtninszedsply-dvbx").show();
    }
  }
}
function mbthscrvdn(e) {
  var mrabths = $(".lbx-pdtmr-dls-dsplybx").text();
  if (mrabths.length > 1000) {
    if (e.keyCode != 8 || e.which != 8) {
      showsnackpopup("You reached 1000 characters!", true, false);
      return false;
    } else {
      return true;
    }
  } else {
    $(".lbx-mbtns-cotmnrtngdvbx .lbx-alwdsmbths-mnrtd-spn").text(
      `${mrabths.length}/1000`
    );
    dmcmthschngr = mrabths;
    return true;
  }
}
function uvm(vom, s, p) {
  $.ajax({
    url: "http://localhost/remindo/stsupsflr/strprdts",
    method: "post",
    data: { uptvom: "treuptvom", s: s, p: p, vom: vom },
  });
}
$(".stpvdocncl").click(() => {
  $(".strwchvdoytb .popupcontentcontainerbox").html("");
});
$(".wchebdytvdo").click((e) => {
  var ylnk = $(e.target).closest(".wchebdytvdo").attr("data-vul");
  var w = window.innerWidth < 600 ? window.innerWidth - 60 : 600;
  var h = (w * 9) / 16;
  $(".strwchvdoytb .popupcontentcontainerbox").html(
    `<iframe width='${w}' height='${h}' src='${ylnk}' id='myFrame' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>`
  );
  $(".strwchvdoytb").show();
});
function opndsply($isgl, $ninf) {
  $(".prdtditmnmcntnrdvbx,.lbx-dsplr-nxtpdt-vwbtn").unbind();
  var isckd = "checked";
  var lbxcnts = (e) => {
    var lbximt = $(e).closest(".prdtditmnmcntnrdvbx");
    $(".lbx-pdt-nmdsplydvbx").text($(lbximt).attr("data-tle"));
    $(".lbx-pdtmr-dls-dsplybx").html(
      $(lbximt).attr("data-dcptn").replace(new RegExp("/br/", "gi"), "<br>")
    );
    $("#hdnpdvlitbx").val($(lbximt).attr("data-pid"));
    $(".lbx-dsplyr-tphdr-ctngdvbx").attr("data-pd", $(lbximt).attr("data-pid"));
    $(".lbx-pdsts-updtyp-stks")
      .text($(lbximt).attr("data-istk"))
      .css(
        "color",
        `${$(lbximt).attr("data-istk") == "In stock" ? "green" : "red"}`
      );
    $("#ytblnkipt").val($(lbximt).attr("data-ebdlk").split("?start=")[0]);
    var stm = $(lbximt).attr("data-ebdlk").split("?start=")[1];
    function fmtMSS(s) {
      return (s - (s %= 60)) / 60 + (9 < s ? ":" : ":0") + s;
    }
    $("#ytvdostrtatipt").val(
      stm != "" && stm != 0 && stm != undefined ? fmtMSS(stm) : "0:00"
    );
    if (
      $(lbximt).attr("data-ebdlk") != 0 &&
      $(lbximt).attr("data-ebdlk").trim() != "" &&
      $(lbximt).attr("data-ebdlk") != undefined
    ) {
      $(".wchebdytvdo").attr("data-vul", $(lbximt).attr("data-ebdlk"));
      $(".wchvdobnctngdvbx").show();
    } else {
      $(".wchvdobnctngdvbx").hide();
    }
    if (
      $(`.nwryllstofnwodr [data-pd="${$(lbximt).attr("data-adpdck")}"]`).length
    ) {
      $(".lbxpthlfcmncls.pdtadtolstbtn.lbx-adto-lst-btn").text("Remove");
    } else {
      $(".lbxpthlfcmncls.pdtadtolstbtn.lbx-adto-lst-btn").text("Add");
    }
    if ($(lbximt).attr("data-istk") == "In stock") {
      $(
        ".lbxpthlfcmncls.pdtadtolstbtn.lbx-adto-lst-btn,.lbx-qtyctngdvbx"
      ).show();
    } else if ($(lbximt).attr("data-istk") == "Out of stock") {
      $(
        ".lbxpthlfcmncls.pdtadtolstbtn.lbx-adto-lst-btn,.lbx-qtyctngdvbx"
      ).hide();
    }
    if ($(".lbx-csmrorstr-dtls-dsply-cntngdvbx").length) {
      var pnt = $(".lbx-csmrorstr-dtls-dsply-cntngdvbx");
      $(pnt)
        .children(".lbx-cmsrsr-pflpc-dsply")
        .html(
          $(lbximt).attr("data-srpc") != "" &&
            $(lbximt).attr("data-srpc") != undefined
            ? `<img src='${$(lbximt).attr(
                "data-srpc"
              )}' class='lbx-cmsrscr-pfig'>`
            : ""
        );
      $(pnt)
        .children(".lbx-cmrsr-pfldls")
        .children()
        .children(".lbx-srctgredsply")
        .text($(lbximt).attr("data-srcgr"));
      $(pnt)
        .children(".lbx-cmrsr-pfldls")
        .children(".srcmrtxtdls")
        .text($(lbximt).attr("data-srnm"));
      $(pnt)
        .children(".lbx-cmrsr-pfldls")
        .children(".lbx-srcmr-pfunm")
        .text($(lbximt).attr("data-srunm"));
    }
    $(".lbx-pdtlst-updt-tmshwn").text($(lbximt).attr("data-luptd"));
    $(".lbx-pdt-stketandothbns-cntngdvbx").css({ display: "flex" });
    $(".lbx-pdt-edbns-cntng-dvbx,.lbx-dvedbl-mntrng-spntgs").hide();
    $(".lbx-pdt-dnmc-cntetbls")
      .removeClass("edtbltgs")
      .attr("contenteditable", "false");
    $(".lbx-dsplyr-tphdr-ctngdvbx").attr(
      "data-adpd",
      $(lbximt).attr("data-adpdck")
    );
    $(".lbx-pdt-fchrswrtn-dvbx").text($(lbximt).attr("data-pfcrs"));
    $(".lbx-pdtisgts-viws-spn").text($(lbximt).attr("data-vws"));
    $(".lbx-pdtisgts-mchme-spn").text($(lbximt).attr("data-mhe"));
    $(".lbx-szes-slctn-dsply")
      .attr("data-aszs", $(lbximt).attr("data-szs"))
      .attr("data-aspce", $(lbximt).attr("data-pce"))
      .attr("data-tslds", $(lbximt).attr("data-slds"));
    $(".rmvftchr,.rmvaddsze,.lbx-pdt-adszbtninszedsply-dvbx").hide();
    if (
      $(lbximt).attr("data-lmig") != "../srptlvmdlpcs/" &&
      $(lbximt).attr("data-lmig") != "srptlvmdlpcs/" &&
      $(lbximt).attr("data-lmig") != undefined &&
      $(lbximt).attr("data-lmig") != ""
    ) {
      var $lvmlig = "";
      if (
        $(lbximt).attr("data-lmig") != undefined &&
        $(lbximt).attr("data-lmig") != ""
      ) {
        $lvmlig = $(lbximt).attr("data-lmig").split("srptlvmdlpcs")[1];
      } else {
        $lvmlig = "";
      }
      $(".lbx-pdt-mtchmebtn")
        .attr("data-m", `http://localhost/remindo/srptlvmdlpcs${$lvmlig}`)
        .attr("data-sid", $(lbximt).attr("data-sid"))
        .attr("data-pid", $(lbximt).attr("data-pid"))
        .show();
      $(".lbx-pdt-lvpc").html(
        `<div class='lbx-pdtlvig-prvwicn'><i class='fas fa-eye remindosymbols lbx-lvmdleysmblicn'></i></div><img src='http://localhost/remindo/srptlvmdlpcs${$lvmlig}' class='lbx-sld-shw-imgprevw-img'>`
      );
    } else {
      $(".lbx-pdt-mtchmebtn").hide().attr("data-m", "");
      $(".lbx-pdt-lvpc").html(
        `<div class='lbx-pdtlvig-prvwicn'><i class='fas fa-eye remindosymbols lbx-lvmdleysmblicn'></i></div>`
      );
    }
    $(".lbx-sktlbn-iptdvbx .switch").html(
      `<input type='checkbox' id='lbx-strpdtstksts' class='lbx-pdt-stkstsupdt' data-pd='${$(
        lbximt
      ).attr("data-pid")}' data-sd='${$("#hnitsidval").val()}' data-ud='${
        $(lbximt).attr("data-istk") == "In stock" ? "fs" : "tre"
      }' ${isckd}><span class='slider round'></span>`
    );
    setTimeout(() => {
      isckd =
        $(lbximt).attr("data-istk") == "In stock" ? "checked" : "unchecked";
      $(".lbx-pdt-stkstsupdt").attr(
        "checked",
        $(lbximt).attr("data-istk") == "In stock" ? true : false
      );
    }, 100);
    $("#lbx-strpdtstksts").change((e) => {
      updtstcksts(e.target);
    });
    $(".lbx-igpcs-rltdtosldshw-dsplr-dbx").attr(
      "data-pigs",
      $(lbximt).attr("data-rpigs")
    );
    $(".shrpstbn")
      .attr("data-ttl", `Remindo.in`)
      .attr("data-txt", $(lbximt).attr("data-tle"))
      .attr(
        "data-pic",
        $(lbximt).attr("data-rpigs") != undefined
          ? "http://localhost/remindo/strpdtspcs/" +
              $(lbximt).attr("data-rpigs").split("/,")[0]
          : ""
      )
      .attr("data-url", $(lbximt).attr("data-url"));
    frmatfchrs($isgl, $ninf);
    $(document.querySelector(".rdo-sze-slct")).click();
    $(".lbx-pdtprce-dsply").text(
      $(document.querySelector(".rdo-sze-slct")).parent().attr("data-pce")
    );
    rptigvwr();
    addszebns(true);
    igvwrfun();
    if ($(lbximt).hasClass("nonsrprdtlbxopn")) {
      uvm("v", $(lbximt).attr("data-sid"), $(lbximt).attr("data-pid"));
    }
  };

  if ($isgl) {
    var alpds = document.querySelector(".prdtditmnmcntnrdvbx");
    lbxcnts(alpds);
  } else {
    var alpds = document.querySelectorAll(".prdtditmnmcntnrdvbx");
    var pcnt = 0;
    alpds.forEach((pdt, idx) => {
      $(pdt).click((e) => {
        pcnt = idx;
        if (idx >= alpds.length - 1) {
          $(".lbx-dsplr-nxtpdt-vwbtn").css({ opacity: "0.5" });
        } else if (idx <= 0) {
          $(".lbx-dsplr-pewpdt-vwbtn").css({ opacity: "0.5" });
        } else {
          $(".lbx-dsplr-pewpdt-vwbtn,.lbx-dsplr-nxtpdt-vwbtn").css({
            opacity: "1",
          });
        }
        $(".lbx-adpdt-andls-btn").hide();
        $(".lbx-dsplr-nxpvbtns-dvbx").show();
        $(
          ".cmn-lbx-bckgrond-cntngdvbx,.cmn-lbx-pdt-dsplyr-cntngdvbx,.lbx-pn-shwedls-icnbtn"
        ).show();
        $(".lbx-picfle")
          .removeClass("lbx-adnwig-fleipt")
          .addClass("lbx-rmdpdtpc-flipt");
        $(".lbx-adptobn")
          .addClass("lbx-ptpto-cmbntocng-pic")
          .removeClass("lbx-adnwpdt-adptobtn");
        $(".lbx-rmvptobtn")
          .removeClass("lbx-adnwpdt-rmvpicbn")
          .addClass("lbx-pdto-rmvpic-btn");
        $(".lbx-pdt-stketandothbns-cntngdvbx").css({ display: "flex" });
        $(".lbx-pdt-edbns-cntng-dvbx,.lbx-dvedbl-mntrng-spntgs").hide();
        $(".lbx-pdt-dnmc-cntetbls")
          .removeClass("edtbltgs")
          .attr("contenteditable", "false");
        $(".rmvftchr,.rmvaddsze,.lbx-pdt-adszbtninszedsply-dvbx").hide();
        lbxcnts(e.target);
      });
    });
    $(".lbx-dsplr-nxtpdt-vwbtn").click((e) => {
      if (pcnt < alpds.length - 1) {
        lbxcnts($(alpds[pcnt + 1]));
        pcnt += 1;
        $(".lbx-dsplr-pewpdt-vwbtn,.lbx-dsplr-nxtpdt-vwbtn").css({
          opacity: "1",
        });
        if (pcnt == alpds.length - 1) {
          $(".lbx-dsplr-nxtpdt-vwbtn").css({ opacity: "0.5" });
        }
        return true;
      } else {
        $(".lbx-dsplr-nxtpdt-vwbtn").css({ opacity: "0.5" });
        return false;
      }
    });
    $(".lbx-dsplr-pewpdt-vwbtn").click((e) => {
      if (pcnt > 0) {
        lbxcnts($(alpds[pcnt - 1]));
        pcnt -= 1;
        $(".lbx-dsplr-pewpdt-vwbtn,.lbx-dsplr-nxtpdt-vwbtn").css({
          opacity: "1",
        });
        if (pcnt == 0) {
          $(".lbx-dsplr-pewpdt-vwbtn").css({ opacity: "0.5" });
        }
        return true;
      } else {
        $(".lbx-dsplr-pewpdt-vwbtn").css({ opacity: "0.5" });
        return false;
      }
    });
  }
}
function igvwrfun() {
  var posx = 0,
    posy = 0,
    zin = false,
    iw;
  document.querySelectorAll(".lbx-sld-shw-imgprevw-img").forEach((ig, idx) => {
    if (idx == 0) {
      $(".lbxothrigscntngdvbx").html(
        `<img src='${$(ig).attr("src")}' class='lbxpwig'/>`
      );
    } else {
      $(".lbxothrigscntngdvbx").append(
        `<img src='${$(ig).attr("src")}' class='lbxpwig'/>`
      );
    }
  });
  $(".mindsplyigdvb").click((e) => {
    if (!zin) {
      zin = true;
      iw = parseInt($(".mindsplyigdvb").css("width"));
      $(".mindsplyigdvb").css("width", 1000 + "px");
      posx = e.clientX;
      posy = e.clientY;
      $(".mindsplyigdvb").css("transform", `translate(-${posx}px,-${posy}px)`);
    } else {
      zin = false;
      $(".mindsplyigdvb").css("width", iw + "px");
      posx = 0;
      posy = 0;
      $(".mindsplyigdvb").css("transform", `translate(${posx}px,${posy}px)`);
    }
  });
  $(".lbxpwig").click((e) => {
    $(".lbxpwig").css("border", "1px solid white");
    $(e.target).css("border", "2px solid orange");
    $(".mindsplyigdvb").attr("src", $(e.target).attr("src"));
  });
  $(".extlbxbtn").click((e) => {
    posx = 0;
    posy = 0;
    zin = false;
    iw = null;
    $(".lbx-bg-igdsplyrdvbx").hide();
  });
  $(".lbx-lrgdsplyprvig-tg .lbx-sld-shw-dsply-img").click((e) => {
    $(".lbxpwig").css("border", "1px solid white");
    $(`.lbxpwig[src='${$(e.target).attr("src")}']`).css(
      "border",
      "2px solid orange"
    );
    $(".mindsplyigdvb").attr("src", $(e.target).attr("src"));
    $(".lbx-bg-igdsplyrdvbx").show();
  });
}
