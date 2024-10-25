$(document).ready(function () {
  if ($(".remindomainheaderlptpvsn").html("")) {
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
});
function preloaderon() {
  const colors = [
      "linear-gradient(45deg, #ff8100, #4498E7)",
      "linear-gradient(245deg, #ff8100, #4498E7)",
    ],
    progressbar = document.querySelector(".remindopageloaderdivbox"),
    progress = setInterval(() => {
      const computedStyle = getComputedStyle(progressbar),
        width = parseFloat(computedStyle.getPropertyValue("--width")) || 0;
      progressbar.style.setProperty("--width", width + 0.2);
      if (width > 100) {
        clearInterval(progress);
        let colorsnvbr = setInterval(() => {
          progressbar.style.background = colors[Math.floor(Math.random() * 3)];
        }, 200);
        setTimeout(() => {
          clearInterval(colorsnvbr);
        }, 5);
      }
    }, 2);
}
rmdoshre();
function rmdoshre() {
  $(".hidepopupbtn").click((e) => {
    $(".shrrmdocnt").hide();
  });
  $(".shrbns-cplylnk").click((e) => {
    var copyText = $(e.target).attr("data-url");
    navigator.clipboard.writeText(copyText);
    $(e.target).text("Copied!");
    setTimeout(() => {
      $(e.target).text("Copy Link");
    }, 3000);
  });
  $(".shrpstbn").click((e) => {
    $(".shrbns-cplylnk").attr(
      "data-url",
      $(e.target).closest(".shrpstbn").attr("data-txt") +
        " : " +
        $(e.target).closest(".shrpstbn").attr("data-url")
    );
    $(".fbshratg").attr(
      "href",
      `https://facebook.com/sharer.php?u=${$(e.target)
        .closest(".shrpstbn")
        .attr("data-url")}`
    );
    $(".twtrshratg").attr(
      "href",
      `https://twitter.com/share?text=${$(e.target)
        .closest(".shrpstbn")
        .attr("data-txt")}&url=${$(e.target)
        .closest(".shrpstbn")
        .attr("data-url")}`
    );
    $(".whtsapshratg").attr(
      "href",
      `https://api.whatsapp.com/send?phone=&text=${
        $(e.target).closest(".shrpstbn").attr("data-txt") +
        $(e.target).closest(".shrpstbn").attr("data-url")
      }`
    );
    $(".pntrstshratg").attr(
      "href",
      `https://pinterest.com/pin/create/button/?url=${$(e.target)
        .closest(".shrpstbn")
        .attr("data-pic")}`
    );
    var files = [`${$(e.target).closest(".shrpstbn").attr("data-pic")}`];
    var optnsif = {
      title: $(e.target).closest(".shrpstbn").attr("data-ttl"),
      text: $(e.target).closest(".shrpstbn").attr("data-txt"),
      url: $(e.target).closest(".shrpstbn").attr("data-url"),
      file: files,
    };
    var optns = {
      title: $(e.target).closest(".shrpstbn").attr("data-ttl"),
      text: $(e.target).closest(".shrpstbn").attr("data-txt"),
      url: $(e.target).closest(".shrpstbn").attr("data-url"),
    };
    $(".shrrmdocnt").show();
    if (window.navigator.canShare && window.navigator.canShare(files)) {
      navigator.share(optnsif);
    } else if (window.navigator.share) {
      navigator.share(optns);
    }
  });
}
