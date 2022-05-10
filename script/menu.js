$("[data-trigger]").on("click", function(){
    var trigger_id =  $(this).attr('data-trigger');
    $(trigger_id).toggleClass("show");
});

// close button 
$(".btn-close").click(function(e){
    $(".navbar-collapse").removeClass("show");
}); 