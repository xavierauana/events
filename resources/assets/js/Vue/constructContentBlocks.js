module.exports = function(data){
    this.blocks =[];
    console.log("fired");
    var theClass = "right";
    for(var i = 1; i <= parseInt(this.numberOfDays); i++)
    {
        if((i-1)%3 == 0)
        {
            // toggle class
            if(theClass == "left"){
                theClass = "right"
            }else{
                theClass= "left"
            }
        }

        // fetch the correct eventsObject to the coresponding date object
        for(var y = 0 ; y <data.length; y++){
            var events = "";
            if(data[y].date == i){
                var events = data[y].events;
                break;
            }
        }

        this.blocks.push({
            class: theClass,
            events: events
        })
    }
}