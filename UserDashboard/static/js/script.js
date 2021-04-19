window.onload = function(){
    
    var modalUserId = document.getElementById("user_id");
    var removeButton = document.getElementsByClassName("remove-user");

        
    for (var i = 0; i < removeButton.length; i++) {
        removeButton[i].onclick = function(e){
            modalUserId.value = e.target.dataset.userid;
        }
    }
}