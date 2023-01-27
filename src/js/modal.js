
$('#modal-open').on('click', function() {
    $('#modal-container').addClass('active'); 
    $('#modal-bg').addClass('active'); 
  });

  $('#modal-close').on('click', function() {
    $('#modal-container').removeClass('active'); 
    $('#modal-bg').removeClass('active'); 
  });


  $('#modal-bg').on('click', function() {
    $('#modal-container').removeClass('active'); 
    $('#modal-bg').removeClass('active'); 
  });{

    
    // icon.addEventListener('click',()=>{
    //     menu.classList.add('active');
    //     modalBg.classList.add('active');
    // });



    $('.logout').on('click', function() {
        alert("ログアウトしますか!!");
      });

}