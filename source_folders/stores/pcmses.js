$(document).ready(() => {
  if (window.innerWidth > 420) {
    if ($(".remindomainheaderlptpvsn").html("")) {
      $.ajax({
        url: "http://localhost/remindo/header",
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
      url: "http://localhost/remindo/header",
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
  $(".remindobackbtnuname").click(() => {
    var sunm = new URL(window.location.href).searchParams.get("s");
    var s = $("#hnitsidval").val();
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
          "http://localhost/remindo/stores/store?s=" + sunm
        );
      },
    });
  });
});
setTimeout(() => {
  var docpthnm = window.location.pathname;
  if (
    docpthnm == "/remindo/stores/pdctmrs" ||
    docpthnm == "/remindo/stores/pdctmrs.php"
  ) {
    pdcmrsjs();
  } else if (
    docpthnm == "/remindo/stores/storeroles" ||
    docpthnm == "/remindo/stores/storeroles.php"
  ) {
    strolsjs();
  }
}, 0.1);
function pdcmrsjs() {
  $(document).ready(() => {
    var os = 0;
    var lt = 5;
    var iscas = false;
    fchalpndcmrs(false, true, os, lt);
    $(".strcasavlcmrsbtn").click(() => {
      if (!iscas) {
        $(".strcasavlcmrsbtn").text("C.A.S");
        fchalpndcmrs(false, true, 0, 5);
        iscas = true;
      } else {
        $(".strcasavlcmrsbtn").text("Show all");
        fchalpndcmrs(true, true, 0, 5);
        iscas = false;
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
        if (!iscas) {
          fchalpndcmrs(false, false, os, lt);
        } else {
          fchalpndcmrs(true, false, os, lt);
        }
      }
    }
    function fchalpndcmrs(scas, $f, os, lt) {
      var $scmrs = "trepncms";
      if (scas) {
        $scmrs = "trepncascms";
      } else {
        $scmrs = "trepncms";
      }
      $.ajax({
        url: "http://localhost/remindo/stsupsflr/strcmspns",
        method: "post",
        data: {
          stpdcmrs: $scmrs,
          s: $("#hnitsidval").val(),
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
            if ($f) {
              $(".prdtsdsplngwall").html(
                "<center><h5 style='color:gray;'>You have no customers.</h5></center>"
              );
            }
          } else if (data == "q0") {
            $(".prdtsdsplngwall").html(
              "<center><h2 style='color:gray;'>Failed to load the customers. Try again later.</h2></center>"
            );
          } else {
            if ($f) {
              $(".prdtsdsplngwall").html(data);
            } else {
              $(".prdtsdsplngwall").append(data);
            }
            avlcasfn();
          }
          rebtnsus();
        },
      });
    }
  });
  function rebtnsus() {}
  function avlcasfn() {
    document.querySelectorAll("#iscasavblipt").forEach((csavl) => {
      $(csavl).click(() => {
        var s = $("#hnitsidval").val();
        var c = $(csavl).attr("data-pu");
        var ud = $(csavl).attr("data-ud");
        var cn = $(csavl).attr("data-c");
        $.ajax({
          url: "../stsupsflr/strdtlsupdt",
          method: "post",
          data: {
            csavl: "avlcstre",
            cn: cn,
            c: c,
            s: s,
            ud: ud,
          },
          beforeSend: () => {
            $("div.pageloader").show();
            preloaderon();
          },
          success: (data) => {
            $("div.pageloader").hide();
            if (data == 1) {
              if ($(csavl).attr("data-ud") == "tre") {
                $(csavl).attr("data-ud", "fs");
              } else {
                $(csavl).attr("data-ud", "tre");
              }
              showsnackpopup("C.A.S availablity status updated.", true, true);
            } else {
              showsnackpopup(
                "Failed to update C.A.S availablity status. Try again later.",
                true,
                false
              );
            }
          },
        });
      });
    });
  }
}
function strolsjs() {
  $(document).ready((e) => {
    var tmbrid = "",
      srld = "",
      aou = "a",
      aur = "au";
    var mterol = "A Member";
    var os = 0;
    var lt = 8;
    var alfsh = false,
      rqcmpl = true;
    fchalstrtmbrs("", true, os, lt);
    $(document).on("touchmove", (e) => {
      scrlfun(e);
    });
    $(window).scroll((e) => {
      scrlfun(e);
    });
    function scrlfun(e) {
      if (
        $(window).scrollTop() + $(window).height() + 10 >
        $(".remindochildboxycontainer").height()
      ) {
        os += lt;
        if (!alfsh && rqcmpl) {
          fchalstrtmbrs(e, false, os, lt);
        }
      }
    }
    function fchalstrtmbrs(e, f, o, l) {
      $.ajax({
        url: "http://localhost/remindo/stsupsflr/strcmspns",
        method: "get",
        data: {
          fhsrls: "fhrlsofstrtre",
          s: $("#hnitsidval").val(),
          w: $("#strlval").val(),
          o: o,
          l: l,
        },
        dataType: "JSON",
        beforeSend: () => {
          rqcmpl = false;
          var pldr =
            "<center class='nwclnchpldr'><div style='font-size:14px;color:orange;display:flex;align-items:center;justify-content:center;'><i class='fas fa-circle-notch fa-spin' style='font-size: 30px;font-weight: 600;color: #c3b767;'></i> Loading...</div></center>";

          if (!$(".strolsdsplycntngdvbx .nwclnchpldr").length) {
            if (f) {
              $(".strolsdsplycntngdvbx").html(pldr);
            } else {
              $(".strolsdsplycntngdvbx").append(pldr);
            }
          }
        },
        success: (data) => {
          rqcmpl = true;
          console.log(data);
          $(".strolsdsplycntngdvbx .nwclnchpldr").remove();
          if (data == "") {
            alfsh = true;
          } else if (data.s == 0) {
            alfsh = true;
          } else {
            $(".ttltmatsofstrdvbx").text(`${data.tmrs} Members`);
            if (f) {
              $(".strolsdsplycntngdvbx").html(data.s);
            } else {
              $(".strolsdsplycntngdvbx").append(data.s);
            }
            $(".chngrolebtn").click((e) => {
              tmbrid = $(e.target).closest(".chngrolebtn").attr("data-p");
              mterol = $(e.target).closest(".chngrolebtn").attr("data-stml");
              srld = $(e.target).closest(".chngrolebtn").attr("data-sl");
              aou = "u";
              $(`.strole`).children(".tckspan").html("");
              $(`.strole[data-srl='${mterol}']`)
                .children(".tckspan")
                .html(
                  "<i class='fas fa-check remindosymbols' style='color:#1e88e5;padding:0;'></i>"
                );
              $(".strtmbrpfig").html(
                !$(e.target)
                  .closest(".chngrolebtn")
                  .parent()
                  .siblings(".strsprdtupdtddtlsdvbx")
                  .children(".strsprdtsimgcntnrbx")
                  .children("img").length
                  ? ""
                  : `<img src='${$(e.target)
                      .closest(".chngrolebtn")
                      .parent()
                      .siblings(".strsprdtupdtddtlsdvbx")
                      .children(".strsprdtsimgcntnrbx")
                      .children("img")
                      .attr("src")}'>`
              );
              $(".strtmbrnam").text(
                $(e.target).closest(".chngrolebtn").attr("data-spn")
              );
              $(".adstroltostr").hide();
              $(".dscrdstrolinstrstr,.svedtdstrolinstr,.strolsppup").show();
            });
            $(".rmvrolbtn").click((e) => {
              tmbrid = $(e.target).closest(".rmvrolbtn").attr("data-ps");
              srld = $(e.target).closest(".rmvrolbtn").attr("data-srl");
              aur = "r";
              $(".vfypwd").show();
            });
          }
        },
      });
      if (e != "") {
        e.stopImmediatePropagation();
      }
      return false;
    }
    $(".strole").click((e) => {
      $(".strole").children(".tckspan").html("");
      $(e.target)
        .children(".tckspan")
        .html(
          "<i class='fas fa-check remindosymbols' style='color:#1e88e5;padding:0;'></i>"
        );
      mterol = $(e.target).closest(".strole").attr("data-srl");
    });
    $(".adstroltostr,.svedtdstrolinstr").click((e) => {
      aur = "au";
      if (mterol != "") {
        $(".vfypwd").show();
      } else {
        showsnackpopup("Please select a role to the person.", true, "non");
      }
    });
    $(".dscrdstrolinstrstr").click((e) => {
      $(".strolsppup").hide();
      tmbrid = "";
      $("#rmndousrpwdtoupdt").val("");
      mterol = "A Member";
    });
    $(".sbmttocngrol").click((e) => {
      e.preventDefault();
      if (aur == "au") {
        $.ajax({
          url: "http://localhost/remindo/stsupsflr/strcmspns",
          method: "post",
          data: {
            adstrol: "adstroltreys",
            ps: $("#rmndousrpwdtoupdt").val(),
            pd: tmbrid,
            rl: mterol,
            srd: srld,
            aou: aou,
            sd: $("#hnitsidval").val(),
          },
          dataType: "JSON",
          beforeSend: () => {
            $(".sbmttocngrol").text("Verifying...");
          },
          success: (data) => {
            $("#rmndousrpwdtoupdt").val("");
            $(".sbmttocngrol").text("Verify And Continue");
            if (data.s == "qpv0") {
              showsnackpopup(
                "Failed to verify password! Please try again later.",
                true,
                "non"
              );
            } else if (data.s == "nac0") {
              showsnackpopup(
                "You don't have an account on Remindo!<a href='../signin' style='color: lightgreen;margin-left: 5px;text-shadow: 0 0 2px #685d5d;'>Create one.</a>",
                false,
                "non"
              );
            } else if (data.s == "p0") {
              showsnackpopup(
                "The password you entered was invalid! Please enter correct password.",
                true,
                false
              );
            } else if (data.s == "pext") {
              $(".vfypwd,.strolsppup").hide();
              showsnackpopup(
                "This person already exists in your team.",
                true,
                true
              );
            } else if (data.s == "iq0") {
              showsnackpopup(
                "Sorry! Failed to Add the person. Please try again later.",
                true,
                "non"
              );
            } else if (data.s == "u0") {
              showsnackpopup(
                "Sorry! Failed update the role. Please try again later.",
                true,
                "non"
              );
            } else if (data.s == "u1") {
              $(".vfypwd").hide();
              $(".vfypwd,.strolsppup").hide();
              showsnackpopup("Successfully Updated the role!", true, true);
              $(`.chngrolebtn[data-p='${tmbrid}']`)
                .closest(".strtemmbrupdtbtnscntngdvbx")
                .children(".strsprdtupdtddtlsdvbx")
                .children(".strcntngordritmdtlscntngdvbx")
                .children(".prdtsrditmothdtlscntngdvbx")
                .text(mterol);
            } else if (data.s == "iq1") {
              $(".vfypwd").hide();
              $(".vfypwd,.strolsppup").hide();
              showsnackpopup(
                "This person successfully added to your store team.",
                true,
                true
              );
              $(".strolsdsplycntngdvbx").append(data.nmbr);
            }
          },
        });
      } else if (aur == "r") {
        $.ajax({
          url: "http://localhost/remindo/stsupsflr/strcmspns",
          method: "post",
          data: {
            rmvstrol: "rmvstroltreys",
            s: $("#hnitsidval").val(),
            psn: tmbrid,
            ps: $("#rmndousrpwdtoupdt").val(),
            d: srld,
          },
          dataType: "JSON",
          beforeSend: () => {
            $(".sbmttocngrol").text("Verifying...");
          },
          success: (data) => {
            $("#rmndousrpwdtoupdt").val("");
            $(".sbmttocngrol").text("Verify And Continue");
            $(".vfypwd,.strolsppup").hide();
            if (data.s == 0) {
              showsnackpopup(
                "Sorry! Failed to remove the role. Please try again later",
                true,
                "non"
              );
            }
            if (data.s == "qpv0") {
              showsnackpopup(
                "Failed to verify password! Please try again later.",
                true,
                "non"
              );
            } else if (data.s == "nac0") {
              showsnackpopup(
                "You don't have an account on Remindo!<a href='../signin' style='color: lightgreen;margin-left: 5px;text-shadow: 0 0 2px #685d5d;'>Create one.</a>",
                false,
                "non"
              );
            } else if (data.s == "p0") {
              showsnackpopup(
                "The password you entered was invalid! Please enter correct password.",
                true,
                false
              );
            } else if (data.s == 1) {
              if (data.w == "me") {
                $("#srchpplinrmdo,.chngrolebtn,.rmvrolbtn").remove();
              }
              showsnackpopup("Successfully removed from store!", true, true);
              $(`.rmvrolbtn[data-ps='${tmbrid}']`)
                .closest(".strprdtsdtlsadntmstpcntnrdvcntngbx")
                .slideUp(200);
              setTimeout(() => {
                $(`.rmvrolbtn[data-ps='${tmbrid}']`)
                  .closest(".strprdtsdtlsadntmstpcntnrdvcntngbx")
                  .remove();
              }, 200);
            }
          },
        });
      }
    });
    $("#srchpplinrmdo")
      .attr("autocomplete", "new-password")
      .focus((e) => {
        if ($(e.target).val() == "") {
          $(".iptsrchusrdcntngdvbx").hide();
        } else {
          $(".iptsrchusrdcntngdvbx").show();
        }
      })
      .blur((e) => {
        $(".iptsrchusrdcntngdvbx").hover(
          (e) => {
            $(".iptsrchusrdcntngdvbx").show();
          },
          (e) => {
            $(".iptsrchusrdcntngdvbx").hide();
          }
        );
      })
      .keyup((e) => {
        var on = e.which || e.keyCode;
        var kcds = [
          17, 18, 20, 16, 40, 37, 45, 46, 33, 34, 144, 145, 9, 27, 38, 13, 39,
          91, 93, 36, 35,
        ];
        if ($(e.target).val().trim() == "") {
          $(".iptsrchusrdcntngdvbx").hide();
        } else {
          $(".iptsrchusrdcntngdvbx").show();
        }
        if (!kcds.includes(on)) {
          $.ajax({
            url: "http://localhost/remindo/stsupsflr/strcmspns",
            method: "get",
            data: {
              shurs: "shsurstre",
              n: $(e.target).val(),
            },
            beforeSend: () => {
              $(".iptsrchusrdcntngdvbx").html(
                "<center><i class='fas fa-spinner-alt fb-spin'></i></center>"
              );
            },
            success: (data) => {
              if (data == 0) {
                $(".iptsrchusrdcntngdvbx").html(
                  "<center><h5 style='color:gray;'>Sorry! No profile was found.</h5></center>"
                );
              } else {
                $(".iptsrchusrdcntngdvbx").html(data);
                $(".fchdusrdlscntngdvbx").click((e) => {
                  tmbrid = $(e.target)
                    .closest(".fchdusrdlscntngdvbx")
                    .children(".usrrlnmcntngdvbx")
                    .attr("data-p");
                  $(".strtmbrpfig").html(
                    !$(e.target)
                      .closest(".fchdusrdlscntngdvbx")
                      .children(".usrpigcntngdvbx")
                      .children("img").length
                      ? ""
                      : `<img src='${$(e.target)
                          .closest(".fchdusrdlscntngdvbx")
                          .children(".usrpigcntngdvbx")
                          .children("img")
                          .attr("src")}'>`
                  );
                  aou = "a";
                  $(".strtmbrnam").text(
                    $(e.target)
                      .closest(".fchdusrdlscntngdvbx")
                      .children(".usrrlnmcntngdvbx")
                      .text()
                  );
                  $(".dscrdstrolinstrstr,.svedtdstrolinstr").hide();
                  $(".adstroltostr,.strolsppup").show();
                });
              }
            },
          });
        }
      });
  });
}
