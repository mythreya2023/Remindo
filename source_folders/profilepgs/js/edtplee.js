$(document).ready(function () {
  if (window.innerWidth > 850) {
    $.ajax({
      url: "http://localhost/remindo/header.php",
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
  } else {
    $.ajax({
      url: "http://localhost/remindo/header.php",
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
  if ($(".optgndr").text() == "Male") {
    $("span.rmdusrgenlogbox").html(
      "<svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'width='20' height='20'viewBox='0 0 172 172'style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#5d5353'><path d='M89.01,11.7175c-12.65812,0.22844 -21.90312,4.00438 -27.52,11.395c-6.65156,8.76125 -7.86094,22.10469 -3.655,39.56c-1.54531,1.89469 -2.71437,4.77031 -2.2575,8.6c0.90031,7.55188 3.92375,10.68281 6.3425,11.9325c1.16906,5.96625 4.46125,12.64469 7.6325,15.8025v1.6125c0.01344,2.27094 -0.02687,4.42094 -0.1075,6.665c1.80063,3.7625 7.51156,9.675 19.995,9.675c12.5775,0 18.43625,-6.03344 20.1025,-10.2125c-0.06719,-2.06937 -0.01344,-4.03125 0,-6.1275v-1.6125c3.07719,-3.14437 6.24844,-9.83625 7.4175,-15.8025c2.48594,-1.23625 5.42875,-4.35375 6.3425,-11.9325c0.45688,-3.74906 -0.645,-6.59781 -2.15,-8.4925c2.00219,-6.81281 6.08719,-24.55031 -0.9675,-35.905c-2.95625,-4.75687 -7.43094,-7.75344 -13.33,-8.9225c-3.25187,-4.09844 -9.48687,-6.235 -17.845,-6.235zM112.66,114.7025c-4.34031,5.01219 -12.01312,9.1375 -23.22,9.1375c-11.40844,0 -18.86625,-4.1925 -23.1125,-9.03c-3.27875,2.75469 -8.51937,4.82406 -14.2975,7.095c-13.4375,5.28094 -30.14031,11.81156 -31.39,32.68l-0.215,3.655h138.03l-0.215,-3.655c-1.24969,-20.86844 -17.88531,-27.39906 -31.2825,-32.68c-5.805,-2.29781 -11.03219,-4.4075 -14.2975,-7.2025z'></path></g></g></svg>"
    );
  } else if ($(".optgndr").text() == "Female") {
    $("span.rmdusrgenlogbox").html(
      "<svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'width='20' height='20'viewBox='0 0 172 172' style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#5d5353'><path d='M147.92,158.24h-123.84c-0.946,0 -1.85072,-0.38872 -2.50088,-1.07672c-0.65016,-0.68456 -0.98728,-1.60992 -0.93568,-2.55248c1.1524,-20.5024 16.84224,-26.9524 29.44984,-32.13992c7.54736,-3.10288 16.71152,-7.48888 18.68264,-12.24296c0.01032,-0.0516 0.0172,-0.09632 0.02408,-0.14792c-12.7796,-1.45168 -27.52,-2.45616 -27.52,-10.32c0,-0.96664 0.40936,-1.892 1.12144,-2.54216c2.68664,-2.44928 4.042,-12.60072 4.35504,-22.41848c0.774,-24.30704 1.94704,-61.03936 39.58752,-61.03936c7.51296,0 12.6076,3.39872 14.76792,5.18752c6.53944,0.26488 11.91616,2.48024 15.98912,6.59104c10.26496,10.35784 10.0964,30.10688 9.9416,47.53048c-0.086,9.9932 -0.1892,21.32112 2.54904,23.79792c0.71896,0.6536 1.12832,1.57896 1.12832,2.54904c0,8.18032 -19.68368,9.64232 -27.52,10.664c0.00688,0.11352 0.01376,0.22704 0.0172,0.34744c2.07088,4.63368 11.2488,8.98528 18.68952,12.04344c12.6076,5.18752 28.30088,11.63752 29.44984,32.13992c0.05504,0.94256 -0.28208,1.86792 -0.93224,2.55248c-0.6536,0.688 -1.55832,1.07672 -2.50432,1.07672zM103.2344,111.13608h0.0344zM99.072,108.69712c0,0 0,0.00344 0,0.00688c0,-0.00344 0,-0.00688 0,-0.00688zM99.072,108.69024v0z'></path></g></g></svg>"
    );
  }
  const gender = ["Male", "Female", "Other"];
  for (d = 0; d <= gender.length - 1; d++) {
    var node = document.createElement("OPTION");
    node.textContent = gender[d];
    node.value = d + 1;
    if ($(".optgndr").text() != gender[d]) {
      document.querySelector(".u_gdreditprofile").appendChild(node);
    }
  }
  for (d = 1; d <= 30; d++) {
    var node = document.createElement("OPTION");
    node.textContent = d;
    document.querySelector(".usrbirthdate").appendChild(node);
  }
  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  var currentdate = new Date();
  var n = currentdate.getFullYear();
  for (d = 1930; d <= n; d++) {
    var node = document.createElement("OPTION");
    node.textContent = d;
    document.querySelector(".rmdousrbirthyear").appendChild(node);
  }
});
$("div.remindobackedtprfnavigationbtn").click(prflreqfun);
function prflreqfun(e) {
  $.ajax({
    url: "./profile.php",
    method: "get",
    data: { nvprfpg: "trys" },
    dataType: "json",
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      let title = "Profile | Remindo";
      $(document).attr("title", title);
      $("div.remindochildboxycontainer").html(data.body);
      $("div.pageloader").hide();
      window.history.pushState({}, {}, "http://localhost/remindo/profile");
    },
  });
  e.stopImmediatePropagation();
  return false;
}
$(".submiteditprofileform").click(function () {
  $("div.popupbackground,div.popupcontainerbox").show();
});
$("button.hidepopupbtn").click(function () {
  $("div.popupbackground,div.popupcontainerbox").hide();
});
$(".submitrmdresform").click(function (e) {
  let fln = $("#editfullName").val();
  let eulm = $("#editemail").val();
  let edbo = $(".edtprflbio").val();
  let usnm = $("#usrname").val();
  let gdr = document.querySelector(".u_gdreditprofile");
  let gnus = gdr.options[gdr.selectedIndex].text;
  let dtt = document.querySelector(".usrbdttt");
  let dtus = dtt.options[dtt.selectedIndex].text;
  let mtt = document.querySelector(".ussrbmttt");
  let mous = mtt.options[mtt.selectedIndex].value;
  let ysub = document.querySelector(".usrbysubt");
  let ysu = ysub.options[ysub.selectedIndex].text;
  let uslctt = $(".locinput").val();
  let supa = $(".rmdowiseluprsd").val();
  let usbttbn = $(".submitrmdresform").val();
  $.ajax({
    url: "./editprofile.php",
    method: "post",
    data: {
      flusrn: fln,
      useml: eulm,
      gnusr: gnus,
      usrbdt: dtus,
      usrbmt: mous,
      usrbyt: ysu,
      uslct: uslctt,
      usnm: usnm,
      usbo: edbo,
      usltc: supa,
      usbbmt: usbttbn,
      upusreprfl: "trys",
    },
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    success: function (data) {
      if (gnus == "Male") {
        $("span.rmdusrgenlogbox").html(
          "<svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'width='20' height='20'viewBox='0 0 172 172'style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#5d5353'><path d='M89.01,11.7175c-12.65812,0.22844 -21.90312,4.00438 -27.52,11.395c-6.65156,8.76125 -7.86094,22.10469 -3.655,39.56c-1.54531,1.89469 -2.71437,4.77031 -2.2575,8.6c0.90031,7.55188 3.92375,10.68281 6.3425,11.9325c1.16906,5.96625 4.46125,12.64469 7.6325,15.8025v1.6125c0.01344,2.27094 -0.02687,4.42094 -0.1075,6.665c1.80063,3.7625 7.51156,9.675 19.995,9.675c12.5775,0 18.43625,-6.03344 20.1025,-10.2125c-0.06719,-2.06937 -0.01344,-4.03125 0,-6.1275v-1.6125c3.07719,-3.14437 6.24844,-9.83625 7.4175,-15.8025c2.48594,-1.23625 5.42875,-4.35375 6.3425,-11.9325c0.45688,-3.74906 -0.645,-6.59781 -2.15,-8.4925c2.00219,-6.81281 6.08719,-24.55031 -0.9675,-35.905c-2.95625,-4.75687 -7.43094,-7.75344 -13.33,-8.9225c-3.25187,-4.09844 -9.48687,-6.235 -17.845,-6.235zM112.66,114.7025c-4.34031,5.01219 -12.01312,9.1375 -23.22,9.1375c-11.40844,0 -18.86625,-4.1925 -23.1125,-9.03c-3.27875,2.75469 -8.51937,4.82406 -14.2975,7.095c-13.4375,5.28094 -30.14031,11.81156 -31.39,32.68l-0.215,3.655h138.03l-0.215,-3.655c-1.24969,-20.86844 -17.88531,-27.39906 -31.2825,-32.68c-5.805,-2.29781 -11.03219,-4.4075 -14.2975,-7.2025z'></path></g></g></svg>"
        );
      } else if (gnus == "Female") {
        $("span.rmdusrgenlogbox").html(
          "<svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'width='20' height='20'viewBox='0 0 172 172' style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#5d5353'><path d='M147.92,158.24h-123.84c-0.946,0 -1.85072,-0.38872 -2.50088,-1.07672c-0.65016,-0.68456 -0.98728,-1.60992 -0.93568,-2.55248c1.1524,-20.5024 16.84224,-26.9524 29.44984,-32.13992c7.54736,-3.10288 16.71152,-7.48888 18.68264,-12.24296c0.01032,-0.0516 0.0172,-0.09632 0.02408,-0.14792c-12.7796,-1.45168 -27.52,-2.45616 -27.52,-10.32c0,-0.96664 0.40936,-1.892 1.12144,-2.54216c2.68664,-2.44928 4.042,-12.60072 4.35504,-22.41848c0.774,-24.30704 1.94704,-61.03936 39.58752,-61.03936c7.51296,0 12.6076,3.39872 14.76792,5.18752c6.53944,0.26488 11.91616,2.48024 15.98912,6.59104c10.26496,10.35784 10.0964,30.10688 9.9416,47.53048c-0.086,9.9932 -0.1892,21.32112 2.54904,23.79792c0.71896,0.6536 1.12832,1.57896 1.12832,2.54904c0,8.18032 -19.68368,9.64232 -27.52,10.664c0.00688,0.11352 0.01376,0.22704 0.0172,0.34744c2.07088,4.63368 11.2488,8.98528 18.68952,12.04344c12.6076,5.18752 28.30088,11.63752 29.44984,32.13992c0.05504,0.94256 -0.28208,1.86792 -0.93224,2.55248c-0.6536,0.688 -1.55832,1.07672 -2.50432,1.07672zM103.2344,111.13608h0.0344zM99.072,108.69712c0,0 0,0.00344 0,0.00688c0,-0.00344 0,-0.00688 0,-0.00688zM99.072,108.69024v0z'></path></g></g></svg>"
        );
      }
      if (data === "Updated") {
        $("span.pderrcs").html("").hide();
        $("div.popupbackground,div.popupcontainerbox").hide();
        $(".rmdowiseluprsd").val("");
        $(".submiteditprofileform").text(data);
      } else {
        $("span.pderrcs").css("display", "block").text(data);
      }
      $("div.pageloader").hide();
    },
  });
  e.stopImmediatePropagation();
  return false;
});
