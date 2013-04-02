$(document).ready( function(){ startTooltip() });

function startTooltip()
{
  $("td, div, :input[type=file], :input[type=radio], :input[type=text], textarea, select").each(function(){
    $(this).attr( "data-toggle", "tooltip");
    $(this).tooltip({
      placement: 'left',
      html: true,
      trigger: 'hover',
      animation: true,
      content: $(this).attr('title')    
    });
  });
}