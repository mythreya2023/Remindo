$(document).ready(function () {
  var os = 0;
  var lt = 5;
  let p = $(".srchqurforcntr").text();
  $(".rmdomainsrchiptbx").val(p);
  srchs(true, p, os, lt);
  $(".rmdomainsrchiptbx").keyup(() => {
    srchs(true, $(".rmdomainsrchiptbx").val(), 0, 5);
  });
  $(".clrtxtinmainsrchbx").click(() => {
    $(".rmdomainsrchiptbx").val("").focus();
  });

  $(document).on("touchmove", scrlfun);
  $(window).scroll(scrlfun);
  function scrlfun() {
    if (
      $(window).scrollTop() + $(window).height() + 10 >
      $(".remindochildboxycontainer").height()
    ) {
      os += lt;
      srchs(false, $(".rmdomainsrchiptbx").val(), os, lt);
    }
  }
  function srchs($f, p, os, lt) {
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/strcmspns.php",
      method: "post",
      data: { srchsrs: "srchtres", srh: p, os: os, lt: lt },
      success: function (data) {
        if (data == 0) {
          if ($f) {
            $(".mainsrchrsltsdvbx").html(
              "<center><p style='color:gray;'>No business found!. Try to search with full business name or it's username</p></center>"
            );
          }
        } else if (data == "q0") {
          if ($f) {
            $(".mainsrchrsltsdvbx").html(
              "<center><p style='color:gray;'>Sorry! failed to execute your search. Try again later.</p></center>"
            );
          }
        } else {
          if ($f) {
            $(".mainsrchrsltsdvbx").html(data);
          } else {
            $(".mainsrchrsltsdvbx").append(data);
          }
          pnstr();
        }
      },
    });
  }
});
$(".pfbcksrchbtn").click(function () {
  window.history.back();
});
function pnstr() {
  document.querySelectorAll(".strprfnmcntngdvbx").forEach((tps) => {
    var pw = $(tps).parent().parent().siblings(".rmracontprewvttlsetctngdvbx");
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
  reusblbtnclckfuns();
}
function reusblbtnclckfuns() {
  document.querySelectorAll(".gtstrpgclstrngtr").forEach((gst) => {
    $(gst).click((e) => {
      var unscs = true;
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
          unscs = false;
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
          if (unscs) {
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
          }
        },
      });
      e.stopImmediatePropagation();
      return false;
    });
  });
  document.querySelectorAll(".pnstrbtndvbx").forEach((pnsr) => {
    $(pnsr).click((e) => {
      $.ajax({
        url: "http://localhost/remindo/stsupsflr/strdtlsupdt.php",
        method: "post",
        data: {
          pnsr: "trepnstr",
          sd: $(pnsr).attr("data-p"),
        },
        beforeSend: function () {
          $("div.pageloader").show();
          preloaderon();
        },
        success: function (data) {
          $("div.pageloader").hide();
          if (data == 1) {
            $(pnsr)
              .closest(".strathmbnldtlscntngdvbx")
              .children(".strpnunpnspnbtndvbx")
              .html("");
            $(pnsr).remove();
            showsnackpopup(
              "<i class='fas fa-thumbtack remindosymbols' style='color:white;transform:rotate(45deg);'></i>You have pinned the store",
              true,
              true
            );
          } else {
            showsnackpopup(
              "<i class='fas fa-thumbtack remindosymbols' style='color:white;transform:rotate(45deg);'></i>Failed to pinned the store. Try again later",
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
}
