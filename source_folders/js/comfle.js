function preloaderon() {
  const colors = [
      "linear-gradient(45deg, #ff8100, #4498E7)",
      "linear-gradient(245deg, #ff8100, #4498E7)",
    ],
    progressbar = document.querySelector(".remindopageloaderdivbox");
  //   progressbar.style.display = "block";
  let progress = setInterval(() => {
    const computedStyle = getComputedStyle(progressbar),
      width = parseFloat(computedStyle.getPropertyValue("--width")) || 0;
    progressbar.style.setProperty("--width", width + 0.2);
    if (width > 100) {
      let colorsnvbr;
      clearInterval(progress);
      colorsnvbr = setInterval(() => {
        progressbar.style.background = colors[Math.floor(Math.random() * 3)];
      }, 200);
      setTimeout(() => {
        clearInterval(colorsnvbr);
        progressbar.style.setProperty("--width", 1);
      }, 20000);
    }
  }, 2);
}
$("button.hidepopupbtn").click(function () {
  $("div.popupbackground,div.popupcontainerbox").hide();
});
$(".pgnavblbtn").click((r) => {
  $.ajax({
    url: "http://localhost/remindo/home.php",
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
