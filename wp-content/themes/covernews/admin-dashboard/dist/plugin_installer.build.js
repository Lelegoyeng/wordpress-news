!function(t){var a={};function n(e){if(a[e])return a[e].exports;var l=a[e]={i:e,l:!1,exports:{}};return t[e].call(l.exports,l,l.exports,n),l.l=!0,l.exports}n.m=t,n.c=a,n.d=function(t,a,e){n.o(t,a)||Object.defineProperty(t,a,{enumerable:!0,get:e})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,a){if(1&a&&(t=n(t)),8&a)return t;if(4&a&&"object"==typeof t&&t&&t.__esModule)return t;var e=Object.create(null);if(n.r(e),Object.defineProperty(e,"default",{enumerable:!0,value:t}),2&a&&"string"!=typeof t)for(var l in t)n.d(e,l,function(a){return t[a]}.bind(null,l));return e},n.n=function(t){var a=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(a,"a",a),a},n.o=function(t,a){return Object.prototype.hasOwnProperty.call(t,a)},n.p="",n(n.s=70)}({70:function(t,a){var n=window.AFTHRAMPES_JS||{};jQuery(document).ready((function(t){"use strict";var a=!1;function e(t){t.removeClass("installing"),a=!1}n.install_plugin=function(n,l){a=!0,n.addClass("installing"),t.ajax({type:"POST",url:aft_installer_localize.ajax_url,data:{action:"covernews_plugin_installer",plugin:l,nonce:aft_installer_localize.admin_nonce,dataType:"json"},success:function(t){t&&"success"===t.status?n.attr("class","activate button button-primary").html(aft_installer_localize.activate_btn):n.removeClass("installing"),a=!1},error:function(){e(n)}})},n.activate_plugin=function(n,l){n.addClass("installing"),t.ajax({type:"POST",url:aft_installer_localize.ajax_url,data:{action:"covernews_plugin_activation",plugin:l,nonce:aft_installer_localize.admin_nonce,dataType:"json"},success:function(t){t&&"success"===t.status&&(n.attr("class","installed button disabled").html(aft_installer_localize.installed_btn),"templatespare"===t.plugin?n.attr("href",t.redirectUrl).removeClass("disabled installed").attr("class","button-primary templatespare primary").html("Get Starter Sites"):n.removeClass("installing")),a=!1},error:function(){e(n)}})},t(document).on("click",".aft-plugin-installer a.button",(function(e){e.preventDefault();var l=t(this),i=l.data("slug");l.hasClass("disabled")||a||(l.hasClass("install")?n.install_plugin(l,i):l.hasClass("activate")&&n.activate_plugin(l,i))})),t(".aft-dismiss-notice").on("click",(function(){t.ajax({type:"POST",url:aft_installer_localize.ajax_url,data:{action:"aft_notice_dismiss",nonce:aft_installer_localize.admin_nonce},success:function(a){"success"===a.status&&t(".aft-notice-content-wrapper").remove()}})})),t(document).on("click",".aft-bulk-active-plugin-installer a.button",(function(a){a.preventDefault(),a.stopPropagation();var n=t(this),e=n.data("install"),l=n.data("activate"),i=n.data("page");n.addClass("installing"),t.ajax({type:"POST",url:ajaxurl,data:{action:"covernews_plugin_installer_activation",install:e,activate:l,page:i,nonce:aft_installer_localize.admin_nonce,dataType:"json"},success:function(t){"success"===t.status&&(window.location.href=t.url)}})}))}))}});