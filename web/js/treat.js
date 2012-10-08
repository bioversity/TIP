$(document).ready(function(){
  $('button').click(function(){
    var label_id= $(this).attr('id');
  
    if($('#detail_'+label_id).attr('class') == 'closed landrace_box'){
      $('#detail_'+label_id).attr('class', 'open landrace_box');
      ask(label_id);
      $('#detail_'+label_id).fadeIn(3000);
    }else{
      $('#detail_'+label_id).attr('class', 'closed landrace_box');
      $('#detail_'+label_id).fadeOut(3000);
    }
  });
});

function ask(label_id){
	jQuery.ajax({
	  	url: '/get-landrace-detail/'+label_id
	}).done(function(data) {
		if(data === null)
			console.log('error, the request is null');
		else{
			buildStep(label_id, data)
		}
	}).fail(function() { 
		console.log('error, the request url was not found'); 
	});
}

function buildStep(label_id, data){
  $('#detail_'+label_id).html(data);
  $('#detail_'+label_id+'.list').attr('width', 100/$('#detail_'+label_id+' .list').size());
}