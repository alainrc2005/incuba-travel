/**
 * Created by aramirez on 4/17/2017.
 */
var App = function () {
    var handleScrollers = function () {
        $('.scroller').each(function () {
            var height;
            if ($(this).attr("data-height")) {
                height = $(this).attr("data-height");
            } else {
                height = $(this).css('height');
            }
            $(this).slimScroll({
                allowPageScroll: true, // allow page scroll when the element scroll is ended
                size: '7px',
                color: ($(this).attr("data-handle-color") ? $(this).attr("data-handle-color") : '#bbb'),
                railColor: ($(this).attr("data-rail-color") ? $(this).attr("data-rail-color") : '#eaeaea'),
                position: 'right',
                height: height,
                alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
                disableFadeOut: true
            });
        });
    };

    return {
        init: function () {
            handleScrollers();
            $("body").prepend('<div id="spinner" style="display: none"><div class="loading"><div class="loading-bar"></div>    <div class="loading-bar"></div>    <div class="loading-bar"></div>    <div class="loading-bar"></div></div></div>');
            ko.validation.rules['mustDateTime'] = {
                validator: function (val, dateFormat) {
                    return ko.validation.utils.isEmptyVal(val) || moment(val, dateFormat, true).isValid();
                },
                message: 'Please enter valid date: {0}'
            };
            ko.validation.registerExtenders();
        },
        SpinnerOn: function () {
            $("#spinner").fadeIn(200);
        },
        SpinnerOff: function () {
            $("#spinner").fadeOut(200);
        },
        modelContact: function () {
            var name = ko.observable().extend({required: true, minLength: 5}),
                email = ko.observable().extend({required: true, email: true}),
                phone = ko.observable(),
                message = ko.observable().extend({required: true, minLength: 5}),
                captcha = ko.observable().extend({required: true, minLength: 6});
            return {
                Name: name,
                Email: email,
                Phone: phone,
                Message: message,
                Captcha: captcha
            }
        },
        ict_Error: function (msg) {
            toastr.error(msg);
        },
        ict_Info: function (msg) {
            toastr.success(msg);
        },
        MSError: "Error in communication process with the server.",
        ACmd: function (options, rjson) {
            App.SpinnerOn();
            $.extend(options, {
                type: "POST",
                dataType: rjson ? "json" : "text",
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8'
            }, options);
            return $.ajax(options).fail(function () {
                App.ict_Error(App.MSError);
            }).always(function () {
                App.SpinnerOff();
            });
        },
        getPSPrice: function (price, adults, infants, children, nights) {
            var vadults = [[0, 1], [1, 1]],
                vchildren = [[0, 0], [0, 1]];
            if ((adults + children === 0) || (infants + children > 2) || (adults === 0 && infants > 0)) {
                return -1;
            }
            var l_adults = vadults[adults][children],
                l_children = vchildren[adults][children];
            return nights ? (((price * l_adults) + (price / 2) * l_children) * nights).toFixed(2) :
                ((price * l_adults) + (price / 2) * l_children).toFixed(2);
        },
        getPDPrice: function (price, adults, infants, children, nights) {
            var vadults = [[0, 1, 2], [1, 2, 2], [2, 2, 2]],
                vchildren = [[0, 0, 0], [0, 0, 1], [0, 1, 2]];
            if ((adults + children < 2) || (infants + children > 2) || (adults === 0 && infants > 0)) {
                return -1;
            }
            var l_adults = vadults[adults][children],
                l_children = vchildren[adults][children];
            return nights ? (((price * l_adults) + (price / 2) * l_children) * nights).toFixed(2) :
                ((price * l_adults) + (price / 2) * l_children).toFixed(2);
        },
        getEPrice: function (adultsprice, childrenprice, adults, children, minpax) {
            if (adults + children < minpax) {
                return -1;
            }
            return (adultsprice * adults + childrenprice * children).toFixed(2);
        },
        initCart: function (vm, removeCart, checkout) {
            window.vmContext = vm;
            window.dCart = removeCart;
            window.cCart = checkout;
        },
        setCart: function (items, length, total, currency, rate) {
            vmContext.kocart = ko.observableArray(items);
            vmContext.kocartlength = ko.observable(length);
            vmContext.kocarttotal = ko.observable(total);
            vmContext.currency = currency;
            vmContext.rate = rate;
        },
        removeCart: function (data) {
            App.ACmd({
                url: dCart,
                data: {Id: data.Id}
            }, "json").done(function (response) {
                vmContext.kocart.remove(function (item) {
                    return item.Id == data.Id;
                });
                vmContext.kocartlength(response.length);
                vmContext.kocarttotal(response.total);
            });
        },
        checkout: function () {
            window.location = window["cCart"];
        },
        cartModel: function () {
            return {
                first_name: ko.observable().extend({required: true}),
                last_name: ko.observable().extend({required: true}),
                email: ko.observable().extend({required: true, email: true}),
                phone: ko.observable().extend({required: true, minLength: 8}),
                captcha: ko.observable().extend({required: true, minLength: 6})
            }
        },
        carModel: function () {
            return {
                CategoryId: ko.observable().extend({required: true}),
                StartDate: ko.observable().extend({required: true, mustDateTime: 'YYYY-MM-DD HH:mm'}),
                EndDate: ko.observable().extend({required: true, mustDateTime: 'YYYY-MM-DD'}),
                Pickin: ko.observable().extend({required: true}),
                Dropoff: ko.observable().extend({required: true}),
                Transmission: ko.observable().extend({required: true}),
                Price: ko.observable(-1).extend({required: true}),
                TotalPrice: ko.observable().extend({required: true})
            }
        },
        diffdays: function (from, to) {
            var m1 = moment(from, 'YYYY-MM-DD'),
                m2 = moment(to, 'YYYY-MM-DD');
            if (m1.isAfter(m2)) {
                var tmp = m1;
                m1 = m2;
                m2 = tmp;
            }
            return m2.diff(m1, "days") + 1;
        },
        Truncate: function (elements, length) {
            var text;
            $.each(elements, function (idx, el) {
                el.innerHTML = el.innerHTML.trim().substring(0, length).split(" ").slice(0, -1).join(" ") + "...";
            });
        },
        validClass: function (model) {
            return (!model.isValid()) ? 'has-error' : '';
        },
        getDates: function (start, end) {
            start = moment(start,"YYYY-MM-DD");
            end = moment(end,"YYYY-MM-DD");
            var dates = [];
            while (start <= end) {
                dates.push(start.format('MM/DD/YYYY'));
                start.add(1, 'd');
            }
            return dates;
        },
        getIntersection: function (dates1, dates2) {
            var count = 0;
            ko.utils.arrayForEach(dates1, function (date1) {
                if (dates2.indexOf(date1) !== -1) {
                    count++;
                }
            });
            return count;
        }
    }
}();

String.prototype.sprintf = function () {
    var args = arguments;
    return this.replace(/{(\d+)}/g, function (match, number) {
        return typeof args[number] != 'undefined'
            ? args[number]
            : match
            ;
    });
};

ko.bindingHandlers.tomoney = {
    init: function (element, valueAccessor, allBindingsAccessor, context) {
        $(element).html((parseFloat(ko.unwrap(valueAccessor())) * allBindingsAccessor().Rate).toFixed(2) + '<span>' + allBindingsAccessor().Currency + '</span>');
    },
    update: function (element, valueAccessor, allBindingsAccessor, context) {
        $(element).html((parseFloat(ko.unwrap(valueAccessor())) * allBindingsAccessor().Rate).toFixed(2) + '<span>' + allBindingsAccessor().Currency + '</span>');
    }
};

ko.bindingHandlers.datepicker = {
    init: function (element, valueAccessor, allBindingsAccessor) {
        var options = allBindingsAccessor().pickerOptions || {},
            $el = $(element);

        //initialize datepicker with some optional options
        $el.datepicker(options);

        //handle the field changing
        ko.utils.registerEventHandler(element, "change", function () {
            var observable = valueAccessor();
            observable($el.datepicker("getFormattedDate"));
        });

        //handle disposal (if KO removes by the template binding)
        ko.utils.domNodeDisposal.addDisposeCallback(element, function () {
            $el.datepicker("destroy");
        });

    },
    update: function (element, valueAccessor) {
        var value = ko.utils.unwrapObservable(valueAccessor()),
            $el = $(element),
            current = $el.datepicker("getDate");

        if (value - current !== 0) {
            $el.datepicker("setDate", value);
        }
    }
};

function pad(number) {
    if (number < 10) {
        return '0' + number;
    }
    return number;
}

Date.prototype.toISOString = function () {
    return this.getFullYear() + "-" + pad(this.getMonth() + 1) + "-" + pad(this.getDate());
};

jQuery(document).ready(function () {
    App.init();
});