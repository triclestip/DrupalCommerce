 /**
 * @file
 * Belgrade Theme JS.
 */
(function ($, Drupal) {

    'use strict';

    /**
     * Close behaviour.
     */
    Drupal.behaviors.quantityIncDec = {
      attach: function (context) {
        $(".number-btn").once().on("click", function() {

            var $button = $(this);
            var oldValue = parseInt($button.parent().find("input").val());
            var newVal;

            if ($button.text() === "+") {
              newVal = oldValue + 1;
            } else {
              // Don't allow decrementing below zero
              newVal = (oldValue > 0) ? oldValue - 1 : 0;
            }

            $button.parent().find("input").val(newVal);
          });
      }
    };

  })(jQuery, Drupal);
