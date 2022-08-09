$('.jak').attr('src', 'GameFiles/img/jak3.png');
clearInterval(counter);
$('.string').text('');
$('.enter').attr('disabled', false);
$('.secretButton').remove();
$('.timer').text('');
$('form').off();
$('form').submit(function(e){
    e.preventDefault();
    $.ajax({
                type: "POST",
                url: "/busido",
                data: { answer: $('.enter').val() },
                }).done(function(obj) {
                    console.log(obj)
                    setTimeout(function (){$.getScript(obj.url);}, obj.timeout)
                })
})


