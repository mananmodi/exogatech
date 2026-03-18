jQuery(document).ready(function ($) {
  var ajaxurl = myAjax.ajaxurl;

  function workshop_listing(page, termid = 0, hashcategory) {
    var current_site_url = $("#current_site_url").val();
    var workshop_category = $(".workshop_category").val();

    $.ajax({
      dataType: "html",
      type: "post",
      url: myAjax.ajaxurl,
      data: {
        page: page,
        action: "workshop_listing",
        current_site_url: current_site_url,
        workshop_category: workshop_category,
        workshoplisting_nonce: myAjax.nonce,
        _nonce: myAjax._token,
      },
      beforeSend: function () {
        $(".cvf_universal_container").empty().hide();
        $(".loader").fadeIn();
      },
      success: function (response) {
        $(".loader").hide();

        $(".cvf_universal_container").empty().append(response).fadeIn();

        $(".cvf_pag_loading").css({
          background: "none",
          transition: "all 1s ease-out",
        });
      },
    });
  }

  var hash = window.location.hash.substring(1);

  if (hash) {
    pageno = parseInt(hash);

    var refresh;

    refresh = "#" + pageno + "/";

    window.history.pushState(
      {
        path: refresh,
      },
      "",
      refresh
    );

    workshop_listing(pageno);
    $("html, body").animate(
      {
        scrollTop: $(".workshops-listing").offset().top,
      },
      1000
    );
  } else {
    workshop_listing(1);
  }

  $(document).on("change","#workshop-category", function(){
     workshop_listing(1);
  });

  $(document).on(
    "click",
    ".cvf_universal_container .cvf-universal-pagination li.active",
    function () {
      var hash = window.location.hash.substring(1);
      var page = $(this).attr("p");

      var refresh;

      refresh = "#" + page + "/";

      window.history.pushState(
        {
          path: refresh,
        },
        "",
        refresh
      );
      workshop_listing(page);
      $("html, body").animate(
        {
          scrollTop: $(".workshops-listing").offset().top,
        },
        1000
      );
    }
  );

  $(document).on("click", ".cvf-universal-pagination a", function (e) {
    e.preventDefault();
  });
});
