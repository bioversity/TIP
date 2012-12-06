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

function setNodeProperty(node_detail){
  selected_node_name        = getNodeName(node_detail);
  selected_node_code        = getNodeCode(node_detail);
  selected_node_code_local  = getNodeLocalCode(node_detail);
  selected_node_description = getNodeDescription(node_detail);
  selected_node_class       = getNodeClass(node_detail);
}

function getRootNodeList(){
  ask(dev_env+urlForRootNodes, generateRootMenu);
}

function getNodeById()
{
  ask(dev_env+urlForNodeDetails+'/'+selected_node_id, initializeNode);
}

function getNodeRelationINById(page)
{
  ask(dev_env+urlForNodeRelationIN+'/'+selected_node_id+ (page ? '/'+page: ''), generateNodeRelationIN);
}

function getNodeRelationOUTById(page)
{
  ask(dev_env+urlForNodeRelationOUT+'/'+selected_node_id+ (page ? '/'+page: ''), generateNodeRelationOUT);
}

function getNodeName(node)
{
  return (node[kTAG_LABEL] !== undefined)? node[kTAG_LABEL]['en']: '';
}

function getNodeId(node)
{
  return node['_id'];
}

function getNodeTerm(node)
{
  return (node[kTAG_TERM] !== undefined)? node[kTAG_TERM]: '';
}

function getNodeCode(node)
{
  return (node[kTAG_GID] !== undefined)? node[kTAG_GID]: '';
}

function getNodeLocalCode(node)
{
  return (node[kTAG_LID] !== undefined)? node[kTAG_LID]: '';
}

function getNodeClass(node)
{
  return (node[kTAG_CLASS] !== undefined)? node[kTAG_CLASS]: '';
}

function getNodeImage(node)
{
  return '/bundles/bioversityontology/images/slider/default.png';
}

function getNodeDescription(node)
{
  return (node[kTAG_DESCRIPTION] !== undefined)? node[kTAG_DESCRIPTION]['en']: '';
}

function getNodePredicate(edge)
{
  return (selected_node_data._term[edge[kTAG_PREDICATE]] !== undefined)?
            selected_node_data._term[edge[kTAG_PREDICATE]][kTAG_LABEL]['en']: '';
}

function getNodeDefinition(node)
{
  return (node[kTAG_DEFINITION] !== undefined)? node[kTAG_DEFINITION]['en']: '';
}

function getNodeKind(node){
  return (node[kTAG_KIND] !== undefined)? node[kTAG_KIND]: '';
}

function findNodePredicate(nodeId){
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

function setNodePredicate(predicate){
  selected_node_predicate= predicate;
}

function setNodeId(node_id){
  selected_node_id= node_id;
}

function isRoot(node){
  if(node[kTAG_DESCRIPTION][0] == ":ROOT")
    return true;
  else
    return false;
}