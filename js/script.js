(function ($) {
  $(document).ready(function () {
    
    var $lightbox = $('.lightbox');

    // Ouvrir la lightbox
    $('.acf-gallery a').click(function (e) {
      e.preventDefault();
      var url = $(this).attr('href');

      $lightbox.css('background-image', 'url(' + url + ')');
      $lightbox.fadeIn();
    });

    // Fermer la lightbox
    $lightbox.click(function () {
      $lightbox.fadeOut();
    });


    // Flexslider 
    $('.flexslider').flexslider();

  });
})(jQuery);
