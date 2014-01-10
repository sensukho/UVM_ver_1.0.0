var DNS = DNS || {};


DNS.EventBus = {
    eventPrefix : '.dns_event',

    sub : function(event, handler) {
        $(this).bind(event + DNS.EventBus.eventPrefix, function(e, data) {
            e.stopPropagation();

            if (handler) {
                e.data = data;
                handler(e);
            }

        });
    },


    // NOTE: Second param can't be an array, or trigger will expect the handler to take more than one 
    // optional param 
    pub : function(event, data) {
        // second param for trigger is used as a data object for the event handler 
        $(this).trigger(event + DNS.EventBus.eventPrefix, data);
    },


    unsub : function(event, handler) {
        $(this).unbind(event + DNS.EventBus.eventPrefix, handler);
    }

};



// Helper for ServiceResult returned by DNS service
DNS.ServiceResult = {
    success : function(data) {
        return /^success$/.test(data.status);
    },

    failed : function(data) {
        return /^failed$/.test(data.status);
    }

};



DNS.Helper = {
    formatCurrency : function(sSymbol, vValue, decimal) {
       aDigits = vValue.toFixed(decimal).split(".");
       aDigits[0] = aDigits[0].split("").reverse().join("").replace(/(\d{3})(?=\d)/g, "$1,").split("").reverse().join("");
       return sSymbol + aDigits.join(".");
    }
};

function capitalizeFirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Get value of querystring variables
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function getHashVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('#') + 1).split('&');
    for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

/*
 * custom jquery funcs 
 */
( function($) {

    // callback for multiple animations

    $.waitForNAnimations = function(numberOfAnimations,callback) {
        var count = 0;
        function cb() {
            count++;
            if ( count == numberOfAnimations) {
                count = 0;
                callback();
            }
        }
        return cb;
    };


    // Scroll to an ID

    $.fn.anchorScroll = function(anchorId, alwaysUseFixWrap){    
        if($(anchorId).length === 0) return;
        
        var fixedOffset = $('.header-fixed-container').outerHeight();

        $('html, body').animate({scrollTop: ($(anchorId).offset().top - fixedOffset)},'slow');
    };


    // Expand paragraph below links with class

    $.fn.textExpand = function(){
        $(this).click( function() {
            if ($(this).hasClass('down')) {
                $(this).removeClass('down').next('p').fadeOut().slideUp();
            } else {
                $(this).addClass('down').next('p').slideDown().fadeIn();
            }
        });
    };


    // animations 
    $.fn.applyOpacityFixForIE = function() {
        if (!jQuery.support.opacity) {
            // doesn't support css opacity(IE6-9), so set it using jquery 
            return this.css('opacity', 0.0);
        } else {
            return this;
        }
    };


    $.fn.toggleWidthFade = function(duration, cb) {
      return this.animate({width: 'toggle', opacity: 'toggle'}, duration || 1000, function() {
        if(cb) cb();
      });
    };


    // set of fadeIn/Out function that only changes opacity so that elements keeps orginal size
    $.fn.dnsFadeIn = function(duration, cb) {
        duration = duration || 1000;
        var self = this;

        return this.stop(true,true).animate( { opacity : 1 }, duration, function() {
            self.removeClass('invis').css('opacity','');
            if (cb) cb();
        });
    };


    $.fn.dnsFadeOut = function(duration, cb) {
        duration = duration || 1000;
        var self = this;

        return this.stop(true,true).animate( { opacity : 0 }, duration, function() {
            self.addClass('invis');
            if (cb) cb();
        });

    };


    $.fn.dnsToggleFade = function(duration, cb) {
        duration = duration || 1000;

        if (this.hasClass('invis')) {
            return this.dnsFadeIn(duration, cb);
        } else {
            return this.dnsFadeOut(duration, cb);
        }
    };


/***************************
* DYNRESIZE Version: 1.0.1 *
***************************/
var dynVar = {};

$.fn.hasScrollBar = function() {

    var current      = $(this)[0],
        hasScrollBar = false,
        inH          = $(this).innerHeight(),
        scH          = current.scrollHeight,
        inW          = $(this).innerWidth(),
        scW          = current.scrollWidth;

    if (( inH < scH && dynVar.lastHeight != scH ) || ( inW < scW && dynVar.lastWidth != scW )) {
        hasScrollBar = true;
    }
    
    return hasScrollBar;

    dynVar.lastWidth  = scW;
    dynVar.lastHeight = scH;
};

$.fn.dynResize = function( options ) {

    var options = $.extend({
        maxSize: 22,
        minSize: 5,
        unit: 'px'
    },options);

    return this.each(function(){
        var that = $(this),
            size = parseInt(that.css('font-size'));

        that.css({ 'white-space' : 'pre' });

        if (that.hasScrollBar()){
            while( that.hasScrollBar() && size > options.minSize ) {
                size-=1;
                that.css({ 'font-size':size+options.unit });
            }
            return;
        }
        else {
            while( !that.hasScrollBar() && size <= options.maxSize ) {
                size+=1;
                that.css({ 'font-size' : size+options.unit });
            }
            return;
        }
    });
};
/* End DYNRESIZE */

})(jQuery);
