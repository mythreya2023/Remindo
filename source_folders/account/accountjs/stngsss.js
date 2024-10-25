$(document).ready(function () {
  $(".remindosettingsbacknavigationbtn").click(function () {
    $.ajax({
      url: "../profile",
      method: "get",
      data: { nvprfpg: "trys" },
      dataType: "json",
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $("div.pageloader").hide();
        let title = "Profile | Remindo";
        $(document).attr("title", title);
        $("div.remindochildboxycontainer").html(data.body);
        window.history.pushState({}, {}, "http://localhost/remindo/profile");
      },
    });
  });
  //
  let prvc = false,
    ntf = false;
  $(".settingsprivacyoptioncontainerdivbox").click(function () {
    if (!prvc) {
      $(".prcysrctyctnrbx").slideDown();
      prvc = true;
    } else {
      $(".prcysrctyctnrbx").slideUp();
      prvc = false;
    }
  });
  $(".settingsnotifioptioncontainerdivbox").click(function () {
    if (!ntf) {
      $(".notifysmldvbx").slideDown();
      ntf = true;
    } else {
      $(".notifysmldvbx").slideUp();
      ntf = false;
    }
  });
  $(".hidepopupbtn").click(function () {
    $(".settingspopupcontainerbox").hide();
    $(".popupbackground").hide();
  });
  $(".disalwtsndemlsasntfies").click(() => {
    updtstngs("milntfy", $(".disalwtsndemlsasntfies").attr("data-ud"));
  });
  function updtstngs(tp, uod) {
    $.ajax({
      url: "acntstgsprvc.php",
      method: "post",
      data: { udtstngs: "udttre", tp: tp, uod: uod },
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        if (data != "") {
          $("div.pageloader").hide();
        }
      },
    });
  }
  $(".privacysecuritychangepwdcontainerdivbox").click(() => {
    $(".stngscngpwdppbg,.stngscngpwdppcntrbx").show();
  });
  $(".chngacpwdbtn").click(function () {
    let od = $(".odpasiptbx").val();
    let nw = $(".nwpasiptbx").val();
    let cnw = $(".cnwpasiptbx").val();
    let tt = od + nw + cnw;
    if (od === "" || nw === "" || cnw === "" || tt.length < 24) {
      $(".pderrcs").show();
      if (od === "" || od.length < 8) {
        if (od === "") {
          $(".pderrcs").text("Password should not be empty.");
        } else {
          $(".pderrcs").text("Password should be morethan 8 characters");
        }
        $(".odpasiptbx").css("border", "2px solid red");
      } else {
        $(".odpasiptbx").css("border", "none");
      }
      if (nw === "" || nw.length < 8) {
        if (nw === "") {
          $(".pderrcs").text("Password should not be empty.");
        } else {
          $(".pderrcs").text("Password should be morethan 8 characters");
        }
        $(".nwpasiptbx").css("border", "2px solid red");
      } else {
        $(".nwpasiptbx").css("border", "none");
      }
      if (cnw === "" || cnw.length < 8) {
        if (cnw === "") {
          $(".pderrcs").text("Password should not be empty.");
        } else {
          $(".pderrcs").text("Password should be morethan 8 characters");
        }
        $(".cnwpasiptbx").css("border", "2px solid red");
      } else {
        $(".cnwpasiptbx").css("border", "none");
      }
    } else {
      $(".pderrcs").hide();
      $(".odpasiptbx,.nwpasiptbx,.cnwpasiptbx").css("border", "none");
      $.ajax({
        url: "acntstgsprvc.php",
        method: "post",
        data: { chngdtpwd: "chngudttre", odpd: od, nwpd: nw, cnwpd: cnw },
        beforeSend: function () {
          $("div.pageloader").show();
          preloaderon();
        },
        success: function (data) {
          $("div.pageloader").hide();
          if (data == "Updated!") {
            $(".pderrcs")
              .show()
              .text("Updated!")
              .css("background-color", "#e8f0fe")
              .css("color", "#1967d2");
            setTimeout(() => {
              $(".settingspopupcontainerbox").hide();
              $(".popupbackground").hide();
            }, 2000);
          } else {
            $(".pderrcs").show().text(data);
          }
          $(".odpasiptbx").val("");
          $(".nwpasiptbx").val("");
          $(".cnwpasiptbx").val("");
        },
      });
    }
  });
});
$(".settinglgotoptioncontainerdivbox").click(function () {
  $.ajax({
    url: "../loginSignup/logout.php",
    method: "get",
    data: { usrlgoot: "trelgot" },
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      $("div.pageloader").hide();
      if (data == "done") {
        window.open("../signin", "_self");
      }
    },
  });
});
