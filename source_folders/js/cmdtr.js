$(document).ready(() => {
  $(".rmdohomepagediv").append(`<div class='rmdorylcamccntnrdvbx'>
  <div class='rmdo-rel-royl-camedtorcntngdvbx'>
    <div class='rmdo-rlcamradsplyr'>
      <div class='rlcamtopnvbrhdrcntngdvbx'>
        <div class='exitcamdvbtn'><i class='fas fa-times camicn'></i></div>
      </div>
      <div class='hdnognls' style='display: none'>
        <img
          src
          class='rmdo-lvml-igpc'
          id='lvmge'
          height='450'
          width='800'
          style='display: none'
        />
        <canvas
          class='rmdo-lvmdl-drwrcnvs'
          height='660'
          width='800'
          id='new-canvas'
        ></canvas>
      </div>
      <div class='rmdoroyl-camdsplycntngdvbx' id='capture'>
        <video
          src=''
          autoplay
          muted
          id='cam-dsplyr'
          class='rmdorylognl-dspl'
          style='display: block'
        ></video>
        <canvas
          id='rmdo-vdodsplyr-drwrcnvs'
          height='660'
          width='800'
          style='
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            object-fit: cover;
            transform: rotateY(180deg);
          '></canvas>
        <canvas
          class='rmdo-lvmdl-dsplyrcnvs'
          height='660'
          width='800'
          style='width:100%'
          id='output-canvas'
        ></canvas>
      </div>
      <div class='rmdorylcambtns-cntngdvbtndsdvbx'>
        <div class='lvmdlszesldrcntngdvbx'>
          <div class='lvmdlszeiodcr'>
            <div class='sldrslctors'>
              <div class='szettle' id='rotatsldrshw'>Rotate</div>
              <div class='szettle' id='szeslidrshwr'>Size</div>
            </div>
            <div class='slidecontainer'>
              <div class='shrotsbtns' style='display: flex'>
                <div class='szettle shrtrotlft'>
                  <i class='fas fa-undo camicn' style='font-size:16px'></i> Left
                </div>
                <div class='szettle shrtrotrght'>
                  <i class='fas fa-redo camicn' style='font-size:16px'></i> Right
                </div>
              </div>
              <div class='slidecontainer' style='padding: 0'>
                <input
                  type='range'
                  min='0'
                  max='200'
                  value='0'
                  class='camsldr'
                  id='szesldr'
                />
              </div>
            </div>
          </div>
        </div>
        <div class='cambtnscntngdvbx'>
          <div class='moroptnsbtndvbtn'>
            <i class='fas fa-circle-notch camicn'></i><i class='fas fa-plus camicn'></i>
          </div>
          <div class='piccpturebtnprntdvbx'>
            <div class='pccptrebtn'></div>
          </div>
          <div class='chngcamvwbtnasdvbtn'>
            <i class='fas fa-sync-alt camicn'></i><i class='fas fa-camera camicn'></i>
          </div>
        </div>
      </div>
    </div>
    <div class='rmdo-rlpicedtordvbx'>
      <div class='rmdo-royl-edtortphdr'>
        <div class='rmdo-royl-edtorgtbckbtn'>
          <i class='fas fa-arrow-left camicn'></i>
        </div>
        <div class='hdr-rght-sdeoptns' style='width: fit-content'>
          <div class='shrble-optn-dvbxbtn'>
            <i class='fas fa-share camicn'></i>
          </div>
        </div>
      </div>
      <div class='rmdo-cnvsedtor-man-dsplycntngdvbx'></div>
    </div>
  </div>
</div>`);
  var slider = document.querySelector(".camsldr");
  var rtvlue = 0,
    sldrvlu = 0;
  var x = 0;
  $(slider)
    .click(sldrclr)
    .on("mousemove", sldrclr)
    .on("touchmove", sldrclr)
    .on("touchstart", sldrclr)
    .on("touchend", sldrclr);
  $(".shrtrotlft").click(() => {
    rtvlue = rtvlue - 90;
    rtvlue = rtvlue < -360 ? -90 : rtvlue;
    rtvlue = Math.abs(rtvlue);
    slider.value = Math.abs(rtvlue);
    $(".rmdo-lvmdl-dsplyrcnvs").css("transform", "rotate(" + rtvlue + "deg)");
  });
  $(".shrtrotrght").click(() => {
    rtvlue = rtvlue + 90;
    rtvlue = rtvlue > 360 ? 90 : rtvlue;
    rtvlue = Math.abs(rtvlue);
    slider.value = rtvlue;
    $(".rmdo-lvmdl-dsplyrcnvs").css("transform", "rotate(" + rtvlue + "deg)");
  });
  $("#rotatsldrshw ,.shrtrotlft,.shrtrotrght").click((e) => {
    slider.value = rtvlue;
    $(slider)
      .attr("id", "rtlsdractvt")
      .attr("value", rtvlue)
      .attr("min", "0")
      .attr("max", "360")
      .attr(
        "style",
        `background: linear-gradient(92deg, #3b804a ${
          rtvlue / 3.6
        }%, #cdcdcdfa ${rtvlue / 3.6}%);`
      );
    $(".szettle").css("background", "#00000036");
    $("#rotatsldrshw").css("background", "#21a921");
  });
  $("#szeslidrshwr").click((e) => {
    slider.value = sldrvlu;
    $(slider)
      .attr("id", "szesldr")
      .attr("value", sldrvlu)
      .attr("min", "0")
      .attr("max", "200")
      .attr(
        "style",
        `background: linear-gradient(92deg, #3b804a ${
          sldrvlu / 2
        }%, #cdcdcdfa ${sldrvlu / 2}%);`
      );
    $(".szettle").css("background", "#00000036");
    $("#szeslidrshwr").css("background", "#21a921");
  });
  function sldrclr() {
    x = slider.value;
    if ($(slider).attr("id") == "szesldr") {
      $(slider).attr(
        "style",
        `background: linear-gradient(92deg, #3b804a ${x / 2}%, #cdcdcdfa ${
          x / 2
        }%);`
      );
      sldrvlu = x;
      $(".rmdo-lvmdl-dsplyrcnvs").css("width", x * 10 + "px");
    } else if ($(slider).attr("id") == "rtlsdractvt") {
      $(slider).attr(
        "style",
        `background: linear-gradient(92deg, #3b804a ${x / 3.6}%, #cdcdcdfa ${
          x / 3.6
        }%);`
      );
      rtvlue = x;
      $(".rmdo-lvmdl-dsplyrcnvs").css("transform", "rotate(" + x + "deg)");
    }
  }
  var moreopns = false;
  $(".moroptnsbtndvbtn").click((e) => {
    if (!moreopns) {
      moreopns = true;
      $(".lvmdlszesldrcntngdvbx").css("display", "flex");
      $(".rmdorylcambtns-cntngdvbtndsdvbx").css(
        "bottom",
        parseInt($(".rmdorylcambtns-cntngdvbtndsdvbx").css("bottom")) +
          parseInt($(".lvmdlszesldrcntngdvbx").css("height")) +
          "px"
      );
      $(".szettle").css("background", "#00000036");
      $("#szeslidrshwr").css("background", "#21a921");
      $(".moroptnsbtndvbtn").css("transform", "rotate(45deg)");
    } else {
      moreopns = false;
      $(".lvmdlszesldrcntngdvbx").hide();
      $(".rmdorylcambtns-cntngdvbtndsdvbx").css(
        "bottom",
        parseInt($(".rmdorylcambtns-cntngdvbtndsdvbx").css("bottom")) -
          parseInt($(".lvmdlszesldrcntngdvbx").css("height")) +
          "px"
      );
      $(".moroptnsbtndvbtn").css("transform", "rotate(0deg)");
    }
  });
  srtlvmdl();
});
function srtlvmdl() {
  $(".mhmebtn").click((e) => {
    $("#lvmge").attr("src", $(e.target).attr("data-m"));
    $(".rmdorylcamccntnrdvbx").show();
    vdofun();
  });
}
function vdofun() {
  var video = document.querySelector("#cam-dsplyr");
  var stream = null;
  var vdcvs = document.querySelector("#rmdo-vdodsplyr-drwrcnvs");
  var vdcnvs = vdcvs.getContext("2d");
  var img, c_out, ctx, c_tmp, ctx_tmp, frame;
  navigator.getUserMedia =
    navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia;
  var strmvdo = () => {
    vdcnvs.clearRect(0, 0, vdcvs.width, vdcvs.height);
    if (navigator.getUserMedia) {
      navigator.getUserMedia(
        {
          audio: false,
          video: {
            width: {
              min: 300,
              ideal: window.innerWidth <= 500 ? window.innerWidth : 800,
              max: 800,
            },
            height: {
              min: 576,
              ideal: window.innerWidth <= 500 ? window.innerHeight : 660,
              max: 1280,
            },
          },
        },
        function (strm) {
          video.srcObject = strm;
          stream = video.srcObject;
          video.onloadedmetadata = function (e) {
            video.play();
            init();
          };
        },
        function (err) {}
      );
    } else {
      alert("Camera not supported!");
    }
  };
  strmvdo();
  $(".rmdo-royl-edtorgtbckbtn").click((e) => {
    $(".rmdo-rlcamradsplyr").show();
    $(".rmdo-rlpicedtordvbx").hide();
    strmvdo();
  });
  var doScreenshot = () => {
    vdcvs.width = video.videoWidth;
    vdcvs.height = video.videoHeight;
    vdcnvs.clearRect(0, 0, vdcvs.width, vdcvs.height);
    vdcnvs.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
    html2canvas(document.querySelector("#capture")).then((canvas) => {
      $(".rmdo-cnvsedtor-man-dsplycntngdvbx").html(
        `<img src='${canvas.toDataURL(
          "image/jpg"
        )}' id='cptredimgfrmrmdocam' style='height:100%;width:100%;'>`
      );
      save(canvas.toDataURL("image/jpg"));
    });
    stream.getTracks().forEach(function (track) {
      track.stop();
    });
    video.stop = true;
  };

  function save(cnt) {
    let a = document.createElement("a");
    a.href = cnt;
    var rmvl = Math.random(0, 1000);
    a.download = "RemindoSnaps(" + rmvl + ").jpg";
    document.body.appendChild(a);
    a.click();
    $(a).remove();
  }
  $(".rlcamtopnvbrhdrcntngdvbx").click((e) => {
    vdcnvs.clearRect(0, 0, vdcvs.width, vdcvs.height);
    stream.getTracks().forEach(function (track) {
      track.stop();
    });
    video.stop = true;
    $(".rmdorylcamccntnrdvbx").hide();
    $(".rmdo-cnvsedtor-man-dsplycntngdvbx").html("");
  });
  $(".piccpturebtnprntdvbx").click((e) => {
    doScreenshot();
    $(".rmdo-rlcamradsplyr").hide();
    $(".rmdo-rlpicedtordvbx").show();
  });
  function init() {
    c_out = document.querySelector("#output-canvas");
    ctx = c_out.getContext("2d");
    c_tmp = document.querySelector("#new-canvas");
    ctx_tmp = c_tmp.getContext("2d");
    img = document.querySelector("#lvmge");
    dragElement(c_out);
    video.addEventListener("play", computedframe);
  }
  function computedframe() {
    ctx_tmp.drawImage(img, 0, 0, img.width, img.height);
    frame = ctx_tmp.getImageData(0, 0, img.width, img.height);
    for (i = 0; i < frame.data.length / 4; i++) {
      let r = frame.data[i * 4 + 0];
      let g = frame.data[i * 4 + 1];
      let b = frame.data[i * 4 + 2];
      // var [h, s, l] = RGBToHSL(r, g, b);
      if ((r < 140 && g > 140) || (r < 160 && g >= 230)) {
        frame.data[i * 4 + 3] = 0;
      }
      // if (h > 90 && h < 200) {
      // pixels[i + 3] = 0;
      // }
    }
    ctx.clearRect(0, 0, c_out.width, c_out.height);
    ctx.putImageData(frame, 0, 0);
    return;
  }
  function RGBToHSL(r, g, b) {
    r /= 255;
    g /= 255;
    b /= 255;
    let cmin = Math.min(r, g, b),
      cmax = Math.max(r, g, b),
      delta = cmax - cmin,
      h = 0,
      s = 0,
      l = 0;
    if (delta == 0) h = 0;
    else if (cmax == r) h = ((g - b) / delta) % 6;
    else if (cmax == g) h = (b - r) / delta + 2;
    else h = (r - g) / delta + 4;
    h = Math.round(h * 60);
    if (h < 0) h += 360;
    l = (cmax + cmin) / 2;
    s = delta == 0 ? 0 : delta / (1 - Math.abs(2 * l - 1));
    s = +(s * 100).toFixed(1);
    l = +(l * 100).toFixed(1);
    return [h, s, l];
  }
  $(".shrble-optn-dvbxbtn").click((e) => {
    var files = [`${$("#cptredimgfrmrmdocam").attr("src")}`];
    var optnsif = {
      file: files,
    };
    if (window.navigator.canShare && window.navigator.canShare(files)) {
      navigator.share(optnsif);
    } else {
      alert("Sorry! Photo share option not supported to this device.");
    }
  });

  function dragElement(elmnt) {
    var pos1 = 0,
      pos2 = 0,
      pos3 = 0,
      pos4 = 0;
    if (document.getElementById(elmnt.id + "header")) {
      document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
      document.getElementById(elmnt.id + "header").ontouchstart = dragMouseDown;
    } else {
      elmnt.onmousedown = dragMouseDown;
      elmnt.ontouchstart = dragMouseDown;
    }

    elmnt.ontouchstart = (e) => {
      var touch = e.touches[0];
      var mouseEvent = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY,
      });
      elmnt.dispatchEvent(mouseEvent);
    };
    function dragMouseDown(e) {
      e = e || window.event;
      e.preventDefault();
      pos3 = e.clientX;
      pos4 = e.clientY;
      document.onmouseup = closeDragElement;
      document.onmousemove = elementDrag;
      document.ontouchend = closeDragElement;
      document.ontouchmove = elementDrag;

      document.ontouchmove = (e) => {
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousemove", {
          clientX: touch.clientX,
          clientY: touch.clientY,
        });
        document.dispatchEvent(mouseEvent);
      };
      document.ontouchend = (e) => {
        var mouseEvent = new MouseEvent("mouseup", {});
        document.dispatchEvent(mouseEvent);
      };
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
      document.ontouchend = null;
      document.ontouchmove = null;
    }
  }
  return;
}
