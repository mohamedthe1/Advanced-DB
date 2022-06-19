$(function(){

	$(".form-control").focus(function(){
		$(this).css("border","1px solid #FE980F");
		$(this).attr("text",$(this).attr("placeholder"));
		$(this).attr($(this).attr("placeholder",""));	
	}).blur(function(){
		$(this).css("border","1px solid #999");
		$(this).attr($(this).attr("placeholder",$(this).attr("text")));
	});

	$(".confirm").click(function (e) {
        var confirm = window.confirm('Are you sure to delete this ? :(');
        if(!confirm)
        {
            e.preventDefault();
        }
	});
	$(".medicine").mouseenter(function(){
		$(".opitionsMed").slideDown();
	}).mouseleave(function(){
		$(".opitionsMed").slideUp(200);
	});

	$(".category").mouseenter(function(){
		$(".opitionsCat").slideDown();
	}).mouseleave(function(){
		$(".opitionsCat").slideUp(200);
	});

	$(".member").mouseenter(function(){
		$(".opitionsMemb").slideDown();
	}).mouseleave(function(){
		$(".opitionsMemb").slideUp(200);
	});
	

})
