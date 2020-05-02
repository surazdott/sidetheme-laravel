! function() {
    "use strict";
    var t = {
            ready: function(t) {
                "loading" !== document.readyState ? t() : document.addEventListener("DOMContentLoaded", t)
            },
            addClass: function(t, e) {
                t.classList ? t.classList.add(e) : t.className += " " + e
            },
            removeClass: function(t, e) {
                t.classList ? t.classList.remove(e) : t.className = t.className.replace(new RegExp("(^|\\b)" + e.split(" ").join("|") + "(\\b|$)", "gi"), " ")
            },
            isCustomEventSupported: function() {
                return "CustomEvent" in window && "function" == typeof window.CustomEvent
            }
        },
        e = function() {
            var e = function(e) {
                var n = !0,
                    o = document.querySelector("html");
                return {
                    show: function() {
                        if (t.removeClass(o, "sidetheme-closed"), n = !0, t.addClass(o, "sidetheme-sliding-down"), setTimeout(function() {
                                t.removeClass(o, "sidetheme-sliding-down")
                            }, 200), t.isCustomEventSupported()) {
                            var e = new CustomEvent("sidetheme_toggle");
                            document.body.dispatchEvent(e)
                        }
                        return n
                    },
                    hide: function() {
                        if (t.addClass(o, "sidetheme-closed"), n = !1, t.isCustomEventSupported()) {
                            var e = new CustomEvent("sidetheme_toggle");
                            document.body.dispatchEvent(e)
                        }
                        return n
                    },
                    toggle: function() {
                        return n ? this.hide() : this.show(), n
                    }
                }
            }();
            document.querySelector(".js-sidetheme-hide").addEventListener("click", e.hide), document.querySelector(".js-sidetheme-show").addEventListener("click", e.show)
        },
        n = function() {
            if (function() {
                    try {
                        return window.self !== window.top
                    } catch (t) {
                        return !0
                    }
                }()) {
                document.getElementById("sd-preview-bar").style.display = "none", document.documentElement.className += " sidetheme-closed"
            }
        };
    t.ready(e), t.ready(n)
}();