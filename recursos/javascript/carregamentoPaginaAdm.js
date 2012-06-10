/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




$(function(){
    
//    atribuir("home.html")
    navegar()
})


atribuir =  function(pagina){

    $("#corpo").load(pagina)   
}

navegar = function(){
    $("#btAdministra a").click(function(){
        
        atribuir($(this).attr("href"))
        return false;

    })
    
//    $("#navegaSuperior a").click(function(){
//        
//        atribuir($(this).attr("href"))
//        return false;
//
//    })
//    
    
    
}

