!function(t,e){"object"==typeof exports&&"object"==typeof module?module.exports=e():"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?exports._vantaEffect=e():t._vantaEffect=e()}("undefined"!=typeof self?self:this,function(){return function(t){var e={};function i(s){if(e[s])return e[s].exports;var o=e[s]={i:s,l:!1,exports:{}};return t[s].call(o.exports,o,o.exports,i),o.l=!0,o.exports}return i.m=t,i.c=e,i.d=function(t,e,s){i.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:s})},i.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},i.t=function(t,e){if(1&e&&(t=i(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var s=Object.create(null);if(i.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)i.d(s,o,function(e){return t[e]}.bind(null,o));return s},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="",i(i.s=10)}({0:function(t,e,i){"use strict";function s(t,e){for(var i in e)e.hasOwnProperty(i)&&(t[i]=e[i]);return t}function o(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||window.innerWidth<600}i.d(e,"c",function(){return s}),i.d(e,"d",function(){return o}),i.d(e,"h",function(){return n}),i.d(e,"g",function(){return r}),i.d(e,"f",function(){return h}),i.d(e,"e",function(){return a}),i.d(e,"a",function(){return l}),i.d(e,"b",function(){return c}),Number.prototype.clamp=function(t,e){return Math.min(Math.max(this,t),e)};const n=t=>t[Math.floor(Math.random()*t.length)];function r(t,e){return null==t&&(t=0),null==e&&(e=1),t+Math.random()*(e-t)}function h(t,e){return null==t&&(t=0),null==e&&(e=1),Math.floor(t+Math.random()*(e-t+1))}var a=t=>document.querySelector(t);const l=t=>"number"==typeof t?"#"+("00000"+t.toString(16)).slice(-6):t,c=(t,e=1)=>{const i=l(t),s=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(i),o=s?{r:parseInt(s[1],16),g:parseInt(s[2],16),b:parseInt(s[3],16)}:null;return"rgba("+o.r+","+o.g+","+o.b+","+e+")"}},1:function(t,e,i){"use strict";i.d(e,"a",function(){return r});var s=i(0);const o="object"==typeof window,n=o&&window.THREE||{};o&&!window.VANTA&&(window.VANTA={});const r=o&&window.VANTA||{};r.register=(t,e)=>r[t]=t=>new e(t),r.version="0.5.2";var h=function(){return Array.prototype.unshift.call(arguments,"[VANTA]"),console.error.apply(this,arguments)};r.VantaBase=class{constructor(t={}){if(!o)return!1;var e,i,a,l;if(r.current=this,this.windowMouseMoveWrapper=this.windowMouseMoveWrapper.bind(this),this.windowTouchWrapper=this.windowTouchWrapper.bind(this),this.resize=this.resize.bind(this),this.animationLoop=this.animationLoop.bind(this),this.restart=this.restart.bind(this),this.options=Object(s.c)({},this.defaultOptions),t instanceof HTMLElement||"string"==typeof t?Object(s.c)(this.options,{el:t}):Object(s.c)(this.options,t),this.el=this.options.el,null==this.el)h('Instance needs "el" param!');else if(!(this.options.el instanceof HTMLElement||(l=this.el,this.el=Object(s.e)(l),this.el)))return void h("Cannot find element",l);for(a=0;a<this.el.children.length;a++)e=this.el.children[a],"static"===getComputedStyle(e).position&&(e.style.position="relative"),"auto"===getComputedStyle(e).zIndex&&(e.style.zIndex=1);"static"===getComputedStyle(this.el).position&&(this.el.style.position="relative"),this.initThree(),this.setSize(),this.uniforms={u_time:{type:"f",value:1},u_resolution:{type:"v2",value:new n.Vector2(1,1)},u_mouse:{type:"v2",value:new n.Vector2(0,0)}};try{this.init()}catch(t){return i=t,h("Init error"),h(i),this.el.removeChild(this.renderer.domElement),void(this.options.backgroundColor&&(console.log("[VANTA] Falling back to backgroundColor"),this.el.style.background=Object(s.a)(this.options.backgroundColor)))}window.addEventListener("resize",this.resize),this.resize(),this.animationLoop(),window.addEventListener("scroll",this.windowMouseMoveWrapper),window.addEventListener("mousemove",this.windowMouseMoveWrapper),window.addEventListener("touchstart",this.windowTouchWrapper),window.addEventListener("touchmove",this.windowTouchWrapper)}applyCanvasStyles(t,e={}){Object(s.c)(t.style,{position:"absolute",zIndex:0,top:0,left:0,background:""}),Object(s.c)(t.style,e),t.classList.add("vanta-canvas")}initThree(){n.WebGLRenderer?(this.renderer=new n.WebGLRenderer({alpha:!0,antialias:!0}),this.el.appendChild(this.renderer.domElement),this.applyCanvasStyles(this.renderer.domElement),isNaN(this.options.backgroundAlpha)&&(this.options.backgroundAlpha=1),this.scene=new n.Scene):console.warn("[VANTA] No THREE defined on window")}windowMouseMoveWrapper(t){const e=this.renderer.domElement.getBoundingClientRect(),i=t.clientX-e.left,s=t.clientY-e.top;i>=0&&s>=0&&i<=e.width&&s<=e.height&&(this.mouseX=i,this.mouseY=s,this.options.mouseEase||this.triggerMouseMove(i,s))}windowTouchWrapper(t){if(1===t.touches.length){const e=this.renderer.domElement.getBoundingClientRect(),i=t.touches[0].clientX-e.left,s=t.touches[0].clientY-e.top;i>=0&&s>=0&&i<=e.width&&s<=e.height&&(this.mouseX=i,this.mouseY=s,this.options.mouseEase||this.triggerMouseMove(i,s))}}triggerMouseMove(t,e){this.uniforms&&(this.uniforms.u_mouse.value.x=t/this.scale,this.uniforms.u_mouse.value.y=e/this.scale);const i=t/this.width,s=e/this.height;"function"==typeof this.onMouseMove&&this.onMouseMove(i,s)}setSize(){this.scale||(this.scale=1),Object(s.d)()&&this.options.scaleMobile?this.scale=this.options.scaleMobile:this.options.scale&&(this.scale=this.options.scale),this.width=this.el.offsetWidth||window.innerWidth,this.height=this.el.offsetHeight||window.innerHeight}resize(){var t,e;this.setSize(),null!=(t=this.camera)&&(t.aspect=this.width/this.height),null!=(e=this.camera)&&"function"==typeof e.updateProjectionMatrix&&e.updateProjectionMatrix(),this.renderer&&(this.renderer.setSize(this.width,this.height),this.renderer.setPixelRatio(window.devicePixelRatio/this.scale)),"function"==typeof this.onResize&&this.onResize()}isOnscreen(){const t=this.el.offsetHeight,e=this.el.getBoundingClientRect(),i=window.pageYOffset||(document.documentElement||document.body.parentNode||document.body).scrollTop,s=e.top+i;return s-window.innerHeight<=i&&i<=s+t}animationLoop(){return this.t||(this.t=0),this.t+=1,this.t2||(this.t2=0),this.t2+=this.options.speed||1,this.uniforms&&(this.uniforms.u_time.value=.016667*this.t2),this.options.mouseEase&&(this.mouseEaseX=this.mouseEaseX||this.mouseX||0,this.mouseEaseY=this.mouseEaseY||this.mouseY||0,Math.abs(this.mouseEaseX-this.mouseX)+Math.abs(this.mouseEaseY-this.mouseY)>.1&&(this.mouseEaseX=this.mouseEaseX+.05*(this.mouseX-this.mouseEaseX),this.mouseEaseY=this.mouseEaseY+.05*(this.mouseY-this.mouseEaseY),this.triggerMouseMove(this.mouseEaseX,this.mouseEaseY))),(this.isOnscreen()||this.options.forceAnimate)&&("function"==typeof this.onUpdate&&this.onUpdate(),this.scene&&this.camera&&(this.renderer.render(this.scene,this.camera),this.renderer.setClearColor(this.options.backgroundColor,this.options.backgroundAlpha)),this.fps&&this.fps.update&&this.fps.update()),this.req=window.requestAnimationFrame(this.animationLoop)}restart(){if(this.scene)for(;this.scene.children.length;)this.scene.remove(this.scene.children[0]);"function"==typeof this.onRestart&&this.onRestart(),this.init()}init(){"function"==typeof this.onInit&&this.onInit()}destroy(){"function"==typeof this.onDestroy&&this.onDestroy(),window.removeEventListener("touchstart",this.windowTouchWrapper),window.removeEventListener("touchmove",this.windowTouchWrapper),window.removeEventListener("scroll",this.windowMouseMoveWrapper),window.removeEventListener("mousemove",this.windowMouseMoveWrapper),window.removeEventListener("resize",this.resize),window.cancelAnimationFrame(this.req),this.renderer&&(this.el.removeChild(this.renderer.domElement),this.renderer=null,this.scene=null)}},e.b=r.VantaBase},10:function(t,e,i){"use strict";i.r(e);var s=i(1),o=i(0);const n="object"==typeof window,r=n&&window.THREE||{};r.Color&&r.Color.prototype&&(r.Color.prototype.getBrightness=function(){return.299*this.r+.587*this.g+.114*this.b});class h extends s.b{static initClass(){this.prototype.defaultOptions={color:16727937,color2:16777215,size:1,backgroundColor:2299196,points:10,maxDistance:20,spacing:15,showDots:!0}}genPoint(t,e,i){let s;if(this.points||(this.points=[]),this.options.showDots){const t=new r.SphereGeometry(.25,12,12),e=new r.MeshLambertMaterial({color:this.options.color});s=new r.Mesh(t,e)}else s=new r.Object3D;return this.cont.add(s),s.ox=t,s.oy=e,s.oz=i,s.position.set(t,e,i),s.r=0,this.points.push(s)}onInit(){this.cont=new r.Group,this.cont.position.set(-50,-20,0),this.scene.add(this.cont);let t=this.options.points,{spacing:e}=this.options;const i=t*t*2;this.linePositions=new Float32Array(i*i*3),this.lineColors=new Float32Array(i*i*3);const s=new r.Color(this.options.color).getBrightness(),n=new r.Color(this.options.backgroundColor).getBrightness();this.blending=s>n?"additive":"subtractive";const h=new r.BufferGeometry;h.addAttribute("position",new r.BufferAttribute(this.linePositions,3).setDynamic(!0)),h.addAttribute("color",new r.BufferAttribute(this.lineColors,3).setDynamic(!0)),h.computeBoundingSphere(),h.setDrawRange(0,0);const a=new r.LineBasicMaterial({vertexColors:r.VertexColors,blending:"additive"===this.blending?r.AdditiveBlending:null,transparent:!0});this.linesMesh=new r.LineSegments(h,a),this.cont.add(this.linesMesh);for(let i=0;i<=t;i++)for(let s=0;s<=t;s++){const o=0,n=(i-t/2)*e;let r=(s-t/2)*e;this.genPoint(n,o,r)}this.camera=new r.PerspectiveCamera(20,this.width/this.height,.01,1e4),this.camera.position.set(50,100,150),this.scene.add(this.camera);const l=new r.AmbientLight(16777215,.75);this.scene.add(l),this.spot=new r.SpotLight(16777215,1),this.spot.position.set(0,200,0),this.spot.distance=400,this.spot.target=this.cont,this.scene.add(this.spot),this.cont2=new r.Group,this.cont2.position.set(0,15,0),this.scene.add(this.cont2);const c=new r.LineBasicMaterial({color:this.options.color2}),u=new r.Geometry;for(let t=0;t<80;t++){var p=Object(o.g)(18,24),d=p+Object(o.g)(1,6),w=Object(o.g)(-1,1),m=Math.sqrt(1-w*w),f=Object(o.g)(0,2*Math.PI),g=Math.sin(f)*m,y=Math.cos(f)*m;u.vertices.push(new r.Vector3(y*p,g*p,w*p)),u.vertices.push(new r.Vector3(y*d,g*d,w*d))}this.linesMesh2=new r.LineSegments(u,c),this.linesMesh2.position.set(0,0,0),this.cont2.add(this.linesMesh2);const M=new r.LineBasicMaterial({color:this.options.color2,linewidth:2}),v=new r.Geometry;v.vertices.push(new r.Vector3(0,30,0)),v.vertices.push(new r.Vector3(0,-30,0));for(let t=0;t<4;t++){let e=.15*Math.cos(t/4*Math.PI*2),i=.15*Math.sin(t/4*Math.PI*2),s=[17.9,12,8,5,3,2,1.5,1.1,.8,.6,.45,.3,.2,.1,.05,.03,.02,.01];for(let t=0;t<s.length;t++){let o=s[t],n=6*(t+1);v.vertices.push(new r.Vector3(e*n,o,i*n)),v.vertices.push(new r.Vector3(e*n,-o,i*n))}}this.linesMesh3=new r.LineSegments(v,M),this.linesMesh3.position.set(0,0,0),this.cont2.add(this.linesMesh3);const b=new r.LineBasicMaterial({color:this.options.color}),C=new r.SphereGeometry(18*this.options.size,18,14),E=new r.EdgesGeometry(C);this.sphere=new r.LineSegments(E,b),this.sphere.position.set(0,0,0),this.cont2.add(this.sphere),this.cont2.rotation.x=-.25}onUpdate(){let t;null!=this.helper&&this.helper.update(),null!=this.controls&&this.controls.update();const e=this.camera;Math.abs(e.tx-e.position.x)>.01&&(t=e.tx-e.position.x,e.position.x+=.02*t),Math.abs(e.ty-e.position.y)>.01&&(t=e.ty-e.position.y,e.position.y+=.02*t),n&&window.innerWidth<480?e.lookAt(new r.Vector3(-10,0,0)):n&&window.innerWidth<720?e.lookAt(new r.Vector3(-20,0,0)):e.lookAt(new r.Vector3(-40,0,0));let i=0,s=0,o=0;const h=new r.Color(this.options.backgroundColor),a=new r.Color(this.options.color),l=a.clone().sub(h);this.rayCaster&&this.rayCaster.setFromCamera(new r.Vector2(this.rcMouseX,this.rcMouseY),this.camera),this.linesMesh2&&(this.linesMesh2.rotation.z+=.002,this.linesMesh2.rotation.x+=8e-4,this.linesMesh2.rotation.y+=5e-4),this.sphere&&(this.sphere.rotation.y+=.002,this.linesMesh3.rotation.y-=.004);for(let t=0;t<this.points.length;t++){var c;const e=this.points[t],n=(this.rayCaster?this.rayCaster.ray.distanceToPoint(e.position):1e3).clamp(5,15);e.scale.z=(.25*(15-n)).clamp(1,100),e.scale.x=e.scale.y=e.scale.z,e.position.y=2*Math.sin(e.position.x/10+.01*this.t+e.position.z/10*.5);for(let n=t;n<this.points.length;n++){const t=this.points[n],p=e.position.x-t.position.x,d=e.position.y-t.position.y,w=e.position.z-t.position.z;if((c=Math.sqrt(p*p+d*d+w*w))<this.options.maxDistance){var u;let n=2*(1-c/this.options.maxDistance);n=n.clamp(0,1),u="additive"===this.blending?new r.Color(0).lerp(l,n):h.clone().lerp(a,n),this.linePositions[i++]=e.position.x,this.linePositions[i++]=e.position.y,this.linePositions[i++]=e.position.z,this.linePositions[i++]=t.position.x,this.linePositions[i++]=t.position.y,this.linePositions[i++]=t.position.z,this.lineColors[s++]=u.r,this.lineColors[s++]=u.g,this.lineColors[s++]=u.b,this.lineColors[s++]=u.r,this.lineColors[s++]=u.g,this.lineColors[s++]=u.b,o++}}}return this.linesMesh.geometry.setDrawRange(0,2*o),this.linesMesh.geometry.attributes.position.needsUpdate=!0,this.linesMesh.geometry.attributes.color.needsUpdate=!0,.001*this.t}onMouseMove(t,e){const i=this.camera;i.oy||(i.oy=i.position.y,i.ox=i.position.x,i.oz=i.position.z);const s=Math.atan2(i.oz,i.ox),o=Math.sqrt(i.oz*i.oz+i.ox*i.ox),n=s+1.5*(t-.5)*(this.options.mouseCoeffX||1);i.tz=o*Math.sin(n),i.tx=o*Math.cos(n),i.ty=i.oy+80*(e-.5)*(this.options.mouseCoeffY||1),this.rayCaster,this.rcMouseX=2*t-1,this.rcMouseY=2*-t+1}onRestart(){this.scene.remove(this.linesMesh),this.points=[]}}h.initClass(),e.default=s.a.register("GLOBE",h)}})});
