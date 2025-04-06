<!DOCTYPE html>
<html>

<head>
    <title>WeConnect</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <!-- <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script> -->
    <script>
        /**
         * @name jquery.Thailand.js
         * @version 1.5.3.4
         * @update Feb 27, 2018
         * @website https://github.com/earthchie/jquery.Thailand.js
         * @license WTFPL v.2 - http://www.wtfpl.net/
         *
         * @dependencies: jQuery <https://jquery.com/>
         *              zip.js <https://github.com/gildas-lormeau/zip.js> (optional: for zip database_type only)
         *              typeahead.js <https://twitter.github.io/typeahead.js/>
         *              JQL.js <https://github.com/earthchie/JQL.js>
         **/
        $.Thailand = function(e) {
            "use strict";
            e = $.extend({}, $.Thailand.defaults, e);
            var t = function(e) {
                    var t, a = [],
                        n = [],
                        i = [];
                    return e.lookup && e.words && (a = e.lookup.split("|"), n = e.words.split("|"), e = e.data), t = function(e) {
                        return "number" == typeof e && (e = a[e]), e.replace(/[A-Z]/gi, function(e) {
                            var t = e.charCodeAt(0);
                            return n[t < 97 ? t - 65 : 26 + t - 97]
                        })
                    }, e.map(function(e) {
                        var a = 1;
                        3 === e.length && (a = 2), e[a].map(function(n) {
                            n[a].map(function(o) {
                                o[a] = o[a] instanceof Array ? o[a] : [o[a]], o[a].map(function(r) {
                                    var c = {
                                        district: t(o[0]),
                                        amphoe: t(n[0]),
                                        province: t(e[0]),
                                        zipcode: r
                                    };
                                    2 === a && (c.district_code = o[1] || !1, c.amphoe_code = n[1] || !1, c.province_code = e[1] || !1), i.push(c)
                                })
                            })
                        })
                    }), i
                },
                a = function(e, t, n) {
                    t += "";
                    var i, o, r, c, s = 0,
                        p = 0,
                        d = 0,
                        h = (e += "").length,
                        l = t.length;
                    for (i = 0; i < h; i += 1)
                        for (o = 0; o < l; o += 1) {
                            for (r = 0; i + r < h && o + r < l && e.charAt(i + r) === t.charAt(o + r);) r += 1;
                            r > d && (d = r, s = i, p = o)
                        }
                    return (c = d) && (s && p && (c += a(e.substr(0, p), t.substr(0, p), !1)), s + d < h && p + d < l && (c += a(e.substr(s + d, h - s - d), t.substr(p + d, l - p - d), !1))), !1 === n ? c : e === t ? 100 : h > l ? Math.floor(c / h * 100) : Math.floor(c / l * 100)
                };
            ! function(a) {
                var n, i = e.database_type.toLowerCase();
                switch ("json" !== i && "zip" !== i && (i = e.database.split(".").pop()), i) {
                    case "json":
                        $.getJSON(e.database, function(e) {
                            a(new JQL(t(e)))
                        }).fail(function(t) {
                            throw new Error('File "' + e.database + '" is not exists.')
                        });
                        break;
                    case "zip":
                        e.zip_worker_path || $("script").each(function() {
                            var e = this.src.split("/");
                            "zip.js" === e.pop() && (zip.workerScriptsPath = e.join("/") + "/")
                        }), (n = new XMLHttpRequest).responseType = "blob", n.onreadystatechange = function() {
                            if (4 === n.readyState) {
                                if (200 !== n.status) throw new Error('File "' + e.database + '" is not exists.');
                                zip.createReader(new zip.BlobReader(n.response), function(e) {
                                    e.getEntries(function(e) {
                                        e[0].getData(new zip.BlobWriter, function(e) {
                                            var n = new FileReader;
                                            n.onload = function() {
                                                a(new JQL(t(JSON.parse(n.result))))
                                            }, n.readAsText(e)
                                        })
                                    })
                                })
                            }
                        }, n.open("GET", e.database), n.send();
                        break;
                    default:
                        throw new Error('Unknown database type: "' + e.database_type + '". Please define database_type explicitly (json or zip)')
                }
            }(function(t) {
                $.Thailand.DB = t;
                var n, i, o = {
                    empty: " ",
                    suggestion: function(e) {
                        return e.zipcode && (e.zipcode = " » " + e.zipcode), "<div>" + e.district + " » " + e.amphoe + " » " + e.province + e.zipcode + "</div>"
                    }
                };
                for (n in e) n.indexOf("$") > -1 && "$search" !== n && e.hasOwnProperty(n) && e[n] && e[n].typeahead({
                    hint: !0,
                    highlight: !0,
                    minLength: 1
                }, {
                    limit: e.autocomplete_size,
                    templates: o,
                    source: function(e, a) {
                        var n = [],
                            i = this.$el.data("field");
                        try {
                            n = t.select("*").where(i).match("^" + e).orderBy(i).fetch()
                        } catch (e) {}
                        a(n)
                    },
                    display: function(e) {
                        return e[this.$el.data("field")]
                    }
                }).parent().find(".tt-dataset").data("field", n.replace("$", ""));
                e.$search && e.$search.typeahead({
                    hint: !0,
                    highlight: !0,
                    minLength: 2
                }, {
                    limit: e.autocomplete_size,
                    templates: o,
                    source: function(e, n) {
                        var i = [];
                        try {
                            i = new JQL(i.concat(t.select("*").where("zipcode").match(e).fetch()).concat(t.select("*").where("province").match(e).fetch()).concat(t.select("*").where("amphoe").match(e).fetch()).concat(t.select("*").where("district").match(e).fetch()).map(function(e) {
                                return JSON.stringify(e)
                            }).filter(function(e, t, a) {
                                return a.indexOf(e) == t
                            }).map(function(t) {
                                return t = JSON.parse(t), t.likely = [5 * a(e, t.district), 3 * a(e, t.amphoe.replace(/^เมือง/, "")), a(e, t.province), a(e, t.zipcode)].reduce(function(e, t) {
                                    return Math.max(e, t)
                                }), t
                            })).select("*").orderBy("likely desc").fetch()
                        } catch (e) {}
                        n(i)
                    },
                    display: function(e) {
                        return ""
                    }
                });
                for (n in e) n.indexOf("$") > -1 && e.hasOwnProperty(n) && e[n] && e[n].bind("typeahead:select typeahead:autocomplete", function(t, a) {
                    for (n in e) i = n.replace("$", ""), n.indexOf("$") > -1 && e.hasOwnProperty(n) && e[n] && a[i] && e[n].typeahead("val", a[i]).trigger("change");
                    "function" == typeof e.onDataFill && (delete a.likely, e.onDataFill(a))
                }).blur(function() {
                    this.value || $(this).parent().find(".tt-dataset").html("")
                });
                "function" == typeof e.onLoad && e.onLoad(), "function" == typeof e.onComplete && e.onComplete()
            })
        }, $.Thailand.defaults = {
            database: "https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/database/db.json",
            database_type: "auto",
            zip_worker_path: !1,
            autocomplete_size: 20,
            onLoad: function() {},
            onDataFill: function() {},
            $district: !1,
            $district_code: !1,
            $amphoe: !1,
            $amphoe_code: !1,
            $province: !1,
            $province_code: !1,
            $zipcode: !1,
            $search: !1
        }, $.Thailand.setup = function(e) {
            $.extend($.Thailand.defaults, e)
        };
    </script>

    <style>
        #map {
            height: 500px;
            width: 500px;
            position: relative;
        }

        /* สร้างหมุดที่อยู่ตรงกลางหน้าจอ */
        .center-marker {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 32px;
            height: 32px;
            margin-left: -16px;
            margin-top: -32px;
            background-image: url('https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png');
            background-size: contain;
            background-repeat: no-repeat;
            pointer-events: none;
            z-index: 999;
        }
    </style>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container h2 {
            margin: 20px 0;
        }

        .form-control {
            width: 50%;
            margin-bottom: 20px;
        }

        .txt {
            width: 100%;
            background: #f2f2f2;
            outline: none;
            border: none;
            padding: 10px;
            border-radius: 10px;
            font-size: 1rem;
        }
    </style>
</head>

<body>

    <form action="{{ url('/addproblem') }}" method="post">
        @csrf
        <input id="community_name" name="community_name" type="text" class="txt" placeholder="ชื่อชุมชน">
        <textarea id="detail" name="detail" placeholder="รายละเอียดเพิ่มเติม"></textarea>

        <!-- หน้าแผนที่ -->
        <div id="map">
            <div class="center-marker"></div> <!-- หมุดกลางหน้าจอ -->
        </div>
        <input id="latitude" name="latitude" type="text" class="txt" placeholder="ละติจูด">
        <input id="longitude" name="longitude" type="text" class="txt" placeholder="ลองจิจูด">

        <script>
            var map = L.map('map').setView(["13.283361132009668", "100.92358591147209"], 13); // กรุงเทพฯ
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // ฟังก์ชันอัปเดตพิกัดจากจุดศูนย์กลางของแผนที่
            function updateMarker() {
                var center = map.getCenter();
                var lat = center.lat;
                var lng = center.lng;
                document.getElementById('latitude').value = `${lat}`;
                document.getElementById('longitude').value = `${lng}`;
            }

            // เรียกใช้งานครั้งแรก
            updateMarker();

            // เมื่อผู้ใช้เลื่อนแผนที่
            map.on('moveend', updateMarker);
        </script>

        <!-- THAILAND AUTOCOMPLETE เลือกพื้นที่ -->
        <div class="container">
            <div class="form-control">
                <span>ตำบล/แขวง</span>
                <input id="sub_district" name="sub_district" type="text" class="txt" placeholder="ตำบล">
            </div>
            <div class="form-control">
                <span>อำเภอ/เขต</span>
                <input id="district" name="district" type="text" class="txt" placeholder="อำเภอ">
            </div>
            <div class="form-control">
                <span>จังหวัด</span>
                <input id="province" name="province" type="text" class="txt" placeholder="จังหวัด">
            </div>
            <div class="form-control">
                <span>รหัสไปรษณีย์</span>
                <input id="postcode" name="postcode" type="text" class="txt" placeholder="รหัสไปรษณีย์">
            </div>
        </div>

        <script>
            $.Thailand({
                $district: $("#sub_district"), // input ของตำบล
                $amphoe: $("#district"), // input ของอำเภอ
                $province: $("#province"), // input ของจังหวัด
                $zipcode: $("#postcode") // input ของรหัสไปรษณีย์
            });
        </script>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>