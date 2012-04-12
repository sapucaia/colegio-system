/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




$(function(){
    
    atribuir("pagina1.html")
    navegar()
})


atribuir =  function(pagina){

    $("#conteudoEsquerda").load(pagina)   
}

navegar = function(){
    $("#navegaInferior a").click(function(){
        
        atribuir($(this).attr("href"))
        return false;

    })
    
    $("#navegaSuperior a").click(function(){
        
        atribuir($(this).attr("href"))
        return false;

    })
    
    
    
}

