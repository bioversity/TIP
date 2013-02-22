/**
 * this methos is used to scroll at the called element in the page
 */


function goToByScroll(id){
  $('html,body').animate({scrollTop: $("#"+id).offset().top - $('#menu_header').height() - 10 },'slow');
}