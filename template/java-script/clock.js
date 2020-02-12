document.addEventListener('DOMContentLoaded', function(){
    let clock = document.getElementById('clock');
    
    setInterval(function(){
        let date = new Date();
        clock.innerHTML = date.toLocaleTimeString()+" -- "+date.toLocaleDateString();
    }, 1000);
});


