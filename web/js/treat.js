$(document).ready(function(){
  checkButtonStatus()
  bindResult();
});

function bindTraiSelect(selected_element){
  if($(selected_element).attr('class') == 'trait_fields'){
    $.ajax({
      type: "POST",
      url: '/update-trait-select',
      data: $(selected_element).attr('name')+'='+$(selected_element).val()
    }).done(function ( data ) {
      var options= '';
      $.each($.parseJSON(data), function(key, value){
        options +='<option valeu="'+value+'">'+value+'</option>';
      });
      $('#trait_trait').html(options);
    });
  }
}

function bindResult(){
  $('#form_result span').click(function(){
    $('.open.landrace_box').each(function(){
      $(this).attr('class', 'closed landrace_box');
      $(this).fadeOut(3000);
    })
    if($(this).attr('class')=='label label-info landrace')
      getLandrace($('#landrace_form').serialize(), 'landrace');
    else
      getCwr($('#landrace_form').serialize(), 'cwr');
  });
}

function showResult(result, category){
  var html='<ul>';
  $.each(result, function(key, value) {
    var name= value.LRNAME ? value.LRNAME:'empty data' ;
    html +='<li><span id="'+value.id+'" class="label label-info '+category+'">'+name+'</span></li>';
  });
  html += '</ul>';
  $('#result_list').html(html);
  $('#result_list').fadeIn(3000);
  
  goToByScroll('result_list'); 
  
  bindResultRecord()
}

function bindResultRecord(){
  $('#result_list span').click(function(){
    
    if($(this).attr('class')=='label label-info landrace')
      getLandraceRecord($(this).attr('id'));
    else
      getCwrRecord($(this).attr('id'));
  });
}

function getLandraceRecord(record_id){
  $.ajax({
    type: "POST",
    url: '/get-landrace-record',
    data: 'record_id='+record_id
  }).done(function ( data ) {
    showLandraceDetail($.parseJSON(data));
  });
}

function getCwrRecord(record_id){
  $.ajax({
    type: "POST",
    url: '/get-cwr-record',
    data: 'record_id='+record_id
  }).done(function ( data ) {
    showLandraceDetail($.parseJSON(data));
  });
}

function showLandraceDetail(landrace){
  showDetail(landrace);
  initialize(landrace);
  $('#result_detail').fadeIn(3000);
  $('#trait_detail').fadeIn(3000);
  $('#map_canvas').fadeIn(3000);
  goToByScroll('map_canvas');
}

function showDetail(landrace){
  var more='';
  $.each(landrace, function(key, value) {
    var label= clearLabel(key);
    if(value){
      if($('#'+key).length > 0){
        $('#record_detail_'+key).html(value);
        $('#'+key+' label').addClass('label label-info');
      }
      else{
        more +='<li class="span2" id="record_detail_'+key+'" ><label for="record_detail_'+key+'" class="label label-info">'+label+'</label><span id="record_detail_'+key+'">'+value+'</span></li>';
      }
    }
    else{
      if($('#'+key).length > 0){
        $('#'+key).addClass('no_detail_find');
        $('#'+key+' label').addClass('label');
      }else{
        more +='<li class="span2 no_detail_find" id="record_detail_'+key+'" ><label for="record_detail_'+key+'" class="label label-info">'+label+'</label><span id="record_detail_'+key+'"></span></li>';
      }
    }
  });
  
  $('#record_detail_more').html(more);
  
}

function clearLabel(string_variable){
  var intIndexOfMatch = string_variable.indexOf("_");

  while (intIndexOfMatch != -1){
    string_variable = string_variable.replace( "_", " " )
    intIndexOfMatch = string_variable.indexOf( "_" );
  }
  
  return string_variable;
}

function goToByScroll(id){
  $('html,body').animate({scrollTop: $("#"+id).offset().top - $('#menu_header').height() - 10 },'slow');
}

function checkButtonStatus(){
  $('.container button').click(function(event) {
    event.preventDefault();
    var label_id= $(this).attr('id');
    
    if($('#detail_'+label_id).attr('class') == 'closed landrace_box'){
      $('#detail_'+label_id).attr('class', 'open landrace_box');
      if(!$('#detail_'+label_id).html())
        ask(label_id);
      $('#detail_'+label_id).fadeIn(3000);
    }else{
      $('#detail_'+label_id).attr('class', 'closed landrace_box');
      $('#detail_'+label_id).fadeOut(3000);
    }
  });
}

function ask(label_id){
  $.ajax({
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
  bindForm()
}

function bindForm(){
  $('form :input').change(function(e){
    var form_action= $('#landrace_form').attr('action');
    var form_data= $('#landrace_form').serialize();
    findLandrace(form_action, form_data);
    findCwr(form_action, form_data);
    bindTraiSelect($(this));
    //findTrait(form_action, form_data);
    return false;
  });
}

function getLandrace (form_data, category){
  $.ajax({
    type: "POST",
    url: '/get-landrace',
    data: form_data,
  }).done(function ( data ) {
    showResult($.parseJSON(data), category)
  });
}

function getCwr (form_data, category){
  $.ajax({
    type: "POST",
    url: '/get-cwr',
    data: form_data,
  }).done(function ( data ) {
    showResult($.parseJSON(data), category)
  });
}

function findLandrace (form_action, form_data){
  $.ajax({
    type: "POST",
    url: '/search-landrace',
    data: form_data,
  }).done(function ( data ) {
    $('#landrace_count').fadeOut();
    $('#landrace_count').html(data);
    $('#landrace_count').fadeIn('slow');
    updateTotal(data);
  });
}
function findCwr (form_action, form_data){
  $.ajax({
    type: "POST",
    url: '/search-cwr',
    data: form_data,
  }).done(function ( data ) {
    $('#cwr_count').fadeOut();
    $('#cwr_count').html(data);
    $('#cwr_count').fadeIn('slow');
    updateTotal(data);
  });
}
function findTrait (form_action, form_data){
  $.ajax({
    type: "POST",
    url: '/search-trait',
    data: form_data,
  }).done(function ( data ) {
    $('#trait_count').fadeOut();
    $('#trait_count').html(data);
    $('#trait_count').fadeIn('slow');
    updateTotal(data);
  });
}

function updateTotal(increment){
  var cwr_count;
  var trait_count;
  var landrace_count;
  
  trait_count= $("#trait_count").html() ? parseInt($("#trait_count").html(),10) : 0;
  cwr_count= $("#cwr_count").html() ? parseInt($("#cwr_count").html(),10) : 0;
  landrace_count= $("#landrace_count").html() ? parseInt($("#landrace_count").html(), 10) : 0;
  $('#result_count').html(cwr_count+trait_count+landrace_count);

}

//MAPS
function initialize(landrace) {
  var latitude= landrace.LRSLATDD;
  var longitude= landrace.FLONGDD;
  
  var mapOptions = {
    center: new google.maps.LatLng(latitude.replace(',', '.'), longitude.replace(',', '.')),
    zoom: 8,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("map_canvas"),
      mapOptions);

  var myLatlng = new google.maps.LatLng(latitude.replace(',', '.'), longitude.replace(',', '.'));

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: landrace.INSTCODE
  });
}