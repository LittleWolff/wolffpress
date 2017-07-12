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

        //closeAllGroups();
        bindTriggerClicks();
    }

    setAccordion();

    jQuery('.flexslider').flexslider({
      animation: "slide"
    });
})