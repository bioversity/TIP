$(document).ready( function(){ startTooltip() });

function startTooltip()
{
  $("form :input[type=file], :input[type=radio], :input[type=checkbox], :input[type=text], textarea, select").each(function(){
    $(this).tooltip({
      position: { my: "left+15 center", at: "right center" },
      content: $(this).attr('title')    
    });
  });
  
  $("form td, div").each(function(){
    $(this).tooltip({
      position: { my: "left+15 center", at: "right center" },
      content: $(this).attr('title')    
    });
  });  
}