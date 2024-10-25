$(document).ready(() => {
  $("#send-email-button").click(() => {
    $("#send-email-button").text("Sending Email...");
  });
  $(".sign-but").click(() => {
    $(".signup-popup-container").css("display", "block");
  });

  $("#cancle-signup-popup").click(() => {
    $(".signup-popup-container").css("display", "none");
  });
  setTimeout(() => {
    $("#session_msg").fadeOut(1000);
  }, 2000);
  document.querySelectorAll(".shwabtcntsqbtn").forEach((tps) => {
    var pw = $(tps).parent().parent().siblings(".strathmbnldtlscntngdvbx");
    var ad = "";
    $(tps).hover(
      () => {
        pw.fadeIn(500);
        $(".strathmbnldtlscntngdvbx").css(
          "margin-top",
          "-" + $(".rmracntdtlsprvctngdvbx").css("height")
        );
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
});
