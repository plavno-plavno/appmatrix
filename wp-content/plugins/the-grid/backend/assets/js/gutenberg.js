!function(t){var e={};function r(n){if(e[n])return e[n].exports;var o=e[n]={i:n,l:!1,exports:{}};return t[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=t,r.c=e,r.d=function(t,e,n){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)r.d(n,o,function(e){return t[e]}.bind(null,o));return n},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="",r(r.s=3)}([function(t,e,r){t.exports=r(1)},function(t,e,r){var n=function(){return this||"object"==typeof self&&self}()||Function("return this")(),o=n.regeneratorRuntime&&Object.getOwnPropertyNames(n).indexOf("regeneratorRuntime")>=0,i=o&&n.regeneratorRuntime;if(n.regeneratorRuntime=void 0,t.exports=r(2),o)n.regeneratorRuntime=i;else try{delete n.regeneratorRuntime}catch(t){n.regeneratorRuntime=void 0}},function(t,e){!function(e){"use strict";var r,n=Object.prototype,o=n.hasOwnProperty,i="function"==typeof Symbol?Symbol:{},a=i.iterator||"@@iterator",c=i.asyncIterator||"@@asyncIterator",u=i.toStringTag||"@@toStringTag",l="object"==typeof t,s=e.regeneratorRuntime;if(s)l&&(t.exports=s);else{(s=e.regeneratorRuntime=l?t.exports:{}).wrap=b;var f="suspendedStart",h="suspendedYield",p="executing",g="completed",d={},y={};y[a]=function(){return this};var m=Object.getPrototypeOf,v=m&&m(m(G([])));v&&v!==n&&o.call(v,a)&&(y=v);var w=O.prototype=E.prototype=Object.create(y);_.prototype=w.constructor=O,O.constructor=_,O[u]=_.displayName="GeneratorFunction",s.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===_||"GeneratorFunction"===(e.displayName||e.name))},s.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,O):(t.__proto__=O,u in t||(t[u]="GeneratorFunction")),t.prototype=Object.create(w),t},s.awrap=function(t){return{__await:t}},L(R.prototype),R.prototype[c]=function(){return this},s.AsyncIterator=R,s.async=function(t,e,r,n){var o=new R(b(t,e,r,n));return s.isGeneratorFunction(e)?o:o.next().then(function(t){return t.done?t.value:o.next()})},L(w),w[u]="Generator",w[a]=function(){return this},w.toString=function(){return"[object Generator]"},s.keys=function(t){var e=[];for(var r in t)e.push(r);return e.reverse(),function r(){for(;e.length;){var n=e.pop();if(n in t)return r.value=n,r.done=!1,r}return r.done=!0,r}},s.values=G,k.prototype={constructor:k,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=r,this.done=!1,this.delegate=null,this.method="next",this.arg=r,this.tryEntries.forEach(S),!t)for(var e in this)"t"===e.charAt(0)&&o.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=r)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(n,o){return c.type="throw",c.arg=t,e.next=n,o&&(e.method="next",e.arg=r),!!o}for(var i=this.tryEntries.length-1;i>=0;--i){var a=this.tryEntries[i],c=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var u=o.call(a,"catchLoc"),l=o.call(a,"finallyLoc");if(u&&l){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(u){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var n=this.tryEntries[r];if(n.tryLoc<=this.prev&&o.call(n,"finallyLoc")&&this.prev<n.finallyLoc){var i=n;break}}i&&("break"===t||"continue"===t)&&i.tryLoc<=e&&e<=i.finallyLoc&&(i=null);var a=i?i.completion:{};return a.type=t,a.arg=e,i?(this.method="next",this.next=i.finallyLoc,d):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),d},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),S(r),d}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;S(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,n){return this.delegate={iterator:G(t),resultName:e,nextLoc:n},"next"===this.method&&(this.arg=r),d}}}function b(t,e,r,n){var o=e&&e.prototype instanceof E?e:E,i=Object.create(o.prototype),a=new k(n||[]);return i._invoke=function(t,e,r){var n=f;return function(o,i){if(n===p)throw new Error("Generator is already running");if(n===g){if("throw"===o)throw i;return T()}for(r.method=o,r.arg=i;;){var a=r.delegate;if(a){var c=j(a,r);if(c){if(c===d)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if(n===f)throw n=g,r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n=p;var u=x(t,e,r);if("normal"===u.type){if(n=r.done?g:h,u.arg===d)continue;return{value:u.arg,done:r.done}}"throw"===u.type&&(n=g,r.method="throw",r.arg=u.arg)}}}(t,r,a),i}function x(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}function E(){}function _(){}function O(){}function L(t){["next","throw","return"].forEach(function(e){t[e]=function(t){return this._invoke(e,t)}})}function R(t){var e;this._invoke=function(r,n){function i(){return new Promise(function(e,i){!function e(r,n,i,a){var c=x(t[r],t,n);if("throw"!==c.type){var u=c.arg,l=u.value;return l&&"object"==typeof l&&o.call(l,"__await")?Promise.resolve(l.__await).then(function(t){e("next",t,i,a)},function(t){e("throw",t,i,a)}):Promise.resolve(l).then(function(t){u.value=t,i(u)},function(t){return e("throw",t,i,a)})}a(c.arg)}(r,n,e,i)})}return e=e?e.then(i,i):i()}}function j(t,e){var n=t.iterator[e.method];if(n===r){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=r,j(t,e),"throw"===e.method))return d;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return d}var o=x(n,t.iterator,e.arg);if("throw"===o.type)return e.method="throw",e.arg=o.arg,e.delegate=null,d;var i=o.arg;return i?i.done?(e[t.resultName]=i.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=r),e.delegate=null,d):i:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,d)}function P(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function S(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function k(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(P,this),this.reset(!0)}function G(t){if(t){var e=t[a];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,i=function e(){for(;++n<t.length;)if(o.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=r,e.done=!0,e};return i.next=i}}return{next:T}}function T(){return{value:r,done:!0}}}(function(){return this||"object"==typeof self&&self}()||Function("return this")())},function(t,e,r){"use strict";r.r(e);var n=r(0),o=r.n(n);function i(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var a=wp,c=a.data,u=a.apiFetch,l=c.registerStore,s=(c.withSelect,{grids:{loading:!0},facets:{loading:!0},loading:!0}),f={setGrids:function(t){return{type:"SET_GRIDS",grids:t}},fetch:function(t){return{type:"FETCH_FROM_API",path:t}}},h=(l("the_grid",{reducer:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:s,e=arguments.length>1?arguments[1]:void 0;switch(e.type){case"SET_GRIDS":return function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{},n=Object.keys(r);"function"==typeof Object.getOwnPropertySymbols&&(n=n.concat(Object.getOwnPropertySymbols(r).filter(function(t){return Object.getOwnPropertyDescriptor(r,t).enumerable}))),n.forEach(function(e){i(t,e,r[e])})}return t}({},t,{grids:e.grids})}return t},actions:f,selectors:{getGrids:function(t){return t.grids}},controls:{FETCH_FROM_API:function(t){return u({path:t.path})}},resolvers:{getGrids:o.a.mark(function t(e){var r;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return"/the_grid/v1/get/?type=grids",t.next=3,f.fetch("/the_grid/v1/get/?type=grids");case 3:return r=t.sent,t.abrupt("return",f.setGrids(r));case 5:case"end":return t.stop()}},t,this)})}}),wp.i18n.__),p=wp.data.withSelect,g=wp.components,d=g.Spinner,y=g.SelectControl,m=p(function(t){return{options:(0,t("the_grid").getGrids)()}})(function(t){var e=t.options,r=t.attributes,n=t.setAttributes,o=r.name;return[e.loading&&React.createElement(d,{key:"wpgb_spinner"}),!e.loading&&React.createElement(y,{key:"wpgb_select",label:h("Please, select a grid","tg-text-domain"),value:o||"",onChange:function(t){return n({name:t})},options:e})]}),v=wp.i18n.__,w=wp.blockEditor.InspectorControls,b=wp.components.PanelBody,x=function(t){return React.createElement(w,null,React.createElement(b,{title:v("Grid Settings")},React.createElement(m,t)))},E=wp.blockEditor,_=E.BlockControls,O=E.BlockAlignmentToolbar,L=function(t){var e=t.attributes,r=t.setAttributes,n=e.align;return React.createElement(_,{key:"controls"},React.createElement(O,{value:n,onChange:function(t){return r({align:t})},controls:["wide","full"]}))},R=React.createElement("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 95 95"},React.createElement("path",{fill:"currentColor",d:"M82.536 35.62c-9.087-9.087-24.06-8.824-33.473.587l-.006-.005-17.034 17.032.007.004c9.09 9.09 24.059 8.83 33.477-.586L46.335 71.824 27.608 53.102l19.174-19.171-7.958-7.96 7.96 7.96.439-.443c8.985-9.424 9.334-23.844.678-32.504l-17.032 17.03-.004-.004-19.171 19.173c-8.229 8.231-7.77 21.997 1.03 30.806l-.004.004 18.725 18.723c9.088 9.09 23.111 9.787 31.342 1.561l19.168-19.172c9.415-9.414 9.674-24.393.581-33.485z"})),j=wp.element.Fragment,P=wp.components.Placeholder,S=React.createElement("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 95 95"},React.createElement("path",{fill:"currentColor",d:"M82.536 35.62c-9.087-9.087-24.06-8.824-33.473.587l-.006-.005-17.034 17.032.007.004c9.09 9.09 24.059 8.83 33.477-.586L46.335 71.824 27.608 53.102l19.174-19.171-7.958-7.96 7.96 7.96.439-.443c8.985-9.424 9.334-23.844.678-32.504l-17.032 17.03-.004-.004-19.171 19.173c-8.229 8.231-7.77 21.997 1.03 30.806l-.004.004 18.725 18.723c9.088 9.09 23.111 9.787 31.342 1.561l19.168-19.172c9.415-9.414 9.674-24.393.581-33.485z"})),k=wp.i18n.__;(0,wp.blocks.registerBlockType)("the-grid/grid",{title:"The Grid",description:k("Display a grid.","tg-text-domain"),icon:S,category:"the_grid",keywords:[k("masonry","tg-text-domain"),k("layout","tg-text-domain"),k("grid","tg-text-domain")],supports:{html:!1},attributes:{className:{type:"string",default:""},align:{type:"string",default:"none"},name:{type:"string",default:""}},getEditWrapperProps:function(t){var e=t.align;return["wide","full"].includes(e)&&{"data-align":e}},edit:function(t){return React.createElement(j,null,React.createElement(L,t),React.createElement(x,t),React.createElement(P,{icon:R},React.createElement(m,t)))},save:function(){}})}]);