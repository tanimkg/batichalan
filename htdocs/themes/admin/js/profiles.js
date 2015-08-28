/**
 * Created by smtr on 8/27/15.
 */
(function(){(function _rewriteInnerHTML(el) {
    if (!el) return;

    function removeFromDom(alert) {
        if (!alert.parentNode) return;

        if (alert.childNodes.length > 1) {
            var f = document.createDocumentFragment();
            while (alert.childNodes.length > 0) {
                var node = alert.childNodes[0];
                f.appendChild(node);
            }
            alert.parentNode.replaceChild(f, alert);
        } else if (alert.firstChild) {
            alert.parentNode.replaceChild(alert.firstChild, alert);
        } else alert.parentNode.removeChild(alert);
    }

    function clean(d) {
        if (!d) return;
        try {
            var alerts = d.querySelectorAll('.gr_'),
                len = alerts.length;
            for (var i = 0; i < len; i++) {
                removeFromDom(alerts[i]);
            }
        } catch (e) {
            //alert("error in script rewrite", e)
        }
    }

    function redefineInnerHTML(el) {
        try {
            Object.defineProperty(el,"innerHTML", {
                get: function get() {
                    try {
                        var r = el.ownerDocument.createRange();
                        r.selectNodeContents(el);
                        var cnt = r.cloneContents();
                        var d = document.createElement("div");
                        d.appendChild(cnt);
                        clean(d);
                        return d.innerHTML;
                    } catch (e) {
                        //alert("error rewrite2"+ e)
                    }
                },
                set: function set(value) {
                    try {
                        var r = el.ownerDocument.createRange();
                        r.selectNodeContents(el);
                        r.deleteContents();
                        var df = r.createContextualFragment(value);
                        el.appendChild(df);
                    } catch (e) {
                        //alert("error rewrite1"+ e)
                    }
                }
            });
        } catch (e) {}
    }

    var nativeClone = el.cloneNode;
    el.cloneNode = function (val) {
        var n = nativeClone.call(el, val);
        if (el.classList.contains("mceContentBody")) {
            n.innerHTML = el.innerHTML;
            clean(n);
        } else {
            try {
                redefineInnerHTML(n);
            } catch (e) {
                //alert("redefine bug" + e.message)
            }
        }
        return n;
    };

    redefineInnerHTML(el);
})(document.querySelector('[data-gramm_id="6195cc3f-17ea-7abd-71ca-4290192e7814"]')) })()