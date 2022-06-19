$(function(){

	$(".form-control").focus(function(){
		$(this).css("border","1px solid #FE980F");
		$(this).attr("text",$(this).attr("placeholder"));
		$(this).attr($(this).attr("placeholder",""));	
	}).blur(function(){
		$(this).css("border","1px solid #999");
		$(this).attr($(this).attr("placeholder",$(this).attr("text")));
	});

	$(".confirm").click(function(){
		alert("Are you sure ?!");
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
	$(".phone-num").change(function(){
		x = ["1", "2", "3", "4", "5", "6", "7", "8", "9"];
		if($(this).val() !==""){
			console.log($(this).val());
		}
		
	});
	

})
