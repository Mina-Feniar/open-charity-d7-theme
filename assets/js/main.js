/**
 * @file
 * Main scripts.
 */
(function ($, Drupal, window, document, undefined) {
  Drupal.behaviors.humbergerMenu= {
    attach: function (context, settings) {
      $("#humb-menu").click(function(){
        $("#main-menu").slideToggle();
      });
    }
  }
})(jQuery, Drupal, this, this.document);
