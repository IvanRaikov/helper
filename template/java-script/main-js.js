$('h3').click(function (){
    $(this).next().find('li').slideToggle();
    });
        
$('.a').click(function(event){
    event.preventDefault();
    var id = $(this).attr('data-id');
    getData(id);
    var edit = $('.edit');
    var deleteArticle = $('.deleteArticle');
    edit.removeAttr('href');
    edit.attr('href','/article/update/'+id);
    deleteArticle.removeAttr('href');
    deleteArticle.attr('href','/article/delete/'+id);
    
});

function getData(id){
    var xhr = new XMLHttpRequest();

    xhr.open('POST','/site/article', true);
    var body ="id="+id;
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(body);

    xhr.onreadystatechange = function(){
    
        if(xhr.status === 200){
            console.log(xhr.responseText);
            writeInContent(xhr.responseText);
        };
    };
};

function writeInContent(text){
    $('.sideMenu li').slideUp();
    var doc = document.getElementById('content');
        doc.innerHTML = text; 
};
