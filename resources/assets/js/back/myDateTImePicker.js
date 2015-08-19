/**
 * Created by Xavier on 4/8/15.
 */

$(function(){

    console.log('myDateTimePicker.js initialized');

    /**
     * Get the datetimepicker input
     * @type {*|jQuery|HTMLElement}
     */
    var dateTimeEntries = $(".datetimepicker");

    /**
     * if there is not datetime input
     * skip all the following
     */
    if(dateTimeEntries.length > 0){

        /**
         * Setting options for datetime picker
         * @type {{format: string, defaultDate: *}}
         */
        var options = {};

        /**
         * Instantiate datetime picker object with default options
         */
        $.each(dateTimeEntries, function(index, val){
            var entry = $(val);
            var myOption = options;
            myOption['format'] = entry.attr('data-format');
            entry.datetimepicker(myOption);
        });

        /**
         * If there are 2 datetime inputs
         * check these 2 inputs have start/end relationship
         */
        if(dateTimeEntries.length == 2){
            var inputNames;

            /**
             * Get the name of these 2 inputs
             * @returns {Array}
             */
            var fetchInputName = function(){
                var names = [];
                $.each(dateTimeEntries, function(index, val){
                    var entry = $(val);
                    names.push(entry.find("input").attr('name'));
                });
                return names;
            };

            /**
             * check the inputs' name
             * verify there are start/end relationship
             *
             * @param names
             * @constructor
             */
            var VerifyStartEndRelationship = function(names){
                var namesArray = [];
                for(var i = 0; i< names.length; i++){
                    namesArray.push(names[i].split(/_/));
                }

                /**
                 * if inputs has the relationship
                 * the input will have start/end constrains
                 */
                if(namesArray[0][0] === namesArray[1][0] && namesArray[0][2] === namesArray[1][2] && namesArray[0][1] ==="start" && namesArray[1][1]==="end")
                {
                    $(dateTimeEntries[0]).on("dp.change", function (e) {
                        $(dateTimeEntries[1]).data("DateTimePicker").minDate(e.date);
                    });
                    $(dateTimeEntries[1]).on("dp.change", function (e) {
                        $(dateTimeEntries[0]).data("DateTimePicker").maxDate(e.date);
                    });
                }
            };

            inputNames = fetchInputName();
            VerifyStartEndRelationship(inputNames);
        }
    }
});
