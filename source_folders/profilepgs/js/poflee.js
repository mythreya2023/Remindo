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
  }
  if (window.innerWidth < 500) {
    $(".remindoprofiletopnavigator").css(
      "width",
      window.innerWidth -
        parseInt($(".remindoprofiletopnavigator").css("padding")) -
        5 +
        "px"
    );
  }
  if ($("h5.usrconr").text() == "") {
    $("i.usrprfcoticon").css("color", "#042af8");
    $("h5.usrconr")
      .text("Add address")
      .css("font-weight", "500")
      .css("font-size", "px")
      .css("color", "#042af8");
    $("div.rmdusrlcotcontainerdivbox").click(edtprfpgnav);
  }
  if ($("h5.usrpfgen").text() == "Male") {
    $("span.rmdusrgenlogbox").html(
      "<svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'width='20' height='20'viewBox='0 0 172 172'style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#5d5353'><path d='M89.01,11.7175c-12.65812,0.22844 -21.90312,4.00438 -27.52,11.395c-6.65156,8.76125 -7.86094,22.10469 -3.655,39.56c-1.54531,1.89469 -2.71437,4.77031 -2.2575,8.6c0.90031,7.55188 3.92375,10.68281 6.3425,11.9325c1.16906,5.96625 4.46125,12.64469 7.6325,15.8025v1.6125c0.01344,2.27094 -0.02687,4.42094 -0.1075,6.665c1.80063,3.7625 7.51156,9.675 19.995,9.675c12.5775,0 18.43625,-6.03344 20.1025,-10.2125c-0.06719,-2.06937 -0.01344,-4.03125 0,-6.1275v-1.6125c3.07719,-3.14437 6.24844,-9.83625 7.4175,-15.8025c2.48594,-1.23625 5.42875,-4.35375 6.3425,-11.9325c0.45688,-3.74906 -0.645,-6.59781 -2.15,-8.4925c2.00219,-6.81281 6.08719,-24.55031 -0.9675,-35.905c-2.95625,-4.75687 -7.43094,-7.75344 -13.33,-8.9225c-3.25187,-4.09844 -9.48687,-6.235 -17.845,-6.235zM112.66,114.7025c-4.34031,5.01219 -12.01312,9.1375 -23.22,9.1375c-11.40844,0 -18.86625,-4.1925 -23.1125,-9.03c-3.27875,2.75469 -8.51937,4.82406 -14.2975,7.095c-13.4375,5.28094 -30.14031,11.81156 -31.39,32.68l-0.215,3.655h138.03l-0.215,-3.655c-1.24969,-20.86844 -17.88531,-27.39906 -31.2825,-32.68c-5.805,-2.29781 -11.03219,-4.4075 -14.2975,-7.2025z'></path></g></g></svg>"
    );
  } else if ($("h5.usrconr").text() == "Female") {
    $("span.rmdusrgenlogbox").html(
      "<svg xmlns='http://www.w3.org/2000/svg' x='0px' y='0px'width='20' height='20'viewBox='0 0 172 172' style=' fill:#000000;'><g fill='none' fill-rule='nonzero' stroke='none' stroke-width='1' stroke-linecap='butt' stroke-linejoin='miter' stroke-miterlimit='10' stroke-dasharray=' stroke-dashoffset='0' font-family='none' font-weight='none' font-size='none' text-anchor='none' style='mix-blend-mode: normal'><path d='M0,172v-172h172v172z' fill='none'></path><g fill='#5d5353'><path d='M147.92,158.24h-123.84c-0.946,0 -1.85072,-0.38872 -2.50088,-1.07672c-0.65016,-0.68456 -0.98728,-1.60992 -0.93568,-2.55248c1.1524,-20.5024 16.84224,-26.9524 29.44984,-32.13992c7.54736,-3.10288 16.71152,-7.48888 18.68264,-12.24296c0.01032,-0.0516 0.0172,-0.09632 0.02408,-0.14792c-12.7796,-1.45168 -27.52,-2.45616 -27.52,-10.32c0,-0.96664 0.40936,-1.892 1.12144,-2.54216c2.68664,-2.44928 4.042,-12.60072 4.35504,-22.41848c0.774,-24.30704 1.94704,-61.03936 39.58752,-61.03936c7.51296,0 12.6076,3.39872 14.76792,5.18752c6.53944,0.26488 11.91616,2.48024 15.98912,6.59104c10.26496,10.35784 10.0964,30.10688 9.9416,47.53048c-0.086,9.9932 -0.1892,21.32112 2.54904,23.79792c0.71896,0.6536 1.12832,1.57896 1.12832,2.54904c0,8.18032 -19.68368,9.64232 -27.52,10.664c0.00688,0.11352 0.01376,0.22704 0.0172,0.34744c2.07088,4.63368 11.2488,8.98528 18.68952,12.04344c12.6076,5.18752 28.30088,11.63752 29.44984,32.13992c0.05504,0.94256 -0.28208,1.86792 -0.93224,2.55248c-0.6536,0.688 -1.55832,1.07672 -2.50432,1.07672zM103.2344,111.13608h0.0344zM99.072,108.69712c0,0 0,0.00344 0,0.00688c0,-0.00344 0,-0.00688 0,-0.00688zM99.072,108.69024v0z'></path></g></g></svg>"
    );
  }
  $(".rmdcgprfpicinprfgp").click(() => {
    $(".chngprflppup").show();
  });
  $(".rmvrmdprflpicbtndvbx").click((e) => {
    var pnm = $(".rdprnpfig").attr("src");
    $.ajax({
      url: "profilepgs/prfupdtftch.php",
      type: "POST",
      data: { prigtcg: pnm, rvpfpc: "rmvpctre" },
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $("div.preloader").hide();
        $(".rdprnpfig").attr("src", "pflmgs/defa.png");
        $(".chngprflppup").hide();
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
  chngigfn();
  function chngigfn() {
    $(document).on("change", "#rmdprpicchngipt", function (e) {
      e.preventDefault();
      var funvn = $(".rdprnpfig").attr("src");
      var property = document.querySelector("#rmdprpicchngipt").files[0];
      var image_name = property.name;
      var extension = image_name.split(".").pop().toLowerCase();
      if ($.inArray(extension, ["png", "jpeg", "jpg"]) == -1) {
        alert("Invalid File");
      } else {
        var img_size = property.size;
        if (img_size > 10000000) {
          alert("File is too big");
        } else {
          var form_data = new FormData();
          form_data.append("file", property);
          $(".chngprflppup").hide();
          $.ajax({
            url: "profilepgs/prfupdtftch.php",
            type: "POST",
            data: { prigtcg: funvn },
            success: function (data) {},
          });
          $.ajax({
            url: "profilepgs/prfupdtftch.php",
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
              $("div.pageloader").show();
              preloaderon();
            },
            success: function (data) {
              $("div.preloader").hide();
              if (data == "e0") {
                alert("Select a photo to set you profile pic.");
              } else if (data == "e1") {
                alert("Please choose a valid pic.");
              } else {
                $(".rdprnpfig").attr("src", "pflmgs/" + data);
              }
            },
          });
          e.stopImmediatePropagation();
          return false;
        }
      }
    });
  }
  $(".editremindouserprofilebtn").click(edtprfpgnav);
  function edtprfpgnav(e) {
    $.ajax({
      url: "./editprofile.php",
      method: "get",
      data: { editprofile: "yes" },
      dataType: "json",
      beforeSend: function () {
        $("div.pageloader").show();
        preloaderon();
      },
      success: function (data) {
        $(".remindomainheaderlptpvsn").html("");
        var title = "Edit Profile | Remindo";
        $(document).attr("title", title);
        $("div.remindochildboxycontainer").html(data.body);
        $("div.pageloader").hide();
        window.history.pushState(
          {},
          {},
          "http://localhost/remindo/editprofile.php"
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  }
  var businessangleup = true,
    accordationangleup = true;
  $(".businesscaretaccordationbtnbox").click(function () {
    $(".remindocontentcontainerbox").slideUp(200);
    $(".accordationanglebtnbox").html(
      "<i class='fas fa-angle-down caretaccordationup' ></i>"
    );
    $(".remindobusinesscontainerbox").slideToggle(200);
    if (businessangleup) {
      $(".businesscaretaccordationbtnbox").html(
        "<i class='fas fa-angle-up caretaccordationup' ></i>"
      );
      businessangleup = false;
    } else {
      $(".businesscaretaccordationbtnbox").html(
        "<i class='fas fa-angle-down caretaccordationup' ></i>"
      );
      businessangleup = true;
    }
  });
  $(".accordationanglebtnbox").click(function () {
    $(".remindobusinesscontainerbox").slideUp(200);
    $(".businesscaretaccordationbtnbox").html(
      "<i class='fas fa-angle-down caretaccordationup' ></i>"
    );
    businessangleup = true;
    $(".remindocontentcontainerbox").slideToggle(200);
    if (accordationangleup) {
      $(".accordationanglebtnbox").html(
        "<i class='fas fa-angle-up caretaccordationup' ></i>"
      );
      accordationangleup = false;
    } else {
      $(".accordationanglebtnbox").html(
        "<i class='fas fa-angle-down caretaccordationup' ></i>"
      );
      accordationangleup = true;
    }
  });
  var bs = false;
  $(".remindoprofilemenunavigationbtn,.remindoprofileenunavigationbtn").click(
    function () {
      if (!bs) {
        bs = true;
        $("div.rmdoprofilepgsidebarbox").fadeIn(500);
      } else {
        bs = false;
        $("div.rmdoprofilepgsidebarbox").fadeOut(200);
      }
    }
  );
  $(".settingsli").click(function (e) {
    $.ajax({
      url: "./account/settings.php",
      method: "get",
      data: { opensettings: "yesopen" },
      dataType: "json",
      beforeSend: function () {
        $(".pageloader").show();
        preloaderon();
        $(".rmdoprofilepgsidebarbox").hide(500);
      },
      success: function (data) {
        var title = "Settings | Remindo";
        $(document).attr("title", title);
        $(".remindomainheaderlptpvsn").html("");
        $(".remindochildboxycontainer").html(data.body);
        $(".pageloader").hide();
        window.history.pushState(
          "Settings",
          title,
          "http://localhost/remindo/account/settings"
        );
      },
    });
    e.stopImmediatePropagation();
    return false;
  });
});
$("div.remindoprofilebacknavigationbtn").click(function (e) {
  $.ajax({
    url: "./home.php",
    method: "get",
    data: { shmpgrm: "yshm" },
    dataType: "json",
    beforeSend: function () {
      $("div.pageloader").show();
      preloaderon();
    },
    dataType: "JSON",
    success: function (data) {
      var title = "Remindo";
      $(document).attr("title", title);
      $("div.remindochildboxycontainer").html(data.body);
      $("div.pageloader").hide();
      window.history.pushState({}, {}, "http://localhost/remindo/");
    },
  });
  e.stopImmediatePropagation();
  return false;
});
