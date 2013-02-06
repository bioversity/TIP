$(document).ready( function(){
  $("form :input[type=file], :input[type=text], textarea, select").each(function(){
    $(this).tooltip({
      position: { my: "left+15 center", at: "right center" },
      content: $(this).attr('title')    
    });
  });
  
  $("form td").each(function(){
    $(this).tooltip({
      position: { my: "left+15 center", at: "right center" },
      content: $(this).attr('title')    
    });
  });
});