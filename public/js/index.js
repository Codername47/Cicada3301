$(document).ready(function(){
	if($(".errMsg").innerHTML != "")
		$(".errMsg").show();

	if($("body").attr("data-failed") == true)
	{
		$(".reg").show();
		$(".aut").hide();
	} else {
		$(".reg").hide();
		$(".aut").show();
	}

	$(".toReg").on("click", function (e){
		e.preventDefault();
		$(".reg").show();
		$(".aut").hide();
	})
	$(".toAuto").on("click", function (e){
		e.preventDefault();
		$(".aut").show();
		$(".reg").hide();
	})
	if($("input[name='username']").val() == "")
	{
		$("input[name='username']").removeAttr("value");
	}

})