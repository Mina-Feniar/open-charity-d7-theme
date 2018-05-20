/**
 * @file
 * Carousel hooks and customization.
 */

(function ($, Drupal, window, document, undefined) {
  const sm = window.matchMedia( "(max-width: 576px)" );
  const md = window.matchMedia( "(max-width: 768px)" );
  const lg = window.matchMedia( "(max-width: 992px)" );

  Drupal.behaviors.carouselWithIndicators = {
  attach: function (context, settings) {
      var counter = 0;

      if (sm.matches) {
        var colClass = 'sm-col-6';
        var itemsToShow = 2;
      }
      else if (md.matches) {
        var colClass = 'sm-col-4';
        var itemsToShow = 3;
      }
      else {
        var colClass = 'sm-col-2';
        var itemsToShow = 5;
      }
      var numOfSlides = $('#slides-temp .single-slide').length;
      var numOfItemsContainer = Math.ceil(numOfSlides/itemsToShow);

      // Creating container items and indicators.
      for (var j = 0; j < numOfItemsContainer; j++) {
        var activeClass = '';
        if (j == 0) {
          activeClass = ' active';
        }
        else {
          activeClass = '';
        }
        // Showing items Containers.
        $(".carousel-type-1 .carousel-inner").append('<div class="item-' + j + ' item ' +  activeClass + '">');

        // Showing items Indicators.
        $(".carousel-type-1 ol.carousel-indicators").append('<li data-target="#carousel-indicators" data-slide-to="'+ j +'" class="' + activeClass + '"></li>');
      }

      // Item containers loop.
      for (var i = 0; i < numOfSlides; i++) {
        if ((i % itemsToShow) == 0 && i != 0) {
          counter++;
        }
        $(".carousel-type-1 .carousel-inner .item-" + counter).append("<div class='border-box slideWrap pull-left " + colClass + "'>" +
            "<img class='single-slide img-responsive' src='" + $('#img-slide-' + i).attr('src') + "' alt='" + $('#img-slide-' + i).attr('alt') +"' />" +
            "</div>");
      }
      $('#slides-temp').empty();
    }
  };


  Drupal.behaviors.carouselWithArrows  = {
    attach: function (context, settings) {
      var counter2 = 0;
      if (sm.matches) {
        var colClass = 'sm-col-12';
        var itemsToShow = 1;
      }
      else if (md.matches) {
        var colClass = 'sm-col-6';
        var itemsToShow = 2;
      }
      else if (lg.matches) {
        var colClass = 'sm-col-4';
        var itemsToShow = 3;
      }
      else {
        var colClass = 'sm-col-3';
        var itemsToShow = 4;
      }
      var numOfSlides = $('.single-blog-post').length;
      var numOfItemsContainer = Math.ceil(numOfSlides/itemsToShow);

      // Creating container items and indicators.
      for (var j = 0; j < numOfItemsContainer; j++) {
        var activeClass = '';
        if (j == 0) {
          activeClass = ' active';
        }
        else {
          activeClass = '';
        }
        // Showing items Containers.
        $(".carousel-type-2 .carousel-inner").append('<div class="item-' + j + ' item ' + activeClass + '">');
      }

      // Item containers loop.
      for (var i = 0; i < numOfSlides; i++) {
        if ((i % itemsToShow) == 0 && i != 0) {
          counter2++;
        }
        $(".carousel-type-2 .carousel-inner .item-" + counter2).append('<div class="col border-box pull-left ' + colClass + '">'
            + $('#blog-post-' + i).html() + '</div>');
      }

      $('#carousel-arrows.carousel').carousel({
        interval: false
      });

      $('.blog-temp').empty();
    }

  }
})(jQuery, Drupal, this, this.document);