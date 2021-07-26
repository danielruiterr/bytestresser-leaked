!function(n) {
    "use strict";
    var t = function() {};
    
    t.prototype.initKnob = function() {
        n('[data-plugin="knob"]').each(function(t, i) {
            n(this).knob()
        })
    }
    ,
    t.prototype.init = function() {
        this.initKnob()
    }
    ,
    n.Components = new t,
    n.Components.Constructor = t
}(window.jQuery),
function(e) {
    "use strict";
    var t = function() {
        this.$body = e("body"),
        this.$window = e(window)
    };

    t.prototype.init = function() {
        e.Components.init()
    }
    ,
    e.App = new t,
    e.App.Constructor = t
}(window.jQuery),
function(t) {
    "use strict";
    window.jQuery.App.init()
}(),
Waves.init();