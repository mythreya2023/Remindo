$(document).ready(function () {
  $(".rmdmnsrchbxshwbtn").click(function () {
    $(".serchdvbx").show();
    $(".rmdomainsrchbar").focus();
    $(".rmdmnsrchbxshwbtn").hide();
  });
  $(".hdsrchbtn").click(function () {
    $(".serchdvbx").hide();
    $(".rmdmnsrchbxshwbtn").show();
  });
  $(".clrtxtinsrchbx").click(function () {
    $(".rmdomainsrchbar").val("").focus();
  });
  $(".rmdomainsrchbar").keyup(function (e) {
    e.preventDefault();
    var t = $(".rmdomainsrchbar").val();
    $.ajax({
      url: "http://localhost/remindo/srch/serprfls",
      method: "post",
      data: { srchqury: t },
      beforeSend: function () {
        $("div.pageloader").show();
      },
      success: function (data) {
        $("div.pageloader").hide();
        $(".srchsugstnsdvbx").html(data);
        hdrblbtnclckfuns();
      },
    });
    if (e.keyCode === 13) {
      $.ajax({
        url: "http://localhost/remindo/search",
        method: "get",
        data: { opnsrchpg: "opnsrch", q: t },
        dataType: "JSON",
        beforeSend: function () {
          $("div.pageloader").show();
        },
        success: function (data) {
          $("div.pageloader").hide();
          $(".remindomainheaderlptpvsn").html("");
          let title = "Search | Remindo";
          $(document).attr("title", title);
          $("div.remindochildboxycontainer").html(data.body);
          $("div.pageloader").hide();
          window.history.pushState(
            {},
            {},
            "http://localhost/remindo/search?q=" + t
          );
        },
      });
      e.stopImmediatePropagation();
      return false;
    }
  });
  $(".remindonavhomebtncontainer").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "http://localhost/remindo/home",
      method: "get",
      data: { shmpgrm: "yshm" },
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      dataType: "JSON",
      success: function (data) {
        let title = "Remindo";
        $(document).attr("title", title);
        $("div.remindochildboxycontainer").html(data.body);
        $("div.pageloader").hide();
        window.history.pushState({}, {}, "http://localhost/remindo/");
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  $(".remindonavmktstsbtncontainer").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "http://localhost/remindo/stores",
      method: "get",
      data: { sstrsnm: "treshw" },
      dataType: "JSON",
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer").html(data.body);
        $("div.pageloader").hide();
        window.history.pushState({}, {}, "http://localhost/remindo/stores");
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  $(".remindoprofilebtn,.reminouserprofilepic").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "http://localhost/remindo/profile",
      method: "get",
      data: { nvprfpg: "trys" },
      dataType: "json",
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $(".remindomainheaderlptpvsn").html("");
        let title = "Profile | Remindo";
        $(document).attr("title", title);
        $("div.remindochildboxycontainer").html(data.body);
        $("div.pageloader").hide();
        window.history.pushState({}, {}, "http://localhost/remindo/profile");
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
});
$(".remindonavmktstsbtncontainer").click(function (e) {
  e.preventDefault();
  $.ajax({
    url: "http://localhost/remindo/stores",
    method: "get",
    data: { sstrsnm: "treshw" },
    dataType: "JSON",
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $(document).attr("title", data.title);
      $("div.remindochildboxycontainer").html(data.body);
      $("div.pageloader").hide();
      window.history.pushState({}, {}, "http://localhost/remindo/stores");
    },
  });
  e.stopImmediatePropagation();
  return false;
});
$(".remindonfcsnavigator,.remindonfcstsbtncontainer").click(function (e) {
  e.preventDefault();
  $.ajax({
    url: "http://localhost/remindo/notifications",
    method: "get",
    data: { nfpg: "ysnfcs", tns: $(".nfcnsbdge").text() },
    dataType: "json",
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $("div.pageloader").hide();
      $(".remindomainheaderlptpvsn").html("");
      $(document).attr("title", data.title);
      $("div.remindochildboxycontainer").html(data.body);
      $("div.pageloader").hide();
      window.history.pushState(
        {},
        {},
        "http://localhost/remindo/notifications"
      );
    },
  });
  e.stopImmediatePropagation();
  return false;
});

function hdrblbtnclckfuns() {
  document.querySelectorAll(".rmdosrchdacntsnm").forEach((gst) => {
    $(gst).click((e) => {
      var uscs = true;
      e.preventDefault();
      $.ajax({
        url: "http://localhost/remindo/stores/store",
        method: "post",
        data: { s: $(gst).attr("data-s") },
        dataType: "json",
        beforeSend: () => {
          $("div.pageloader").show();
          preloaderon();
        },
        success: (data) => {
          uscs = false;
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
          if (uscs) {
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
  $(".pnacntbtn").click((e) => {
    e.preventDefault();
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/strdtlsupdt",
      method: "post",
      data: {
        pnsr: "trepnstr",
        sd: $(".pnacntbtn").attr("data-p"),
      },
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $("div.pageloader").hide();
        if (data == 1) {
          $(e.target)
            .closest(".pnacntbtn")
            .parent(".rmdosrchdacntsunpdpnbx")
            .html("");
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
}

window.addEventListener("popstate", (e) => {
  e.preventDefault();
  let pgurl = e.currentTarget.window.location.href;
  $.ajax({
    url: pgurl,
    method: "post",
    data: { ppsttevt: "frdppstt" },
    dataType: "json",
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $(document).attr("title", data.title);
      $("div.remindochildboxycontainer").html(data.body);
      $("div.pageloader").hide();
      window.history.pushState({}, {}, pgurl);
    },
  });
  e.stopImmediatePropagation();
  return false;
});
if (!$(".lgn_btn_stplvtcns").length) {
  var pnms = [
    "/remindo/stores.php",
    "/remindo/",
    "/remindo/home",
    "/remindo/home.php",
  ];
  var lkfups = 10000;
  var ulvtid = "";
  if (pnms.includes(window.location.pathname)) {
    ulvtid = setInterval(() => {
      if (pnms.includes(window.location.pathname)) {
        $.get(
          "stsupsflr/srcritrxnnts",
          {
            lvutnfs: "trelupdsncs",
          },
          (data) => {
            if (data == 0) {
              lkfups = 10000;
              $(".nfcnsbdge").hide();
            } else if (!isNaN(data)) {
              lkfups = 10000;
              $(".nfcnsbdge").text(data).show();
            } else if (data == "q0") {
              lkfups = 60000;
              $(".nfcnsbdge").hide();
            }
          }
        );
        return false;
      } else {
        clearInterval(ulvtid);
        return false;
      }
    }, lkfups);
  }
}
//snckbarfun
function showsnackpopup(txt, exct, g, ysn, ystxt, fun) {
  var x = document.getElementById("snackbar");
  x.className = "show";
  var $c = "color:white;";
  if (!g) {
    $c = "color:#f53d3d;";
  } else {
    $c = "color:#08ff08;";
  }
  if (g == undefined || g == "non") {
    $c = "color:white;";
  }
  var $s = "";
  const btnstyle =
    "color: white;background: #524b4b;margin:0 3px;padding: -2px;font-size: 14px;padding:4px;width: 50%;cursor: pointer;";
  if (ysn) {
    yst = ystxt.split("/");
    $s =
      "<br><div style='display:flex;justify-content:space-between;'><div class='stackbtnno' style='" +
      btnstyle +
      "'>" +
      yst[0] +
      "</div><div class='stackbtnyes' style='" +
      btnstyle +
      "'>" +
      yst[1] +
      "</div></div>";
  }
  $(x).html("<div><div style='" + $c + "'>" + txt + "</div>" + $s + "</div>");
  if (exct) {
    setTimeout(function () {
      x.className = x.className.replace("show", "");
    }, 3000);
  }

  $(".stackbtnno").click(() => {
    return (x.className = x.className.replace("show", ""));
  });
  $(".stackbtnyes").click(() => {
    x.className = x.className.replace("show", "");
    return fun();
  });
}
//onoflndtctn
var cncn = true;
function netwrkdtctn() {
  if (!navigator.onLine) {
    cncn = false;
    showsnackpopup(
      "Your network connection lost.<span style='color:#f53d3d;'><strong> No connection!</strong></span>",
      false
    );
  } else {
    if (!cncn) {
      showsnackpopup(
        "Your network connection gained.<span style='color:#08ff08;'><strong> Back to online!</strong></span>",
        true
      );
    }
    cncn = true;
  }
}
setInterval(() => {
  netwrkdtctn();
}, 2000);
