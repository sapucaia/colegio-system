/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    $("#barraLinkSuperior a").mouseenter(function(){
        $(this).stop().animate({
            "background-color": "#f3f5fc",
            "color": "#2652d6"
        },200)
    })
    
    $("#barraLinkSuperior a").mouseout(function(){
        $(this).stop().animate({
            "background-color":"#2652d6",
            "color":"#FFF"
        },200)
    })
    
    
    
    $("#barraLinkInferior a").mouseenter(function(){
        $(this).stop().animate({
            "background-color": "#f3f5fc",
            "color": "#2652d6"
        },200)
    })
    
    $("#barraLinkInferior a").mouseout(function(){
        $(this).stop().animate({
            "background-color":"#2652d6",
            "color":"#FFF"
        },200)
    })
    
    
    
    
    
    
    
    
})