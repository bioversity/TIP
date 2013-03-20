/**
 *	Slider configurator file for node creation.
 *
 *	There you can find the primary bind method an relations request method
 *
 *	@package	ontology slider
 *
 *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
 *	@version	1.00
 */

function hideAddNodeButton()
{
  $('.'+slider_destination_form_action).hide();
}

function attachNodeCreationButton()
{
  var html= '<div class="form-actions">'+
            '<a class="btn btn-info" href="#" onclick="javascript: createNewNode();">New Root</a>'+
            '</div>';
  $('#'+ontology_root_node_list).append(html);
}

function createNewNode()
{
  setActualAction('newroot');
  createTerm();
}

function setActualAction(action)
{
  form_action= action;
}