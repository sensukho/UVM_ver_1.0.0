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
            id:'ganadores_btn_hover',
            type:'image',
            rect:['0','0','22px','163px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"ganadores_btn_hover.png",'0px','0px']
         },
         {
            id:'ganadores_btn',
            type:'image',
            rect:['0','0','22px','163px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"ganadores_btn.png",'0px','0px']
         }],
         symbolInstances: [

         ]
      },
   states: {
      "Base State": {
         "${_Stage}": [
            ["color", "background-color", 'rgba(255,255,255,1)'],
            ["style", "width", '22px'],
            ["style", "height", '165px'],
            ["style", "overflow", 'hidden']
         ],
         "${_ganadores_btn}": [
            ["style", "opacity", '1']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 1250,
         autoPlay: true,
         labels: {
            "masganadores": 0,
            "masganadores2": 500,
            "masganadores3": 750,
            "masganadores4": 1000,
            "masganadores5": 1250
         },
         timeline: [
            { id: "eid1", tween: [ "style", "${_ganadores_btn}", "opacity", '1', { fromValue: '1'}], position: 0, duration: 0 },
            { id: "eid3", tween: [ "style", "${_ganadores_btn}", "opacity", '0', { fromValue: '1'}], position: 500, duration: 250 },
            { id: "eid6", tween: [ "style", "${_ganadores_btn}", "opacity", '1', { fromValue: '0.000000'}], position: 1000, duration: 250 },
            { id: "eid4", tween: [ "gradient", "${_Stage}", "background-image", [270,[['rgba(255,255,255,0)',0],['rgba(255,255,255,0)',100]]], { fromValue: [270,[['rgba(255,255,255,0)',0],['rgba(255,255,255,0)',100]]]}], position: 0, duration: 0 }         ]
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
})(jQuery, AdobeEdge, "EDGE-7791581");
