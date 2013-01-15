/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    $("#nav > li > a").button()
    $("#nav > li > a").css('border','none')
    $(".subitem").button()
    $( "#datepicker" ).datepicker({
        autoSize: true
    })
    $(".camera_pag").remove()
    $(".camera_wrap").css("margin",0)
    
})
