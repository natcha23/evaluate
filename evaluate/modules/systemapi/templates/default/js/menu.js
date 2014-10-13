  $(document).ready(function() {
     $("img#toggle-left-menu")
     .css({"cursor":"pointer"})
     .attr({title:"Close"})
     .click(function() {
         $('#left-menu-container').animate({opacity: 0.5}, 10).toggle("slow",function(){
             $('#left-menu-container-open').css({height:"99%"}).toggle("fast");
         });
         return false;
     });

     $("span#toggle-left-menu-open")
     .css({"cursor":"pointer"})
     .attr({title:"Open"})
     .click(function() {
         $('#left-menu-container-open').toggle("fast",function(){
             $('#left-menu-container').toggle("show",function(){$(this).animate({opacity: 1.0})});
         });
         return false;
     });
  });