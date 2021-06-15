const form = document.querySelector(".myform form"),
uploadBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-success-text");


form.onsubmit = (e)=>{
    e.preventDefault(); //prevents form from submitting
}

uploadBtn.onclick = ()=>{
    //starting Ajax
    let xhr = new XMLHttpRequest(); //creating an XML object
    xhr.open("POST", "filesLogic.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                if (data == "Success") {
                    // errorText.classList.add("success");
                    // errorText.textContent = data;
                    // errorText.style.display = "block";
                    console.log(data);
                }else{
                    // errorText.classList.remove("success");
                    // errorText.textContent = data;
                    // errorText.style.display = "block";
                    console.log(data);
                }
            }
        }
    }

    // we have to send the form data through ajax to php
    let formData = new FormData(form); //Creating new formData object
    xhr.send(formData); //sending the form data to php
}