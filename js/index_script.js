var isdown1 = 0;
var isdown2 = 0;
$(document).ready(function() {
  $._messengerDefaults = {
    extraClasses: 'messenger-fixed messenger-theme-future messenger-on-bottom messenger-on-right'
  }
});
$(document).on('click', '.ye', function(e) {
  $(this).scojs_collapse();
  return false;
});
$(document).on('click', '.curriculum', function(e) {
  isdown1 = (isdown1 + 1) % 2;
  $('#curriculum').scojs_collapse();
  if (isdown1 == 1) $(".chartbtn").addClass("active");
  else $(".chartbtn").removeClass("active");
  if ($('.main-right-inner').scrollTop() != 0 && isdown1 == 1) $('.main-right-inner').animate({
    scrollTop: 0
  }, 'slow');
  return false;
});
$(document).on('click', '.selected-curriculum', function(e) {
  isdown2 = (isdown2 + 1) % 2;
  $('#selected-curriculum').scojs_collapse();
  if (isdown2 == 1) $(".choosedbtn").addClass("active");
  else $(".choosedbtn").removeClass("active");
  if (isdown2 == 1) {
    if ($('.main-right-inner').scrollTop() != 0)
      if (isdown1 == 1 && $('.main-right-inner').scrollTop() != 410) $('.main-right-inner').animate({
        scrollTop: 410
      }, 'slow');
      else if ($('.main-right-inner').scrollTop() != 0) $('.main-right-inner').animate({
      scrollTop: 0
    }, 'slow');
  }
  return false;
});
function inittooltip() {
  $('.icon-search').tooltip();
}
$(document).on('click', '.selectall', function(e) {
  $('.makecourse input').attr('checked', 'checked');
});
$(document).on('click', '.selectinverse', function(e) {
  $('.makecourse input').each(function() {
    if ($(this).attr('checked') == 'checked') $(this).removeAttr('checked');
    else $(this).attr('checked', 'checked');
  });
});
$(document).on('click', '.gototop', function(e) {
  $('.main-right-inner').animate({
    scrollTop: 0
  }, 'slow');
});
$(document).on('keypress', '.search-text', function(e) {
  if (e.which == 13) {
    $('.go').click();
  }
});
function hidetop() {
  if ($('.main-right-inner').scrollTop() == 0) $('.gototop').fadeOut(500);
  else $('.gototop').fadeIn(500);
}