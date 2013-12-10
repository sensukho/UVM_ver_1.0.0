/***********************
* Acciones de composición de Adobe Edge Animate
*
* Editar este archivo con precaución, teniendo cuidado de conservar 
* las firmas de función y los comentarios que comienzan con "Edge" para mantener la 
* capacidad de interactuar con estas acciones en Adobe Edge Animate
*
***********************/
(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // los alias más comunes para las clases de Edge

   //Edge symbol: 'stage'
   (function(symbolName) {
      
      
      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 0, function(sym, e) {
         sym.stop("maspremios");

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 1250, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_maspremiosbtn}", "mouseover", function(sym, e) {
         // reproducir la línea de tiempo en la posición determinada (ms o etiqueta)
         sym.play("maspremios2");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 2000, function(sym, e) {
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_maspremios_btn2}", "mouseover", function(sym, e) {
         // reproducir la línea de tiempo en la posición determinada (ms o etiqueta)
         sym.play("maspremios2");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_maspremios_btn2}", "mouseout", function(sym, e) {
         // reproducir la línea de tiempo en la posición determinada (ms o etiqueta)
         sym.play("maspremios4");
         

      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

   //=========================================================
   
   //Edge symbol: 'maspremiosbtn'
   (function(symbolName) {   
   
   })("maspremiosbtn");
   //Edge symbol end:'maspremiosbtn'

})(jQuery, AdobeEdge, "EDGE-3582624");