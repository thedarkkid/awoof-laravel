/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

(function( $, window, document, undefined )
{
	$.fn.doubleTapToGo = function( params )
	{
		if( !( 'ontouchstart' in window ) &&
			!navigator.msMaxTouchPoints &&
			!navigator.userAgent.toLowerCase().match( /windows phone os 7/i ) ) return false;

		this.each( function()
		{
			var curItem = false;
			$( this ).on( 'click', function( e )
			{
				var item = $( this );
				if( item[ 0 ] != curItem[ 0 ] )
				{
					e.preventDefault();
					curItem = item;
				}
			});
			$( document ).on( 'click touchstart MSPointerDown', function( e )
			{
				var resetItem = true,
					parents	  = $( e.target ).parents();

				for( var i = 0; i < parents.length; i++ )
					if( parents[ i ] == curItem[ 0 ] )
						resetItem = false;
				if( resetItem )
					curItem = false;
			});
		});
		return this;
	};
})( jQuery, window, document );

/*-----------------------------------------------------------------------------------
    HOME SIMPLE TEXT SLIDER
/*-----------------------------------------------------------------------------------*/
function MenuExpander () { 
  $('.menu-toggle').click( function() {
      $('nav > ul').toggle(); 
  });
}
$( document ).ready(function() {
  MenuExpander();
  $('nav li:has(ul)').addClass('sub-menu'); 
  $( '.sub-menu > a' ).doubleTapToGo();
});

/*!
Waypoints - 3.1.1
Copyright © 2011-2015 Caleb Troughton
Licensed under the MIT license.
https://github.com/imakewebthings/waypoints/blog/master/licenses.txt
*/
!function(){"use strict";function t(o){if(!o)throw new Error("No options passed to Waypoint constructor");if(!o.element)throw new Error("No element option passed to Waypoint constructor");if(!o.handler)throw new Error("No handler option passed to Waypoint constructor");this.key="waypoint-"+e,this.options=t.Adapter.extend({},t.defaults,o),this.element=this.options.element,this.adapter=new t.Adapter(this.element),this.callback=o.handler,this.axis=this.options.horizontal?"horizontal":"vertical",this.enabled=this.options.enabled,this.triggerPoint=null,this.group=t.Group.findOrCreate({name:this.options.group,axis:this.axis}),this.context=t.Context.findOrCreateByElement(this.options.context),t.offsetAliases[this.options.offset]&&(this.options.offset=t.offsetAliases[this.options.offset]),this.group.add(this),this.context.add(this),i[this.key]=this,e+=1}var e=0,i={};t.prototype.queueTrigger=function(t){this.group.queueTrigger(this,t)},t.prototype.trigger=function(t){this.enabled&&this.callback&&this.callback.apply(this,t)},t.prototype.destroy=function(){this.context.remove(this),this.group.remove(this),delete i[this.key]},t.prototype.disable=function(){return this.enabled=!1,this},t.prototype.enable=function(){return this.context.refresh(),this.enabled=!0,this},t.prototype.next=function(){return this.group.next(this)},t.prototype.previous=function(){return this.group.previous(this)},t.invokeAll=function(t){var e=[];for(var o in i)e.push(i[o]);for(var n=0,r=e.length;r>n;n++)e[n][t]()},t.destroyAll=function(){t.invokeAll("destroy")},t.disableAll=function(){t.invokeAll("disable")},t.enableAll=function(){t.invokeAll("enable")},t.refreshAll=function(){t.Context.refreshAll()},t.viewportHeight=function(){return window.innerHeight||document.documentElement.clientHeight},t.viewportWidth=function(){return document.documentElement.clientWidth},t.adapters=[],t.defaults={context:window,continuous:!0,enabled:!0,group:"default",horizontal:!1,offset:0},t.offsetAliases={"bottom-in-view":function(){return this.context.innerHeight()-this.adapter.outerHeight()},"right-in-view":function(){return this.context.innerWidth()-this.adapter.outerWidth()}},window.Waypoint=t}(),function(){"use strict";function t(t){window.setTimeout(t,1e3/60)}function e(t){this.element=t,this.Adapter=n.Adapter,this.adapter=new this.Adapter(t),this.key="waypoint-context-"+i,this.didScroll=!1,this.didResize=!1,this.oldScroll={x:this.adapter.scrollLeft(),y:this.adapter.scrollTop()},this.waypoints={vertical:{},horizontal:{}},t.waypointContextKey=this.key,o[t.waypointContextKey]=this,i+=1,this.createThrottledScrollHandler(),this.createThrottledResizeHandler()}var i=0,o={},n=window.Waypoint,r=window.onload;e.prototype.add=function(t){var e=t.options.horizontal?"horizontal":"vertical";this.waypoints[e][t.key]=t,this.refresh()},e.prototype.checkEmpty=function(){var t=this.Adapter.isEmptyObject(this.waypoints.horizontal),e=this.Adapter.isEmptyObject(this.waypoints.vertical);t&&e&&(this.adapter.off(".waypoints"),delete o[this.key])},e.prototype.createThrottledResizeHandler=function(){function t(){e.handleResize(),e.didResize=!1}var e=this;this.adapter.on("resize.waypoints",function(){e.didResize||(e.didResize=!0,n.requestAnimationFrame(t))})},e.prototype.createThrottledScrollHandler=function(){function t(){e.handleScroll(),e.didScroll=!1}var e=this;this.adapter.on("scroll.waypoints",function(){(!e.didScroll||n.isTouch)&&(e.didScroll=!0,n.requestAnimationFrame(t))})},e.prototype.handleResize=function(){n.Context.refreshAll()},e.prototype.handleScroll=function(){var t={},e={horizontal:{newScroll:this.adapter.scrollLeft(),oldScroll:this.oldScroll.x,forward:"right",backward:"left"},vertical:{newScroll:this.adapter.scrollTop(),oldScroll:this.oldScroll.y,forward:"down",backward:"up"}};for(var i in e){var o=e[i],n=o.newScroll>o.oldScroll,r=n?o.forward:o.backward;for(var s in this.waypoints[i]){var a=this.waypoints[i][s],l=o.oldScroll<a.triggerPoint,h=o.newScroll>=a.triggerPoint,p=l&&h,u=!l&&!h;(p||u)&&(a.queueTrigger(r),t[a.group.id]=a.group)}}for(var c in t)t[c].flushTriggers();this.oldScroll={x:e.horizontal.newScroll,y:e.vertical.newScroll}},e.prototype.innerHeight=function(){return this.element==this.element.window?n.viewportHeight():this.adapter.innerHeight()},e.prototype.remove=function(t){delete this.waypoints[t.axis][t.key],this.checkEmpty()},e.prototype.innerWidth=function(){return this.element==this.element.window?n.viewportWidth():this.adapter.innerWidth()},e.prototype.destroy=function(){var t=[];for(var e in this.waypoints)for(var i in this.waypoints[e])t.push(this.waypoints[e][i]);for(var o=0,n=t.length;n>o;o++)t[o].destroy()},e.prototype.refresh=function(){var t,e=this.element==this.element.window,i=this.adapter.offset(),o={};this.handleScroll(),t={horizontal:{contextOffset:e?0:i.left,contextScroll:e?0:this.oldScroll.x,contextDimension:this.innerWidth(),oldScroll:this.oldScroll.x,forward:"right",backward:"left",offsetProp:"left"},vertical:{contextOffset:e?0:i.top,contextScroll:e?0:this.oldScroll.y,contextDimension:this.innerHeight(),oldScroll:this.oldScroll.y,forward:"down",backward:"up",offsetProp:"top"}};for(var n in t){var r=t[n];for(var s in this.waypoints[n]){var a,l,h,p,u,c=this.waypoints[n][s],d=c.options.offset,f=c.triggerPoint,w=0,y=null==f;c.element!==c.element.window&&(w=c.adapter.offset()[r.offsetProp]),"function"==typeof d?d=d.apply(c):"string"==typeof d&&(d=parseFloat(d),c.options.offset.indexOf("%")>-1&&(d=Math.ceil(r.contextDimension*d/100))),a=r.contextScroll-r.contextOffset,c.triggerPoint=w+a-d,l=f<r.oldScroll,h=c.triggerPoint>=r.oldScroll,p=l&&h,u=!l&&!h,!y&&p?(c.queueTrigger(r.backward),o[c.group.id]=c.group):!y&&u?(c.queueTrigger(r.forward),o[c.group.id]=c.group):y&&r.oldScroll>=c.triggerPoint&&(c.queueTrigger(r.forward),o[c.group.id]=c.group)}}for(var g in o)o[g].flushTriggers();return this},e.findOrCreateByElement=function(t){return e.findByElement(t)||new e(t)},e.refreshAll=function(){for(var t in o)o[t].refresh()},e.findByElement=function(t){return o[t.waypointContextKey]},window.onload=function(){r&&r(),e.refreshAll()},n.requestAnimationFrame=function(e){var i=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||t;i.call(window,e)},n.Context=e}(),function(){"use strict";function t(t,e){return t.triggerPoint-e.triggerPoint}function e(t,e){return e.triggerPoint-t.triggerPoint}function i(t){this.name=t.name,this.axis=t.axis,this.id=this.name+"-"+this.axis,this.waypoints=[],this.clearTriggerQueues(),o[this.axis][this.name]=this}var o={vertical:{},horizontal:{}},n=window.Waypoint;i.prototype.add=function(t){this.waypoints.push(t)},i.prototype.clearTriggerQueues=function(){this.triggerQueues={up:[],down:[],left:[],right:[]}},i.prototype.flushTriggers=function(){for(var i in this.triggerQueues){var o=this.triggerQueues[i],n="up"===i||"left"===i;o.sort(n?e:t);for(var r=0,s=o.length;s>r;r+=1){var a=o[r];(a.options.continuous||r===o.length-1)&&a.trigger([i])}}this.clearTriggerQueues()},i.prototype.next=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints),o=i===this.waypoints.length-1;return o?null:this.waypoints[i+1]},i.prototype.previous=function(e){this.waypoints.sort(t);var i=n.Adapter.inArray(e,this.waypoints);return i?this.waypoints[i-1]:null},i.prototype.queueTrigger=function(t,e){this.triggerQueues[e].push(t)},i.prototype.remove=function(t){var e=n.Adapter.inArray(t,this.waypoints);e>-1&&this.waypoints.splice(e,1)},i.prototype.first=function(){return this.waypoints[0]},i.prototype.last=function(){return this.waypoints[this.waypoints.length-1]},i.findOrCreate=function(t){return o[t.axis][t.name]||new i(t)},n.Group=i}(),function(){"use strict";function t(t){this.$element=e(t)}var e=window.jQuery,i=window.Waypoint;e.each(["innerHeight","innerWidth","off","offset","on","outerHeight","outerWidth","scrollLeft","scrollTop"],function(e,i){t.prototype[i]=function(){var t=Array.prototype.slice.call(arguments);return this.$element[i].apply(this.$element,t)}}),e.each(["extend","inArray","isEmptyObject"],function(i,o){t[o]=e[o]}),i.adapters.push({name:"jquery",Adapter:t}),i.Adapter=t}(),function(){"use strict";function t(t){return function(){var i=[],o=arguments[0];return t.isFunction(arguments[0])&&(o=t.extend({},arguments[1]),o.handler=arguments[0]),this.each(function(){var n=t.extend({},o,{element:this});"string"==typeof n.context&&(n.context=t(this).closest(n.context)[0]),i.push(new e(n))}),i}}var e=window.Waypoint;window.jQuery&&(window.jQuery.fn.waypoint=t(window.jQuery)),window.Zepto&&(window.Zepto.fn.waypoint=t(window.Zepto))}();



(function($){var defaults={topSpacing:0,bottomSpacing:0,className:'is-sticky',wrapperClassName:'sticky-wrapper',center:false,getWidthFrom:''},$window=$(window),$document=$(document),sticked=[],windowHeight=$window.height(),scroller=function(){var scrollTop=$window.scrollTop(),documentHeight=$document.height(),dwh=documentHeight-windowHeight,extra=(scrollTop>dwh)?dwh-scrollTop:0;for(var i=0;i<sticked.length;i++){var s=sticked[i],elementTop=s.stickyWrapper.offset().top,etse=elementTop-s.topSpacing-extra;if(scrollTop<=etse){if(s.currentTop!==null){s.stickyElement.css('position','').css('top','');s.stickyElement.parent().removeClass(s.className);s.currentTop=null;}}else{var newTop=documentHeight-s.stickyElement.outerHeight()-s.topSpacing-s.bottomSpacing-scrollTop-extra;if(newTop<0){newTop=newTop+s.topSpacing;}else{newTop=s.topSpacing;}if(s.currentTop!=newTop){s.stickyElement.css('position','fixed').css('top',newTop);if(typeof s.getWidthFrom!=='undefined'){s.stickyElement.css('width',$(s.getWidthFrom).width());}s.stickyElement.parent().addClass(s.className);s.currentTop=newTop;}}}},resizer=function(){windowHeight=$window.height();},methods={init:function(options){var o=$.extend(defaults,options);return this.each(function(){var stickyElement=$(this);var stickyId=stickyElement.attr('id');var wrapper=$('<div></div>').attr('id',stickyId+'-sticky-wrapper').addClass(o.wrapperClassName);stickyElement.wrapAll(wrapper);if(o.center){stickyElement.parent().css({width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"});}if(stickyElement.css("float")=="right"){stickyElement.css({"float":"none"}).parent().css({"float":"right"});}var stickyWrapper=stickyElement.parent();stickyWrapper.css('height',stickyElement.outerHeight());sticked.push({topSpacing:o.topSpacing,bottomSpacing:o.bottomSpacing,stickyElement:stickyElement,currentTop:null,stickyWrapper:stickyWrapper,className:o.className,getWidthFrom:o.getWidthFrom});});},update:scroller};if(window.addEventListener){window.addEventListener('scroll',scroller,false);window.addEventListener('resize',resizer,false);}else if(window.attachEvent){window.attachEvent('onscroll',scroller);window.attachEvent('onresize',resizer);}$.fn.sticky=function(method){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else if(typeof method==='object'||!method){return methods.init.apply(this,arguments);}else{$.error('Method '+method+' does not exist on jQuery.sticky');}};$(function(){setTimeout(scroller,0);});})(jQuery);


// Generated by CoffeeScript 1.9.3

/*
jQuery Lighter
Copyright 2015 Kevin Sylvestre
1.3.4
 */

(function() {
  "use strict";
  var $, Animation, Lighter, Slide,
    bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $ = jQuery;

  Animation = (function() {
    function Animation() {}

    Animation.transitions = {
      "webkitTransition": "webkitTransitionEnd",
      "mozTransition": "mozTransitionEnd",
      "oTransition": "oTransitionEnd",
      "transition": "transitionend"
    };

    Animation.transition = function($el) {
      var el, i, len, ref, result, type;
      for (i = 0, len = $el.length; i < len; i++) {
        el = $el[i];
        ref = this.transitions;
        for (type in ref) {
          result = ref[type];
          if (el.style[type] != null) {
            return result;
          }
        }
      }
    };

    Animation.execute = function($el, callback) {
      var transition;
      transition = this.transition($el);
      if (transition != null) {
        return $el.one(transition, callback);
      } else {
        return callback();
      }
    };

    return Animation;

  })();

  Slide = (function() {
    function Slide(url) {
      this.url = url;
    }

    Slide.prototype.type = function() {
      switch (false) {
        case !this.url.match(/\.(webp|jpeg|jpg|jpe|gif|png|bmp)$/i):
          return 'image';
        default:
          return 'unknown';
      }
    };

    Slide.prototype.preload = function(callback) {
      var image;
      image = new Image();
      image.src = this.url;
      return image.onload = (function(_this) {
        return function() {
          _this.dimensions = {
            width: image.width,
            height: image.height
          };
          return callback(_this);
        };
      })(this);
    };

    Slide.prototype.$content = function() {
      return $("<img />").attr({
        src: this.url
      });
    };

    return Slide;

  })();

  Lighter = (function() {
    Lighter.namespace = "lighter";

    Lighter.prototype.defaults = {
      loading: '#{Lighter.namespace}-loading',
      fetched: '#{Lighter.namespace}-fetched',
      padding: 40,
      dimensions: {
        width: 480,
        height: 480
      },
      template: "<div class='" + Lighter.namespace + " " + Lighter.namespace + "-fade'>\n  <div class='" + Lighter.namespace + "-container'>\n    <span class='" + Lighter.namespace + "-content'></span>\n    <a class='" + Lighter.namespace + "-close'>&times;</a>\n    <a class='" + Lighter.namespace + "-prev'>&lsaquo;</a>\n    <a class='" + Lighter.namespace + "-next'>&rsaquo;</a>\n  </div>\n  <div class='" + Lighter.namespace + "-spinner'>\n    <div class='" + Lighter.namespace + "-dot'></div>\n    <div class='" + Lighter.namespace + "-dot'></div>\n    <div class='" + Lighter.namespace + "-dot'></div>\n  </div>\n  <div class='" + Lighter.namespace + "-overlay'></div>\n</div>"
    };

    Lighter.lighter = function($target, options) {
      var data;
      if (options == null) {
        options = {};
      }
      data = $target.data('_lighter');
      if (!data) {
        $target.data('_lighter', data = new Lighter($target, options));
      }
      return data;
    };

    Lighter.prototype.$ = function(selector) {
      return this.$el.find(selector);
    };

    function Lighter($target, settings) {
      if (settings == null) {
        settings = {};
      }
      this.show = bind(this.show, this);
      this.hide = bind(this.hide, this);
      this.observe = bind(this.observe, this);
      this.keyup = bind(this.keyup, this);
      this.size = bind(this.size, this);
      this.align = bind(this.align, this);
      this.process = bind(this.process, this);
      this.resize = bind(this.resize, this);
      this.type = bind(this.type, this);
      this.prev = bind(this.prev, this);
      this.next = bind(this.next, this);
      this.close = bind(this.close, this);
      this.$ = bind(this.$, this);
      this.$target = $target;
      this.settings = $.extend({}, this.defaults, settings);
      this.$el = $(this.settings.template);
      this.$overlay = this.$("." + Lighter.namespace + "-overlay");
      this.$content = this.$("." + Lighter.namespace + "-content");
      this.$container = this.$("." + Lighter.namespace + "-container");
      this.$close = this.$("." + Lighter.namespace + "-close");
      this.$prev = this.$("." + Lighter.namespace + "-prev");
      this.$next = this.$("." + Lighter.namespace + "-next");
      this.$body = this.$("." + Lighter.namespace + "-body");
      this.dimensions = this.settings.dimensions;
      this.process();
    }

    Lighter.prototype.close = function(event) {
      if (event != null) {
        event.preventDefault();
      }
      if (event != null) {
        event.stopPropagation();
      }
      return this.hide();
    };

    Lighter.prototype.next = function(event) {
      if (event != null) {
        event.preventDefault();
      }
      return event != null ? event.stopPropagation() : void 0;
    };

    Lighter.prototype.prev = function() {
      if (typeof event !== "undefined" && event !== null) {
        event.preventDefault();
      }
      return typeof event !== "undefined" && event !== null ? event.stopPropagation() : void 0;
    };

    Lighter.prototype.type = function(href) {
      if (href == null) {
        href = this.href();
      }
      return this.settings.type || (this.href().match(/\.(webp|jpeg|jpg|jpe|gif|png|bmp)$/i) ? "image" : void 0);
    };

    Lighter.prototype.resize = function(dimensions) {
      this.dimensions = dimensions;
      return this.align();
    };

    Lighter.prototype.process = function() {
      var fetched, loading;
      fetched = (function(_this) {
        return function() {
          return _this.$el.removeClass(Lighter.namespace + "-loading").addClass(Lighter.namespace + "-fetched");
        };
      })(this);
      loading = (function(_this) {
        return function() {
          return _this.$el.removeClass(Lighter.namespace + "-fetched").addClass(Lighter.namespace + "-loading");
        };
      })(this);
      this.slide = new Slide(this.$target.attr("href"));
      loading();
      return this.slide.preload((function(_this) {
        return function(slide) {
          _this.resize(slide.dimensions);
          _this.$content.html(_this.slide.$content());
          return fetched();
        };
      })(this));
    };

    Lighter.prototype.align = function() {
      var size;
      size = this.size();
      return this.$container.css({
        width: size.width,
        height: size.height,
        margin: "-" + (size.height / 2) + "px -" + (size.width / 2) + "px"
      });
    };

    Lighter.prototype.size = function() {
      var ratio;
      ratio = Math.max(this.dimensions.height / ($(window).height() - this.settings.padding), this.dimensions.width / ($(window).width() - this.settings.padding));
      return {
        width: ratio > 1.0 ? Math.round(this.dimensions.width / ratio) : this.dimensions.width,
        height: ratio > 1.0 ? Math.round(this.dimensions.height / ratio) : this.dimensions.height
      };
    };

    Lighter.prototype.keyup = function(event) {
      if (event.target.form != null) {
        return;
      }
      if (event.which === 27) {
        this.close();
      }
      if (event.which === 37) {
        this.prev();
      }
      if (event.which === 39) {
        return this.next();
      }
    };

    Lighter.prototype.observe = function(method) {
      if (method == null) {
        method = 'on';
      }
      $(window)[method]("resize", this.align);
      $(document)[method]("keyup", this.keyup);
      this.$overlay[method]("click", this.close);
      this.$close[method]("click", this.close);
      this.$next[method]("click", this.next);
      return this.$prev[method]("click", this.prev);
    };

    Lighter.prototype.hide = function() {
      var alpha, omega;
      alpha = (function(_this) {
        return function() {
          return _this.observe('off');
        };
      })(this);
      omega = (function(_this) {
        return function() {
          return _this.$el.remove();
        };
      })(this);
      alpha();
      this.$el.position();
      this.$el.addClass(Lighter.namespace + "-fade");
      return Animation.execute(this.$el, omega);
    };

    Lighter.prototype.show = function() {
      var alpha, omega;
      omega = (function(_this) {
        return function() {
          return _this.observe('on');
        };
      })(this);
      alpha = (function(_this) {
        return function() {
          return $(document.body).append(_this.$el);
        };
      })(this);
      alpha();
      this.$el.position();
      this.$el.removeClass(Lighter.namespace + "-fade");
      return Animation.execute(this.$el, omega);
    };

    return Lighter;

  })();

  $.fn.extend({
    lighter: function(option) {
      if (option == null) {
        option = {};
      }
      return this.each(function() {
        var $this, action, options;
        $this = $(this);
        options = $.extend({}, $.fn.lighter.defaults, typeof option === "object" && option);
        action = typeof option === "string" ? option : option.action;
        if (action == null) {
          action = "show";
        }
        return Lighter.lighter($this, options)[action]();
      });
    }
  });

  $(document).on("click", "[data-lighter]", function(event) {
    event.preventDefault();
    event.stopPropagation();
    return $(this).lighter();
  });

}).call(this);
