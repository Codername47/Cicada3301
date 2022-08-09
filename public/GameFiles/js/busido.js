var initial = 30000;
var count = initial;
var counter; //10 will  run it every 100th of a second
var initialMillis;

function timer() {
    if (count <= 0) {
        $('.enterText').text('Ответ?');
        $('.timer').text("Время вышло!");
        clearInterval(counter);
        $('.jak').attr('src', 'GameFiles/img/jak2.jpg')
        $('.string').text('');
        $('.form').empty();
        $('.secretButton').remove();
        return;
    }
    var current = Date.now();

    count = count - (current - initialMillis);
    initialMillis = current;
    displayCount(count);
}
function displayCount(count) {
    var res = count / 1000;
    $('.timer').text(res.toPrecision(count.toString().length) + " secs");
}
$(document).ready(function(){
    clearInterval(counter);
    initialMillis = Date.now();
    counter = setInterval(timer, 1);
    $('.form').submit(function(e){
        e.preventDefault();
    })
    
    $('.form').on('mouseenter', function(){
        
        if (count > 3000)
        {
        $('body').append('<input type="image" class="secretButton" src="button.png">')
        $('.secretButton').on('click', function(){
            $.ajax({
                type: "POST",
                url: "/busido",
                data: { content: 1},
                }).done(function(obj) {
                    console.log(obj)
                    setTimeout(function (){$.getScript(obj.url);}, obj.timeout)
                })
    })
        count = 7000;
        $('.timer').css({'color':'red'});
        }
    })
})