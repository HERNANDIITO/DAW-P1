function closeSessionButton() {    
    document.getElementById("logOut").addEventListener("click",  function(params) {
        window.location.href = "/";
    }); 
}