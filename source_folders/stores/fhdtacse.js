$(document).ready(() => {
  var o = 0,
    os = 0;
  var l = 5,
    lt = 8;
  var pds = true;
  var ods = true;
  fhodrs(true, o, l);
  $(".strpgmdbdyofodrlstscntnrdvbx").on("touchmove", ldodrs);
  $(".strpgmdbdyofodrlstscntnrdvbx").scroll(ldodrs);
  function scrlfun($c) {
    var container = $($c);
    var height = container.height();
    var scrollHeight = container[0].scrollHeight;
    var st = container.scrollTop();
    var sum = scrollHeight - height - 32;
    return [st, sum];
  }
  function ldodrs() {
    var scrl = scrlfun(".strpgmdbdyofodrlstscntnrdvbx");
    if (scrl[0] >= scrl[1]) {
      o += l;
      if (ods) {
        fhodrs(false, o, l);
      }
    }
  }
  var ishp = false;
  $(".stralpdtsdsplydvbxctnrdvbx").on("touchmove", () => {
    pdtstblds();
  });
  $(".stralpdtsdsplydvbxctnrdvbx").scroll(() => {
    pdtstblds();
  });
  $(".srchalpdtsinstrmandsplyiptsrch").keyup((e) => {
    var on = e.which || e.keyCode;
    var kcds = [
      17, 18, 20, 16, 40, 37, 45, 46, 33, 34, 144, 145, 9, 27, 38, 13, 39, 91,
      93, 36, 35,
    ];
    if (!kcds.includes(on)) {
      os = 0;
      lt = 8;
      ishp = true;
      pds = true;
      rvrpdts($(".srchalpdtsinstrmandsplyiptsrch").val(), true, os, lt, false);
    }
  });
  function pdtstblds(ish) {
    var scrl = scrlfun(".stralpdtsdsplydvbxctnrdvbx");
    if (scrl[0] > 0) {
      $(".stralpdtsplcetphdr").css("box-shadow", "0px 3px 13px -9px black");
    } else {
      $(".stralpdtsplcetphdr").css("box-shadow", "0 0 0 black");
    }
    if (scrl[0] >= scrl[1]) {
      os += lt;
      if (pds) {
        if (!ish) {
          rvrpdts("", false, os, lt, false);
        } else {
          rvrpdts(
            $(".srchalpdtsinstrmandsplyiptsrch").val(),
            false,
            os,
            lt,
            false
          );
        }
      }
    }
  }
  $(".shwalpdtsinstrbtn").click(() => {
    if (!$(".pdtsinstrhgedsplydvbx .lbx-dsply-pdts-nd-dtls-cntngdvbx").length) {
      os = 0;
      lt = 5;
      pds = true;
      rvrpdts("", true, os, lt, false);
    }
  });
  if (!$(".strpgmdbdyofodrlstscntnrdvbx").length) {
    os = 0;
    lt = 5;
    pds = true;
    rvrpdts("", true, os, lt, false);
  }
  function rvrpdts(sp, f, os, lt, rel, cpid) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/rtvpds",
      method: "get",
      data: {
        rvrpds: "yscmrfhsrpds",
        sd: $("#ithnthssmrcls").val(),
        rel: rel + "/re,./cs" + cpid,
        sp: sp,
        os: os,
        lt: lt,
      },
      beforeSend: () => {
        if (!rel) {
          $("div.pageloader").show();
          preloaderon();
        } else {
          $(".lbx-rltd-pdts-bdy .lbx-rld-rltdpds-dvbx").html(
            "<div class='prldrspnr'><center><div style='color:#ff8d00;'><i class='fas fa-circle-notch fa-spin' style='font-weight:900;'></i></div></center></div>"
          );
        }
      },
      success: (data) => {
        $("div.pageloader").hide();
        if (data != 0) {
          $(".pdtsinstrhgedsplydvbx").removeAttr("style");
          if (!rel) {
            if (f) {
              $(".pdtsinstrhgedsplydvbx").html(data);
            } else {
              $(".pdtsinstrhgedsplydvbx").append(data);
            }
            opndsply(false, false);
          } else {
            $(".lbx-rltd-pdts-bdy .lbx-rld-rltdpds-dvbx").html(data);
            opndsply(false, false);
          }
          $(
            ".lbx-dsply-shdls-ptpc-dvbx,.lbx-dsply-rltdpdsnm,.lbx-shtpdtigdsplycntng-dvbx"
          ).click((e) => {
            var $reltvcnt = $(e.target)
              .closest(".lbx-dsply-pdts-nd-dtls-cntngdvbx")
              .children(".lbx-shtpdtigdsplycntng-dvbx")
              .attr("data-pfcrs");
            rvrpdts(
              $reltvcnt != "" || $reltvcnt != " "
                ? $reltvcnt
                : $(e.target)
                    .closest(".lbx-dsply-pdts-nd-dtls-cntngdvbx")
                    .children(".lbx-shtpdtigdsplycntng-dvbx")
                    .attr("data-ttl"),
              true,
              0,
              0,
              true,
              $(e.target)
                .closest(".lbx-dsply-pdts-nd-dtls-cntngdvbx")
                .children(".lbx-shtpdtigdsplycntng-dvbx")
                .attr("data-pid")
            );
          });
          pwrngpdtbns();
        } else {
          if (!rel) {
            pds = false;
            if (f && data == 0) {
              $(".pdtsinstrhgedsplydvbx").css("grid-template-columns", "90%")
                .html(`
              <center><div><img src='../includes/fn_img/noschpdtfnd.png' style='width:100%;'></div>
              <div><h4 style='color:gray;max-width: 95%;'><div>Sorry! No such product found.</div><div>It looks like there aren't any great matches for your search.</div></h4><p style='color:gray;font-size:11px;'>Try searching for the products that you know this store sells.</p></div>
              </center>
            `);
            }
          }
        }
      },
    });
  }
  function fhodrs(f, o, l, e) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/odrvtrngs",
      method: "post",
      data: {
        fhodrscr: "yscmrefhstr",
        s: $("#ithnthssmrcls").val(),
        o: o,
        l: l,
      },
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        if (data != 0) {
          if (f) {
            $(".strpgmdbdyofodrlstscntnrdvbx").html(data);
          } else {
            $(".strpgmdbdyofodrlstscntnrdvbx").append(data);
          }
          orgptamt();
          ttlamt();
          ttitms();
          chckitms();
          rmvdelbnsfuncg();
          crtnwordr();
          knwpkgng();
          plcngodr();
          // vrfpmts();
          pytostr();
        } else {
          ods = false;
        }
      },
    });
  }
});
function orlvpds(g, o) {
  $.ajax({
    url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
    method: "post",
    data: {
      gtlvpds: "yslvpdts",
      sid: $("#ithnthssmrcls").val(),
      o: o,
    },
    success: (data) => {
      if (data != 0) {
        if (data == 1) {
          $(g)
            .parent()
            .html(
              "<div class='sntrmrodraspndng' data-od=" +
                o +
                "' id='undne'><i class='fas fa-clock remindosymbols'></i>Pending</div>"
            );
          $("#undne").unbind();
          knwpkgng();
        } else if (data == 2) {
          $(g)
            .parent()
            .html(
              "<div class='sntrmrodraspndng' data-od=" +
                o +
                "' id='undne'><i class='fas fa-box remindosymbols'></i>Packing...</div>"
            );
          $("#undne").unbind();
          knwpkgng();
        } else if (data == 3) {
          $(g)
            .parent()
            .html(
              "<div class='sntrmrodraspndng' id='dne'><i class='fas fa-box remindosymbols'></i>Packed</div>"
            );
        }
      }
    },
  });
  return false;
}
function knwpkgng() {
  document.querySelectorAll("#undne").forEach((cck) => {
    $(cck).click(() => {
      orlvpds(cck, $(cck).attr("data-od"));
    });
  });
}
//
var ckusrpmt = "";
// adidtovfpmtbtn();
$(document).ready(() => {
  if ($(".vrfypmtsbtninppup").attr("id") == "vfyptmsidtre") {
    //   ckusrpmt = setInterval((e) => {
    //     adidtovfpmtbtn();
    //     // vrfpmts(e);
    //   }, 20000);
  }
});
function adidtovfpmtbtn() {
  if (
    $(".sdordrtostrbtn").attr("data-p") &&
    $(".sdordrtostrbtn").attr("data-p") == "vfyptmsidtre"
  ) {
    $(".vrfypmtsbtninppup").attr("id", "vfyptmsidtre");
  } else {
    clearInterval(ckusrpmt);
    $(".vrfypmtsbtninppup").attr("id", "");
    $(".vrfypmtsbtninppup").removeAttr("id");
  }
}
function vrfpmts(e) {
  $.ajax({
    url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
    method: "post",
    data: { ntfirply: "ysrplypttre", s: $("#ithnthssmrcls").val() },
    dataType: "json",
    success: (data) => {
      if (data != 0) {
        if (data.d == "d1") {
          $(".vrfypmtsbtninppup").text(
            "Congratulations! Your payment recived by store."
          );
          clearInterval(ckusrpmt);
          $("#treptnmitbxval").show();
          $(".vrfypmtsbtninppup").attr("id", "");
          $(".vrfypmtsbtninppup").removeAttr("id");
          setTimeout(() => {
            $(".vrfypmtsbtninppup").text("Verify payment");
            $(".streppupbx").hide();
            $("#strodrsdtosrbn,#strodrnsdtosrbn")
              .parent()
              .html(
                "<div class='sntrmrodraspndng' id='undne'><i class='fas fa-clock remindosymbols'></i>Pending</div>"
              );
            crtnwordr();
          }, 3000);
          $vfpts = false;
        } else if (data.d == "d0") {
          if ($(".sdordrtostrbtn").attr("data-onm")) {
            $(".vrfypmtsbtninppup").attr(
              "data-vo",
              $(".sdordrtostrbtn").attr("data-onm")
            );
          }
          if ($(".sdordrtostrbtn").attr("data-p")) {
            if ($(".sdordrtostrbtn").attr("data-p") == "vfyptmsidtre") {
              $vfpts = true;
              $(".usecasoptionbtn").hide();
              $("#treptnmitbxval").hide();
              $(".vrfypmtsbtninppup").text(
                "Asked! Waiting for reply from store..."
              );
              $(".vrfypmtsbtninppup").attr("id", "vfyptmsidtre");
            }
          } else {
            $(".vrfypmtsbtninppup").removeAttr("id");
          }
        }
      }
    },
  });
}
function pytostr() {
  $(".odrpcdtopy").click((e) => {
    var tpc = $(e.target)
      .closest(".odrpcdtopy")
      .parent()
      .siblings(".ordrlstbdycntnrdvbx")
      .children(".odrgstccgpcdlscntnrdvbx")
      .children(".tamtcnrcycntnrdvbx")
      .children(".ttlamntwthccgstspntg")
      .text();
    $("#ttlodritmplcdbycmr").text(tpc);
    $(".vrfypmtsbtninppup").attr(
      "data-vo",
      $(e.target).closest(".odrpcdtopy").attr("data-onm")
    );
    $(".streppupbx").show();
  });
  $(".odrstsdsplyr").click((e) => {
    $(".odridsplyrspntg").text(
      $(e.target).closest(".odrstsdsplyr").attr("data-oi")
    );
    $(".odrdtxdsplyctngdvbx").html(
      $(e.target).closest(".odrstsdsplyr").attr("data-dx") != "" &&
        $(e.target).closest(".odrstsdsplyr").attr("data-dx") != undefined
        ? `<strong>Delivery details: </strong><div>${$(e.target)
            .closest(".odrstsdsplyr")
            .attr("data-dx")
            .replace(new RegExp("br/br", "gi"), "<br>")}</div>`
        : ""
    );
    if ($(e.target).hasClass("odrdlvrngnfyr")) {
      $(".igtmyodrvfcnctngdvbx")
        .attr("data-o", $(e.target).attr("data-onm"))
        .show();
    } else {
      $(".igtmyodrvfcnctngdvbx").attr("data-o", "").hide();
    }
    $(".strshwodrdls").show();
    var odstsbtn = $(e.target);
    $("#icvdodrcbx").click((e) => {
      if ($("#icvdodrcbx").is(":checked")) {
        if (confirm("Did you really received the order?")) {
          $.ajax({
            url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
            method: "post",
            data: {
              odrcvdupdt: "ysodcvpdts",
              sid: $("#ithnthssmrcls").val(),
              o: $(".igtmyodrvfcnctngdvbx").attr("data-o"),
              sts: "dvrd",
            },
            beforeSend: () => {
              $(".ircvdmyodrtxt").hide();
              $(".igtmyodrvfcnctngdvbx").append(
                `<div class='prldrspnr'><center><div style='color:#ff8d00;'><i class='fas fa-circle-notch fa-spin' style='font-weight:900;'></i> Updating...</div></center></div>`
              );
            },
            success: (data) => {
              $(".igtmyodrvfcnctngdvbx .prldrspnr").remove();
              if (data == 1) {
                $(odstsbtn)
                  .removeClass("odrdlvrngnfyr")
                  .html(
                    `<i class='fas fa-shipping-fast remindosymbols'></i> Delivered`
                  );
                showsnackpopup("Updated successfully!", true, true);
              } else {
                $(".ircvdmyodrtxt").show();
                showsnackpopup("Failed to upadte! Try again.", true, "non");
              }
            },
            error: () => {
              $(".ircvdmyodrtxt").show();
              showsnackpopup("Failed to upadte! Try again.", true, "non");
            },
          });
        }
      }
    });
  });
}
$(".odlsclsbtn").click((e) => {
  $("#icvdodrcbx").unbind();
});
