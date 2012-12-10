

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