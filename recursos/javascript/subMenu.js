/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    $("#navegaSuperior a").mouseover(function(){
        var menu = $(this).parent().children('.subMenu');
        var submenu =  $(this).parent().parent();
          
        if(menu.length > 0 && menu.is(':hidden')){
            $("#navegaSuperior a").removeClass('ativo');
            $(this).addClass('ativo');
            $('.subMenu').slideUp();    
            menu.slideDown();
        }
        if(!submenu.hasClass('subMenu') && menu.length == 0){
            $("#navegaSuperior a").removeClass('ativo');
            $(this).addClass('ativo');

            $('.subMenu').slideUp();
        }
          
    });
       
    $("#titulo").mouseover(function(){
        $(".subMenu").slideUp();        
    }); 
    $("#bannerSuperior").mouseover(function(){
        $(".subMenu").slideUp();        
    }); 
    $("#barraLinkInferior").mouseover(function(){
        $(".subMenu").slideUp();        
    }); 
    
    $("#conteudo").mouseover(function(){
        $(".subMenu").slideUp();        
    }); 
});
       
       
       
       
