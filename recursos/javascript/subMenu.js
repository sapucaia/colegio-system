/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {	
	
    $('#nav li').hover(
        function () {
            //show its submenu
            $('ul', this).slideDown(500);

        }, 
        function () {
            //hide its submenu
            $('ul', this).stop(true, true).slideUp(400);			
        }
        );
	
});
       
       
       
