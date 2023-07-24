const form = document.querySelector('form');
form.addEventListener('submit', function (event) {
    const password = form.querySelector('input[name="password"]').value;
    const confirmPassword = form.querySelector('input[name="confirm_password"]').value;

    if (password !== confirmPassword) {
        event.preventDefault();
        alert('Passwords do not match. Please re-enter the passwords.');
    }
});