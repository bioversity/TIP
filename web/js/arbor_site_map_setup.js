var colour = {
  root_page:"#EEB211",
  research_page:"#21526a",
  static_page:"#941e5e",
}


var data = {
  nodes:{
    HOME:{
      color:colour.root_page,
      shape:'dot',
      radius:39,
      alpha:1,
      label: 'HOMEPAGE',
      link: '/'},
    LR:{
      color:colour.research_page, 
      shape:'dot', 
      radius:30,
      alpha:1,
      label: 'LANDRACE',
      link: '/admin/browse-landrace'},
    CWR:{
      color:colour.research_page, 
      shape:'dot',
      radius:40,
      alpha:1,
      label: 'CROP WILD RELATIVES',
      link: '/admin/browse-cwr'},
   TRAIT: {
      color:colour.research_page,               
      shape:'dot',
      radius:35,
      alpha:1,
      label: 'TRAIT',
      link: '/admin/browse-trait'},
   ABOUT: {
      color:colour.static_page,               
      shape:'dot',
      radius:35,
      alpha:1,
      label: 'ABOUT',
      link: '/about'},
   CONTACT: {
      color:colour.static_page,               
      shape:'dot',
      radius:35,
      alpha:1,
      label: 'CONTACT',
      link: '/contact'},
   DATABASE: {
      color:colour.static_page,               
      shape:'dot',
      radius:35,
      alpha:1,
      label: 'DATABASE',
      link: '/database'},
   DATABASE1: {
      color:colour.static_page,
      radius:35,
      alpha:0,
      label: 'DATASETS'},
   DATABASE2: {
      color:colour.static_page,
      radius:35,
      alpha:0,
      label: 'DATA SEARCH'},
   DATABASE3: {
      color:colour.static_page,
      radius:35,
      alpha:0,
      label: 'DOWNLOAD DATA'},
   DATABASE4: {
      color:colour.static_page,
      radius:35,
      alpha:0,
      label: 'REQUEST DATA'},
   DATABASE5: {
      color:colour.static_page,
      radius:35,
      alpha:0,
      label: 'CONTRIBUTE DATA'},
  },
  edges:{
    HOME:{
      LR:{}, 
      CWR:{}, 
      TRAIT:{},
      ABOUT:{},
      CONTACT:{},
      DATABASE:{}
    },
    DATABASE:{
      DATABASE1:{},
      DATABASE2:{},
      DATABASE3:{},
      DATABASE4:{},
      DATABASE5:{},
    }
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
        if(selected.node.data.link)
          window.location = selected.node.data.link;
    }
  });
});