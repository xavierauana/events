new Vue({
    el: "#vue",
    data: {
        // momentObject is instance of momentjs for the current month
        momentObject: moment(),
        windowSize:"",
        // blocks contains all events in the month
        blocks: [

        ],
        // currentMonth is the String of current month
        currentMonth :""
    },
    computed:{
        numberOfDays: function(){
            return this.momentObject.endOf('month').format("D");
        }
    },
    methods:{
        constructContentBlocks: require("./Vue/constructContentBlocks"),
        // call api and fetch db for events
        getEvents: require("./Vue/getEvents"),
        // change the momentjs object and refresh the content blocks
        changeMonth: function(increment){
            this.momentObject.add(parseInt(increment), "M");
            this.currentMonth = this.momentObject.format("MMMM");
            this.getEvents();
        }
    },
    ready:function(){
        this.currentMonth = this.momentObject.format("MMMM");
        if(window.innerWidth > 1200)  this.windowSize = "lg";
        if(this.windowSize == 'lg'){
        }

        this.getEvents();
    }
});