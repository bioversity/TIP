///**
// *	Slider configurator file for node creation.
// *
// *	There you can find the primary bind method an relations request method
// *
// *	@package	ontology slider
// *
// *	@author		Antonino Luca Carella <antonio.carella@gmail.com>
// *	@version	1.00
// */
//
//
//function generateNodeRelations(layout, destination)
//{
//  //console.log('generateNodeRelations');
//  var pager_count;
//  
//  $.each(selected_node_data._edge, function(key, value){
//    if(value[kTAG_OBJECT] == selected_node_id){
//      var node_id= value[kTAG_SUBJECT];
//      var node_value= selected_node_data._node[node_id];
//      select_node_direction='left';
//      $show_pager=true;
//      $show_action=true;
//      $show_search_filter= true;
//      pager_count= $pager_node_data_in_count;
//    }else if(value[kTAG_SUBJECT] == selected_node_id){
//      var node_id= value[kTAG_OBJECT];
//      var node_value= selected_node_data._node[node_id];
//      select_node_direction='right';
//      $show_pager=true;
//      $show_action=true;
//      $show_search_filter= true;
//      pager_count= $pager_node_data_out_count;
//    }
//    
//    createNodeButton(
//      layout,
//      destination,
//      getNodePredicate(value),
//      getNodeName(node_value),
//      getNodeCode(node_value),
//      node_id,
//      getNodeDescription(node_value),
//      getNodeDefinition(node_value),
//      getNodeKind(node_value),
//      select_node_direction
//    );
//  });
//  
//  startButtonListAnimation();
//  
//  if($show_pager===true){
//    createPager(pager_count, destination);
//  }
//  
//  if($show_action===true){
//    showFormAction(destination);
//  }
//  
//  if($show_search_filter===true){
//    if(pager_count > 25){
//      showSearchFilter(destination);
//    
//      if($start_search_bind===true){
//        startSearchBind();
//        $start_search_bind=false;
//      }
//    }
//  }
//}