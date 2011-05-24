$(function() {
    //Chat entry point panel slide down
    $("#panel, #feedback_hover").hide();
    $("#login").toggle(
        function(){
            $("#panel").slideDown('');
        },
        function(){
            $("#panel").slideUp('');
        }
     )
});