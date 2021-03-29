$(document).ready(function(){

  $("#burger").click(function() {
    if ($(window).width() <= 1440){
      $("nav").toggle(300);
      $("nav ul li a").click(function() {
        $("nav").hide(300);
      });
    }
    else{}
  });


  $('a').click(function(e){
    
    if($(e.target).is($("#accueilBtn")) && ($(window).width() < 1366)) {
      $("nav").hide(300);
      $('html, body').animate({scrollTop: $( $.attr(this, 'href') ).offset().top-100}, 500);
      return false;
    }
    else if($(e.target).is($("#accueilBtn")) && ($(window).width() >= 1366)) {
      $('html, body').animate({scrollTop: $( $.attr(this, 'href') ).offset().top-200}, 500);
      return false;
    }

    else if(!$(e.target).is($(".external"))) {
      if ($(window).width() < 1024){
        $("nav").hide(300);
        $('html, body').animate({scrollTop: $( $.attr(this, 'href') ).offset().top+30}, 500);
        return false;
      }
      else if (($(window).width() >= 1024)){
        $('html, body').animate({scrollTop: $( $.attr(this, 'href') ).offset().top-0}, 500);
        return false;
      }
      else if (($(window).width() >= 1366)){
        $('html, body').animate({scrollTop: $( $.attr(this, 'href') ).offset().top-0}, 500);
        return false;
      }
      else if (($(window).width() >= 1440)){
        $('html, body').animate({scrollTop: $( $.attr(this, 'href') ).offset().top-0}, 500);
        return false;
      }
      else if (($(window).width() >= 1920)){
        $('html, body').animate({scrollTop: $( $.attr(this, 'href') ).offset().top-0}, 500);
        return false;
      }
    }
    
  });


});
