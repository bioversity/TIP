var colour = {
  orange:"#EEB211",
  darkblue:"#21526a",
  purple:"#941e5e",
  limegreen:"#c1d72e",
  darkgreen:"#619b45",
  lightblue:"#009fc3",
  pink:"#d11b67",    
}
var data = {
  nodes:{
    HOME:{
      color:colour.orange,
      shape:'dot',
      radius:39,
      alpha:1,
      label: 'DASHBOARD',
      link: '/admin/dashboard'},
    LR:{
      color:colour.darkblue, 
      shape:'dot', 
      radius:30,
      alpha:1,
      label: 'LANDRACE',
      link: '/admin/browse-landrace'},
    CWR:{
      color:colour.purple, 
      shape:'dot',
      radius:40,
      alpha:1,
      label: 'CROP WILD RELATIVES',
      link: '/admin/browse-cwr'},
   TRAIT: {
      color:colour.limegreen,               
      shape:'dot',
      radius:35,
      alpha:1,
      label: 'TRAIT',
      link: '/admin/browse-trait'},
  },
  edges:{
    HOME:{
      LR:{}, 
      CWR:{}, 
      TRAIT:{}
    },
  }
}


var sys = arbor.ParticleSystem()
sys.parameters({stiffness:900, repulsion:2000, gravity:true, dt:0.015})
sys.renderer = Renderer("#viewport");
sys.graft(data); 

$("#viewport").mousedown(function(e){
  var pos = $(this).offset();
  var p = arbor.Point(e.pageX-pos.left, e.pageY-pos.top);
  selected = sys.nearest(p);
  
  $(this).mouseup(function(e){
    if(selected.distance < 50){
      var new_p= arbor.Point(e.pageX-pos.left, e.pageY-pos.top);
      if(p.x == new_p.x && p.y == new_p.y)
        window.location = selected.node.data.link;
    }
  });
});