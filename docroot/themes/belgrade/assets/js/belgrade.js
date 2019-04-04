/**
 * @file
 * Belgrade Theme JS.
 */
(function ($) {

    'use strict';

    /**
     * Close behaviour.
     */
    Drupal.behaviors.closeCartblockcontents = {
      attach: function (context, settings) {
        $('.cart-block--contents .close-btn').click(function() {
          $(this).parent().removeClass('cart-block--contents__expanded');
        });
      }
    };

  })(jQuery);
