$(document).ready(function(){
	let error = null;
    if(error !== null)
        $(".errMsg").show().text(error);
	let success = null;
    if(success !== null)
        $(".sucMsg").text(success).show();
	if($(".errMsg").innerHTML != "")
		$(".errMsg").show();
	$(".reg").mouseup(function(){
		if($(".user-box").eq(2).css('display') == "none")
		{
	    	$("form").attr("action",);
		    setTimeout('$("h2").fadeToggle(500);', 500);
	        setTimeout('$("h2").html("&nbsp;").fadeIn(700);', 1000);
		    setTimeout('$("h2").text("Register");',1300);
	    	$(".reg").css({'letter-spacing': '1px', 'whiteSpace': 'nowrap'}).html("<span></span><span></span><span></span><span></span>Back to Login");
		    $(".user-box").eq(2).slideDown(1000);
		} else
		{
		    $("form").attr("action","auth/auth.php");
			setTimeout('$("h2").fadeToggle(500);', 500);
		    setTimeout('$("h2").html("&nbsp;").fadeIn(700);', 1000);
		    setTimeout('$("h2").text("Login");',1300);
		    $(".reg").css({'letter-spacing': '4px', 'whiteSpace': 'nowrap'}).html("<span></span><span></span><span></span><span></span>Register");
		    $(".user-box").eq(2).slideUp(1000);
		
		$(".login-box .user-box h5").eq(1).slideDown(400);
		}
	})
})