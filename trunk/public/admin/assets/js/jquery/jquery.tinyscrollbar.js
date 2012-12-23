/*!
 * Tiny Scrollbar 1.65
 * http://www.baijs.nl/tinyscrollbar/
 *
 * Copyright 2010, Maarten Baijs
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/gpl-2.0.php
 *
 * Date: 10 / 05 / 2011
 * Depends on library: jQuery
 * 
 */

(function($){
	$.tiny = $.tiny || { };
	
	$.tiny.scrollbar = {
		options: {	
			axis: 'y', // vertical or horizontal scrollbar? ( x || y ).
			wheel: 30,  //how many pixels must the mouswheel scroll at a time.
			scroll: true, //enable or disable the mousewheel;
			size: 'auto', //set the size of the scrollbar to auto or a fixed number.
			sizethumb: 'auto', //set the size of the thumb to auto or a fixed number.
            fnUpdateBottom:function(){}
		}
	};	
	
	$.fn.tinyscrollbar = function(options) { 
		var options = $.extend({}, $.tiny.scrollbar.options, options); 		
		this.each(function(){ $(this).data('tsb', new Scrollbar($(this), options)); });
		return this;
	};
	$.fn.tinyscrollbar_update = function(sScroll) { return $(this).data('tsb').update(sScroll); };
    $.fn.tinyscrollbar_scrollTop = function() { return $(this).data('tsb').cuteScrollTop(); };
    $.fn.tinyscrollbar_diableWheelDrag = function() { return $(this).data('tsb').diableWheelDrag(); };
    $.fn.tinyscrollbar_enableWheelDrag = function() { return $(this).data('tsb').enableWheelDrag(); };
    $.fn.tinyscrollbar_getCurrentScrollBarPos = function() { return $(this).data('tsb').getScrollBarPos(); };

	function Scrollbar(root, options){
		var oSelf = this;
		var oWrapper = root;
		var oViewport = { obj: $('.sys-scroll-content-box', root) };
		var oContent = { obj: $('.sys-scroll-content', root) };
		var oScrollbar = { obj: $('.sys-scroll-scrollbar', root) };
        var oScrolltop = {obj:$('.sys-scroll-top',root)};
		var oTrack = { obj: $('.sys-scroll-track', oScrollbar.obj) };
		var oThumb = { obj: $('.sys-scroll-thumb', oScrollbar.obj) };
		var sAxis = options.axis == 'x', sDirection = sAxis ? 'left' : 'top', sSize = sAxis ? 'Width' : 'Height';
		var iScroll, iPosition = { start: 0, now: 0 }, iMouse = {};
        //cute edit
        var holdMouse = false;
        var pMax = 0;
        var cMax = 0;
        var isUpdate = false;
        //if small item
        if(oViewport.obj.height() > oContent.obj.height() - 20) {
            $('div.ticker-update',oContent.obj).addClass('scroll-disable');
        }

		function initialize() {
			oSelf.update();
			setEvents();
			return oSelf;
		}
		this.update = function(sScroll){
            //update scroll
			oViewport[options.axis] = oViewport.obj[0]['offset'+ sSize];
			oContent[options.axis] = oContent.obj[0]['scroll'+ sSize];
			oContent.ratio = oViewport[options.axis] / oContent[options.axis];
			oScrollbar.obj.toggleClass('scroll-disable', oContent.ratio >= 1);
			oTrack[options.axis] = options.size == 'auto' ? oViewport[options.axis] : options.size;
			oThumb[options.axis] = Math.min(oTrack[options.axis], Math.max(0, ( options.sizethumb == 'auto' ? (oTrack[options.axis] * oContent.ratio) : options.sizethumb )));
			oScrollbar.ratio = options.sizethumb == 'auto' ? (oContent[options.axis] / oTrack[options.axis]) : (oContent[options.axis] - oViewport[options.axis]) / (oTrack[options.axis] - oThumb[options.axis]);
            iScroll = (sScroll == 'relative' && oContent.ratio <= 1) ? Math.min((oContent[options.axis] - oViewport[options.axis]), Math.max(0, iScroll)) : 0;
			iScroll = (sScroll == 'bottom' && oContent.ratio <= 1) ? (oContent[options.axis] - oViewport[options.axis]) : isNaN(parseInt(sScroll)) ? iScroll : parseInt(sScroll);
            cMax = oContent[options.axis] - oViewport[options.axis];
            pMax = cMax / oScrollbar.ratio;//max postion
            setSize();
		};
        //Method private
		function setSize(){
            var tpl_size_Scrollbar,tpl_size_Thumb;
			oThumb.obj.css(sDirection, iScroll / oScrollbar.ratio);
            animateScroll(oContent.obj,sDirection,-iScroll,600);
			iMouse['start'] = oThumb.obj.offset()[sDirection];
			var sCssSize = sSize.toLowerCase();
			oScrollbar.obj.css(sCssSize, oTrack[options.axis]-parseInt(oScrollbar.obj.css("top")));
			oTrack.obj.css(sCssSize, oTrack[options.axis]-parseInt(oScrollbar.obj.css("top")));
			oThumb.obj.css(sCssSize, oThumb[options.axis]-parseInt(oScrollbar.obj.css("top")));
            //open new update
            isUpdate = false;
		}

		function setEvents(){
			oThumb.obj.bind('mousedown', start);
			oThumb.obj[0].ontouchstart = function(oEvent){
				oEvent.preventDefault();
				oThumb.obj.unbind('mousedown');
				start(oEvent.touches[0]);
				return false;
			};
			oTrack.obj.bind('mouseup', drag);
			if(options.scroll && this.addEventListener){
				oWrapper[0].addEventListener('DOMMouseScroll', wheel, false);
				oWrapper[0].addEventListener('mousewheel', wheel, false );
			}
			else if(options.scroll){oWrapper[0].onmousewheel = wheel;}
		}

		function start(oEvent){
			iMouse.start = sAxis ? oEvent.pageX : oEvent.pageY;
			var oThumbDir = parseInt(oThumb.obj.css(sDirection));
			iPosition.start = oThumbDir == 'auto' ? 0 : oThumbDir;
			$(document).bind('mousemove', drag);
			document.ontouchmove = function(oEvent){
				$(document).unbind('mousemove');
				drag(oEvent.touches[0]);
			};
			$(document).bind('mouseup', end);
			oThumb.obj.bind('mouseup', end);
			oThumb.obj[0].ontouchend = document.ontouchend = function(oEvent){
				$(document).unbind('mouseup');
				oThumb.obj.unbind('mouseup');
				end(oEvent.touches[0]);
			};
            //for active bar
            holdMouse = true;
			return false;
		}
		function wheel(oEvent){
            if(options.scroll){
                if(!(oContent.ratio >= 1)){
//                    oEvent = $.event.fix(oEvent || window.event); //v1.65
                    var oEvent = oEvent || window.event;//v1.65
                    var iDelta = oEvent.wheelDelta ? oEvent.wheelDelta/120 : -oEvent.detail/3;
                    iScroll -= iDelta * options.wheel;
                    iScroll = Math.min((oContent[options.axis] - oViewport[options.axis]), Math.max(0, iScroll));
                    oScrolltop.obj.toggleClass('scroll-disable', iScroll <= 30);
                    oThumb.obj.css(sDirection, iScroll / oScrollbar.ratio);
                    oContent.obj.css(sDirection,-iScroll);
                    oEvent = $.event.fix(oEvent);
                    oEvent.preventDefault();
                    if (iScroll >= cMax - 18) {
                        if ($.isFunction(options.fnUpdateBottom()))
                            options.fnUpdateBottom.call(this);
//                        callUpdate();
                    }
                    else{

                    }
                }
            }
		}
		function end(oEvent){
			$(document).unbind('mousemove', drag);
			$(document).unbind('mouseup', end);
			oThumb.obj.unbind('mouseup', end);
			document.ontouchmove = oThumb.obj[0].ontouchend = document.ontouchend = null;
			//for active bar
            holdMouse = false;
            if(!root.hasClass('hover')){root.removeClass('active');}
            return false;
		}
		function drag(oEvent){
            if(options.scroll){
                if(!(oContent.ratio >= 1)){
                    iPosition.now = Math.min((oTrack[options.axis] - oThumb[options.axis]), Math.max(0, (iPosition.start + ((sAxis ? oEvent.pageX : oEvent.pageY) - iMouse.start))));
                    iScroll = iPosition.now * oScrollbar.ratio;
                    oContent.obj.css(sDirection,-iScroll);
                    oThumb.obj.css(sDirection, iPosition.now);
                    oScrolltop.obj.toggleClass('scroll-disable', iScroll <= 30);
                    if (iPosition.now >= pMax - 18) {
                        if ($.isFunction(options.fnUpdateBottom()))
                            options.fnUpdateBottom.call(this);
//                        callUpdate();
                    }
                    else{
                    }
                }
                return false;
            }
		}
        //scrolltop for public call
        this.cuteScrollTop = function(){callScrolltop()};
        this.diableWheelDrag = function(){
            options.scroll = false;
            oScrollbar.obj.addClass("hide-scrollbar");
        };
        this.enableWheelDrag = function(){
            options.scroll = true;
            oScrollbar.obj.removeClass("hide-scrollbar");
        };
        this.getScrollBarPos = function(){
            return parseInt(iScroll);
        };
        function callUpdate(){
            console.log("call update");
//            switch (options.controlScrollId) {
//                case 1: //right ticker
//                    if (!isUpdate) {
//                        isUpdate = true;
//                    }
//                    break;
//                case 2://preview ticker
//                    break;
//                case 3://Network Notification
//                    break;
//                case 4://My Groups
//
//                    break;
//                case 5:// Groups suggest(composer)
//                    break;
//            }
        }

        //Method default scrolltop
        oScrolltop.obj.bind('click',function(){
            callScrolltop();
        });
        //Scroll top
        function callScrolltop(){
            var sDirec = 'top';
            iScroll = 0;
            oScrolltop.obj.toggleClass('scroll-disable', iScroll <= 30);
            animateScroll(oThumb.obj,sDirec,0,300);
            animateScroll(oContent.obj,sDirec,iScroll,600);
        }
        //Animate for scroll 
        function animateScroll (obj,sDirec,pos,dura){
            if(sDirec == 'top'){obj.stop().animate({top:pos},{queue:false, duration:dura, easing:'easeOutQuint'})}
            if(sDirec == 'left'){obj.stop().animate({left:pos},{queue:false, duration:dura, easing: 'easeOutQuint'})}
        }
        
	    return initialize();
	}
})(jQuery);