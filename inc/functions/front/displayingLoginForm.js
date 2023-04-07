let accountBtn = document.getElementById("btn-account");
let loginBtn = document.getElementById("btn-login");
let registerBtn = document.getElementById("btn-register");
let inputLoginForm = document.getElementById("login-form");
let inputRegisterForm = document.getElementById("register-form");
let account = document.getElementById("account-container");
let moduleTitleLogin = document.getElementById("title-login");
let moduleTitleRegister = document.getElementById("title-register");

function handleAccount(){
  if(getComputedStyle(account).display != "none"){
    account.style.display = "none";
  } else {
    account.style.display = "block";
  }
};

function handleLogin(){
  if(getComputedStyle(inputLoginForm).display === "none"){
    inputLoginForm.style.display = "block";
    inputRegisterForm.style.display = "none";
    loginBtn.style.border = "#16a085 2px solid";
    moduleTitleLogin.style.color = "#16a085";
    registerBtn.style.border = "#ecf0f1 2px solid";
    moduleTitleRegister.style.color = "#ecf0f1";
  }
};

function handleRegister(){
  if(getComputedStyle(inputRegisterForm).display === "none"){
    inputRegisterForm.style.display = "block";
    inputLoginForm.style.display = "none";
    registerBtn.style.border = "#16a085 2px solid";
    moduleTitleRegister.style.color = "#16a085";
    loginBtn.style.border = "#ecf0f1 2px solid";
    moduleTitleLogin.style.color = "#ecf0f1";
  }
};

accountBtn.onclick = handleAccount;
loginBtn.onclick = handleLogin;
registerBtn.onclick = handleRegister;