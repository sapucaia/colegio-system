/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var colorMouseEnterFonteContainer = "#bbc1cb"
var colorMouseOutFonteContainer = "#FFF"
var colorBackgroundEnterContainer = "#c43f3f"
var colorBackgroundOutContainer = "#2652d6"
var bordaOn = "1px solid #fff"
var bordaOff = ""

$(document).ready(function(){
    $("#barraLinkSuperior a").mouseenter(function(){
        $(this).stop().animate({
            "background-color": colorBackgroundEnterContainer,
            "color": colorMouseEnterFonteContainer,
//            "border-top": bordaOn,
            "border-bottom": bordaOn
        },600)
        
//        $("#nav ul a").css({
//            "border-top": bordaOff,
//            "border-bottom": bordaOff
//        })
    })
    
    $("#barraLinkSuperior a").mouseout(function(){
        $(this).stop().animate({
            "background-color": colorBackgroundOutContainer,
            "color":colorMouseOutFonteContainer,
//            "border-top": bordaOff,
            "border-bottom": bordaOff
        },200)
    })
    
    
    
    
    $("#barraLinkInferior a").mouseenter(function(){
        $(this).stop().animate({
            "background-color": colorBackgroundEnterContainer,
            "color": colorMouseEnterFonteContainer
        },600)
    })
    
    $("#barraLinkInferior a").mouseout(function(){
        $(this).stop().animate({
            "background-color": colorBackgroundOutContainer,
            "color": colorMouseOutFonteContainer
        },200)
    })
})


//$(function(){
//    
//    $("#barraLinkSuperior a").mousedown(function(){
//        var elemento  = document.getElementById(this).click();
//        elemento.className = 'selected'
//    })
//
//})

    
    
