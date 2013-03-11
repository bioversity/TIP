/**
 * this methos is used to scroll at the called element in the page
 */

function calculateScroll(element){
  var scrollTop     = $(window).scrollTop(),
      elementOffset = $('#'+element).offset().top,
      distance      = (elementOffset - scrollTop);
      
  return scrollTop;
}
    
function goToByScroll(id){
  $('html,body').animate({scrollTop: $("#"+id).offset().top - $('#menu_header').height() - 10 },'slow');
}