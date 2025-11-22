document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formPembayaran');
    const btnBayar = document.getElementById('btnBayar');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nama = document.getElementById('nama').value.trim();
        const email = document.getElementById('email').value.trim();
        const metode = document.querySelector('input[name="metode"]:checked');
        
        if (!nama) {
            alert('Nama lengkap harus diisi!');
            document.getElementById('nama').focus();
            return false;
        }
        
        if (!email) {
            alert('Email/No-HP harus diisi!');
            document.getElementById('email').focus();
            return false;
        }
        
        if (!metode) {
            alert('Pilih metode pembayaran!');
            return false;
        }
        
        const konfirmasi = confirm(`Konfirmasi Pembayaran\n\nNama: ${nama}\nMetode: ${metode.value}\n\nLanjutkan pembayaran?`);
        
        if (konfirmasi) {
            const originalText = btnBayar.textContent;
            btnBayar.textContent = 'Memproses Pembayaran...';
            btnBayar.disabled = true;
            
            form.submit();
        }
        
        return false;
    });
});