




$('.follow').click(function(){
  //  alert($(this).data('id'))

  var url='';
  if($(this).data('status')==='1')

       url='/alaa/products/follow/'+$(this).data('id')+'/'+1
        else
           url='/alaa/products/follow/'+$(this).data('id')+'/'+0





        d=$(this);
    if($(this).data('status')==='1')
    {
        d.empty();

        if($("#local").val()==='ar')
        d.append(`عدم متابعه`)
        else
        d.append(`unfollow`)


        $(this).data('status','0')


    }



  else
    {

        d.empty();

        if($("#local").val()==='ar')
    d.append(`<i class="fa fa-heart"></i> متابعه السعر `)
    else

        d.append(`<i class="fa fa-heart"></i> Follow Price`)
        $(this).data('status','follow')
    }






    $.ajax({
    type:'get',
    url:url,

     success:function(data){

     }



});
});












$('.follow-profile').click(function(){
    //  alert($(this).data('id'))

        url='products/follow/'+$(this).data('id')+'/'+0


    var d=$(this);

    $.ajax({
        type:'get',
        url:url,

        success:function(data){
            d.parent().parent().remove()
            if( $('.on-delivery .con-img-text').length === 0 ) {
                $('.on-delivery').append(
                    `<p>no products here</p>`
                );
            }
        }



    });
});





// $('.follow').click(function() {
//     $(this).text('ahmed');
// })



