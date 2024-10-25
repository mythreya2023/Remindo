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
  $(".strpgmdbdyofodrlstscntnrdvbx").unbind();
  $(".rmdobctostrbtn").click((e) => {
    $.ajax({
      ulr: "store",
      method: "post",
      data: { s: $("#stnmrecptd").val() },
      dataType: "json",
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $("body").removeClass("storeedtspgbdy").addClass("storecustmrpgbdy");
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer").html(data.body);
        window.history.pushState(
          {},
          {},
          "http://localhost/remindo/stores/store?s=" +
            new URL(window.location.href).searchParams.get("s")
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  $(".tmgsipt")
    .on("keyup", (e) => {
      document.querySelector("#nhavblipt").checked = false;
      var etg = $(e.target).val();
      etg = etg.split(":");
      if (isNaN(etg[0]) && etg[0] != "") {
        return $(e.target).val(
          "1" + ":" + (etg[1] == undefined ? "00" : etg[1])
        );
      } else if (isNaN(etg[1]) && etg[1] != "") {
        return $(e.target).val(
          (etg[0] == undefined ? "1" : etg[0]) + ":" + "00"
        );
      }
      if (etg[0] > 12) {
        return $(e.target).val("12" + ":" + etg[1]);
      } else if (etg[0] < 0) {
        return $(e.target).val("1" + ":" + etg[1]);
      }
      if (etg[1] > 60) {
        return $(e.target).val(etg[0] + ":" + 60);
      } else if (etg[1] < 0) {
        return $(e.target).val(etg[0] + ":" + "00");
      }
    })
    .blur((e) => {
      if ($("#nhavblipt").val() == "") {
        document.querySelector("#nhavblipt").checked = true;
      }
      var etg = $(e.target).val();
      if (etg != "") {
        etg = etg.split(":");
        if (etg[1] == "" || etg[1] == undefined) {
          return $(e.target).val((etg[0] == "" ? "1" : etg[0]) + ":" + "00");
        }
        if (etg[0] == "" || etg[0] == undefined) {
          return $(e.target).val("1" + ":" + etg[1]);
        }
      }
    });
  $(".strepmtmtdsselct").val($("#hdptsvledts").val().split(","));
  $(".stredtsupdtcmpltdnxtpgbtn").click((e) => {
    var strnm = $(".strflnm").val();
    var at = $(".streusat").val();
    var cg = document.querySelector(".strecatgreselct");
    var cg = cg.options[cg.selectedIndex].text;
    var ads = $(".streadrsipt").val();
    var mbl = $(".strmblnm").val();
    var eml = $(".edtstreml").val();
    var ptms = $(".strepmtmtdsselct").val();
    var a = /^[789]\d{9}$/;
    var mber = (txt) => {
      $(
        ".strflnm,.streusat,.strecatgreselct,.strepmtmtdsselct,.streadrsipt"
      ).css("border", "none");
      $(".strmblnm").css("border", "2px solid red");
      $(".stuperrstsdvbx").text(txt);
    };
    if (
      strnm === "" &&
      at === "" &&
      cg === "-- Select Category --" &&
      mbl === "" &&
      ptms === "" &&
      ads === ""
    ) {
      $(
        ".strflnm,.streusat,.strecatgreselct,.strmblnm,.strepmtmtdsselct,.streadrsipt"
      ).css("border", "2px solid red");
      $(".stuperrstsdvbx").text("Please fill all the details.");
      showsnackpopup("Please fill all the details.", true, false);
    } else if (strnm === "") {
      $(
        ".streusat,.strecatgreselct,.strmblnm,.strepmtmtdsselct,.streadrsipt"
      ).css("border", "none");
      $(".strflnm").css("border", "2px solid red");
      $(".stuperrstsdvbx").text("Please fill the Store name.");
      showsnackpopup("Please fill the Store name.", true, false);
    } else if (strnm.length > 30) {
      $(
        ".streusat,.strecatgreselct,.strmblnm,.strepmtmtdsselct,.streadrsipt"
      ).css("border", "none");
      $(".strflnm").css("border", "2px solid red");
      $(".stuperrstsdvbx").text(
        "Your business name cannot be morethan 20 characters."
      );
      showsnackpopup(
        "Your business name cannot be morethan 20 characters.",
        true,
        false
      );
    } else if (at === "") {
      $(
        ".strflnm,.strecatgreselct,.strmblnm,.strepmtmtdsselct,.streadrsipt"
      ).css("border", "none");
      $(".streusat").css("border", "2px solid red");
      $(".stuperrstsdvbx").text("Please fill the username.");
      showsnackpopup("Please fill the username.", true, false);
    } else if (at.length > 20) {
      $(
        ".strflnm,.strecatgreselct,.strmblnm,.strepmtmtdsselct,.streadrsipt"
      ).css("border", "none");
      $(".streusat").css("border", "2px solid red");
      $(".stuperrstsdvbx").text(
        "Your username cannot be morethan 20 characters."
      );
      showsnackpopup(
        "Your username cannot be morethan 20 characters.",
        true,
        false
      );
    } else if (cg == "-- Select Category --") {
      $(".strflnm,.streusat,.strmblnm,.strepmtmtdsselct,.streadrsipt").css(
        "border",
        "none"
      );
      $(".strecatgreselct").css("border", "2px solid red");
      $(".stuperrstsdvbx").text("Select your store category.");
      showsnackpopup("Select your store category.", true, false);
    } else if (mbl === "") {
      mber("Please enter a mobile number.");
    } else if (ptms === "") {
      $(".strflnm,.streusat,.strecatgreselct,.strmblnm,.streadrsipt").css(
        "border",
        "none"
      );
      $(".strepmtmtdsselct").css("border", "2px solid red");
      $(".stuperrstsdvbx").text("Select your all valid payment methods.");
      showsnackpopup("Select your all valid payment methods.", true, false);
    } else if (!a.test(mbl) && mbl.length == 10) {
      mber("Please enter a valid mobile number.");
    } else if (mbl.length != 10) {
      mber("Please enter a valid mobile number.");
    } else if (ads === "") {
      $(".strflnm,.streusat,.strecatgreselct,.strmblnm,.strepmtmtdsselct").css(
        "border",
        "none"
      );
      $(".streadrsipt").css("border", "2px solid red");
      $(".stuperrstsdvbx").text("Please fill your physical store address.");
      showsnackpopup("Please fill your physical store address.", true, false);
    } else if (ads.length < 10) {
      $(".strflnm,.streusat,.strecatgreselct,.strmblnm,.strepmtmtdsselct").css(
        "border",
        "none"
      );
      $(".streadrsipt").css("border", "2px solid red");
      $(".stuperrstsdvbx").text(
        "Please enter a valid address of minimum 5 words."
      );
      showsnackpopup(
        "Please enter a valid address of minimum 5 words.",
        true,
        false
      );
    } else if (ads.length > 100) {
      $(".strflnm,.streusat,.strecatgreselct,.strmblnm,.strepmtmtdsselct").css(
        "border",
        "none"
      );
      $(".streadrsipt").css("border", "2px solid red");
      $(".stuperrstsdvbx").text(
        "Your address cannot contain morethan 100 characters."
      );
      showsnackpopup(
        "Your address cannot contain morethan 100 characters.",
        true,
        false
      );
    } else {
      $(
        ".strflnm,.streusat,.strecatgreselct,.strmblnm,.strepmtmtdsselct,.streadrsipt"
      ).css("border", "1px solid black");
      $(".stuperrstsdvbx").text("");
      var opntmgs = `${$("#opnsatmgsipt").val()} ${$("#eoapm").val()}//${$(
        "#clsatmgsipt"
      ).val()} ${$("#ecapm").val()}||${$("#snopnsatmgsipt").val()} ${$(
        "#soapm"
      ).val()}//${$("#snclsatmgsipt").val()} ${$("#scapm").val()}`;
      opntmgs = $("#nhavblipt").is(":checked")
        ? $("#nhavblipt").val()
        : opntmgs;
      if (at !== "") {
        var sid = $("#hdnusrvledts").val();
        $.ajax({
          url: "http://localhost/remindo/stsupsflr/strdtlsupdt",
          method: "post",
          data: {
            edtextac: "treedtext",
            sid: sid,
            strnm: strnm,
            at: at,
            cg: cg,
            eml: eml,
            mbl: mbl,
            pmts: ptms,
            ads: ads,
            oct: opntmgs,
            mps: $(".mnpchseipt").val(),
            lalg: "",
          },
          beforeSend: () => {
            $("div.pageloader").show();
            preloaderon();
          },
          success: (data) => {
            $("div.pageloader").hide();
            if (data == 1) {
              showsnackpopup("Updated successfully!", true, true);
            } else if (data == "u1") {
              $(".stuperrstsdvbx").text(
                "This username is already taken. Try with new characters."
              );
              showsnackpopup(
                "This username is already taken. Try including numbers and Other letters.",
                true,
                false
              );
            } else {
              showsnackpopup(
                "Failed to update the business details. Try again.",
                true,
                false
              );
            }
          },
          error: (err) => {
            showsnackpopup(
              "Failed to update the business details. Try again later.",
              true,
              false
            );
          },
        });
        e.stopImmediatePropagation();
        return false;
      }
    }
  });
});
