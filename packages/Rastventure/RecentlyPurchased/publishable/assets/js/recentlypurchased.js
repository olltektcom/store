var SalesBoosterAlert;
! function(a) {
    "use strict";
    var b, c;
    SalesBoosterAlert = {
        init: function() {
            b = {
                mouseover: !1,
                document_mouseleave: !1,
                in_process: !1,
                products: JSON.parse(a("#sales-booster-popup-products").text()),
                i: 0
            }, a(".recently-purchase").length && (c = {
                wrapper: a(".recently-purchase"),
                repeat_every: a(".recently-purchase").data("repeat-time")
            }, this.renderContentPopup(), this.closePopup())
        },
        renderProduct: function() {
            var d = a.makeArray(b.products[b.i]),
            e = d.map(function(a) {
                return '<img src="'+d[0].image+'" alt="'+d[0].title+'"><div class="media-body"><div><div class="title">Someone recently purchase this item</div><a href="'+d[0].url+'"><span class="product-name">'+d[0].title+'</span></a><small class="timeAgo">'+d[0].time_ago+' minutes ago from '+d[0].location+'</small></div></div>'
            }).join("");
            c.wrapper.html(e), a(".recently-purchase").toggleClass("show"), setTimeout(function() {
                b.mouseover || a(".recently-purchase").toggleClass("show")
            }, c.repeat_every / 2 * 1e3), b.products.length > b.i + 1 ? b.i++ : b.i = 0

        },
        renderContentPopup: function() {
            setInterval(SalesBoosterAlert.renderProduct, 1e3 * c.repeat_every); 
        },
        closePopup: function() {
            c.wrapper.on("click", ".close", function() {
                c.wrapper.toggleClass("show"), setTimeout(function() {
                    c.wrapper.remove()
                }, c.repeat_every / 2 * 1e3)
            })
        },
    }, a(document).ready(function() {
        SalesBoosterAlert.init()
        a('a.close-popup').on('click', function () {
            a(".recently-purchase").toggleClass("show")
        });
    })
}(jQuery);


