/*
 * Nav bottom slider
 *
 */

var append_direction;
var position_layout;
var nav_length;
var create_new_nav_row;
var selected_nav_element= null;
var selected_nav_node_active;
var elemnt_list;


/**
 *
 *
 */
function startHistoryBind()
{
  //console.log('startHistoryBind');
  var button= $('#'+slider_destination_breadcrumb_history_container_button);
  button.click(function(){
    if(button.attr('class')=='dontshow'){
      $('#'+slider_destination_breadcrumb_history).slideDown('slow');
      button.val('Hide History');
      button.attr('class','show');
      button.addClass('nav_open');
    }else{
      $('#'+slider_destination_breadcrumb_history).slideUp('slow');
      button.val('Show History');
      button.attr('class','dontshow');
      button.removeClass('nav_open');
    }
  });
}

/**
 * Start the process
 */
function buildNav()
{
  //console.log('buildNav');
  createNavButton();
}

/**
 * check if the node is in the history
 * @param int node_id
 */
function startNav(node_id)
{
  //console.log('startNav');
  resetNavActiveElement();
  cloneNavToHistory();
  $('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul+' li').remove();
  startBind(node_id, '');
}

/**
 * set the append direction ex:left or right
 * @param string direction
 */
function setAppendDirection(direction)
{
  //console.log('setAppendDirection');
  append_direction= direction;
}

/**
 * set the partial layout. It use the css class name
 * @param string layout
 */
function setPositionLayout(layout)
{
  //console.log('setPositionLayout');
  position_layout= layout;
}

function createNavButton()
{
  //console.log('createNavButton');
  if(append_direction == 'left')
    setPositionLayout(bottom_menu_layout_left_id);
  else
    setPositionLayout(bottom_menu_layout_right_id);
  
  resetNavActiveElement();
  checkNavElement();
}

function resetNavActiveElement()
{
  //console.log('resetNavActiveElement');
  selected_nav_node_active= $('#'+slider_destination_breadcrumb+' ul li a.active').attr('id');
  $('#'+slider_destination_breadcrumb+' ul li a.active').removeClass('active');
}

function checkNavElement()
{
  //console.log('checkNavElement');
  elemnt_list= $('#'+slider_destination_breadcrumb+' ul.breadcrumb li').length;
  if(elemnt_list > 0){
    $('#'+slider_destination_breadcrumb+' ul.breadcrumb li a').each(function(){
      if($(this).attr('id') == selected_node_predicate.replace(' ', '')+selected_node_id){
        selected_nav_element= selected_node_predicate.replace(' ', '')+selected_node_id;
        return false;
      }else if($(this).attr('id') == 'root_'+selected_node_id){
        selected_nav_element= 'root_'+selected_node_id;
        return false;
      }else{
        selected_nav_element= null;
        return true;
      }
    });
  }
  
  valorizeNav();
}

function valorizeNav()
{
  //console.log('valorizeNav');
  if(selected_nav_element){
    $('#'+selected_nav_element).addClass('active');
  }else{
    createActiveNavButtonLink();
  }
}

function createNewNavRow()
{
  //console.log('createNewNavRow');
  $('#'+slider_destination_breadcrumb).append('<ul id="nav_story_'+selected_node_id+'" class="breadcrumb"></ul>');
  slider_destination_breadcrumb_ul= selected_node_id;
  createActiveNavButtonLink();
}

function createActiveNavButtonLink()
{
  //console.log('createActiveNavButtonLink');
  var predicate= (selected_node_predicate !== undefined )? selected_node_predicate : 'root_';
  $('#'+position_layout+' a').addClass('active');
  $('#'+position_layout+' a').attr('onclick', 'javascript: startBind('+selected_node_id+',\''+selected_node_predicate+'\',\''+selected_node_direction+'\');');
  $('#'+position_layout+' a').attr('id', predicate.replace(' ', '')+selected_node_id);
  $('#'+position_layout+' a').html(selected_node_name);
  if(selected_node_predicate)
    $('#'+position_layout+' span.divider').html(selected_node_predicate);

  removeNode(append_direction);
  if(append_direction == 'right'){
    $('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul).append($('#'+position_layout).html());
  }else{
    $('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul).prepend($('#'+position_layout).html());
  }
  
  resetNavPartial();
}

function resetNavPartial()
{
  //console.log('resetNavPartial');
  $('#'+position_layout+' a').removeClass('active');
  $('#'+position_layout+' a').removeAttr('onclick');
  $('#'+position_layout+' a').removeAttr('id');
  $('#'+position_layout+' a').html('');
  $('#'+position_layout+' span.divider').html('');
}

function removeNode(append_direction)
{
  //console.log('removeNode');
  var selected_li      = $("li:has(a[id='"+selected_nav_node_active+"'])");
  var selected_li_span = $("li:has(a[id='"+selected_nav_node_active+"']) span");
  
  if(append_direction == 'right'){
    if(selected_li.next().length){
      cloneNavToHistory()
      selected_li_span.remove();
      selected_li.nextAll().each(function(){
        $(this).remove();
      });
    }
  }else{
    if(selected_li.prev().length){
      cloneNavToHistory();
      selected_li_span.remove();
      selected_li.prevAll().each(function(){
        $(this).remove();
      });
    }
  }
}

function cloneNavToHistory()
{
  //console.log('cloneNavToHistory');
  if($('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul+' li').length > 0){
    var history_nav= $('#'+slider_destination_breadcrumb+' ul#'+'nav_story_'+slider_destination_breadcrumb_ul).clone();
    history_nav.removeAttr('id');
    $('#'+slider_destination_breadcrumb_history).prepend(history_nav);
    
    last_history= $('#'+slider_destination_breadcrumb_history+' ul').first();
    last_history.find('li').each(function(){
      $(this).addClass('child');
      var action= $(this).find('a').attr('onclick');
      var new_action= action.replace("startBind","startNav");
      $(this).find('a').attr('onclick', new_action);
    });
  }
}