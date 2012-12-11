

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
  '.pager .first_page:hover,'+
  '.pager .prev_page:hover,'+
  '.pager .next_page:hover,'+
  '.pager .last_page:hover{'+
  '  cursor: pointer;'+
  '  font-weight: bold;'+
  '}'+
  '.nav_open{'+
  '  font-weight: bold;'+
  '}'+
  '</style>';
}