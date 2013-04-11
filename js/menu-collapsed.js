function initMenu() {
  $('#menu ul').hide();
  $('#menu_selected1 ul').next().slideToggle('fast');
  $('.menu_tail ul').next().slideToggle('fast');
  $('#menu_selected1 ul').show();
  $('.menu_tail ul').show();
 
  $('#menu li a').click(
function() {
  $(this).next().slideToggle('fast');	
}
 );
  }
$(function() {initMenu();});