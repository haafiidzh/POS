/******/
(() => { // webpackBootstrap
    /******/
    "use strict";
    /******/
    var __webpack_modules__ = ({

        /***/
        "./node_modules/gridjs/dist/gridjs.module.js":
            /*!***************************************************!*\
              !*** ./node_modules/gridjs/dist/gridjs.module.js ***!
              \***************************************************/
            /***/
            ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

                __webpack_require__.r(__webpack_exports__);
                /* harmony export */
                __webpack_require__.d(__webpack_exports__, {
                    /* harmony export */
                    BaseActions: () => ( /* binding */ ut),
                    /* harmony export */
                    BaseComponent: () => ( /* binding */ X),
                    /* harmony export */
                    BaseStore: () => ( /* binding */ st),
                    /* harmony export */
                    Cell: () => ( /* binding */ Z),
                    /* harmony export */
                    Component: () => ( /* binding */ C),
                    /* harmony export */
                    Config: () => ( /* binding */ jt),
                    /* harmony export */
                    Dispatcher: () => ( /* binding */ Ct),
                    /* harmony export */
                    Grid: () => ( /* binding */ ae),
                    /* harmony export */
                    PluginBaseComponent: () => ( /* binding */ ht),
                    /* harmony export */
                    PluginPosition: () => ( /* binding */ ot),
                    /* harmony export */
                    Row: () => ( /* binding */ J),
                    /* harmony export */
                    className: () => ( /* binding */ rt),
                    /* harmony export */
                    createElement: () => ( /* binding */ b),
                    /* harmony export */
                    createRef: () => ( /* binding */ k),
                    /* harmony export */
                    h: () => ( /* binding */ b),
                    /* harmony export */
                    html: () => ( /* binding */ K),
                    /* harmony export */
                    useEffect: () => ( /* binding */ ge),
                    /* harmony export */
                    useRef: () => ( /* binding */ ve)
                    /* harmony export */
                });

                function t(t, e) {
                    for (var n = 0; n < e.length; n++) {
                        var r = e[n];
                        r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
                    }
                }

                function e(e, n, r) {
                    return n && t(e.prototype, n), r && t(e, r), e
                }

                function n() {
                    return n = Object.assign || function (t) {
                        for (var e = 1; e < arguments.length; e++) {
                            var n = arguments[e];
                            for (var r in n) Object.prototype.hasOwnProperty.call(n, r) && (t[r] = n[r])
                        }
                        return t
                    }, n.apply(this, arguments)
                }

                function r(t, e) {
                    t.prototype = Object.create(e.prototype), t.prototype.constructor = t, i(t, e)
                }

                function i(t, e) {
                    return i = Object.setPrototypeOf || function (t, e) {
                        return t.__proto__ = e, t
                    }, i(t, e)
                }

                function o(t) {
                    if (void 0 === t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return t
                }

                function s(t, e) {
                    (null == e || e > t.length) && (e = t.length);
                    for (var n = 0, r = new Array(e); n < e; n++) r[n] = t[n];
                    return r
                }

                function a(t, e) {
                    var n = "undefined" != typeof Symbol && t[Symbol.iterator] || t["@@iterator"];
                    if (n) return (n = n.call(t)).next.bind(n);
                    if (Array.isArray(t) || (n = function (t, e) {
                            if (t) {
                                if ("string" == typeof t) return s(t, e);
                                var n = Object.prototype.toString.call(t).slice(8, -1);
                                return "Object" === n && t.constructor && (n = t.constructor.name), "Map" === n || "Set" === n ? Array.from(t) : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n) ? s(t, e) : void 0
                            }
                        }(t)) || e && t && "number" == typeof t.length) {
                        n && (t = n);
                        var r = 0;
                        return function () {
                            return r >= t.length ? {
                                done: !0
                            } : {
                                done: !1,
                                value: t[r++]
                            }
                        }
                    }
                    throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
                }
                var u, l, c, p, h, f, d, _ = {},
                    m = [],
                    g = /acit|ex(?:s|g|n|p|$)|rph|grid|ows|mnc|ntw|ine[ch]|zoo|^ord|itera/i;

                function v(t, e) {
                    for (var n in e) t[n] = e[n];
                    return t
                }

                function y(t) {
                    var e = t.parentNode;
                    e && e.removeChild(t)
                }

                function b(t, e, n) {
                    var r, i, o, s = {};
                    for (o in e) "key" == o ? r = e[o] : "ref" == o ? i = e[o] : s[o] = e[o];
                    if (arguments.length > 2 && (s.children = arguments.length > 3 ? u.call(arguments, 2) : n), "function" == typeof t && null != t.defaultProps)
                        for (o in t.defaultProps) void 0 === s[o] && (s[o] = t.defaultProps[o]);
                    return w(t, s, r, i, null)
                }

                function w(t, e, n, r, i) {
                    var o = {
                        type: t,
                        props: e,
                        key: n,
                        ref: r,
                        __k: null,
                        __: null,
                        __b: 0,
                        __e: null,
                        __d: void 0,
                        __c: null,
                        __h: null,
                        constructor: void 0,
                        __v: null == i ? ++c : i
                    };
                    return null == i && null != l.vnode && l.vnode(o), o
                }

                function k() {
                    return {
                        current: null
                    }
                }

                function S(t) {
                    return t.children
                }

                function C(t, e) {
                    this.props = t, this.context = e
                }

                function P(t, e) {
                    if (null == e) return t.__ ? P(t.__, t.__.__k.indexOf(t) + 1) : null;
                    for (var n; e < t.__k.length; e++)
                        if (null != (n = t.__k[e]) && null != n.__e) return n.__e;
                    return "function" == typeof t.type ? P(t) : null
                }

                function x(t) {
                    var e, n;
                    if (null != (t = t.__) && null != t.__c) {
                        for (t.__e = t.__c.base = null, e = 0; e < t.__k.length; e++)
                            if (null != (n = t.__k[e]) && null != n.__e) {
                                t.__e = t.__c.base = n.__e;
                                break
                            } return x(t)
                    }
                }

                function N(t) {
                    (!t.__d && (t.__d = !0) && h.push(t) && !E.__r++ || f !== l.debounceRendering) && ((f = l.debounceRendering) || setTimeout)(E)
                }

                function E() {
                    for (var t; E.__r = h.length;) t = h.sort(function (t, e) {
                        return t.__v.__b - e.__v.__b
                    }), h = [], t.some(function (t) {
                        var e, n, r, i, o, s;
                        t.__d && (o = (i = (e = t).__v).__e, (s = e.__P) && (n = [], (r = v({}, i)).__v = i.__v + 1, U(s, i, r, e.__n, void 0 !== s.ownerSVGElement, null != i.__h ? [o] : null, n, null == o ? P(i) : o, i.__h), H(n, i), i.__e != o && x(i)))
                    })
                }

                function F(t, e, n, r, i, o, s, a, u, l) {
                    var c, p, h, f, d, g, v, y = r && r.__k || m,
                        b = y.length;
                    for (n.__k = [], c = 0; c < e.length; c++)
                        if (null != (f = n.__k[c] = null == (f = e[c]) || "boolean" == typeof f ? null : "string" == typeof f || "number" == typeof f || "bigint" == typeof f ? w(null, f, null, null, f) : Array.isArray(f) ? w(S, {
                                children: f
                            }, null, null, null) : f.__b > 0 ? w(f.type, f.props, f.key, null, f.__v) : f)) {
                            if (f.__ = n, f.__b = n.__b + 1, null === (h = y[c]) || h && f.key == h.key && f.type === h.type) y[c] = void 0;
                            else
                                for (p = 0; p < b; p++) {
                                    if ((h = y[p]) && f.key == h.key && f.type === h.type) {
                                        y[p] = void 0;
                                        break
                                    }
                                    h = null
                                }
                            U(t, f, h = h || _, i, o, s, a, u, l), d = f.__e, (p = f.ref) && h.ref != p && (v || (v = []), h.ref && v.push(h.ref, null, f), v.push(p, f.__c || d, f)), null != d ? (null == g && (g = d), "function" == typeof f.type && f.__k === h.__k ? f.__d = u = T(f, u, t) : u = D(t, f, h, y, d, u), "function" == typeof n.type && (n.__d = u)) : u && h.__e == u && u.parentNode != t && (u = P(h))
                        } for (n.__e = g, c = b; c--;) null != y[c] && ("function" == typeof n.type && null != y[c].__e && y[c].__e == n.__d && (n.__d = P(r, c + 1)), j(y[c], y[c]));
                    if (v)
                        for (c = 0; c < v.length; c++) O(v[c], v[++c], v[++c])
                }

                function T(t, e, n) {
                    for (var r, i = t.__k, o = 0; i && o < i.length; o++)(r = i[o]) && (r.__ = t, e = "function" == typeof r.type ? T(r, e, n) : D(n, r, r, i, r.__e, e));
                    return e
                }

                function D(t, e, n, r, i, o) {
                    var s, a, u;
                    if (void 0 !== e.__d) s = e.__d, e.__d = void 0;
                    else if (null == n || i != o || null == i.parentNode) t: if (null == o || o.parentNode !== t) t.appendChild(i), s = null;
                        else {
                            for (a = o, u = 0;
                                (a = a.nextSibling) && u < r.length; u += 2)
                                if (a == i) break t;
                            t.insertBefore(i, o), s = o
                        } return void 0 !== s ? s : i.nextSibling
                }

                function R(t, e, n) {
                    "-" === e[0] ? t.setProperty(e, n) : t[e] = null == n ? "" : "number" != typeof n || g.test(e) ? n : n + "px"
                }

                function L(t, e, n, r, i) {
                    var o;
                    t: if ("style" === e)
                        if ("string" == typeof n) t.style.cssText = n;
                        else {
                            if ("string" == typeof r && (t.style.cssText = r = ""), r)
                                for (e in r) n && e in n || R(t.style, e, "");
                            if (n)
                                for (e in n) r && n[e] === r[e] || R(t.style, e, n[e])
                        }
                    else if ("o" === e[0] && "n" === e[1]) o = e !== (e = e.replace(/Capture$/, "")), e = e.toLowerCase() in t ? e.toLowerCase().slice(2) : e.slice(2), t.l || (t.l = {}), t.l[e + o] = n, n ? r || t.addEventListener(e, o ? I : A, o) : t.removeEventListener(e, o ? I : A, o);
                    else if ("dangerouslySetInnerHTML" !== e) {
                        if (i) e = e.replace(/xlink(H|:h)/, "h").replace(/sName$/, "s");
                        else if ("href" !== e && "list" !== e && "form" !== e && "tabIndex" !== e && "download" !== e && e in t) try {
                            t[e] = null == n ? "" : n;
                            break t
                        } catch (t) {}
                        "function" == typeof n || (null != n && (!1 !== n || "a" === e[0] && "r" === e[1]) ? t.setAttribute(e, n) : t.removeAttribute(e))
                    }
                }

                function A(t) {
                    this.l[t.type + !1](l.event ? l.event(t) : t)
                }

                function I(t) {
                    this.l[t.type + !0](l.event ? l.event(t) : t)
                }

                function U(t, e, n, r, i, o, s, a, u) {
                    var c, p, h, f, d, _, m, g, y, b, w, k, P, x = e.type;
                    if (void 0 !== e.constructor) return null;
                    null != n.__h && (u = n.__h, a = e.__e = n.__e, e.__h = null, o = [a]), (c = l.__b) && c(e);
                    try {
                        t: if ("function" == typeof x) {
                            if (g = e.props, y = (c = x.contextType) && r[c.__c], b = c ? y ? y.props.value : c.__ : r, n.__c ? m = (p = e.__c = n.__c).__ = p.__E : ("prototype" in x && x.prototype.render ? e.__c = p = new x(g, b) : (e.__c = p = new C(g, b), p.constructor = x, p.render = W), y && y.sub(p), p.props = g, p.state || (p.state = {}), p.context = b, p.__n = r, h = p.__d = !0, p.__h = []), null == p.__s && (p.__s = p.state), null != x.getDerivedStateFromProps && (p.__s == p.state && (p.__s = v({}, p.__s)), v(p.__s, x.getDerivedStateFromProps(g, p.__s))), f = p.props, d = p.state, h) null == x.getDerivedStateFromProps && null != p.componentWillMount && p.componentWillMount(), null != p.componentDidMount && p.__h.push(p.componentDidMount);
                            else {
                                if (null == x.getDerivedStateFromProps && g !== f && null != p.componentWillReceiveProps && p.componentWillReceiveProps(g, b), !p.__e && null != p.shouldComponentUpdate && !1 === p.shouldComponentUpdate(g, p.__s, b) || e.__v === n.__v) {
                                    p.props = g, p.state = p.__s, e.__v !== n.__v && (p.__d = !1), p.__v = e, e.__e = n.__e, e.__k = n.__k, e.__k.forEach(function (t) {
                                        t && (t.__ = e)
                                    }), p.__h.length && s.push(p);
                                    break t
                                }
                                null != p.componentWillUpdate && p.componentWillUpdate(g, p.__s, b), null != p.componentDidUpdate && p.__h.push(function () {
                                    p.componentDidUpdate(f, d, _)
                                })
                            }
                            if (p.context = b, p.props = g, p.__v = e, p.__P = t, w = l.__r, k = 0, "prototype" in x && x.prototype.render) p.state = p.__s, p.__d = !1, w && w(e), c = p.render(p.props, p.state, p.context);
                            else
                                do {
                                    p.__d = !1, w && w(e), c = p.render(p.props, p.state, p.context), p.state = p.__s
                                } while (p.__d && ++k < 25);
                            p.state = p.__s, null != p.getChildContext && (r = v(v({}, r), p.getChildContext())), h || null == p.getSnapshotBeforeUpdate || (_ = p.getSnapshotBeforeUpdate(f, d)), P = null != c && c.type === S && null == c.key ? c.props.children : c, F(t, Array.isArray(P) ? P : [P], e, n, r, i, o, s, a, u), p.base = e.__e, e.__h = null, p.__h.length && s.push(p), m && (p.__E = p.__ = null), p.__e = !1
                        } else null == o && e.__v === n.__v ? (e.__k = n.__k, e.__e = n.__e) : e.__e = M(n.__e, e, n, r, i, o, s, u);
                        (c = l.diffed) && c(e)
                    }
                    catch (t) {
                        e.__v = null, (u || null != o) && (e.__e = a, e.__h = !!u, o[o.indexOf(a)] = null), l.__e(t, e, n)
                    }
                }

                function H(t, e) {
                    l.__c && l.__c(e, t), t.some(function (e) {
                        try {
                            t = e.__h, e.__h = [], t.some(function (t) {
                                t.call(e)
                            })
                        } catch (t) {
                            l.__e(t, e.__v)
                        }
                    })
                }

                function M(t, e, n, r, i, o, s, a) {
                    var l, c, p, h = n.props,
                        f = e.props,
                        d = e.type,
                        m = 0;
                    if ("svg" === d && (i = !0), null != o)
                        for (; m < o.length; m++)
                            if ((l = o[m]) && "setAttribute" in l == !!d && (d ? l.localName === d : 3 === l.nodeType)) {
                                t = l, o[m] = null;
                                break
                            } if (null == t) {
                        if (null === d) return document.createTextNode(f);
                        t = i ? document.createElementNS("http://www.w3.org/2000/svg", d) : document.createElement(d, f.is && f), o = null, a = !1
                    }
                    if (null === d) h === f || a && t.data === f || (t.data = f);
                    else {
                        if (o = o && u.call(t.childNodes), c = (h = n.props || _).dangerouslySetInnerHTML, p = f.dangerouslySetInnerHTML, !a) {
                            if (null != o)
                                for (h = {}, m = 0; m < t.attributes.length; m++) h[t.attributes[m].name] = t.attributes[m].value;
                            (p || c) && (p && (c && p.__html == c.__html || p.__html === t.innerHTML) || (t.innerHTML = p && p.__html || ""))
                        }
                        if (function (t, e, n, r, i) {
                                var o;
                                for (o in n) "children" === o || "key" === o || o in e || L(t, o, null, n[o], r);
                                for (o in e) i && "function" != typeof e[o] || "children" === o || "key" === o || "value" === o || "checked" === o || n[o] === e[o] || L(t, o, e[o], n[o], r)
                            }(t, f, h, i, a), p) e.__k = [];
                        else if (m = e.props.children, F(t, Array.isArray(m) ? m : [m], e, n, r, i && "foreignObject" !== d, o, s, o ? o[0] : n.__k && P(n, 0), a), null != o)
                            for (m = o.length; m--;) null != o[m] && y(o[m]);
                        a || ("value" in f && void 0 !== (m = f.value) && (m !== t.value || "progress" === d && !m || "option" === d && m !== h.value) && L(t, "value", m, h.value, !1), "checked" in f && void 0 !== (m = f.checked) && m !== t.checked && L(t, "checked", m, h.checked, !1))
                    }
                    return t
                }

                function O(t, e, n) {
                    try {
                        "function" == typeof t ? t(e) : t.current = e
                    } catch (t) {
                        l.__e(t, n)
                    }
                }

                function j(t, e, n) {
                    var r, i;
                    if (l.unmount && l.unmount(t), (r = t.ref) && (r.current && r.current !== t.__e || O(r, null, e)), null != (r = t.__c)) {
                        if (r.componentWillUnmount) try {
                            r.componentWillUnmount()
                        } catch (t) {
                            l.__e(t, e)
                        }
                        r.base = r.__P = null
                    }
                    if (r = t.__k)
                        for (i = 0; i < r.length; i++) r[i] && j(r[i], e, "function" != typeof t.type);
                    n || null == t.__e || y(t.__e), t.__e = t.__d = void 0
                }

                function W(t, e, n) {
                    return this.constructor(t, n)
                }

                function B(t, e, n) {
                    var r, i, o;
                    l.__ && l.__(t, e), i = (r = "function" == typeof n) ? null : n && n.__k || e.__k, o = [], U(e, t = (!r && n || e).__k = b(S, null, [t]), i || _, _, void 0 !== e.ownerSVGElement, !r && n ? [n] : i ? null : e.firstChild ? u.call(e.childNodes) : null, o, !r && n ? n : i ? i.__e : e.firstChild, r), H(o, t)
                }

                function z() {
                    return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (t) {
                        var e = 16 * Math.random() | 0;
                        return ("x" == t ? e : 3 & e | 8).toString(16)
                    })
                }
                u = m.slice, l = {
                    __e: function (t, e, n, r) {
                        for (var i, o, s; e = e.__;)
                            if ((i = e.__c) && !i.__) try {
                                if ((o = i.constructor) && null != o.getDerivedStateFromError && (i.setState(o.getDerivedStateFromError(t)), s = i.__d), null != i.componentDidCatch && (i.componentDidCatch(t, r || {}), s = i.__d), s) return i.__E = i
                            } catch (e) {
                                t = e
                            }
                        throw t
                    }
                }, c = 0, p = function (t) {
                    return null != t && void 0 === t.constructor
                }, C.prototype.setState = function (t, e) {
                    var n;
                    n = null != this.__s && this.__s !== this.state ? this.__s : this.__s = v({}, this.state), "function" == typeof t && (t = t(v({}, n), this.props)), t && v(n, t), null != t && this.__v && (e && this.__h.push(e), N(this))
                }, C.prototype.forceUpdate = function (t) {
                    this.__v && (this.__e = !0, t && this.__h.push(t), N(this))
                }, C.prototype.render = S, h = [], E.__r = 0, d = 0;
                var q = /*#__PURE__*/ function () {
                        function t(t) {
                            this._id = void 0, this._id = t || z()
                        }
                        return e(t, [{
                            key: "id",
                            get: function () {
                                return this._id
                            }
                        }]), t
                    }(),
                    V = {
                        search: {
                            placeholder: "Type a keyword..."
                        },
                        sort: {
                            sortAsc: "Sort column ascending",
                            sortDesc: "Sort column descending"
                        },
                        pagination: {
                            previous: "Previous",
                            next: "Next",
                            navigate: function (t, e) {
                                return "Page " + t + " of " + e
                            },
                            page: function (t) {
                                return "Page " + t
                            },
                            showing: "Showing",
                            of: "of",
                            to: "to",
                            results: "results"
                        },
                        loading: "Loading...",
                        noRecordsFound: "No matching records found",
                        error: "An error happened while fetching the data"
                    },
                    G = /*#__PURE__*/ function () {
                        function t(t) {
                            this._language = void 0, this._defaultLanguage = void 0, this._language = t, this._defaultLanguage = V
                        }
                        var e = t.prototype;
                        return e.getString = function (t, e) {
                            if (!e || !t) return null;
                            var n = t.split("."),
                                r = n[0];
                            if (e[r]) {
                                var i = e[r];
                                return "string" == typeof i ? function () {
                                    return i
                                } : "function" == typeof i ? i : this.getString(n.slice(1).join("."), i)
                            }
                            return null
                        }, e.translate = function (t) {
                            var e, n = this.getString(t, this._language);
                            return (e = n || this.getString(t, this._defaultLanguage)) ? e.apply(void 0, [].slice.call(arguments, 1)) : t
                        }, t
                    }(),
                    X = /*#__PURE__*/ function (t) {
                        function e(e, n) {
                            var r, i;
                            return (r = t.call(this, e, n) || this).config = void 0, r._ = void 0, r.config = function (t) {
                                if (!t) return null;
                                var e = Object.keys(t);
                                return e.length ? t[e[0]].props.value : null
                            }(n), r.config && (r._ = (i = r.config.translator, function (t) {
                                return i.translate.apply(i, [t].concat([].slice.call(arguments, 1)))
                            })), r
                        }
                        return r(e, t), e
                    }(C),
                    $ = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        return r(e, t), e.prototype.render = function () {
                            return b(this.props.parentElement, {
                                dangerouslySetInnerHTML: {
                                    __html: this.props.content
                                }
                            })
                        }, e
                    }(X);

                function K(t, e) {
                    return b($, {
                        content: t,
                        parentElement: e
                    })
                }
                $.defaultProps = {
                    parentElement: "span"
                };
                var Y, Z = /*#__PURE__*/ function (t) {
                        function e(e) {
                            var n;
                            return (n = t.call(this) || this).data = void 0, n.update(e), n
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.cast = function (t) {
                            return t instanceof HTMLElement ? K(t.outerHTML) : t
                        }, n.update = function (t) {
                            return this.data = this.cast(t), this
                        }, e
                    }(q),
                    J = /*#__PURE__*/ function (t) {
                        function n(e) {
                            var n;
                            return (n = t.call(this) || this)._cells = void 0, n.cells = e || [], n
                        }
                        r(n, t);
                        var i = n.prototype;
                        return i.cell = function (t) {
                            return this._cells[t]
                        }, i.toArray = function () {
                            return this.cells.map(function (t) {
                                return t.data
                            })
                        }, n.fromCells = function (t) {
                            return new n(t.map(function (t) {
                                return new Z(t.data)
                            }))
                        }, e(n, [{
                            key: "cells",
                            get: function () {
                                return this._cells
                            },
                            set: function (t) {
                                this._cells = t
                            }
                        }, {
                            key: "length",
                            get: function () {
                                return this.cells.length
                            }
                        }]), n
                    }(q),
                    Q = /*#__PURE__*/ function (t) {
                        function n(e) {
                            var n;
                            return (n = t.call(this) || this)._rows = void 0, n._length = void 0, n.rows = e instanceof Array ? e : e instanceof J ? [e] : [], n
                        }
                        return r(n, t), n.prototype.toArray = function () {
                            return this.rows.map(function (t) {
                                return t.toArray()
                            })
                        }, n.fromRows = function (t) {
                            return new n(t.map(function (t) {
                                return J.fromCells(t.cells)
                            }))
                        }, n.fromArray = function (t) {
                            return new n((t = function (t) {
                                return !t[0] || t[0] instanceof Array ? t : [t]
                            }(t)).map(function (t) {
                                return new J(t.map(function (t) {
                                    return new Z(t)
                                }))
                            }))
                        }, e(n, [{
                            key: "rows",
                            get: function () {
                                return this._rows
                            },
                            set: function (t) {
                                this._rows = t
                            }
                        }, {
                            key: "length",
                            get: function () {
                                return this._length || this.rows.length
                            },
                            set: function (t) {
                                this._length = t
                            }
                        }]), n
                    }(q),
                    tt = /*#__PURE__*/ function () {
                        function t() {
                            this.callbacks = void 0
                        }
                        var e = t.prototype;
                        return e.init = function (t) {
                            this.callbacks || (this.callbacks = {}), t && !this.callbacks[t] && (this.callbacks[t] = [])
                        }, e.on = function (t, e) {
                            return this.init(t), this.callbacks[t].push(e), this
                        }, e.off = function (t, e) {
                            var n = t;
                            return this.init(), this.callbacks[n] && 0 !== this.callbacks[n].length ? (this.callbacks[n] = this.callbacks[n].filter(function (t) {
                                return t != e
                            }), this) : this
                        }, e.emit = function (t) {
                            var e = arguments,
                                n = t;
                            return this.init(n), this.callbacks[n].length > 0 && (this.callbacks[n].forEach(function (t) {
                                return t.apply(void 0, [].slice.call(e, 1))
                            }), !0)
                        }, t
                    }();
                ! function (t) {
                    t[t.Initiator = 0] = "Initiator", t[t.ServerFilter = 1] = "ServerFilter", t[t.ServerSort = 2] = "ServerSort", t[t.ServerLimit = 3] = "ServerLimit", t[t.Extractor = 4] = "Extractor", t[t.Transformer = 5] = "Transformer", t[t.Filter = 6] = "Filter", t[t.Sort = 7] = "Sort", t[t.Limit = 8] = "Limit"
                }(Y || (Y = {}));
                var et = /*#__PURE__*/ function (t) {
                        function n(e) {
                            var n;
                            return (n = t.call(this) || this).id = void 0, n._props = void 0, n._props = {}, n.id = z(), e && n.setProps(e), n
                        }
                        r(n, t);
                        var i = n.prototype;
                        return i.process = function () {
                            var t = [].slice.call(arguments);
                            this.validateProps instanceof Function && this.validateProps.apply(this, t), this.emit.apply(this, ["beforeProcess"].concat(t));
                            var e = this._process.apply(this, t);
                            return this.emit.apply(this, ["afterProcess"].concat(t)), e
                        }, i.setProps = function (t) {
                            return Object.assign(this._props, t), this.emit("propsUpdated", this), this
                        }, e(n, [{
                            key: "props",
                            get: function () {
                                return this._props
                            }
                        }]), n
                    }(tt),
                    nt = /*#__PURE__*/ function (t) {
                        function n() {
                            return t.apply(this, arguments) || this
                        }
                        return r(n, t), n.prototype._process = function (t) {
                            return this.props.keyword ? (e = String(this.props.keyword).trim(), n = this.props.columns, r = this.props.ignoreHiddenColumns, i = t, o = this.props.selector, e = e.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&"), new Q(i.rows.filter(function (t, i) {
                                return t.cells.some(function (t, s) {
                                    if (!t) return !1;
                                    if (r && n && n[s] && "object" == typeof n[s] && n[s].hidden) return !1;
                                    var a = "";
                                    if ("function" == typeof o) a = o(t.data, i, s);
                                    else if ("object" == typeof t.data) {
                                        var u = t.data;
                                        u && u.props && u.props.content && (a = u.props.content)
                                    } else a = String(t.data);
                                    return new RegExp(e, "gi").test(a)
                                })
                            }))) : t;
                            var e, n, r, i, o
                        }, e(n, [{
                            key: "type",
                            get: function () {
                                return Y.Filter
                            }
                        }]), n
                    }(et);

                function rt() {
                    var t = "gridjs";
                    return "" + t + [].slice.call(arguments).reduce(function (t, e) {
                        return t + "-" + e
                    }, "")
                }

                function it() {
                    return [].slice.call(arguments).filter(function (t) {
                        return t
                    }).reduce(function (t, e) {
                        return (t || "") + " " + e
                    }, "").trim() || null
                }
                var ot, st = /*#__PURE__*/ function (t) {
                        function n(e) {
                            var n;
                            return (n = t.call(this) || this)._state = void 0, n.dispatcher = void 0, n.dispatcher = e, n._state = n.getInitialState(), e.register(n._handle.bind(o(n))), n
                        }
                        r(n, t);
                        var i = n.prototype;
                        return i._handle = function (t) {
                            this.handle(t.type, t.payload)
                        }, i.setState = function (t) {
                            var e = this._state;
                            this._state = t, this.emit("updated", t, e)
                        }, e(n, [{
                            key: "state",
                            get: function () {
                                return this._state
                            }
                        }]), n
                    }(tt),
                    at = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.getInitialState = function () {
                            return {
                                keyword: null
                            }
                        }, n.handle = function (t, e) {
                            "SEARCH_KEYWORD" === t && this.search(e.keyword)
                        }, n.search = function (t) {
                            this.setState({
                                keyword: t
                            })
                        }, e
                    }(st),
                    ut = /*#__PURE__*/ function () {
                        function t(t) {
                            this.dispatcher = void 0, this.dispatcher = t
                        }
                        return t.prototype.dispatch = function (t, e) {
                            this.dispatcher.dispatch({
                                type: t,
                                payload: e
                            })
                        }, t
                    }(),
                    lt = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        return r(e, t), e.prototype.search = function (t) {
                            this.dispatch("SEARCH_KEYWORD", {
                                keyword: t
                            })
                        }, e
                    }(ut),
                    ct = /*#__PURE__*/ function (t) {
                        function i() {
                            return t.apply(this, arguments) || this
                        }
                        return r(i, t), i.prototype._process = function (t) {
                            if (!this.props.keyword) return t;
                            var e = {};
                            return this.props.url && (e.url = this.props.url(t.url, this.props.keyword)), this.props.body && (e.body = this.props.body(t.body, this.props.keyword)), n({}, t, e)
                        }, e(i, [{
                            key: "type",
                            get: function () {
                                return Y.ServerFilter
                            }
                        }]), i
                    }(et),
                    pt = new( /*#__PURE__*/ function () {
                        function t() {}
                        var e = t.prototype;
                        return e.format = function (t, e) {
                            return "[Grid.js] [" + e.toUpperCase() + "]: " + t
                        }, e.error = function (t, e) {
                            void 0 === e && (e = !1);
                            var n = this.format(t, "error");
                            if (e) throw Error(n);
                            console.error(n)
                        }, e.warn = function (t) {
                            console.warn(this.format(t, "warn"))
                        }, e.info = function (t) {
                            console.info(this.format(t, "info"))
                        }, t
                    }()),
                    ht = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        return r(e, t), e
                    }(X);
                ! function (t) {
                    t[t.Header = 0] = "Header", t[t.Footer = 1] = "Footer", t[t.Cell = 2] = "Cell"
                }(ot || (ot = {}));
                var ft = /*#__PURE__*/ function () {
                        function t() {
                            this.plugins = void 0, this.plugins = []
                        }
                        var e = t.prototype;
                        return e.get = function (t) {
                            var e = this.plugins.filter(function (e) {
                                return e.id === t
                            });
                            return e.length > 0 ? e[0] : null
                        }, e.add = function (t) {
                            return t.id ? null !== this.get(t.id) ? (pt.error("Duplicate plugin ID: " + t.id), this) : (this.plugins.push(t), this) : (pt.error("Plugin ID cannot be empty"), this)
                        }, e.remove = function (t) {
                            return this.plugins.splice(this.plugins.indexOf(this.get(t)), 1), this
                        }, e.list = function (t) {
                            var e;
                            return e = null != t || null != t ? this.plugins.filter(function (e) {
                                return e.position === t
                            }) : this.plugins, e.sort(function (t, e) {
                                return t.order - e.order
                            })
                        }, t
                    }(),
                    dt = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        return r(e, t), e.prototype.render = function () {
                            var t = this;
                            if (this.props.pluginId) {
                                var e = this.config.plugin.get(this.props.pluginId);
                                return e ? b(S, {}, b(e.component, n({
                                    plugin: e
                                }, e.props, this.props.props))) : null
                            }
                            return void 0 !== this.props.position ? b(S, {}, this.config.plugin.list(this.props.position).map(function (e) {
                                return b(e.component, n({
                                    plugin: e
                                }, e.props, t.props.props))
                            })) : null
                        }, e
                    }(X),
                    _t = /*#__PURE__*/ function (t) {
                        function e(e, n) {
                            var r;
                            (r = t.call(this, e, n) || this).searchProcessor = void 0, r.actions = void 0, r.store = void 0, r.storeUpdatedFn = void 0, r.actions = new lt(r.config.dispatcher), r.store = new at(r.config.dispatcher);
                            var i, s = e.keyword;
                            return e.enabled && (s && r.actions.search(s), r.storeUpdatedFn = r.storeUpdated.bind(o(r)), r.store.on("updated", r.storeUpdatedFn), i = e.server ? new ct({
                                keyword: e.keyword,
                                url: e.server.url,
                                body: e.server.body
                            }) : new nt({
                                keyword: e.keyword,
                                columns: r.config.header && r.config.header.columns,
                                ignoreHiddenColumns: e.ignoreHiddenColumns || void 0 === e.ignoreHiddenColumns,
                                selector: e.selector
                            }), r.searchProcessor = i, r.config.pipeline.register(i)), r
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.componentWillUnmount = function () {
                            this.config.pipeline.unregister(this.searchProcessor), this.store.off("updated", this.storeUpdatedFn)
                        }, n.storeUpdated = function (t) {
                            this.searchProcessor.setProps({
                                keyword: t.keyword
                            })
                        }, n.onChange = function (t) {
                            this.actions.search(t.target.value)
                        }, n.render = function () {
                            if (!this.props.enabled) return null;
                            var t, e, n, r = this.onChange.bind(this);
                            return this.searchProcessor instanceof ct && (t = r, e = this.props.debounceTimeout, r = function () {
                                var r = arguments;
                                return new Promise(function (i) {
                                    n && clearTimeout(n), n = setTimeout(function () {
                                        return i(t.apply(void 0, [].slice.call(r)))
                                    }, e)
                                })
                            }), b("div", {
                                className: rt(it("search", this.config.className.search))
                            }, b("input", {
                                type: "search",
                                placeholder: this._("search.placeholder"),
                                "aria-label": this._("search.placeholder"),
                                onInput: r,
                                className: it(rt("input"), rt("search", "input")),
                                value: this.store.state.keyword
                            }))
                        }, e
                    }(ht);
                _t.defaultProps = {
                    debounceTimeout: 250
                };
                var mt = /*#__PURE__*/ function (t) {
                        function n() {
                            return t.apply(this, arguments) || this
                        }
                        r(n, t);
                        var i = n.prototype;
                        return i.validateProps = function () {
                            if (isNaN(Number(this.props.limit)) || isNaN(Number(this.props.page))) throw Error("Invalid parameters passed")
                        }, i._process = function (t) {
                            var e = this.props.page;
                            return new Q(t.rows.slice(e * this.props.limit, (e + 1) * this.props.limit))
                        }, e(n, [{
                            key: "type",
                            get: function () {
                                return Y.Limit
                            }
                        }]), n
                    }(et),
                    gt = /*#__PURE__*/ function (t) {
                        function i() {
                            return t.apply(this, arguments) || this
                        }
                        return r(i, t), i.prototype._process = function (t) {
                            var e = {};
                            return this.props.url && (e.url = this.props.url(t.url, this.props.page, this.props.limit)), this.props.body && (e.body = this.props.body(t.body, this.props.page, this.props.limit)), n({}, t, e)
                        }, e(i, [{
                            key: "type",
                            get: function () {
                                return Y.ServerLimit
                            }
                        }]), i
                    }(et),
                    vt = /*#__PURE__*/ function (t) {
                        function n(e, n) {
                            var r;
                            return (r = t.call(this, e, n) || this).processor = void 0, r.onUpdateFn = void 0, r.setTotalFromTabularFn = void 0, r.state = {
                                limit: e.limit,
                                page: e.page || 0,
                                total: 0
                            }, r
                        }
                        r(n, t);
                        var i = n.prototype;
                        return i.componentWillMount = function () {
                            var t, e = this;
                            this.props.enabled && (this.setTotalFromTabularFn = this.setTotalFromTabular.bind(this), this.props.server ? (t = new gt({
                                limit: this.state.limit,
                                page: this.state.page,
                                url: this.props.server.url,
                                body: this.props.server.body
                            }), this.config.pipeline.on("afterProcess", this.setTotalFromTabularFn)) : (t = new mt({
                                limit: this.state.limit,
                                page: this.state.page
                            })).on("beforeProcess", this.setTotalFromTabularFn), this.processor = t, this.config.pipeline.register(t), this.config.pipeline.on("error", function () {
                                e.setState({
                                    total: 0,
                                    page: 0
                                })
                            }))
                        }, i.setTotalFromTabular = function (t) {
                            this.setTotal(t.length)
                        }, i.onUpdate = function (t) {
                            this.props.resetPageOnUpdate && t !== this.processor && this.setPage(0)
                        }, i.componentDidMount = function () {
                            this.onUpdateFn = this.onUpdate.bind(this), this.config.pipeline.on("updated", this.onUpdateFn)
                        }, i.componentWillUnmount = function () {
                            this.config.pipeline.unregister(this.processor), this.config.pipeline.off("updated", this.onUpdateFn)
                        }, i.setPage = function (t) {
                            if (t >= this.pages || t < 0 || t === this.state.page) return null;
                            this.setState({
                                page: t
                            }), this.processor.setProps({
                                page: t
                            })
                        }, i.setTotal = function (t) {
                            this.setState({
                                total: t
                            })
                        }, i.renderPages = function () {
                            var t = this;
                            if (this.props.buttonsCount <= 0) return null;
                            var e = Math.min(this.pages, this.props.buttonsCount),
                                n = Math.min(this.state.page, Math.floor(e / 2));
                            return this.state.page + Math.floor(e / 2) >= this.pages && (n = e - (this.pages - this.state.page)), b(S, null, this.pages > e && this.state.page - n > 0 && b(S, null, b("button", {
                                tabIndex: 0,
                                role: "button",
                                onClick: this.setPage.bind(this, 0),
                                title: this._("pagination.firstPage"),
                                "aria-label": this._("pagination.firstPage"),
                                className: this.config.className.paginationButton
                            }, this._("1")), b("button", {
                                tabIndex: -1,
                                className: it(rt("spread"), this.config.className.paginationButton)
                            }, "...")), Array.from(Array(e).keys()).map(function (e) {
                                return t.state.page + (e - n)
                            }).map(function (e) {
                                return b("button", {
                                    tabIndex: 0,
                                    role: "button",
                                    onClick: t.setPage.bind(t, e),
                                    className: it(t.state.page === e ? it(rt("currentPage"), t.config.className.paginationButtonCurrent) : null, t.config.className.paginationButton),
                                    title: t._("pagination.page", e + 1),
                                    "aria-label": t._("pagination.page", e + 1)
                                }, t._("" + (e + 1)))
                            }), this.pages > e && this.pages > this.state.page + n + 1 && b(S, null, b("button", {
                                tabIndex: -1,
                                className: it(rt("spread"), this.config.className.paginationButton)
                            }, "..."), b("button", {
                                tabIndex: 0,
                                role: "button",
                                onClick: this.setPage.bind(this, this.pages - 1),
                                title: this._("pagination.page", this.pages),
                                "aria-label": this._("pagination.page", this.pages),
                                className: this.config.className.paginationButton
                            }, this._("" + this.pages))))
                        }, i.renderSummary = function () {
                            return b(S, null, this.props.summary && this.state.total > 0 && b("div", {
                                role: "status",
                                "aria-live": "polite",
                                className: it(rt("summary"), this.config.className.paginationSummary),
                                title: this._("pagination.navigate", this.state.page + 1, this.pages)
                            }, this._("pagination.showing"), " ", b("b", null, this._("" + (this.state.page * this.state.limit + 1))), " ", this._("pagination.to"), " ", b("b", null, this._("" + Math.min((this.state.page + 1) * this.state.limit, this.state.total))), " ", this._("pagination.of"), " ", b("b", null, this._("" + this.state.total)), " ", this._("pagination.results")))
                        }, i.render = function () {
                            return this.props.enabled ? b("div", {
                                className: it(rt("pagination"), this.config.className.pagination)
                            }, this.renderSummary(), b("div", {
                                className: rt("pages")
                            }, this.props.prevButton && b("button", {
                                tabIndex: 0,
                                role: "button",
                                disabled: 0 === this.state.page,
                                onClick: this.setPage.bind(this, this.state.page - 1),
                                title: this._("pagination.previous"),
                                "aria-label": this._("pagination.previous"),
                                className: it(this.config.className.paginationButton, this.config.className.paginationButtonPrev)
                            }, this._("pagination.previous")), this.renderPages(), this.props.nextButton && b("button", {
                                tabIndex: 0,
                                role: "button",
                                disabled: this.pages === this.state.page + 1 || 0 === this.pages,
                                onClick: this.setPage.bind(this, this.state.page + 1),
                                title: this._("pagination.next"),
                                "aria-label": this._("pagination.next"),
                                className: it(this.config.className.paginationButton, this.config.className.paginationButtonNext)
                            }, this._("pagination.next")))) : null
                        }, e(n, [{
                            key: "pages",
                            get: function () {
                                return Math.ceil(this.state.total / this.state.limit)
                            }
                        }]), n
                    }(ht);

                function yt(t, e) {
                    return "string" == typeof t ? t.indexOf("%") > -1 ? e / 100 * parseInt(t, 10) : parseInt(t, 10) : t
                }

                function bt(t) {
                    return t ? Math.floor(t) + "px" : ""
                }
                vt.defaultProps = {
                    summary: !0,
                    nextButton: !0,
                    prevButton: !0,
                    buttonsCount: 3,
                    limit: 10,
                    resetPageOnUpdate: !0
                };
                var wt = /*#__PURE__*/ function (t) {
                    function e(e, n) {
                        var r;
                        return (r = t.call(this, e, n) || this).tableElement = void 0, r.tableClassName = void 0, r.tableStyle = void 0, r.tableElement = r.props.tableRef.current.base.cloneNode(!0), r.tableElement.style.position = "absolute", r.tableElement.style.width = "100%", r.tableElement.style.zIndex = "-2147483640", r.tableElement.style.visibility = "hidden", r.tableClassName = r.tableElement.className, r.tableStyle = r.tableElement.style.cssText, r
                    }
                    r(e, t);
                    var i = e.prototype;
                    return i.widths = function () {
                        this.tableElement.className = this.tableClassName + " " + rt("shadowTable"), this.tableElement.style.tableLayout = "auto", this.tableElement.style.width = "auto", this.tableElement.style.padding = "0", this.tableElement.style.margin = "0", this.tableElement.style.border = "none", this.tableElement.style.outline = "none";
                        var t = Array.from(this.base.parentNode.querySelectorAll("thead th")).reduce(function (t, e) {
                            var r;
                            return e.style.width = e.clientWidth + "px", n(((r = {})[e.getAttribute("data-column-id")] = {
                                minWidth: e.clientWidth
                            }, r), t)
                        }, {});
                        return this.tableElement.className = this.tableClassName, this.tableElement.style.cssText = this.tableStyle, this.tableElement.style.tableLayout = "auto", Array.from(this.base.parentNode.querySelectorAll("thead th")).reduce(function (t, e) {
                            return t[e.getAttribute("data-column-id")].width = e.clientWidth, t
                        }, t)
                    }, i.render = function () {
                        var t = this;
                        return this.props.tableRef.current ? b("div", {
                            ref: function (e) {
                                e && e.appendChild(t.tableElement)
                            }
                        }) : null
                    }, e
                }(X);

                function kt(t) {
                    if (!t) return "";
                    var e = t.split(" ");
                    return 1 === e.length && /([a-z][A-Z])+/g.test(t) ? t : e.map(function (t, e) {
                        return 0 == e ? t.toLowerCase() : t.charAt(0).toUpperCase() + t.slice(1).toLowerCase()
                    }).join("")
                }
                var St = /*#__PURE__*/ function (t) {
                        function i() {
                            var e;
                            return (e = t.call(this) || this)._columns = void 0, e._columns = [], e
                        }
                        r(i, t);
                        var o = i.prototype;
                        return o.adjustWidth = function (t) {
                            var e = t.container,
                                n = t.tableRef,
                                r = t.tempRef,
                                o = t.tempRef || !0;
                            if (!e) return this;
                            var s = e.clientWidth,
                                u = {
                                    current: null
                                },
                                l = {};
                            if (n.current && o) {
                                var c = b(wt, {
                                    tableRef: n
                                });
                                c.ref = u, B(c, r.current), l = u.current.widths()
                            }
                            for (var p, h = a(i.tabularFormat(this.columns).reduce(function (t, e) {
                                    return t.concat(e)
                                }, [])); !(p = h()).done;) {
                                var f = p.value;
                                f.columns && f.columns.length > 0 || (!f.width && o ? f.id in l && (f.width = bt(l[f.id].width), f.minWidth = bt(l[f.id].minWidth)) : f.width = bt(yt(f.width, s)))
                            }
                            return n.current && o && B(null, r.current), this
                        }, o.setSort = function (t, e) {
                            for (var r, i = a(e || this.columns || []); !(r = i()).done;) {
                                var o = r.value;
                                o.columns && o.columns.length > 0 && (o.sort = {
                                    enabled: !1
                                }), void 0 === o.sort && t.sort && (o.sort = {
                                    enabled: !0
                                }), o.sort ? "object" == typeof o.sort && (o.sort = n({
                                    enabled: !0
                                }, o.sort)) : o.sort = {
                                    enabled: !1
                                }, o.columns && this.setSort(t, o.columns)
                            }
                        }, o.setFixedHeader = function (t, e) {
                            for (var n, r = a(e || this.columns || []); !(n = r()).done;) {
                                var i = n.value;
                                void 0 === i.fixedHeader && (i.fixedHeader = t.fixedHeader), i.columns && this.setFixedHeader(t, i.columns)
                            }
                        }, o.setResizable = function (t, e) {
                            for (var n, r = a(e || this.columns || []); !(n = r()).done;) {
                                var i = n.value;
                                void 0 === i.resizable && (i.resizable = t.resizable), i.columns && this.setResizable(t, i.columns)
                            }
                        }, o.setID = function (t) {
                            for (var e, n = a(t || this.columns || []); !(e = n()).done;) {
                                var r = e.value;
                                r.id || "string" != typeof r.name || (r.id = kt(r.name)), r.id || pt.error('Could not find a valid ID for one of the columns. Make sure a valid "id" is set for all columns.'), r.columns && this.setID(r.columns)
                            }
                        }, o.populatePlugins = function (t, e) {
                            for (var r, i = a(e); !(r = i()).done;) {
                                var o = r.value;
                                void 0 !== o.plugin && t.plugin.add(n({
                                    id: o.id,
                                    props: {}
                                }, o.plugin, {
                                    position: ot.Cell
                                }))
                            }
                        }, i.fromColumns = function (t) {
                            for (var e, n = new i, r = a(t); !(e = r()).done;) {
                                var o = e.value;
                                if ("string" == typeof o || p(o)) n.columns.push({
                                    name: o
                                });
                                else if ("object" == typeof o) {
                                    var s = o;
                                    s.columns && (s.columns = i.fromColumns(s.columns).columns), "object" == typeof s.plugin && void 0 === s.data && (s.data = null), n.columns.push(o)
                                }
                            }
                            return n
                        }, i.fromUserConfig = function (t) {
                            var e = new i;
                            return t.from ? e.columns = i.fromHTMLTable(t.from).columns : t.columns ? e.columns = i.fromColumns(t.columns).columns : !t.data || "object" != typeof t.data[0] || t.data[0] instanceof Array || (e.columns = Object.keys(t.data[0]).map(function (t) {
                                return {
                                    name: t
                                }
                            })), e.columns.length ? (e.setID(), e.setSort(t), e.setFixedHeader(t), e.setResizable(t), e.populatePlugins(t, e.columns), e) : null
                        }, i.fromHTMLTable = function (t) {
                            for (var e, n = new i, r = a(t.querySelector("thead").querySelectorAll("th")); !(e = r()).done;) {
                                var o = e.value;
                                n.columns.push({
                                    name: o.innerHTML,
                                    width: o.width
                                })
                            }
                            return n
                        }, i.tabularFormat = function (t) {
                            var e = [],
                                n = t || [],
                                r = [];
                            if (n && n.length) {
                                e.push(n);
                                for (var i, o = a(n); !(i = o()).done;) {
                                    var s = i.value;
                                    s.columns && s.columns.length && (r = r.concat(s.columns))
                                }
                                r.length && (e = e.concat(this.tabularFormat(r)))
                            }
                            return e
                        }, i.leafColumns = function (t) {
                            var e = [],
                                n = t || [];
                            if (n && n.length)
                                for (var r, i = a(n); !(r = i()).done;) {
                                    var o = r.value;
                                    o.columns && 0 !== o.columns.length || e.push(o), o.columns && (e = e.concat(this.leafColumns(o.columns)))
                                }
                            return e
                        }, i.maximumDepth = function (t) {
                            return this.tabularFormat([t]).length - 1
                        }, e(i, [{
                            key: "columns",
                            get: function () {
                                return this._columns
                            },
                            set: function (t) {
                                this._columns = t
                            }
                        }, {
                            key: "visibleColumns",
                            get: function () {
                                return this._columns.filter(function (t) {
                                    return !t.hidden
                                })
                            }
                        }]), i
                    }(q),
                    Ct = /*#__PURE__*/ function () {
                        function t() {
                            this._callbacks = void 0, this._isDispatching = void 0, this._isHandled = void 0, this._isPending = void 0, this._lastID = void 0, this._pendingPayload = void 0, this._callbacks = {}, this._isDispatching = !1, this._isHandled = {}, this._isPending = {}, this._lastID = 1
                        }
                        var e = t.prototype;
                        return e.register = function (t) {
                            var e = "ID_" + this._lastID++;
                            return this._callbacks[e] = t, e
                        }, e.unregister = function (t) {
                            if (!this._callbacks[t]) throw Error("Dispatcher.unregister(...): " + t + " does not map to a registered callback.");
                            delete this._callbacks[t]
                        }, e.waitFor = function (t) {
                            if (!this._isDispatching) throw Error("Dispatcher.waitFor(...): Must be invoked while dispatching.");
                            for (var e = 0; e < t.length; e++) {
                                var n = t[e];
                                if (this._isPending[n]) {
                                    if (!this._isHandled[n]) throw Error("Dispatcher.waitFor(...): Circular dependency detected while ' +\n            'waiting for " + n + ".")
                                } else {
                                    if (!this._callbacks[n]) throw Error("Dispatcher.waitFor(...): " + n + " does not map to a registered callback.");
                                    this._invokeCallback(n)
                                }
                            }
                        }, e.dispatch = function (t) {
                            if (this._isDispatching) throw Error("Dispatch.dispatch(...): Cannot dispatch in the middle of a dispatch.");
                            this._startDispatching(t);
                            try {
                                for (var e in this._callbacks) this._isPending[e] || this._invokeCallback(e)
                            } finally {
                                this._stopDispatching()
                            }
                        }, e.isDispatching = function () {
                            return this._isDispatching
                        }, e._invokeCallback = function (t) {
                            this._isPending[t] = !0, this._callbacks[t](this._pendingPayload), this._isHandled[t] = !0
                        }, e._startDispatching = function (t) {
                            for (var e in this._callbacks) this._isPending[e] = !1, this._isHandled[e] = !1;
                            this._pendingPayload = t, this._isDispatching = !0
                        }, e._stopDispatching = function () {
                            delete this._pendingPayload, this._isDispatching = !1
                        }, t
                    }(),
                    Pt = function () {},
                    xt = /*#__PURE__*/ function (t) {
                        function e(e) {
                            var n;
                            return (n = t.call(this) || this).data = void 0, n.set(e), n
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.get = function () {
                            try {
                                return Promise.resolve(this.data()).then(function (t) {
                                    return {
                                        data: t,
                                        total: t.length
                                    }
                                })
                            } catch (t) {
                                return Promise.reject(t)
                            }
                        }, n.set = function (t) {
                            return t instanceof Array ? this.data = function () {
                                return t
                            } : t instanceof Function && (this.data = t), this
                        }, e
                    }(Pt),
                    Nt = /*#__PURE__*/ function (t) {
                        function e(e) {
                            var n;
                            return (n = t.call(this) || this).options = void 0, n.options = e, n
                        }
                        r(e, t);
                        var i = e.prototype;
                        return i.handler = function (t) {
                            return "function" == typeof this.options.handle ? this.options.handle(t) : t.ok ? t.json() : (pt.error("Could not fetch data: " + t.status + " - " + t.statusText, !0), null)
                        }, i.get = function (t) {
                            var e = n({}, this.options, t);
                            return "function" == typeof e.data ? e.data(e) : fetch(e.url, e).then(this.handler.bind(this)).then(function (t) {
                                return {
                                    data: e.then(t),
                                    total: "function" == typeof e.total ? e.total(t) : void 0
                                }
                            })
                        }, e
                    }(Pt),
                    Et = /*#__PURE__*/ function () {
                        function t() {}
                        return t.createFromUserConfig = function (t) {
                            var e = null;
                            return t.data && (e = new xt(t.data)), t.from && (e = new xt(this.tableElementToArray(t.from)), t.from.style.display = "none"), t.server && (e = new Nt(t.server)), e || pt.error("Could not determine the storage type", !0), e
                        }, t.tableElementToArray = function (t) {
                            for (var e, n, r = [], i = a(t.querySelector("tbody").querySelectorAll("tr")); !(e = i()).done;) {
                                for (var o, s = [], u = a(e.value.querySelectorAll("td")); !(o = u()).done;) {
                                    var l = o.value;
                                    1 === l.childNodes.length && l.childNodes[0].nodeType === Node.TEXT_NODE ? s.push((n = l.innerHTML, (new DOMParser).parseFromString(n, "text/html").documentElement.textContent)) : s.push(K(l.innerHTML))
                                }
                                r.push(s)
                            }
                            return r
                        }, t
                    }(),
                    Ft = "undefined" != typeof Symbol ? Symbol.iterator || (Symbol.iterator = Symbol("Symbol.iterator")) : "@@iterator";

                function Tt(t, e, n) {
                    if (!t.s) {
                        if (n instanceof Dt) {
                            if (!n.s) return void(n.o = Tt.bind(null, t, e));
                            1 & e && (e = n.s), n = n.v
                        }
                        if (n && n.then) return void n.then(Tt.bind(null, t, e), Tt.bind(null, t, 2));
                        t.s = e, t.v = n;
                        var r = t.o;
                        r && r(t)
                    }
                }
                var Dt = /*#__PURE__*/ function () {
                    function t() {}
                    return t.prototype.then = function (e, n) {
                        var r = new t,
                            i = this.s;
                        if (i) {
                            var o = 1 & i ? e : n;
                            if (o) {
                                try {
                                    Tt(r, 1, o(this.v))
                                } catch (t) {
                                    Tt(r, 2, t)
                                }
                                return r
                            }
                            return this
                        }
                        return this.o = function (t) {
                            try {
                                var i = t.v;
                                1 & t.s ? Tt(r, 1, e ? e(i) : i) : n ? Tt(r, 1, n(i)) : Tt(r, 2, i)
                            } catch (t) {
                                Tt(r, 2, t)
                            }
                        }, r
                    }, t
                }();

                function Rt(t) {
                    return t instanceof Dt && 1 & t.s
                }
                var Lt, At = /*#__PURE__*/ function (t) {
                        function n(e) {
                            var n;
                            return (n = t.call(this) || this)._steps = new Map, n.cache = new Map, n.lastProcessorIndexUpdated = -1, e && e.forEach(function (t) {
                                return n.register(t)
                            }), n
                        }
                        r(n, t);
                        var i = n.prototype;
                        return i.clearCache = function () {
                            this.cache = new Map, this.lastProcessorIndexUpdated = -1
                        }, i.register = function (t, e) {
                            if (void 0 === e && (e = null), null === t.type) throw Error("Processor type is not defined");
                            t.on("propsUpdated", this.processorPropsUpdated.bind(this)), this.addProcessorByPriority(t, e), this.afterRegistered(t)
                        }, i.unregister = function (t) {
                            if (t) {
                                var e = this._steps.get(t.type);
                                e && e.length && (this._steps.set(t.type, e.filter(function (e) {
                                    return e != t
                                })), this.emit("updated", t))
                            }
                        }, i.addProcessorByPriority = function (t, e) {
                            var n = this._steps.get(t.type);
                            if (!n) {
                                var r = [];
                                this._steps.set(t.type, r), n = r
                            }
                            if (null === e || e < 0) n.push(t);
                            else if (n[e]) {
                                var i = n.slice(0, e - 1),
                                    o = n.slice(e + 1);
                                this._steps.set(t.type, i.concat(t).concat(o))
                            } else n[e] = t
                        }, i.getStepsByType = function (t) {
                            return this.steps.filter(function (e) {
                                return e.type === t
                            })
                        }, i.getSortedProcessorTypes = function () {
                            return Object.keys(Y).filter(function (t) {
                                return !isNaN(Number(t))
                            }).map(function (t) {
                                return Number(t)
                            })
                        }, i.process = function (t) {
                            try {
                                var e = this,
                                    n = function (t) {
                                        return e.lastProcessorIndexUpdated = i.length, e.emit("afterProcess", o), o
                                    },
                                    r = e.lastProcessorIndexUpdated,
                                    i = e.steps,
                                    o = t,
                                    s = function (t, n) {
                                        try {
                                            var s = function (t, e, n) {
                                                if ("function" == typeof t[Ft]) {
                                                    var r, i, o, s = t[Ft]();
                                                    if (function t(n) {
                                                            try {
                                                                for (; !(r = s.next()).done;)
                                                                    if ((n = e(r.value)) && n.then) {
                                                                        if (!Rt(n)) return void n.then(t, o || (o = Tt.bind(null, i = new Dt, 2)));
                                                                        n = n.v
                                                                    } i ? Tt(i, 1, n) : i = n
                                                            } catch (t) {
                                                                Tt(i || (i = new Dt), 2, t)
                                                            }
                                                        }(), s.return) {
                                                        var a = function (t) {
                                                            try {
                                                                r.done || s.return()
                                                            } catch (t) {}
                                                            return t
                                                        };
                                                        if (i && i.then) return i.then(a, function (t) {
                                                            throw a(t)
                                                        });
                                                        a()
                                                    }
                                                    return i
                                                }
                                                if (!("length" in t)) throw new TypeError("Object is not iterable");
                                                for (var u = [], l = 0; l < t.length; l++) u.push(t[l]);
                                                return function (t, e, n) {
                                                    var r, i, o = -1;
                                                    return function n(s) {
                                                        try {
                                                            for (; ++o < t.length;)
                                                                if ((s = e(o)) && s.then) {
                                                                    if (!Rt(s)) return void s.then(n, i || (i = Tt.bind(null, r = new Dt, 2)));
                                                                    s = s.v
                                                                } r ? Tt(r, 1, s) : r = s
                                                        } catch (t) {
                                                            Tt(r || (r = new Dt), 2, t)
                                                        }
                                                    }(), r
                                                }(u, function (t) {
                                                    return e(u[t])
                                                })
                                            }(i, function (t) {
                                                var n = e.findProcessorIndexByID(t.id),
                                                    i = function () {
                                                        if (n >= r) return Promise.resolve(t.process(o)).then(function (n) {
                                                            e.cache.set(t.id, o = n)
                                                        });
                                                        o = e.cache.get(t.id)
                                                    }();
                                                if (i && i.then) return i.then(function () {})
                                            })
                                        } catch (t) {
                                            return n(t)
                                        }
                                        return s && s.then ? s.then(void 0, n) : s
                                    }(0, function (t) {
                                        throw pt.error(t), e.emit("error", o), t
                                    });
                                return Promise.resolve(s && s.then ? s.then(n) : n())
                            } catch (t) {
                                return Promise.reject(t)
                            }
                        }, i.findProcessorIndexByID = function (t) {
                            return this.steps.findIndex(function (e) {
                                return e.id == t
                            })
                        }, i.setLastProcessorIndex = function (t) {
                            var e = this.findProcessorIndexByID(t.id);
                            this.lastProcessorIndexUpdated > e && (this.lastProcessorIndexUpdated = e)
                        }, i.processorPropsUpdated = function (t) {
                            this.setLastProcessorIndex(t), this.emit("propsUpdated"), this.emit("updated", t)
                        }, i.afterRegistered = function (t) {
                            this.setLastProcessorIndex(t), this.emit("afterRegister"), this.emit("updated", t)
                        }, e(n, [{
                            key: "steps",
                            get: function () {
                                for (var t, e = [], n = a(this.getSortedProcessorTypes()); !(t = n()).done;) {
                                    var r = this._steps.get(t.value);
                                    r && r.length && (e = e.concat(r))
                                }
                                return e.filter(function (t) {
                                    return t
                                })
                            }
                        }]), n
                    }(tt),
                    It = /*#__PURE__*/ function (t) {
                        function n() {
                            return t.apply(this, arguments) || this
                        }
                        return r(n, t), n.prototype._process = function (t) {
                            try {
                                return Promise.resolve(this.props.storage.get(t))
                            } catch (t) {
                                return Promise.reject(t)
                            }
                        }, e(n, [{
                            key: "type",
                            get: function () {
                                return Y.Extractor
                            }
                        }]), n
                    }(et),
                    Ut = /*#__PURE__*/ function (t) {
                        function n() {
                            return t.apply(this, arguments) || this
                        }
                        return r(n, t), n.prototype._process = function (t) {
                            var e = Q.fromArray(t.data);
                            return e.length = t.total, e
                        }, e(n, [{
                            key: "type",
                            get: function () {
                                return Y.Transformer
                            }
                        }]), n
                    }(et),
                    Ht = /*#__PURE__*/ function (t) {
                        function i() {
                            return t.apply(this, arguments) || this
                        }
                        return r(i, t), i.prototype._process = function () {
                            return Object.entries(this.props.serverStorageOptions).filter(function (t) {
                                return "function" != typeof t[1]
                            }).reduce(function (t, e) {
                                var r;
                                return n({}, t, ((r = {})[e[0]] = e[1], r))
                            }, {})
                        }, e(i, [{
                            key: "type",
                            get: function () {
                                return Y.Initiator
                            }
                        }]), i
                    }(et),
                    Mt = /*#__PURE__*/ function (t) {
                        function n() {
                            return t.apply(this, arguments) || this
                        }
                        r(n, t);
                        var i = n.prototype;
                        return i.castData = function (t) {
                            if (!t || !t.length) return [];
                            if (!this.props.header || !this.props.header.columns) return t;
                            var e = St.leafColumns(this.props.header.columns);
                            return t[0] instanceof Array ? t.map(function (t) {
                                var n = 0;
                                return e.map(function (e, r) {
                                    return void 0 !== e.data ? (n++, "function" == typeof e.data ? e.data(t) : e.data) : t[r - n]
                                })
                            }) : "object" != typeof t[0] || t[0] instanceof Array ? [] : t.map(function (t) {
                                return e.map(function (e, n) {
                                    return void 0 !== e.data ? "function" == typeof e.data ? e.data(t) : e.data : e.id ? t[e.id] : (pt.error("Could not find the correct cell for column at position " + n + ".\n                          Make sure either 'id' or 'selector' is defined for all columns."), null)
                                })
                            })
                        }, i._process = function (t) {
                            return {
                                data: this.castData(t.data),
                                total: t.total
                            }
                        }, e(n, [{
                            key: "type",
                            get: function () {
                                return Y.Transformer
                            }
                        }]), n
                    }(et),
                    Ot = /*#__PURE__*/ function () {
                        function t() {}
                        return t.createFromConfig = function (t) {
                            var e = new At;
                            return t.storage instanceof Nt && e.register(new Ht({
                                serverStorageOptions: t.server
                            })), e.register(new It({
                                storage: t.storage
                            })), e.register(new Mt({
                                header: t.header
                            })), e.register(new Ut), e
                        }, t
                    }(),
                    jt = /*#__PURE__*/ function () {
                        function t(e) {
                            this._userConfig = void 0, Object.assign(this, n({}, t.defaultConfig(), e)), this._userConfig = {}
                        }
                        var e = t.prototype;
                        return e.assign = function (t) {
                            for (var e = 0, n = Object.keys(t); e < n.length; e++) {
                                var r = n[e];
                                "_userConfig" !== r && (this[r] = t[r])
                            }
                            return this
                        }, e.update = function (e) {
                            return e ? (this._userConfig = n({}, this._userConfig, e), this.assign(t.fromUserConfig(this._userConfig)), this) : this
                        }, t.defaultConfig = function () {
                            return {
                                plugin: new ft,
                                dispatcher: new Ct,
                                tableRef: {
                                    current: null
                                },
                                tempRef: {
                                    current: null
                                },
                                width: "100%",
                                height: "auto",
                                autoWidth: !0,
                                style: {},
                                className: {}
                            }
                        }, t.fromUserConfig = function (e) {
                            var r = new t(e);
                            return r._userConfig = e, "boolean" == typeof e.sort && e.sort && r.assign({
                                sort: {
                                    multiColumn: !0
                                }
                            }), r.assign({
                                header: St.fromUserConfig(r)
                            }), r.assign({
                                storage: Et.createFromUserConfig(e)
                            }), r.assign({
                                pipeline: Ot.createFromConfig(r)
                            }), r.assign({
                                translator: new G(e.language)
                            }), r.plugin.add({
                                id: "search",
                                position: ot.Header,
                                component: _t,
                                props: n({
                                    enabled: !0 === e.search || e.search instanceof Object
                                }, e.search)
                            }), r.plugin.add({
                                id: "pagination",
                                position: ot.Footer,
                                component: vt,
                                props: n({
                                    enabled: !0 === e.pagination || e.pagination instanceof Object
                                }, e.pagination)
                            }), e.plugins && e.plugins.forEach(function (t) {
                                return r.plugin.add(t)
                            }), r
                        }, t
                    }();
                ! function (t) {
                    t[t.Init = 0] = "Init", t[t.Loading = 1] = "Loading", t[t.Loaded = 2] = "Loaded", t[t.Rendered = 3] = "Rendered", t[t.Error = 4] = "Error"
                }(Lt || (Lt = {}));
                var Wt, Bt, zt, qt, Vt = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        r(e, t);
                        var i = e.prototype;
                        return i.content = function () {
                            return this.props.column && "function" == typeof this.props.column.formatter ? this.props.column.formatter(this.props.cell.data, this.props.row, this.props.column) : this.props.column && this.props.column.plugin ? b(dt, {
                                pluginId: this.props.column.id,
                                props: {
                                    column: this.props.column,
                                    cell: this.props.cell,
                                    row: this.props.row
                                }
                            }) : this.props.cell.data
                        }, i.handleClick = function (t) {
                            this.props.messageCell || this.config.eventEmitter.emit("cellClick", t, this.props.cell, this.props.column, this.props.row)
                        }, i.getCustomAttributes = function (t) {
                            return t ? "function" == typeof t.attributes ? t.attributes(this.props.cell.data, this.props.row, this.props.column) : t.attributes : {}
                        }, i.render = function () {
                            return b("td", n({
                                role: this.props.role,
                                colSpan: this.props.colSpan,
                                "data-column-id": this.props.column && this.props.column.id,
                                className: it(rt("td"), this.props.className, this.config.className.td),
                                style: n({}, this.props.style, this.config.style.td),
                                onClick: this.handleClick.bind(this)
                            }, this.getCustomAttributes(this.props.column)), this.content())
                        }, e
                    }(X),
                    Gt = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.getColumn = function (t) {
                            if (this.props.header) {
                                var e = St.leafColumns(this.props.header.columns);
                                if (e) return e[t]
                            }
                            return null
                        }, n.handleClick = function (t) {
                            this.props.messageRow || this.config.eventEmitter.emit("rowClick", t, this.props.row)
                        }, n.getChildren = function () {
                            var t = this;
                            return this.props.children ? this.props.children : b(S, null, this.props.row.cells.map(function (e, n) {
                                var r = t.getColumn(n);
                                return r && r.hidden ? null : b(Vt, {
                                    key: e.id,
                                    cell: e,
                                    row: t.props.row,
                                    column: r
                                })
                            }))
                        }, n.render = function () {
                            return b("tr", {
                                className: it(rt("tr"), this.config.className.tr),
                                onClick: this.handleClick.bind(this)
                            }, this.getChildren())
                        }, e
                    }(X),
                    Xt = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        return r(e, t), e.prototype.render = function () {
                            return b(Gt, {
                                messageRow: !0
                            }, b(Vt, {
                                role: "alert",
                                colSpan: this.props.colSpan,
                                messageCell: !0,
                                cell: new Z(this.props.message),
                                className: it(rt("message"), this.props.className ? this.props.className : null)
                            }))
                        }, e
                    }(X),
                    $t = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.headerLength = function () {
                            return this.props.header ? this.props.header.visibleColumns.length : 0
                        }, n.render = function () {
                            var t = this;
                            return b("tbody", {
                                className: it(rt("tbody"), this.config.className.tbody)
                            }, this.props.data && this.props.data.rows.map(function (e) {
                                return b(Gt, {
                                    key: e.id,
                                    row: e,
                                    header: t.props.header
                                })
                            }), this.props.status === Lt.Loading && (!this.props.data || 0 === this.props.data.length) && b(Xt, {
                                message: this._("loading"),
                                colSpan: this.headerLength(),
                                className: it(rt("loading"), this.config.className.loading)
                            }), this.props.status === Lt.Rendered && this.props.data && 0 === this.props.data.length && b(Xt, {
                                message: this._("noRecordsFound"),
                                colSpan: this.headerLength(),
                                className: it(rt("notfound"), this.config.className.notfound)
                            }), this.props.status === Lt.Error && b(Xt, {
                                message: this._("error"),
                                colSpan: this.headerLength(),
                                className: it(rt("error"), this.config.className.error)
                            }))
                        }, e
                    }(X),
                    Kt = /*#__PURE__*/ function (t) {
                        function n() {
                            return t.apply(this, arguments) || this
                        }
                        r(n, t);
                        var i = n.prototype;
                        return i.validateProps = function () {
                            for (var t, e = a(this.props.columns); !(t = e()).done;) {
                                var n = t.value;
                                void 0 === n.direction && (n.direction = 1), 1 !== n.direction && -1 !== n.direction && pt.error("Invalid sort direction " + n.direction)
                            }
                        }, i.compare = function (t, e) {
                            return t > e ? 1 : t < e ? -1 : 0
                        }, i.compareWrapper = function (t, e) {
                            for (var n, r = 0, i = a(this.props.columns); !(n = i()).done;) {
                                var o = n.value;
                                if (0 !== r) break;
                                var s = t.cells[o.index].data,
                                    u = e.cells[o.index].data;
                                r |= "function" == typeof o.compare ? o.compare(s, u) * o.direction : this.compare(s, u) * o.direction
                            }
                            return r
                        }, i._process = function (t) {
                            var e = [].concat(t.rows);
                            e.sort(this.compareWrapper.bind(this));
                            var n = new Q(e);
                            return n.length = t.length, n
                        }, e(n, [{
                            key: "type",
                            get: function () {
                                return Y.Sort
                            }
                        }]), n
                    }(et),
                    Yt = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.getInitialState = function () {
                            return []
                        }, n.handle = function (t, e) {
                            "SORT_COLUMN" === t ? this.sortColumn(e.index, e.direction, e.multi, e.compare) : "SORT_COLUMN_TOGGLE" === t && this.sortToggle(e.index, e.multi, e.compare)
                        }, n.sortToggle = function (t, e, n) {
                            var r = [].concat(this.state).find(function (e) {
                                return e.index === t
                            });
                            this.sortColumn(t, r && 1 === r.direction ? -1 : 1, e, n)
                        }, n.sortColumn = function (t, e, n, r) {
                            var i = [].concat(this.state),
                                o = i.length,
                                s = i.find(function (e) {
                                    return e.index === t
                                }),
                                a = !1,
                                u = !1,
                                l = !1,
                                c = !1;
                            if (void 0 !== s ? n ? -1 === s.direction ? l = !0 : c = !0 : 1 === o ? c = !0 : o > 1 && (u = !0, a = !0) : 0 === o ? a = !0 : o > 0 && !n ? (a = !0, u = !0) : o > 0 && n && (a = !0), u && (i = []), a) i.push({
                                index: t,
                                direction: e,
                                compare: r
                            });
                            else if (c) {
                                var p = i.indexOf(s);
                                i[p].direction = e
                            } else if (l) {
                                var h = i.indexOf(s);
                                i.splice(h, 1)
                            }
                            this.setState(i)
                        }, e
                    }(st),
                    Zt = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.sortColumn = function (t, e, n, r) {
                            this.dispatch("SORT_COLUMN", {
                                index: t,
                                direction: e,
                                multi: n,
                                compare: r
                            })
                        }, n.sortToggle = function (t, e, n) {
                            this.dispatch("SORT_COLUMN_TOGGLE", {
                                index: t,
                                multi: e,
                                compare: n
                            })
                        }, e
                    }(ut),
                    Jt = /*#__PURE__*/ function (t) {
                        function i() {
                            return t.apply(this, arguments) || this
                        }
                        return r(i, t), i.prototype._process = function (t) {
                            var e = {};
                            return this.props.url && (e.url = this.props.url(t.url, this.props.columns)), this.props.body && (e.body = this.props.body(t.body, this.props.columns)), n({}, t, e)
                        }, e(i, [{
                            key: "type",
                            get: function () {
                                return Y.ServerSort
                            }
                        }]), i
                    }(et),
                    Qt = /*#__PURE__*/ function (t) {
                        function e(e, n) {
                            var r;
                            return (r = t.call(this, e, n) || this).sortProcessor = void 0, r.actions = void 0, r.store = void 0, r.updateStateFn = void 0, r.updateSortProcessorFn = void 0, r.actions = new Zt(r.config.dispatcher), r.store = new Yt(r.config.dispatcher), e.enabled && (r.sortProcessor = r.getOrCreateSortProcessor(), r.updateStateFn = r.updateState.bind(o(r)), r.store.on("updated", r.updateStateFn), r.state = {
                                direction: 0
                            }), r
                        }
                        r(e, t);
                        var i = e.prototype;
                        return i.componentWillUnmount = function () {
                            this.config.pipeline.unregister(this.sortProcessor), this.store.off("updated", this.updateStateFn), this.updateSortProcessorFn && this.store.off("updated", this.updateSortProcessorFn)
                        }, i.updateState = function () {
                            var t = this,
                                e = this.store.state.find(function (e) {
                                    return e.index === t.props.index
                                });
                            this.setState(e ? {
                                direction: e.direction
                            } : {
                                direction: 0
                            })
                        }, i.updateSortProcessor = function (t) {
                            this.sortProcessor.setProps({
                                columns: t
                            })
                        }, i.getOrCreateSortProcessor = function () {
                            var t = Y.Sort;
                            this.config.sort && "object" == typeof this.config.sort.server && (t = Y.ServerSort);
                            var e, r = this.config.pipeline.getStepsByType(t);
                            return r.length > 0 ? e = r[0] : (this.updateSortProcessorFn = this.updateSortProcessor.bind(this), this.store.on("updated", this.updateSortProcessorFn), e = t === Y.ServerSort ? new Jt(n({
                                columns: this.store.state
                            }, this.config.sort.server)) : new Kt({
                                columns: this.store.state
                            }), this.config.pipeline.register(e)), e
                        }, i.changeDirection = function (t) {
                            t.preventDefault(), t.stopPropagation(), this.actions.sortToggle(this.props.index, !0 === t.shiftKey && this.config.sort.multiColumn, this.props.compare)
                        }, i.render = function () {
                            if (!this.props.enabled) return null;
                            var t = this.state.direction,
                                e = "neutral";
                            return 1 === t ? e = "asc" : -1 === t && (e = "desc"), b("button", {
                                tabIndex: -1,
                                "aria-label": this._("sort.sort" + (1 === t ? "Desc" : "Asc")),
                                title: this._("sort.sort" + (1 === t ? "Desc" : "Asc")),
                                className: it(rt("sort"), rt("sort", e), this.config.className.sort),
                                onClick: this.changeDirection.bind(this)
                            })
                        }, e
                    }(X),
                    te = /*#__PURE__*/ function (t) {
                        function e() {
                            for (var e, n = arguments.length, r = new Array(n), i = 0; i < n; i++) r[i] = arguments[i];
                            return (e = t.call.apply(t, [this].concat(r)) || this).moveFn = void 0, e.upFn = void 0, e
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.getPageX = function (t) {
                            return t instanceof MouseEvent ? Math.floor(t.pageX) : Math.floor(t.changedTouches[0].pageX)
                        }, n.start = function (t) {
                            var e, n, r, i, o;
                            t.stopPropagation(), this.setState({
                                offsetStart: parseInt(this.props.thRef.current.style.width, 10) - this.getPageX(t)
                            }), this.upFn = this.end.bind(this), this.moveFn = (e = this.move.bind(this), void 0 === (n = 10) && (n = 100), function () {
                                var t = [].slice.call(arguments);
                                r ? (clearTimeout(i), i = setTimeout(function () {
                                    Date.now() - o >= n && (e.apply(void 0, t), o = Date.now())
                                }, Math.max(n - (Date.now() - o), 0))) : (e.apply(void 0, t), o = Date.now(), r = !0)
                            }), document.addEventListener("mouseup", this.upFn), document.addEventListener("touchend", this.upFn), document.addEventListener("mousemove", this.moveFn), document.addEventListener("touchmove", this.moveFn)
                        }, n.move = function (t) {
                            t.stopPropagation();
                            var e = this.props.thRef.current;
                            this.state.offsetStart + this.getPageX(t) >= parseInt(e.style.minWidth, 10) && (e.style.width = this.state.offsetStart + this.getPageX(t) + "px")
                        }, n.end = function (t) {
                            t.stopPropagation(), document.removeEventListener("mouseup", this.upFn), document.removeEventListener("mousemove", this.moveFn), document.removeEventListener("touchmove", this.moveFn), document.removeEventListener("touchend", this.upFn)
                        }, n.render = function () {
                            return b("div", {
                                className: it(rt("th"), rt("resizable")),
                                onMouseDown: this.start.bind(this),
                                onTouchStart: this.start.bind(this),
                                onClick: function (t) {
                                    return t.stopPropagation()
                                }
                            })
                        }, e
                    }(X),
                    ee = /*#__PURE__*/ function (t) {
                        function e(e, n) {
                            var r;
                            return (r = t.call(this, e, n) || this).sortRef = {
                                current: null
                            }, r.thRef = {
                                current: null
                            }, r.state = {
                                style: {}
                            }, r
                        }
                        r(e, t);
                        var i = e.prototype;
                        return i.isSortable = function () {
                            return this.props.column.sort.enabled
                        }, i.isResizable = function () {
                            return this.props.column.resizable
                        }, i.onClick = function (t) {
                            t.stopPropagation(), this.isSortable() && this.sortRef.current.changeDirection(t)
                        }, i.keyDown = function (t) {
                            this.isSortable() && 13 === t.which && this.onClick(t)
                        }, i.componentDidMount = function () {
                            var t = this;
                            setTimeout(function () {
                                if (t.props.column.fixedHeader && t.thRef.current) {
                                    var e = t.thRef.current.offsetTop;
                                    "number" == typeof e && t.setState({
                                        style: {
                                            top: e
                                        }
                                    })
                                }
                            }, 0)
                        }, i.content = function () {
                            return void 0 !== this.props.column.name ? this.props.column.name : void 0 !== this.props.column.plugin ? b(dt, {
                                pluginId: this.props.column.plugin.id,
                                props: {
                                    column: this.props.column
                                }
                            }) : null
                        }, i.getCustomAttributes = function () {
                            var t = this.props.column;
                            return t ? "function" == typeof t.attributes ? t.attributes(null, null, this.props.column) : t.attributes : {}
                        }, i.render = function () {
                            var t = {};
                            return this.isSortable() && (t.tabIndex = 0), b("th", n({
                                ref: this.thRef,
                                "data-column-id": this.props.column && this.props.column.id,
                                className: it(rt("th"), this.isSortable() ? rt("th", "sort") : null, this.props.column.fixedHeader ? rt("th", "fixed") : null, this.config.className.th),
                                onClick: this.onClick.bind(this),
                                style: n({}, this.config.style.th, {
                                    minWidth: this.props.column.minWidth,
                                    width: this.props.column.width
                                }, this.state.style, this.props.style),
                                onKeyDown: this.keyDown.bind(this),
                                rowSpan: this.props.rowSpan > 1 ? this.props.rowSpan : void 0,
                                colSpan: this.props.colSpan > 1 ? this.props.colSpan : void 0
                            }, this.getCustomAttributes(), t), b("div", {
                                className: rt("th", "content")
                            }, this.content()), this.isSortable() && b(Qt, n({
                                ref: this.sortRef,
                                index: this.props.index
                            }, this.props.column.sort)), this.isResizable() && this.props.index < this.config.header.visibleColumns.length - 1 && b(te, {
                                column: this.props.column,
                                thRef: this.thRef
                            }))
                        }, e
                    }(X),
                    ne = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.renderColumn = function (t, e, n, r) {
                            var i = function (t, e, n) {
                                var r = St.maximumDepth(t),
                                    i = n - e;
                                return {
                                    rowSpan: Math.floor(i - r - r / i),
                                    colSpan: t.columns && t.columns.length || 1
                                }
                            }(t, e, r);
                            return b(ee, {
                                column: t,
                                index: n,
                                colSpan: i.colSpan,
                                rowSpan: i.rowSpan
                            })
                        }, n.renderRow = function (t, e, n) {
                            var r = this,
                                i = St.leafColumns(this.props.header.columns);
                            return b(Gt, null, t.map(function (t) {
                                return t.hidden ? null : r.renderColumn(t, e, i.indexOf(t), n)
                            }))
                        }, n.renderRows = function () {
                            var t = this,
                                e = St.tabularFormat(this.props.header.columns);
                            return e.map(function (n, r) {
                                return t.renderRow(n, r, e.length)
                            })
                        }, n.render = function () {
                            return this.props.header ? b("thead", {
                                key: this.props.header.id,
                                className: it(rt("thead"), this.config.className.thead)
                            }, this.renderRows()) : null
                        }, e
                    }(X),
                    re = /*#__PURE__*/ function (t) {
                        function e() {
                            return t.apply(this, arguments) || this
                        }
                        return r(e, t), e.prototype.render = function () {
                            return b("table", {
                                role: "grid",
                                className: it(rt("table"), this.config.className.table),
                                style: n({}, this.config.style.table, {
                                    height: this.props.height
                                })
                            }, b(ne, {
                                header: this.props.header
                            }), b($t, {
                                data: this.props.data,
                                status: this.props.status,
                                header: this.props.header
                            }))
                        }, e
                    }(X),
                    ie = /*#__PURE__*/ function (t) {
                        function e(e, n) {
                            var r;
                            return (r = t.call(this, e, n) || this).headerRef = {
                                current: null
                            }, r.state = {
                                isActive: !0
                            }, r
                        }
                        r(e, t);
                        var i = e.prototype;
                        return i.componentDidMount = function () {
                            0 === this.headerRef.current.children.length && this.setState({
                                isActive: !1
                            })
                        }, i.render = function () {
                            return this.state.isActive ? b("div", {
                                ref: this.headerRef,
                                className: it(rt("head"), this.config.className.header),
                                style: n({}, this.config.style.header)
                            }, b(dt, {
                                position: ot.Header
                            })) : null
                        }, e
                    }(X),
                    oe = /*#__PURE__*/ function (t) {
                        function e(e, n) {
                            var r;
                            return (r = t.call(this, e, n) || this).footerRef = {
                                current: null
                            }, r.state = {
                                isActive: !0
                            }, r
                        }
                        r(e, t);
                        var i = e.prototype;
                        return i.componentDidMount = function () {
                            0 === this.footerRef.current.children.length && this.setState({
                                isActive: !1
                            })
                        }, i.render = function () {
                            return this.state.isActive ? b("div", {
                                ref: this.footerRef,
                                className: it(rt("footer"), this.config.className.footer),
                                style: n({}, this.config.style.footer)
                            }, b(dt, {
                                position: ot.Footer
                            })) : null
                        }, e
                    }(X),
                    se = /*#__PURE__*/ function (t) {
                        function e(e, n) {
                            var r;
                            return (r = t.call(this, e, n) || this).configContext = void 0, r.processPipelineFn = void 0, r.configContext = function (t, e) {
                                var n = {
                                    __c: e = "__cC" + d++,
                                    __: null,
                                    Consumer: function (t, e) {
                                        return t.children(e)
                                    },
                                    Provider: function (t) {
                                        var n, r;
                                        return this.getChildContext || (n = [], (r = {})[e] = this, this.getChildContext = function () {
                                            return r
                                        }, this.shouldComponentUpdate = function (t) {
                                            this.props.value !== t.value && n.some(N)
                                        }, this.sub = function (t) {
                                            n.push(t);
                                            var e = t.componentWillUnmount;
                                            t.componentWillUnmount = function () {
                                                n.splice(n.indexOf(t), 1), e && e.call(t)
                                            }
                                        }), t.children
                                    }
                                };
                                return n.Provider.__ = n.Consumer.contextType = n
                            }(), r.state = {
                                status: Lt.Loading,
                                header: e.header,
                                data: null
                            }, r
                        }
                        r(e, t);
                        var i = e.prototype;
                        return i.processPipeline = function () {
                            try {
                                var t = this;
                                t.props.config.eventEmitter.emit("beforeLoad"), t.setState({
                                    status: Lt.Loading
                                });
                                var e = function (e, n) {
                                    try {
                                        var r = Promise.resolve(t.props.pipeline.process()).then(function (e) {
                                            t.setState({
                                                data: e,
                                                status: Lt.Loaded
                                            }), t.props.config.eventEmitter.emit("load", e)
                                        })
                                    } catch (t) {
                                        return n(t)
                                    }
                                    return r && r.then ? r.then(void 0, n) : r
                                }(0, function (e) {
                                    pt.error(e), t.setState({
                                        status: Lt.Error,
                                        data: null
                                    })
                                });
                                return Promise.resolve(e && e.then ? e.then(function () {}) : void 0)
                            } catch (t) {
                                return Promise.reject(t)
                            }
                        }, i.componentDidMount = function () {
                            try {
                                var t = this,
                                    e = t.props.config;
                                return Promise.resolve(t.processPipeline()).then(function () {
                                    e.header && t.state.data && t.state.data.length && t.setState({
                                        header: e.header.adjustWidth(e)
                                    }), t.processPipelineFn = t.processPipeline.bind(t), t.props.pipeline.on("updated", t.processPipelineFn)
                                })
                            } catch (t) {
                                return Promise.reject(t)
                            }
                        }, i.componentWillUnmount = function () {
                            this.props.pipeline.off("updated", this.processPipelineFn)
                        }, i.componentDidUpdate = function (t, e) {
                            e.status != Lt.Rendered && this.state.status == Lt.Loaded && (this.setState({
                                status: Lt.Rendered
                            }), this.props.config.eventEmitter.emit("ready"))
                        }, i.render = function () {
                            return b(this.configContext.Provider, {
                                value: this.props.config
                            }, b("div", {
                                role: "complementary",
                                className: it("gridjs", rt("container"), this.state.status === Lt.Loading ? rt("loading") : null, this.props.config.className.container),
                                style: n({}, this.props.config.style.container, {
                                    width: this.props.width
                                })
                            }, this.state.status === Lt.Loading && b("div", {
                                className: rt("loading-bar")
                            }), b(ie, null), b("div", {
                                className: rt("wrapper"),
                                style: {
                                    height: this.props.height
                                }
                            }, b(re, {
                                ref: this.props.config.tableRef,
                                data: this.state.data,
                                header: this.state.header,
                                width: this.props.width,
                                height: this.props.height,
                                status: this.state.status
                            })), b(oe, null), b("div", {
                                ref: this.props.config.tempRef,
                                id: "gridjs-temp",
                                className: rt("temp")
                            })))
                        }, e
                    }(X),
                    ae = /*#__PURE__*/ function (t) {
                        function e(e) {
                            var n;
                            return (n = t.call(this) || this).config = void 0, n.plugin = void 0, n.config = new jt({
                                instance: o(n),
                                eventEmitter: o(n)
                            }).update(e), n.plugin = n.config.plugin, n
                        }
                        r(e, t);
                        var n = e.prototype;
                        return n.updateConfig = function (t) {
                            return this.config.update(t), this
                        }, n.createElement = function () {
                            return b(se, {
                                config: this.config,
                                pipeline: this.config.pipeline,
                                header: this.config.header,
                                width: this.config.width,
                                height: this.config.height
                            })
                        }, n.forceRender = function () {
                            return this.config && this.config.container || pt.error("Container is empty. Make sure you call render() before forceRender()", !0), this.config.pipeline.clearCache(), B(null, this.config.container), B(this.createElement(), this.config.container), this
                        }, n.render = function (t) {
                            return t || pt.error("Container element cannot be null", !0), t.childNodes.length > 0 ? (pt.error("The container element " + t + " is not empty. Make sure the container is empty and call render() again"), this) : (this.config.container = t, B(this.createElement(), t), this)
                        }, e
                    }(tt),
                    ue = 0,
                    le = [],
                    ce = [],
                    pe = l.__b,
                    he = l.__r,
                    fe = l.diffed,
                    de = l.__c,
                    _e = l.unmount;

                function me(t, e) {
                    l.__h && l.__h(Bt, t, ue || e), ue = 0;
                    var n = Bt.__H || (Bt.__H = {
                        __: [],
                        __h: []
                    });
                    return t >= n.__.length && n.__.push({
                        __V: ce
                    }), n.__[t]
                }

                function ge(t, e) {
                    var n = me(Wt++, 3);
                    !l.__s && Se(n.__H, e) && (n.__ = t, n.i = e, Bt.__H.__h.push(n))
                }

                function ve(t) {
                    return ue = 5,
                        function (t, e) {
                            var n = me(Wt++, 7);
                            return Se(n.__H, e) ? (n.__V = t(), n.i = e, n.__h = t, n.__V) : n.__
                        }(function () {
                            return {
                                current: t
                            }
                        }, [])
                }

                function ye() {
                    for (var t; t = le.shift();)
                        if (t.__P && t.__H) try {
                            t.__H.__h.forEach(we), t.__H.__h.forEach(ke), t.__H.__h = []
                        } catch (e) {
                            t.__H.__h = [], l.__e(e, t.__v)
                        }
                }
                l.__b = function (t) {
                    Bt = null, pe && pe(t)
                }, l.__r = function (t) {
                    he && he(t), Wt = 0;
                    var e = (Bt = t.__c).__H;
                    e && (zt === Bt ? (e.__h = [], Bt.__h = [], e.__.forEach(function (t) {
                        t.__N && (t.__ = t.__N), t.__V = ce, t.__N = t.i = void 0
                    })) : (e.__h.forEach(we), e.__h.forEach(ke), e.__h = [])), zt = Bt
                }, l.diffed = function (t) {
                    fe && fe(t);
                    var e = t.__c;
                    e && e.__H && (e.__H.__h.length && (1 !== le.push(e) && qt === l.requestAnimationFrame || ((qt = l.requestAnimationFrame) || function (t) {
                        var e, n = function () {
                                clearTimeout(r), be && cancelAnimationFrame(e), setTimeout(t)
                            },
                            r = setTimeout(n, 100);
                        be && (e = requestAnimationFrame(n))
                    })(ye)), e.__H.__.forEach(function (t) {
                        t.i && (t.__H = t.i), t.__V !== ce && (t.__ = t.__V), t.i = void 0, t.__V = ce
                    })), zt = Bt = null
                }, l.__c = function (t, e) {
                    e.some(function (t) {
                        try {
                            t.__h.forEach(we), t.__h = t.__h.filter(function (t) {
                                return !t.__ || ke(t)
                            })
                        } catch (n) {
                            e.some(function (t) {
                                t.__h && (t.__h = [])
                            }), e = [], l.__e(n, t.__v)
                        }
                    }), de && de(t, e)
                }, l.unmount = function (t) {
                    _e && _e(t);
                    var e, n = t.__c;
                    n && n.__H && (n.__H.__.forEach(function (t) {
                        try {
                            we(t)
                        } catch (t) {
                            e = t
                        }
                    }), e && l.__e(e, n.__v))
                };
                var be = "function" == typeof requestAnimationFrame;

                function we(t) {
                    var e = Bt,
                        n = t.__c;
                    "function" == typeof n && (t.__c = void 0, n()), Bt = e
                }

                function ke(t) {
                    var e = Bt;
                    t.__c = t.__(), Bt = e
                }

                function Se(t, e) {
                    return !t || t.length !== e.length || e.some(function (e, n) {
                        return e !== t[n]
                    })
                }
                //# sourceMappingURL=gridjs.module.js.map


                /***/
            })

        /******/
    });
    /************************************************************************/
    /******/ // The module cache
    /******/
    var __webpack_module_cache__ = {};
    /******/
    /******/ // The require function
    /******/
    function __webpack_require__(moduleId) {
        /******/ // Check if module is in cache
        /******/
        var cachedModule = __webpack_module_cache__[moduleId];
        /******/
        if (cachedModule !== undefined) {
            /******/
            return cachedModule.exports;
            /******/
        }
        /******/ // Create a new module (and put it into the cache)
        /******/
        var module = __webpack_module_cache__[moduleId] = {
            /******/ // no module.id needed
            /******/ // no module.loaded needed
            /******/
            exports: {}
            /******/
        };
        /******/
        /******/ // Execute the module function
        /******/
        __webpack_modules__[moduleId](module, module.exports, __webpack_require__);
        /******/
        /******/ // Return the exports of the module
        /******/
        return module.exports;
        /******/
    }
    /******/
    /************************************************************************/
    /******/
    /* webpack/runtime/define property getters */
    /******/
    (() => {
        /******/ // define getter functions for harmony exports
        /******/
        __webpack_require__.d = (exports, definition) => {
            /******/
            for (var key in definition) {
                /******/
                if (__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
                    /******/
                    Object.defineProperty(exports, key, {
                        enumerable: true,
                        get: definition[key]
                    });
                    /******/
                }
                /******/
            }
            /******/
        };
        /******/
    })();
    /******/
    /******/
    /* webpack/runtime/hasOwnProperty shorthand */
    /******/
    (() => {
        /******/
        __webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
        /******/
    })();
    /******/
    /******/
    /* webpack/runtime/make namespace object */
    /******/
    (() => {
        /******/ // define __esModule on exports
        /******/
        __webpack_require__.r = (exports) => {
            /******/
            if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
                /******/
                Object.defineProperty(exports, Symbol.toStringTag, {
                    value: 'Module'
                });
                /******/
            }
            /******/
            Object.defineProperty(exports, '__esModule', {
                value: true
            });
            /******/
        };
        /******/
    })();
    /******/
    /************************************************************************/
    var __webpack_exports__ = {};
    // This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
    (() => {
        /*!*******************************************************!*\
          !*** ./resources/dist/panel/js/pages/table-gridjs.js ***!
          \*******************************************************/
        __webpack_require__.r(__webpack_exports__);
        /* harmony import */
        var gridjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__( /*! gridjs */ "./node_modules/gridjs/dist/gridjs.module.js");

        function _typeof(o) {
            "@babel/helpers - typeof";
            return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) {
                return typeof o;
            } : function (o) {
                return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o;
            }, _typeof(o);
        }

        function _classCallCheck(instance, Constructor) {
            if (!(instance instanceof Constructor)) {
                throw new TypeError("Cannot call a class as a function");
            }
        }

        function _defineProperties(target, props) {
            for (var i = 0; i < props.length; i++) {
                var descriptor = props[i];
                descriptor.enumerable = descriptor.enumerable || false;
                descriptor.configurable = true;
                if ("value" in descriptor) descriptor.writable = true;
                Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor);
            }
        }

        function _createClass(Constructor, protoProps, staticProps) {
            if (protoProps) _defineProperties(Constructor.prototype, protoProps);
            if (staticProps) _defineProperties(Constructor, staticProps);
            Object.defineProperty(Constructor, "prototype", {
                writable: false
            });
            return Constructor;
        }

        function _toPropertyKey(arg) {
            var key = _toPrimitive(arg, "string");
            return _typeof(key) === "symbol" ? key : String(key);
        }

        function _toPrimitive(input, hint) {
            if (_typeof(input) !== "object" || input === null) return input;
            var prim = input[Symbol.toPrimitive];
            if (prim !== undefined) {
                var res = prim.call(input, hint || "default");
                if (_typeof(res) !== "object") return res;
                throw new TypeError("@@toPrimitive must return a primitive value.");
            }
            return (hint === "string" ? String : Number)(input);
        }
        /*
        Template Name: Konrix - Responsive 5 Admin Dashboard
        Author: SOC Software House
        Website: https://SOC Software House.com/
        Contact: support@SOC Software House.com
        File: datatable js
        */


        window.gridjs = gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid;
        var GridDatatable = /*#__PURE__*/ function () {
            function GridDatatable() {
                _classCallCheck(this, GridDatatable);
            }
            _createClass(GridDatatable, [{
                key: "init",
                value: function init() {
                    this.basicTableInit();
                }
            }, {
                key: "basicTableInit",
                value: function basicTableInit() {
                    // Basic Table
                    if (document.getElementById("table-gridjs")) new gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid({
                        columns: [{
                            name: 'ID',
                            formatter: function formatter(cell) {
                                return (0, gridjs__WEBPACK_IMPORTED_MODULE_0__.html)('<span class="fw-semibold">' + cell + '</span>');
                            }
                        }, "Name", {
                            name: 'Email',
                            formatter: function formatter(cell) {
                                return (0, gridjs__WEBPACK_IMPORTED_MODULE_0__.html)('<a href="">' + cell + '</a>');
                            }
                        }, "Position", "Company", "Country", {
                            name: 'Actions',
                            width: '120px',
                            formatter: function formatter(cell) {
                                return (0, gridjs__WEBPACK_IMPORTED_MODULE_0__.html)("<a href='#' class='text-reset text-decoration-underline'>" + "Details" + "</a>");
                            }
                        }],
                        pagination: {
                            limit: 5
                        },
                        sort: true,
                        search: true,
                        data: [
                            ["01", "Jonathan", "jonathan@example.com", "Senior Implementation Architect", "Hauck Inc", "Holy See"],
                            ["02", "Harold", "harold@example.com", "Forward Creative Coordinator", "Metz Inc", "Iran"],
                            ["03", "Shannon", "shannon@example.com", "Legacy Functionality Associate", "Zemlak Group", "South Georgia"],
                            ["04", "Robert", "robert@example.com", "Product Accounts Technician", "Hoeger", "San Marino"],
                            ["05", "Noel", "noel@example.com", "Customer Data Director", "Howell - Rippin", "Germany"],
                            ["06", "Traci", "traci@example.com", "Corporate Identity Director", "Koelpin - Goldner", "Vanuatu"],
                            ["07", "Kerry", "kerry@example.com", "Lead Applications Associate", "Feeney, Langworth and Tremblay", "Niger"],
                            ["08", "Patsy", "patsy@example.com", "Dynamic Assurance Director", "Streich Group", "Niue"],
                            ["09", "Cathy", "cathy@example.com", "Customer Data Director", "Ebert, Schamberger and Johnston", "Mexico"],
                            ["10", "Tyrone", "tyrone@example.com", "Senior Response Liaison", "Raynor, Rolfson and Daugherty", "Qatar"]
                        ]
                    }).render(document.getElementById("table-gridjs"));

                    // card Table
                    if (document.getElementById("table-card")) new gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid({
                        columns: ["Name", "Email", "Position", "Company", "Country"],
                        sort: true,
                        pagination: {
                            limit: 5
                        },
                        data: [
                            ["Jonathan", "jonathan@example.com", "Senior Implementation Architect", "Hauck Inc", "Holy See"],
                            ["Harold", "harold@example.com", "Forward Creative Coordinator", "Metz Inc", "Iran"],
                            ["Shannon", "shannon@example.com", "Legacy Functionality Associate", "Zemlak Group", "South Georgia"],
                            ["Robert", "robert@example.com", "Product Accounts Technician", "Hoeger", "San Marino"],
                            ["Noel", "noel@example.com", "Customer Data Director", "Howell - Rippin", "Germany"],
                            ["Traci", "traci@example.com", "Corporate Identity Director", "Koelpin - Goldner", "Vanuatu"],
                            ["Kerry", "kerry@example.com", "Lead Applications Associate", "Feeney, Langworth and Tremblay", "Niger"],
                            ["Patsy", "patsy@example.com", "Dynamic Assurance Director", "Streich Group", "Niue"],
                            ["Cathy", "cathy@example.com", "Customer Data Director", "Ebert, Schamberger and Johnston", "Mexico"],
                            ["Tyrone", "tyrone@example.com", "Senior Response Liaison", "Raynor, Rolfson and Daugherty", "Qatar"]
                        ]
                    }).render(document.getElementById("table-card"));

                    // pagination Table
                    if (document.getElementById("table-pagination")) new gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid({
                        columns: [{
                            name: 'ID',
                            width: '120px',
                            formatter: function formatter(cell) {
                                return (0, gridjs__WEBPACK_IMPORTED_MODULE_0__.html)('<a href="" class="fw-medium">' + cell + '</a>');
                            }
                        }, "Name", "Date", "Total", "Status", {
                            name: 'Actions',
                            width: '100px',
                            formatter: function formatter(cell) {
                                return (0, gridjs__WEBPACK_IMPORTED_MODULE_0__.html)("<button type='button' class='btn btn-sm btn-light'>" + "Details" + "</button>");
                            }
                        }],
                        pagination: {
                            limit: 5
                        },
                        data: [
                            ["#VL2111", "Jonathan", "07 Oct, 2021", "$24.05", "Paid"],
                            ["#VL2110", "Harold", "07 Oct, 2021", "$26.15", "Paid"],
                            ["#VL2109", "Shannon", "06 Oct, 2021", "$21.25", "Refund"],
                            ["#VL2108", "Robert", "05 Oct, 2021", "$25.03", "Paid"],
                            ["#VL2107", "Noel", "05 Oct, 2021", "$22.61", "Paid"],
                            ["#VL2106", "Traci", "04 Oct, 2021", "$24.05", "Paid"],
                            ["#VL2105", "Kerry", "04 Oct, 2021", "$26.15", "Paid"],
                            ["#VL2104", "Patsy", "04 Oct, 2021", "$21.25", "Refund"],
                            ["#VL2103", "Cathy", "03 Oct, 2021", "$22.61", "Paid"],
                            ["#VL2102", "Tyrone", "03 Oct, 2021", "$25.03", "Paid"]
                        ]
                    }).render(document.getElementById("table-pagination"));

                    // search Table
                    if (document.getElementById("table-search")) new gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid({
                        columns: ["Name", "Email", "Position", "Company", "Country"],
                        pagination: {
                            limit: 5
                        },
                        search: true,
                        data: [
                            ["Jonathan", "jonathan@example.com", "Senior Implementation Architect", "Hauck Inc", "Holy See"],
                            ["Harold", "harold@example.com", "Forward Creative Coordinator", "Metz Inc", "Iran"],
                            ["Shannon", "shannon@example.com", "Legacy Functionality Associate", "Zemlak Group", "South Georgia"],
                            ["Robert", "robert@example.com", "Product Accounts Technician", "Hoeger", "San Marino"],
                            ["Noel", "noel@example.com", "Customer Data Director", "Howell - Rippin", "Germany"],
                            ["Traci", "traci@example.com", "Corporate Identity Director", "Koelpin - Goldner", "Vanuatu"],
                            ["Kerry", "kerry@example.com", "Lead Applications Associate", "Feeney, Langworth and Tremblay", "Niger"],
                            ["Patsy", "patsy@example.com", "Dynamic Assurance Director", "Streich Group", "Niue"],
                            ["Cathy", "cathy@example.com", "Customer Data Director", "Ebert, Schamberger and Johnston", "Mexico"],
                            ["Tyrone", "tyrone@example.com", "Senior Response Liaison", "Raynor, Rolfson and Daugherty", "Qatar"]
                        ]
                    }).render(document.getElementById("table-search"));

                    // Sorting Table
                    if (document.getElementById("table-sorting")) new gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid({
                        columns: ["Name", "Email", "Position", "Company", "Country"],
                        pagination: {
                            limit: 5
                        },
                        sort: true,
                        data: [
                            ["Jonathan", "jonathan@example.com", "Senior Implementation Architect", "Hauck Inc", "Holy See"],
                            ["Harold", "harold@example.com", "Forward Creative Coordinator", "Metz Inc", "Iran"],
                            ["Shannon", "shannon@example.com", "Legacy Functionality Associate", "Zemlak Group", "South Georgia"],
                            ["Robert", "robert@example.com", "Product Accounts Technician", "Hoeger", "San Marino"],
                            ["Noel", "noel@example.com", "Customer Data Director", "Howell - Rippin", "Germany"],
                            ["Traci", "traci@example.com", "Corporate Identity Director", "Koelpin - Goldner", "Vanuatu"],
                            ["Kerry", "kerry@example.com", "Lead Applications Associate", "Feeney, Langworth and Tremblay", "Niger"],
                            ["Patsy", "patsy@example.com", "Dynamic Assurance Director", "Streich Group", "Niue"],
                            ["Cathy", "cathy@example.com", "Customer Data Director", "Ebert, Schamberger and Johnston", "Mexico"],
                            ["Tyrone", "tyrone@example.com", "Senior Response Liaison", "Raynor, Rolfson and Daugherty", "Qatar"]
                        ]
                    }).render(document.getElementById("table-sorting"));

                    // Loading State Table
                    if (document.getElementById("table-loading-state")) new gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid({
                        columns: ["Name", "Email", "Position", "Company", "Country"],
                        pagination: {
                            limit: 5
                        },
                        sort: true,
                        data: function data() {
                            return new Promise(function (resolve) {
                                setTimeout(function () {
                                    resolve([
                                        ["Jonathan", "jonathan@example.com", "Senior Implementation Architect", "Hauck Inc", "Holy See"],
                                        ["Harold", "harold@example.com", "Forward Creative Coordinator", "Metz Inc", "Iran"],
                                        ["Shannon", "shannon@example.com", "Legacy Functionality Associate", "Zemlak Group", "South Georgia"],
                                        ["Robert", "robert@example.com", "Product Accounts Technician", "Hoeger", "San Marino"],
                                        ["Noel", "noel@example.com", "Customer Data Director", "Howell - Rippin", "Germany"],
                                        ["Traci", "traci@example.com", "Corporate Identity Director", "Koelpin - Goldner", "Vanuatu"],
                                        ["Kerry", "kerry@example.com", "Lead Applications Associate", "Feeney, Langworth and Tremblay", "Niger"],
                                        ["Patsy", "patsy@example.com", "Dynamic Assurance Director", "Streich Group", "Niue"],
                                        ["Cathy", "cathy@example.com", "Customer Data Director", "Ebert, Schamberger and Johnston", "Mexico"],
                                        ["Tyrone", "tyrone@example.com", "Senior Response Liaison", "Raynor, Rolfson and Daugherty", "Qatar"]
                                    ]);
                                }, 2000);
                            });
                        }
                    }).render(document.getElementById("table-loading-state"));

                    // Fixed Header
                    if (document.getElementById("table-fixed-header")) new gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid({
                        columns: ["Name", "Email", "Position", "Company", "Country"],
                        sort: true,
                        pagination: true,
                        fixedHeader: true,
                        height: '400px',
                        data: [
                            ["Jonathan", "jonathan@example.com", "Senior Implementation Architect", "Hauck Inc", "Holy See"],
                            ["Harold", "harold@example.com", "Forward Creative Coordinator", "Metz Inc", "Iran"],
                            ["Shannon", "shannon@example.com", "Legacy Functionality Associate", "Zemlak Group", "South Georgia"],
                            ["Robert", "robert@example.com", "Product Accounts Technician", "Hoeger", "San Marino"],
                            ["Noel", "noel@example.com", "Customer Data Director", "Howell - Rippin", "Germany"],
                            ["Traci", "traci@example.com", "Corporate Identity Director", "Koelpin - Goldner", "Vanuatu"],
                            ["Kerry", "kerry@example.com", "Lead Applications Associate", "Feeney, Langworth and Tremblay", "Niger"],
                            ["Patsy", "patsy@example.com", "Dynamic Assurance Director", "Streich Group", "Niue"],
                            ["Cathy", "cathy@example.com", "Customer Data Director", "Ebert, Schamberger and Johnston", "Mexico"],
                            ["Tyrone", "tyrone@example.com", "Senior Response Liaison", "Raynor, Rolfson and Daugherty", "Qatar"]
                        ]
                    }).render(document.getElementById("table-fixed-header"));

                    // Hidden Columns
                    if (document.getElementById("table-hidden-column")) new gridjs__WEBPACK_IMPORTED_MODULE_0__.Grid({
                        columns: ["Name", "Email", "Position", "Company", {
                            name: 'Country',
                            hidden: true
                        }],
                        pagination: {
                            limit: 5
                        },
                        sort: true,
                        data: [
                            ["Jonathan", "jonathan@example.com", "Senior Implementation Architect", "Hauck Inc", "Holy See"],
                            ["Harold", "harold@example.com", "Forward Creative Coordinator", "Metz Inc", "Iran"],
                            ["Shannon", "shannon@example.com", "Legacy Functionality Associate", "Zemlak Group", "South Georgia"],
                            ["Robert", "robert@example.com", "Product Accounts Technician", "Hoeger", "San Marino"],
                            ["Noel", "noel@example.com", "Customer Data Director", "Howell - Rippin", "Germany"],
                            ["Traci", "traci@example.com", "Corporate Identity Director", "Koelpin - Goldner", "Vanuatu"],
                            ["Kerry", "kerry@example.com", "Lead Applications Associate", "Feeney, Langworth and Tremblay", "Niger"],
                            ["Patsy", "patsy@example.com", "Dynamic Assurance Director", "Streich Group", "Niue"],
                            ["Cathy", "cathy@example.com", "Customer Data Director", "Ebert, Schamberger and Johnston", "Mexico"],
                            ["Tyrone", "tyrone@example.com", "Senior Response Liaison", "Raynor, Rolfson and Daugherty", "Qatar"]
                        ]
                    }).render(document.getElementById("table-hidden-column"));
                }
            }]);
            return GridDatatable;
        }();
        document.addEventListener('DOMContentLoaded', function (e) {
            new GridDatatable().init();
        });
    })();

    /******/
})();
