$(function() {
    //Chat entry point panel slide down
    //$("#panel").hide();
    $("#login").toggle(
        function(){
            $("#panel").slideDown();
        },
        function(){
            $("#panel").slideUp();
        }
     )
});