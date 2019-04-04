/**
 * @file
 * Product images JS
 */
(function ($) {

    'use strict';

    Drupal.behaviors.productImages = {
      attach: function (context, settings) {

        $('.product-img--main')
        // tile mouse actions
        .on('mouseover', function(){
          $(this).children('.product-img--main__image').css({'transform': 'scale('+ $(this).attr('data-scale') +')'});
        })
        .on('mouseout', function(){
          $(this).children('.product-img--main__image').css({'transform': 'scale(1)'});
        })
        .on('mousemove', function(e){
          $(this).children('.product-img--main__image').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
        })
        // tiles set up
        .each(function(){
          $(this)
            // add a image container
            .append('<div class="product-img--main__image"></div>')
            // set up a background image for each tile based on data-image attribute
            .children('.product-img--main__image').css({'background-image': 'url('+ $(this).attr('data-image') +')'});
        });

        $('.product-img--thumb')

        .click(function(){
          // add active class to visble image
          $(this).addClass('active').siblings().removeClass('active');
          // get image src attribute from image
          var img_src = 'url("' + $(this).children('img').attr('src') + '")';
          // change css
          $('.product-img--main__image').css('background-image', img_src);
        })
        .first().addClass('active');

        $('.product-img--thumb__switcher')
        .click(function(){
          if ($(this).siblings('.active').is(":last-child")){
            // check if the needed element is last
            $(this).siblings().first().click();
          } else{
            // if not just click on next
            $(this).siblings('.active').next().click();
          }
        });

      }
    };

  })(jQuery);
