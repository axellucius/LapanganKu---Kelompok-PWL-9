
const photoUpload = document.getElementById("photoUpload");
const profilePhoto = document.getElementById("profilePhoto");
const profileMini = document.getElementById("profileMini");

photoUpload.addEventListener("change", e => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = event => {
      profilePhoto.src = event.target.result;
      profileMini.src = event.target.result;
      alert("Foto profil berhasil diubah ✅");
    };
    reader.readAsDataURL(file);
  }
});

document.querySelectorAll(".edit").forEach(editBtn => {
  editBtn.addEventListener("click", () => {
    const wrapper = editBtn.parentElement;
    const input = wrapper.querySelector("input, textarea");

    if (input.hasAttribute("readonly")) {
      input.removeAttribute("readonly");
      input.focus();
      editBtn.textContent = "Save";
      input.style.border = "1px solid #2d7a5f";
    } else {
      if (input.value.trim() === "") {
        alert("Kolom tidak boleh kosong!");
        input.focus();
        return;
      }

      input.setAttribute("readonly", true);
      input.style.border = "1px solid #ccc";
      editBtn.textContent = "Edit";

      if (input.id === "name") {
        document.getElementById("displayName").textContent = input.value;
      }

      alert("Data berhasil disimpan ✅");
    }
  });
});

document.querySelectorAll(".menu .item").forEach(item => {
  item.addEventListener("mouseover", () => item.classList.add("hovered"));
  item.addEventListener("mouseout", () => item.classList.remove("hovered"));
});
