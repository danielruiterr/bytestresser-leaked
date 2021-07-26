! function(a) {
    "use strict";
    var n = function() {};
    n.prototype.init = function() {
        a("#world-map-markers").vectorMap({
            map: "world_mill_en",
            normalizeFunction: "polynomial",
            hoverOpacity: .7,
            hoverColor: !1,
            regionStyle: {
                initial: {
                    fill: "#fec544"
                }
            },
            markerStyle: {
                initial: {
                    r: 9,
                    fill: "#675db7",
                    "fill-opacity": .9,
                    stroke: "#fff",
                    "stroke-width": 7,
                    "stroke-opacity": .4
                },
                hover: {
                    stroke: "#fff",
                    "fill-opacity": 1,
                    "stroke-width": 1.5
                }
            },
            backgroundColor: "transparent",
            markers: [{
                latLng: [45, 20.73],
                name: "Test"
            }]
        }), a("#usa-vectormap").vectorMap({
            map: "us_merc_en",
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: "#56c2d6"
                }
            }
        }), a("#india-vectormap").vectorMap({
            map: "in_mill_en",
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: "#f0643b"
                }
            }
        }), a("#australia-vectormap").vectorMap({
            map: "au_mill_en",
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: "#f0643b"
                }
            }
        }), a("#chicago-vectormap").vectorMap({
            map: "us-il-chicago_mill_en",
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: "#56c2d6"
                }
            }
        }), a("#uk-vectormap").vectorMap({
            map: "uk_mill_en",
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: "#56c2d6"
                }
            }
        }), a("#canada-vectormap").vectorMap({
            map: "ca_lcc_en",
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: "#f0643b"
                }
            }
        })
    }, a.VectorMap = new n, a.VectorMap.Constructor = n
}(window.jQuery),
function(a) {
    "use strict";
    window.jQuery.VectorMap.init()
}();