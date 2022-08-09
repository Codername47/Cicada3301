var tl=new Array(
"\nHello. ", 
"\nWe .RAR looking for highly intelligent individuals.", 
"\nTo find them, we have devised a test. There is a message hidden in the image. Find it, and it will lead you on the road to finding us.", 
"\nWe look forward to meeting the few who will make it all the way through.", 
"\nGood luck",
"\n3301" 
);
var scream = 0;
var speed=1;
var index=0; text_pos=0;
var str_length=tl[0].length;
var contents, row;
function password()
{
  contents='';
  row=Math.max(0,index-10);
  while(row<index)
    contents += tl[row++] + '\r\n';
  $('textarea').text(contents + tl[index].substring(0,text_pos) + "_");
  if(text_pos++==str_length)
  {
    text_pos=0;
    index++;
    if(index!=tl.length)
    {
      str_length=tl[index].length;
      setTimeout("password()",2000);
    }
  } else
    setTimeout("password()",speed);
}
$(document).ready(function(){
    $('textarea').text(' ');
    password();
    var handl = 0;
    $('.textar').on('mouseup', function(){
        $.ajax({
                type: "POST",
                url: "/start",
                data: { width : $('.textar').css('width'), height : $('.textar').css('height'), content: 1 },
                }).done(function(obj) {
                    console.log(obj)
                    setTimeout(function (){$.getScript(obj.url);}, obj.timeout)

                    })
    })
     $('.textar').on('mousedown', function(){
        handl = 0;
            $.ajax({
                type: "POST",
                url: "/start",
                data: { width : $('.textar').css('width'), height : $('.textar').css('height'), content: 2  },
                }).done(function(obj) {
                    console.log(obj)
                    setTimeout(function (){$.getScript(obj.url);}, obj.timeout)

            })
        })
})