var strsTp = "all";
var ursTp = "all";
var orsTp = "all";
var strdt = [];
var usrdt = [];
var odrdt = [];
$(document).ready(() => {
  resetdtFun($(`.crd_y_bx`), $(`.crd_m_bx`), $(`.crd_d_bx`));
  var o = 0;
  var l = 10;
  ttlanlys();
  anlysstr(true, 0, 0, 0, o, l);
  anlysurs(true, 0, 0, 0, o, l);
  anlysodrs(true, 0, 0, 0, o, l);
  $(".str_dta_tbl_bdy,.urs_crd_tbl_bdy").on("touchmove", scrlfun);
  $(".str_dta_tbl_bdy,.urs_crd_tbl_bdy").scroll(scrlfun);
  function scrlfun(e) {
    var container = $(".str_dta_tbl_bdy,.urs_crd_tbl_bdy");
    var height = container.height();
    var scrollHeight = container[0].scrollHeight;
    var st = container.scrollTop();
    var sum = scrollHeight - height - 32;
    if (st >= sum) {
      o += l;
      if ($(e.target).attr("class") == "str_dta_tbl_bdy") {
        scrlby(strsTp, anlysstr, strdt);
      } else if ($(e.target).attr("class") == "urs_crd_tbl_bdy") {
        scrlby(ursTp, anlysurs, usrdt);
      } else if ($(e.target).attr("class") == "ods_crd_tbl_bdy") {
        scrlby(ursTp, fun, usrdt);
      }
    }
  }
  function scrlby(ursTp, fun, usrdt) {
    if (ursTp == "all") {
      fun(false, 0, 0, 0, o, l);
    } else if (ursTp == "imh") {
      fun(false, usrdt[0], usrdt[1], 0, o, l);
    } else if (ursTp == "iyr") {
      fun(false, usrdt[0], 0, 0, o, l);
    }
  }
  $(".ud_slct").click((e) => {
    var dt = dateFilter("sl_uy_bx", "sl_um_bx", "sl_ud_bx");
    usrdt = [dt[0], dt[1], dt[2]];
    anlysurs(true, dt[0], dt[1], dt[2], 0, 1);
  });
  $(".sd_slct").click((e) => {
    var dt = dateFilter("sl_sy_bx", "sl_sm_bx", "sl_sd_bx");
    strdt = [dt[0], dt[1], dt[2]];
    anlysstr(true, dt[0], dt[1], dt[2], 0, 1);
  });
  $(".od_slct").click((e) => {
    var dt = dateFilter("sl_oy_bx", "sl_om_bx", "sl_od_bx");
    odrdt = [dt[0], dt[1], dt[2]];
    anlysodrs(true, dt[0], dt[1], dt[2], 0, 1);
  });
  $(".crd_mthsbtn").click((e) => {
    o = 0;
    l = 10;
    $(e.target).parent().siblings().children(".crd_m_bx").css({ opacity: "1" });
    $(e.target)
      .parent()
      .siblings()
      .children(".crd_d_bx")
      .css({ opacity: "0.6" });
    if ($(e.target).attr("data-mhs") == "srs") {
      var dt = dateFilter("sl_sy_bx", "sl_sm_bx", "sl_sd_bx");
      anlysstr(true, dt[0], dt[1], 0, o, l);
    } else if ($(e.target).attr("data-mhs") == "urs") {
      var dt = dateFilter("sl_uy_bx", "sl_um_bx", "sl_ud_bx");
      anlysurs(true, dt[0], dt[1], 0, o, l);
    } else if ($(e.target).attr("data-mhs") == "ods") {
      var dt = dateFilter("sl_oy_bx", "sl_om_bx", "sl_od_bx");
      anlysodrs(true, dt[0], dt[1], 0, o, l);
    }
  });
  $(".crd_yrbtn").click((e) => {
    o = 0;
    l = 10;
    $(e.target)
      .parent()
      .siblings()
      .children(".crd_m_bx")
      .css({ opacity: "0.6" });
    $(e.target)
      .parent()
      .siblings()
      .children(".crd_d_bx")
      .css({ opacity: "0.6" });
    if ($(e.target).attr("data-yrs") == "srs") {
      var dt = dateFilter("sl_sy_bx", "sl_sm_bx", "sl_sd_bx");
      anlysstr(true, dt[0], 0, 0, o, l);
    } else if ($(e.target).attr("data-yrs") == "urs") {
      var dt = dateFilter("sl_uy_bx", "sl_um_bx", "sl_ud_bx");
      anlysurs(true, dt[0], 0, 0, o, l);
    } else if ($(e.target).attr("data-yrs") == "ods") {
      var dt = dateFilter("sl_oy_bx", "sl_om_bx", "sl_od_bx");
      anlysodrs(true, dt[0], 0, 0, o, l);
    }
  });
  $(".crd_rstbtn").click((e) => {
    resetdtFun(
      $(e.target).parent().siblings().children(`.crd_y_bx`),
      $(e.target).parent().siblings().children(`.crd_m_bx`),
      $(e.target).parent().siblings().children(`.crd_d_bx`)
    );
    o = 0;
    l = 10;
    if ($(e.target).attr("data-abtn") == "srs") {
      anlysstr(true, 0, 0, 0, o, l);
    } else if ($(e.target).attr("data-abtn") == "urs") {
      anlysurs(true, 0, 0, 0, o, l);
    } else if ($(e.target).attr("data-abtn") == "ods") {
      anlysodrs(true, 0, 0, 0, o, l);
    }
  });
  $ispncl = false;
  $("#pencil").click(() => {
    if (!$ispncl) {
      $(".ddl_clrs_dvbx").show().css("top", "230px");
      $(".ddl_cnvs_dsply").show();
      drwpad();
      $ispncl = true;
    } else {
      $ispncl = false;
      $(".ddl_cnvs_dsply,.ddl_clrs_dvbx").hide();
    }
  });
  $ishoriz = false;
  $(".horiz").click(() => {
    if (!$ishoriz) {
      $(".horiz").text("||");
      $(".ddl_clrs_dvbx").css({ display: "flex" });
      $ishoriz = true;
    } else {
      $ishoriz = false;
      $(".horiz").text("=");
      $(".ddl_clrs_dvbx").css({ display: "block" });
    }
  });
});
var drwF = false;
function drwpad() {
  var canvas = document.getElementById("ddl_pad");
  var ctx = canvas.getContext("2d");
  canvas.height = $(document).height();
  canvas.width = $(document).width();
  if (!drwF) {
    ctx.fillStyle = "#0000";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    drwF = true;
  }
  var draw_color = "black";
  var draw_width = "2";
  var is_drawing = false;
  var restoreArray = [];
  var idx = -1;
  $(".ddl_clrs").click((e) => {
    draw_color = $(e.target).attr("data-clr");
  });
  $("#get_ddl_clr").on("input", () => {
    draw_color = $("#get_ddl_clr").val();
  });
  canvas.addEventListener("touchstart", start, false);
  canvas.addEventListener("touchmove", draw, false);
  canvas.addEventListener("mousedown", start, false);
  canvas.addEventListener("mousemove", draw, false);
  canvas.addEventListener("touchend", stop, false);
  canvas.addEventListener("mouseup", stop, false);
  canvas.addEventListener("mouseout", stop, false);
  $("#ddl_cler").click(clear_canvas);
  function clear_canvas(e) {
    ctx.fillStyle = "#0000";
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    restoreArray = [];
    idx -= 1;
    e.preventDefault();
  }
  function start(e) {
    is_drawing = true;
    ctx.beginPath();
    ctx.moveTo(e.pageX - canvas.offsetLeft, e.pageY - canvas.offsetTop);
    // ctx.moveTo(mouse.x, mouse.y);
    e.preventDefault();
  }
  function draw(e) {
    if (is_drawing) {
      ctx.lineTo(e.pageX - canvas.offsetLeft, e.pageY - canvas.offsetTop);
      // mouse.x = e.pageX - this.offsetLeft;
      // mouse.y = e.pageY - this.offsetTop;
      // ctx.lineTo(mouse.x, mouse.y);
      ctx.strokeStyle = draw_color;
      ctx.lineWidth = draw_width;
      ctx.lineCap = "round";
      ctx.lineJoin = "round";
      ctx.stroke();
    }
    e.preventDefault();
  }
  function stop(e) {
    if (is_drawing) {
      ctx.stroke();
      ctx.closePath();
      is_drawing = false;
    }
    e.preventDefault();
    if (e.type != "mouseout") {
      restoreArray.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
      idx += 1;
    }
  }
  $("#ddl_undo").click((e) => {
    if (idx <= 0) {
      clear_canvas();
    } else {
      idx -= 1;
      restoreArray.pop();
      ctx.putImageData(restoreArray[idx], 0, 0);
    }
    // e.preventDefault();
  });
}
dragElement(document.querySelector(".mnu_dsply_nvgtr"));
dragElement(document.querySelector(".ddl_clrs_dvbx"));
function dragElement(elmnt) {
  var pos1 = 0,
    pos2 = 0,
    pos3 = 0,
    pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    elmnt.style.top = elmnt.offsetTop - pos2 + "px";
    elmnt.style.left = elmnt.offsetLeft - pos1 + "px";
  }

  function closeDragElement() {
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
function resetdtFun(y, m, d) {
  var date = new Date();
  y.val(date.getFullYear()).css({ opacity: "1" });
  m.val(date.toLocaleString("default", { month: "short" })).css({
    opacity: "1",
  });
  d.val(date.getDate()).css({ opacity: "1" });
}
function dateFilter(y, m, d) {
  var yr = $(`.${y}`).val();
  var mt = $(`.${m}`).val();
  var dt = $(`.${d}`).val();
  var mths = {
    Jan: "01",
    Feb: "02",
    Mar: "03",
    Apr: "04",
    May: "05",
    Jun: "06",
    Jul: "07",
    Aug: "08",
    Sep: "09",
    Oct: "10",
    Nov: "11",
    Dec: "12",
  };
  return [yr, mths[mt], dt];
}
function prldron(s) {
  if (s) $(".pgldr_dvbx").slideDown(200);
  else $(".pgldr_dvbx").slideUp(200);
}
function ttlanlys() {
  $.ajax({
    url: "analyser.php",
    method: "post",
    data: { tstcs: "treTlests" },
    dataType: "JSON",
    beforeSend: () => {
      prldron(true);
    },
    success: (data) => {
      prldron(false);
      $(".ttl_usrs").text(data.tus);
      $(".ttl_sts").text(data.tsts);
    },
  });
}
var allmnths = [
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
function anlysstr(f, y, m, d, o, l) {
  var $utp = "all";
  if (y > 0 && m > 0 && d > 0) {
    $utp = "idt";
  } else if (y > 0 && m > 0) {
    $utp = "imh";
  } else if (y > 0) {
    $utp = "iyr";
  }
  strsTp = $utp;
  $.ajax({
    url: "analyser.php",
    method: "post",
    data: {
      anlssrs: "trsrsanls",
      sy: y,
      sm: m,
      sd: d,
      utp: $utp,
      o: o,
      l: l,
    },
    dataType: "json",
    beforeSend: () => {
      prldron(true);
    },
    success: (data) => {
      prldron(false);
      if (data.data == "q0") {
        $(".str_dta_tbl_bdy,#Line_chart_s")
          .html("<center>Failed to load content!</center>")
          .css({ color: "gray" });
      } else if (data.data == "0") {
        $(".str_dta_tbl_bdy,#Line_chart_s")
          .html("<center>No data to load!</center>")
          .css({ color: "gray" });
      } else {
        $(".crd_str_tdy_nm").text(data.tdy);
        if (f) {
          $(".str_dta_tbl_bdy").html(data.data);
          if ($utp == "all") {
            m = new Date().getMonth() + 1;
          }
          var $yomvbl = $utp == "iyr" ? y : allmnths[m - 1];
          getChart(
            true,
            `New Stores Created By Users In ${$yomvbl}`,
            "Grocery,Book Store,Bakery,Supermarkets,Restarunts,Stalls,Meat Centers",
            [data.vsall, "str"],
            "Line_chart_s",
            "line"
          );
          getChart(
            false,
            $utp == "all" ? `All Stores Till Now` : `All Stores In ${$yomvbl}`,
            "",
            [data.tscpsn, "str"],
            "donutchart_stps",
            "donut"
          );
        } else {
          $(".str_dta_tbl_bdy").append(data.data);
        }
      }
    },
  });
}
function anlysurs(f, y, m, d, o, l) {
  var $utp = "all";
  if (y > 0 && m > 0 && d > 0) {
    $utp = "idt";
  } else if (y > 0 && m > 0) {
    $utp = "imh";
  } else if (y > 0) {
    $utp = "iyr";
  }
  ursTp = $utp;
  $.ajax({
    url: "analyser.php",
    method: "post",
    data: {
      anlsurs: "treursanls",
      uy: y,
      um: m,
      ud: d,
      utp: $utp,
      o: o,
      l: l,
    },
    dataType: "json",
    beforeSend: () => {
      prldron(true);
    },
    success: (data) => {
      prldron(false);
      if (data.data == "q0") {
        $(".urs_crd_tbl_bdy,#donutchart_u")
          .html("<center>Failed to load content!</center>")
          .css({ color: "gray" });
      } else if (data.data == "0") {
        $(".urs_crd_tbl_bdy,#donutchart_u")
          .html("<center>No data to load!</center>")
          .css({ color: "gray" });
      } else {
        $(".crd_usr_tdy_nm").text(data.tdy);
        if (f) {
          $(".urs_crd_tbl_bdy").html(data.data);
          if ($utp == "all") {
            m = new Date().getMonth() + 1;
          }
          var $yomvbl = $utp == "iyr" ? y : allmnths[m - 1];
          getChart(
            true,
            `New Users Per Day In ${$yomvbl}`,
            "",
            [data.vsall, "usr"],
            "donutchart_u",
            "donut"
          );
          getChart(
            true,
            `New Users Created By Users In ${$yomvbl}`,
            "",
            [data.vsall, "usr"],
            "Line_chart_u",
            "line"
          );
        } else {
          $(".urs_crd_tbl_bdy").append(data.data);
        }
      }
    },
  });
}
function anlysodrs(f, y, m, d, o, l) {
  var $utp = "all";
  if (y > 0 && m > 0 && d > 0) {
    $utp = "idt";
  } else if (y > 0 && m > 0) {
    $utp = "imh";
  } else if (y > 0) {
    $utp = "iyr";
  }
  orsTp = $utp;
  $.ajax({
    url: "analyser.php",
    method: "post",
    data: {
      anlsors: "treodsanls",
      oy: y,
      om: m,
      od: d,
      utp: $utp,
      o: o,
      l: l,
    },
    dataType: "JSON",
    beforeSend: () => {
      prldron(true);
    },
    success: (data) => {
      prldron(false);
      if (data.data == "q0") {
        $(".ods_crd_tbl_bdy")
          .html("<center>Failed to load content!</center>")
          .css({ color: "gray" });
      } else if (data.data == "0") {
        $(".ods_crd_tbl_bdy")
          .html("<center>No data to load!</center>")
          .css({ color: "gray" });
      } else {
        $(".crd_ods_tdy_nm").text(data.tdy);
        if (f) {
          $(".ods_crd_tbl_bdy").html(data.data);
          if ($utp == "all") {
            m = new Date().getMonth() + 1;
          }
          var $yomvbl = $utp == "iyr" ? y : allmnths[m - 1];
          getChart(
            true,
            [
              `Orders Per Day In ${$yomvbl}`,
              `C.A.S Per Day In ${$yomvbl}`,
              `Prepaid Per Day In ${$yomvbl}`,
            ],
            "",
            [data.vsall, "odr"],
            "donutchart_o",
            "donut"
          );
          getChart(
            false,
            `Comparision b/w C.A.S And Prepaid In ${$yomvbl}`,
            "",
            [data.pmtcpr, "odr"],
            "donutchart_opmtcr",
            "donut"
          );
          getChart(
            true,
            `Orders Per Day In ${$yomvbl}`,
            "Total orders, C.A.S, Prepaid",
            [data.vsall, "odr"],
            "Line_chart_o",
            "line"
          );
        } else {
          $(".ods_crd_tbl_bdy").append(data.data);
        }
      }
    },
  });
}
function getChart(vsal, title, y_c, Data, put, type) {
  var chartData = [];
  data = Data[0];
  if (type == "line") {
    chartData = [];
    if (vsal == true) {
      for (var t in data) {
        var nmr = [];
        for (var i in data[t]) {
          nmr.push(Number(data[t][i]));
        }
        chartData.push(nmr);
      }
    } else {
      for (var i in data) {
        chartData.push([parseInt(i), Number(data[i])]);
      }
    }
    google.charts.load("current", { packages: ["Line"] });
    google.charts.setOnLoadCallback(() => {
      drawChart(vsal, title, y_c, Data[1], chartData, put, type);
    });
  } else if (type == "donut") {
    chartData = [["Task", "per Day"]];
    if (vsal == true) {
      if (Data[1] == "odr") {
        chartData = [];
        var odrs = [["Task", "per Day"]];
        var cas = [["Task", "per Day"]];
        var ppd = [["Task", "per Day"]];
        for (var i in data) {
          odrs.push([i, Number(data[i][1])]);
          cas.push([i, Number(data[i][2])]);
          ppd.push([i, Number(data[i][3])]);
        }
        chartData.push(odrs, cas, ppd);
      }
      if (Data[1] == "usr") {
        for (var i in data) {
          chartData.push([i, Number(data[i][1])]);
        }
        vsal = false;
      }
    } else {
      for (var i in data) {
        chartData.push([i, Number(data[i])]);
      }
    }
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(() => {
      drawChart(vsal, title, y_c, Data[1], chartData, put, type);
    });
  }
}
function drawChart(vsal, title, subtitle, dtatp, chartData, put, type) {
  var optionsd = {
    title: title,
    pieHole: 0.4,
  };
  var optionsL = {
    chart: {
      title: title,
      subtitle: subtitle,
    },
    width: 900,
    height: 500,
    axes: {
      x: {
        0: { side: "bottom" },
      },
    },
  };
  if (type == "line") {
    var data = new google.visualization.DataTable();
    if (vsal == true) {
      if (dtatp == "str") {
        data.addColumn("number", "Date");
        data.addColumn("number", "Total Stores");
        data.addColumn("number", "Grocery");
        data.addColumn("number", "Book Store");
        data.addColumn("number", "Bakery");
        data.addColumn("number", "Super market");
        data.addColumn("number", "Stall");
        data.addColumn("number", "Meat Center");
        data.addColumn("number", "Restarunt");
      } else if (dtatp == "odr") {
        data.addColumn("number", "Date");
        data.addColumn("number", "Total Orders");
        data.addColumn("number", "C.A.S");
        data.addColumn("number", "Prepaid");
      } else if (dtatp == "usr") {
        data.addColumn("number", "Date");
        data.addColumn("number", "Users");
      }
    } else {
      if (dtatp == "str") {
        data.addColumn("number", "Date");
        data.addColumn("number", "Total Stores");
      } else if (dtatp == "usr") {
        data.addColumn("number", "Date");
        data.addColumn("number", "Users");
      }
    }
    data.addRows(chartData);
    var chart = new google.charts.Line(document.getElementById(put));
    chart.draw(data, google.charts.Line.convertOptions(optionsL));
  } else if (type == "donut") {
    if (vsal == true) {
      if (dtatp == "odr") {
        put = ["donutchart_o", "donutchart_ocp", "donutchart_opd"];
        for (var i = 0; i <= chartData.length - 1; i++) {
          optionsd = {
            title: title[i],
            pieHole: 0.4,
          };
          var data = google.visualization.arrayToDataTable(chartData[i]);
          var chart = new google.visualization.PieChart(
            document.getElementById(put[i])
          );
          chart.draw(data, optionsd);
        }
      }
    } else {
      var data = google.visualization.arrayToDataTable(chartData);
      var chart = new google.visualization.PieChart(
        document.getElementById(put)
      );
      chart.draw(data, optionsd);
    }
  }
}
