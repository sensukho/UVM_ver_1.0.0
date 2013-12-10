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
            id:'arrow',
            type:'rect',
            rect:['0','0','auto','auto','auto','auto']
         }],
         symbolInstances: [
         {
            id:'arrow',
            symbolName:'arrow'
         }
         ]
      },
   states: {
      "Base State": {
         "${_Stage}": [
            ["color", "background-color", 'rgba(255,255,255,0.00)'],
            ["style", "width", '155px'],
            ["style", "height", '70px'],
            ["style", "overflow", 'hidden']
         ],
         "${_arrow}": [
            ["style", "top", '1px'],
            ["style", "opacity", '0'],
            ["style", "left", '12px'],
            ["style", "width", '155px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 1518,
         autoPlay: true,
         timeline: [
            { id: "eid15", tween: [ "style", "${_arrow}", "left", '1px', { fromValue: '12px'}], position: 0, duration: 95, easing: "easeInOutBack" },
            { id: "eid8", tween: [ "style", "${_arrow}", "left", '93px', { fromValue: '1px'}], position: 95, duration: 655, easing: "easeInOutBack" },
            { id: "eid20", tween: [ "style", "${_arrow}", "left", '1px', { fromValue: '4px'}], position: 768, duration: 95, easing: "easeInOutBack" },
            { id: "eid21", tween: [ "style", "${_arrow}", "left", '93px', { fromValue: '1px'}], position: 863, duration: 655, easing: "easeInOutBack" },
            { id: "eid1", tween: [ "style", "${_arrow}", "top", '1px', { fromValue: '1px'}], position: 0, duration: 0 },
            { id: "eid17", tween: [ "style", "${_arrow}", "top", '1px', { fromValue: '1px'}], position: 768, duration: 0 },
            { id: "eid11", tween: [ "style", "${_arrow}", "opacity", '1', { fromValue: '0'}], position: 0, duration: 95, easing: "easeInOutBack" },
            { id: "eid13", tween: [ "style", "${_arrow}", "opacity", '0', { fromValue: '1'}], position: 685, duration: 65, easing: "easeInOutBack" },
            { id: "eid18", tween: [ "style", "${_arrow}", "opacity", '1', { fromValue: '0'}], position: 768, duration: 95, easing: "easeInOutBack" },
            { id: "eid19", tween: [ "style", "${_arrow}", "opacity", '1', { fromValue: '1'}], position: 1518, duration: 0, easing: "easeInOutBack" },
            { id: "eid14", tween: [ "style", "${_Stage}", "width", '169px', { fromValue: '155px'}], position: 0, duration: 0, easing: "easeInOutBack" },
            { id: "eid24", tween: [ "color", "${_Stage}", "background-color", 'rgba(255,255,255,0.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,0.00)'}], position: 0, duration: 0, easing: "easeInOutBack" },
            { id: "eid23", tween: [ "color", "${_Stage}", "background-color", 'rgba(255,255,255,0.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(255,255,255,0.00)'}], position: 1518, duration: 0, easing: "easeInOutBack" },
            { id: "eid16", tween: [ "style", "${_arrow}", "width", '169px', { fromValue: '155px'}], position: 863, duration: 655, easing: "easeInOutBack" }         ]
      }
   }
},
"arrow": {
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
      id: 'arrow5',
      type: 'image',
      rect: ['0px','0px','61px','67px','auto','auto'],
      fill: ['rgba(0,0,0,0)','images/arrow5.png','0px','0px']
   }],
   symbolInstances: [
   ]
   },
   states: {
      "Base State": {
         "${_arrow5}": [
            ["style", "left", '0px'],
            ["style", "top", '0px']
         ],
         "${symbolSelector}": [
            ["style", "height", '67px'],
            ["style", "width", '61px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 0,
         autoPlay: true,
         timeline: [
         ]
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
})(jQuery, AdobeEdge, "EDGE-1500767");
