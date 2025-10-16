function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showError(message) {
    const existingError = document.querySelector('.error-message');
    if (existingError) existingError.remove();
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.cssText = 'background-color:#fee;color:#c33;padding:12px;border-radius:8px;margin:15px 0;border:1px solid #fcc;font-size:14px;';
    errorDiv.textContent = message;
    const form = document.querySelector('form');
    form.parentNode.insertBefore(errorDiv, form);
    setTimeout(() => errorDiv.remove(), 5000);
}

function showSuccess(message) {
    const existingSuccess = document.querySelector('.success-message');
    if (existingSuccess) existingSuccess.remove();
    const successDiv = document.createElement('div');
    successDiv.className = 'success-message';
    successDiv.style.cssText = 'background-color:#efe;color:#2d6f3d;padding:12px;border-radius:8px;margin:15px 0;border:1px solid #9c9;font-size:14px;';
    successDiv.textContent = message;
    const form = document.querySelector('form');
    form.parentNode.insertBefore(successDiv, form);
}

function handleForgotPassword(event) {
    event.preventDefault();
    const emailInput = document.querySelector('input[type="email"]');
    const email = emailInput.value.trim();
    if (!email) {
        showError('Please enter your email address');
        return;
    }
    if (!isValidEmail(email)) {
        showError('Please enter a valid email address');
        return;
    }
    showSuccess('Password reset link has been sent to your email. Please check your inbox.');
    emailInput.value = '';
    setTimeout(() => {
        window.location.href = 'sign-in.php';
    }, 5000);
}

function handleResetPassword(event) {
    event.preventDefault();
    const newPassword = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="confirm-password"]').value;
    if (!newPassword || !confirmPassword) {
        showError('Please fill in all fields');
        return;
    }
    if (newPassword.length < 6) {
        showError('Password must be at least 6 characters');
        return;
    }
    if (newPassword !== confirmPassword) {
        showError('Passwords do not match');
        return;
    }
    showSuccess('Password reset successful! Redirecting to sign in...');
    setTimeout(() => {
        window.location.href = 'sign-in.php';
    }, 2000);
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        const urlParams = new URLSearchParams(window.location.search);
        const hasToken = urlParams.has('token');
        if (hasToken) {
            form.addEventListener('submit', handleResetPassword);
        } else {
            form.addEventListener('submit', handleForgotPassword);
        }
    }
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach((input, index) => {
        const toggleBtn = document.createElement('span');
        toggleBtn.className = 'toggle-password';
        toggleBtn.style.cssText = 'cursor:pointer;position:absolute;right:10px;top:50%;';
        toggleBtn.innerHTML = '<img src="Foto/Password.png" style="width:20px;">';
        toggleBtn.addEventListener('click', function() {
            if (input.type === 'password') {
                input.type = 'text';
                this.innerHTML = '<img src="Foto/Password-visible.png" style="width:20px;">';
            } else {
                input.type = 'password';
                this.innerHTML = '<img src="Foto/Password.png" style="width:20px;">';
            }
        });
        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('toggle-password')) {
            input.parentNode.style.position = 'relative';
            input.parentNode.appendChild(toggleBtn);
        }
    });
});
