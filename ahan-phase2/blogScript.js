let form = document.getElementById('blog-form');
let clearButton = document.getElementById('clear');

let title = document.getElementsByClassName('blog-title')[0];
let body = document.getElementsByClassName('blog-text')[0];

function checkEmpty(e){

    if(title.value == "" || body.value == ""){
        e.preventDefault();
        if(title.value == "" && body.value == ""){
            title.style.border = "solid 2px red";
            body.style.border = "solid 2px red";
        }else if (title.value == "") {
            title.style.border = "solid 2px red";
            body.style.border = "none";
        } else {
            title.style.border = "none";
            body.style.border = "solid 2px red";
        }
    }else{
        title.style.border = "none";
        body.style.border = "none";
    }
}

function resetForm(e){
    e.preventDefault();

    if(confirm("Do you want ot clear your submission?") == true){
        title.style.border = "none";
        body.style.border = "none";
        form.reset();
    }
    
}

form.addEventListener('submit', checkEmpty);
clearButton.addEventListener('click', resetForm);