/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

var fonts = {};


var resources = [
];
var symbols = {
"stage": {
   version: "2.0.1",
   minimumCompatibleVersion: "2.0.0",
   build: "2.0.1.268",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
         dom: [
         {
            id:'premios_grafico',
            type:'image',
            rect:['8px','6px','103px','234px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"premios_grafico.png",'0px','0px']
         },
         {
            id:'maspremiosbtn',
            type:'rect',
            rect:['88','37','auto','auto','auto','auto']
         },
         {
            id:'maspremios_btn2',
            type:'image',
            rect:['89px','37px','22px','163px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"maspremios_btn2.png",'0px','0px']
         }],
         symbolInstances: [
         {
            id:'maspremiosbtn',
            symbolName:'maspremiosbtn'
         }
         ]
      },
   states: {
      "Base State": {
         "${_premios_grafico}": [
            ["style", "left", '26px'],
            ["style", "top", '6px']
         ],
         "${_maspremiosbtn}": [
            ["style", "left", '89px']
         ],
         "${_maspremios_btn2}": [
            ["style", "top", '37px'],
            ["style", "opacity", '1'],
            ["style", "left", '89px']
         ],
         "${_Stage}": [
            ["color", "background-color", 'rgba(255,255,255,1)'],
            ["style", "width", '111px'],
            ["style", "height", '246px'],
            ["style", "overflow", 'hidden']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 2000,
         autoPlay: true,
         labels: {
            "maspremios": 0,
            "maspremios2": 1000,
            "maspremios3": 1250,
            "maspremios4": 1750,
            "maspremios5": 2000
         },
         timeline: [
            { id: "eid10", tween: [ "style", "${_maspremios_btn2}", "opacity", '1', { fromValue: '1'}], position: 0, duration: 0 },
            { id: "eid12", tween: [ "style", "${_maspremios_btn2}", "opacity", '0', { fromValue: '1'}], position: 1000, duration: 250 },
            { id: "eid22", tween: [ "style", "${_maspremios_btn2}", "opacity", '1', { fromValue: '0.000000'}], position: 1750, duration: 250 },
            { id: "eid17", tween: [ "style", "${_premios_grafico}", "left", '8px', { fromValue: '26px'}], position: 1000, duration: 250 },
            { id: "eid20", tween: [ "style", "${_premios_grafico}", "left", '26px', { fromValue: '8px'}], position: 1750, duration: 250 }         ]
      }
   }
},
"maspremiosbtn": {
   version: "2.0.1",
   minimumCompatibleVersion: "2.0.0",
   build: "2.0.1.268",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
   dom: [
   {
      id: 'maspremios_btn_hover',
      type: 'image',
      rect: ['1px','0px','22px','163px','auto','auto'],
      fill: ['rgba(0,0,0,0)','images/maspremios_btn_hover.png','0px','0px']
   }],
   symbolInstances: [
   ]
   },
   states: {
      "Base State": {
         "${_maspremios_btn_hover}": [
            ["style", "top", '0px'],
            ["style", "opacity", '1'],
            ["style", "left", '0px']
         ],
         "${symbolSelector}": [
            ["style", "height", '163px'],
            ["style", "width", '22px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 1250,
         autoPlay: true,
         timeline: [
            { id: "eid2", tween: [ "style", "${_maspremios_btn_hover}", "opacity", '1', { fromValue: '1'}], position: 1000, duration: 0 },
            { id: "eid3", tween: [ "style", "${_maspremios_btn_hover}", "opacity", '1', { fromValue: '1'}], position: 1250, duration: 0 }         ]
      }
   }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "EDGE-3582624");
