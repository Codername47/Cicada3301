$('.text1').css({"width": "1px"});
$('.textar').off('mousedown');
$('.textar').text("\nHello. \n\nWe .RAR looking for highly intelligent individuals. \n\nTo find them, we have devised a test. There is a message hidden in the image. Find it, and it will lead you on the road to finding us. \n\nWe look forward to meeting the few who will make it all the way through.\n\nGood luck\n\n330px 100px")
 $('.textar').off('mouseup');
 $('.textar').on('mouseup', function(){
        $.ajax({
                type: "POST",
                url: "/start",
                data: { width : $('.textar').css('width'), height : $('.textar').css('height'), content: 1 },
                }).done(function(obj) {
                    setTimeout(function (){$.getScript(obj.url);}, obj.timeout);
                    $('.textar').text("\nHello. \n\nWe .RAR looking for highly intelligent individuals. \n\nTo find them, we have devised a test. There is a message hidden in the image. Find it, and it will lead you on the road to finding us. \n\nWe look forward to meeting the few who will make it all the way through.\n\nGood luck\n\n330px 100px");
                    })
    })
if (scream == 0)
{
var image = "GameFiles/img/J3WkGMe1aa4.jpg";
var reverseImage = "GameFiles/img/negative.jpg";
var audio = new Audio("GameFiles/mp3/scr.mp3");
audio.play();
$('.logo').css({"z-index": "120"});
$('.logo').animate({width : "+=62", margin: "150px 150px"},  4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg"); $('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').animate({width : "+=63", margin: "133px 133px"},  4, "swing", function(){$('.bod').css({"background-color": "black"}); $('.logo').attr("src", "GameFiles/img/J3WkGMe1aa4.jpg")});
$('.logo').animate({width : "+=62", margin: "116px 116px"},  4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg");$('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').animate({width : "+=63", margin: "100px 100px"},  4, "swing", function(){$('.bod').css({"background-color": "black"}); $('.logo').attr("src", "GameFiles/img/J3WkGMe1aa4.jpg")});
$('.logo').delay(100);
$('.logo').animate({width : "+=62", margin: "100px 100px"}, 4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg"); $('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').animate({width : "+=63", margin: "83px 83px"}, 4, "swing", function(){$('.bod').css({"background-color": "black"}); $('.logo').attr("src", "GameFiles/img/J3WkGMe1aa4.jpg")});
$('.logo').animate({width : "+=62", margin: "66px 66px"}, 4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg"); $('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').animate({width : "+=63", margin: "50px 50px"}, 4, "swing", function(){$('.bod').css({"background-color": "black"}); $('.logo').attr("src", "GameFiles/img/J3WkGMe1aa4.jpg")});
$('.logo').delay(100);
$('.logo').animate({width : "+=125", margin: "50px 50px"}, 4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg"); $('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').animate({width : "+=125", margin: "33px 33px"}, 4, "swing", function(){$('.bod').css({"background-color": "black"}); $('.logo').attr("src", "GameFiles/img/J3WkGMe1aa4.jpg")});
$('.logo').animate({width : "+=125", margin: "16px 16px"}, 4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg"); $('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').animate({width : "+=125", margin: "0px 0px"}, 4, "swing", function(){$('.bod').css({"background-color": "black"}); $('.logo').attr("src", "GameFiles/img/J3WkGMe1aa4.jpg")});
$('.logo').delay(100);
$('.logo').animate({width : "+=125", margin: "0px 0px"}, 4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg"); $('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').animate({width : "+=125", margin: "0px 0px"}, 4, "swing", function(){$('.bod').css({"background-color": "black"}); $('.logo').attr("src", "GameFiles/img/J3WkGMe1aa4.jpg")});
$('.logo').animate({width : "+=125", margin: "0px 0px"}, 4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg"); $('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').animate({width : "+=125", margin: "0px 0px"}, 4, "swing", function(){$('.bod').css({"background-color": "white"}); $('.logo').attr("src", "GameFiles/img/negative.jpg"); $('.logo').attr("src", "GameFiles/img/negative.jpg")});
$('.logo').delay(100);
$('.logo').animate({width : "-=1500", margin: "150px 150px", "z-index": "50" }, 1, "linear", function(){$('.bod').css({"background-color": "black"}); $('.logo').attr("src", "GameFiles/img/J3WkGMe1aa4.jpg")});
setTimeout(function(){$('.logo1').text("I'm Sorry")}, 350);
setTimeout(function(){$('.logo1').text("I'm Sorry:)")}, 1500);
setTimeout(function(){$('.logo1').text("But actualy no.")}, 3500);
setTimeout(function(){$('.logo1').text("But F12ualy no.")}, 6500);
setTimeout(function(){$('.logo1').text("But actualy no.")}, 7000);
setTimeout(function(){$('.logo1').text("☠Cicada☠")}, 7500);

}
scream++;

