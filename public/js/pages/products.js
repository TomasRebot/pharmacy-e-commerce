!function(e){var t={};function r(a){if(t[a])return t[a].exports;var n=t[a]={i:a,l:!1,exports:{}};return e[a].call(n.exports,n,n.exports,r),n.l=!0,n.exports}r.m=e,r.c=t,r.d=function(e,t,a){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(r.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)r.d(a,n,function(t){return e[t]}.bind(null,n));return a},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="/",r(r.s=41)}({41:function(e,t,r){e.exports=r(42)},42:function(e,t){$(document).ready((function(){var e=$("#brands_select"),t=$("#category_select"),r=$("#provider_select"),a=$("#laboratory_select"),n=$("#input-description"),o=$("#drug_select"),i=$("#therapeutic_action_select"),c=void 0!==$("#id").val(),u=$("#product_ajax_select_loading"),d=$("#product_ajax_select_container");n.summernote(summernoteBaseMediumConfig);var l=c?{product:$("#id").val()}:{};o.select2(),r.select2(),i.select2(),e.select2(),a.select2(),t.select2(),axios.post(productSuportDataUrl,l).then((function(n){var c=n.data;d.removeClass("opacity-0"),u.addClass("hidden"),o.trigger({type:"select2:select",params:{data:c.drugs.map((function(e){return{id:e.id,value:e.id,text:e.name}}))}}),o.select2({data:c.drugs.map((function(e){return{id:e.id,value:e.id,text:e.name}}))}),r.select2({data:c.providers.map((function(e){return{id:e.id,value:e.id,text:e.name}}))}),i.select2({data:c.therapeutic_actions.map((function(e){return{id:e.id,value:e.id,text:e.name}}))}),e.select2({data:c.brands.map((function(e){return{id:e.id,value:e.id,text:e.name}}))}),a.select2({data:c.laboratories.map((function(e){return{id:e.id,value:e.id,text:e.name}}))}),t.select2({data:c.categories.map((function(e){return{id:e.id,value:e.id,text:e.name}}))}),c.product!==[]&&(e.val(c.product.brand),e.trigger("change"),t.val(c.product.category),t.trigger("change"),r.val(c.product.provider),r.trigger("change"),a.val(c.product.laboratory),a.trigger("change"),o.val(c.product.drug),o.trigger("change"),i.val(c.product.therapeutic_action),i.trigger("change"))}))}))}});