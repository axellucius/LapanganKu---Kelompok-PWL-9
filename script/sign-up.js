async function handleSignUp(event) {
    event.preventDefault();

    const name = document.querySelector('input[name="name"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();
    const password = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="confirm-password"]').value;
    const acceptedTerms = document.querySelector('input[type="checkbox"]').checked;

    if (!name || !email || !password) {
        showError('Please fill in all required fields');
        return;
    }
    if (!isValidEmail(email)) {
        showError('Please enter a valid email');
        return;
    }
    if (password !== confirmPassword) {
        showError('Passwords do not match');
        return;
    }
    if (!acceptedTerms) {
        showError('Please accept the terms and conditions');
        return;
    }

    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('confirm-password', confirmPassword);

    try {
        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.text();
        console.log(result);

        if (result.includes('Pendaftaran berhasil')) {
            showSuccess('Account created successfully! Redirecting...');
            setTimeout(() => window.location.href = 'sign-in.php', 2000);
        } else if (result.includes('Password tidak sama')) {
            showError('Passwords do not match');
        } else {
            showError('Failed to create account. Please try again.');
        }
    } catch (error) {
        console.error(error);
        showError('Error connecting to server');
    }
}
