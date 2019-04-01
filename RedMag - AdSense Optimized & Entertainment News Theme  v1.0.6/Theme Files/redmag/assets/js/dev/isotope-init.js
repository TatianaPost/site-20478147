(function($){
    "use strict";
    function redmag_isotope(){
        var $grid =$('.affect-isotope').isotope({
            transitionDuration: '0.4s',
            masonry: {
                columnWidth:'.col-item'
            },
            fitWidth: true,
        });
        $grid.imagesLoaded().progress( function() {
            $grid.isotope('layout');
        });
    }

    jQuery(document).ready(function($) {
        $('.lazy').lazy({
            effect: "fadeIn",
            effectTime: 400,
            threshold: 0
        });
        redmag_isotope();
    });

    jQuery(window).on( 'resize', function() {
        redmag_isotope();
    }).resize();

    jQuery(window).load(function(){
        redmag_isotope();
    });

})(jQuery);


