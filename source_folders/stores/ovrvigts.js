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
  $(".ovrvwpgbckbtn").click(() => {
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
  var up = false;
  $(".ovrvwpullbarcntnr").click((e) => {
    console.log(up);
    if (!up) {
      $(".rmdostrovrvwpgsbdycntngdvbx")
        .css("position", "absolute")
        .css("top", 0);
      up = true;

      var point = parseInt(
        $(".rmdoovrpgdvbxcmrspdtscntngdvbx").css("margin-top")
      );

      var yem = point / 12;
      var percent = yem * 100;
      console.log(point, yem, percent, 100 - percent, window.innerHeight);
      $(".rmoothcntrsovrldvcntnrdvbx").css(
        "height",
        window.innerHeight - point + "px"
      );
    } else {
      up = false;
      $(".rmdostrovrvwpgsbdycntngdvbx").css("position", "static");
    }
  });
  fchovrvwfmdb();
});
function fchovrvwfmdb() {
  $.ajax({
    url: "../stsupsflr/strovrvw.php",
    method: "get",
    data: { fchstrovrew: "trefhsrovrw", s: $("#hnitsidval").val() },
    beforeSend: () => {
      $(".rmoothcntrsovrldvcntnrdvbx").html(`
      <div class='prldrspnr' style='margin:auto;'><center><div style='margin:20px 6px;display: flex;justify-content: center;align-items: center;color:#ff8d00;'><i class='fas fa-circle-notch fa-spin' style='font-weight: 500;font-size: 35px;'></i> <div>Analysing your data...</div></div></center></div>`);
    },
    success: (data) => {
      $(".rmoothcntrsovrldvcntnrdvbx").html(data);
    },
  });
}
