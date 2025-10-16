function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function checkPasswordStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[^a-zA-Z0-9]+/)) strength++;
    return strength;
}

function togglePassword(inputElement) {
    const passwordInput = inputElement || document.querySelector('input[type="password"], input[type="text"][placeholder*="•"]');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordInput) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            if (eyeIcon) eyeIcon.src = 'Foto/Password-visible.png';
        } else {
            passwordInput.type = 'password';
            if (eyeIcon) eyeIcon.src = 'Foto/Password.png';
        }
    }
}

function showError(message) {
    const existingError = document.querySelector('.error-message');
    if (existingError) existingError.remove();
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.cssText = 'background-color: #fee; color: #c33; padding: 12px; border-radius: 8px; margin: 15px 0; border: 1px solid #fcc; font-size: 14px;';
    errorDiv.textContent = message;
    const form = document.querySelector('form');
    form.parentNode.insertBefore(errorDiv, form);
    setTimeout(() => errorDiv.remove(), 4000);
}

function showSuccess(message) {
    const existingSuccess = document.querySelector('.success-message');
    if (existingSuccess) existingSuccess.remove();
    const successDiv = document.createElement('div');
    successDiv.className = 'success-message';
    successDiv.style.cssText = 'background-color: #efe; color: #2d6f3d; padding: 12px; border-radius: 8px; margin: 15px 0; border: 1px solid #9c9; font-size: 14px;';
    successDiv.textContent = message;
    const form = document.querySelector('form');
    form.parentNode.insertBefore(successDiv, form);
    setTimeout(() => successDiv.remove(), 4000);
}

async function handleSignUp(event) {
    event.preventDefault();
    const nameInput = document.querySelector('input[name="name"], input[placeholder*="Name"], input[placeholder*="Nama"]');
    const emailInput = document.querySelector('input[type="email"]');
    const passwordInput = document.querySelector('input[type="password"][name="password"], input[type="password"]:first-of-type');
    const confirmPasswordInput = document.querySelector('input[type="password"][name="confirm-password"], input[type="password"]:last-of-type');
    const termsCheckbox = document.querySelector('input[type="checkbox"]');
    const name = nameInput ? nameInput.value.trim() : '';
    const email = emailInput ? emailInput.value.trim() : '';
    const password = passwordInput ? passwordInput.value : '';
    const confirmPassword = confirmPasswordInput ? confirmPasswordInput.value : '';
    const acceptedTerms = termsCheckbox ? termsCheckbox.checked : true;

    if (!name || !email || !password) {
        showError('Please fill in all required fields');
        return;
    }
    if (name.length < 2) {
        showError('Name must be at least 2 characters');
        return;
    }
    if (!isValidEmail(email)) {
        showError('Please enter a valid email address');
        return;
    }
    if (password.length < 6) {
        showError('Password must be at least 6 characters');
        return;
    }
    if (confirmPasswordInput && password !== confirmPassword) {
        showError('Passwords do not match');
        return;
    }
    if (!acceptedTerms) {
        showError('Please accept the terms and conditions');
        return;
    }

    const strength = checkPasswordStrength(password);
    if (strength < 2) {
        showError('Password is too weak. Use a mix of letters, numbers, and symbols.');
        return;
    }

    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Creating account...';
    submitBtn.disabled = true;

    setTimeout(() => {
        showSuccess('Account created successfully! Redirecting to sign in...');
        localStorage.setItem('userEmail', email);
        if (nameInput) nameInput.value = '';
        if (emailInput) emailInput.value = '';
        if (passwordInput) passwordInput.value = '';
        if (confirmPasswordInput) confirmPasswordInput.value = '';
        if (termsCheckbox) termsCheckbox.checked = false;
        setTimeout(() => {
            window.location.href = 'sign-in.php';
        }, 2000);
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    }, 1000);
}

function updatePasswordStrength() {
    const passwordInput = document.querySelector('input[type="password"][name="password"], input[type="password"]:first-of-type');
    if (!passwordInput) return;
    const password = passwordInput.value;
    const strength = checkPasswordStrength(password);
    let indicator = document.querySelector('.password-strength-indicator');
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.className = 'password-strength-indicator';
        indicator.style.cssText = 'margin-top: 5px; font-size: 12px;';
        passwordInput.parentNode.appendChild(indicator);
    }
    if (password.length === 0) {
        indicator.textContent = '';
        return;
    }
    const strengthTexts = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
    const strengthColors = ['#c33', '#e74', '#fa0', '#7a7', '#3a3'];
    indicator.textContent = `Password Strength: ${strengthTexts[strength - 1] || 'Very Weak'}`;
    indicator.style.color = strengthColors[strength - 1] || '#c33';
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) form.addEventListener('submit', handleSignUp);
    const passwordInput = document.querySelector('input[type="password"][name="password"], input[type="password"]:first-of-type');
    if (passwordInput) passwordInput.addEventListener('input', updatePasswordStrength);
    const confirmPasswordInput = document.querySelector('input[type="password"][name="confirm-password"], input[type="password"]:last-of-type');
    if (confirmPasswordInput && passwordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            if (this.value && passwordInput.value !== this.value) this.style.borderColor = '#c33';
            else this.style.borderColor = '';
        });
    }
    const token = localStorage.getItem('authToken') || sessionStorage.getItem('authToken');
    if (token) window.location.href = 'homepage.php';
});
