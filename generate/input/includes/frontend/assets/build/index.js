$=jQuery;const o=window.helloWorld||{container:"a.hello-world",bindClick:function(){$(this.container).length!==0&&$(this.container).on("click",e=>{e.preventDefault(),console.log("Hello, World!")})},init:function(){this.bindClick()}},t={props:{open:{type:Boolean,required:!0}},template:`
        <div>
            I am {{open ? 'opened' : 'closed'}}
        </div>
    `},n={props:{open:{type:Boolean,required:!0}},template:`
        <div>
            <button
                type="button"
                @click="$emit('toggle')"
            >{{open ? 'Close' : 'Open'}}</button>
        </div>
    `};(function(e){e(function(){o.init(),document.getElementById("|uniquestring|_app")&&(Vue.component("|uniquestring|_block",t),Vue.component("|uniquestring|_button",n),new Vue({el:"#|uniquestring|_app",data:{open:!1},methods:{toggle(){this.open=!this.open}}}))})})(jQuery);
