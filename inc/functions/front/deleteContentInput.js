let transition = 1000;
document.documentElement.style.setProperty("--transition", transition + "ms");

let form = document.querySelector(".url-input-form-container");
let input = document.querySelector(".url-input");
input.focus();
let bars = document.querySelector(".bars");

bars.addEventListener("click", function () {
  form.classList.toggle("changeShape");

  setTimeout(() => {
    form.classList.toggle("move");
    setTimeout(() => {
      input.value = "";
      input.focus();
      form.classList.toggle("move");
      form.classList.toggle("changeShape");
    }, transition);
  }, 300);
});