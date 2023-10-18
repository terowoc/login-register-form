const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");
const password2 = document.getElementById("password2");

togglePassword.addEventListener("click", function () {
  const type = password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);

  const type2 = password2.getAttribute("type") === "password" ? "text" : "password";
  password2.setAttribute("type", type);

  this.classList.toggle('bi-eye');
  this.classList.toggle('bi-eye-slash');
});