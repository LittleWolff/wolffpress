var ajax_request_running;
var paged = 1;

jQuery( document ).ready(function() {
    function setAccordion(){

         var trigger = '.accordion-trigger';
         var content = '.accordion-content';
         var container = '.accordion-container';
         var speed = 400;

        function closeOtherAccordionGroups()
        {
          jQuery(trigger+'.expanded').next().slideToggle(speed);
          jQuery(trigger+'.expanded').removeClass('expanded');
        }

        function closeAllGroups()
        {
            jQuery(this).slideToggle(speed);
        }

        function bindTriggerClicks()
        {

          //unbind old click event
          jQuery(trigger).unbind('click');
          //bind new click event
          jQuery(trigger).on('click', function() {

            if(!jQuery(this).closest(trigger).attr('class').match('expanded'))
            {
              closeOtherAccordionGroups();
            }

            jQuery(this).next().slideToggle(speed);
            jQuery(this).closest(trigger).toggleClass('expanded');
            
          });
        }
        bindTriggerClicks();
    }

    setAccordion();

    jQuery('.slider-container').slick({
      arrows: true,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false
    });

  //Initialize gallery slider if one exists
  if(jQuery('.gallery-slider')[0]){

    jQuery('.gallery-slider').slick({
      arrows: true,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: true,
      fade: true,
      autoplay: false
    });

    jQuery('.entry.new').on('click', function(){
      jQuery('.gallery-slider').slick('slickGoTo',jQuery(this).index(),true);
      jQuery('.gallery-slider').slick('refresh');
    });

    jQuery('.entry.new').css('opacity','0');

    var animation_delay = 0;

    jQuery('.entry.new').each(function(){
      jQuery(this).delay(animation_delay).animate({ opacity: 1 }, 700);
      animation_delay += 100;
    });

    jQuery('.entry.new').removeClass('new');

    jQuery(document).on('opening', '.remodal', function () {
      jQuery(window).trigger('resize');
      jQuery('.gallery-slider').slick('refresh');
    });

    /* AJAX Gallery */
    jQuery(window).scroll(function() {
      if(jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height() - jQuery('footer').height() ) {

        if(ajax_request_running !== true && jQuery('.view-more')[0]){

          jQuery('.view-more').each(function(){

            var gallery_row = jQuery(this).data('gallery-row');
            var page_id = jQuery(this).data('page-id');

            jQuery(this).remove();

            paged++;

            ajax_request_running = true;

            ajax_request = jQuery.ajax({
              url: ajaxObject.ajaxurl,
              type: "post",

              data: {
                  paged: paged,
                  page_id: page_id,
                  gallery_row: gallery_row,
                  action: 'addGalleryAjax'
              },
              success: function(data) {

                var return_val = JSON.parse(data);

                var pictures = return_val[0];
                var slides = return_val[1];

                ajax_request_running = false;
                jQuery('.gallery-block').append(pictures);

                slides = slides.split('~');

                for(var i = 0; i < slides.length; i++){
                  jQuery('.gallery-slider').slick('slickAdd', slides[i]);
                }

                jQuery('.entry.new').on('click', function(){
                  jQuery('.gallery-slider').slick('slickGoTo',jQuery(this).index(),true);
                  jQuery(window).trigger('resize');
                });

                jQuery('.entry.new').css('opacity','0');

                var animation_delay = 0;

                jQuery('.entry.new').each(function(){

                  jQuery(this).delay(animation_delay).animate({ opacity: 1 }, 700);
                  animation_delay += 100;

                });
                      
                jQuery('.entry.new').removeClass('new');

              },
              error: function() {
                ajax_request_running = false;
                console.log('error loading gallery');
              }
            });
          });
        }
      }
    });
  }
});
