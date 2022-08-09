$(window).on('load', function () {
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');
        $spinner.delay(1500).fadeOut('slow', function()
    {
        $('.rick').attr("src","https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1")
    });
    $preloader.delay(2500).fadeOut(1000);
    $.ajax({
        type: "POST",
        url: "/nothing",
        data: { content: 1 },
    }).done(function(obj) {
        console.log(obj)
        setTimeout(function (){$.getScript(obj.url);}, obj.timeout)
    })
});