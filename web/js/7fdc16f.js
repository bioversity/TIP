//
//  arbor.js - version 0.91
//  a graph vizualization toolkit
//
//  Copyright (c) 2011 Samizdat Drafting Co.
//  Physics code derived from springy.js, copyright (c) 2010 Dennis Hotson
// 
//  Permission is hereby granted, free of charge, to any person
//  obtaining a copy of this software and associated documentation
//  files (the "Software"), to deal in the Software without
//  restriction, including without limitation the rights to use,
//  copy, modify, merge, publish, distribute, sublicense, and/or sell
//  copies of the Software, and to permit persons to whom the
//  Software is furnished to do so, subject to the following
//  conditions:
// 
//  The above copyright notice and this permission notice shall be
//  included in all copies or substantial portions of the Software.
// 
//  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
//  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
//  OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
//  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
//  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
//  WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
//  FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
//  OTHER DEALINGS IN THE SOFTWARE.
//

(function($){

  /*        etc.js */  var trace=function(msg){if(typeof(window)=="undefined"||!window.console){return}var len=arguments.length;var args=[];for(var i=0;i<len;i++){args.push("arguments["+i+"]")}eval("console.log("+args.join(",")+")")};var dirname=function(a){var b=a.replace(/^\/?(.*?)\/?$/,"$1").split("/");b.pop();return"/"+b.join("/")};var basename=function(b){var c=b.replace(/^\/?(.*?)\/?$/,"$1").split("/");var a=c.pop();if(a==""){return null}else{return a}};var _ordinalize_re=/(\d)(?=(\d\d\d)+(?!\d))/g;var ordinalize=function(a){var b=""+a;if(a<11000){b=(""+a).replace(_ordinalize_re,"$1,")}else{if(a<1000000){b=Math.floor(a/1000)+"k"}else{if(a<1000000000){b=(""+Math.floor(a/1000)).replace(_ordinalize_re,"$1,")+"m"}}}return b};var nano=function(a,b){return a.replace(/\{([\w\-\.]*)}/g,function(f,c){var d=c.split("."),e=b[d.shift()];$.each(d,function(){if(e.hasOwnProperty(this)){e=e[this]}else{e=f}});return e})};var objcopy=function(a){if(a===undefined){return undefined}if(a===null){return null}if(a.parentNode){return a}switch(typeof a){case"string":return a.substring(0);break;case"number":return a+0;break;case"boolean":return a===true;break}var b=($.isArray(a))?[]:{};$.each(a,function(d,c){b[d]=objcopy(c)});return b};var objmerge=function(d,b){d=d||{};b=b||{};var c=objcopy(d);for(var a in b){c[a]=b[a]}return c};var objcmp=function(e,c,d){if(!e||!c){return e===c}if(typeof e!=typeof c){return false}if(typeof e!="object"){return e===c}else{if($.isArray(e)){if(!($.isArray(c))){return false}if(e.length!=c.length){return false}}else{var h=[];for(var f in e){if(e.hasOwnProperty(f)){h.push(f)}}var g=[];for(var f in c){if(c.hasOwnProperty(f)){g.push(f)}}if(!d){h.sort();g.sort()}if(h.join(",")!==g.join(",")){return false}}var i=true;$.each(e,function(a){var b=objcmp(e[a],c[a]);i=i&&b;if(!i){return false}});return i}};var objkeys=function(b){var a=[];$.each(b,function(d,c){if(b.hasOwnProperty(d)){a.push(d)}});return a};var objcontains=function(c){if(!c||typeof c!="object"){return false}for(var b=1,a=arguments.length;b<a;b++){if(c.hasOwnProperty(arguments[b])){return true}}return false};var uniq=function(b){var a=b.length;var d={};for(var c=0;c<a;c++){d[b[c]]=true}return objkeys(d)};var arbor_path=function(){var a=$("script").map(function(b){var c=$(this).attr("src");if(!c){return}if(c.match(/arbor[^\/\.]*.js|dev.js/)){return c.match(/.*\//)||"/"}});if(a.length>0){return a[0]}else{return null}};
  /*     kernel.js */  var Kernel=function(b){var k=window.location.protocol=="file:"&&navigator.userAgent.toLowerCase().indexOf("chrome")>-1;var a=(window.Worker!==undefined&&!k);var i=null;var c=null;var f=[];f.last=new Date();var l=null;var e=null;var d=null;var h=null;var g=false;var j={system:b,tween:null,nodes:{},init:function(){if(typeof(Tween)!="undefined"){c=Tween()}else{if(typeof(arbor.Tween)!="undefined"){c=arbor.Tween()}else{c={busy:function(){return false},tick:function(){return true},to:function(){trace("Please include arbor-tween.js to enable tweens");c.to=function(){};return}}}}j.tween=c;var m=b.parameters();if(a){trace("using web workers");l=setInterval(j.screenUpdate,m.timeout);i=new Worker(arbor_path()+"arbor.js");i.onmessage=j.workerMsg;i.onerror=function(n){trace("physics:",n)};i.postMessage({type:"physics",physics:objmerge(m,{timeout:Math.ceil(m.timeout)})})}else{trace("couldn't use web workers, be careful...");i=Physics(m.dt,m.stiffness,m.repulsion,m.friction,j.system._updateGeometry);j.start()}return j},graphChanged:function(m){if(a){i.postMessage({type:"changes",changes:m})}else{i._update(m)}j.start()},particleModified:function(n,m){if(a){i.postMessage({type:"modify",id:n,mods:m})}else{i.modifyNode(n,m)}j.start()},physicsModified:function(m){if(!isNaN(m.timeout)){if(a){clearInterval(l);l=setInterval(j.screenUpdate,m.timeout)}else{clearInterval(d);d=null}}if(a){i.postMessage({type:"sys",param:m})}else{i.modifyPhysics(m)}j.start()},workerMsg:function(n){var m=n.data.type;if(m=="geometry"){j.workerUpdate(n.data)}else{trace("physics:",n.data)}},_lastPositions:null,workerUpdate:function(m){j._lastPositions=m;j._lastBounds=m.bounds},_lastFrametime:new Date().valueOf(),_lastBounds:null,_currentRenderer:null,screenUpdate:function(){var n=new Date().valueOf();var m=false;if(j._lastPositions!==null){j.system._updateGeometry(j._lastPositions);j._lastPositions=null;m=true}if(c&&c.busy()){m=true}if(j.system._updateBounds(j._lastBounds)){m=true}if(m){var o=j.system.renderer;if(o!==undefined){if(o!==e){o.init(j.system);e=o}if(c){c.tick()}o.redraw();var p=f.last;f.last=new Date();f.push(f.last-p);if(f.length>50){f.shift()}}}},physicsUpdate:function(){if(c){c.tick()}i.tick();var n=j.system._updateBounds();if(c&&c.busy()){n=true}var o=j.system.renderer;var m=new Date();var o=j.system.renderer;if(o!==undefined){if(o!==e){o.init(j.system);e=o}o.redraw({timestamp:m})}var q=f.last;f.last=m;f.push(f.last-q);if(f.length>50){f.shift()}var p=i.systemEnergy();if((p.mean+p.max)/2<0.05){if(h===null){h=new Date().valueOf()}if(new Date().valueOf()-h>1000){clearInterval(d);d=null}else{}}else{h=null}},fps:function(n){if(n!==undefined){var q=1000/Math.max(1,targetFps);j.physicsModified({timeout:q})}var r=0;for(var p=0,o=f.length;p<o;p++){r+=f[p]}var m=r/Math.max(1,f.length);if(!isNaN(m)){return Math.round(1000/m)}else{return 0}},start:function(m){if(d!==null){return}if(g&&!m){return}g=false;if(a){i.postMessage({type:"start"})}else{h=null;d=setInterval(j.physicsUpdate,j.system.parameters().timeout)}},stop:function(){g=true;if(a){i.postMessage({type:"stop"})}else{if(d!==null){clearInterval(d);d=null}}}};return j.init()};
  /*      atoms.js */  var Node=function(a){this._id=_nextNodeId++;this.data=a||{};this._mass=(a.mass!==undefined)?a.mass:1;this._fixed=(a.fixed===true)?true:false;this._p=new Point((typeof(a.x)=="number")?a.x:null,(typeof(a.y)=="number")?a.y:null);delete this.data.x;delete this.data.y;delete this.data.mass;delete this.data.fixed};var _nextNodeId=1;var Edge=function(b,c,a){this._id=_nextEdgeId--;this.source=b;this.target=c;this.length=(a.length!==undefined)?a.length:1;this.data=(a!==undefined)?a:{};delete this.data.length};var _nextEdgeId=-1;var Particle=function(a,b){this.p=a;this.m=b;this.v=new Point(0,0);this.f=new Point(0,0)};Particle.prototype.applyForce=function(a){this.f=this.f.add(a.divide(this.m))};var Spring=function(c,b,d,a){this.point1=c;this.point2=b;this.length=d;this.k=a};Spring.prototype.distanceToParticle=function(a){var c=that.point2.p.subtract(that.point1.p).normalize().normal();var b=a.p.subtract(that.point1.p);return Math.abs(b.x*c.x+b.y*c.y)};var Point=function(a,b){if(a&&a.hasOwnProperty("y")){b=a.y;a=a.x}this.x=a;this.y=b};Point.random=function(a){a=(a!==undefined)?a:5;return new Point(2*a*(Math.random()-0.5),2*a*(Math.random()-0.5))};Point.prototype={exploded:function(){return(isNaN(this.x)||isNaN(this.y))},add:function(a){return new Point(this.x+a.x,this.y+a.y)},subtract:function(a){return new Point(this.x-a.x,this.y-a.y)},multiply:function(a){return new Point(this.x*a,this.y*a)},divide:function(a){return new Point(this.x/a,this.y/a)},magnitude:function(){return Math.sqrt(this.x*this.x+this.y*this.y)},normal:function(){return new Point(-this.y,this.x)},normalize:function(){return this.divide(this.magnitude())}};
  /*     system.js */  var ParticleSystem=function(d,p,e,f,t,l,q){var j=[];var h=null;var k=0;var u=null;var m=0.04;var i=[20,20,20,20];var n=null;var o=null;if(typeof p=="object"){var s=p;e=s.friction;d=s.repulsion;t=s.fps;l=s.dt;p=s.stiffness;f=s.gravity;q=s.precision}e=isNaN(e)?0.5:e;d=isNaN(d)?1000:d;t=isNaN(t)?55:t;p=isNaN(p)?600:p;l=isNaN(l)?0.02:l;q=isNaN(q)?0.6:q;f=(f===true);var r=(t!==undefined)?1000/t:1000/50;var b={repulsion:d,stiffness:p,friction:e,dt:l,gravity:f,precision:q,timeout:r};var a;var c={renderer:null,tween:null,nodes:{},edges:{},adjacency:{},names:{},kernel:null};var g={parameters:function(v){if(v!==undefined){if(!isNaN(v.precision)){v.precision=Math.max(0,Math.min(1,v.precision))}$.each(b,function(x,w){if(v[x]!==undefined){b[x]=v[x]}});c.kernel.physicsModified(v)}return b},fps:function(v){if(v===undefined){return c.kernel.fps()}else{g.parameters({timeout:1000/(v||50)})}},start:function(){c.kernel.start()},stop:function(){c.kernel.stop()},addNode:function(w,B){B=B||{};var C=c.names[w];if(C){C.data=B;return C}else{if(w!=undefined){var v=(B.x!=undefined)?B.x:null;var D=(B.y!=undefined)?B.y:null;var A=(B.fixed)?1:0;var z=new Node(B);z.name=w;c.names[w]=z;c.nodes[z._id]=z;j.push({t:"addNode",id:z._id,m:z.mass,x:v,y:D,f:A});g._notify();return z}}},pruneNode:function(w){var v=g.getNode(w);if(typeof(c.nodes[v._id])!=="undefined"){delete c.nodes[v._id];delete c.names[v.name]}$.each(c.edges,function(y,x){if(x.source._id===v._id||x.target._id===v._id){g.pruneEdge(x)}});j.push({t:"dropNode",id:v._id});g._notify()},getNode:function(v){if(v._id!==undefined){return v}else{if(typeof v=="string"||typeof v=="number"){return c.names[v]}}},eachNode:function(v){$.each(c.nodes,function(y,x){if(x._p.x==null||x._p.y==null){return}var w=(u!==null)?g.toScreen(x._p):x._p;v.call(g,x,w)})},addEdge:function(z,A,y){z=g.getNode(z)||g.addNode(z);A=g.getNode(A)||g.addNode(A);y=y||{};var x=new Edge(z,A,y);var B=z._id;var C=A._id;c.adjacency[B]=c.adjacency[B]||{};c.adjacency[B][C]=c.adjacency[B][C]||[];var w=(c.adjacency[B][C].length>0);if(w){$.extend(c.adjacency[B][C].data,x.data);return}else{c.edges[x._id]=x;c.adjacency[B][C].push(x);var v=(x.length!==undefined)?x.length:1;j.push({t:"addSpring",id:x._id,fm:B,to:C,l:v});g._notify()}return x},pruneEdge:function(A){j.push({t:"dropSpring",id:A._id});delete c.edges[A._id];for(var v in c.adjacency){for(var B in c.adjacency[v]){var w=c.adjacency[v][B];for(var z=w.length-1;z>=0;z--){if(c.adjacency[v][B][z]._id===A._id){c.adjacency[v][B].splice(z,1)}}}}g._notify()},getEdges:function(w,v){w=g.getNode(w);v=g.getNode(v);if(!w||!v){return[]}if(typeof(c.adjacency[w._id])!=="undefined"&&typeof(c.adjacency[w._id][v._id])!=="undefined"){return c.adjacency[w._id][v._id]}return[]},getEdgesFrom:function(v){v=g.getNode(v);if(!v){return[]}if(typeof(c.adjacency[v._id])!=="undefined"){var w=[];$.each(c.adjacency[v._id],function(y,x){w=w.concat(x)});return w}return[]},getEdgesTo:function(v){v=g.getNode(v);if(!v){return[]}var w=[];$.each(c.edges,function(y,x){if(x.target==v){w.push(x)}});return w},eachEdge:function(v){$.each(c.edges,function(z,x){var y=c.nodes[x.source._id]._p;var w=c.nodes[x.target._id]._p;if(y.x==null||w.x==null){return}y=(u!==null)?g.toScreen(y):y;w=(u!==null)?g.toScreen(w):w;if(y&&w){v.call(g,x,y,w)}})},prune:function(w){var v={dropped:{nodes:[],edges:[]}};if(w===undefined){$.each(c.nodes,function(y,x){v.dropped.nodes.push(x);g.pruneNode(x)})}else{g.eachNode(function(y){var x=w.call(g,y,{from:g.getEdgesFrom(y),to:g.getEdgesTo(y)});if(x){v.dropped.nodes.push(y);g.pruneNode(y)}})}return v},graft:function(w){var v={added:{nodes:[],edges:[]}};if(w.nodes){$.each(w.nodes,function(y,x){var z=g.getNode(y);if(z){z.data=x}else{v.added.nodes.push(g.addNode(y,x))}c.kernel.start()})}if(w.edges){$.each(w.edges,function(z,x){var y=g.getNode(z);if(!y){v.added.nodes.push(g.addNode(z,{}))}$.each(x,function(D,A){var C=g.getNode(D);if(!C){v.added.nodes.push(g.addNode(D,{}))}var B=g.getEdges(z,D);if(B.length>0){B[0].data=A}else{v.added.edges.push(g.addEdge(z,D,A))}})})}return v},merge:function(w){var v={added:{nodes:[],edges:[]},dropped:{nodes:[],edges:[]}};$.each(c.edges,function(A,z){if((w.edges[z.source.name]===undefined||w.edges[z.source.name][z.target.name]===undefined)){g.pruneEdge(z);v.dropped.edges.push(z)}});var y=g.prune(function(A,z){if(w.nodes[A.name]===undefined){v.dropped.nodes.push(A);return true}});var x=g.graft(w);v.added.nodes=v.added.nodes.concat(x.added.nodes);v.added.edges=v.added.edges.concat(x.added.edges);v.dropped.nodes=v.dropped.nodes.concat(y.dropped.nodes);v.dropped.edges=v.dropped.edges.concat(y.dropped.edges);return v},tweenNode:function(y,v,x){var w=g.getNode(y);if(w){c.tween.to(w,v,x)}},tweenEdge:function(w,v,z,y){if(y===undefined){g._tweenEdge(w,v,z)}else{var x=g.getEdges(w,v);$.each(x,function(A,B){g._tweenEdge(B,z,y)})}},_tweenEdge:function(w,v,x){if(w&&w._id!==undefined){c.tween.to(w,v,x)}},_updateGeometry:function(y){if(y!=undefined){var v=(y.epoch<k);a=y.energy;var z=y.geometry;if(z!==undefined){for(var x=0,w=z.length/3;x<w;x++){var A=z[3*x];if(v&&c.nodes[A]==undefined){continue}c.nodes[A]._p.x=z[3*x+1];c.nodes[A]._p.y=z[3*x+2]}}}},screen:function(v){if(v==undefined){return{size:(u)?objcopy(u):undefined,padding:i.concat(),step:m}}if(v.size!==undefined){g.screenSize(v.size.width,v.size.height)}if(!isNaN(v.step)){g.screenStep(v.step)}if(v.padding!==undefined){g.screenPadding(v.padding)}},screenSize:function(v,w){u={width:v,height:w};g._updateBounds()},screenPadding:function(y,z,v,w){if($.isArray(y)){trbl=y}else{trbl=[y,z,v,w]}var A=trbl[0];var x=trbl[1];var B=trbl[2];if(x===undefined){trbl=[A,A,A,A]}else{if(B==undefined){trbl=[A,x,A,x]}}i=trbl},screenStep:function(v){m=v},toScreen:function(x){if(!n||!u){return}var w=i||[0,0,0,0];var v=n.bottomright.subtract(n.topleft);var z=w[3]+x.subtract(n.topleft).divide(v.x).x*(u.width-(w[1]+w[3]));var y=w[0]+x.subtract(n.topleft).divide(v.y).y*(u.height-(w[0]+w[2]));return arbor.Point(z,y)},fromScreen:function(z){if(!n||!u){return}var y=i||[0,0,0,0];var x=n.bottomright.subtract(n.topleft);var w=(z.x-y[3])/(u.width-(y[1]+y[3]))*x.x+n.topleft.x;var v=(z.y-y[0])/(u.height-(y[0]+y[2]))*x.y+n.topleft.y;return arbor.Point(w,v)},_updateBounds:function(w){if(u===null){return}if(w){o=w}else{o=g.bounds()}var z=new Point(o.bottomright.x,o.bottomright.y);var y=new Point(o.topleft.x,o.topleft.y);var B=z.subtract(y);var v=y.add(B.divide(2));var x=4;var D=new Point(Math.max(B.x,x),Math.max(B.y,x));o.topleft=v.subtract(D.divide(2));o.bottomright=v.add(D.divide(2));if(!n){if($.isEmptyObject(c.nodes)){return false}n=o;return true}var C=m;_newBounds={bottomright:n.bottomright.add(o.bottomright.subtract(n.bottomright).multiply(C)),topleft:n.topleft.add(o.topleft.subtract(n.topleft).multiply(C))};var A=new Point(n.topleft.subtract(_newBounds.topleft).magnitude(),n.bottomright.subtract(_newBounds.bottomright).magnitude());if(A.x*u.width>1||A.y*u.height>1){n=_newBounds;return true}else{return false}},energy:function(){return a},bounds:function(){var w=null;var v=null;$.each(c.nodes,function(z,y){if(!w){w=new Point(y._p);v=new Point(y._p);return}var x=y._p;if(x.x===null||x.y===null){return}if(x.x>w.x){w.x=x.x}if(x.y>w.y){w.y=x.y}if(x.x<v.x){v.x=x.x}if(x.y<v.y){v.y=x.y}});if(w&&v){return{bottomright:w,topleft:v}}else{return{topleft:new Point(-1,-1),bottomright:new Point(1,1)}}},nearest:function(x){if(u!==null){x=g.fromScreen(x)}var w={node:null,point:null,distance:null};var v=g;$.each(c.nodes,function(B,y){var z=y._p;if(z.x===null||z.y===null){return}var A=z.subtract(x).magnitude();if(w.distance===null||A<w.distance){w={node:y,point:z,distance:A};if(u!==null){w.screenPoint=g.toScreen(z)}}});if(w.node){if(u!==null){w.distance=g.toScreen(w.node.p).subtract(g.toScreen(x)).magnitude()}return w}else{return null}},_notify:function(){if(h===null){k++}else{clearTimeout(h)}h=setTimeout(g._synchronize,20)},_synchronize:function(){if(j.length>0){c.kernel.graphChanged(j);j=[];h=null}},};c.kernel=Kernel(g);c.tween=c.kernel.tween||null;Node.prototype.__defineGetter__("p",function(){var w=this;var v={};v.__defineGetter__("x",function(){return w._p.x});v.__defineSetter__("x",function(x){c.kernel.particleModified(w._id,{x:x})});v.__defineGetter__("y",function(){return w._p.y});v.__defineSetter__("y",function(x){c.kernel.particleModified(w._id,{y:x})});v.__proto__=Point.prototype;return v});Node.prototype.__defineSetter__("p",function(v){this._p.x=v.x;this._p.y=v.y;c.kernel.particleModified(this._id,{x:v.x,y:v.y})});Node.prototype.__defineGetter__("mass",function(){return this._mass});Node.prototype.__defineSetter__("mass",function(v){this._mass=v;c.kernel.particleModified(this._id,{m:v})});Node.prototype.__defineSetter__("tempMass",function(v){c.kernel.particleModified(this._id,{_m:v})});Node.prototype.__defineGetter__("fixed",function(){return this._fixed});Node.prototype.__defineSetter__("fixed",function(v){this._fixed=v;c.kernel.particleModified(this._id,{f:v?1:0})});return g};
  /* barnes-hut.js */  var BarnesHutTree=function(){var b=[];var a=0;var e=null;var d=0.5;var c={init:function(g,h,f){d=f;a=0;e=c._newBranch();e.origin=g;e.size=h.subtract(g)},insert:function(j){var f=e;var g=[j];while(g.length){var h=g.shift();var m=h._m||h.m;var p=c._whichQuad(h,f);if(f[p]===undefined){f[p]=h;f.mass+=m;if(f.p){f.p=f.p.add(h.p.multiply(m))}else{f.p=h.p.multiply(m)}}else{if("origin" in f[p]){f.mass+=(m);if(f.p){f.p=f.p.add(h.p.multiply(m))}else{f.p=h.p.multiply(m)}f=f[p];g.unshift(h)}else{var l=f.size.divide(2);var n=new Point(f.origin);if(p[0]=="s"){n.y+=l.y}if(p[1]=="e"){n.x+=l.x}var o=f[p];f[p]=c._newBranch();f[p].origin=n;f[p].size=l;f.mass=m;f.p=h.p.multiply(m);f=f[p];if(o.p.x===h.p.x&&o.p.y===h.p.y){var k=l.x*0.08;var i=l.y*0.08;o.p.x=Math.min(n.x+l.x,Math.max(n.x,o.p.x-k/2+Math.random()*k));o.p.y=Math.min(n.y+l.y,Math.max(n.y,o.p.y-i/2+Math.random()*i))}g.push(o);g.unshift(h)}}}},applyForces:function(m,g){var f=[e];while(f.length){node=f.shift();if(node===undefined){continue}if(m===node){continue}if("f" in node){var k=m.p.subtract(node.p);var l=Math.max(1,k.magnitude());var i=((k.magnitude()>0)?k:Point.random(1)).normalize();m.applyForce(i.multiply(g*(node._m||node.m)).divide(l*l))}else{var j=m.p.subtract(node.p.divide(node.mass)).magnitude();var h=Math.sqrt(node.size.x*node.size.y);if(h/j>d){f.push(node.ne);f.push(node.nw);f.push(node.se);f.push(node.sw)}else{var k=m.p.subtract(node.p.divide(node.mass));var l=Math.max(1,k.magnitude());var i=((k.magnitude()>0)?k:Point.random(1)).normalize();m.applyForce(i.multiply(g*(node.mass)).divide(l*l))}}}},_whichQuad:function(i,f){if(i.p.exploded()){return null}var h=i.p.subtract(f.origin);var g=f.size.divide(2);if(h.y<g.y){if(h.x<g.x){return"nw"}else{return"ne"}}else{if(h.x<g.x){return"sw"}else{return"se"}}},_newBranch:function(){if(b[a]){var f=b[a];f.ne=f.nw=f.se=f.sw=undefined;f.mass=0;delete f.p}else{f={origin:null,size:null,nw:undefined,ne:undefined,sw:undefined,se:undefined,mass:0};b[a]=f}a++;return f}};return c};
  /*    physics.js */  var Physics=function(a,m,n,e,h){var f=BarnesHutTree();var c={particles:{},springs:{}};var l={particles:{}};var o=[];var k=[];var d=0;var b={sum:0,max:0,mean:0};var g={topleft:new Point(-1,-1),bottomright:new Point(1,1)};var j=1000;var i={stiffness:(m!==undefined)?m:1000,repulsion:(n!==undefined)?n:600,friction:(e!==undefined)?e:0.3,gravity:false,dt:(a!==undefined)?a:0.02,theta:0.4,init:function(){return i},modifyPhysics:function(p){$.each(["stiffness","repulsion","friction","gravity","dt","precision"],function(r,s){if(p[s]!==undefined){if(s=="precision"){i.theta=1-p[s];return}i[s]=p[s];if(s=="stiffness"){var q=p[s];$.each(c.springs,function(u,t){t.k=q})}}})},addNode:function(u){var t=u.id;var q=u.m;var p=g.bottomright.x-g.topleft.x;var s=g.bottomright.y-g.topleft.y;var r=new Point((u.x!=null)?u.x:g.topleft.x+p*Math.random(),(u.y!=null)?u.y:g.topleft.y+s*Math.random());c.particles[t]=new Particle(r,q);c.particles[t].connections=0;c.particles[t].fixed=(u.f===1);l.particles[t]=c.particles[t];o.push(c.particles[t])},dropNode:function(s){var r=s.id;var q=c.particles[r];var p=$.inArray(q,o);if(p>-1){o.splice(p,1)}delete c.particles[r];delete l.particles[r]},modifyNode:function(r,p){if(r in c.particles){var q=c.particles[r];if("x" in p){q.p.x=p.x}if("y" in p){q.p.y=p.y}if("m" in p){q.m=p.m}if("f" in p){q.fixed=(p.f===1)}if("_m" in p){if(q._m===undefined){q._m=q.m}q.m=p._m}}},addSpring:function(t){var s=t.id;var p=t.l;var r=c.particles[t.fm];var q=c.particles[t.to];if(r!==undefined&&q!==undefined){c.springs[s]=new Spring(r,q,p,i.stiffness);k.push(c.springs[s]);r.connections++;q.connections++;delete l.particles[t.fm];delete l.particles[t.to]}},dropSpring:function(s){var r=s.id;var q=c.springs[r];q.point1.connections--;q.point2.connections--;var p=$.inArray(q,k);if(p>-1){k.splice(p,1)}delete c.springs[r]},_update:function(p){d++;$.each(p,function(q,r){if(r.t in i){i[r.t](r)}});return d},tick:function(){i.tendParticles();i.eulerIntegrator(i.dt);i.tock()},tock:function(){var p=[];$.each(c.particles,function(r,q){p.push(r);p.push(q.p.x);p.push(q.p.y)});if(h){h({geometry:p,epoch:d,energy:b,bounds:g})}},tendParticles:function(){$.each(c.particles,function(q,p){if(p._m!==undefined){if(Math.abs(p.m-p._m)<1){p.m=p._m;delete p._m}else{p.m*=0.98}}p.v.x=p.v.y=0})},eulerIntegrator:function(p){if(i.repulsion>0){if(i.theta>0){i.applyBarnesHutRepulsion()}else{i.applyBruteForceRepulsion()}}if(i.stiffness>0){i.applySprings()}i.applyCenterDrift();if(i.gravity){i.applyCenterGravity()}i.updateVelocity(p);i.updatePosition(p)},applyBruteForceRepulsion:function(){$.each(c.particles,function(q,p){$.each(c.particles,function(s,r){if(p!==r){var u=p.p.subtract(r.p);var v=Math.max(1,u.magnitude());var t=((u.magnitude()>0)?u:Point.random(1)).normalize();p.applyForce(t.multiply(i.repulsion*(r._m||r.m)*0.5).divide(v*v*0.5));r.applyForce(t.multiply(i.repulsion*(p._m||p.m)*0.5).divide(v*v*-0.5))}})})},applyBarnesHutRepulsion:function(){if(!g.topleft||!g.bottomright){return}var q=new Point(g.bottomright);var p=new Point(g.topleft);f.init(p,q,i.theta);$.each(c.particles,function(s,r){f.insert(r)});$.each(c.particles,function(s,r){f.applyForces(r,i.repulsion)})},applySprings:function(){$.each(c.springs,function(t,p){var s=p.point2.p.subtract(p.point1.p);var q=p.length-s.magnitude();var r=((s.magnitude()>0)?s:Point.random(1)).normalize();p.point1.applyForce(r.multiply(p.k*q*-0.5));p.point2.applyForce(r.multiply(p.k*q*0.5))})},applyCenterDrift:function(){var q=0;var r=new Point(0,0);$.each(c.particles,function(t,s){r.add(s.p);q++});if(q==0){return}var p=r.divide(-q);$.each(c.particles,function(t,s){s.applyForce(p)})},applyCenterGravity:function(){$.each(c.particles,function(r,p){var q=p.p.multiply(-1);p.applyForce(q.multiply(i.repulsion/100))})},updateVelocity:function(p){$.each(c.particles,function(t,q){if(q.fixed){q.v=new Point(0,0);q.f=new Point(0,0);return}var s=q.v.magnitude();q.v=q.v.add(q.f.multiply(p)).multiply(1-i.friction);q.f.x=q.f.y=0;var r=q.v.magnitude();if(r>j){q.v=q.v.divide(r*r)}})},updatePosition:function(q){var r=0,p=0,u=0;var t=null;var s=null;$.each(c.particles,function(w,v){v.p=v.p.add(v.v.multiply(q));var x=v.v.magnitude();var z=x*x;r+=z;p=Math.max(z,p);u++;if(!t){t=new Point(v.p.x,v.p.y);s=new Point(v.p.x,v.p.y);return}var y=v.p;if(y.x===null||y.y===null){return}if(y.x>t.x){t.x=y.x}if(y.y>t.y){t.y=y.y}if(y.x<s.x){s.x=y.x}if(y.y<s.y){s.y=y.y}});b={sum:r,max:p,mean:r/u,n:u};g={topleft:s||new Point(-1,-1),bottomright:t||new Point(1,1)}},systemEnergy:function(p){return b}};return i.init()};var _nearParticle=function(b,c){var c=c||0;var a=b.x;var f=b.y;var e=c*2;return new Point(a-c+Math.random()*e,f-c+Math.random()*e)};

  // if called as a worker thread, set up a run loop for the Physics object and bail out
  if (typeof(window)=='undefined') return (function(){
  /* hermetic.js */  $={each:function(d,e){if($.isArray(d)){for(var c=0,b=d.length;c<b;c++){e(c,d[c])}}else{for(var a in d){e(a,d[a])}}},map:function(a,c){var b=[];$.each(a,function(f,e){var d=c(e);if(d!==undefined){b.push(d)}});return b},extend:function(c,b){if(typeof b!="object"){return c}for(var a in b){if(b.hasOwnProperty(a)){c[a]=b[a]}}return c},isArray:function(a){if(!a){return false}return(a.constructor.toString().indexOf("Array")!=-1)},inArray:function(c,a){for(var d=0,b=a.length;d<b;d++){if(a[d]===c){return d}}return -1},isEmptyObject:function(a){if(typeof a!=="object"){return false}var b=true;$.each(a,function(c,d){b=false});return b},};
  /*     worker.js */  var PhysicsWorker=function(){var b=20;var a=null;var d=null;var c=null;var g=[];var f=new Date().valueOf();var e={init:function(h){e.timeout(h.timeout);a=Physics(h.dt,h.stiffness,h.repulsion,h.friction,e.tock);return e},timeout:function(h){if(h!=b){b=h;if(d!==null){e.stop();e.go()}}},go:function(){if(d!==null){return}c=null;d=setInterval(e.tick,b)},stop:function(){if(d===null){return}clearInterval(d);d=null},tick:function(){a.tick();var h=a.systemEnergy();if((h.mean+h.max)/2<0.05){if(c===null){c=new Date().valueOf()}if(new Date().valueOf()-c>1000){e.stop()}else{}}else{c=null}},tock:function(h){h.type="geometry";postMessage(h)},modifyNode:function(i,h){a.modifyNode(i,h);e.go()},modifyPhysics:function(h){a.modifyPhysics(h)},update:function(h){var i=a._update(h)}};return e};var physics=PhysicsWorker();onmessage=function(a){if(!a.data.type){postMessage("¿kérnèl?");return}if(a.data.type=="physics"){var b=a.data.physics;physics.init(a.data.physics);return}switch(a.data.type){case"modify":physics.modifyNode(a.data.id,a.data.mods);break;case"changes":physics.update(a.data.changes);physics.go();break;case"start":physics.go();break;case"stop":physics.stop();break;case"sys":var b=a.data.param||{};if(!isNaN(b.timeout)){physics.timeout(b.timeout)}physics.modifyPhysics(b);physics.go();break}};
  })()


  arbor = (typeof(arbor)!=='undefined') ? arbor : {}
  $.extend(arbor, {
    // object constructors (don't use ‘new’, just call them)
    ParticleSystem:ParticleSystem,
    Point:function(x, y){ return new Point(x, y) },

    // immutable object with useful methods
    etc:{      
      trace:trace,              // ƒ(msg) -> safe console logging
      dirname:dirname,          // ƒ(path) -> leading part of path
      basename:basename,        // ƒ(path) -> trailing part of path
      ordinalize:ordinalize,    // ƒ(num) -> abbrev integers (and add commas)
      objcopy:objcopy,          // ƒ(old) -> clone an object
      objcmp:objcmp,            // ƒ(a, b, strict_ordering) -> t/f comparison
      objkeys:objkeys,          // ƒ(obj) -> array of all keys in obj
      objmerge:objmerge,        // ƒ(dst, src) -> like $.extend but non-destructive
      uniq:uniq,                // ƒ(arr) -> array of unique items in arr
      arbor_path:arbor_path,    // ƒ() -> guess the directory of the lib code
    }
  })
  
})(this.jQuery)
//
//  arbor-tween.js
//  smooth transitions with a realtime clock
//
//  Copyright (c) 2011 Samizdat Drafting Co.
// 
//  Permission is hereby granted, free of charge, to any person
//  obtaining a copy of this software and associated documentation
//  files (the "Software"), to deal in the Software without
//  restriction, including without limitation the rights to use,
//  copy, modify, merge, publish, distribute, sublicense, and/or sell
//  copies of the Software, and to permit persons to whom the
//  Software is furnished to do so, subject to the following
//  conditions:
// 
//  The above copyright notice and this permission notice shall be
//  included in all copies or substantial portions of the Software.
// 
//  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
//  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
//  OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
//  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
//  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
//  WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
//  FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
//  OTHER DEALINGS IN THE SOFTWARE.
//

//  Easing Equations in easing.js:
//  Copyright © 2001 Robert Penner. All rights reserved.
//  
//  Open source under the BSD License. Redistribution and use in source
//  and binary forms, with or without modification, are permitted
//  provided that the following conditions are met:
//  
//  Redistributions of source code must retain the above copyright
//  notice, this list of conditions and the following disclaimer.
//  Redistributions in binary form must reproduce the above copyright
//  notice, this list of conditions and the following disclaimer in the
//  documentation and/or other materials provided with the distribution.
//  
//  Neither the name of the author nor the names of contributors may be
//  used to endorse or promote products derived from this software
//  without specific prior written permission.
//  
//  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
//  "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
//  LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
//  A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
//  OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
//  SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
//  LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
//  DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
//  THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
//  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
//  OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 


(function($){

  /*    etc.js */  var trace=function(msg){if(typeof(window)=="undefined"||!window.console){return}var len=arguments.length;var args=[];for(var i=0;i<len;i++){args.push("arguments["+i+"]")}eval("console.log("+args.join(",")+")")};var dirname=function(a){var b=a.replace(/^\/?(.*?)\/?$/,"$1").split("/");b.pop();return"/"+b.join("/")};var basename=function(b){var c=b.replace(/^\/?(.*?)\/?$/,"$1").split("/");var a=c.pop();if(a==""){return null}else{return a}};var _ordinalize_re=/(\d)(?=(\d\d\d)+(?!\d))/g;var ordinalize=function(a){var b=""+a;if(a<11000){b=(""+a).replace(_ordinalize_re,"$1,")}else{if(a<1000000){b=Math.floor(a/1000)+"k"}else{if(a<1000000000){b=(""+Math.floor(a/1000)).replace(_ordinalize_re,"$1,")+"m"}}}return b};var nano=function(a,b){return a.replace(/\{([\w\-\.]*)}/g,function(f,c){var d=c.split("."),e=b[d.shift()];$.each(d,function(){if(e.hasOwnProperty(this)){e=e[this]}else{e=f}});return e})};var objcopy=function(a){if(a===undefined){return undefined}if(a===null){return null}if(a.parentNode){return a}switch(typeof a){case"string":return a.substring(0);break;case"number":return a+0;break;case"boolean":return a===true;break}var b=($.isArray(a))?[]:{};$.each(a,function(d,c){b[d]=objcopy(c)});return b};var objmerge=function(d,b){d=d||{};b=b||{};var c=objcopy(d);for(var a in b){c[a]=b[a]}return c};var objcmp=function(e,c,d){if(!e||!c){return e===c}if(typeof e!=typeof c){return false}if(typeof e!="object"){return e===c}else{if($.isArray(e)){if(!($.isArray(c))){return false}if(e.length!=c.length){return false}}else{var h=[];for(var f in e){if(e.hasOwnProperty(f)){h.push(f)}}var g=[];for(var f in c){if(c.hasOwnProperty(f)){g.push(f)}}if(!d){h.sort();g.sort()}if(h.join(",")!==g.join(",")){return false}}var i=true;$.each(e,function(a){var b=objcmp(e[a],c[a]);i=i&&b;if(!i){return false}});return i}};var objkeys=function(b){var a=[];$.each(b,function(d,c){if(b.hasOwnProperty(d)){a.push(d)}});return a};var objcontains=function(c){if(!c||typeof c!="object"){return false}for(var b=1,a=arguments.length;b<a;b++){if(c.hasOwnProperty(arguments[b])){return true}}return false};var uniq=function(b){var a=b.length;var d={};for(var c=0;c<a;c++){d[b[c]]=true}return objkeys(d)};var arbor_path=function(){var a=$("script").map(function(b){var c=$(this).attr("src");if(!c){return}if(c.match(/arbor[^\/\.]*.js|dev.js/)){return c.match(/.*\//)||"/"}});if(a.length>0){return a[0]}else{return null}};
  /* colors.js */  var Colors=(function(){var f=/#[0-9a-f]{6}/i;var b=/#(..)(..)(..)/;var c=function(h){var g=h.toString(16);return(g.length==2)?g:"0"+g};var a=function(g){return parseInt(g,16)};var d=function(g){if(!g||typeof g!="object"){return false}var h=objkeys(g).sort().join("");if(h=="abgr"){return true}};var e={CSS:{aliceblue:"#f0f8ff",antiquewhite:"#faebd7",aqua:"#00ffff",aquamarine:"#7fffd4",azure:"#f0ffff",beige:"#f5f5dc",bisque:"#ffe4c4",black:"#000000",blanchedalmond:"#ffebcd",blue:"#0000ff",blueviolet:"#8a2be2",brown:"#a52a2a",burlywood:"#deb887",cadetblue:"#5f9ea0",chartreuse:"#7fff00",chocolate:"#d2691e",coral:"#ff7f50",cornflowerblue:"#6495ed",cornsilk:"#fff8dc",crimson:"#dc143c",cyan:"#00ffff",darkblue:"#00008b",darkcyan:"#008b8b",darkgoldenrod:"#b8860b",darkgray:"#a9a9a9",darkgrey:"#a9a9a9",darkgreen:"#006400",darkkhaki:"#bdb76b",darkmagenta:"#8b008b",darkolivegreen:"#556b2f",darkorange:"#ff8c00",darkorchid:"#9932cc",darkred:"#8b0000",darksalmon:"#e9967a",darkseagreen:"#8fbc8f",darkslateblue:"#483d8b",darkslategray:"#2f4f4f",darkslategrey:"#2f4f4f",darkturquoise:"#00ced1",darkviolet:"#9400d3",deeppink:"#ff1493",deepskyblue:"#00bfff",dimgray:"#696969",dimgrey:"#696969",dodgerblue:"#1e90ff",firebrick:"#b22222",floralwhite:"#fffaf0",forestgreen:"#228b22",fuchsia:"#ff00ff",gainsboro:"#dcdcdc",ghostwhite:"#f8f8ff",gold:"#ffd700",goldenrod:"#daa520",gray:"#808080",grey:"#808080",green:"#008000",greenyellow:"#adff2f",honeydew:"#f0fff0",hotpink:"#ff69b4",indianred:"#cd5c5c",indigo:"#4b0082",ivory:"#fffff0",khaki:"#f0e68c",lavender:"#e6e6fa",lavenderblush:"#fff0f5",lawngreen:"#7cfc00",lemonchiffon:"#fffacd",lightblue:"#add8e6",lightcoral:"#f08080",lightcyan:"#e0ffff",lightgoldenrodyellow:"#fafad2",lightgray:"#d3d3d3",lightgrey:"#d3d3d3",lightgreen:"#90ee90",lightpink:"#ffb6c1",lightsalmon:"#ffa07a",lightseagreen:"#20b2aa",lightskyblue:"#87cefa",lightslategray:"#778899",lightslategrey:"#778899",lightsteelblue:"#b0c4de",lightyellow:"#ffffe0",lime:"#00ff00",limegreen:"#32cd32",linen:"#faf0e6",magenta:"#ff00ff",maroon:"#800000",mediumaquamarine:"#66cdaa",mediumblue:"#0000cd",mediumorchid:"#ba55d3",mediumpurple:"#9370d8",mediumseagreen:"#3cb371",mediumslateblue:"#7b68ee",mediumspringgreen:"#00fa9a",mediumturquoise:"#48d1cc",mediumvioletred:"#c71585",midnightblue:"#191970",mintcream:"#f5fffa",mistyrose:"#ffe4e1",moccasin:"#ffe4b5",navajowhite:"#ffdead",navy:"#000080",oldlace:"#fdf5e6",olive:"#808000",olivedrab:"#6b8e23",orange:"#ffa500",orangered:"#ff4500",orchid:"#da70d6",palegoldenrod:"#eee8aa",palegreen:"#98fb98",paleturquoise:"#afeeee",palevioletred:"#d87093",papayawhip:"#ffefd5",peachpuff:"#ffdab9",peru:"#cd853f",pink:"#ffc0cb",plum:"#dda0dd",powderblue:"#b0e0e6",purple:"#800080",red:"#ff0000",rosybrown:"#bc8f8f",royalblue:"#4169e1",saddlebrown:"#8b4513",salmon:"#fa8072",sandybrown:"#f4a460",seagreen:"#2e8b57",seashell:"#fff5ee",sienna:"#a0522d",silver:"#c0c0c0",skyblue:"#87ceeb",slateblue:"#6a5acd",slategray:"#708090",slategrey:"#708090",snow:"#fffafa",springgreen:"#00ff7f",steelblue:"#4682b4",tan:"#d2b48c",teal:"#008080",thistle:"#d8bfd8",tomato:"#ff6347",turquoise:"#40e0d0",violet:"#ee82ee",wheat:"#f5deb3",white:"#ffffff",whitesmoke:"#f5f5f5",yellow:"#ffff00",yellowgreen:"#9acd32"},decode:function(h){var g=arguments.length;for(var l=g-1;l>=0;l--){if(arguments[l]===undefined){g--}}var k=arguments;if(!h){return null}if(g==1&&d(h)){return h}var j=null;if(typeof h=="string"){var o=1;if(g==2){o=k[1]}var n=e.CSS[h.toLowerCase()];if(n!==undefined){h=n}var m=h.match(f);if(m){vals=h.match(b);if(!vals||!vals.length||vals.length!=4){return null}j={r:a(vals[1]),g:a(vals[2]),b:a(vals[3]),a:o}}}else{if(typeof h=="number"){if(g>=3){j={r:k[0],g:k[1],b:k[2],a:1};if(g>=4){j.a*=k[3]}}else{if(g>=1){j={r:k[0],g:k[0],b:k[0],a:1};if(g==2){j.a*=k[1]}}}}}return j},validate:function(g){if(!g||typeof g!="string"){return false}if(e.CSS[g.toLowerCase()]!==undefined){return true}if(g.match(f)){return true}return false},mix:function(h,g,k){var j=e.decode(h);var i=e.decode(g)},blend:function(g,j){j=(j!==undefined)?Math.max(0,Math.min(1,j)):1;var h=e.decode(g);if(!h){return null}if(j==1){return g}var h=g;if(typeof g=="string"){h=e.decode(g)}var i=objcopy(h);i.a*=j;return nano("rgba({r},{g},{b},{a})",i)},encode:function(g){if(!d(g)){g=e.decode(g);if(!d(g)){return null}}if(g.a==1){return nano("#{r}{g}{b}",{r:c(g.r),g:c(g.g),b:c(g.b)})}else{return nano("rgba({r},{g},{b},{a})",g)}}};return e})();
  /* easing.js */  var Easing=(function(){var a={linear:function(f,e,h,g){return h*(f/g)+e},quadin:function(f,e,h,g){return h*(f/=g)*f+e},quadout:function(f,e,h,g){return -h*(f/=g)*(f-2)+e},quadinout:function(f,e,h,g){if((f/=g/2)<1){return h/2*f*f+e}return -h/2*((--f)*(f-2)-1)+e},cubicin:function(f,e,h,g){return h*(f/=g)*f*f+e},cubicout:function(f,e,h,g){return h*((f=f/g-1)*f*f+1)+e},cubicinout:function(f,e,h,g){if((f/=g/2)<1){return h/2*f*f*f+e}return h/2*((f-=2)*f*f+2)+e},quartin:function(f,e,h,g){return h*(f/=g)*f*f*f+e},quartout:function(f,e,h,g){return -h*((f=f/g-1)*f*f*f-1)+e},quartinout:function(f,e,h,g){if((f/=g/2)<1){return h/2*f*f*f*f+e}return -h/2*((f-=2)*f*f*f-2)+e},quintin:function(f,e,h,g){return h*(f/=g)*f*f*f*f+e},quintout:function(f,e,h,g){return h*((f=f/g-1)*f*f*f*f+1)+e},quintinout:function(f,e,h,g){if((f/=g/2)<1){return h/2*f*f*f*f*f+e}return h/2*((f-=2)*f*f*f*f+2)+e},sinein:function(f,e,h,g){return -h*Math.cos(f/g*(Math.PI/2))+h+e},sineout:function(f,e,h,g){return h*Math.sin(f/g*(Math.PI/2))+e},sineinout:function(f,e,h,g){return -h/2*(Math.cos(Math.PI*f/g)-1)+e},expoin:function(f,e,h,g){return(f==0)?e:h*Math.pow(2,10*(f/g-1))+e},expoout:function(f,e,h,g){return(f==g)?e+h:h*(-Math.pow(2,-10*f/g)+1)+e},expoinout:function(f,e,h,g){if(f==0){return e}if(f==g){return e+h}if((f/=g/2)<1){return h/2*Math.pow(2,10*(f-1))+e}return h/2*(-Math.pow(2,-10*--f)+2)+e},circin:function(f,e,h,g){return -h*(Math.sqrt(1-(f/=g)*f)-1)+e},circout:function(f,e,h,g){return h*Math.sqrt(1-(f=f/g-1)*f)+e},circinout:function(f,e,h,g){if((f/=g/2)<1){return -h/2*(Math.sqrt(1-f*f)-1)+e}return h/2*(Math.sqrt(1-(f-=2)*f)+1)+e},elasticin:function(g,e,k,j){var h=1.70158;var i=0;var f=k;if(g==0){return e}if((g/=j)==1){return e+k}if(!i){i=j*0.3}if(f<Math.abs(k)){f=k;var h=i/4}else{var h=i/(2*Math.PI)*Math.asin(k/f)}return -(f*Math.pow(2,10*(g-=1))*Math.sin((g*j-h)*(2*Math.PI)/i))+e},elasticout:function(g,e,k,j){var h=1.70158;var i=0;var f=k;if(g==0){return e}if((g/=j)==1){return e+k}if(!i){i=j*0.3}if(f<Math.abs(k)){f=k;var h=i/4}else{var h=i/(2*Math.PI)*Math.asin(k/f)}return f*Math.pow(2,-10*g)*Math.sin((g*j-h)*(2*Math.PI)/i)+k+e},elasticinout:function(g,e,k,j){var h=1.70158;var i=0;var f=k;if(g==0){return e}if((g/=j/2)==2){return e+k}if(!i){i=j*(0.3*1.5)}if(f<Math.abs(k)){f=k;var h=i/4}else{var h=i/(2*Math.PI)*Math.asin(k/f)}if(g<1){return -0.5*(f*Math.pow(2,10*(g-=1))*Math.sin((g*j-h)*(2*Math.PI)/i))+e}return f*Math.pow(2,-10*(g-=1))*Math.sin((g*j-h)*(2*Math.PI)/i)*0.5+k+e},backin:function(f,e,i,h,g){if(g==undefined){g=1.70158}return i*(f/=h)*f*((g+1)*f-g)+e},backout:function(f,e,i,h,g){if(g==undefined){g=1.70158}return i*((f=f/h-1)*f*((g+1)*f+g)+1)+e},backinout:function(f,e,i,h,g){if(g==undefined){g=1.70158}if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+e}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+e},bouncein:function(f,e,h,g){return h-a.bounceOut(g-f,0,h,g)+e},bounceout:function(f,e,h,g){if((f/=g)<(1/2.75)){return h*(7.5625*f*f)+e}else{if(f<(2/2.75)){return h*(7.5625*(f-=(1.5/2.75))*f+0.75)+e}else{if(f<(2.5/2.75)){return h*(7.5625*(f-=(2.25/2.75))*f+0.9375)+e}else{return h*(7.5625*(f-=(2.625/2.75))*f+0.984375)+e}}}},bounceinout:function(f,e,h,g){if(f<g/2){return a.bounceIn(f*2,0,h,g)*0.5+e}return a.bounceOut(f*2-g,0,h,g)*0.5+h*0.5+e}};return a})();
  /*  tween.js */  var Tween=function(){var a={};var c=true;var b={init:function(){return b},busy:function(){var e=false;for(var d in a){e=true;break}return e},to:function(g,e,p){var f=new Date().valueOf();var d={};var q={from:{},to:{},colors:{},node:g,t0:f,t1:f+e*1000,dur:e*1000};var o="linear";for(var j in p){if(j=="easing"){var h=p[j].toLowerCase();if(h in Easing){o=h}continue}else{if(j=="delay"){var m=(p[j]||0)*1000;q.t0+=m;q.t1+=m;continue}}if(Colors.validate(p[j])){q.colors[j]=[Colors.decode(g.data[j]),Colors.decode(p[j]),p[j]];d[j]=true}else{q.from[j]=(g.data[j]!=undefined)?g.data[j]:p[j];q.to[j]=p[j];d[j]=true}}q.ease=Easing[o];if(a[g._id]===undefined){a[g._id]=[]}a[g._id].push(q);if(a.length>1){for(var l=a.length-2;l>=0;l++){var n=a[l];for(var j in n.to){if(j in d){delete n.to[j]}else{d[j]=true}}for(var j in n.colors){if(j in d){delete n.colors[j]}else{d[j]=true}}if($.isEmptyObject(n.colors)&&$.isEmptyObject(n.to)){a.splice(l,1)}}}c=false},interpolate:function(e,h,i,g){g=(g||"").toLowerCase();var d=Easing.linear;if(g in Easing){d=Easing[g]}var f=d(e,0,1,1);if(Colors.validate(h)&&Colors.validate(i)){return lerpRGB(f,h,i)}else{if(!isNaN(h)){return lerpNumber(f,h,i)}else{if(typeof h=="string"){return(f<0.5)?h:i}}}},tick:function(){var f=true;for(var d in a){f=false;break}if(f){return}var e=new Date().valueOf();$.each(a,function(i,h){var g=false;$.each(h,function(p,t){var o=t.ease((e-t.t0),0,1,t.dur);o=Math.min(1,o);var r=t.from;var s=t.to;var j=t.colors;var l=t.node.data;var m=(o==1);for(var n in s){switch(typeof s[n]){case"number":l[n]=lerpNumber(o,r[n],s[n]);if(n=="alpha"){l[n]=Math.max(0,Math.min(1,l[n]))}break;case"string":if(m){l[n]=s[n]}break}}for(var n in j){if(m){l[n]=j[n][2]}else{var q=lerpRGB(o,j[n][0],j[n][1]);l[n]=Colors.encode(q)}}if(m){t.completed=true;g=true}});if(g){a[i]=$.map(h,function(j){if(!j.completed){return j}});if(a[i].length==0){delete a[i]}}});c=$.isEmptyObject(a);return c}};return b.init()};var lerpNumber=function(a,c,b){return c+a*(b-c)};var lerpRGB=function(b,d,c){b=Math.max(Math.min(b,1),0);var a={};$.each("rgba".split(""),function(e,f){a[f]=Math.round(d[f]+b*(c[f]-d[f]))});return a};

  arbor = (typeof(arbor)!=='undefined') ? arbor : {}
  $.extend(arbor, {
    // not really user-serviceable; use the ParticleSystem’s .tween* methods instead
    Tween:Tween,
    
    // immutable object with useful methods
    colors:{
      CSS:Colors.CSS,           // dictionary: {colorname:#fef2e2,...}
      validate:Colors.validate, // ƒ(str) -> t/f
      decode:Colors.decode,     // ƒ(hexString_or_cssColor) -> {r,g,b,a}
      encode:Colors.encode,     // ƒ({r,g,b,a}) -> hexOrRgbaString
      blend:Colors.blend        // ƒ(color, opacity) -> rgbaString
    }
  })
  
})(this.jQuery)




 

//
//  arbor-graphics.js
//  canvas fructose
//
//  Copyright (c) 2011 Samizdat Drafting Co.
// 
//  Permission is hereby granted, free of charge, to any person
//  obtaining a copy of this software and associated documentation
//  files (the "Software"), to deal in the Software without
//  restriction, including without limitation the rights to use,
//  copy, modify, merge, publish, distribute, sublicense, and/or sell
//  copies of the Software, and to permit persons to whom the
//  Software is furnished to do so, subject to the following
//  conditions:
// 
//  The above copyright notice and this permission notice shall be
//  included in all copies or substantial portions of the Software.
// 
//  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
//  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
//  OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
//  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
//  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
//  WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
//  FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
//  OTHER DEALINGS IN THE SOFTWARE.
//

(function($){

  /*        etc.js */  var trace=function(msg){if(typeof(window)=="undefined"||!window.console){return}var len=arguments.length;var args=[];for(var i=0;i<len;i++){args.push("arguments["+i+"]")}eval("console.log("+args.join(",")+")")};var dirname=function(a){var b=a.replace(/^\/?(.*?)\/?$/,"$1").split("/");b.pop();return"/"+b.join("/")};var basename=function(b){var c=b.replace(/^\/?(.*?)\/?$/,"$1").split("/");var a=c.pop();if(a==""){return null}else{return a}};var _ordinalize_re=/(\d)(?=(\d\d\d)+(?!\d))/g;var ordinalize=function(a){var b=""+a;if(a<11000){b=(""+a).replace(_ordinalize_re,"$1,")}else{if(a<1000000){b=Math.floor(a/1000)+"k"}else{if(a<1000000000){b=(""+Math.floor(a/1000)).replace(_ordinalize_re,"$1,")+"m"}}}return b};var nano=function(a,b){return a.replace(/\{([\w\-\.]*)}/g,function(f,c){var d=c.split("."),e=b[d.shift()];$.each(d,function(){if(e.hasOwnProperty(this)){e=e[this]}else{e=f}});return e})};var objcopy=function(a){if(a===undefined){return undefined}if(a===null){return null}if(a.parentNode){return a}switch(typeof a){case"string":return a.substring(0);break;case"number":return a+0;break;case"boolean":return a===true;break}var b=($.isArray(a))?[]:{};$.each(a,function(d,c){b[d]=objcopy(c)});return b};var objmerge=function(d,b){d=d||{};b=b||{};var c=objcopy(d);for(var a in b){c[a]=b[a]}return c};var objcmp=function(e,c,d){if(!e||!c){return e===c}if(typeof e!=typeof c){return false}if(typeof e!="object"){return e===c}else{if($.isArray(e)){if(!($.isArray(c))){return false}if(e.length!=c.length){return false}}else{var h=[];for(var f in e){if(e.hasOwnProperty(f)){h.push(f)}}var g=[];for(var f in c){if(c.hasOwnProperty(f)){g.push(f)}}if(!d){h.sort();g.sort()}if(h.join(",")!==g.join(",")){return false}}var i=true;$.each(e,function(a){var b=objcmp(e[a],c[a]);i=i&&b;if(!i){return false}});return i}};var objkeys=function(b){var a=[];$.each(b,function(d,c){if(b.hasOwnProperty(d)){a.push(d)}});return a};var objcontains=function(c){if(!c||typeof c!="object"){return false}for(var b=1,a=arguments.length;b<a;b++){if(c.hasOwnProperty(arguments[b])){return true}}return false};var uniq=function(b){var a=b.length;var d={};for(var c=0;c<a;c++){d[b[c]]=true}return objkeys(d)};var arbor_path=function(){var a=$("script").map(function(b){var c=$(this).attr("src");if(!c){return}if(c.match(/arbor[^\/\.]*.js|dev.js/)){return c.match(/.*\//)||"/"}});if(a.length>0){return a[0]}else{return null}};
  /*     colors.js */  var Colors=(function(){var f=/#[0-9a-f]{6}/i;var b=/#(..)(..)(..)/;var c=function(h){var g=h.toString(16);return(g.length==2)?g:"0"+g};var a=function(g){return parseInt(g,16)};var d=function(g){if(!g||typeof g!="object"){return false}var h=objkeys(g).sort().join("");if(h=="abgr"){return true}};var e={CSS:{aliceblue:"#f0f8ff",antiquewhite:"#faebd7",aqua:"#00ffff",aquamarine:"#7fffd4",azure:"#f0ffff",beige:"#f5f5dc",bisque:"#ffe4c4",black:"#000000",blanchedalmond:"#ffebcd",blue:"#0000ff",blueviolet:"#8a2be2",brown:"#a52a2a",burlywood:"#deb887",cadetblue:"#5f9ea0",chartreuse:"#7fff00",chocolate:"#d2691e",coral:"#ff7f50",cornflowerblue:"#6495ed",cornsilk:"#fff8dc",crimson:"#dc143c",cyan:"#00ffff",darkblue:"#00008b",darkcyan:"#008b8b",darkgoldenrod:"#b8860b",darkgray:"#a9a9a9",darkgrey:"#a9a9a9",darkgreen:"#006400",darkkhaki:"#bdb76b",darkmagenta:"#8b008b",darkolivegreen:"#556b2f",darkorange:"#ff8c00",darkorchid:"#9932cc",darkred:"#8b0000",darksalmon:"#e9967a",darkseagreen:"#8fbc8f",darkslateblue:"#483d8b",darkslategray:"#2f4f4f",darkslategrey:"#2f4f4f",darkturquoise:"#00ced1",darkviolet:"#9400d3",deeppink:"#ff1493",deepskyblue:"#00bfff",dimgray:"#696969",dimgrey:"#696969",dodgerblue:"#1e90ff",firebrick:"#b22222",floralwhite:"#fffaf0",forestgreen:"#228b22",fuchsia:"#ff00ff",gainsboro:"#dcdcdc",ghostwhite:"#f8f8ff",gold:"#ffd700",goldenrod:"#daa520",gray:"#808080",grey:"#808080",green:"#008000",greenyellow:"#adff2f",honeydew:"#f0fff0",hotpink:"#ff69b4",indianred:"#cd5c5c",indigo:"#4b0082",ivory:"#fffff0",khaki:"#f0e68c",lavender:"#e6e6fa",lavenderblush:"#fff0f5",lawngreen:"#7cfc00",lemonchiffon:"#fffacd",lightblue:"#add8e6",lightcoral:"#f08080",lightcyan:"#e0ffff",lightgoldenrodyellow:"#fafad2",lightgray:"#d3d3d3",lightgrey:"#d3d3d3",lightgreen:"#90ee90",lightpink:"#ffb6c1",lightsalmon:"#ffa07a",lightseagreen:"#20b2aa",lightskyblue:"#87cefa",lightslategray:"#778899",lightslategrey:"#778899",lightsteelblue:"#b0c4de",lightyellow:"#ffffe0",lime:"#00ff00",limegreen:"#32cd32",linen:"#faf0e6",magenta:"#ff00ff",maroon:"#800000",mediumaquamarine:"#66cdaa",mediumblue:"#0000cd",mediumorchid:"#ba55d3",mediumpurple:"#9370d8",mediumseagreen:"#3cb371",mediumslateblue:"#7b68ee",mediumspringgreen:"#00fa9a",mediumturquoise:"#48d1cc",mediumvioletred:"#c71585",midnightblue:"#191970",mintcream:"#f5fffa",mistyrose:"#ffe4e1",moccasin:"#ffe4b5",navajowhite:"#ffdead",navy:"#000080",oldlace:"#fdf5e6",olive:"#808000",olivedrab:"#6b8e23",orange:"#ffa500",orangered:"#ff4500",orchid:"#da70d6",palegoldenrod:"#eee8aa",palegreen:"#98fb98",paleturquoise:"#afeeee",palevioletred:"#d87093",papayawhip:"#ffefd5",peachpuff:"#ffdab9",peru:"#cd853f",pink:"#ffc0cb",plum:"#dda0dd",powderblue:"#b0e0e6",purple:"#800080",red:"#ff0000",rosybrown:"#bc8f8f",royalblue:"#4169e1",saddlebrown:"#8b4513",salmon:"#fa8072",sandybrown:"#f4a460",seagreen:"#2e8b57",seashell:"#fff5ee",sienna:"#a0522d",silver:"#c0c0c0",skyblue:"#87ceeb",slateblue:"#6a5acd",slategray:"#708090",slategrey:"#708090",snow:"#fffafa",springgreen:"#00ff7f",steelblue:"#4682b4",tan:"#d2b48c",teal:"#008080",thistle:"#d8bfd8",tomato:"#ff6347",turquoise:"#40e0d0",violet:"#ee82ee",wheat:"#f5deb3",white:"#ffffff",whitesmoke:"#f5f5f5",yellow:"#ffff00",yellowgreen:"#9acd32"},decode:function(h){var g=arguments.length;for(var l=g-1;l>=0;l--){if(arguments[l]===undefined){g--}}var k=arguments;if(!h){return null}if(g==1&&d(h)){return h}var j=null;if(typeof h=="string"){var o=1;if(g==2){o=k[1]}var n=e.CSS[h.toLowerCase()];if(n!==undefined){h=n}var m=h.match(f);if(m){vals=h.match(b);if(!vals||!vals.length||vals.length!=4){return null}j={r:a(vals[1]),g:a(vals[2]),b:a(vals[3]),a:o}}}else{if(typeof h=="number"){if(g>=3){j={r:k[0],g:k[1],b:k[2],a:1};if(g>=4){j.a*=k[3]}}else{if(g>=1){j={r:k[0],g:k[0],b:k[0],a:1};if(g==2){j.a*=k[1]}}}}}return j},validate:function(g){if(!g||typeof g!="string"){return false}if(e.CSS[g.toLowerCase()]!==undefined){return true}if(g.match(f)){return true}return false},mix:function(h,g,k){var j=e.decode(h);var i=e.decode(g)},blend:function(g,j){j=(j!==undefined)?Math.max(0,Math.min(1,j)):1;var h=e.decode(g);if(!h){return null}if(j==1){return g}var h=g;if(typeof g=="string"){h=e.decode(g)}var i=objcopy(h);i.a*=j;return nano("rgba({r},{g},{b},{a})",i)},encode:function(g){if(!d(g)){g=e.decode(g);if(!d(g)){return null}}if(g.a==1){return nano("#{r}{g}{b}",{r:c(g.r),g:c(g.g),b:c(g.b)})}else{return nano("rgba({r},{g},{b},{a})",g)}}};return e})();
  /* primitives.js */  var Primitives=function(c,f,g){var b=function(i,m,j,l,k){this.x=i;this.y=m;this.w=j;this.h=l;this.style=(k!==undefined)?k:{}};b.prototype={draw:function(h){this._draw(h)},_draw:function(i,n,j,l,k){if(objcontains(i,"stroke","fill","width")){k=i}if(this.x!==undefined){i=this.x,n=this.y,j=this.w,l=this.h;k=objmerge(this.style,k)}k=objmerge(f,k);if(!k.stroke&&!k.fill){return}var m=0.5522848;ox=(j/2)*m,oy=(l/2)*m,xe=i+j,ye=n+l,xm=i+j/2,ym=n+l/2;c.save();c.beginPath();c.moveTo(i,ym);c.bezierCurveTo(i,ym-oy,xm-ox,n,xm,n);c.bezierCurveTo(xm+ox,n,xe,ym-oy,xe,ym);c.bezierCurveTo(xe,ym+oy,xm+ox,ye,xm,ye);c.bezierCurveTo(xm-ox,ye,i,ym+oy,i,ym);c.closePath();if(k.fill!==null){if(k.alpha!==undefined){c.fillStyle=Colors.blend(k.fill,k.alpha)}else{c.fillStyle=Colors.encode(k.fill)}c.fill()}if(k.stroke!==null){c.strokeStyle=Colors.encode(k.stroke);if(!isNaN(k.width)){c.lineWidth=k.width}c.stroke()}c.restore()}};var a=function(i,n,j,l,m,k){if(objcontains(m,"stroke","fill","width")){k=m;m=0}this.x=i;this.y=n;this.w=j;this.h=l;this.r=(m!==undefined)?m:0;this.style=(k!==undefined)?k:{}};a.prototype={draw:function(h){this._draw(h)},_draw:function(j,o,k,m,n,l){if(objcontains(n,"stroke","fill","width","alpha")){l=n;n=0}else{if(objcontains(j,"stroke","fill","width","alpha")){l=j}}if(this.x!==undefined){j=this.x,o=this.y,k=this.w,m=this.h;l=objmerge(this.style,l)}l=objmerge(f,l);if(!l.stroke&&!l.fill){return}var i=(n>0);c.save();c.beginPath();c.moveTo(j+n,o);c.lineTo(j+k-n,o);if(i){c.quadraticCurveTo(j+k,o,j+k,o+n)}c.lineTo(j+k,o+m-n);if(i){c.quadraticCurveTo(j+k,o+m,j+k-n,o+m)}c.lineTo(j+n,o+m);if(i){c.quadraticCurveTo(j,o+m,j,o+m-n)}c.lineTo(j,o+n);if(i){c.quadraticCurveTo(j,o,j+n,o)}if(l.fill!==null){if(l.alpha!==undefined){c.fillStyle=Colors.blend(l.fill,l.alpha)}else{c.fillStyle=Colors.encode(l.fill)}c.fill()}if(l.stroke!==null){c.strokeStyle=Colors.encode(l.stroke);if(!isNaN(l.width)){c.lineWidth=l.width}c.stroke()}c.restore()}};var e=function(i,l,h,j,k){if(k!==undefined||typeof j=="number"){this.points=[{x:i,y:l},{x:h,y:j}];this.style=k||{}}else{if($.isArray(i)){this.points=i;this.style=l||{}}else{this.points=[i,l];this.style=h||{}}}};e.prototype={draw:function(h){if(this.points.length<2){return}var j=[];if(!$.isArray(this.points[0])){j.push(this.points)}else{j=this.points}c.save();c.beginPath();$.each(j,function(n,m){c.moveTo(m[0].x+0.5,m[0].y+0.5);$.each(m,function(o,p){if(o==0){return}c.lineTo(p.x+0.5,p.y+0.5)})});var i=$.extend(objmerge(f,this.style),h);if(i.closed){c.closePath()}if(i.fill!==undefined){var l=Colors.decode(i.fill,(i.alpha!==undefined)?i.alpha:1);if(l){c.fillStyle=Colors.encode(l)}c.fill()}if(i.stroke!==undefined){var k=Colors.decode(i.stroke,(i.alpha!==undefined)?i.alpha:1);if(k){c.strokeStyle=Colors.encode(k)}if(!isNaN(i.width)){c.lineWidth=i.width}c.stroke()}c.restore()}};var d=function(i,h,l,k){var j=Colors.decode(i,h,l,k);if(j){this.r=j.r;this.g=j.g;this.b=j.b;this.a=j.a}};d.prototype={toString:function(){return Colors.encode(this)},blend:function(){trace("blend",this.r,this.g,this.b,this.a)}};return{_Oval:b,_Rect:a,_Color:d,_Path:e}};
  /*   graphics.js */  var Graphics=function(c){var h=$(c);var q=$(h).get(0).getContext("2d");var i=null;var l="rgb";var e="origin";var m={};var p={background:null,fill:null,stroke:null,width:0};var b={};var g={font:"sans-serif",size:12,align:"left",color:Colors.decode("black"),alpha:1,baseline:"ideographic"};var k=[];var o=Primitives(q,p,g);var f=o._Oval;var n=o._Rect;var d=o._Color;var a=o._Path;var j={init:function(){if(!q){return null}return j},size:function(s,r){if(!isNaN(s)&&!isNaN(r)){h.attr({width:s,height:r})}return{width:h.attr("width"),height:h.attr("height")}},clear:function(r,u,s,t){if(arguments.length<4){r=0;u=0;s=h.attr("width");t=h.attr("height")}q.clearRect(r,u,s,t);if(p.background!==null){q.save();q.fillStyle=Colors.encode(p.background);q.fillRect(r,u,s,t);q.restore()}},background:function(s,r,v,t){if(s==null){p.background=null;return null}var u=Colors.decode(s,r,v,t);if(u){p.background=u;j.clear()}},noFill:function(){p.fill=null},fill:function(s,r,v,t){if(arguments.length==0){return p.fill}else{if(arguments.length>0){var u=Colors.decode(s,r,v,t);p.fill=u;q.fillStyle=Colors.encode(u)}}},noStroke:function(){p.stroke=null;q.strokeStyle=null},stroke:function(s,r,v,u){if(arguments.length==0&&p.stroke!==null){return p.stroke}else{if(arguments.length>0){var t=Colors.decode(s,r,v,u);p.stroke=t;q.strokeStyle=Colors.encode(t)}}},strokeWidth:function(r){if(r===undefined){return q.lineWidth}q.lineWidth=p.width=r},Color:function(r){return new d(r)},drawStyle:function(s){if(arguments.length==0){return objcopy(p)}if(arguments.length==2){var r=arguments[0];var v=arguments[1];if(typeof r=="string"&&typeof v=="object"){var u={};if(v.color!==undefined){var t=Colors.decode(v.color);if(t){u.color=t}}$.each("background fill stroke width".split(" "),function(w,x){if(v[x]!==undefined){u[x]=v[x]}});if(!$.isEmptyObject(u)){m[r]=u}}return}if(arguments.length==1&&m[arguments[0]]!==undefined){s=m[arguments[0]]}if(s.width!==undefined){p.width=s.width}q.lineWidth=p.width;$.each("background fill stroke",function(y,x){if(s[x]!==undefined){if(s[x]===null){p[x]=null}else{var w=Colors.decode(s[x]);if(w){p[x]=w}}}});q.fillStyle=p.fill;q.strokeStyle=p.stroke},textStyle:function(s){if(arguments.length==0){return objcopy(g)}if(arguments.length==2){var r=arguments[0];var v=arguments[1];if(typeof r=="string"&&typeof v=="object"){var u={};if(v.color!==undefined){var t=Colors.decode(v.color);if(t){u.color=t}}$.each("font size align baseline alpha".split(" "),function(w,x){if(v[x]!==undefined){u[x]=v[x]}});if(!$.isEmptyObject(u)){b[r]=u}}return}if(arguments.length==1&&b[arguments[0]]!==undefined){s=b[arguments[0]]}if(s.font!==undefined){g.font=s.font}if(s.size!==undefined){g.size=s.size}q.font=nano("{size}px {font}",g);if(s.align!==undefined){q.textAlign=g.align=s.align}if(s.baseline!==undefined){q.textBaseline=g.baseline=s.baseline}if(s.alpha!==undefined){g.alpha=s.alpha}if(s.color!==undefined){var t=Colors.decode(s.color);if(t){g.color=t}}if(g.color){var t=Colors.blend(g.color,g.alpha);if(t){q.fillStyle=t}}},text:function(s,r,z,v){if(arguments.length>=3&&!isNaN(r)){v=v||{};v.x=r;v.y=z}else{if(arguments.length==2&&typeof(r)=="object"){v=r}else{v=v||{}}}var u=objmerge(g,v);q.save();if(u.align!==undefined){q.textAlign=u.align}if(u.baseline!==undefined){q.textBaseline=u.baseline}if(u.font!==undefined&&!isNaN(u.size)){q.font=nano("{size}px {font}",u)}var w=(u.alpha!==undefined)?u.alpha:g.alpha;var t=(u.color!==undefined)?u.color:g.color;q.fillStyle=Colors.blend(t,w);if(w>0){q.fillText(s,Math.round(u.x),u.y)}q.restore()},textWidth:function(r,t){t=objmerge(g,t||{});q.save();q.font=nano("{size}px {font}",t);var s=q.measureText(r).width;q.restore();return s},Rect:function(s,A,t,v,z,u){return new n(s,A,t,v,z,u)},rect:function(s,A,t,v,z,u){n.prototype._draw(s,A,t,v,z,u)},Oval:function(r,v,s,u,t){return new f(r,v,s,u,t)},oval:function(r,v,s,u,t){t=t||{};f.prototype._draw(r,v,s,u,t)},line:function(s,v,r,t,u){var w=new a(s,v,r,t);w.draw(u)},lines:function(s,u,r,t){if(typeof t=="number"){k.push([{x:s,y:u},{x:r,y:t}])}else{k.push([s,u])}},drawLines:function(r){var s=new a(k);s.draw(r);k=[]}};return j.init()};

  arbor = (typeof(arbor)!=='undefined') ? arbor : {}
  $.extend(arbor, {
    // object constructor (don't use ‘new’, just call it)
    Graphics:function(ctx){ return Graphics(ctx) },

    // useful methods for dealing with the r/g/b
    colors:{
      CSS:Colors.CSS,           // dict:{colorname:"#fef2e2", ...}
      validate:Colors.validate, // ƒ(str) -> t/f
      decode:Colors.decode,     // ƒ(hexString_or_cssColor) -> {r,g,b,a}
      encode:Colors.encode,     // ƒ({r,g,b,a}) -> hexOrRgbaString
      blend:Colors.blend        // ƒ(color, opacity) -> rgbaString
    }
  })
  
})(this.jQuery)
(function($){
  // var trace = function(msg){
  // if (typeof(window)=='undefined' || !window.console) return
  // var len = arguments.length, args = [];
  // for (var i=0; i<len; i++) args.push("arguments["+i+"]")
  // eval("console.log("+args.join(",")+")")
  // }
  Renderer = function(elt){
    var dom = $(elt)
    var canvas = dom.get(0)
    var ctx = canvas.getContext("2d");
    var gfx = arbor.Graphics(canvas)
    var sys = null
    var _vignette = null
    var selected = null,
        nearest = null,
        _mouseP = null;
    
    var that = {
      init:function(pSystem){
        sys = pSystem
        sys.screen({size:{width:dom.width(), height:dom.height()},
        padding:[36,60,36,60]})
        $(window).resize(that.resize)
        that.resize()
        that._initMouseHandling()
        //study to back button feature
        if (document.referrer.match(/echolalia|atlas|halfviz/)){
          // if we got here by hitting the back button in one of the demos,
          // start with the demos section pre-selected
          that.switchSection('demos')
        }
      },
      resize:function(){
        canvas.width = dom.width()
        canvas.height = .75* dom.height()
        sys.screen({size:{width:canvas.width, height:canvas.height}})
        _vignette = null
        that.redraw()
      },
      redraw:function(){
        gfx.clear()
        sys.eachEdge(function(edge, p1, p2){
          if (edge.source.data.alpha * edge.target.data.alpha == 0) return
            gfx.line(p1, p2, {stroke:"#b2b19d", width:2, alpha:edge.target.data.alpha})
          })
        sys.eachNode(function(node, pt){
          var w = Math.max(20, 5+gfx.textWidth(node.data.label) )
          var font_size= 8
          if (node.data.alpha===0) return
          if (node.data.shape=='dot'){
            gfx.oval(pt.x-w/2, pt.y-w/2, w, w, {fill:node.data.color, alpha:node.data.alpha})
            gfx.text(node.data.label, pt.x, pt.y+7, {color:"white", align:"center", font:"Arial", size:font_size})
            gfx.text(node.data.label, pt.x, pt.y+7, {color:"white", align:"center", font:"Arial", size:font_size})
          }else{
            gfx.rect(pt.x-w/2, pt.y-8, w, 20, 4, {fill:node.data.color, alpha:node.data.alpha})
            gfx.text(node.data.label, pt.x, pt.y+9, {color:"white", align:"center", font:"Arial", size:font_size})
            gfx.text(node.data.label, pt.x, pt.y+9, {color:"white", align:"center", font:"Arial", size:font_size})
          }
        })
        that._drawVignette()
      },
      _drawVignette:function(){
        var w = canvas.width
        var h = canvas.height
        var r = 20
        if (!_vignette){
          var top = ctx.createLinearGradient(0,0,0,r)
          top.addColorStop(0, "#e0e0e0")
          top.addColorStop(.7, "rgba(255,255,255,0)")
          var bot = ctx.createLinearGradient(0,h-r,0,h)
          bot.addColorStop(0, "rgba(255,255,255,0)")
          bot.addColorStop(1, "white")
          _vignette = {top:top, bot:bot}
        }
        // top
        //ctx.fillStyle = _vignette.top
        //ctx.fillRect(0,0, w,r)
        // bot
        //ctx.fillStyle = _vignette.bot
        //ctx.fillRect(0,h-r, w,r)
      },
      switchMode:function(e){
        if (e.mode=='hidden'){
        dom.stop(true).fadeTo(e.dt,0, function(){
          if (sys) sys.stop()
          $(this).hide()
        })
      }else if (e.mode=='visible'){
        dom.stop(true).css('opacity',0).show().fadeTo(e.dt,1,function(){
          that.resize()
        })
        if (sys) sys.start()
      }
      },
      switchSection:function(newSection){
        //var parent = sys.getEdgesFrom(newSection)[0].source
        var children = $.map(sys.getEdgesFrom(newSection), function(edge){
          return edge.target
        })
        sys.eachNode(function(node){
        if (node.data.shape=='dot') return // skip all but leafnodes
        var nowVisible = ($.inArray(node, children)>=0)
        var newAlpha = (nowVisible) ? 1 : 0
        var dt = (nowVisible) ? .5 : .5
        sys.tweenNode(node, dt, {alpha:newAlpha})
        //if (newAlpha==1){
        //  node.p.x = parent.p.x + .05*Math.random() - .025
        //  node.p.y = parent.p.y + .05*Math.random() - .025
        //  node.tempMass = .001
        //}
        })
      },
      _initMouseHandling:function(){
        // no-nonsense drag and drop (thanks springy.js)
        selected = null;
        nearest = null;
        var dragged = null;
        var oldmass = 1
        var _section = null
        var handler = {
          moved:function(e){
            var pos = $(canvas).offset();
            _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
            nearest = sys.nearest(_mouseP);
            if (!nearest.node) return false
            if (nearest.node.data.shape!='dot'){
              selected = (nearest.distance < 50) ? nearest : null
              //commented because we don't need the linkable class
              //if (selected){
              //  dom.addClass('linkable')
              //  window.status = selected.node.data.link.replace(/^\//,"http://"+window.location.host+"/").replace(/^#/,'')
              //}
              //else{
              //  dom.removeClass('linkable')
              //  window.status = ''
              //}
            //hack to explode all nodes
            //}else if ($.inArray(nearest.node.name, ['arbor.js','code','docs','demos']) >=0 ){
            }else{
              if (nearest.node.name!=_section){
                _section = nearest.node.name
                that.switchSection(_section)
              }
              dom.removeClass('linkable')
              window.status = ''
            }
            return false
          },
          clicked:function(e){
            var pos = $(canvas).offset();
            _mouseP = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
            nearest = dragged = sys.nearest(_mouseP);
            //if (nearest && selected && nearest.node===selected.node){
            //  var link = selected.node.data.link
            //  if (link.match(/^#/)){
            //    $(that).trigger({type:"navigate", path:link.substr(1)})
            //  }else{
            //    window.location = link
            //  }
            //  return false
            //}
            if (dragged && dragged.node !== null) dragged.node.fixed = true
            $(canvas).unbind('mousemove', handler.moved);
            $(canvas).bind('mousemove', handler.dragged)
            $(window).bind('mouseup', handler.dropped)
            return false
          },
          dragged:function(e){
            var old_nearest = nearest && nearest.node._id
            var pos = $(canvas).offset();
            var s = arbor.Point(e.pageX-pos.left, e.pageY-pos.top)
            if (!nearest) return
            if (dragged !== null && dragged.node !== null){
              var p = sys.fromScreen(s)
              dragged.node.p = p
            }
            return false
          },
          dropped:function(e){
            if (dragged===null || dragged.node===undefined) return
            if (dragged.node !== null) dragged.node.fixed = false
            dragged.node.tempMass = 1000
            dragged = null;
            // selected = null
            $(canvas).unbind('mousemove', handler.dragged)
            $(window).unbind('mouseup', handler.dropped)
            $(canvas).bind('mousemove', handler.moved);
            _mouseP = null
            return false
          }
        }
        $(canvas).mousedown(handler.clicked);
        $(canvas).mousemove(handler.moved);
      }
    }
    return that
  }
  Nav = function(elt){
    var dom = $(elt)
    var _path = null
    var that = {
    init:function(){
      $(window).bind('popstate',that.navigate)
      dom.find('> a').click(that.back)
      $('.more').one('click',that.more)
      $('#docs dl:not(.datastructure) dt').click(that.reveal)
      that.update()
      return that
    },
    more:function(e){
      $(this).removeAttr('href').addClass('less').html('&nbsp;').siblings().fadeIn()
      $(this).next('h2').find('a').one('click', that.less)
      return false
    },
    less:function(e){
      var more = $(this).closest('h2').prev('a')
      $(this).closest('h2').prev('a')
      .nextAll().fadeOut(function(){
        $(more).text('creation & use').removeClass('less').attr('href','#')
      })
      $(this).closest('h2').prev('a').one('click',that.more)
      return false
    },
    reveal:function(e){
      $(this).next('dd').fadeToggle('fast')
      return false
    },
    back:function(){
      _path = "/"
      if (window.history && window.history.pushState){
        window.history.pushState({path:_path}, "", _path);
      }
      that.update()
      return false
    },
    navigate:function(e){
      var oldpath = _path
      if (e.type=='navigate'){
        _path = e.path
        if (window.history && window.history.pushState){
          window.history.pushState({path:_path}, "", _path);
        }else{
          that.update()
        }
      }else if (e.type=='popstate'){
        var state = e.originalEvent.state || {}
        _path = state.path || window.location.pathname.replace(/^\//,'')
      }
      if (_path != oldpath) that.update()
    },
    update:function(){
      var dt = 'fast'
      if (_path===null){
        // this is the original page load. don't animate anything just jump
        // to the proper state
        _path = window.location.pathname.replace(/^\//,'')
        dt = 0
        dom.find('p').css('opacity',0).show().fadeTo('slow',1)
      }
      switch (_path){
        case '':
        case '/':
        dom.find('p').text('a graph visualization library using web workers and jQuery')
        dom.find('> a').removeClass('active').attr('href','#')
        $('#docs').fadeTo('fast',0, function(){
          $(this).hide()
          $(that).trigger({type:'mode', mode:'visible', dt:dt})
        })
        //document.title = "arbor.js"
        break
        case 'introduction':
        case 'reference':
        $(that).trigger({type:'mode', mode:'hidden', dt:dt})
        dom.find('> p').text(_path)
        dom.find('> a').addClass('active').attr('href','#')
        $('#docs').stop(true).css({opacity:0}).show().delay(333).fadeTo('fast',1)
        $('#docs').find(">div").hide()
        $('#docs').find('#'+_path).show()
        //document.title = "arbor.js » " + _path
        break
      }
    }
    }
    return that
  }
  $(document).ready(function(){
    //startArbor();
  })
})(this.jQuery)

function startArbor(){
  var colour = {
    root_page:"#990033",
    research_page:"#FFCC00",
    static_page:"#669966",
    trait_page:"#F1921A",
  }
  
  
  var data = {
    nodes:{
      HOME:{
        color:colour.root_page, shape:'dot', radius:39, alpha:1, label: 'HOMEPAGE', link: '/'},
      LR:{
        color:colour.research_page, shape:'dot', radius:30, alpha:1, label: 'LANDRACE', link: '/browse-landrace'},
      CWR:{
        color:colour.research_page, shape:'dot', radius:40, alpha:1, label: "CWR", link: '/browse-cwr'},
     TRAIT: {
        color:colour.trait_page, shape:'dot', radius:35, alpha:1, label: 'TRAIT', link: '/browse-trait'},
     ABOUT: {
        color:colour.static_page, shape:'dot', radius:35, alpha:1, label: 'ABOUT', link: '/about'},
     CONTACT: {
        color:colour.static_page, shape:'dot', radius:35, alpha:1, label: 'CONTACT', link: '/contact'},
     DATABASE: {
        color:colour.static_page, shape:'dot', radius:35, alpha:1, label: 'DATABASE', link: '/database'},
     DATABASE1: {
        color:colour.static_page, radius:35, alpha:0, label: 'DATASETS', link: '/datasets'},
     DATABASE2: {
        color:colour.static_page, radius:35, alpha:0, label: 'DATA SEARCH', link: '/data-search'},
     DATABASE3: {
        color:colour.static_page, radius:35, alpha:0, label: 'DOWNLOAD DATA', link: '/download-data'},
     DATABASE4: {
        color:colour.static_page, radius:35, alpha:0, label: 'REQUEST DATA', link: '/request-data'},
     DATABASE5: {
        color:colour.static_page, radius:35, alpha:0, label: 'CONTRIBUTE DATA', link: '/contribute-data'},
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
  sys.renderer = Renderer("#arbor_homepage")
  sys.graft(data)
  
  var nav = Nav("#nav")
  $(sys.renderer).bind('navigate', nav.navigate)
  $(nav).bind('mode', sys.renderer.switchMode)
  nav.init()
  $("#arbor_homepage").mousedown(function(e){
   var pos = $(this).offset();
   var p = arbor.Point(e.pageX-pos.left, e.pageY-pos.top);
   selected = sys.nearest(p);
   
   $(this).mouseup(function(e){
     var new_p= arbor.Point(e.pageX-pos.left, e.pageY-pos.top);
     if(p.x == new_p.x && p.y == new_p.y)
       if(selected.node.data.link)
         window.location = selected.node.data.link;
   });
 });
}