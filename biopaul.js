/**
 * 2014.3.1
 * jQuery gMap - Google Maps API V3
 *
 * @url   http://github.com/marioestrada/jQuery-gMap
 * @author  Cedric Kastner <cedric@nur-text.de> and Mario Estrada <me@mario.ec>
 * @version 2.1
 */
 // (function(a){a.fn.gMap=function(b,c){switch(b){case"addMarker":return a(this).trigger("gMap.addMarker",[c.latitude,c.longitude,c.content,c.icon,c.popup]);case"centerAt":return a(this).trigger("gMap.centerAt",[c.latitude,c.longitude,c.zoom])}opts=a.extend({},a.fn.gMap.defaults,b);return this.each(function(){var b=new google.maps.Map(this);$geocoder=new google.maps.Geocoder,opts.address?$geocoder.geocode({address:opts.address},function(a,c){a&&a.length&&b.setCenter(a[0].geometry.location)}):opts.latitude&&opts.longitude?b.setCenter(new google.maps.LatLng(opts.latitude,opts.longitude)):a.isArray(opts.markers)&&opts.markers.length>0?opts.markers[0].address?$geocoder.geocode({address:opts.markers[0].address},function(a,c){a&&a.length>0&&b.setCenter(a[0].geometry.location)}):b.setCenter(new google.maps.LatLng(opts.markers[0].latitude,opts.markers[0].longitude)):b.setCenter(new google.maps.LatLng(34.885931,9.84375)),b.setZoom(opts.zoom),b.setMapTypeId(google.maps.MapTypeId[opts.maptype]),map_options={scrollwheel:opts.scrollwheel},opts.controls===!1?a.extend(map_options,{disableDefaultUI:!0}):opts.controls.length!=0&&a.extend(map_options,opts.controls,{disableDefaultUI:!0}),b.setOptions(map_options);var c=new google.maps.Marker;marker_icon=new google.maps.MarkerImage(opts.icon.image),marker_icon.size=new google.maps.Size(opts.icon.iconsize[0],opts.icon.iconsize[1]),marker_icon.anchor=new google.maps.Point(opts.icon.iconanchor[0],opts.icon.iconanchor[1]),c.setIcon(marker_icon),opts.icon.shadow&&(marker_shadow=new google.maps.MarkerImage(opts.icon.shadow),marker_shadow.size=new google.maps.Size(opts.icon.shadowsize[0],opts.icon.shadowsize[1]),marker_shadow.anchor=new google.maps.Point(opts.icon.shadowanchor[0],opts.icon.shadowanchor[1]),c.setShadow(marker_shadow)),a(this).bind("gMap.centerAt",function(a,c,d,e){e&&b.setZoom(e),b.panTo(new google.maps.LatLng(parseFloat(c),parseFloat(d)))});var d;a(this).bind("gMap.addMarker",function(a,e,f,g,h,i){var j=new google.maps.LatLng(parseFloat(e),parseFloat(f)),k=new google.maps.Marker({position:j});h?(marker_icon=new google.maps.MarkerImage(h.image),marker_icon.size=new google.maps.Size(h.iconsize[0],h.iconsize[1]),marker_icon.anchor=new google.maps.Point(h.iconanchor[0],h.iconanchor[1]),k.setIcon(marker_icon),h.shadow&&(marker_shadow=new google.maps.MarkerImage(h.shadow),marker_shadow.size=new google.maps.Size(h.shadowsize[0],h.shadowsize[1]),marker_shadow.anchor=new google.maps.Point(h.shadowanchor[0],h.shadowanchor[1]),c.setShadow(marker_shadow))):(k.setIcon(c.getIcon()),k.setShadow(c.getShadow()));if(g){g=="_latlng"&&(g=e+", "+f);var l=new google.maps.InfoWindow({content:opts.html_prepend+g+opts.html_append});google.maps.event.addListener(k,"click",function(){d&&d.close(),l.open(b,k),d=l}),i&&l.open(b,k)}k.setMap(b)});for(var e=0;e<opts.markers.length;e++){marker=opts.markers[e];if(marker.address){marker.html=="_address"&&(marker.html=marker.address);var f=this;$geocoder.geocode({address:marker.address},function(b,c){return function(d,e){d&&d.length>0&&a(c).trigger("gMap.addMarker",[d[0].geometry.location.lat(),d[0].geometry.location.lng(),b.html,b.icon])}}(marker,f))}else a(this).trigger("gMap.addMarker",[marker.latitude,marker.longitude,marker.html,marker.icon])}})},a.fn.gMap.defaults={address:"",latitude:0,longitude:0,zoom:1,markers:[],controls:[],scrollwheel:!1,maptype:"ROADMAP",html_prepend:'<div class="gmap_marker">',html_append:"</div>",icon:{image:"http://www.google.com/mapfiles/marker.png",shadow:"http://www.google.com/mapfiles/shadow50.png",iconsize:[20,34],shadowsize:[37,34],iconanchor:[9,34],shadowanchor:[6,34]}}})(jQuery);

/*global jQuery */
/*! 
* FitVids 1.0
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*/

// (function( $ ){

//   $.fn.fitVids = function( options ) {
//     var settings = {
//       customSelector: null
//     }
    
//     var div = document.createElement('div'),
//         ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];
        
//     div.className = 'fit-vids-style';
//     div.innerHTML = '&shy;<style>         \
//       .fluid-width-video-wrapper {        \
//          width: 100%;                     \
//          position: relative;              \
//          padding: 0;                      \
//       }                                   \
//                                           \
//       .fluid-width-video-wrapper iframe,  \
//       .fluid-width-video-wrapper object,  \
//       .fluid-width-video-wrapper embed {  \
//          position: absolute;              \
//          top: 0;                          \
//          left: 0;                         \
//          width: 100%;                     \
//          height: 100%;                    \
//       }                                   \
//     </style>';
                      
//     ref.parentNode.insertBefore(div,ref);
    
//     if ( options ) { 
//       $.extend( settings, options );
//     }
    
//     return this.each(function(){
//       var selectors = [
//         "iframe[src^='http://player.vimeo.com']", 
//         "iframe[src^='http://www.youtube.com']", 
//         "iframe[src^='https://www.youtube.com']", 
//         "iframe[src^='http://www.kickstarter.com']", 
//         "object", 
//         "embed"
//       ];
      
//       if (settings.customSelector) {
//         selectors.push(settings.customSelector);
//       }
      
//       var $allVideos = $(this).find(selectors.join(','));

//       $allVideos.each(function(){
//         var $this = $(this);
//         if (this.tagName.toLowerCase() == 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; } 
//         var height = this.tagName.toLowerCase() == 'object' ? $this.attr('height') : $this.height(),
//             aspectRatio = height / $this.width();
//     if(!$this.attr('id')){
//       var videoID = 'fitvid' + Math.floor(Math.random()*999999);
//       $this.attr('id', videoID);
//     }
//         $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
//         $this.removeAttr('height').removeAttr('width');
//       });
//     });
  
//   }
// })( jQuery );


/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
*/
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1;};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p;}('h.i["Z"]=h.i["C"];h.Y(h.i,{y:"A",C:9(x,t,b,c,d){6 h.i[h.i.y](x,t,b,c,d)},12:9(x,t,b,c,d){6 c*(t/=d)*t+b},A:9(x,t,b,c,d){6-c*(t/=d)*(t-2)+b},11:9(x,t,b,c,d){e((t/=d/2)<1){6 c/2*t*t+b};6-c/2*((--t)*(t-2)-1)+b},W:9(x,t,b,c,d){6 c*(t/=d)*t*t+b},18:9(x,t,b,c,d){6 c*((t=t/d-1)*t*t+1)+b},1b:9(x,t,b,c,d){e((t/=d/2)<1){6 c/2*t*t*t+b};6 c/2*((t-=2)*t*t+2)+b},13:9(x,t,b,c,d){6 c*(t/=d)*t*t*t+b},16:9(x,t,b,c,d){6-c*((t=t/d-1)*t*t*t-1)+b},15:9(x,t,b,c,d){e((t/=d/2)<1){6 c/2*t*t*t*t+b};6-c/2*((t-=2)*t*t*t-2)+b},H:9(x,t,b,c,d){6 c*(t/=d)*t*t*t*t+b},F:9(x,t,b,c,d){6 c*((t=t/d-1)*t*t*t*t+1)+b},G:9(x,t,b,c,d){e((t/=d/2)<1){6 c/2*t*t*t*t*t+b};6 c/2*((t-=2)*t*t*t*t+2)+b},J:9(x,t,b,c,d){6-c*8.D(t/d*(8.g/2))+c+b},I:9(x,t,b,c,d){6 c*8.n(t/d*(8.g/2))+b},E:9(x,t,b,c,d){6-c/2*(8.D(8.g*t/d)-1)+b},K:9(x,t,b,c,d){6(t==0)?b:c*8.j(2,10*(t/d-1))+b},M:9(x,t,b,c,d){6(t==d)?b+c:c*(-8.j(2,-10*t/d)+1)+b},S:9(x,t,b,c,d){e(t==0){6 b};e(t==d){6 b+c};e((t/=d/2)<1){6 c/2*8.j(2,10*(t-1))+b};6 c/2*(-8.j(2,-10*--t)+2)+b},N:9(x,t,b,c,d){6-c*(8.q(1-(t/=d)*t)-1)+b},L:9(x,t,b,c,d){6 c*8.q(1-(t=t/d-1)*t)+b},O:9(x,t,b,c,d){e((t/=d/2)<1){6-c/2*(8.q(1-t*t)-1)+b};6 c/2*(8.q(1-(t-=2)*t)+1)+b},R:9(x,t,b,c,d){f s=1.m;f p=0;f a=c;e(t==0){6 b};e((t/=d)==1){6 b+c};e(!p){p=d*0.3};e(a<8.r(c)){a=c;f s=p/4}l{f s=p/(2*8.g)*8.u(c/a)};6-(a*8.j(2,10*(t-=1))*8.n((t*d-s)*(2*8.g)/p))+b},P:9(x,t,b,c,d){f s=1.m;f p=0;f a=c;e(t==0){6 b};e((t/=d)==1){6 b+c};e(!p){p=d*0.3};e(a<8.r(c)){a=c;f s=p/4}l{f s=p/(2*8.g)*8.u(c/a)};6 a*8.j(2,-10*t)*8.n((t*d-s)*(2*8.g)/p)+c+b},Q:9(x,t,b,c,d){f s=1.m;f p=0;f a=c;e(t==0){6 b};e((t/=d/2)==2){6 b+c};e(!p){p=d*(0.3*1.5)};e(a<8.r(c)){a=c;f s=p/4}l{f s=p/(2*8.g)*8.u(c/a)};e(t<1){6-0.5*(a*8.j(2,10*(t-=1))*8.n((t*d-s)*(2*8.g)/p))+b};6 a*8.j(2,-10*(t-=1))*8.n((t*d-s)*(2*8.g)/p)*0.5+c+b},14:9(x,t,b,c,d,s){e(s==v){s=1.m};6 c*(t/=d)*t*((s+1)*t-s)+b},17:9(x,t,b,c,d,s){e(s==v){s=1.m};6 c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},1a:9(x,t,b,c,d,s){e(s==v){s=1.m};e((t/=d/2)<1){6 c/2*(t*t*(((s*=(1.B))+1)*t-s))+b};6 c/2*((t-=2)*t*(((s*=(1.B))+1)*t+s)+2)+b},z:9(x,t,b,c,d){6 c-h.i.w(x,d-t,0,c,d)+b},w:9(x,t,b,c,d){e((t/=d)<(1/2.k)){6 c*(7.o*t*t)+b}l{e(t<(2/2.k)){6 c*(7.o*(t-=(1.5/2.k))*t+0.k)+b}l{e(t<(2.5/2.k)){6 c*(7.o*(t-=(2.19/2.k))*t+0.V)+b}l{6 c*(7.o*(t-=(2.T/2.k))*t+0.U)+b}}}},X:9(x,t,b,c,d){e(t<d/2){6 h.i.z(x,t*2,0,c,d)*0.5+b};6 h.i.w(x,t*2-d,0,c,d)*0.5+c*0.5+b}});',62,74,'||||||return||Math|function|||||if|var|PI|jQuery|easing|pow|75|else|70158|sin|5625||sqrt|abs|||asin|undefined|easeOutBounce||def|easeInBounce|easeOutQuad|525|swing|cos|easeInOutSine|easeOutQuint|easeInOutQuint|easeInQuint|easeOutSine|easeInSine|easeInExpo|easeOutCirc|easeOutExpo|easeInCirc|easeInOutCirc|easeOutElastic|easeInOutElastic|easeInElastic|easeInOutExpo|625|984375|9375|easeInCubic|easeInOutBounce|extend|jswing||easeInOutQuad|easeInQuad|easeInQuart|easeInBack|easeInOutQuart|easeOutQuart|easeOutBack|easeOutCubic|25|easeInOutBack|easeInOutCubic'.split('|'),0,{}));


/* 
 * Class: prettyPhoto
 * Author: Stephane Caron (http://www.no-margin-for-errors.com/projects/prettyPhoto-jquery-lightbox-clone/)
 * Version: 3.1.5
 * Chinesized by Paul Allen (http://www.bropaul.com/)
 */
(function(e) {
   function t() {
     var e = location.href;
     return hashtag = e.indexOf("#prettyPhoto") !== -1 ? decodeURI(e.substring(e.indexOf("#prettyPhoto") + 1, e.length)) : !1, hashtag
   }

   function n() {
     if (typeof theRel == "undefined") return;
     location.hash = theRel + "/" + rel_index + "/"
   }

   function r() {
     location.href.indexOf("#prettyPhoto") !== -1 && (location.hash = "prettyPhoto")
   }

   function i(e, t) {
     e = e.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
     var n = "[\\?&]" + e + "=([^&#]*)",
       r = new RegExp(n),
       i = r.exec(t);
     return i == null ? "" : i[1]
   }
   e.prettyPhoto = {
     version: "3.1.5"
   }, e.fn.prettyPhoto = function(s) {
     function o() {
       e(".pp_loaderIcon").hide(), projectedTop = scroll_pos.scrollTop + (N / 2 - b.containerHeight / 2), projectedTop < 0 && (projectedTop = 0), $ppt.fadeTo(settings.animation_speed, 1), $pp_pic_holder.find(".pp_content").animate({
         height: b.contentHeight,
         width: b.contentWidth
       }, settings.animation_speed), $pp_pic_holder.animate({
         top: projectedTop,
         left: C / 2 - b.containerWidth / 2 < 0 ? 0 : C / 2 - b.containerWidth / 2,
         width: b.containerWidth
       }, settings.animation_speed, function() {
         $pp_pic_holder.find(".pp_hoverContainer,#fullResImage").height(b.height).width(b.width), $pp_pic_holder.find(".pp_fade").fadeIn(settings.animation_speed), isSet && c(pp_images[set_position]) == "image" ? $pp_pic_holder.find(".pp_hoverContainer").show() : $pp_pic_holder.find(".pp_hoverContainer").hide(), settings.allow_expand && (b.resized ? e("a.pp_expand,a.pp_contract").show() : e("a.pp_expand").hide()), settings.autoplay_slideshow && !k && !w && e.prettyPhoto.startSlideshow(), settings.changepicturecallback(), w = !0
       }), v(), s.ajaxcallback()
     }

     function u(t) {
       $pp_pic_holder.find("#pp_full_res object,#pp_full_res embed").css("visibility", "hidden"), $pp_pic_holder.find(".pp_fade").fadeOut(settings.animation_speed, function() {
         e(".pp_loaderIcon").show(), t()
       })
     }

     function a(t) {
       t > 1 ? e(".pp_nav").show() : e(".pp_nav").hide()
     }

     function f(e, t) {
       resized = !1, l(e, t), imageWidth = e, imageHeight = t;
       if ((T > C || x > N) && doresize && settings.allow_resize && !y) {
         resized = !0, fitting = !1;
         while (!fitting) T > C ? (imageWidth = C - 200, imageHeight = t / e * imageWidth) : x > N ? (imageHeight = N - 200, imageWidth = e / t * imageHeight) : fitting = !0, x = imageHeight, T = imageWidth;
         (T > C || x > N) && f(T, x), l(imageWidth, imageHeight)
       }
       return {
         width: Math.floor(imageWidth),
         height: Math.floor(imageHeight),
         containerHeight: Math.floor(x),
         containerWidth: Math.floor(T) + settings.horizontal_padding * 2,
         contentHeight: Math.floor(E),
         contentWidth: Math.floor(S),
         resized: resized
       }
     }

     function l(t, n) {
       t = parseFloat(t), n = parseFloat(n), $pp_details = $pp_pic_holder.find(".pp_details"), $pp_details.width(t), detailsHeight = parseFloat($pp_details.css("marginTop")) + parseFloat($pp_details.css("marginBottom")), $pp_details = $pp_details.clone().addClass(settings.theme).width(t).appendTo(e("body")).css({
         position: "absolute",
         top: -1e4
       }), detailsHeight += $pp_details.height(), detailsHeight = detailsHeight <= 34 ? 36 : detailsHeight, $pp_details.remove(), $pp_title = $pp_pic_holder.find(".ppt"), $pp_title.width(t), titleHeight = parseFloat($pp_title.css("marginTop")) + parseFloat($pp_title.css("marginBottom")), $pp_title = $pp_title.clone().appendTo(e("body")).css({
         position: "absolute",
         top: -1e4
       }), titleHeight += $pp_title.height(), $pp_title.remove(), E = n + detailsHeight, S = t, x = E + titleHeight + $pp_pic_holder.find(".pp_top").height() + $pp_pic_holder.find(".pp_bottom").height(), T = t
     }

     function c(e) {
       return e.match(/\b.swf\b/i) ? "flash" :e.match(/youtube\.com\/watch/i) || e.match(/youtu\.be/i) ? "youtube" : e.match(/youku\.com/i) ? "youku": e.match(/tudou\.com/i) ? "tudou" : e.match(/video\.sina\.com\.cn/i) ? "sina" : e.match(/56\.com/i) ? "56": e.match(/\b.mp4\b/i)||e.match(/\b.webm\b/i)? "html5v": e.match(/\biframe=true\b/i) ? "iframe" : e.match(/\bajax=true\b/i) ? "ajax" : e.match(/\bcustom=true\b/i) ? "custom" : e.substr(0, 1) == "#" ? "inline" : "image"
     }

     function h() {
       if (doresize && typeof $pp_pic_holder != "undefined") {
         scroll_pos = p(), contentHeight = $pp_pic_holder.height(), contentwidth = $pp_pic_holder.width(), projectedTop = N / 2 + scroll_pos.scrollTop - contentHeight / 2, projectedTop < 0 && (projectedTop = 0);
         if (contentHeight > N) return;
         $pp_pic_holder.css({
           top: projectedTop,
           left: C / 2 + scroll_pos.scrollLeft - contentwidth / 2
         })
       }
     }

     function p() {
       if (self.pageYOffset) return {
         scrollTop: self.pageYOffset,
         scrollLeft: self.pageXOffset
       };
       if (document.documentElement && document.documentElement.scrollTop) return {
         scrollTop: document.documentElement.scrollTop,
         scrollLeft: document.documentElement.scrollLeft
       };
       if (document.body) return {
         scrollTop: document.body.scrollTop,
         scrollLeft: document.body.scrollLeft
       }
     }

     function d() {
       N = e(window).height(), C = e(window).width(), typeof $pp_overlay != "undefined" && $pp_overlay.height(e(document).height()).width(C)
     }

     function v() {
       isSet && settings.overlay_gallery && c(pp_images[set_position]) == "image" ? (itemWidth = 57, navWidth = settings.theme == "facebook" || settings.theme == "pp_default" ? 50 : 30, itemsPerPage = Math.floor((b.containerWidth - 100 - navWidth) / itemWidth), itemsPerPage = itemsPerPage < pp_images.length ? itemsPerPage : pp_images.length, totalPage = Math.ceil(pp_images.length / itemsPerPage) - 1, totalPage == 0 ? (navWidth = 0, $pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").hide()) : $pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").show(), galleryWidth = itemsPerPage * itemWidth, fullGalleryWidth = pp_images.length * itemWidth, $pp_gallery.css("margin-left", -(galleryWidth / 2 + navWidth / 2)).find("div:first").width(galleryWidth + 5).find("ul").width(fullGalleryWidth).find("li.selected").removeClass("selected"), goToPage = Math.floor(set_position / itemsPerPage) < totalPage ? Math.floor(set_position / itemsPerPage) : totalPage, e.prettyPhoto.changeGalleryPage(goToPage), $pp_gallery_li.filter(":eq(" + set_position + ")").addClass("selected")) : $pp_pic_holder.find(".pp_content").unbind("mouseenter mouseleave")
     }

     function m(t) {
       settings.social_tools && (facebook_like_link = settings.social_tools.replace("{location_href}", encodeURIComponent(location.href))), settings.markup = settings.markup.replace("{pp_social}", ""), e("body").append(settings.markup), $pp_pic_holder = e(".pp_pic_holder"), $ppt = e(".ppt"), $pp_overlay = e("div.pp_overlay");
       if (isSet && settings.overlay_gallery) {
         currentGalleryPage = 0, toInject = "";
         for (var n = 0; n < pp_images.length; n++) pp_images[n].match(/\b(jpg|jpeg|png|gif)\b/gi) ? (classname = "", img_src = pp_images[n]) : (classname = "default", img_src = ""), toInject += "<li class='" + classname + "'><a href='#'><img src='" + img_src + "' width='50' alt='' /></a></li>";
         toInject = settings.gallery_markup.replace(/{gallery}/g, toInject), $pp_pic_holder.find("#pp_full_res").after(toInject), $pp_gallery = e(".pp_pic_holder .pp_gallery"), $pp_gallery_li = $pp_gallery.find("li"), $pp_gallery.find(".pp_arrow_next").click(function() {
           return e.prettyPhoto.changeGalleryPage("next"), e.prettyPhoto.stopSlideshow(), !1
         }), $pp_gallery.find(".pp_arrow_previous").click(function() {
           return e.prettyPhoto.changeGalleryPage("previous"), e.prettyPhoto.stopSlideshow(), !1
         }), $pp_pic_holder.find(".pp_content").hover(function() {
           $pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeIn()
         }, function() {
           $pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeOut()
         }), itemWidth = 57, $pp_gallery_li.each(function(t) {
           e(this).find("a").click(function() {
             return e.prettyPhoto.changePage(t), e.prettyPhoto.stopSlideshow(), !1
           })
         })
       }
       settings.slideshow && ($pp_pic_holder.find(".pp_nav").prepend('<a href="#" class="pp_play">Play</a>'), $pp_pic_holder.find(".pp_nav .pp_play").click(function() {
         return e.prettyPhoto.startSlideshow(), !1
       })), $pp_pic_holder.attr("class", "pp_pic_holder " + settings.theme), $pp_overlay.css({
         opacity: 0,
         height: e(document).height(),
         width: e(window).width()
       }).bind("click", function() {
         settings.modal || e.prettyPhoto.close()
       }), e("a.pp_close").bind("click", function() {
         return e.prettyPhoto.close(), !1
       }), settings.allow_expand && e("a.pp_expand").bind("click", function(t) {
         return e(this).hasClass("pp_expand") ? (e(this).removeClass("pp_expand").addClass("pp_contract"), doresize = !1) : (e(this).removeClass("pp_contract").addClass("pp_expand"), doresize = !0), u(function() {
           e.prettyPhoto.open()
         }), !1
       }), $pp_pic_holder.find(".pp_previous, .pp_nav .pp_arrow_previous").bind("click", function() {
         return e.prettyPhoto.changePage("previous"), e.prettyPhoto.stopSlideshow(), !1
       }), $pp_pic_holder.find(".pp_next, .pp_nav .pp_arrow_next").bind("click", function() {
         return e.prettyPhoto.changePage("next"), e.prettyPhoto.stopSlideshow(), !1
       }), h()
     }
     s = jQuery.extend({
       hook: "rel",
       animation_speed: "fast",
       ajaxcallback: function() {},
       slideshow: 5e3,
       autoplay_slideshow: !1,
       opacity: .8,
       show_title: 0,
       allow_resize: !0,
       allow_expand: !0,
       default_width: 500,
       default_height: 344,
       counter_separator_label: "/",
       theme: "facebook",
       horizontal_padding: 20,
       hideflash: !1,
       wmode: "opaque",
       autoplay: !0,
       modal: !1,
       deeplinking: 0,
       overlay_gallery: !0,
       overlay_gallery_max: 30,
       keyboard_shortcuts: !0,
       changepicturecallback: function() {},
       callback: function() {},
       ie6_fallback: !0,
       markup: '<div class="pp_pic_holder"><div class="ppt"></div><div class="pp_top"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div><div class="pp_content_container"><div class="pp_left"><div class="pp_right"><div class="pp_content"><div class="pp_loaderIcon"></div><div class="pp_fade"><a href="#" class="pp_expand" title="查看原图">原图</a><div class="pp_hoverContainer"><a class="pp_next" href="#">→</a><a class="pp_previous" href="#">←</a></div><div id="pp_full_res"></div><div class="pp_details"><div class="pp_nav"><a href="#" class="pp_arrow_previous">←</a><p class="currentTextHolder">0/0</p><a href="#" class="pp_arrow_next">→</a></div><p class="pp_description"></p><div class="pp_social">{pp_social}</div><a class="pp_close" href="#">x</a></div></div></div></div></div></div><div class="pp_bottom"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div></div><div class="pp_overlay"></div>',
       gallery_markup: '<div class="pp_gallery"><a href="#" class="pp_arrow_previous">←</a><div><ul>{gallery}</ul></div><a href="#" class="pp_arrow_next">→</a></div>',
       image_markup: '<img id="fullResImage" src="{path}" />',
       flash_markup: '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
       html5v_markup:'<video controls autoplay src="{path}" width="{width}" height="{height}"></video>',
       // quicktime_markup: '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',
       iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
       inline_markup: '<div class="pp_inline">{content}</div>',
       custom_markup: "",
       social_tools: !1
     }, s);
     var g = this,
       y = !1,
       b, w, E, S, x, T, N = e(window).height(),
       C = e(window).width(),
       k;
     return doresize = !0, scroll_pos = p(), e(window).unbind("resize.prettyphoto").bind("resize.prettyphoto", function() {
       h(), d()
     }), s.keyboard_shortcuts && e(document).unbind("keydown.prettyphoto").bind("keydown.prettyphoto", function(t) {
       if (typeof $pp_pic_holder != "undefined" && $pp_pic_holder.is(":visible")) switch (t.keyCode) {
         case 37:
           e.prettyPhoto.changePage("previous"), t.preventDefault();
           break;
         case 39:
           e.prettyPhoto.changePage("next"), t.preventDefault();
           break;
         case 27:
           settings.modal || e.prettyPhoto.close(), t.preventDefault()
       }
     }), e.prettyPhoto.initialize = function() {
       return settings = s, settings.theme == "pp_default" && (settings.horizontal_padding = 16), theRel = e(this).attr(settings.hook), galleryRegExp = /\[(?:.*)\]/, isSet = galleryRegExp.exec(theRel) ? !0 : !1, pp_images = isSet ? jQuery.map(g, function(t, n) {
         if (e(t).attr(settings.hook).indexOf(theRel) != -1) return e(t).attr("href")
       }) : e.makeArray(e(this).attr("href")), pp_titles = isSet ? jQuery.map(g, function(t, n) {
         if (e(t).attr(settings.hook).indexOf(theRel) != -1) return e(t).find("img").attr("alt") ? e(t).find("img").attr("alt") : ""
       }) : e.makeArray(e(this).find("img").attr("alt")), pp_descriptions = isSet ? jQuery.map(g, function(t, n) {
         if (e(t).attr(settings.hook).indexOf(theRel) != -1) return e(t).attr("title") ? e(t).attr("title") : ""
       }) : e.makeArray(e(this).attr("title")), pp_images.length > settings.overlay_gallery_max && (settings.overlay_gallery = !1), set_position = jQuery.inArray(e(this).attr("href"), pp_images), rel_index = isSet ? set_position : e("a[" + settings.hook + "^='" + theRel + "']").index(e(this)), m(this), settings.allow_resize && e(window).bind("scroll.prettyphoto", function() {
         h()
       }), e.prettyPhoto.open(), !1
     }, e.prettyPhoto.open = function(t) {
       return typeof settings == "undefined" && (settings = s, pp_images = e.makeArray(arguments[0]), pp_titles = arguments[1] ? e.makeArray(arguments[1]) : e.makeArray(""), pp_descriptions = arguments[2] ? e.makeArray(arguments[2]) : e.makeArray(""), isSet = pp_images.length > 1 ? !0 : !1, set_position = arguments[3] ? arguments[3] : 0, m(t.target)), settings.hideflash && e("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility", "hidden"), a(e(pp_images).size()), e(".pp_loaderIcon").show(), settings.deeplinking && n(), settings.social_tools && (facebook_like_link = settings.social_tools.replace("{location_href}", encodeURIComponent(location.href)), $pp_pic_holder.find(".pp_social").html(facebook_like_link)), $ppt.is(":hidden") && $ppt.css("opacity", 0).show(), $pp_overlay.show().fadeTo(settings.animation_speed, settings.opacity), $pp_pic_holder.find(".currentTextHolder").text(set_position + 1 + settings.counter_separator_label + e(pp_images).size()), typeof pp_descriptions[set_position] != "undefined" && pp_descriptions[set_position] != "" ? $pp_pic_holder.find(".pp_description").show().html(unescape(pp_descriptions[set_position])) : $pp_pic_holder.find(".pp_description").hide(), movie_width = parseFloat(i("width", pp_images[set_position])) ? i("width", pp_images[set_position]) : settings.default_width.toString(), movie_height = parseFloat(i("height", pp_images[set_position])) ? i("height", pp_images[set_position]) : settings.default_height.toString(), y = !1, movie_height.indexOf("%") != -1 && (movie_height = parseFloat(e(window).height() * parseFloat(movie_height) / 100 - 150), y = !0), movie_width.indexOf("%") != -1 && (movie_width = parseFloat(e(window).width() * parseFloat(movie_width) / 100 - 150), y = !0), $pp_pic_holder.fadeIn(function() {
         settings.show_title && pp_titles[set_position] != "" && typeof pp_titles[set_position] != "undefined" ? $ppt.html(unescape(pp_titles[set_position])) : $ppt.html(" "), imgPreloader = "", skipInjection = !1;
         switch (c(pp_images[set_position])) {
           case "image":
             imgPreloader = new Image, nextImage = new Image, isSet && set_position < e(pp_images).size() - 1 && (nextImage.src = pp_images[set_position + 1]), prevImage = new Image, isSet && pp_images[set_position - 1] && (prevImage.src = pp_images[set_position - 1]), $pp_pic_holder.find("#pp_full_res")[0].innerHTML = settings.image_markup.replace(/{path}/g, pp_images[set_position]), imgPreloader.onload = function() {
               b = f(imgPreloader.width, imgPreloader.height), o()
             }, imgPreloader.onerror = function() {
               alert("载入文件出错，请给博主留言"), e.prettyPhoto.close()
             }, imgPreloader.src = pp_images[set_position];
             break;
           case "flash":
             b = f(movie_width, movie_height), movie = pp_images[set_position], toInject = settings.flash_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g,movie);
             break;
           case "youtube":
             b = f(movie_width, movie_height), movie_id = i("v", pp_images[set_position]), movie_id == "" && (movie_id = pp_images[set_position].split("youtu.be/"), movie_id = movie_id[1], movie_id.indexOf("?") > 0 && (movie_id = movie_id.substr(0, movie_id.indexOf("?"))), movie_id.indexOf("&") > 0 && (movie_id = movie_id.substr(0, movie_id.indexOf("&")))), movie = "http://www.youtube.com/embed/" + movie_id, i("rel", pp_images[set_position]) ? movie += "?rel=" + i("rel", pp_images[set_position]) : movie += "?rel=1", settings.autoplay && (movie += "&autoplay=1"), toInject = settings.iframe_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g, movie);
             break;
          case "youku":
             // http://v.youku.com/v_show/id_XNzA3NDI1NTQ4.html
             // http://player.youku.com/player.php/sid/XNzA3NDI1NTQ4/v.swf
             // http://player.youku.com/embed/XNzA3NDI1NTQ4
             b = f(movie_width, movie_height),t = /v_show\/id_(.+)\.html/,movie_id = pp_images[set_position].match(t);
             if(!/Mobile/.test(navigator.userAgent)){
             movie = "http://player.youku.com/player.php/sid/" + movie_id[1] + "/v.swf",toInject = settings.flash_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g,movie);
             }else{
             movie = "http://player.youku.com/embed/" + movie_id[1],toInject = settings.iframe_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{path}/g, movie);
             }
             break;
           case "tudou":
             // www.tudou.com/v/clTvRctcLH4&autoPlay=true&forcePlayRate=99/v.swf
             // js.tudouui.com/bin/lingtong/PortalPlayer.swf?hd=999&vcode=XNTk1MzY5MDE2
             // js.tudouui.com/bin/lingtong/PortalPlayer.swf?hd=999&icode=clTvRctcLH4&iid=151233299
             // www.tudou.com/programs/view/html5embed.action?code=clTvRctcLH4
             b = f(movie_width, movie_height),t = /view\/(.+)\//,movie_id = pp_images[set_position].match(t);
             if(!/Mobile/.test(navigator.userAgent)){
             movie = "http://www.tudou.com/v/" + movie_id[1] + "&autoPlay=true&forcePlayRate=99/v.swf",toInject = settings.flash_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g,movie);
             }else{
             movie = "http://www.tudou.com/programs/view/html5embed.action?code=" + movie_id[1],toInject = settings.iframe_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{path}/g, movie);
             }
             break;
           case "sina":
             // you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=102765338/s.swf
             // v.iask.com/v_play_ipad.php?vid=102763201
             b = f(movie_width, movie_height),t = /v\/.\/(\d+)-(\d+)\.html/,movie_id = pp_images[set_position].match(t);
             if(!/Mobile/.test(navigator.userAgent)){
             movie = "http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=" + movie_id[1] + "_" + movie_id[2] + "/s.swf",toInject = settings.flash_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g,movie);
             }else{
             movie = "http://v.iask.com/v_play_ipad.php?vid=" + movie_id[1],toInject = settings.html5v_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{path}/g, movie);
             }
             break;
           case "56":
             // www.56.com/iframe/MTA2ODg0MjE3
             // http://www.56.com/u44/v_MTA2ODg0MjE3.html
             // http://www.56.com/u45/v_MTA4MDUzNzM4.html/1030_r241101547.html
             // http://player.56.com/v_MTA4MDUzNzM4.swf/1030_r241101547.swf
             // http://player.56.com/3000003849/open_MTA4MDUzNzM4.swf
             // <embed src='http://player.56.com/v_MTA4MDUzNzM4.swf/1030_r241101547.swf' type='application/x-shockwave-flash' width='480' height='395'></embed>
             b = f(movie_width, movie_height),t = /v_(.+)\.html/,movie_id = pp_images[set_position].match(t);
             if(!/Mobile/.test(navigator.userAgent)){
             movie = "http://player.56.com/3000003849/open_" + movie_id[1] + ".swf",toInject = settings.flash_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g,movie);
             }else{
             movie = "http://www.56.com/iframe/" + movie_id[1],toInject = settings.iframe_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{path}/g, movie);
             }
             break;
           case "html5v":
             b = f(movie_width, movie_height), movie = pp_images[set_position], toInject = settings.html5v_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{path}/g, movie);
             break;
           // case "quicktime":
           //   b = f(movie_width, movie_height), b.height += 15, b.contentHeight += 15, b.containerHeight += 15, toInject = settings.quicktime_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{wmode}/g, settings.wmode).replace(/{path}/g, pp_images[set_position]).replace(/{autoplay}/g, settings.autoplay);
           //   break;
           case "iframe":
             b = f(movie_width, movie_height), frame_url = pp_images[set_position], frame_url = frame_url.substr(0, frame_url.indexOf("iframe") - 1), toInject = settings.iframe_markup.replace(/{width}/g, b.width).replace(/{height}/g, b.height).replace(/{path}/g, frame_url);
             break;
           case "ajax":
             doresize = !1, b = f(movie_width, movie_height), doresize = !0, skipInjection = !0, e.get(pp_images[set_position], function(e) {
               toInject = settings.inline_markup.replace(/{content}/g, e), $pp_pic_holder.find("#pp_full_res")[0].innerHTML = toInject, o()
             });
             break;
           case "custom":
             b = f(movie_width, movie_height), toInject = settings.custom_markup;
             break;
           case "inline":
             myClone = e(pp_images[set_position]).clone().append('<br clear="all" />').css({'width': settings.default_width}).wrapInner('<div id="pp_full_res"><div class="pp_inline"></div></div>').appendTo(e("body")).show(), doresize = !1, b = f(e(myClone).width(), e(myClone).height()), doresize = !0, e(myClone).remove(), toInject = settings.inline_markup.replace(/{content}/g, e(pp_images[set_position]).html())
         }!imgPreloader && !skipInjection && ($pp_pic_holder.find("#pp_full_res")[0].innerHTML = toInject, o())
       }), !1
     }, e.prettyPhoto.changePage = function(t) {
       currentGalleryPage = 0, t == "previous" ? (set_position--, set_position < 0 && (set_position = e(pp_images).size() - 1)) : t == "next" ? (set_position++, set_position > e(pp_images).size() - 1 && (set_position = 0)) : set_position = t, rel_index = set_position, doresize || (doresize = !0), settings.allow_expand && e(".pp_contract").removeClass("pp_contract").addClass("pp_expand"), u(function() {
         e.prettyPhoto.open()
       })
     }, e.prettyPhoto.changeGalleryPage = function(e) {
       e == "next" ? (currentGalleryPage++, currentGalleryPage > totalPage && (currentGalleryPage = 0)) : e == "previous" ? (currentGalleryPage--, currentGalleryPage < 0 && (currentGalleryPage = totalPage)) : currentGalleryPage = e, slide_speed = e == "next" || e == "previous" ? settings.animation_speed : 0, slide_to = currentGalleryPage * itemsPerPage * itemWidth, $pp_gallery.find("ul").animate({
         left: -slide_to
       }, slide_speed)
     }, e.prettyPhoto.startSlideshow = function() {
       typeof k == "undefined" ? ($pp_pic_holder.find(".pp_play").unbind("click").removeClass("pp_play").addClass("pp_pause").click(function() {
         return e.prettyPhoto.stopSlideshow(), !1
       }), k = setInterval(e.prettyPhoto.startSlideshow, settings.slideshow)) : e.prettyPhoto.changePage("next")
     }, e.prettyPhoto.stopSlideshow = function() {
       $pp_pic_holder.find(".pp_pause").unbind("click").removeClass("pp_pause").addClass("pp_play").click(function() {
         return e.prettyPhoto.startSlideshow(), !1
       }), clearInterval(k), k = undefined
     }, e.prettyPhoto.close = function() {
       if ($pp_overlay.is(":animated")) return;
       e.prettyPhoto.stopSlideshow(), $pp_pic_holder.stop().find("object,embed").css("visibility", "hidden"), e("div.pp_pic_holder,div.ppt,.pp_fade").fadeOut(settings.animation_speed, function() {
         e(this).remove()
       }), $pp_overlay.fadeOut(settings.animation_speed, function() {
         settings.hideflash && e("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility", "visible"), e(this).remove(), e(window).unbind("scroll.prettyphoto"), r(), settings.callback(), doresize = !0, w = !1, delete settings
       })
     }, !pp_alreadyInitialized && t() && (pp_alreadyInitialized = !0, hashIndex = t(), hashRel = hashIndex, hashIndex = hashIndex.substring(hashIndex.indexOf("/") + 1, hashIndex.length - 1), hashRel = hashRel.substring(0, hashRel.indexOf("/")), setTimeout(function() {
       e("a[" + s.hook + "^='" + hashRel + "']:eq(" + hashIndex + ")").trigger("click")
     }, 50)), this.unbind("click.prettyphoto").bind("click.prettyphoto", e.prettyPhoto.initialize)
   }
 })(jQuery);
 var pp_alreadyInitialized = !1;



/*! http://mths.be/placeholder v1.8.5 by @mathias */
// (function(g,a,$){var f='placeholder' in a.createElement('input'),b='placeholder' in a.createElement('textarea');if(f&&b){$.fn.placeholder=function(){return this};$.fn.placeholder.input=$.fn.placeholder.textarea=true}else{$.fn.placeholder=function(){return this.filter((f?'textarea':':input')+'[placeholder]').bind('focus.placeholder',c).bind('blur.placeholder',e).trigger('blur.placeholder').end()};$.fn.placeholder.input=f;$.fn.placeholder.textarea=b;$(function(){$('form').bind('submit.placeholder',function(){var h=$('.placeholder',this).each(c);setTimeout(function(){h.each(e)},10)})});$(g).bind('unload.placeholder',function(){$('.placeholder').val('')})}function d(i){var h={},j=/^jQuery\d+$/;$.each(i.attributes,function(l,k){if(k.specified&&!j.test(k.name)){h[k.name]=k.value}});return h}function c(){var h=$(this);if(h.val()===h.attr('placeholder')&&h.hasClass('placeholder')){if(h.data('placeholder-password')){h.hide().next().show().focus().attr('id',h.removeAttr('id').data('placeholder-id'))}else{h.val('').removeClass('placeholder')}}}function e(){var l,k=$(this),h=k,j=this.id;if(k.val()===''){if(k.is(':password')){if(!k.data('placeholder-textinput')){try{l=k.clone().attr({type:'text'})}catch(i){l=$('<input>').attr($.extend(d(this),{type:'text'}))}l.removeAttr('name').data('placeholder-password',true).data('placeholder-id',j).bind('focus.placeholder',c);k.data('placeholder-textinput',l).data('placeholder-id',j).before(l)}k=k.removeAttr('id').hide().prev().attr('id',j).show()}k.addClass('placeholder').val(k.attr('placeholder'))}else{k.removeClass('placeholder')}}}(this,document,jQuery));


/*
 * Linkify and Relative Time functions by Ralph Whitbeck http://ralphwhitbeck.com/2007/11/20/PullingTwitterUpdatesWithJSONAndJQuery.aspx
 */
// String.prototype.linkify = function() {
//   return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(m) {
//       return m.link(m);
//   })/*.split('<a href').join('</br><a href').split('/a>').join('/a></br>')*/;
// };

// function relative_time(time_value) {
//   var values = time_value.split(" ");
//   time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
//   var parsed_date = Date.parse(time_value);
//   var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
//   var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
//   delta = delta + (relative_to.getTimezoneOffset() * 60);

//   var r = '';
//   if (delta < 60) {
//         r = 'a minute ago';
//   } else if(delta < 120) {
//         r = 'couple of minutes ago';
//   } else if(delta < (45*60)) {
//         r = (parseInt(delta / 60)).toString() + ' minutes ago';
//   } else if(delta < (90*60)) {
//         r = 'an hour ago';
//   } else if(delta < (24*60*60)) {
//         r = '' + (parseInt(delta / 3600)).toString() + ' hours ago';
//   } else if(delta < (48*60*60)) {
//         r = '1 day ago';
//   } else {
//         r = (parseInt(delta / 86400)).toString() + ' days ago';
//   }
  
//   return r;
// }


// function validateEmail(email) {
//   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
//   if( !emailReg.test(email) ) {
//     return false;
//   }
//   else {
//     return true;
//   }
// }

/**
 * Isotope v1.5.26
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Copyright 2014 Metafizzy
 */
!function(t,i){"use strict";var s,e=t.document,n=e.documentElement,o=t.Modernizr,r=function(t){return t.charAt(0).toUpperCase()+t.slice(1)},a="Moz Webkit O Ms".split(" "),h=function(t){var i,s=n.style;if("string"==typeof s[t])return t;t=r(t);for(var e=0,o=a.length;o>e;e++)if(i=a[e]+t,"string"==typeof s[i])return i},l=h("transform"),u=h("transitionProperty"),c={csstransforms:function(){return!!l},csstransforms3d:function(){var t=!!h("perspective");if(t&&"webkitPerspective"in n.style){var s=i("<style>@media (transform-3d),(-webkit-transform-3d){#modernizr{height:3px}}</style>").appendTo("head"),e=i('<div id="modernizr" />').appendTo("html");t=3===e.height(),e.remove(),s.remove()}return t},csstransitions:function(){return!!u}};if(o)for(s in c)o.hasOwnProperty(s)||o.addTest(s,c[s]);else{o=t.Modernizr={_version:"1.6ish: miniModernizr for Isotope"};var d,f=" ";for(s in c)d=c[s](),o[s]=d,f+=" "+(d?"":"no-")+s;i("html").addClass(f)}if(o.csstransforms){var m=o.csstransforms3d?{translate:function(t){return"translate3d("+t[0]+"px, "+t[1]+"px, 0) "},scale:function(t){return"scale3d("+t+", "+t+", 1) "}}:{translate:function(t){return"translate("+t[0]+"px, "+t[1]+"px) "},scale:function(t){return"scale("+t+") "}},p=function(t,s,e){var n,o,r=i.data(t,"isoTransform")||{},a={},h={};a[s]=e,i.extend(r,a);for(n in r)o=r[n],h[n]=m[n](o);var u=h.translate||"",c=h.scale||"",d=u+c;i.data(t,"isoTransform",r),t.style[l]=d};i.cssNumber.scale=!0,i.cssHooks.scale={set:function(t,i){p(t,"scale",i)},get:function(t){var s=i.data(t,"isoTransform");return s&&s.scale?s.scale:1}},i.fx.step.scale=function(t){i.cssHooks.scale.set(t.elem,t.now+t.unit)},i.cssNumber.translate=!0,i.cssHooks.translate={set:function(t,i){p(t,"translate",i)},get:function(t){var s=i.data(t,"isoTransform");return s&&s.translate?s.translate:[0,0]}}}var y,g;o.csstransitions&&(y={WebkitTransitionProperty:"webkitTransitionEnd",MozTransitionProperty:"transitionend",OTransitionProperty:"oTransitionEnd otransitionend",transitionProperty:"transitionend"}[u],g=h("transitionDuration"));var v,_=i.event,A=i.event.handle?"handle":"dispatch";_.special.smartresize={setup:function(){i(this).bind("resize",_.special.smartresize.handler)},teardown:function(){i(this).unbind("resize",_.special.smartresize.handler)},handler:function(t,i){var s=this,e=arguments;t.type="smartresize",v&&clearTimeout(v),v=setTimeout(function(){_[A].apply(s,e)},"execAsap"===i?0:100)}},i.fn.smartresize=function(t){return t?this.bind("smartresize",t):this.trigger("smartresize",["execAsap"])},i.Isotope=function(t,s,e){this.element=i(s),this._create(t),this._init(e)};var w=["width","height"],C=i(t);i.Isotope.settings={resizable:!0,layoutMode:"masonry",containerClass:"isotope",itemClass:"isotope-item",hiddenClass:"isotope-hidden",hiddenStyle:{opacity:0,scale:.001},visibleStyle:{opacity:1,scale:1},containerStyle:{position:"relative",overflow:"hidden"},animationEngine:"best-available",animationOptions:{queue:!1,duration:800},sortBy:"original-order",sortAscending:!0,resizesContainer:!0,transformsEnabled:!0,itemPositionDataEnabled:!1},i.Isotope.prototype={_create:function(t){this.options=i.extend({},i.Isotope.settings,t),this.styleQueue=[],this.elemCount=0;var s=this.element[0].style;this.originalStyle={};var e=w.slice(0);for(var n in this.options.containerStyle)e.push(n);for(var o=0,r=e.length;r>o;o++)n=e[o],this.originalStyle[n]=s[n]||"";this.element.css(this.options.containerStyle),this._updateAnimationEngine(),this._updateUsingTransforms();var a={"original-order":function(t,i){return i.elemCount++,i.elemCount},random:function(){return Math.random()}};this.options.getSortData=i.extend(this.options.getSortData,a),this.reloadItems(),this.offset={left:parseInt(this.element.css("padding-left")||0,10),top:parseInt(this.element.css("padding-top")||0,10)};var h=this;setTimeout(function(){h.element.addClass(h.options.containerClass)},0),this.options.resizable&&C.bind("smartresize.isotope",function(){h.resize()}),this.element.delegate("."+this.options.hiddenClass,"click",function(){return!1})},_getAtoms:function(t){var i=this.options.itemSelector,s=i?t.filter(i).add(t.find(i)):t,e={position:"absolute"};return s=s.filter(function(t,i){return 1===i.nodeType}),this.usingTransforms&&(e.left=0,e.top=0),s.css(e).addClass(this.options.itemClass),this.updateSortData(s,!0),s},_init:function(t){this.$filteredAtoms=this._filter(this.$allAtoms),this._sort(),this.reLayout(t)},option:function(t){if(i.isPlainObject(t)){this.options=i.extend(!0,this.options,t);var s;for(var e in t)s="_update"+r(e),this[s]&&this[s]()}},_updateAnimationEngine:function(){var t,i=this.options.animationEngine.toLowerCase().replace(/[ _\-]/g,"");switch(i){case"css":case"none":t=!1;break;case"jquery":t=!0;break;default:t=!o.csstransitions}this.isUsingJQueryAnimation=t,this._updateUsingTransforms()},_updateTransformsEnabled:function(){this._updateUsingTransforms()},_updateUsingTransforms:function(){var t=this.usingTransforms=this.options.transformsEnabled&&o.csstransforms&&o.csstransitions&&!this.isUsingJQueryAnimation;t||(delete this.options.hiddenStyle.scale,delete this.options.visibleStyle.scale),this.getPositionStyles=t?this._translate:this._positionAbs},_filter:function(t){var i=""===this.options.filter?"*":this.options.filter;if(!i)return t;var s=this.options.hiddenClass,e="."+s,n=t.filter(e),o=n;if("*"!==i){o=n.filter(i);var r=t.not(e).not(i).addClass(s);this.styleQueue.push({$el:r,style:this.options.hiddenStyle})}return this.styleQueue.push({$el:o,style:this.options.visibleStyle}),o.removeClass(s),t.filter(i)},updateSortData:function(t,s){var e,n,o=this,r=this.options.getSortData;t.each(function(){e=i(this),n={};for(var t in r)n[t]=s||"original-order"!==t?r[t](e,o):i.data(this,"isotope-sort-data")[t];i.data(this,"isotope-sort-data",n)})},_sort:function(){var t=this.options.sortBy,i=this._getSorter,s=this.options.sortAscending?1:-1,e=function(e,n){var o=i(e,t),r=i(n,t);return o===r&&"original-order"!==t&&(o=i(e,"original-order"),r=i(n,"original-order")),(o>r?1:r>o?-1:0)*s};this.$filteredAtoms.sort(e)},_getSorter:function(t,s){return i.data(t,"isotope-sort-data")[s]},_translate:function(t,i){return{translate:[t,i]}},_positionAbs:function(t,i){return{left:t,top:i}},_pushPosition:function(t,i,s){i=Math.round(i+this.offset.left),s=Math.round(s+this.offset.top);var e=this.getPositionStyles(i,s);this.styleQueue.push({$el:t,style:e}),this.options.itemPositionDataEnabled&&t.data("isotope-item-position",{x:i,y:s})},layout:function(t,i){var s=this.options.layoutMode;if(this["_"+s+"Layout"](t),this.options.resizesContainer){var e=this["_"+s+"GetContainerSize"]();this.styleQueue.push({$el:this.element,style:e})}this._processStyleQueue(t,i),this.isLaidOut=!0},_processStyleQueue:function(t,s){var e,n,r,a,h=this.isLaidOut?this.isUsingJQueryAnimation?"animate":"css":"css",l=this.options.animationOptions,u=this.options.onLayout;if(n=function(t,i){i.$el[h](i.style,l)},this._isInserting&&this.isUsingJQueryAnimation)n=function(t,i){e=i.$el.hasClass("no-transition")?"css":h,i.$el[e](i.style,l)};else if(s||u||l.complete){var c=!1,d=[s,u,l.complete],f=this;if(r=!0,a=function(){if(!c){for(var i,s=0,e=d.length;e>s;s++)i=d[s],"function"==typeof i&&i.call(f.element,t,f);c=!0}},this.isUsingJQueryAnimation&&"animate"===h)l.complete=a,r=!1;else if(o.csstransitions){for(var m,p=0,v=this.styleQueue[0],_=v&&v.$el;!_||!_.length;){if(m=this.styleQueue[p++],!m)return;_=m.$el}var A=parseFloat(getComputedStyle(_[0])[g]);A>0&&(n=function(t,i){i.$el[h](i.style,l).one(y,a)},r=!1)}}i.each(this.styleQueue,n),r&&a(),this.styleQueue=[]},resize:function(){this["_"+this.options.layoutMode+"ResizeChanged"]()&&this.reLayout()},reLayout:function(t){this["_"+this.options.layoutMode+"Reset"](),this.layout(this.$filteredAtoms,t)},addItems:function(t,i){var s=this._getAtoms(t);this.$allAtoms=this.$allAtoms.add(s),i&&i(s)},insert:function(t,i){this.element.append(t);var s=this;this.addItems(t,function(t){var e=s._filter(t);s._addHideAppended(e),s._sort(),s.reLayout(),s._revealAppended(e,i)})},appended:function(t,i){var s=this;this.addItems(t,function(t){s._addHideAppended(t),s.layout(t),s._revealAppended(t,i)})},_addHideAppended:function(t){this.$filteredAtoms=this.$filteredAtoms.add(t),t.addClass("no-transition"),this._isInserting=!0,this.styleQueue.push({$el:t,style:this.options.hiddenStyle})},_revealAppended:function(t,i){var s=this;setTimeout(function(){t.removeClass("no-transition"),s.styleQueue.push({$el:t,style:s.options.visibleStyle}),s._isInserting=!1,s._processStyleQueue(t,i)},10)},reloadItems:function(){this.$allAtoms=this._getAtoms(this.element.children())},remove:function(t,i){this.$allAtoms=this.$allAtoms.not(t),this.$filteredAtoms=this.$filteredAtoms.not(t);var s=this,e=function(){t.remove(),i&&i.call(s.element)};t.filter(":not(."+this.options.hiddenClass+")").length?(this.styleQueue.push({$el:t,style:this.options.hiddenStyle}),this._sort(),this.reLayout(e)):e()},shuffle:function(t){this.updateSortData(this.$allAtoms),this.options.sortBy="random",this._sort(),this.reLayout(t)},destroy:function(){var t=this.usingTransforms,i=this.options;this.$allAtoms.removeClass(i.hiddenClass+" "+i.itemClass).each(function(){var i=this.style;i.position="",i.top="",i.left="",i.opacity="",t&&(i[l]="")});var s=this.element[0].style;for(var e in this.originalStyle)s[e]=this.originalStyle[e];this.element.unbind(".isotope").undelegate("."+i.hiddenClass,"click").removeClass(i.containerClass).removeData("isotope"),C.unbind(".isotope")},_getSegments:function(t){var i,s=this.options.layoutMode,e=t?"rowHeight":"columnWidth",n=t?"height":"width",o=t?"rows":"cols",a=this.element[n](),h=this.options[s]&&this.options[s][e]||this.$filteredAtoms["outer"+r(n)](!0)||a;i=Math.floor(a/h),i=Math.max(i,1),this[s][o]=i,this[s][e]=h},_checkIfSegmentsChanged:function(t){var i=this.options.layoutMode,s=t?"rows":"cols",e=this[i][s];return this._getSegments(t),this[i][s]!==e},_masonryReset:function(){this.masonry={},this._getSegments();var t=this.masonry.cols;for(this.masonry.colYs=[];t--;)this.masonry.colYs.push(0)},_masonryLayout:function(t){var s=this,e=s.masonry;t.each(function(){var t=i(this),n=Math.ceil(t.outerWidth(!0)/e.columnWidth);if(n=Math.min(n,e.cols),1===n)s._masonryPlaceBrick(t,e.colYs);else{var o,r,a=e.cols+1-n,h=[];for(r=0;a>r;r++)o=e.colYs.slice(r,r+n),h[r]=Math.max.apply(Math,o);s._masonryPlaceBrick(t,h)}})},_masonryPlaceBrick:function(t,i){for(var s=Math.min.apply(Math,i),e=0,n=0,o=i.length;o>n;n++)if(i[n]===s){e=n;break}var r=this.masonry.columnWidth*e,a=s;this._pushPosition(t,r,a);var h=s+t.outerHeight(!0),l=this.masonry.cols+1-o;for(n=0;l>n;n++)this.masonry.colYs[e+n]=h},_masonryGetContainerSize:function(){var t=Math.max.apply(Math,this.masonry.colYs);return{height:t}},_masonryResizeChanged:function(){return this._checkIfSegmentsChanged()},_fitRowsReset:function(){this.fitRows={x:0,y:0,height:0}},_fitRowsLayout:function(t){var s=this,e=this.element.width(),n=this.fitRows;t.each(function(){var t=i(this),o=t.outerWidth(!0),r=t.outerHeight(!0);0!==n.x&&o+n.x>e&&(n.x=0,n.y=n.height),s._pushPosition(t,n.x,n.y),n.height=Math.max(n.y+r,n.height),n.x+=o})},_fitRowsGetContainerSize:function(){return{height:this.fitRows.height}},_fitRowsResizeChanged:function(){return!0},_cellsByRowReset:function(){this.cellsByRow={index:0},this._getSegments(),this._getSegments(!0)},_cellsByRowLayout:function(t){var s=this,e=this.cellsByRow;t.each(function(){var t=i(this),n=e.index%e.cols,o=Math.floor(e.index/e.cols),r=(n+.5)*e.columnWidth-t.outerWidth(!0)/2,a=(o+.5)*e.rowHeight-t.outerHeight(!0)/2;s._pushPosition(t,r,a),e.index++})},_cellsByRowGetContainerSize:function(){return{height:Math.ceil(this.$filteredAtoms.length/this.cellsByRow.cols)*this.cellsByRow.rowHeight+this.offset.top}},_cellsByRowResizeChanged:function(){return this._checkIfSegmentsChanged()},_straightDownReset:function(){this.straightDown={y:0}},_straightDownLayout:function(t){var s=this;t.each(function(){var t=i(this);s._pushPosition(t,0,s.straightDown.y),s.straightDown.y+=t.outerHeight(!0)})},_straightDownGetContainerSize:function(){return{height:this.straightDown.y}},_straightDownResizeChanged:function(){return!0},_masonryHorizontalReset:function(){this.masonryHorizontal={},this._getSegments(!0);var t=this.masonryHorizontal.rows;for(this.masonryHorizontal.rowXs=[];t--;)this.masonryHorizontal.rowXs.push(0)},_masonryHorizontalLayout:function(t){var s=this,e=s.masonryHorizontal;t.each(function(){var t=i(this),n=Math.ceil(t.outerHeight(!0)/e.rowHeight);if(n=Math.min(n,e.rows),1===n)s._masonryHorizontalPlaceBrick(t,e.rowXs);else{var o,r,a=e.rows+1-n,h=[];for(r=0;a>r;r++)o=e.rowXs.slice(r,r+n),h[r]=Math.max.apply(Math,o);s._masonryHorizontalPlaceBrick(t,h)}})},_masonryHorizontalPlaceBrick:function(t,i){for(var s=Math.min.apply(Math,i),e=0,n=0,o=i.length;o>n;n++)if(i[n]===s){e=n;break}var r=s,a=this.masonryHorizontal.rowHeight*e;this._pushPosition(t,r,a);var h=s+t.outerWidth(!0),l=this.masonryHorizontal.rows+1-o;for(n=0;l>n;n++)this.masonryHorizontal.rowXs[e+n]=h},_masonryHorizontalGetContainerSize:function(){var t=Math.max.apply(Math,this.masonryHorizontal.rowXs);return{width:t}},_masonryHorizontalResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_fitColumnsReset:function(){this.fitColumns={x:0,y:0,width:0}},_fitColumnsLayout:function(t){var s=this,e=this.element.height(),n=this.fitColumns;t.each(function(){var t=i(this),o=t.outerWidth(!0),r=t.outerHeight(!0);0!==n.y&&r+n.y>e&&(n.x=n.width,n.y=0),s._pushPosition(t,n.x,n.y),n.width=Math.max(n.x+o,n.width),n.y+=r})},_fitColumnsGetContainerSize:function(){return{width:this.fitColumns.width}},_fitColumnsResizeChanged:function(){return!0},_cellsByColumnReset:function(){this.cellsByColumn={index:0},this._getSegments(),this._getSegments(!0)},_cellsByColumnLayout:function(t){var s=this,e=this.cellsByColumn;t.each(function(){var t=i(this),n=Math.floor(e.index/e.rows),o=e.index%e.rows,r=(n+.5)*e.columnWidth-t.outerWidth(!0)/2,a=(o+.5)*e.rowHeight-t.outerHeight(!0)/2;s._pushPosition(t,r,a),e.index++})},_cellsByColumnGetContainerSize:function(){return{width:Math.ceil(this.$filteredAtoms.length/this.cellsByColumn.rows)*this.cellsByColumn.columnWidth}},_cellsByColumnResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_straightAcrossReset:function(){this.straightAcross={x:0}},_straightAcrossLayout:function(t){var s=this;t.each(function(){var t=i(this);s._pushPosition(t,s.straightAcross.x,0),s.straightAcross.x+=t.outerWidth(!0)})},_straightAcrossGetContainerSize:function(){return{width:this.straightAcross.x}},_straightAcrossResizeChanged:function(){return!0}},i.fn.imagesLoaded=function(t){function s(){t.call(n,o)}function e(t){var n=t.target;n.src!==a&&-1===i.inArray(n,h)&&(h.push(n),--r<=0&&(setTimeout(s),o.unbind(".imagesLoaded",e)))}var n=this,o=n.find("img").add(n.filter("img")),r=o.length,a="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",h=[];return r||s(),o.bind("load.imagesLoaded error.imagesLoaded",e).each(function(){var t=this.src;this.src=a,this.src=t}),n};var z=function(i){t.console&&t.console.error(i)};i.fn.isotope=function(t,s){if("string"==typeof t){var e=Array.prototype.slice.call(arguments,1);this.each(function(){var s=i.data(this,"isotope");return s?i.isFunction(s[t])&&"_"!==t.charAt(0)?void s[t].apply(s,e):void z("no such method '"+t+"' for isotope instance"):void z("cannot call methods on isotope prior to initialization; attempted to call method '"+t+"'")})}else this.each(function(){var e=i.data(this,"isotope");e?(e.option(t),e._init(s)):i.data(this,"isotope",new i.Isotope(t,this,s))});return this}}(window,jQuery);


/**
*Gravatar
*/
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1;};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p;}('f P=0;f U="";l 1x(s){n 1i(X(z(s)))};l 35(s){n 1a(X(z(s)))};l 1V(s,e){n 1b(X(z(s)),e)};l 1E(k,d){n 1i(V(z(k),z(d)))};l 1J(k,d){n 1a(V(z(k),z(d)))};l 1K(k,d,e){n 1b(V(z(k),z(d)),e)};l 1I(){n 1x("1H").2e()=="2f"};l X(s){n 1f(M(W(s),s.m*8))};l V(1e,1k){f L=W(1e);C(L.m>16){L=M(L,1e.m*8)};f 1l=E(16),1j=E(16);v(f i=0;i<16;i++){1l[i]=L[i]^2g;1j[i]=L[i]^1Y};f 1r=M(1l.1s(W(1k)),1C+1k.m*8);n 1f(M(1j.1s(1r),1C+D))};l 1i(g){1B{P}1y(e){P=0};f 19=P?"26":"2i";f h="";f x;v(f i=0;i<g.m;i++){x=g.w(i);h+=19.R((x>>>4)&15)+19.R(x&15)};n h};l 1a(g){1B{U}1y(e){U=""};f 1A="1G+/";f h="";f A=g.m;v(f i=0;i<A;i+=3){f 1z=(g.w(i)<<16)|(i+1<A?g.w(i+1)<<8:0)|(i+2<A?g.w(i+2):0);v(f j=0;j<4;j++){C(i*8+j*6>g.m*8){h+=U}T{h+=1A.R((1z>>>6*(3-j))&F)}}};n h};l 1b(g,Q){f Z=Q.m;f i,j,q,x,J;f K=E(O.1o(g.m/2));v(i=0;i<K.m;i++){K[i]=(g.w(i*2)<<8)|g.w(i*2+1)};f 1c=O.1o(g.m*8/(O.1n(Q.m)/O.1n(2)));f S=E(1c);v(j=0;j<1c;j++){J=E();x=0;v(i=0;i<K.m;i++){x=(x<<16)+K[i];q=O.2d(x/Z);x-=q*Z;C(J.m>0||q>0){J[J.m]=q}};S[j]=x;K=J};f h="";v(i=S.m-1;i>=0;i--){h+=Q.R(S[i])};n h};l z(g){f h="";f i=-1;f x,y;25(++i<g.m){x=g.w(i);y=i+1<g.m?g.w(i+1):0;C(27<=x&&x<=29&&28<=y&&y<=1X){x=1W+((x&1m)<<10)+(y&1m);i++};C(x<=24){h+=G.H(x)}T{C(x<=1Z){h+=G.H(2a|((x>>>6)&31),D|(x&F))}T{C(x<=Y){h+=G.H(2h|((x>>>12)&15),D|((x>>>6)&F),D|(x&F))}T{C(x<=2k){h+=G.H(2j|((x>>>18)&7),D|((x>>>12)&F),D|((x>>>6)&F),D|(x&F))}}}}};n h};l 2c(g){f h="";v(f i=0;i<g.m;i++){h+=G.H(g.w(i)&I,(g.w(i)>>>8)&I)};n h};l 2b(g){f h="";v(f i=0;i<g.m;i++){h+=G.H((g.w(i)>>>8)&I,g.w(i)&I)};n h};l W(g){f h=E(g.m>>2);v(f i=0;i<h.m;i++){h[i]=0};v(f i=0;i<g.m*8;i+=8){h[i>>5]|=(g.w(i/8)&I)<<(i%32)};n h};l 1f(g){f h="";v(f i=0;i<g.m*32;i+=8){h+=G.H((g[i>>5]>>>(i%32))&I)};n h};l M(x,A){x[A>>5]|=D<<((A)%32);x[(((A+1D)>>>9)<<4)+14]=A;f a=1F;f b=-1S;f c=-1R;f d=1T;v(f i=0;i<x.m;i+=16){f 1p=a;f 1q=b;f 1t=c;f 1w=d;a=o(a,b,c,d,x[i+0],7,-1U);d=o(d,a,b,c,x[i+1],12,-1Q);c=o(c,d,a,b,x[i+2],17,1M);b=o(b,c,d,a,x[i+3],22,-1L);a=o(a,b,c,d,x[i+4],7,-1N);d=o(d,a,b,c,x[i+5],12,1P);c=o(c,d,a,b,x[i+6],17,-1O);b=o(b,c,d,a,x[i+7],22,-2l);a=o(a,b,c,d,x[i+8],7,2X);d=o(d,a,b,c,x[i+9],12,-2Y);c=o(c,d,a,b,x[i+10],17,-30);b=o(b,c,d,a,x[i+11],22,-2Z);a=o(a,b,c,d,x[i+12],7,33);d=o(d,a,b,c,x[i+13],12,-36);c=o(c,d,a,b,x[i+14],17,-34);b=o(b,c,d,a,x[i+15],22,2S);a=p(a,b,c,d,x[i+1],5,-2R);d=p(d,a,b,c,x[i+6],9,-2Q);c=p(c,d,a,b,x[i+11],14,2T);b=p(b,c,d,a,x[i+0],20,-2W);a=p(a,b,c,d,x[i+5],5,-2V);d=p(d,a,b,c,x[i+10],9,2U);c=p(c,d,a,b,x[i+15],14,-37);b=p(b,c,d,a,x[i+4],20,-3h);a=p(a,b,c,d,x[i+9],5,3i);d=p(d,a,b,c,x[i+14],9,-3a);c=p(c,d,a,b,x[i+3],14,-38);b=p(b,c,d,a,x[i+8],20,3e);a=p(a,b,c,d,x[i+13],5,-3d);d=p(d,a,b,c,x[i+2],9,-3c);c=p(c,d,a,b,x[i+7],14,39);b=p(b,c,d,a,x[i+12],20,-3b);a=r(a,b,c,d,x[i+5],4,-3f);d=r(d,a,b,c,x[i+8],11,-3g);c=r(c,d,a,b,x[i+11],16,2w);b=r(b,c,d,a,x[i+14],23,-2v);a=r(a,b,c,d,x[i+1],4,-2u);d=r(d,a,b,c,x[i+4],11,2x);c=r(c,d,a,b,x[i+7],16,-2A);b=r(b,c,d,a,x[i+10],23,-2z);a=r(a,b,c,d,x[i+13],4,2y);d=r(d,a,b,c,x[i+0],11,-2t);c=r(c,d,a,b,x[i+3],16,-2o);b=r(b,c,d,a,x[i+6],23,2n);a=r(a,b,c,d,x[i+9],4,-2m);d=r(d,a,b,c,x[i+12],11,-2p);c=r(c,d,a,b,x[i+15],16,2s);b=r(b,c,d,a,x[i+2],23,-2r);a=u(a,b,c,d,x[i+0],6,-2q);d=u(d,a,b,c,x[i+7],10,2L);c=u(c,d,a,b,x[i+14],15,-2K);b=u(b,c,d,a,x[i+5],21,-2J);a=u(a,b,c,d,x[i+12],6,2M);d=u(d,a,b,c,x[i+3],10,-2P);c=u(c,d,a,b,x[i+10],15,-2O);b=u(b,c,d,a,x[i+1],21,-2N);a=u(a,b,c,d,x[i+8],6,2I);d=u(d,a,b,c,x[i+15],10,-2D);c=u(c,d,a,b,x[i+6],15,-2C);b=u(b,c,d,a,x[i+13],21,2B);a=u(a,b,c,d,x[i+4],6,-2E);d=u(d,a,b,c,x[i+11],10,-2H);c=u(c,d,a,b,x[i+2],15,2G);b=u(b,c,d,a,x[i+9],21,-2F);a=B(a,1p);b=B(b,1q);c=B(c,1t);d=B(d,1w)};n E(a,b,c,d)};l N(q,a,b,x,s,t){n B(1v(B(B(a,q),B(x,t)),s),b)};l o(a,b,c,d,x,s,t){n N((b&c)|((~b)&d),a,b,x,s,t)};l p(a,b,c,d,x,s,t){n N((b&d)|(c&(~d)),a,b,x,s,t)};l r(a,b,c,d,x,s,t){n N(b^c^d,a,b,x,s,t)};l u(a,b,c,d,x,s,t){n N(c^(b|(~d)),a,b,x,s,t)};l B(x,y){f 1h=(x&Y)+(y&Y);f 1u=(x>>16)+(y>>16)+(1h>>16);n(1u<<16)|(1h&Y)};l 1v(1g,1d){n(1g<<1d)|(1g>>>(32-1d))};',62,205,'|||||||||||||||var|input|output||||function|length|return|md5_ff|md5_gg||md5_hh|||md5_ii|for|charCodeAt|||str2rstr_utf8|len|safe_add|if|128|Array|63|String|fromCharCode|255|quotient|dividend|bkey|binl_md5|md5_cmn|Math|hexcase|encoding|charAt|remainders|else|b64pad|rstr_hmac_md5|rstr2binl|rstr_md5|65535|divisor||||||||||hex_tab|rstr2b64|rstr2any|full_length|cnt|key|binl2rstr|num|lsw|rstr2hex|opad|data|ipad|1023|log|ceil|olda|oldb|hash|concat|oldc|msw|bit_rol|oldd|hex_md5|catch|triplet|tab|try|512|64|hex_hmac_md5|1732584193|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|abc|md5_vm_test|b64_hmac_md5|any_hmac_md5|1044525330|606105819|176418897|1473231341|1200080426|389564586|1732584194|271733879|271733878|680876936|any_md5|65536|57343|1549556828|2047|||||127|while|0123456789ABCDEF|55296|56320|56319|192|str2rstr_utf16be|str2rstr_utf16le|floor|toLowerCase|900150983cd24fb0d6963f7d28e17f72|909522486|224|0123456789abcdef|240|2097151|45705983|640364487|76029189|722521979|421815835|198630844|995338651|530742520|358537222|1530992060|35309556|1839030562|1272893353|681279174|1094730640|155497632|1309151649|1560198380|30611744|145523070|343485551|718787259|1120210379|1873313359|57434055|1416354905|1126891415|1700485571|2054922799|1051523|1894986606|1069501632|165796510|1236535329|643717713|38016083|701558691|373897302|1770035416|1958414417|1990404162|42063|||1804603682|1502002290|b64_md5|40341101|660478335|187363961|1735328473|1019803690|1926607734|51403784|1444681467|1163531501|378558|2022574463|405537848|568446438'.split('|'),0,{}));




/**
*Others
*/

// 评论功能
var addComment={moveForm:function(a,b,c,d){var e,f=this,g=f.I(a),h=f.I(c),i=f.I("cancel-comment-reply-link"),j=f.I("comment_parent"),k=f.I("comment_post_ID");if(g&&h&&i&&j){f.respondId=c,d=d||!1,f.I("wp-temp-form-div")||(e=document.createElement("div"),e.id="wp-temp-form-div",e.style.display="none",h.parentNode.insertBefore(e,h)),g.parentNode.insertBefore(h,g.nextSibling),k&&d&&(k.value=d),j.value=b,i.style.display="",i.onclick=function(){var a=addComment,b=a.I("wp-temp-form-div"),c=a.I(a.respondId);if(b&&c)return a.I("comment_parent").value="0",b.parentNode.insertBefore(c,b),b.parentNode.removeChild(b),this.style.display="none",this.onclick=null,!1};try{f.I("comment").focus()}catch(l){}return!1}},I:function(a){return document.getElementById(a)}};

jQuery(document).ready(function($){
  /* === Gravatar === */
  $('#email').blur(function(){$('img.gravatar').attr('src','http://www.gravatar.com/avatar.php?gravatar_id=' + hex_md5($('#email').val()) + '&size=40&r=G&d=mm')});

  /* === Pretty Photo === */
  $("a[rel^='prettyPhoto'],a[href$='.jpg'],a[href$='.gif'],a[href$='.png']").prettyPhoto();
 
  /* === Portfolio Filter Menu === */
  var $container= $('#portfolio-list');
  $container.isotope({
    filter: '*',
    layoutMode: 'masonry',
    animationOptions: {
      duration:750,
      easing:'linear'
     }
  }); 
  $('body').on('click','#portfolio-filter a', function(e) {
    e.preventDefault();
    $('.active').removeClass('active');
    $(this).parent().addClass('active');
    var selector = $(this).attr('data-filter');
    $container.isotope({ 
      filter: selector,
      animationOptions  : {
        duration: 750,
        easing: 'linear',
        queue: false,
       }
    });
  // $container.isotope('reLayout');
  }); 
  // 原来的生硬动画
  // $('ul.filter li a').click(function(e) {
  //   e.preventDefault();
  //   $('ul.filter li.active').removeClass('active');
  //   $(this).parent().addClass('active');
  //   var filterVal = $(this).text().toLowerCase().replace(' ','-');
  //   if($(this).parent().data('text')=="all") {
  //     $('.work').removeClass('item-hidden');
  //   }
  //   else {
  //     $('.work').each(function(index, element) {
  //       if(!$(this).hasClass(filterVal)) {
  //         $(this).addClass('item-hidden');
  //       }
  //       else {
  //         $(this).removeClass('item-hidden');
  //       }
  //     });
  //   }
  // });

  /* === Tabs === */
  $('body').on('click','ul.tabs > li > a', function(e) {
    var contentLocation = $(this).attr('href');
    if(contentLocation.charAt(0)=="#") {
      e.preventDefault();
      $(this).parent().siblings().children('a').removeClass('active');
      $(this).addClass('active');
      $(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
    }
  });

  /* === Accordion === */
  $('body').on('click','.accordion > .atitle > a', function(e) {
    var accordionTabs = $('.accordion > .atab');
    e.preventDefault();   
    currenttab = $(this);
    targetTab =  currenttab.parent().next();
    if (currenttab.parent().hasClass('active')) {
      accordionTabs.slideUp(300, 'easeOutExpo');
      currenttab.parent().parent().find('.atitle').removeClass('active');
    }
    else if(!targetTab.hasClass('active'))  {
      accordionTabs.slideUp(300, 'easeOutExpo');
      targetTab.slideDown(300, 'easeOutExpo');
      currenttab.parent().parent().find('.atitle').removeClass('active');
      currenttab.parent().addClass('active');
    }
  });
  
  /* === Toggle === */
  $('body').on('click','.toggle > .ttitle > a', function(e) {
    e.preventDefault();
    if($(this).parent().hasClass('active')) {
      $(this).parent().removeClass("active").closest('.toggle').find('.ttab').slideUp(300, 'easeOutExpo');
    }
    else {
      $(this).parent().addClass("active").closest('.toggle').find('.ttab').slideDown(300, 'easeOutExpo');
    }
  });

  /* === go Top and Left Menu === */ 
  var upperLimit = 100, menuLimit= 200; 
  var gotop = $('a#gotop'), menu=$('nav');
  var scrollSpeed = 500;
  gotop.hide();
  $(window).scroll(function () {      
    var scrollTop = $(document).scrollTop();    
    if (scrollTop > upperLimit ) {
      $(gotop).stop().fadeTo(300, 1); // fade back in     
    }else{    
      $(gotop).stop().fadeTo(300, 0); // fade out
    }
    if (scrollTop > menuLimit ) {
      $(menu).stop().animate({"top":scrollTop},200);
    }else{    
      $(menu).stop().animate({"top":"0"},200);
    }
  });
  // Scroll to top
  gotop.click(function(){ 
    $('html,body').animate({scrollTop:0}, scrollSpeed); return false; 
  });
})

  /* === Handles palceholder values for input and textareas in older browsers === */
      // $('input, textarea').placeholder();

  /* === Fit Videos === */
      // $(".scale-video").fitVids();

  /* === Handles multiple functions for window.onload event === */
  // function addLoadEvent(func) {
  //   var oldonload = window.onload;
  //   if (typeof window.onload != 'function') {
  //     window.onload = func;
  //   }
  //   else {
  //     window.onload = function() {
  //       if (oldonload) {
  //         oldonload();
  //       }
  //       func();
  //     }
  //   }
  // }