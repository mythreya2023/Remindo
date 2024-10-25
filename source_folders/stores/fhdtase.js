$(document).ready(() => {
  var gtodrs = "";
  lkttodrs();
  var uo = 0,
    po = 0,
    od = 0;
  var ul = 5,
    pl = 5,
    dl = 5;
  var tb = "upk";
  var tbp = ".strpgmbdyupcdodscntnrdvbx";
  $(".strownrpgftrtoshwppupsdvbx").show();
  $(".alupcdodrs").click((e) => {
    $(".stronrbdyctnrdvbx").hide();
    $(".strpgmbdyupcdodscntnrdvbx,.strownrpgftrtoshwppupsdvbx").show();
    $(".stronrtbsicns").css("color", "#5d5353");
    $(".alupcdodrs .stronrtbsicns").css("color", "orange");
    tb = "upk";
    tbp = ".strpgmbdyupcdodscntnrdvbx";
    if (
      $(tbp).children(".strpgmdbdyctgsdvx").children(".odrdlsttostrcntnrdvbx")
        .length == 0 ||
      !$(tbp).children(".strpgmdbdyctgsdvx").children(".odrdlsttostrcntnrdvbx")
        .length
    ) {
      fhodrs(true, uo, ul, true);
    }
  });
  $(".shpcdodrs,.rfrshpckdodrs").click((e) => {
    $(".stronrbdyctnrdvbx,.strownrpgftrtoshwppupsdvbx").hide();
    $(".strpgmdbdypckdodrscntnrdvbx").show();
    $(".stronrtbsicns").css("color", "#5d5353");
    $(".shpcdodrs .stronrtbsicns").css("color", "orange");
    tb = "apk";
    tbp = ".strpgmdbdypckdodrscntnrdvbx";
    if (
      $(tbp).children(".strpgmdbdyctgsdvx").children(".odrdlsttostrcntnrdvbx")
        .length == 0 ||
      !$(tbp).children(".strpgmdbdyctgsdvx").children(".odrdlsttostrcntnrdvbx")
        .length
    ) {
      fhodrs(true, po, pl, true);
    } else if ($(e.target).hasClass("rfrshpckdodrs")) {
      po = 0;
      pl = 5;
      fhodrs(true, po, pl, true);
    }
  });
  $(".shodstoshp").click(() => {
    $(".stronrbdyctnrdvbx,.strownrpgftrtoshwppupsdvbx").hide();
    $(".strpgmdbdyodrsrdytodlvrcntnrdvbx").show();
    $(".stronrtbsicns").css("color", "#5d5353");
    $(".shodstoshp .stronrtbsicns").css("color", "orange");
    tb = "rtd";
    tbp = ".strpgmdbdyodrsrdytodlvrcntnrdvbx";
    if (
      $(tbp).children(".strpgmdbdyctgsdvx").children(".odrdlsttostrcntnrdvbx")
        .length == 0 ||
      !$(tbp).children(".strpgmdbdyctgsdvx").children(".odrdlsttostrcntnrdvbx")
        .length
    ) {
      fhodrs(true, od, dl, true);
    }
  });
  $(".srchodrbyicnbtn").click(() => {
    var oid = $("#srchodript").val().trim();
    if (oid != "") {
      fhodrs(true, oid, "sch", true);
    }
  });
  function lkttodrs() {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/odrvtrngs",
      method: "post",
      data: { gtalkdodrs: "ysgtaladrsupkdtre", s: $("#hnsnmrvliptbx").val() },
      success: (data) => {
        $(".strsodrinnmcntngspntgbx").text(data);
        if (parseInt(data) > 0) {
          tryfrodrs();
        }
      },
    });
  }
  mvmtrld();
  function mvmtrld() {
    fhodrs(true, uo, ul, true);
    $(tbp).on("touchmove", scrlfun);
    $(tbp).scroll(scrlfun);
    function scrlfun() {
      var container = $(tbp);
      var height = container.height();
      var scrollHeight = container[0].scrollHeight;
      var st = container.scrollTop();
      var sum = scrollHeight - height - 32;
      if (st >= sum) {
        var o = 0;
        l = 5;
        // o += l;
        if (tb == "upk") {
          uo += ul;
          o = uo;
          l = ul;
        } else if (tb == "apk") {
          po += pl;
          o = po;
          l = pl;
        } else if (tb == "rtd") {
          od += dl;
          o = od;
          l = dl;
        }
        console.log(o, l);
        fhodrs(false, o, l, false);
        lkttodrs();
      }
    }
  }
  function tryfrodrs() {
    //   if ($(".strsodrinnmcntngspntgbx").text()=="0") {
    //     gtodrs = setInterval(() => {
    //       o = 0;
    //       l = 5;
    //       fhodrs(true, o, l,true);lkttodrs();
    //     }, 30000);
    //   }
  }
  function fhodrs(f, o, l, hpl) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/odrvtrngs",
      method: "post",
      data: {
        fhodrsstr: "ysstrefhstr",
        s: $("#hnsnmrvliptbx").val(),
        t: tb,
        o: o,
        l: l,
      },
      beforeSend: () => {
        if (hpl) {
          $("div.pageloader").show();
          preloaderon();
        }
      },
      success: (data) => {
        $("div.pageloader").hide();
        if (data != 0 && data != "q0") {
          if (gtodrs != "") {
            clearInterval(gtodrs);
          }
          if (f) {
            $(tbp).children(".strpgmdbdyctgsdvx").html(data);
          } else {
            $(tbp).children(".strpgmdbdyctgsdvx").append(data);
          }
          orgptamt();
          ttlamt();
          ttitms();
          strodrmntrngfn();
          pmtrcvdont();
          opndsply(false, false);
        } else {
          if (l == "sch") {
            showsnackpopup("No order found!", true, "non");
          } else if (f) {
            $(tbp)
              .children(".strpgmdbdyctgsdvx")
              .html("<center><h3>You have no new orders now!</h3></center>");
          }
        }
      },
    });
  }
  odlmtfnctn();
  function odlmtfnctn() {
    $(".lmodschvrnbtn").click((e) => {
      if ($(e.target).closest(".lmodschvrnbtn").hasClass("fa-chevron-down")) {
        $(".tlmtodrscngbledvbx").slideDown(200);
        $(".tlmtodrscngbledvbx").css({ display: "flex" });
        $(e.target)
          .closest(".lmodschvrnbtn")
          .removeClass("fa-chevron-down")
          .addClass("fa-chevron-up");
      } else {
        $(".tlmtodrscngbledvbx").slideUp(200);
        $(e.target)
          .closest(".lmodschvrnbtn")
          .addClass("fa-chevron-down")
          .removeClass("fa-chevron-up");
      }
    });
    $(".nwlmtnmrrster").keyup((e) => {
      $(".lmodrcntspntg").text($(e.target).val());
    });
    var lmbnclckd = false;
    $(".nwlmtrsetrbtn").click(() => {
      if (!lmbnclckd) {
        $.ajax({
          url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
          type: "post",
          data: {
            odlmt: "trelmtodr",
            s: $("#hnsnmrvliptbx").val(),
            olm: $(".nwlmtnmrrster").val(),
          },
          beforeSend: (data) => {
            $(".nwlmtrsetrbtn").text("LIMITING...");
            lmbnclckd = true;
          },
          success: (data) => {
            if (data == "1") {
              $(".nwlmtrsetrbtn").text("LIMITED");
              showsnackpopup(
                "Your store receiving orders limited to " +
                  $(".nwlmtnmrrster").val() +
                  " successfully!",
                true,
                true
              );
              setTimeout(() => {
                lmbnclckd = false;
                $(".nwlmtrsetrbtn").text("LIMIT");
              }, 4000);
            } else {
              lmbnclckd = false;
              $(".nwlmtrsetrbtn").text("LIMIT");
              showsnackpopup(
                "Sorry! Failed to limit orders, try again later.",
                true,
                "non"
              );
            }
          },
          error: (err) => {
            lmbnclckd = false;
            $(".nwlmtrsetrbtn").text("LIMIT");
            showsnackpopup(
              "Sorry! Failed to limit orders, try again later.",
              true,
              "non"
            );
          },
        });
      }
    });
  }
  function strodrmntrngfn() {
    document.querySelectorAll(".stronrbdyctnrdvbx").forEach((bybx) => {
      var bodr = bybx.querySelectorAll(".strecstmrmnodrlstdvtgbx");
      // $(".strsodrinnmcntngspntgbx").text(bodr.length);
      bodr.forEach((odr, idx) => {
        var odrpcd = false;
        var usdls = (odr) => {
          $(".mtrngnmalldnbtnifallitmsarpckddvbx").unbind();
          var i = $(odr).attr("data-i");
          var n = $(odr).attr("data-nm");
          var am = $(odr).attr("data-at");
          var dspoid = $(odr).attr("data-oi");
          var orid = $(odr).children().attr("data-or");
          $(".lbx-cmsrsr-pflpc-dsply").html(
            `<img src='${i}' class='lbx-cmsrscr-pfig'>`
          );
          $(".srcmrtxtdls").text(n);
          $(".lbx-srcmr-pfunm").text("@" + am);
          $("#cmoid").text(":" + dspoid);
          /////////////////////
          var adrs = $(odr).attr("data-adrs");
          adrs = adrs.split("/||/");
          $("#cmnme").text(": " + adrs[0]);
          $("#cmads").text(": " + adrs[1]);
          $("#cmcty").text(": " + adrs[2]);
          $("#cmstat").text(": " + adrs[3]);
          $("#cmpncd").text(": " + adrs[4]);
          $("#cmpnmr").text(": " + adrs[5]);
          /////////////////////
          if (!$(".strbsnprfpicimg").length) {
            $(".strbsnprfpiccntnrdvbox").html(
              `<img src='${i}' class='strbsnprfpicimg'>`
            );
          } else {
            $(".strbsnprfpicimg").attr("src", i);
          }
          $(".strnamecntnrdvbx").text(n);
          $(".strscstmrsatmtncntngspntg").text(am);
          $(".strordrmtnrngdvbx,.mtrngnmalldnbtnifallitmsarpckddvbx").attr(
            "data-op",
            orid
          );
          var ckds = 0;
          var $pids = [];
          odr
            .querySelectorAll('input[type="checkbox"]:checked')
            .forEach((pt) => {
              ckds += 1;
              var $qnty = $(pt)
                .parent()
                .parent()
                .siblings(".strcntngordritmdtlscntngdvbx")
                .children(".cmrdsrditmothdtlscntngdvbx")
                .children(".cmrdsrditmqntycntnrdvbx")
                .text()
                .trim();
              $qnty = $qnty.substr(0, 1) == "." ? $qnty.substr(1) : $qnty;
              var qty = $(pt)
                .parent()
                .siblings(".strownrpgodrngitmsqntyandprccntngdvbx")
                .children(".stronrpgitmsqntyctnrdvbx")
                .children(".qntinnmofthsitmbxnspng")
                .text();
              var $pdprc = $(pt)
                .parent()
                .siblings(".strownrpgodrngitmsqntyandprccntngdvbx")
                .children(".strownrpgordrditmsprceandcrncycntnrdvbx")
                .children(".odritmcstdtatcnttl")
                .attr("data-cst");
              $pids.push([
                $(pt).attr("data-p") + ",/",
                "/" + $qnty + ",/",
                "/" + qty + ",/",
                "/" + $pdprc + "//",
              ]);
            });
          var ttlims = parseInt(
            $(odr)
              .children()
              .children()
              .children()
              .children(".noitmsinlstbtmhrctnrdvbx")
              .text()
          );
          $(".ttlitmslfttopckinodrspntg").text(ttlims - ckds);
          if (ttlims - ckds > 0) {
            if ((ckds / ttlims) * 100 > 40 && (ckds / ttlims) * 100 < 60) {
              orupdts(
                false,
                $(odr).children(".ordrdlstartletgcntnrdvbox").attr("data-or"),
                $(odr).children(".ordrdlstartletgcntnrdvbox").attr("data-cd"),
                2,
                ""
              );
            }
            $(".mtrngnmalldnbtnifallitmsarpckddvbx").hide();
          } else {
            $(".mtrngnmalldnbtnifallitmsarpckddvbx")
              .show()
              .click(() => {
                var noods = parseInt($(".strsodrinnmcntngspntgbx").text());
                var opd = $(odr).children(".ordrdlstartletgcntnrdvbox");
                if (parseInt(opd.attr("data-pd")) == 0) {
                  $unm = am;
                  if (
                    confirm(
                      `Are you sure you packed all the items of the order @${$unm}?`
                    )
                  ) {
                    if (noods > 0) {
                      $(".strsodrinnmcntngspntgbx").text(noods - 1);
                      var tout = 200;
                      opd.attr("data-pd", "1").slideUp(tout);
                      $(odr).slideUp(200);
                      setTimeout(() => {
                        $(odr).remove();
                      }, tout);
                      odrpcd = true;
                      $(".odrdlvsntbtn,.odrdlvrcntngdvbx").hide();
                      $(
                        ".usrshpngcrgscntngdvbx,.procdbtnctngdvbx,.prcdbtn,.strcsmradrspupbx"
                      ).show();
                      odrccgsgstpcd(
                        true,
                        $(odr)
                          .children(".ordrdlstartletgcntnrdvbox")
                          .attr("data-or"),
                        $(odr)
                          .children(".ordrdlstartletgcntnrdvbox")
                          .attr("data-cd"),
                        3,
                        $pids.toString().slice(0, -2)
                      );
                    }
                  }
                }
              });
          }
        };
        odr.querySelectorAll(".chckbxtochcktheitmthatpackd").forEach((cb) => {
          $(cb).click(() => {
            if (cb.checked) {
              $(cb).parent().parent().parent().css("background", "#c3f3eab8");
            } else {
              $(cb).parent().parent().parent().css("background", "#f8f5f5a8");
            }
          });
        });
        usdls(bodr[0]);
        $(odr)
          .on("touchmove", () => usdls(odr))
          .click(() => usdls(odr));
      });
    });
  }
  $(".strrolspgnvgtbn").click((e) => {
    var sunm = $(".strrolspgnvgtbn").attr("data-sn");
    var s = $("#hnsnmrvliptbx").val();
    $.ajax({
      url: "storeroles",
      method: "get",
      data: { s: s, gtit: "ystregtit" },
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $("body").removeClass("storecustmrpgbdy");
        $(document).attr("title", "storeroles | Remindo");
        $("div.remindochildboxycontainer").html(data);
        window.history.pushState(
          {},
          {},
          "http://localhost/remindo/stores/storeroles?s=" + sunm
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  $(".strovrvwisgtsnvgtnbtndvbx").click((e) => {
    var sunm = new URL(window.location.href).searchParams.get("s");
    var s = $("#hnsnmrvliptbx").val();
    $.ajax({
      url: `overview`,
      method: "get",
      data: { srovrigs: "ytopovrigstre", s: s },
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
          "http://localhost/remindo/stores/overview?s=" + sunm
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  function orupdts($sp, o, cid, sts, $pp, ccg, gst) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
      method: "post",
      data: {
        udtodrsts: "ystrudtofodr",
        o: o,
        sid: $("#hnsnmrvliptbx").val(),
        cid: cid,
        sts: sts,
        cg: ccg,
        gt: gst,
      },
      beforeSend: () => {
        $(".prcdbtn").text("proceeding...");
      },
      success: (data) => {
        $(".prcdbtn").text("proceed");
        if (data != 0) {
          if ($sp) {
            $(".strcsmradrspupbx").hide();
            showsnackpopup("You packed order successfully!", true, true);
            if ($pp != "") {
              $.ajax({
                url: "http://localhost/remindo/stsupsflr/strprdts",
                method: "post",
                data: {
                  uppdtnmr: "ystreupnmr",
                  p: $pp,
                  s: $("#hnsnmrvliptbx").val(),
                },
              });
            }
          }
        } else {
          if ($sp) {
            $(".strcsmradrspupbx").hide();
            showsnackpopup(
              "Sorry! Failed to pack order. Try again.",
              true,
              "non"
            );
          }
        }
      },
      error: () => {
        showsnackpopup("Sorry! Failed to pack order. Try again.", true, "non");
      },
    });
  }
  /////////////////
  function pmtrcvdont() {
    $(".ysodrpidtre").click((e) => {
      var ysbn = $(e.target).closest(".ysodrpidtre");
      $.ajax({
        url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
        method: "post",
        data: {
          udtodrsts: "ystrudtofodr",
          s: $("#hnsnmrvliptbx").val(),
          o: $(ysbn).attr("data-o"),
          c: $(ysbn).attr("data-c"),
          yos: "ys",
        },
        beforeSend: () => {
          $(ysbn).hide().siblings().hide();
          $(ysbn)
            .parent()
            .append(
              "<div class='prldrspnr'><center><div style='color:#ff8d00;'><i class='fas fa-circle-notch fa-spin' style='font-weight:900;'></i> Updating...</div></center></div>"
            );
        },
        success: (data) => {
          $(ysbn).siblings(".prldrspnr").remove();
          if (data == 1) {
            var tamt = parseInt(
              $(ysbn)
                .parent()
                .parent(".odrvrfycninodr")
                .parent(".ordrlstftrcntnrdvbox")
                .siblings(".ordrlstbdycntnrdvbx")
                .children(".odrgstccgpcdlscntnrdvbx")
                .children(".tamtcnrcycntnrdvbx")
                .children(".ttlamntwthccgstspntg")
                .text()
            );
            $(ysbn)
              .parent()
              .parent(".odrvrfycninodr")
              .parent(".ordrlstftrcntnrdvbox")
              .html(
                "<div style='text-align:center;'><i class='fas fa-shipping-fast remindosymbols' style='color:orange'></i><span style='color:orange'>Ready to delivery</span></div>"
              );
            $.ajax({
              url: "http://localhost/remindo/stsupsflr/strprdts",
              method: "post",
              data: {
                upsdlsnmr: "ystreupmnynmr",
                s: $("#hnsnmrvliptbx").val(),
                ta: tamt,
              },
            });
          } else {
            $(ysbn).show().siblings().show();
            showsnackpopup("Failed to upadte! Try again.", true, "non");
          }
        },
        error: () => {
          $(ysbn).siblings(".prldrspnr").remove();
          $(ysbn).show().siblings().show();
          showsnackpopup("Failed to upadte! Try again.", true, "non");
        },
      });
    });
    $(".noodrpidfls").click((e) => {
      var ysbn = $(e.target).closest(".noodrpidfls");
      $.ajax({
        url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
        method: "post",
        data: {
          udtodrsts: "ystrudtofodr",
          s: $("#hnsnmrvliptbx").val(),
          o: $(ysbn).attr("data-o"),
          c: $(ysbn).attr("data-c"),
          yos: "no",
        },
        beforeSend: () => {
          $(ysbn).hide().siblings().hide();
          $(ysbn)
            .parent()
            .append(
              "<div class='prldrspnr'><center><div style='color:#ff8d00;'><i class='fas fa-circle-notch fa-spin' style='font-weight:900;'></i> Updating...</div></center></div>"
            );
        },
        success: (data) => {
          $(ysbn).siblings(".prldrspnr").remove();
          if (data == 1) {
            $(ysbn)
              .parent()
              .parent(".odrvrfycninodr")
              .parent(".ordrlstftrcntnrdvbox")
              .html("<div style='text-align:center;'>Updated</div>");
          } else {
            $(ysbn).show().siblings().show();
            showsnackpopup("Failed to upadte! Try again.", true, "non");
          }
        },
        error: () => {
          $(ysbn).siblings(".prldrspnr").remove();
          $(ysbn).show().siblings().show();
          showsnackpopup("Failed to upadte! Try again.", true, "non");
        },
      });
    });
    $(".sndtodlvryodrbtn").click((e) => {
      $(".usrshpngcrgscntngdvbx,.prcdbtn").hide();
      $(
        ".odrdlvsntbtn,.procdbtnctngdvbx,.odrdlvrcntngdvbx,.strcsmradrspupbx"
      ).show();
      var stsbx = $(e.target);
      $(".odrdlvsntbtn").click(() => {
        var dtxt = $("#rmdodrdlvtxt").val();
        if (dtxt.trim() == "") {
          $(".corerrordsply").text("Please enter delivery details.");
          $("#rmdodrdlvtxt").css("border", "2px solid red");
        } else {
          $(".corerrordsply").text("");
          $("#rmdodrdlvtxt").css("border", "1px solid gray");
          $.ajax({
            url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
            method: "post",
            data: {
              udtodrsts: "ystrudtofodr",
              s: $("#hnsnmrvliptbx").val(),
              o: $(stsbx).attr("data-o"),
              c: $(stsbx).attr("data-c"),
              yos: "dx",
              dtx: dtxt,
            },
            beforeSend: () => {
              $(".odrdlvsntbtn").text("Sending...");
            },
            success: (data) => {
              $(".odrdlvsntbtn").text("Send");
              if (data == 1) {
                $(stsbx).text("Delivering...");
                $(".strcsmradrspupbx").hide();
                showsnackpopup(
                  "Order status updated successfully!",
                  true,
                  true
                );
                $(stsbx).unbind();
                $(".odrdlvsntbtn").unbind();
              } else {
                showsnackpopup(
                  "Failed to update order status! Try again.",
                  true,
                  "non"
                );
              }
            },
            error: () => {
              showsnackpopup(
                "Failed to update order status! Try again.",
                true,
                "non"
              );
            },
          });
        }
      });
    });
  }
  function odrccgsgstpcd($sp, o, cid, sts, $ppd) {
    $(".prcdbtn").click(() => {
      var ccg = $("#rmdodrcrcg").val();
      var gst = $("#rmdgstodr").val();
      if (ccg.trim() == "") {
        $("#rmdodrcrcg").css("border", "2px solid red");
      } else {
        $("#rmdodrcrcg").css("border", "0");
      }
      if (gst.trim() == "") {
        $("#rmdgstodr").css("border", "2px solid red");
      } else {
        $("#rmdgstodr").css("border", "0");
        orupdts($sp, o, cid, sts, $ppd, ccg, gst);
        $(".prcdbtn").unbind();
      }
    });
  }
  $(".vmpstrprfbsndtlscntnrdvbx").click((e) => {
    $(".strcsmradrspupbx .usradrescntngdvbx").text(
      $(".vmpstrprfbsndtlscntnrdvbx").attr("data-adrs")
    );
    $(".usrshpngcrgscntngdvbx,.odrdlvrcntngdvbx,.procdbtnctngdvbx").hide();
    $(".strcsmradrspupbx").show();
  });
  function gtntfcnppup(e) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
      method: "post",
      data: {
        ntfirlysr: "ysrlysrptre",
        s: $("#hnsnmrvliptbx").val(),
      },
      dataType: "json",
      success: (data) => {
        if (data != 0 && data.d == "d0") {
          showsnackpopup(data.nmg, false, "non", true, "No/Yes", () => {
            uspmtrvd(e, data.nd, $("#hnsnmrvliptbx").val(), data.cd);
          });
        }
      },
    });
  }
  function uspmtrvd(e, $n, $sid, $cid) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/srcritrxnnts",
      method: "post",
      data: {
        nfupd1: "ysnfup1tre",
        n: $n,
        s: $sid,
        tp: "fspg",
        c: $cid,
      },
    });
    e.stopImmediatePropagation();
    return false;
  }
  if ($("#hdnvlsrolpsn").val() == "onr") {
    // gtntfcnppup();
    // setInterval((e) => {
    // gtntfcnppup(e);
    // }, 20000);
  }
  strhlgtr();
  function strhlgtr() {
    $("#swthstrbtn").click((e) => {
      $(".strhghltspupbx").show();
    });
    var hltd = false,
      ghts = $(".strhghltscntngdvbx").text();
    $(".updthghlts").click((e) => {
      var lhts = $(".strhghltscntngdvbx").text();
      if (!hltd && ghts != lhts) {
        var hlts = $(".strhghltscntngdvbx").html();
        hlts = hlts
          .replace(/<div>/gi, "*/*")
          .replace(/<span>/gi, "")
          .replace(/<br>/gi, "")
          .replace(/&nbsp;/gi, "")
          .replace(new RegExp("</div>", "gi"), "")
          .replace(new RegExp("</br>", "gi"), "")
          .replace(new RegExp("</span>", "gi"), "");
        $.ajax({
          url: "http://localhost/remindo/stsupsflr/strdtlsupdt",
          method: "post",
          data: { strhlts: "tresrhlts", s: $("#hnsnmrvliptbx").val(), h: hlts },
          beforeSend: () => {
            hltd = true;
            $(".updthghlts").text("Highlighting...");
          },
          success: (data) => {
            if (data == "1") {
              ghts = lhts;
              $(".updthghlts").text("Highlighted!");
              showsnackpopup("Highlighted successfully!", true, "non");
              setInterval(() => {
                $(".updthghlts").text("Highlight");
                hltd = false;
              }, 5000);
            } else {
              hltd = false;
              $(".updthghlts").text("Highlight");
              showsnackpopup(
                "Failed to update Highlights. Please try again later.",
                true,
                "non"
              );
            }
          },
          error: () => {
            hltd = false;
            $(".updthghlts").text("Highlight");
            showsnackpopup(
              "Failed to update Highlights. Please try again later.",
              true,
              "non"
            );
          },
        });
      }
    });
  }
});
