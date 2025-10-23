async function handleSignIn(event) {
    event.preventDefault();

    const email = document.querySelector('input[name="email"]').value.trim();
    const password = document.querySelector('input[name="password"]').value.trim();

    if (!email || !password) {
        alert("Harap isi email dan password!");
        return false;
    }

    try {
        const formData = new FormData();
        formData.append("email", email);
        formData.append("password", password);

        const response = await fetch(window.location.href, {
            method: "POST",
            body: formData,
        });

        const text = await response.text();
        document.open();
        document.write(text);
        document.close();
    } catch (error) {
        alert("Gagal terhubung ke server!");
        console.error(error);
    }

    return false;
}
