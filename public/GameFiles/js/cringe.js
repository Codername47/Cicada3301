$(function (){
    $(".form").on("submit", function (e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/cringe",
            data: { key: $('.enter').val(), content: 1 },
        }).done(function(obj) {
            console.log(obj)
            setTimeout(function (){$.getScript(obj.url);}, obj.timeout)
        })
    })
})