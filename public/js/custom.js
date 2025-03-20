/*banner slider jquery */

$('#banner_slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
dots: true,
    speed:1000,
    arrows: false,
    autoplay:true

});





/*       why choose us counter jquery */
jQuery(document).ready(function( $ ) {
$('.counter').counterUp({
   delay: 30,
   time: 1000
});
});




// toogle class method forphone

$(".toggle_bars").click(function(){
$("body").toggleClass("opennav");
});





$('.service_slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
draggable: false,
    arrows: false,
    autoplay: true,
autoplaySpeed: 1000,

});







$('.our_trainer_slider').slick({
 infinite: true,
 slidesToShow: 3,
 slidesToScroll: 1,
 dots: false,

 arrows: true,
autoplay: true,
autoplaySpeed: 2000,
 responsive: [
   {
     breakpoint: 767,
     settings: {
       slidesToShow: 2,
       slidesToScroll: 1,

     }
   },
   {
     breakpoint: 600,
     settings: {
       slidesToShow: 1,
       slidesToScroll: 1
     }
   }
 ]
});



/* wow js animtion scrollSpy*/
jQuery(document).ready(function($){

   wow = new WOW(
     {
       boxClass: 'wow',
       animateClass: 'animated',
       offset: 0,
       mobile: true,
       live: true
     }
   )
   new WOW().init();



 WOW.prototype.addBox = function(element) {
   this.boxes.push(element);
 };

 // Init WOW.js and get instance
 var wow = new WOW();
 wow.init();

 // Attach scrollSpy to .wow elements for detect view exit events,
 // then reset elements and add again for animation
 $('.wow').on('scrollSpy:exit', function() {
   $(this).css({
     'visibility': 'hidden',
     'animation-name': 'none'
   }).removeClass('animated');
   wow.addBox(this);
 }).scrollSpy();

});


// toggle method jquery for phone

$(".mobile_toggle").click(function(){
 $("body").toggleClass("openmenu");
});
