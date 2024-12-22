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

// document.getElementById('ADD_FORM').addEventListener('submit', function (event) {
//     const titleInput = document.getElementById('title');
//     const descriptionInput = document.getElementById('description');
//     const priceInput = document.getElementById('price');
//     const imageInput = document.getElementById('image');

//     // Validate Title: Not empty and alphanumeric
//     if (titleInput.value.trim() === '') {
//         alert('Book title is required.');
//         event.preventDefault();
//         return;
//     }
//     if (!/^[a-zA-Z0-9\s]+$/.test(titleInput.value.trim())) {
//         alert('Book title can only contain letters, numbers, and spaces.');
//         event.preventDefault();
//         return;
//     }

//     // Validate Description: Minimum 10 characters
//     if (descriptionInput.value.trim() === '' ) {
//         alert('Description must contain at least 4 words.');
//         event.preventDefault();
//         return;
//     }

//     // Validate Price: Positive number
//     if (priceInput.value.trim() === '' || isNaN(priceInput.value) || parseFloat(priceInput.value) <= 0) {
//         alert('Please enter a valid price greater than 0.');
//         event.preventDefault();
//         return;
//     }

//     // Validate Image URL: Must be a valid URL if provided
//     if (imageInput.value.trim() !== '' && !isValidURL(imageInput.value.trim())) {
//         alert('Please enter a valid image URL.');
//         event.preventDefault();
//         return;
//     }
// });

// // Helper function to validate URL
// function isValidURL(url) {
//     try {
//         new URL(url);
//         return true;
//     } catch (_) {
//         return false;
//     }
// }

// document.getElementById('ADD_FORM').addEventListener('click' ,  function(event) {
    

     // event.preventDefault();
   
    // event.submit();


// }

// )

document.getElementById('login-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const email = document.getElementById('loginEmail').value.trim();
    const password = document.getElementById('loginPassword').value.trim();

   console.log('test email');
   
   
        const emailPattern = /^[a-zA-Z][a-zA-Z0-9._-]*@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
        res = emailPattern.test(email);

     if (!res) {
        alert('Please enter a valid email address.');
      
        return;
    }
    
    if (password === '') {
        alert('Password cannot be empty.');
     
    }

    this.submit();
   
});





// Validate Register Form
document.getElementById('register-form').addEventListener('submit', function (event) {
  
    event.preventDefault();

    
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email-register').value.trim();
    const password = document.getElementById('password-register').value.trim();
    const confirmPassword = document.getElementById('confirm-password').value.trim();



    if (name === '') {
        alert('Name cannot be empty.');
       
        return;
    }

    if (!isValidEmail(email)) {
        alert('Please enter a valid email address.');
      
        return;
    }

    if (password === '') {
        alert('Password cannot be empty.');
        
        return;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
       
    }
    this.submit();
});

function isValidEmail(email) {
    const emailPattern = /^[a-zA-Z][\w.-]*@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
    return emailPattern.test(email);
}
