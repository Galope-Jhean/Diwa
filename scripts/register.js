const form = document.querySelector('form');

form.addEventListener('submit', function (event) {

    const username = form.querySelector('input[name="username"]').value;
    const password = form.querySelector('input[name="password"]').value;
    const confirmPassword = form.querySelector('input[name="confirm_password"]').value;

    if(username === '' || password === '' || confirmPassword === ''){
        event.preventDefault();
        alert("Please fill in all required fields.");
    } else {
        if (password !== confirmPassword) {
            event.preventDefault();
            alert('Passwords do not match. Please re-enter the passwords.');
        }
    }
});