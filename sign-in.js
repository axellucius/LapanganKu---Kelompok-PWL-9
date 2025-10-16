function togglePassword() {
    const passwordInput = document.querySelector('input[type="password"], input[type="text"][placeholder="••••••"]');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.src = 'Foto/Password-visible.png';
    } else {
        passwordInput.type = 'password';
        eyeIcon.src = 'Foto/Password.png';
    }
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showError(message) {
    const existingError = document.querySelector('.error-message');
    if (existingError) existingError.remove();
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.style.cssText = 'background-color:#fee;color:#c33;padding:10px;border-radius:5px;margin:10px 0;border:1px solid #fcc;';
    errorDiv.textContent = message;
    const form = document.querySelector('form');
    form.parentNode.insertBefore(errorDiv, form);
    setTimeout(() => errorDiv.remove(), 5000);
}

function showSuccess(message) {
    const successDiv = document.createElement('div');
    successDiv.className = 'success-message';
    successDiv.style.cssText = 'background-color:#efe;color:#3a3;padding:10px;border-radius:5px;margin:10px 0;border:1px solid #cfc;';
    successDiv.textContent = message;
    const form = document.querySelector('form');
    form.parentNode.insertBefore(successDiv, form);
    setTimeout(() => successDiv.remove(), 3000);
}

async function handleSignIn(event) {
    event.preventDefault();
    
    const email = document.querySelector('input[type="email"]').value.trim();
    const password = document.querySelector('input[type="password"], input[type="text"][placeholder="••••••"]').value;
    const rememberMe = document.querySelector('input[type="checkbox"]').checked;

    if (!email || !password) {
        showError('Please fill in all fields');
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

    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Signing in...';
    submitBtn.disabled = true;

    setTimeout(() => {
        showSuccess('Login successful! Redirecting...');
        
        if (rememberMe) {
            localStorage.setItem('authToken', 'dummyToken123');
            localStorage.setItem('userEmail', email);
        } else {
            sessionStorage.setItem('authToken', 'dummyToken123');
            sessionStorage.setItem('userEmail', email);
        }

        setTimeout(() => {
            window.location.href = 'homepage.php';
        }, 1500);

        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    }, 1000);
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) form.addEventListener('submit', handleSignIn);

    const rememberedEmail = localStorage.getItem('userEmail');
    if (rememberedEmail) {
        document.querySelector('input[type="email"]').value = rememberedEmail;
    }
});
