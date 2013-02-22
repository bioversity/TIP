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

var $show_action= true;
var $slider_destination_form_action= 'action_form';

$(document).ready(function(){
    showFormAction();
});