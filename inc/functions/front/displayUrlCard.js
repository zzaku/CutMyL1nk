let old = $('.card').get(0);
let old2 = $('.info-container').get(0);
$('.card').click(function(){
  if(old!=null && $(old).hasClass('open'))
    $(old).toggleClass('open');
   $(this).toggleClass('open');
   old = this;
   if(old2!=null && $(old2).hasClass('undisplayed'))
     $(old2).toggleClass('undisplayed');
    $(this).toggleClass('undisplayed');
    old2 = this;
})