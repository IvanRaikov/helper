$(document).ready(function(){
    $('.searchResultA').click(function(){
        $('.searchResult').css('display', 'none');
         $(this).next('.searchResult').css('display','block');
    });
});


