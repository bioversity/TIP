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
  var button= $('#'+$slider_destination_breadcrumb_history_container_button);
  button.click(function(){
    if(button.attr('class')=='dontshow'){
      $('#'+$slider_destination_breadcrumb_history).slideDown('slow');
      button.val('Hide History');
      button.attr('class','show');
      button.addClass('nav_open');
    }else{
      $('#'+$slider_destination_breadcrumb_history).slideUp('slow');
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
  $('#'+$slider_destination_breadcrumb+' ul#'+'nav_story_'+$slider_destination_breadcrumb_ul+' li').remove();
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
    setPositionLayout($bottom_menu_layout_left_id);
  else
    setPositionLayout($bottom_menu_layout_right_id);
  
  resetNavActiveElement();
  checkNavElement();
}

function resetNavActiveElement()
{
  //console.log('resetNavActiveElement');
  selected_nav_node_active= $('#'+$slider_destination_breadcrumb+' ul li a.active').attr('id');
  $('#'+$slider_destination_breadcrumb+' ul li a.active').removeClass('active');
}

function checkNavElement()
{
  //console.log('checkNavElement');
  elemnt_list= $('#'+$slider_destination_breadcrumb+' ul.breadcrumb li').length;
  if(elemnt_list > 0){
    $('#'+$slider_destination_breadcrumb+' ul.breadcrumb li a').each(function(){
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
  $('#'+$slider_destination_breadcrumb).append('<ul id="nav_story_'+selected_node_id+'" class="breadcrumb"></ul>');
  $slider_destination_breadcrumb_ul= selected_node_id;
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
    $('#'+$slider_destination_breadcrumb+' ul#'+'nav_story_'+$slider_destination_breadcrumb_ul).append($('#'+position_layout).html());
  }else{
    $('#'+$slider_destination_breadcrumb+' ul#'+'nav_story_'+$slider_destination_breadcrumb_ul).prepend($('#'+position_layout).html());
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
  if($('#'+$slider_destination_breadcrumb+' ul#'+'nav_story_'+$slider_destination_breadcrumb_ul+' li').length > 0){
    var history_nav= $('#'+$slider_destination_breadcrumb+' ul#'+'nav_story_'+$slider_destination_breadcrumb_ul).clone();
    history_nav.removeAttr('id');
    $('#'+$slider_destination_breadcrumb_history).prepend(history_nav);
    
    last_history= $('#'+$slider_destination_breadcrumb_history+' ul').first();
    last_history.find('li').each(function(){
      $(this).addClass('child');
      var action= $(this).find('a').attr('onclick');
      var new_action= action.replace("startBind","startNav");
      $(this).find('a').attr('onclick', new_action);
    });
  }
}
/**
 * Node Class
 * 
 */

var selected_node_data;
var selected_node_name;
var selected_node_code;
var selected_node_id;
var selected_node_description;
var selected_node_predicate;
var selected_node_show_predicate= false;
var selected_node_code_local;
var selected_node_class;
var selected_node_direction;

function setNodeProperty(node_detail)
{
  //console.log('setNodeProperty');
  selected_node_name        = getNodeName(node_detail);
  selected_node_code        = getNodeCode(node_detail);
  selected_node_code_local  = getNodeLocalCode(node_detail);
  selected_node_description = getNodeDescription(node_detail);
  selected_node_class       = getNodeClass(node_detail);
  selected_node_kind        = getNodeKind(node_detail);
}

function getRootNodeList()
{
  //console.log('getRootNodeList');
  ask($dev_env+$urlForRootNodes, generateRootMenu);
}

function getNodeById()
{
  //console.log('getNodeById');
  ask($dev_env+$urlForNodeDetails+'/'+selected_node_id, initializeNode);
}

function getNodeRelationINById(page)
{
  //console.log('getNodeRelationINById');
  ask($dev_env+$urlForNodeRelationIN+'/'+selected_node_id+ (page ? '/'+page: ''), generateNodeRelationIN);
}

function getNodeRelationOUTById(page)
{
  //console.log('getNodeRelationOUTById');
  ask($dev_env+$urlForNodeRelationOUT+'/'+selected_node_id+ (page ? '/'+page: ''), generateNodeRelationOUT);
}

function searchNodeRelationINById(term)
{
  //console.log('searchNodeRelationINById');
  ask($dev_env+$urlForSearchNodeRelationIN+'/'+selected_node_id+ (term ? '/'+term: ''), generateNodeRelationIN);
}

function searchNodeRelationOUTById(term)
{
  //console.log('searchNodeRelationOUTById');
  ask($dev_env+$urlForSearchNodeRelationOUT+'/'+selected_node_id+ (term ? '/'+term: ''), generateNodeRelationOUT);
}

function getNodeName(node)
{
  //console.log('getNodeName');
  return (node[kTAG_LABEL] !== undefined)? node[kTAG_LABEL]['en']: '';
}

function getNodeId(node)
{
  //console.log('getNodeId');
  return node['_id'];
}

function getNodeTerm(node)
{
  //console.log('getNodeTerm');
  return (node[kTAG_TERM] !== undefined)? node[kTAG_TERM]: '';
}

function getNodeCode(node)
{
  //console.log('getNodeCode');
  return (node[kTAG_GID] !== undefined)? node[kTAG_GID]: '';
}

function getNodeLocalCode(node)
{
  //console.log('getNodeLocalCode');
  return (node[kTAG_LID] !== undefined)? node[kTAG_LID]: '';
}

function getNodeClass(node)
{
  //console.log('getNodeClass');
  return (node[kTAG_CLASS] !== undefined)? node[kTAG_CLASS]: '';
}

function getNodeImage(node)
{
  //console.log('getNodeImage');
  return '/bundles/bioversityontology/images/slider/default.png';
}

function getNodeDescription(node)
{
  //console.log('getNodeDescription');
  return (node[kTAG_DESCRIPTION] !== undefined)? node[kTAG_DESCRIPTION]['en']: '';
}

function getNodePredicate(edge)
{
  //console.log('getNodePredicate');
  return (selected_node_data._term[edge[kTAG_PREDICATE]] !== undefined)?
            selected_node_data._term[edge[kTAG_PREDICATE]][kTAG_LABEL]['en']: '';
}

function getNodeDefinition(node)
{
  //console.log('getNodeDefinition');
  return (node[kTAG_DEFINITION] !== undefined)? node[kTAG_DEFINITION]['en']: '';
}

function getNodeKind(node)
{
  //console.log('getNodeKind');
  return (node[kTAG_KIND] !== undefined)? node[kTAG_KIND]: '';
}

function findNodePredicate(nodeId)
{
  //console.log('findNodePredicate');
  var predicate= null;
  //var pattReverter=new RegExp(" reverter");
  
  if(selected_node_data._edge[key][kTAG_VERTEX_OBJECT] == selected_node_id){
    setAppendDirection('right');
    predicate= getNodePredicate(value);
  }else if(selected_node_data._edge[key][kTAG_VERTEX_SUBJECT] == selected_node_id){
    setAppendDirection('left');
    predicate= getNodePredicate(value);
  }
  
  return predicate;
}

function setNodePredicate(predicate)
{
  //console.log('setNodePredicate');
  selected_node_predicate= predicate;
}

function setNodeId(node_id)
{
  //console.log('setNodeId');
  selected_node_id= node_id;
}

function isRoot(node)
{
  //console.log('isRoot');
  if(node[kTAG_DESCRIPTION][0] == ":ROOT")
    return true;
  else
    return false;
}
/*=======================================================================================
 *																						*
 *									Tags.inc.js											*
 *																						*
 *======================================================================================*/
 
/**
 * Default attribute tags.
 *
 * This file contains the tag definitions for all default attributes, these tags are used
 * as the object's attribute keys and are related to the default attribute terms.
 *
 * <ul>
 *	<li><i>Identification attributes</i>: These attributes are used to identify objects:
 *	 <ul>
 *		<li><tt>{@link kTAG_NID}</tt>: <i>Native identifier</i>. This attribute contains the
 *			native unique identifier of the object. This identifier is used as the default
 *			unique key for all objects and can have any scalar data type. 
 *		<li><tt>{@link kTAG_LID}</tt>: <i>Local identifier</i>. This attribute contains the
 *			local unique identifier. This value represents the value that uniquely
 *			identifies an object within a specific domain or namespace. It is by definition
 *			a string constituting the suffix of the global identifier, {@link kTAG_GID}. 
 *		<li><tt>{@link kTAG_GID}</tt>: <i>Global identifier</i>. This attribute contains
 *			the global unique identifier. This value represents the value that uniquely
 *			identifies the object across domains and namespaces. This value is by definition
 *			a string and will generally constitute the object's primary key
 *			({@link kTAG_NID}) in full or hashed form. 
 *		<li><tt>{@link kTAG_UID}</tt>: <i>Unique identifier</i>. This attribute contains
 *			the hashed unique identifier of an object in which its {@link kTAG_NID} is not
 *			related to the {@link kTAG_GID}. This is generally used when the
 *			{@link kTAG_NID} is a sequence number.
 *		<li><tt>{@link kTAG_SYNONYMS}</tt>: <i>Synonyms</i>. This attribute contains a list
 *			of strings that represent alternate identifiers for the hosting object.
 *			Synonyms do not have any relation to the namespace.
 *	 </ul>
 *	<li><i>Classification attributes</i>: These attributes are used to classify objects:
 *	 <ul>
 *		<li><tt>{@link kTAG_CATEGORY}</tt>: <i>Category</i>. This attribute is an
 *			enumerated set that contains all the categories to which the hosting object
 *			belongs to. 
 *		<li><tt>{@link kTAG_KIND}</tt>: <i>Kind</i>. This attribute is an enumerated set
 *			that defines the kind of the hosting object. 
 *		<li><tt>{@link kTAG_TYPE}</tt>: <i>Type</i>. This attribute is an enumerated set
 *			that contains a combination of data type and cardinality indicators which,
 *			combined, represet the data type of the hosting object.
 *		<li><tt>{@link kTAG_CLASS}</tt>: <i>Class</i>. This attribute is a string that
 *			represets the referenced object's class. This attribute is used to instantiate
 *			the correct class once an object has been retrieved from its container.
 *		<li><tt>{@link kTAG_NAMESPACE}</tt>: <i>Namespace</i>. This attribute is a
 *			reference to a term which represents the namespace of the current object. The
 *			object local identifiers must be unique within the scope of the namespace.
 *	 </ul>
 *	<li><i>Description attributes</i>: These attributes are used to describe objects:
 *	 <ul>
 *		<li><tt>{@link kTAG_LABEL}</tt>: <i>Label</i>. This attribute represents the label,
 *			name or short description of the referenced object. It is a
 *			{@link kTYPE_LSTRING} structure in which the label can be expressed in several
 *			languages. 
 *		<li><tt>{@link kTAG_DEFINITION}</tt>: <i>Definition</i>. This attribute
 *			represents the definition of the referenced object. It is an
 *			{@link kTYPE_LSTRING} structure in which the definition can be expressed in
 *			several languages. A definition is independent of the context.
 *		<li><tt>{@link kTAG_DESCRIPTION}</tt>: <i>Description</i>. This attribute
 *			represents the description of the referenced object. It is an
 *			{@link kTYPE_LSTRING} structure in which the description can be expressed in
 *			several languages. A description depends on the context.
 *		<li><tt>{@link kTAG_NOTES}</tt>: <i>Notes</i>. This attribute represents the notes
 *			or comments of the referenced object. It is a {@link kTYPE_LSTRING} structure in
 *			which the description can be expressed in several languages. 
 *		<li><tt>{@link kTAG_EXAMPLES}</tt>: <i>Examples</i>. This attribute represents the
 *			examples or templates of the referenced object. It is a list of strings where
 *			each string represents an example or template. 
 *	 </ul>
 *	<li><i>Authorship attributes</i>: These attributes are used to describe authorship:
 *	 <ul>
 *		<li><tt>{@link kTAG_AUTHORS}</tt>: <i>Authors</i>. This attribute represents a list
 *			of authors, it is an array of author names.
 *		<li><tt>{@link kTAG_ACKNOWLEDGMENTS}</tt>: <i>Acknowledgments</i>. This attribute
 *			represents a list of generic acknowledgments, it is an array of strings.
 *		<li><tt>{@link kTAG_BIBLIOGRAPHY}</tt>: <i>Bibliography</i>. This attribute
 *			represents a list of bibliographic references, it is an array of strings.
 *	 </ul>
 *	<li><i>Reference attributes</i>: These attributes are used to reference other objects
 *		and contain the native identifier of the referenced object:
 *	 <ul>
 *		<li><tt>{@link kTAG_TERM}</tt>: <i>Term</i>. This attribute contains a reference to
 *			an object that represents the term of the attribute host.
 *		<li><tt>{@link kTAG_NODE}</tt>: <i>Node</i>. This attribute contains a reference to
 *			an object that represents the node of the attribute host.
 *		<li><tt>{@link kTAG_SUBJECT}</tt>: <i>Subject</i>. This attribute contains a
 *			reference to an object that represents the start, origin or subject vertex of a
 *			<tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *		<li><tt>{@link kTAG_OBJECT}</tt>: <i>Object</i>. This attribute contains a
 *			reference to an object that represents the end, destination or object vertex of
 *			a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *		<li><tt>{@link kTAG_PREDICATE}</tt>: <i>Predicate</i>. This attribute contains a
 *			reference to an object that represents the predicate term of a
 *			<tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *		<li><tt>{@link kTAG_PATH}</tt>: <i>Path</i>. This attribute represents a sequence
 *			of <tt>vertex</tt>, <tt>predicate</tt>, <tt>vertex</tt> elements whose
 *			concatenation represents a path between an origin vertex and a destination
 *			vertex.
 *	 </ul>
 *	<li><i>Reference collections</i>: These attributes are used as collections of references
 *		to other objects and contain a list whose elements are the native identifier of the
 *		referenced object:
 *	 <ul>
 *		<li><tt>{@link kTAG_NAMESPACE_REFS}</tt>: <i>Namespace references count</i>. This
 *			integer attribute counts how many times external objects have referenced the
 *			current one as a namespace.
 *		<li><tt>{@link kTAG_NODES}</tt>: <i>Nodes</i>. This attribute is a collection of
 *			node references, it is an array of node object native identifiers who reference
 *			the current object.
 *		<li><tt>{@link kTAG_EDGES}</tt>: <i>Edges</i>. This attribute is a collection of
 *			edge references, it is an array of edge object native identifiers who reference
 *			the current object.
 *		<li><tt>{@link kTAG_FEATURES}</tt>: <i>Features</i>. This attribute is a collection
 *			of feature references, it is an array of object native identifiers that
 *			reference the current object as a feature or trait.
 *		<li><tt>{@link kTAG_METHODS}</tt>: <i>Methods</i>. This attribute is a collection
 *			of method references, it is an array of object native identifiers that
 *			reference the current object as a method or modifier.
 *		<li><tt>{@link kTAG_SCALES}</tt>: <i>Scales</i>. This attribute is a collection
 *			of scale references, it is an array of object native identifiers that
 *			reference the current object as a scale or unit.
 *	 </ul>
 *	<li><i>Local tags</i>: This set of tags is local and is managed internally:
 *	 <ul>
 *		<li><i>Custom type sub-attributes</i>: These attributes are used by the standard
 *			data type structures for recording the type and value:
 *		 <ul>
 *			<li><tt>{@link kTAG_CUSTOM_TYPE}</tt>: <i>Custom data object type</i>. This tag
 *				is used as the default offset for indicating a custom data type, in general
 *				it is used in a structure in conjunction with the {@link kTAG_CUSTOM_DATA}
 *				offset to indicate the data type of the item.
 *			<li><tt>{@link kTAG_CUSTOM_DATA}</tt>: <i>Custom data object data</i>. This tag
 *				is used as the default offset for indicating a custom data type content, in
 *				general this tag is used in conjunction with the {@link kTAG_CUSTOM_TYPE} to
 *				wrap a custom data type in a standard structure.
 *		 </ul>
 *		<li><i>Custom timestamp sub-attributes</i>: These attributes are used by the
 *			standard data type structures for recording sub-elements of time-stamps:
 *		 <ul>
 *			<li><tt>{@link kTAG_STAMP_SEC}</tt>: <i>Seconds</i>. This tag defines the number
 *				of seconds since January 1st, 1970.
 *			<li><tt>{@link kTAG_STAMP_USEC}</tt>: <i>Microseconds</i>. This tag defines
 *				microseconds.
 *		 </ul>
 *	 </ul>
 * </ul>
 *
 *	@package	MyWrapper
 *	@subpackage	Definitions
 *
 *	@author		Milko A. Škofič <m.skofic@cgiar.org>
 *	@version	1.00 25/11/2012
 */

/*=======================================================================================
 *	IDENTIFICATION ATTRIBUTES															*
 *======================================================================================*/

/**
 * _id.
 *
 * Native identifier.
 *
 * This attribute contains the native unique identifier of the object. This identifier is
 * used as the default unique key for all objects and can have any scalar data type.
 *
 * Version 1: (kOFFSET_NID)[_id]
 */
var kTAG_NID=							'_id';

/**
 * LID.
 *
 * Local identifier.
 *
 * This attribute contains the local unique identifier. This value represents the value that
 * uniquely identifies an object within a specific domain or namespace. It is by definition
 * a string constituting the suffix of the global identifier, {@link kTAG_GID}.
 *
 * Version 1: (kTAG_LID)[1]
 */
var kTAG_LID=								'1';

/**
 * GID.
 *
 * Global identifier.
 *
 * This attribute contains the global unique identifier. This value represents the value
 * that uniquely identifies the object across domains and namespaces. This value is by
 * definition a string and will generally constitute the object's primary key
 * ({@link kTAG_NID}) in full or hashed form.
 *
 * Version 1: (kTAG_GID)[2]
 */
var kTAG_GID=								'2';

/**
 * UID.
 *
 * Unique identifier.
 *
 * This attribute contains the hashed unique identifier of an object in which its
 * {@link kTAG_NID} is not related to the {@link kTAG_GID}. This is generally used when
 * the {@link kTAG_NID} is a sequence number.
 *
 * Version 1: (kTAG_UID)[21]
 */
var kTAG_UID=								'3';

/**
 * SYNONYMS.
 *
 * Synonyms.
 *
 * This attribute contains a list of strings that represent alternate identifiers for the
 * hosting object. Synonyms do not have any relation to the namespace.
 *
 * Version 1: (kTAG_SYNONYMS)[7]
 */
var kTAG_SYNONYMS=							'4';

/*=======================================================================================
 *	CLASSIFICATION ATTRIBUTES															*
 *======================================================================================*/

/**
 * CATEGORY.
 *
 * Category.
 *
 * This attribute is an enumerated set that contains all the categories to which the hosting
 * object belongs to.
 *
 * Version 1: (kTAG_CATEGORY)[12]
 */
var kTAG_CATEGORY=							'5';

/**
 * KIND.
 *
 * Kind.
 *
 * This attribute is an enumerated set that defines the kind of the hosting object.
 *
 * Version 1: (kTAG_KIND)[13]
 */
var kTAG_KIND=								'6';

/**
 * TYPE.
 *
 * Type.
 *
 * This attribute is an enumerated set that contains a combination of data type and
 * cardinality indicators which, combined, represet the data type of the hosting object.
 *
 * Version 1: (kTAG_TYPE)[14]
 */
var kTAG_TYPE=								'7';

/**
 * CLASS.
 *
 * Class.
 *
 * This attribute is a string that represets the referenced object's class. This attribute
 * is used to instantiate the correct class once an object has been retrieved from its
 * container.
 *
 * Version 1: (kTAG_CLASS)[4]
 */
var kTAG_CLASS=								'8';

/**
 * NAMESPACE.
 *
 * Namespace.
 *
 * This attribute is a reference to a term which represents the namespace of the current
 * object. The object local identifiers must be unique within the scope of the namespace.
 *
 * Version 1: (kTAG_NAMESPACE)[3]
 */
var kTAG_NAMESPACE=							'9';

/*=======================================================================================
 *	DESCRIPTION ATTRIBUTES																*
 *======================================================================================*/

/**
 * LABEL.
 *
 * Label.
 *
 * This attribute represents the label, name or short description of the referenced object.
 * It is a {@link kTYPE_LSTRING} structure in which the label can be expressed in several
 * languages.
 *
 * Version 1: (kTAG_LABEL)[5]
 */
var kTAG_LABEL=								'10';

/**
 * DEFINITION.
 *
 * Definition.
 *
 * This attribute represents the definition of the referenced object. It is an
 * {@link kTYPE_LSTRING} structure in which the definition can be expressed in several
 + languages. A definition is independent of the context.
 *
 * Version 1: (kTAG_DEFINITION)[??]
 */
var kTAG_DEFINITION=							'11';

/**
 * DESCRIPTION.
 *
 * Description.
 *
 * This attribute represents the description of the referenced object. It is an
 * {@link kTYPE_LSTRING} structure in which the description can be expressed in several
 * languages. A description depends on the context.
 *
 * Version 1: (kTAG_DESCRIPTION)[6]
 */
var kTAG_DESCRIPTION=						'12';

/**
 * NOTES.
 *
 * Notes.
 *
 * This attribute represents the notes or comments of the referenced object.
 * It is a {@link kTYPE_LSTRING} structure in which the description can be expressed in
 * several languages.
 *
 * Version 1: (kTAG_NOTES)[25]
 */
var kTAG_NOTES=								'13';

/**
 * EXAMPLES.
 *
 * Examples.
 *
 * This attribute represents the examples or templates of the referenced object.
 * It is a list of strings where each string represents an example or template.
 *
 * Version 1: (kTAG_EXAMPLES)[28]
 */
var kTAG_EXAMPLES=							'14';

/*=======================================================================================
 *	AUTHORSHIP ATTRIBUTES																*
 *======================================================================================*/

/**
 * AUTHORS.
 *
 * Authors.
 *
 * This attribute represents a list of authors, it is an array of author names.
 *
 * Version 1: (kTAG_AUTHORS)[24]
 */
var kTAG_AUTHORS=							'15';

/**
 * ACKNOWLEDGMENTS.
 *
 * Acknowledgments.
 *
 * This attribute represents a list of generic acknowledgments, it is an array of strings.
 *
 * Version 1: (kTAG_ACKNOWLEDGMENTS)[26]
 */
var kTAG_ACKNOWLEDGMENTS=					'16';

/**
 * BIBLIOGRAPHY.
 *
 * Bibliography.
 *
 * This attribute represents a list of bibliographic references, it is an array of strings.
 *
 * Version 1: (kTAG_BIBLIOGRAPHY)[27]
 */
var kTAG_BIBLIOGRAPHY=						'17';

/*=======================================================================================
 *	REFERENCE ATTRIBUTES																*
 *======================================================================================*/

/**
 * TERM.
 *
 * Term.
 *
 * This attribute contains a reference to an object that represents the term of the
 * attribute host.
 *
 * Version 1: (kTAG_TERM)[8]
 */
var kTAG_TERM=								'18';

/**
 * NODE.
 *
 * Node.
 *
 * This attribute contains a reference to an object that represents the master node of the
 * attribute host.
 *
 * Version 1: (kTAG_NODE)[??]
 */
var kTAG_NODE=								'19';

/**
 * SUBJECT.
 *
 * Subject.
 *
 * This attribute contains a reference to an object that represents the start, origin or
 * subject vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *
 * Version 1: (kTAG_VERTEX_SUBJECT)[18]
 */
var kTAG_SUBJECT=							'20';

/**
 * kTAG_OBJECT.
 *
 * Object.
 *
 * This attribute contains a reference to an object that represents the end, destination or
 * object vertex of a <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *
 * Version 1: (kTAG_VERTEX_OBJECT)[20]
 */
var kTAG_OBJECT=								'21';

/**
 * PREDICATE.
 *
 * Predicate.
 *
 * This attribute contains a reference to an object that represents the predicate term of a
 * <tt>subject</tt>/<tt>predicate</tt>/<tt>object</tt> relationship.
 *
 * Version 1: (kTAG_PREDICATE)[19]
 */
var kTAG_PREDICATE=							'22';

/**
 * PATH.
 *
 * Path.
 *
 * This attribute represents a sequence of <tt>vertex</tt>, <tt>predicate</tt>,
 * <tt>vertex</tt> elements whose concatenation represents a path between an origin vertex
 * and a destination vertex.
 *
 * Version 1: (kTAG_TAG_PATH)[22]
 */
var kTAG_PATH=								'23';

/*=======================================================================================
 *	REFERENCE COLLECTIONS																*
 *======================================================================================*/

/**
 * NAMESPACE-REFS.
 *
 * Namespace references count.
 *
 * This integer attribute counts how many times external objects have referenced the current
 * one as a namespace.
 *
 * Version 1: (kTAG_REFS_NAMESPACE)[9]
 */
var kTAG_NAMESPACE_REFS=						'24';

/**
 * NODES.
 *
 * Nodes.
 *
 * This attribute is a collection of node references, it is an array of node object native
 * identifiers who reference the current object.
 *
 * Version 1: (kTAG_REFS_NODE)[10]
 */
var kTAG_NODES=								'25';

/**
 * EDGES.
 *
 * Edges.
 *
 * This attribute is a collection of edge references, it is an array of edge object native
 * identifiers who reference the current object.
 *
 * Version 1: (kTAG_REFS_EDGE)[17]
 */
var kTAG_EDGES=								'26';

/**
 * FEATURES.
 *
 * Features.
 *
 * This attribute is a collection of feature references, it is an array of object native
 * identifiers that reference the current object as a feature or trait.
 *
 * Version 1: (kTAG_REFS_TAG_FEATURE)[15]
 */
var kTAG_FEATURES=							'27';

/**
 * METHODS.
 *
 * Methods.
 *
 * This attribute is a collection of method references, it is an array of object native
 * identifiers that reference the current object as a method or modifier.
 *
 * Version 1: (kTAG_REFS_TAG_METHOD)[??]
 */
var kTAG_METHODS=							'28';

/**
 * SCALES.
 *
 * Scales.
 *
 * This attribute is a collection of scale references, it is an array of object native
 * identifiers that reference the current object as a scale or unit.
 *
 * Version 1: (kTAG_REFS_TAG_SCALE)[16]
 */
var kTAG_SCALES=								'29';
/**
 * Pager
 *
 */

var $pager_node_data_limit;
var $pager_node_data_in_count;
var $pager_node_data_out_count;
var $pager_node_data_selected;

function createPager(request_result, destination)
{
  //console.log('createPager');
  var pages= getPageNumber(request_result);
  if(pages > 0){
    $('#'+$slider_pager_layout_id+' .node_record .total_page').html(pages);
    
    $('#'+$slider_pager_layout_id+' .node_record input').attr('value', $pager_node_data_selected);
    $('#'+$slider_pager_layout_id+' .node_record input').attr('onChange', 'javascript: startPager(this.value,\''+destination+'\');');
    
    if(($pager_node_data_selected) > 1){
      $('#'+$slider_pager_layout_id+' .node_record .first_page').attr('onclick', 'javascript: startPager(1,\''+destination+'\');');
      $('#'+$slider_pager_layout_id+' .node_record   .prev_page').attr('onclick', 'javascript: startPager('+($pager_node_data_selected-1)+',\''+destination+'\');');
    }
    if(($pager_node_data_selected) < pages){
      $('#'+$slider_pager_layout_id+' .node_record .last_page').attr('onclick', 'javascript: startPager('+(pages)+',\''+destination+'\');');
      $('#'+$slider_pager_layout_id+' .node_record   .next_page').attr('onclick', 'javascript: startPager('+($pager_node_data_selected+1)+',\''+destination+'\');');
    }
    
    $('#'+destination+' .'+$slider_destination_pager).append($('#'+$slider_pager_layout_id+' .node_record').html());
  }
}

function startPager(page, destination)
{
  //console.log('startPager');
  resetPager();
  if(destination == $slider_destination_left){
    resetLeft();
    getNodeRelationPagerINById(page-1);
  }
  else{
    resetRight();
    getNodeRelationPagerOUTById(page-1);
  }
}

function getPageNumber(request_result)
{
  //console.log('getPageNumber');
  return Math.ceil(request_result/$pager_node_data_limit);
}

function resetPager()
{
  //console.log('resetPager');
  $('.'+$slider_destination_pager).html(' ');
  $('#'+$slider_pager_layout_id+' .node_record .first_page').removeAttr('onclick');
  $('#'+$slider_pager_layout_id+' .node_record   .prev_page').removeAttr('onclick');
  $('#'+$slider_pager_layout_id+' .node_record .last_page').removeAttr('onclick');
  $('#'+$slider_pager_layout_id+' .node_record   .next_page').removeAttr('onclick');
}

function getNodeRelationPagerINById(page)
{
  //console.log('getRootNodeList');
  ask($dev_env+$urlForNodeRelationPagerIN+'/'+selected_node_id+ '/'+page, generateNodeRelationIN);
}

function getNodeRelationPagerOUTById(page)
{
  //console.log('getNodeRelationPagerOUTById');
  ask($dev_env+$urlForNodeRelationPagerOUT+'/'+selected_node_id+ '/'+page, generateNodeRelationOUT);
}


/**
 * this method create the html container
 *
 */
function createContainer(){
  $slider_container_layout=
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
  '    <div><input type="text" id="search_left" class="search_filter" name="search_left" placeholder="search node" style="display: none;"/></div>'+
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
  '    <div><input type="text" id="search_right" class="search_filter" name="search_right" placeholder="search node" style="display: none;"/></div>'+
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
  $slider_menu_layout=
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
  $slider_breadcrumb_layout=
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
  $slider_breadcrumb_history_layout=
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
  $slider_partials_layout=
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
/**
 * Search
 *
 */

var $start_search_bind= true;
var $show_search_filter= true;

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

var $$slider_destination_content= 'slider';
var $$slider_destination_root= 'entry_point ul.nav';
var $slider_destination_right= 'node_childrens';
var $slider_destination_left= 'node_parents';
var $slider_destination_center= 'node_details #node_details_container_body';
var $slider_destination_center_header= 'node_details #node_details_container_header';
var $slider_destination_pager= 'pager';
var $slider_destination_breadcrumb= 'breadcrumb';
var $slider_destination_breadcrumb_history= 'breadcrumb_history';
var $slider_destination_breadcrumb_history_container= 'history_container';
var $slider_destination_breadcrumb_history_container_button= 'history_button';
var $slider_destination_breadcrumb_ul= 'root';

var $show_pager=false;
var $slider_partials_layout;
var $slider_menu_layout;
var $slider_container_layout;
var $slider_breadcrumb_layout;
var $slider_css;
var $slider_breadcrumb_history_layout;

var $top_menu_layout_id= 'nav_top_button';
var $bottom_menu_layout_left_id= 'nav_bottom_button_left .node_record';
var $bottom_menu_layout_right_id= 'nav_bottom_button_right .node_record';
var $slider_right_layout_id= 'node_button_right';
var $slider_left_layout_id= 'node_button_left';
var $slider_center_layout_id= 'node_details_layout';
var $slider_pager_layout_id= 'node_pager_layout';

var $dev_env= '/app_dev.php';
var $urlForRootNodes= '/get-root-nodes';
var $urlForNodeDetails= '/get-node-details';
var $urlForNodeRelationIN= '/get-node-relation-in';
var $urlForNodeRelationOUT= '/get-node-relation-out';
var $urlForSearchNodeRelationIN= '/search-node-relation-in';
var $urlForSearchNodeRelationOUT= '/search-node-relation-out';
var $urlForNodeRelationPagerIN= '/get-node-relation-pager-in';
var $urlForNodeRelationPagerOUT= '/get-node-relation-pager-out';
var $urlForNodeRelations= '/get-node-relations';

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

/**
 * this method include on the slider container all html partial
 *
 */
function loadTemplates(){
  $('#slider_content').append($slider_css);
  $('#slider_content').append($slider_menu_layout);
  $('#slider_content').append($slider_breadcrumb_layout);
  $('#slider_content').append($slider_breadcrumb_history_layout);
  $('#slider_content').append($slider_container_layout);
  $('#slider_content').append($slider_partials_layout);
  initSlider();
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
  var pattIN=new RegExp($urlForNodeRelationIN);
  var pattOUT=new RegExp($urlForNodeRelationOUT);
  var pattSearchIN=new RegExp($urlForSearchNodeRelationIN);
  var pattSearchOUT=new RegExp($urlForSearchNodeRelationOUT);
  
  json_data= $.parseJSON(data);
  selected_node_data= json_data[':WS:RESPONSE'];
  $pager_node_data_limit= json_data[':WS:PAGING'][':WS:PAGE-LIMIT'];
  $pager_node_data_selected= parseInt(json_data[':WS:PAGING'][':WS:PAGE-START'])+1;
  
  $pager_node_data_in_count= 0;
  $pager_node_data_out_count= 0;
  $show_search_filter=false;
  $show_pager=false;
  
  if(pattIN.test(url) || pattSearchIN.test(url)){
    $pager_node_data_in_count= json_data[':WS:STATUS'][':WS:AFFECTED-COUNT'];
  }
  if(pattOUT.test(url) || pattSearchOUT.test(url)){
    $pager_node_data_out_count= json_data[':WS:STATUS'][':WS:AFFECTED-COUNT'];
  }
}


function createCss(){
  $slider_css=
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
/**
 *	Slider configurator file.
 *
 *	There you can find the primary bind method an relations request method
 *
 *	@package	ontology slider
 *
 *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
 *	@version	1.00
 */

function initSlider()
{
  //console.log('initSlider');
  getRootNodeList();
}

function generateRootMenu()
{
  //console.log('generateRootMenu');
  $.each(selected_node_data._ids, function(key, value){
    createNodeMenuButton(
      $top_menu_layout_id,
      getNodeName(selected_node_data._node[value]),
      getNodeCode(selected_node_data._node[value]),
      value
    );
  });
}

function startBind(button, predicate, direction)
{
  //console.log('startBind');
  setAppendDirection(direction);
  startButtonAnimation(button,predicate);
}

function startButtonAnimation(button, predicate)
{
  //console.log('startButtonAnimation');
  $('#row_'+button).effect("transfer", { to: $('#'+$slider_destination_center_header+' .btn_node') }, 300);
  startDetailAnimation(button, predicate);
}

function startDetailAnimation(button, predicate)
{
  //console.log('startDetailAnimation');
  $('#'+$slider_destination_center).fadeOut('slow');
  bindButton(button, predicate);
}

function bindButton(button, predicate)
{
  //console.log('bindButton');
  setNodeId(button);
  setNodePredicate(predicate);
  getNodeById();
}

function initializeNode()
{
  //console.log('initializeNode');
  $.each(selected_node_data._ids, function(key, value){
    if(value == selected_node_id){
      setNodeProperty(selected_node_data._node[value]);
      resetSlider();
      createNodeDetail();
      buildNav();
    }
  });
  initializeNodeRelations();
}

function initializeNodeRelations()
{
  //console.log('initializeNodeRelations');
  getNodeRelationINById();
  getNodeRelationOUTById();
}

function startButtonListAnimation()
{
  //console.log('startButtonListAnimation');
  $("ul.node_container li .btn_node_more").click(function() {
    var detail= $(this).parent();
    if(detail.attr('class')=='dontshow'){
      detail.find(".list_node_detail").slideDown('slow');
      detail.find(".btn_node_more").html(' - show less');
      detail.attr('class','show');
    }else{
      detail.find(".list_node_detail").slideUp('slow');
      detail.find(".btn_node_more").html(' + show more');
      detail.attr('class','dontshow');
    }
  });

}

function generateNodeRelationIN()
{
  //console.log('generateNodeRelationIN');
  if(selected_node_data){
    generateNodeRelations($slider_left_layout_id,$slider_destination_left);
  }
}

function generateNodeRelationOUT()
{
  //console.log('generateNodeRelationOUT');
  if(selected_node_data){
    generateNodeRelations($slider_right_layout_id,$slider_destination_right);
  }
}

function generateNodeRelations(layout, destination)
{
  //console.log('generateNodeRelations');
  var pager_count;
  
  $.each(selected_node_data._edge, function(key, value){
    if(value[kTAG_OBJECT] == selected_node_id){
      var node_id= value[kTAG_SUBJECT];
      var node_value= selected_node_data._node[node_id];
      select_node_direction='left';
      $show_pager=true;
      $show_search_filter= true;
      pager_count= $pager_node_data_in_count;
    }else if(value[kTAG_SUBJECT] == selected_node_id){
      var node_id= value[kTAG_OBJECT];
      var node_value= selected_node_data._node[node_id];
      select_node_direction='right';
      $show_pager=true;
      $show_search_filter= true;
      pager_count= $pager_node_data_out_count;
    }
    
    createNodeButton(
      layout,
      destination,
      getNodePredicate(value),
      getNodeName(node_value),
      getNodeCode(node_value),
      node_id,
      getNodeDescription(node_value),
      getNodeDefinition(node_value),
      getNodeKind(node_value),
      select_node_direction
    );
  });
  
  startButtonListAnimation();
  
  if($show_pager===true){
    createPager(pager_count, destination);
  }
  
  if($show_search_filter===true){
    if(pager_count > 5){
      showSearchFilter(destination);
    
      if($start_search_bind===true){
        startSearchBind();
        $start_search_bind=false;
      }
    }
  }
}

/**
 * This method group is used for reset the slider values
 *
 */
function resetSlider()
{
  //console.log('resetSlider');
  resetCenter();
  resetLeft();
  resetRight();
  resetPager();
  resetSearch();
}

function resetCenter()
{
  //console.log('resetCenter');
  $('#'+$slider_destination_center).html(' ');  
}

function resetLeft()
{
  //console.log('resetLeft');
  $('#'+$slider_destination_left+' ul').html(' ');  
}

function resetRight()
{
  //console.log('resetRight');
  $('#'+$slider_destination_right+' ul').html(' ');  
}

function resetSearch()
{
  $('.search_filter').fadeOut();
  $('.search_filter').val('');
}


/**
 * The following method are used to valorize the node data in the partials html slider
 *
 */
function createNodeMenuButton(layout, node_name, node_code, node_id)
{
  //console.log('createNodeMenuButton');
  $('#'+layout+' .node_record a').html(node_name);
  $('#'+layout+' .node_record a').attr('onclick', 'javascript: startNav('+node_id+');');
  $('#'+$$slider_destination_root).append($('#nav_top_button .node_record').html());
}

function createNodeButton(layout, destination, predicate, node_name, node_code, node_id,node_description,node_definition, node_kind, direction)
{
  //console.log('createNodeButton');
  $('#'+layout+' .node_record .btn_node_predicate').html(predicate);
  $('#'+layout+' .node_record .btn_node_code').html(node_code);
  $('#'+layout+' .node_record .btn_node_name').html(node_name);
  $('#'+layout+' .node_record .btn_node_description').html(node_description);
  $('#'+layout+' .node_record .btn_node_definition').html(node_definition);
  $('#'+layout+' .node_record li').attr('id', 'row_'+node_id);
  $('#'+layout+' .node_record li').attr('style', 'display:none;');
  $('#'+layout+' .node_record .btn_node').attr('onclick', 'javascript: startBind('+node_id+',\''+predicate+'\',\''+direction+'\');');
  
  if(node_kind !== ''){
    var added_class= '';
    $.each(node_kind, function(key, value){
      var html_class= value.replace(':', '');
      added_class += ' <span class="'+html_class+'" title=":'+html_class+'">■</span> ';
    });
    $('#'+layout+' .node_record .btn_node_code').html(node_code+added_class);
  }
    
  $('#'+destination+' ul.node_container').append($('#'+layout+' .node_record').html());
  $('#'+destination+' ul.node_container li').fadeIn('slow');
}

function createNodeDetail()
{
  //console.log('createNodeDetail');
  $.each(selected_node_data._node[selected_node_id], function(arrayID,arrayValue) {
    if(arrayID !== '_id'){
      var label= selected_node_data._term[selected_node_data._tag[arrayID][kTAG_PATH][0]][kTAG_LABEL]['en'];
      if(arrayID == kTAG_LABEL){
        createNodeHeaderName(arrayValue['en']);
      }else if(arrayID == kTAG_GID){
        createNodeHeaderCode(checkArray(arrayValue));
      }else{
        $('#'+$slider_center_layout_id+' .node_detail label' ).html(label);
        $('#'+$slider_center_layout_id+' .node_detail span' ).html(checkArray(arrayValue));
        $('#'+$slider_destination_center).append($('#'+$slider_center_layout_id).html());
        $('#'+$slider_center_layout_id+' .node_detail label' ).html('');
        $('#'+$slider_center_layout_id+' .node_detail span' ).html('');
      }
    }
  });
  
  $('#'+$slider_destination_center).fadeIn('slow');  
  $('#'+$slider_destination_center_header).fadeIn('slow');
}

function createNodeHeaderName(node_name)
{
  //console.log('createNodeHeaderName');
  $('#'+$slider_destination_center_header+' .btn_node_name').html(node_name);
}

function createNodeHeaderCode(node_code)
{
  //console.log('createNodeHeaderCode');
  $('#'+$slider_destination_center_header+' .btn_node_code').html(node_code);
  
  if(selected_node_kind !== ''){
    var added_class= '';
    $.each(selected_node_kind, function(key, value){
      var html_class= value.replace(':', '');
      added_class += ' <span class="'+html_class+'" title=":'+html_class+'">■</span> ';
    });
    $('#'+$slider_destination_center_header+' .btn_node_code').html(node_code+added_class);
  }
}

function checkArray(arrayValue)
{
  //console.log('checkArray');
  var node_partial='';
  
  if($.isArray(arrayValue)){
    $.each(arrayValue, function(key,value){
      node_partial +=checkArray(value)+'<br/>';
    });
    return (node_partial['en'])? node_partial['en']: node_partial;
  }
  
  if($.isPlainObject(arrayValue)){
    $.each(arrayValue, function(key,value){
      node_partial +='<strong>'+key+': </strong>'+checkArray(value)+'<br/>';
    });
    return (node_partial['en'])? node_partial['en']: node_partial;
  }
  
  return arrayValue;
}