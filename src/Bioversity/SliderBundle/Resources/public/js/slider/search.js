/**
 * Search
 *
 */

var start_search_bind= true;
var show_search_filter= true;

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

function showSearchFilter(destination)
{
  //console.log('showSearchFilter');
  $('#'+destination+' .search_filter').fadeIn();
}

function startSearchBind()
{
  $('.search_filter').keyup(function (){
    var search_id= $(this).attr('id');
    var string= $(this).val();
    if(string.length >= 3){
      delay(function(){
        if(search_id === 'search_left'){
          resetLeft();
          resetPager();
          searchNodeRelationINById(string);
        }else{
          resetRight();
          resetPager();
          searchNodeRelationOUTById(string);
        }
      }, 1000 );
    }else if(string.length === 0){
      delay(function(){
        if(search_id === 'search_left'){
          resetLeft();
          resetPager();
          getNodeRelationINById(string);
        }else{
          resetRight();
          resetPager();
          getNodeRelationOUTById(string);
        }
      }, 1000 );
    }
  });
}

function createSearchPoint()
{
    $('#search_point').html('');
    $.ajax({
        url:        dev_stage+'/slider/partial/node/search/'+pager_search_node_data_selected,
        dataType:   "html",
        success: function( data ) {
           $('#search_point').append(data);
        }
     }).done( function(){
        buildTree();
        bindFormCheckbox();
        startAutocomplete('SliderSearchNode');
        startTooltip();
        bindSearchButton();
     });  
}

function bindSearchButton()
{
  $('#SliderSearchNode_search').click(function(event){
      event.preventDefault();
      searchNode(0);
  });
  
  $('#SliderSearchNode_clear').click(function(event){
    setActualForm('SliderSearchNode');
    unvalorizeAllField();
  });
}

function searchNode(page)
{
  resetSearchPager();
  hideSlider();
  pager_search_node_data_selected= page;
  $.ajax({
      type:       "POST",
      url:        dev_stage+'/slider/partial/node/search/'+(page),
      dataType:   "json",
      data:       $('#SliderSearchNode').serializeArray(),
      success: function( data ) {
        generateNodeList(data);
      }
  });
}