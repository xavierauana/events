module.exports = function(){
    var resource = this.$resource('/api/getEvent/:date/:token');
    resource.get({date: this.momentObject, token: $('meta[name="csrf-token"]').attr('content')}, function (response, status, request) {
        if(response.response == true){
            this.constructContentBlocks(response.data);
        }else{
            console.log(response.error)
        }
    })
}