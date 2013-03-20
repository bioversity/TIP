/**
 *	Global plugin setup file for node creation.
 *
 *	This file set the global var for the plugin
 *	You can customize the slider changing the html class name of the single elment
 *
 *	@package	ontology slider
 *
 *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
 *	@version	1.00
 */

var form_action;
var show_action= false;
var slider_destination_form_action= 'action_form';
var ontology_root_node_list= 'entry_point .root_node_menu';
var ontology_selected_node_relation;
var ontology_selected_node_object;
var ontology_selected_node_subject;
var ontology_selected_node_predicate;

$(document).ready(function(){
    //hideAddNodeButton();
    //showFormAction();
    attachNodeCreationButton();
    bindRootNode();
    bindFoundNode();
});