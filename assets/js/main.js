document.getElementById("btn_signUp").addEventListener("click", registerTransition)
document.getElementById("btn_signIn").addEventListener("click", logInTransition)

/* Variables declaration */
let main_signUp_box = document.querySelector(".main_signUp_box")
let logIn_form = document.querySelector(".logIn_form")
let registration_form = document.querySelector(".registration_form")
let background_box_login = document.querySelector(".background_box_login")
let registration_box = document.querySelector(".registration_box")

function logInTransition(){
    registration_form.style.display = "none";
    main_signUp_box.style.left = "10px";
    logIn_form.style.display = "block";
    registration_box.style.opacity = "1";
    background_box_login.style.opacity = "0"; 
}

function registerTransition(){
    registration_form.style.display = "block";
    main_signUp_box.style.left = "410px";
    logIn_form.style.display = "none";
    registration_box.style.opacity = "0";
    background_box_login.style.opacity = "1"; 
}