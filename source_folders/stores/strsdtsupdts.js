$(document).ready(() => {
  var susr = new FormData();
  document.querySelectorAll(".stupstrptobtns").forEach((btn) => {
    $(btn).click(() => {
      $("#hdndtatpvl").val($(btn).attr("data-tp"));
    });
  });
  $("#stupbcknmunmctgpg").click(() => {
    $(
      ".bsnacntstupmladscntngbx,.bsnacntstuplcncntngbx,.bsnacntstupupipccntngbx,.bsnacntstcvrpflscntngbx"
    ).fadeOut(100);
    $(".bsnacntstupnunemlcntngbx").fadeIn(100);
  });
  $("#stupdcktomblemlpg").click(() => {
    $(
      ".bsnacntstuplcncntngbx,.bsnacntstupupipccntngbx,.bsnacntstcvrpflscntngbx"
    ).fadeOut(100);
    $(".bsnacntstupmladscntngbx").fadeIn(100);
  });
  $("#stupbcktoadrspg").click(() => {
    $(".bsnacntstuplcncntngbx").fadeIn(100);
    $(".bsnacntstupupipccntngbx").fadeOut(100);
  });
  $("#bcktoupistupg").click(() => {
    $(".bsnacntstcvrpflscntngbx").fadeOut(100);
    $(".bsnacntstupupipccntngbx").fadeIn(100);
  });
  function picrszr(img, tp) {
    var cnvs = document.createElement("canvas");
    var MAX_WIDTH = 600;
    var MAX_HEIGHT = 600;
    if (tp == "pf") {
      MAX_WIDTH = 400;
      MAX_HEIGHT = 400;
    }
    var width = img.width;
    var height = img.height;
    if (width > height) {
      if (width > MAX_WIDTH) {
        height *= MAX_WIDTH / width;
        width = MAX_WIDTH;
      }
    } else {
      if (height > MAX_HEIGHT) {
        width *= MAX_HEIGHT / height;
        height = MAX_HEIGHT;
      }
    }
    cnvs.width = width;
    cnvs.height = height;
    var ctx = cnvs.getContext("2d");
    ctx.drawImage(img, 0, 0, cnvs.width, cnvs.height);
    return cnvs;
  }
  pdtpmg();
  function pdtpmg() {
    $(document).on(
      "change",
      ".rmdprpicchngiptinprfpg,.stuppgadupimgbtn,.rmdprpicchngiptincvrpg",
      (e) => {
        e.preventDefault();
        var $tp = $("#hdndtatpvl").val();
        var purl = "";
        var $pto = "";
        var $q = false,
          $p = false;
        if ($tp == "bnstrpfpt") {
          purl = "strpsnlpts/strpcspfupdts.php";
          $pto = $("#hdtpiptofppc").val();
          $q = false;
          $p = true;
        } else if ($tp == "bnstrcvpt") {
          purl = "strpsnlpts/strpcscvupdts.php";
          $pto = $("#hdtpiptofcpc").val();
          $q = false;
          $p = false;
        } else if ($tp == "bnstrppt") {
          purl = "strpsnlpts/strpcsqupupds.php";
          $pto = $("#hdtpiptofqrcd").val();
          $q = true;
          $p = false;
        }
        var property = !$q
          ? $p
            ? document.querySelector(".rmdprpicchngiptinprfpg").files[0]
            : document.querySelector(".rmdprpicchngiptincvrpg").files[0]
          : document.querySelector(".stuppgadupimgbtn").files[0];
        var image_name = property.name;
        var extension = image_name.split(".").pop().toLowerCase();
        if ($.inArray(extension, ["png", "jpeg", "jpg"]) == -1) {
          alert("Invalid File");
        } else {
          var gmi = document.createElement("img");
          gmi.src = URL.createObjectURL(property);
          gmi.onload = () => {
            var cnvs = picrszr(gmi, $tp == "bnstrpfpt" ? "pf" : "");
            cnvs.toBlob(
              function (blob) {
                property = new File([blob], `${new Date()}.jpeg`, {
                  type: "image/jpeg",
                  lastModified: new Date(),
                });
                var img_size = property.size;
                if (img_size > 1000000) {
                  alert("File is too big");
                } else {
                  var src = URL.createObjectURL(blob);
                  if ($tp == "bnstrpfpt") {
                    $(".strsstupprfldsplybx").html(
                      `<img src='${src}' style='width:100%;height:100%;object-fit:cover;'>`
                    );
                    susr.delete("pfpc");
                    susr.append("pfpc", property);
                  } else if ($tp == "bnstrcvpt") {
                    $(".strsstupcvrdsplybx").html(
                      `<img src='${src}' style='width:100%;height:100%;object-fit:cover;'>`
                    );
                    susr.delete("cvig");
                    susr.append("cvig", property);
                  } else if ($tp == "bnstrppt") {
                    $(".strstupimgdsplydvbx").html(
                      `<img src='${src}' style='width:100%;height:100%;object-fit:cover;'>`
                    );
                    susr.delete("pmig");
                    susr.append("pmig", property);
                  }
                }
              },
              "image/jpeg",
              0.899
            );
          };
        }
      }
    );
  }
  fmvldtn();
  function fmvldtn() {
    var vfdcts = [];
    $(".enumfmcmpltdnxtpgbtn").click((e) => {
      var strnm = $(".strflnm").val();
      var at = $(".streusat").val();
      var ctg = document.querySelector(".strecatgreselct");
      var cg = ctg.options[ctg.selectedIndex].text;
      if (strnm === "" && at === "" && cg === "-- Select Category --") {
        $(".strflnm,.streusat,.strecatgreselct").css("border", "2px solid red");
        $(".stuperrstsdvbx").text("Please fill all the details.");
      } else if (strnm === "") {
        $(".streusat,.strecatgreselct").css("border", "none");
        $(".strflnm").css("border", "2px solid red");
        $(".stuperrstsdvbx").text("Please fill the Store name.");
      } else if (strnm.length > 30) {
        $(".streusat,.strecatgreselct").css("border", "none");
        $(".strflnm").css("border", "2px solid red");
        $(".stuperrstsdvbx").text(
          "Store name cannot be morethan 30 characters."
        );
      } else if (at === "") {
        $(".strflnm,.strecatgreselct").css("border", "none");
        $(".streusat").css("border", "2px solid red");
        $(".stuperrstsdvbx").text("Please fill the username.");
      } else if (at.length >= 20) {
        $(".strflnm,.strecatgreselct").css("border", "none");
        $(".streusat").css("border", "2px solid red");
        $(".stuperrstsdvbx").text("Username cannot be morethan 20 characters.");
      } else if (cg == "-- Select Category --") {
        $(".strflnm,.streusat").css("border", "none");
        $(".strecatgreselct").css("border", "2px solid red");
        $(".stuperrstsdvbx").text("Select your store category.");
      } else {
        $(".strflnm,.streusat,.strecatgreselct").css("border", "none");
        $(".stuperrstsdvbx").text("");
        $.ajax({
          url: "http://localhost/remindo/stsupsflr/strdtlsupdt",
          method: "post",
          data: { vrfat: at },
          beforeSend: () => {
            $("div.pageloader").show();
            preloaderon();
          },
          success: (data) => {
            $("div.pageloader").hide();
            if (data != 0) {
              $(".stuperrstsdvbx").text(
                "This username is already taken. Try with new characters."
              );
            } else {
              vfdcts.push(strnm, at, cg);
              susr.delete("strnm");
              susr.delete("at");
              susr.delete("cg");
              susr.append("strnm", strnm);
              susr.append("at", at);
              susr.append("cg", cg);
              $(".bsnacntstupnunemlcntngbx").fadeOut(10);
              $(".bsnacntstupmladscntngbx").fadeIn(200);
            }
          },
        });
      }
    });
    $(".mnmempmcmpltdnxtpgbtn").click(() => {
      var mbl = $(".strmblnm").val();
      var eml = $(".edtstreml").val();
      var cgt = $(".strepmtmtdsselct").val();
      var mber = (txt) => {
        $(".strepmtmtdsselct").css("border", "none");
        $(".strmblnm").css("border", "2px solid red");
        $(".stuperrstsdvbx").text(txt);
      };
      if (mbl == "" && cgt == "") {
        $(".strmblnm,.strepmtmtdsselct").css("border", "2px solid red");
        $(".stuperrstsdvbx").text("Please fill all the details.");
      } else if (mbl == "") {
        mber("Please enter a mobile number.");
      } else if (cgt == "") {
        $(".strmblnm").css("border", "none");
        $(".strepmtmtdsselct").css("border", "2px solid red");
        $(".stuperrstsdvbx").text("Select your all valid payment methods.");
      } else {
        var a = /^[6789]\d{9}$/;
        if (!a.test(mbl) && mbl.length == 10) {
          mber("Please enter a valid mobile number.");
        } else if (mbl.length != 10) {
          mber("Please enter a valid mobile number.");
        } else {
          $(".strmblnm,.strepmtmtdsselct").css("border", "none");
          $(".stuperrstsdvbx").text("");
          vfdcts.push(mbl, eml, cgt);
          susr.delete("mlm");
          susr.delete("eml");
          susr.delete("apmts");
          susr.append("mlm", mbl);
          susr.append("eml", eml);
          susr.append("apmts", cgt);
          $(".bsnacntstupmladscntngbx").fadeOut(10);
          $(".bsnacntstuplcncntngbx").fadeIn(200);
        }
      }
    });
    $(".adrslccmpltdnxtpgbtn").click(() => {
      var ads = $(".streadrsipt").val();
      if (ads == "") {
        $(".streadrsipt").css("border", "2px solid red");
        $(".stuperrstsdvbx").text("Please fill your physical store address.");
      } else if (ads.length < 10) {
        $(".streadrsipt").css("border", "2px solid red");
        $(".stuperrstsdvbx").text(
          "Please enter a valid address of minimum 5 words."
        );
      } else if (ads.length > 100) {
        $(".streadrsipt").css("border", "2px solid red");
        $(".stuperrstsdvbx").text(
          "Your address cannot contain morethan 100 characters."
        );
      } else {
        $(".streadrsipt").css("border", "none");
        $(".stuperrstsdvbx").text("");
        vfdcts.push(ads);
        susr.delete("ads");
        susr.append("ads", ads);
        $(".bsnacntstuplcncntngbx").fadeOut(10);
        $(".bsnacntstupupipccntngbx").fadeIn(200);
      }
    });
    $(".upupldcmpltdnxtpgbtn").click(() => {
      var up = $("#hdtpiptofqrcd").val();
      vfdcts.push(up != undefined ? up : "");
      $(".bsnacntstupupipccntngbx").fadeOut(10);
      $(".bsnacntstcvrpflscntngbx").fadeIn(200);
    });
    $(".strcppcmpltdnxtpgbtn").click((e) => {
      var cp = $("#hdtpiptofcpc").val();
      var pp = $("#hdtpiptofppc").val();
      vfdcts.push(cp != undefined ? cp : "", pp != undefined ? pp : "");
      stupacntfun(vfdcts, e);
    });
  }
  function stupacntfun(stp, e) {
    var dt = new Date();
    var jtms =
      dt.getFullYear() +
      "-" +
      (dt.getMonth() + 1) +
      "-" +
      dt.getDate() +
      " " +
      dt.getHours() +
      "-" +
      dt.getMinutes() +
      "-" +
      dt.getSeconds();
    var suobj = {
      stpac: "trestp",
      octms: "",
      jtms: jtms,
    };
    Object.keys(suobj).forEach((key) => {
      susr.delete(key);
      susr.append(key, suobj[key]);
    });
    for (var pair of susr.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
    console.log(susr.getAll("pmig"));
    console.log(susr.getAll("cvig"));
    console.log(susr.getAll("pfpc"));
    $.ajax({
      url: "http://localhost/remindo/stsupsflr/strdtlsupdt",
      method: "post",
      data: susr,
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        if (data == "1") {
          alert("Your business account created successfully!");
          $(".aftrstupgtstrebtn .stpnxtbtntxt").text(`Go to ${stp[2]}`);
          $(".bsnactstupsscflyscntngbx").fadeIn(200);
          $(".bsnacntstcvrpflscntngbx").fadeOut(100);
        } else {
          alert("Failed to create business account. Please try again later!");
        }
      },
      error: (err) => {
        alert("Failed to create business account. Please try again later!");
      },
    });
    e.stopImmediatePropagation();
    return false;
  }
  $(".aftrstupgtstrebtn").click((e) => {
    $.ajax({
      url: "http://localhost/remindo/stores/store",
      method: "post",
      data: { s: $(".streusat").val() },
      dataType: "json",
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $("body").addClass("storecustmrpgbdy");
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer")
          .html(data.body)
          .addClass("rmdchldbxstrecustmruidvbx");
        window.history.pushState(
          {},
          {},
          `http://localhost/remindo/stores/store?s=${$(".streusat").val()}`
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
});
