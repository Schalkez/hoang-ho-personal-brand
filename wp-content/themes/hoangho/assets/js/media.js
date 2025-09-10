jQuery(document).ready(function ($) {
  $(".media-page").each(function () {
    var $this = $(this);

    $this.find(".tab").click(function (e) {
      e.preventDefault();
      $(this).siblings().find("input")[0].checked = false;
      $(this).find("input")[0].checked = true;

      get_media();
    });
    $this.find("[data-page]").click(function () {
      var page = $(this).data("page");
      if (page != paged) get_media(page);
    });

    function get_media(page = 1) {
      paged = page;

      var type = $this.find('input[name="type"]:checked').val();

      $this.find(".loading-container").addClass("loading");
      $.ajax({
        type: "POST",
        url: hoangho_ajax.ajax_url,
        data: {
          action: "get_media",
          type: type,
          paged: page,
          posts_per_page: posts_per_page,
        },
        dataType: "JSON",
        success: function (response) {
          setTimeout(function () {
            render_media(response);
            loading_media();
          }, 400);
        },
      });
    }

    function loading_media() {
      $this.find(".loading-container").toggleClass("loading");
    }

    function render_media(response) {
      $this.find(".gallery-grid").html("");
      $this.find(".gallery-grid").append($(response.html));
      $this.find(".right-header").html("");
      $this.find(".right-header").append($(response.html_nav));
      $this.find(".gallery-footer").html("");
      $this.find(".gallery-footer").append($(response.html_pagination));
      $this.find("[data-page]").click(function () {
        var page = $(this).data("page");
        if (page != paged) get_media(page);
      });
    }
  });
});
