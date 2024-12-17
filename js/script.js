// Toggle between Login and Register forms
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const showRegister = document.getElementById("show-register");
    const showLogin = document.getElementById("show-login");

    // Show Register form
    showRegister.addEventListener("click", (event) => {
        event.preventDefault();
        loginForm.classList.add("hidden");
        registerForm.classList.remove("hidden");
    });

    // Show Login form
    showLogin.addEventListener("click", (event) => {
        event.preventDefault();
        registerForm.classList.add("hidden");
        loginForm.classList.remove("hidden");
    });
});
