'use strict';

{

    const open = document.getElementById('modal-open');
    const container = document.getElementById('modal-container');
    const close = document.getElementById('modal-close');
    const modalBg = document.getElementById('modal-bg');

    const icon = document.getElementById('icon');
    const menu = document.getElementById('menu-modal-container');
    
    open.addEventListener('click',()=>{
        container.classList.add('active');
        menu.classList.add('active');
        modalBg.classList.add('active');
    });

    close.addEventListener('click',()=>{
        container.classList.remove('active');
        modalBg.classList.remove('active');
    });

    modalBg.addEventListener('click',()=>{
        container.classList.remove('active');
        menu.classList.remove('active');
        modalBg.classList.remove('active');
        
    });


    
    icon.addEventListener('click',()=>{
        menu.classList.add('active');
        modalBg.classList.add('active');
    });



    $('.logout').on('click', function() {
        alert("ログアウトしますか!!");
      });

}