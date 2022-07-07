$('button[name=sepeteEkle]').click(function(){
  var urunId = $(this).attr('urunId');
  var urunAdet = $('input[name=urunAdet'+urunId+']').val();

  $.ajax({
    url: 'post.php',
    type: 'post',
    data: {'urunId':urunId , 'urunAdet': urunAdet},
    success: function(resp){
      alert("Sepete Eklendi");
      $('#urunler').append(resp);
    }
  });
});