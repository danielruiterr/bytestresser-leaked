function Notify(msg, type) {
    !function(p) {
        "use strict";
        var t = function() {};
        t.prototype.send = function(t, i, o, e, n, a, s, r) {
            a || (a = 3e3),
            s || (s = 1);
            var c = {
                heading: t,
                text: i,
                position: o,
                loaderBg: e,
                icon: n,
                hideAfter: a,
                stack: s
            };
            r && (c.showHideTransition = r),
            console.log(c),
            p.toast().reset("all"),
            p.toast(c)
        }
        ,
        p.NotificationApp = new t,
        p.NotificationApp.Constructor = t
    }(window.jQuery),
    function(i) {
        "use strict";
        if(type == 'info')
            i.NotificationApp.send("Information", msg, "top-right", "#3b98b5", "info");
        else if(type == 'warning')
            i.NotificationApp.send("Warning", msg, "top-right", "#da8609", "warning")
        else if(type == 'success')
            i.NotificationApp.send("Success", msg, "top-right", "#5ba035", "success")
        else if(type == 'error')
            i.NotificationApp.send("Error", msg, "top-right", "#bf441d", "error")
    }(window.jQuery);
}