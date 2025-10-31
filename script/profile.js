document.addEventListener("DOMContentLoaded", () => {
  const editButtons = document.querySelectorAll(".edit");
  const uploadBtn = document.getElementById("uploadBtn");
  const photoInput = document.getElementById("photoInput");
  const profilePhoto = document.getElementById("profilePhoto");
  const toast = document.getElementById("toast");
  const navAvatar = document.getElementById("navAvatar");

  editButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const input = btn.previousElementSibling;
      if (input.hasAttribute("readonly")) {
        input.removeAttribute("readonly");
        input.focus();
        btn.textContent = "Save";
        input.style.backgroundColor = "#fff";
      } else {
        if (input.value.trim() === "") {
          showToast("Field tidak boleh kosong!");
          input.focus();
          return;
        }
        input.setAttribute("readonly", true);
        btn.textContent = "Edit";
        input.style.backgroundColor = "#fafafa";
        showToast("Perubahan disimpan!");
      }
    });
  });

  uploadBtn.addEventListener("click", () => {
    photoInput.click();
  });

  photoInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (event) => {
      profilePhoto.src = event.target.result;
      navAvatar.src = event.target.result;
      showToast("Foto profil berhasil diubah!");
      profilePhoto.style.opacity = "0";
      setTimeout(() => {
        profilePhoto.style.opacity = "1";
      }, 200);
    };
    reader.readAsDataURL(file);
  });

  function showToast(message) {
    toast.textContent = message;
    toast.style.display = "block";
    toast.style.opacity = "1";
    setTimeout(() => {
      toast.style.opacity = "0";
      setTimeout(() => (toast.style.display = "none"), 400);
    }, 2000);
  }
});
