/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function()
{
    $("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} );
}
);


$(document) .ready(function(){
    $(".tablesorter tr") .mouseover(function(){
        $(this) .addClass("over")
    });
    $(".tablesorter tr") .mouseout(function(){
        $(this) .removeClass("over")
    });
    $(".tablesorter tr:even") .addClass("alt");
})