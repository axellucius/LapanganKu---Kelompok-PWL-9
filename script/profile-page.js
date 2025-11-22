document.addEventListener('DOMContentLoaded', function() {
  const uploadBtn = document.getElementById('uploadBtn');
  const photoInput = document.getElementById('photoInput');
  const profilePhoto = document.getElementById('profilePhoto');
  const navAvatar = document.getElementById('navAvatar');

  uploadBtn.addEventListener('click', function() {
    photoInput.click();
  });

  photoInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    if (!file.type.match('image.*')) {
      showToast('Harap pilih file gambar!', 'error');
      return;
    }

    if (file.size > 5 * 1024 * 1024) {
      showToast('Ukuran file maksimal 5MB!', 'error');
      return;
    }

    const reader = new FileReader();
    reader.onload = function(event) {
      profilePhoto.style.opacity = '0';
      navAvatar.style.opacity = '0';
      
      setTimeout(() => {
        profilePhoto.src = event.target.result;
        navAvatar.src = event.target.result;
        
        profilePhoto.style.opacity = '1';
        navAvatar.style.opacity = '1';
      }, 200);

      showToast('Foto profil berhasil diupdate!', 'success');
    };
    
    reader.readAsDataURL(file);
  });

  const editButtons = document.querySelectorAll('.edit-btn');
  
  editButtons.forEach(button => {
    button.addEventListener('click', function() {
      const wrapper = this.parentElement;
      const input = wrapper.querySelector('.form-input');
      const field = this.dataset.field;

      if (input.hasAttribute('readonly')) {
        input.removeAttribute('readonly');
        input.focus();
        input.style.background = 'white';
        input.style.borderColor = '#2A8A56';
        
        this.textContent = 'Simpan';
        this.style.background = 'linear-gradient(135deg, #fd7e14 0%, #ff8c42 100%)';
        
        if (input.tagName === 'INPUT') {
          input.select();
        }
        
      } else {

        if (input.value.trim() === '') {
          showToast('Kolom tidak boleh kosong!', 'error');
          input.focus();
          return;
        }

        if (field === 'email' && !isValidEmail(input.value)) {
          showToast('Format email tidak valid!', 'error');
          input.focus();
          return;
        }

        if (field === 'phone' && !isValidPhone(input.value)) {
          showToast('Format nomor telepon tidak valid!', 'error');
          input.focus();
          return;
        }

        input.setAttribute('readonly', true);
        input.style.background = '#f8fdf8';
        input.style.borderColor = '#e8f5e9';
        
        this.textContent = 'Edit';
        this.style.background = 'linear-gradient(135deg, #2A8A56 0%, #28a745 100%)';

        if (field === 'name') {
          updateDisplayName(input.value);
        }

        saveToDatabase(field, input.value);
        
        showToast('Perubahan berhasil disimpan!', 'success');
      }
    });
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, {
    threshold: 0.1
  });

  document.querySelectorAll('.card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'all 0.6s ease';
    observer.observe(card);
  });

  document.querySelectorAll('.stat-card').forEach(card => {
    card.addEventListener('click', function() {
      this.style.transform = 'translateX(0) scale(0.97)';
      setTimeout(() => {
        this.style.transform = 'translateX(8px) scale(1)';
      }, 150);
    });
  });

  document.querySelectorAll('.tag').forEach(tag => {
    tag.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-5px) rotate(3deg)';
    });
    tag.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) rotate(0deg)';
    });
  });

  document.querySelectorAll('.achievement-badge').forEach((badge, index) => {
    badge.style.opacity = '0';
    badge.style.transform = 'scale(0.9)';
    
    setTimeout(() => {
      badge.style.transition = 'all 0.5s ease';
      badge.style.opacity = '1';
      badge.style.transform = 'scale(1)';
    }, 200 * (index + 1));
  });

  let lastScroll = 0;
  const navbar = document.querySelector('.navbar');

  window.addEventListener('scroll', function() {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll <= 0) {
      navbar.style.boxShadow = '0 2px 15px rgba(0,0,0,0.1)';
    } else if (currentScroll > lastScroll && currentScroll > 100) {
      navbar.style.transform = 'translateY(-100%)';
    } else {
      navbar.style.transform = 'translateY(0)';
      navbar.style.boxShadow = '0 5px 25px rgba(0,0,0,0.15)';
    }
    
    lastScroll = currentScroll;
  });
});


function updateDisplayName(newName) {
  const userInfoSpans = document.querySelectorAll('.user-info span');
  userInfoSpans.forEach(span => {
    if (!span.textContent.includes('▼')) {
      span.textContent = newName;
    }
  });
  
  const profileName = document.querySelector('.profile-name');
  if (profileName) {
    profileName.textContent = newName;
  }
}

function showToast(message, type = 'success') {
  const toast = document.getElementById('toast');
  const toastIcon = document.getElementById('toastIcon');
  const toastMessage = document.getElementById('toastMessage');

  if (type === 'success') {
    toastIcon.textContent = '✓';
    toast.style.borderLeftColor = '#28a745';
  } else if (type === 'error') {
    toastIcon.textContent = '✗';
    toast.style.borderLeftColor = '#dc3545';
  }

  toastMessage.textContent = message;
  toast.classList.add('show');

  setTimeout(() => {
    toast.classList.remove('show');
  }, 3000);
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPhone(phone) {
  const digits = phone.replace(/\D/g, '');
  
  return digits.length >= 10 && digits.length <= 15;
}

function saveToDatabase(field, value) {
  // Uncomment jika ingin save ke database via AJAX
  /*
  const formData = new FormData();
  formData.append('field', field);
  formData.append('value', value);
  formData.append('user_id', userId); // userId dari PHP

  fetch('../database/update-profile.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      console.log('Data berhasil disimpan ke database');
    } else {
      console.error('Gagal menyimpan data:', data.message);
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
  */
  
  // Untuk saat ini, hanya log ke console
  console.log(`Saving ${field}: ${value} for user ${userId}`);
}

document.addEventListener('keydown', function(e) {

  if (e.key === 'Escape') {
    const activeInput = document.querySelector('.form-input:not([readonly])');
    if (activeInput) {
      const editBtn = activeInput.parentElement.querySelector('.edit-btn');
      if (editBtn && editBtn.textContent === 'Simpan') {
        editBtn.click();
        showToast('Edit dibatalkan', 'error');
      }
    }
  }
});

function setButtonLoading(button, isLoading) {
  if (isLoading) {
    button.disabled = true;
    button.innerHTML = '<span class="loading"></span> Loading...';
  } else {
    button.disabled = false;
    button.textContent = 'Edit';
  }
}

// Console welcome message
console.log('%c🏀 LapanganKu Profile Page', 'color: #2A8A56; font-size: 20px; font-weight: bold;');
console.log('%cProfile system loaded successfully!', 'color: #28a745; font-size: 14px;');