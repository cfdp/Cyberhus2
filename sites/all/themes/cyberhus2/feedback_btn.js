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

     //Room nav dropdown
     $("#room_nav li").hover(
        function () {
            //show its submenu
            $('ul', this).slideDown(200);
    },
        function () {
            //hide its submenu
            $('ul', this).slideUp(200);
            }
    );

    //Feedback button
    $("#feedback_btn").hover(
        function(){
            //on mouse over
            $("#feedback_hover").fadeIn(200);
        },
        function(){
            //on mouse out
            $("#feedback_hover").fadeOut('fast');
        }
    );
});