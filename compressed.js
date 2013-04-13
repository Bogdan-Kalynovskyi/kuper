function wheel(event) {
    var delta = 0;
    if (!event) {
        event = window.event;
    }
    if (event.wheelDelta) {
        delta = event.wheelDelta / 120;
        if (window.opera) {
            delta = -delta;
        }
    } else if (event.detail) {
        delta = -event.detail / 3;
    }
    if (delta) {
        slideshow.handle(delta);
    }
    if (event.preventDefault) {
        event.preventDefault();
    }
    event.returnValue = false;
}

function getKey(evt) {
    if (!evt) {
        theKey = event.keyCode;
    } else {
        theKey = evt.keyCode;
    }
    if (theKey == 32 || theKey == 13) { // ESC //SPOACE
        slideshow.mv(1, 1);
    }
}
document.onkeypress = getKey;

/* Initialization code. */
if (window.addEventListener) {
    window.addEventListener('DOMMouseScroll', wheel, false);
}
window.onmousewheel = document.onmousewheel = wheel;

var TINY = {};
function $(i) {
    return document.getElementById(i)
}
function $$(e, p) {
    p = p || document;
    return p.getElementsByTagName(e)
}
TINY.slideshow = function (n) {
    this.infoSpeed = 5;
    this.imgSpeed = 24;
    this.speed = 7;
    this.thumbOpacity = this.navHover = 70;
    this.navOpacity = 35;
    this.scrollSpeed = 6;
    this.letterbox = '#eee';
    this.n = n;
    this.c = 0;
    this.a = [];
    this.auto = 1;
    this.link = "linkhover";
    this.info = "information";
    this.thumbs = "slider";
    this.left = "slideleft";
    this.right = "slideright";
    this.spacing = 6;
    this.active = "#fff";
    this.ss = $('slidearea');
};
TINY.slideshow.prototype = {init: function (s, z, b, f, q) {
    this.ss.onmouseover = this.shit;
    this.ss.onmouseout = new Function('TINY.scroll.cl("' + this.thumbs + '")');
    s = $(s);
    var m = $$('li', s), i = 0, w = 0;
    this.l = m.length;
    this.q = $(q);
    this.f = $(z);
    this.r = $(this.info);
    this.o = parseInt(TINY.style.val(z, 'width'));
    if (this.thumbs) {
        var u = $(this.left), r = $(this.right);
        u.onmouseover = new Function('TINY.scroll.init("' + this.thumbs + '",-1,' + this.scrollSpeed + ')');
        u.onmouseout = r.onmouseout = new Function('TINY.scroll.cl("' + this.thumbs + '")');
        r.onmouseover = new Function('TINY.scroll.init("' + this.thumbs + '",1,' + this.scrollSpeed + ')');
        this.p = $(this.thumbs)
    }
    for (i; i < this.l; i++) {
        this.a[i] = {};
        var h = m[i], a = this.a[i];

        a.t = h.childNodes[1].innerHTML;//h3$
        a.p = h.childNodes[3].innerHTML;//span
        a.u = h.childNodes[5].innerHTML;//u
        a.d = h.childNodes[7].innerHTML;//p
        a.l = h.childNodes[9].href;
        if (a.l.charAt(a.l.length - 1) == '#') {
            a.l = '';
        }//A
        if (this.thumbs) {
            var g = h.childNodes[9].childNodes[0];//img
            this.p.appendChild(g);
            w += parseInt(g.offsetWidth);
            if (i != this.l - 1) {
                g.style.marginRight = this.spacing + 'px';
                w += this.spacing
            }
            this.p.style.width = w + 'px';
            g.style.opacity = this.thumbOpacity / 100;
            g.style.filter = 'alpha(opacity=' + this.thumbOpacity + ')';
            g.onmouseover = new Function('TINY.alpha.set(this,100,5)');
            g.onmouseout = new Function('TINY.alpha.set(this,' + this.thumbOpacity + ',5)');
            g.onclick = new Function(this.n + '.pr(' + i + ',1)')
        }
    }
    if (b && f) {
        b = $(b);
        f = $(f);
        b.style.opacity = f.style.opacity = this.navOpacity / 100;
        b.style.filter = f.style.filter = 'alpha(opacity=' + this.navOpacity + ')';
        b.onmouseover = f.onmouseover = new Function('TINY.alpha.set(this,' + this.navHover + ',5)');
        b.onmouseout = f.onmouseout = new Function('TINY.alpha.set(this,' + this.navOpacity + ',5)');
        b.onclick = new Function(this.n + '.mv(-1,1)');
        f.onclick = new Function(this.n + '.mv(1,1)')
    }
    if (this.auto) {
        this.is(0, 0)
    }
}, mv: function (d, c) {
    var t = this.c + d;
    this.c = t = t < 0 ? this.l - 1 : t > this.l - 1 ? 0 : t;
    this.pr(t, c)
}, pr: function (t, c) {
    clearTimeout(this.lt);
    if (c) {
        clearTimeout(this.at)
    }
    this.c = t;
    this.is(t, c)
},


    handle: function (d) {
        var e = $(this.thumbs);
        var x = e.offsetWidth - this.f.offsetWidth;
        var l = parseInt(e.style.left);
        l += d * 50;
        if (l > 0 || l < -x) {
            return;
        }//alert(l);alert(x)
        e.style.left = l + 'px';
    },


    shit: function (event) {
        pos_x = event.offsetX ? (event.offsetX) : event.pageX - slideshow.ss.offsetLeft - mol.offsetLeft;

        if (pos_x > this.f.offsetWidth / 2) {
            TINY.scroll.init(this.thumbs, 1, this.scrollSpeed);
        } else {
            TINY.scroll.init(this.thumbs, -1, this.scrollSpeed);
        }
    },


    is: function (s, c) {
        mol.style.visibility = 'visible';

        var i = new Image();
        i.style.opacity = 0;
        i.style.filter = 'alpha(opacity=0)';
        this.i = i;
        i.onload = new Function(this.n + '.le(' + s + ',' + c + ')');
        i.src = this.a[s].p;
        p1.src = this.a[s].u;
        TINY.height.set(this.r, 0, this.infoSpeed / 3, -1);
        if (s + 1 < this.l) {
            p0.src = this.a[s + 1].p;
            p2.src = this.a[s + 1].u
        }
        ;
        if (this.thumbs) {
            var xxx, a = $$('img', this.p), l = a.length, x = 0;
            for (x; x < l; x++) {
                a[x].style.borderColor = x != s ? '' : this.active;
                if (x == s) {
                    xxx = a[x].offsetLeft;
                }
            }
            TINY.scrollTo.init(this.thumbs, -xxx, this.scrollSpeed);
        }
    },

    le: function (s, c) {
        this.link = "linkhover";
        this.info1 = $("information");
        this.wrapper1 = $("wrapper");
        this.fullsize1 = $("fullsize");
        this.slidearea1 = $("slidearea");
        this.molbert1 = $("molbert");


        this.f.appendChild(this.i);
        var m = $$('img', this.f);
        var ml = m.length;
        var x = m[ml - 1].clientWidth;
        b = Math.max(x, 372)
        var bodia = b + 'px';
        this.wrapper1.style.width = bodia;
        this.fullsize1.style.width = bodia;
        this.info1.style.width = bodia;
        this.slidearea1.style.width = bodia;
        this.f.style.width = bodia;
        this.molbert1.style.marginLeft = -(b + 20) / 2 + 'px';
        this.i.style.marginLeft = -x / 2 + 'px';

        var w = this.o - parseInt(this.i.offsetWidth);
        TINY.alpha.set(this.i, 100, this.imgSpeed);


        if (ml > 1) {
            TINY.alpha.set(m[ml - 2], 0, this.imgSpeed / 4);
        }
        var n = new Function(this.n + '.nf(' + s + ')');
        this.lt = setTimeout(n, this.imgSpeed * 10);
        if (!c) {
            this.at = setTimeout(new Function(this.n + '.mv(1,0)'), this.speed * 1000)
        }
        if (this.a[s].l) {
            this.q.onmouseover = function () {
                zoomPreload(slideshow.a[s].l);
                this.className = "linkhover"
            };
            this.q.onclick = function (event) {
                return zoomClick(m[m.length - 1], slideshow.a[s].l, slideshow.a[s].t, event);
            };


            this.q.onmouseout = new Function('this.className=""');
            this.q.style.cursor = 'pointer'
        } else {
            this.q.onclick = this.q.onmouseover = null;
            this.q.style.cursor = 'default';
        }
        var m = $$('img', this.f);
        if (m.length > 2) {
            this.f.removeChild(m[0])
        }
    }, nf: function (s) {
        s = this.a[s];
        if (s.t) {
            this.r.childNodes[1].innerHTML = s.t;
            this.r.childNodes[3].innerHTML = s.d;
            this.r.style.height = 'auto';
            var h = parseInt(this.r.offsetHeight);
            this.r.style.height = 0;
            TINY.height.set(this.r, h, this.infoSpeed / 3, 0)
        }
    }};
TINY.scroll = function () {
    return{init: function (e, d, s) {
        e = typeof e == 'object' ? e : $(e);
        var p = e.style.left || TINY.style.val(e, 'left');
        e.style.left = p;
        var l = d == 1 ? parseInt(e.offsetWidth) - parseInt(e.parentNode.offsetWidth) : 0;
        e.si = setInterval(function () {
            TINY.scroll.mv(e, l, d, s)
        }, 20)
    }, mv: function (e, l, d, s) {
        var c = parseInt(e.style.left);
        if (c == l) {
            TINY.scroll.cl(e)
        } else {
            var i = Math.abs(l + c);
            i = i < s ? i : s;
            var n = c - i * d;
            e.style.left = n + 'px'
        }
    }, cl: function (e) {
        e = typeof e == 'object' ? e : $(e);
        clearInterval(e.si)
    }}
}();

TINY.scrollTo = function () {
    return{init: function (e, l, s) {
        e = typeof e == 'object' ? e : $(e);
        var p = e.style.left || TINY.style.val(e, 'left');
        e.style.left = p;
        d = (parseInt(p) < l) ? 1 : -1;
        e.si = setInterval(function () {
            TINY.scrollTo.mv(e, l, d, s)
        }, 20)
    }, mv: function (e, l, d, s) {
        var c = parseInt(e.style.left);
        if (c == l) {
            TINY.scroll.cl(e)
        } else {
            var i = Math.abs(l - c);
            i = i < s ? i : s;
            var n = c + d * i;
            e.style.left = n + 'px'
        }
    }, cl: function (e) {
        e = typeof e == 'object' ? e : $(e);
        clearInterval(e.si)
    }}
}();

TINY.height = function () {
    return{set: function (e, h, s, d) {
        e = typeof e == 'object' ? e : $(e);
        var oh = e.offsetHeight, ho = e.style.height || TINY.style.val(e, 'height');
        ho = oh - parseInt(ho);
        var hd = oh - ho > h ? -1 : 1;
        clearInterval(e.si);
        e.si = setInterval(function () {
            TINY.height.tw(e, h, ho, hd, s)
        }, 20)
    }, tw: function (e, h, ho, hd, s) {
        var oh = e.offsetHeight - ho;
        if (oh == h) {
            clearInterval(e.si)
        } else {
            if (oh != h) {
                e.style.height = oh + (Math.ceil(Math.abs(h - oh) / s) * hd) + 'px'
            }
        }
    }}
}();
TINY.alpha = function () {
    return{set: function (e, a, s) {
        e = typeof e == 'object' ? e : $(e);
        var o = e.style.opacity || TINY.style.val(e, 'opacity'), d = a > o * 100 ? 1 : -1;
        e.style.opacity = o;
        clearInterval(e.ai);
        e.ai = setInterval(function () {
            TINY.alpha.tw(e, a, d, s)
        }, 20)
    }, tw: function (e, a, d, s) {
        var o = Math.round(e.style.opacity * 100);
        if (o == a) {
            clearInterval(e.ai)
        } else {
            var n = o + Math.ceil(Math.abs(a - o) / s) * d;
            e.style.opacity = n / 100;
            e.style.filter = 'alpha(opacity=' + n + ')'
        }
    }}
}();
TINY.style = function () {
    return{val: function (e, p) {
        e = typeof e == 'object' ? e : $(e);
        return e.currentStyle ? e.currentStyle[p] : document.defaultView.getComputedStyle(e, null).getPropertyValue(p)
    }}
}();

var p0 = new Image();
var p2 = new Image();
var slideshow = new TINY.slideshow("slideshow");
window.onload = function () {
    slideshow.init("slideshow", "image", "imgprev", "imgnext", "imglink");
}