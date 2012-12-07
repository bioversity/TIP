/**
 *	Global plugin setup file.
 *
 *	This file set the global var for the plugin
 *	You can customize the slider changing the html class name of the single elment
 *
 *	@package	ontology slider
 *
 *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
 *	@version	1.00
 */

var slider_destination_content= 'slider';
var slider_destination_root= 'entry_point ul.nav';
var slider_destination_right= 'node_childrens';
var slider_destination_left= 'node_parents';
var slider_destination_center= 'node_details #node_details_container_body';
var slider_destination_center_header= 'node_details #node_details_container_header';
var slider_destination_pager= 'pager';
var slider_destination_breadcrumb= 'breadcrumb';
var slider_destination_breadcrumb_history= 'breadcrumb_history';
var slider_destination_breadcrumb_history_container= 'history_container';
var slider_destination_breadcrumb_history_container_button= 'history_button';
var slider_destination_breadcrumb_ul= 'root';

var slider_partials_layout;
var slider_menu_layout;
var slider_container_layout;
var slider_breadcrumb_layout;
var slider_css;
var slider_breadcrumb_history_layout;

var top_menu_layout_id= 'nav_top_button';
var bottom_menu_layout_left_id= 'nav_bottom_button_left .node_record';
var bottom_menu_layout_right_id= 'nav_bottom_button_right .node_record';
var slider_right_layout_id= 'node_button_right';
var slider_left_layout_id= 'node_button_left';
var slider_center_layout_id= 'node_details_layout';
var slider_pager_layout_id= 'node_pager_layout';

var dev_env= '/app_dev.php';
var urlForRootNodes= '/get-root-nodes';
var urlForNodeDetails= '/get-node-details';
var urlForNodeRelationIN= '/get-node-relation-in';
var urlForNodeRelationOUT= '/get-node-relation-out';
var urlForNodeRelationPagerIN= '/get-node-relation-pager-in';
var urlForNodeRelationPagerOUT= '/get-node-relation-pager-out';
var urlForNodeRelations= '/get-node-relations';

$('document').ready(function(){
  createCss();
  createMenu();
  createContainer();
  createPartial();
  createBreadcrumb();
  createBreadcrumbHistory();
  loadTemplates();
  startHistoryBind();
});

function createCss(){
  slider_css=
  '<style>'+
  '.ui-effects-transfer { border: 2px solid black; }'+
  '.KIND-FEATURE{'+
  '  color: #DF0101;'+
  '}'+  
  '.KIND-SCALE{'+
  '  color: #FFFF00;'+
  '}'+  
  '.KIND-ROOT{'+
  '  color: #0101DF;'+
  '}'+   
  '.KIND-METHOD{'+
  '  color: #FF8000;'+
  '}'+  
  '.KIND-ENUMERATION{'+
  '  color: #3ADF00;'+
  '}'+  
  '.KIND-NAMESPACE{'+
  '  color: #000;'+
  '}'+
  '.KIND-PREDICATE{'+
  '  color: #00FFFF;'+
  '}'+
  '#slider,'+
  '#entry_point,'+
  '#breadcrumb{'+
  '  //width: 100%;'+
  '  //margin-bottom: 5px;'+
  '}'+  
  '#slider{'+
  '  height: 400px;'+
  '}'+  
  '#entry_point button{'+
  '  float: left;'+
  '}'+  
  '#node_details{'+
  '  height: 95%;'+
  '}'+  
  '#node_details_container_body{'+
  '  height: 255px;'+
  '  overflow: auto;'+
  '  border-radius: 3px 3px 3px 3px;'+
  '  background: none repeat scroll 0 0 #E3E3E3;'+
  '  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) inset;'+
  '  position: relative;'+
  '  margin-top: 5px;'+
  '}'+
  '#node_details_container{'+
  '  //border: 1px solid #000;'+
  '}'+
  '#node_parents ul,'+
  '#node_details ul,'+
  '#node_childrens ul{'+
  '  list-style: none !important;'+
  '  margin: 0px !important;'+
  '  padding: 5px !important;'+
  '}'+  
  '#node_parents li,'+
  '#node_details #node_details_container_header li,'+
  '#node_childrens li{'+
  '  border-bottom: 1px solid #fff;'+
  '  padding: 5px;'+
  '}'+  
  '#node_parents li .btn_node_name,'+
  '#node_details li .btn_node_name,'+
  '#node_childrens li .btn_node_name{'+
  '  font-size: 1.2em;'+
  '  max-width: 70%;'+
  '  font-weight: bold;'+
  '}'+  
  '#node_parents li .btn_node:hover,'+
  '#node_childrens li .btn_node:hover{'+
  '  color: red;'+
  '}'+  
  '#node_parents li .btn_node_code,'+
  '#node_details li .btn_node_code,'+
  '#node_childrens li .btn_node_code{'+
  '  font-style:oblique;'+
  '  font-size: 0.8em;'+
  '  font-family: impact;'+
  '}'+  
  '#node_parents li:hover,'+
  '#node_childrens li:hover{'+
  '  //font-weight: bold;'+
  '  background-color: #fff;'+
  '  color: #000;'+
  '}'+
  '#node_parents{'+
  '  width: 33%;'+
  '  float: left;'+
  '  padding-left: 10px;'+
  '}'+  
  '#node_details{'+
  '  width: 30%;'+
  '  float: left;'+
  '  padding-left: 10px;'+
  '}'+  
  '#node_childrens{'+
  '  width: 33%;'+
  '  float: right;'+
  '  padding-left: 10px;'+
  '}'+  
  '#slider_button_left{'+
  ' float: left; '+
  '}'+
  '#slider_button_right{'+
  '  float: right;'+
  '}'+
  '#slider_button_left,'+
  '#slider_button_right{'+
  '  position: relative;'+
  '  height: 400px;'+
  '  width: 50px;'+
  '  background-color: rgba(0,0,0,0.5);'+
  '  z-index: 100;'+
  '}'+
  '#slider_button_left:hover,'+
  '#slider_button_right:hover{'+
  '  background-color: rgba( 0,102,255,0.5);'+
  '}'+
  '#node_button_left,'+
  '#node_button_right{'+
  '  display: none;'+
  '}'+
  '#node_name,'+
  '#node_code,'+
  '#node_description{'+
  '  margin-bottom: 5px;'+
  '}'+
  '#node_parents .btn_node,'+
  '#node_details .btn_node,'+
  '#node_childrens .btn_node{'+
  '  cursor: pointer;'+
  '  width: 100%;'+
  '  text-indent: 10px;'+
  ' -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;'+
  ' -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;'+
  ' box-shadow:inset 0px 1px 0px 0px #ffffff;'+
  ' background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );'+
  ' background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );'+
  ' filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#ededed", endColorstr="#dfdfdf");'+
  ' background-color:#ededed;'+
  ' -moz-border-radius:5px;'+
  ' -webkit-border-radius:5px;'+
  ' border-radius:5px;'+
  ' border:1px solid #dcdcdc;'+
  ' display:inline-block;'+
  ' color:#777777;'+
  '}'+
  '#node_parents div.btn_node_more,'+
  '#node_childrens div.btn_node_more{'+
  '  cursor: pointer;'+
  '}'+
  'ul.breadcrumb{'+
  '  color: #0088CC !important;'+
  '  text-decoration: none !important;'+
  '  margin: 0 !important;'+
  '}'+
  'ul.breadcrumb li a{'+
  '  color: #0088CC !important;'+
  '  text-decoration: none !important;'+
  '}'+
  'ul.breadcrumb li a.active{'+
  '  color: red !important;'+
  '  text-decoration: none !important;'+
  '}'+
  '#history_container input[type="button"]{'+
  '  float: left;'+
  '}'+
  '#breadcrumb_history{'+
  '  float: left;'+
  '  width: 100%;'+
  '}'+
  '#history_container{'+
  '  background-color: #FBFBFB;'+
  '  background-image: -moz-linear-gradient(center top , #FFFFFF, #F5F5F5);'+
  '  background-repeat: repeat-x;'+
  '  border: 1px solid #DDDDDD;'+
  '  border-radius: 3px 3px 3px 3px;'+
  '  box-shadow: 0 1px 0 #FFFFFF inset;'+
  '  margin: 0 0 18px;'+
  '  padding: 7px 14px;'+
  '}'+
  '.clear{'+
  '  clear: both;'+
  '  height: 0px !important;'+
  '}'+
  '#history_container{'+
  '  border-bottom: 1px solid #fff;'+
  '}'+
  '#history_button{'+
  '  margin-bottom: 0px !important;'+
  '  background-color: #FBFBFB;'+
  '  background-image: -moz-linear-gradient(center top , #FFFFFF, #F5F5F5);'+
  '  background-repeat: repeat-x;'+
  '  border: 1px solid #DDDDDD;'+
  '  border-radius: 3px 3px 3px 3px;'+
  '  box-shadow: 0 1px 0 #FFFFFF inset;'+
  '  width: 100%;'+
  '}'+
  '#node_legend{'+
  '  background-color: #d9d9d9;'+
  '  padding: 5px;'+
  '}'+
  '#node_legend span{'+
  '  margin-right: 10px;'+
  '  font-weight: bold;'+
  '}'+
  '</style>';
}

/**
 * this method include on the slider container all html partial
 *
 */
function loadTemplates(){
  $('#slider_content').append(slider_css);
  $('#slider_content').append(slider_menu_layout);
  $('#slider_content').append(slider_breadcrumb_layout);
  $('#slider_content').append(slider_breadcrumb_history_layout);
  $('#slider_content').append(slider_container_layout);
  $('#slider_content').append(slider_partials_layout);
  initSlider();
}

/**
 * this method create the html container
 *
 */
function createContainer(){
  slider_container_layout=
  '<div id="slider">'+
  '  <div id="node_legend">'+
  '    <span class="KIND-ROOT">■ :KIND-ROOT</span> '+
  '    <span class="KIND-SCALE">■ :KIND-SCALE</span> '+
  '    <span class="KIND-FEATURE">■ :KIND-FEATURE</span> '+
  '    <span class="KIND-ENUMERATION">■ :KIND-ENUMERATION</span> '+
  '    <span class="KIND-NAMESPACE">■ :KIND-NAMESPACE</span> '+
  '  </div>'+
  '  <div id="node_parents">'+
  '    <h3>Incoming Relations</h3>'+
  '    <ul class="node_container"></ul>'+
  '    <div class="pager"></div>'+
  '  </div>'+
  '  <div id="node_details">'+
  '    <h3>Node Detail</h3>'+
  '    <ul id="node_details_container_header" class="node_container" style="display: none;">'+
  '      <li>'+
  '        <div class="btn_node">'+
  '          <div class="btn_node_name" style="float: left;"></div>'+
  '        </div>'+
  '        <div class="clear">&nbsp;</div>'+  
  '        <div class="btn_node_code" style="float: left;"></div>'+
  '        <div class="clear">&nbsp;</div>'+
  '      </li>'+
  '    </ul>'+
  '    <ul id="node_details_container_body" class="node_container"></ul>'+
  '  </div>'+
  '  <div id="node_childrens">'+
  '    <h3>Outgoing Relations</h3>'+
  '    <ul class="node_container"></ul>'+
  '    <ul class="pager"></ul>'+
  '  </div>'+
  '</div>'+
  '<div class="clear"></div>';
}

/**
 * this method create the html menu
 *
 */
function createMenu(){
  slider_menu_layout=
  '<div id="entry_point" class="navbar">'+
  '  <div class="navbar-inner">'+
  '    <ul class="nav"></ul>'+
  '    <div class="clear">&nbsp;</div>'+
  '  </div>'+
  '</div>'+
  '<div class="clear"></div>';
}

/**
 * this method create the html breadcrumb
 *
 */
function createBreadcrumb(){
  slider_breadcrumb_layout=
  '<div id="breadcrumb">'+
  ' <ul id="nav_story_root" class="breadcrumb"></ul>'+
  '</div>'+
  '<div class="clear"></div>';
}

/**
 * this method create the html breadcrumb
 *
 */
function createBreadcrumbHistory(){
  slider_breadcrumb_history_layout=
  '<div id="history_container">'+
  ' <input id="history_button" type="button" class="dontshow" style="float:left;" value="Show History" />'+
  ' <div id="breadcrumb_history" style="display:none;"></div>'+
  ' <div class="clear"></div>'+
  '</div>'+
  '<div class="clear"></div>';
}

/**
 * this method create the html partials
 *
 */
function createPartial(){
  slider_partials_layout=
  '<!-- NODE RESULT PARTIAL LAYOUT LEFT-->'+
  '<div id="node_button_left" style="display: none;">'+
  '  <div class="node_record">'+
  '    <li class="dontshow">'+
  '      <div class="btn_node">'+
  '        <div class="btn_node_name" style="float: left;"></div>'+
  '        <div class="btn_node_direction" style="float: right;">&nbsp;&nbsp;&nbsp;►</div>'+
  '        <div class="btn_node_predicate" style="float: right;"></div>'+
  '      </div>'+
  '      <div class="clear">&nbsp;</div>'+  
  '      <div class="btn_node_code" style="float: left;"></div>'+
  '      <div class="btn_node_more" style="float: right;">&nbsp;+&nbsp;show more</div>'+
  '      <div class="clear">&nbsp;</div>'+  
  '      <div class="list_node_detail" style="display:none;">'+
  '        <span class="btn_node_description"></span>'+
  '        </br>'+
  '        <span class="btn_node_definition"></span>'+
  '      </div>'+  
  '      <div class="clear">&nbsp;</div>'+
  '    </li>'+
  '  </div>'+
  '</div>'+
  
  '<!-- NODE RESULT PARTIAL LAYOUT RIGHT -->'+
  '<div id="node_button_right" style="display: none;">'+
  '  <div class="node_record">'+
  '    <li class="dontshow">'+
  '      <div class="btn_node">'+
  '        <div class="btn_node_name" style="float: right; text-align: right;"></div>'+
  '        <div class="btn_node_direction" style="float: left;">►&nbsp;&nbsp;&nbsp;</div>'+
  '        <div class="btn_node_predicate" style="float: left;"></div>'+
  '      </div>'+
  '      <div class="clear">&nbsp;</div>'+  
  '      <div class="btn_node_code" style="float: right;"></div>'+
  '      <div class="btn_node_more" style="float: left;">&nbsp;+&nbsp;show more</div>'+
  '      <div class="clear">&nbsp;</div>'+  
  '      <div class="list_node_detail" style="display:none;">'+
  '        <span class="btn_node_description"></span>'+
  '        </br>'+
  '        <span class="btn_node_definition"></span>'+
  '      </div>'+
  '      <div class="clear">&nbsp;</div>'+
  '    </li>'+
  '  </div>'+
  '</div>'+
  
  '<!-- NODE NAV BOTTOM PARTIAL LAYOUT RIGHT -->'+
  '<div id="nav_bottom_button_left" style="display: none;">'+
  '  <div class="node_record">'+
  '    <li><a rel="tooltip" href="#"></a> <span class="divider"></span></li>'+
  '  </div>'+
  '</div>'+
  
  '<!-- NODE NAV BOTTOM PARTIAL LAYOUT LEFT -->'+
  '<div id="nav_bottom_button_right" style="display: none;">'+
  '  <div class="node_record">'+
  '    <li><span class="divider"></span> <a rel="tooltip" href="#"></a></li>'+
  '  </div>'+
  '</div>'+
  
  '<!-- NODE NAV TOP PARTIAL LAYOUT RIGHT -->'+
  '<div id="nav_top_button" style="display: none;">'+
  '  <div class="node_record">'+
  '    <li><a href="#"></a></li>'+
  '  </div>'+
  '</div>'+
  
  '<!-- NODE DETAIL PARTIAL LAYOUT -->'+
  '<div id="node_details_layout" style="display: none;">'+
  '  <div class="node_record" style="clear: both;">'+
  '    <li class="node_detail"><label></label><span></span></li>'+
  '  </div>'+
  '</div>'+
  
  '<!-- NODE DETAIL PARTIAL LAYOUT PAGER -->'+
  '<div id="node_pager_layout" style="display: none;">'+
  '  <div class="node_record" style="clear: both;">'+
  '    <span class="first_page"><<</span> <span class="prev_page"><</span> page <input type="text" value="" /> of <span class="total_page"></span> <span class="next_page">></span> <span class="last_page">>></span>'+
  '  </div>'+
  '</div>';
}


//--------ASYNC REQUEST


/**
 * this method make the server request and manage the response
 * @param string url
 * @param string callback
 *
 * @returns Array data
 */
function ask(url, callback){
  jQuery.ajax({
      url:url
  }).done(function(data) {
    if(data === null){
      console.log('error, the request is null');
      return false;
    }
    else{
      setBasicValue(url, data);
      if(callback){
        callback();
      }
      else{
        return selected_node_data;
      }
      return false;
    }
  }).fail(function() { 
    console.log('error, the request url was not found');
    return false;
  });
}

/**
 * this method set the basic value for pager and basic node data
 * @param string url
 * @param Array data *
 */
function setBasicValue(url, data){
  json_data= $.parseJSON(data);
  selected_node_data= json_data[':WS:RESPONSE'];
  pager_node_data_limit= json_data[':WS:PAGING'][':WS:PAGE-LIMIT'];
  pager_node_data_selected= json_data[':WS:PAGING'][':WS:PAGE-START'];
  
  if(url == dev_env+urlForNodeRelationIN+'/'+selected_node_id){
    pager_node_data_in_count= json_data[':WS:STATUS'][':WS:AFFECTED-COUNT'];
  }
  if(url == dev_env+urlForNodeRelationOUT+'/'+selected_node_id){
    pager_node_data_out_count= json_data[':WS:STATUS'][':WS:AFFECTED-COUNT'];
  }
}