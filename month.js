(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

new Vue({
    el: "#vue",
    data: {
        // momentObject is instance of momentjs for the current month
        momentObject: moment(),
        windowSize: "",
        // blocks contains all events in the month
        blocks: [],
        // currentMonth is the String of current month
        currentMonth: ""
    },
    computed: {
        numberOfDays: function numberOfDays() {
            return this.momentObject.endOf("month").format("D");
        }
    },
    methods: {
        constructContentBlocks: require("./Vue/constructContentBlocks"),
        // call api and fetch db for events
        getEvents: require("./Vue/getEvents"),
        // change the momentjs object and refresh the content blocks
        changeMonth: function changeMonth(increment) {
            this.momentObject.add(parseInt(increment), "M");
            this.currentMonth = this.momentObject.format("MMMM");
            this.getEvents();
        }
    },
    ready: function ready() {
        this.currentMonth = this.momentObject.format("MMMM");
        if (window.innerWidth > 1200) this.windowSize = "lg";
        if (this.windowSize == "lg") {}
        this.getEvents();
    }
});

},{"./Vue/constructContentBlocks":2,"./Vue/getEvents":3}],2:[function(require,module,exports){
"use strict";

module.exports = function () {
    this.blocks = [];
    console.log("fired");
    var theClass = "right";
    for (var i = 1; i <= parseInt(this.numberOfDays); i++) {
        if ((i - 1) % 3 == 0) {
            // toggle class
            if (theClass == "left") {
                theClass = "right";
            } else {
                theClass = "left";
            }
        }
        this.blocks.push({
            "class": theClass,
            description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet asperiores atque cupiditate esse pariatur qui rem repudiandae temporibus voluptates. Accusantium asperiores hic laboriosam neque quaerat, quasi sit voluptas voluptate?"
        });
    }
};

},{}],3:[function(require,module,exports){
'use strict';

module.exports = function () {
    var resource = this.$resource('/api/getEvent/:date/:token');
    resource.get({ date: this.momentObject, token: $('meta[name="csrf-token"]').attr('content') }, function (response, status, request) {
        if (response.response == true) {
            this.constructContentBlocks();
        } else {
            console.log(response.error);
        }
    });
};

},{}]},{},[1]);
