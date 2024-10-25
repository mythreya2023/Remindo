$(document).ready(() => {
  $(".tketothstr").click((e) => {
    e.preventDefault();
    var gst = $(".tketothstr");
    $.ajax({
      url: "http://localhost/remindo/stores/store",
      method: "post",
      data: { s: $(gst).attr("data-unm") },
      dataType: "json",
      beforeSend: () => {
        $("div.pageloader").show();
        preloaderon();
      },
      success: (data) => {
        $("div.pageloader").hide();
        $(".remindomainheaderlptpvsn").html("");
        $("body").addClass("storecustmrpgbdy");
        $(document).attr("title", data.title);
        $("div.remindochildboxycontainer")
          .html(data.body)
          .addClass("rmdchldbxstrecustmruidvbx");
        window.history.pushState(
          {},
          {},
          "http://localhost/remindo/stores/store?s=" + $(gst).attr("data-unm")
        );
      },
    });
  });
});
