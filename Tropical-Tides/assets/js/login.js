    document.addEventListener('DOMContentLoaded', () => {
    const rememberMeCheckbox = document.getElementById('remember');
    const emailInput = document.querySelector('input[name="email"]');

    if (localStorage.getItem('rememberMe') === 'true') {
        rememberMeCheckbox.checked = true;
        emailInput.value = localStorage.getItem('email');
    }

    document.querySelector('form').addEventListener('submit', () => {
        if (rememberMeCheckbox.checked) {
            localStorage.setItem('rememberMe', 'true');
            localStorage.setItem('email', emailInput.value);
        } else {
            localStorage.removeItem('rememberMe');
            localStorage.removeItem('email');
        }
    });
});
