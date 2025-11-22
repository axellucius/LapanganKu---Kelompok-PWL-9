let olahraga = 'Basket';
let lap = 'Lapangan 1';
let tgl = '';
let jamMulai = '';
let jamSelesai = '';

function buatTanggal() {
    const s = document.getElementById('tanggal');
    const bln = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    
    for (let i = 0; i < 30; i++) {
        const d = new Date();
        d.setDate(d.getDate() + i);
        
        const hari = d.getDate();
        const bulan = bln[d.getMonth()];
        const tahun = d.getFullYear();
        
        const opt = document.createElement('option');
        opt.value = `${hari} ${bulan} ${tahun}`;
        opt.textContent = opt.value;
        s.appendChild(opt);
    }
}

function hitungDurasi() {
    if (!jamMulai || !jamSelesai) return 0;
    const mulai = parseFloat(jamMulai);
    const selesai = parseFloat(jamSelesai);
    return selesai - mulai;
}

function perbaruiRingkasan() {
    document.getElementById('s-sport').textContent = olahraga + ' -';
    document.getElementById('s-lapangan').textContent = lap;
    document.getElementById('s-tanggal').textContent = tgl || '-';
    
    if (jamMulai && jamSelesai) {
        document.getElementById('s-jam').textContent = `${jamMulai} - ${jamSelesai}`;
        const durasi = hitungDurasi();
        document.getElementById('s-durasi').textContent = durasi > 0 ? `${durasi} jam` : '-';
    } else if (jamMulai) {
        document.getElementById('s-jam').textContent = `${jamMulai} - ...`;
        document.getElementById('s-durasi').textContent = '-';
    } else {
        document.getElementById('s-jam').textContent = '-';
        document.getElementById('s-durasi').textContent = '-';
    }
}

function updateJamSelesaiOptions() {
    const jamSelesaiButtons = document.querySelectorAll('#jamSelesaiContainer .time');
    
    if (!jamMulai) {
        // Disable semua jam selesai jika belum pilih jam mulai
        jamSelesaiButtons.forEach(btn => {
            btn.disabled = true;
            btn.classList.remove('active');
        });
        return;
    }
    
    const jamMulaiInt = parseFloat(jamMulai);
    
    jamSelesaiButtons.forEach(btn => {
        const jamValue = parseFloat(btn.dataset.time);
        
        if (jamValue > jamMulaiInt) {
            btn.disabled = false;
        } else {
            btn.disabled = true;
            btn.classList.remove('active');
        }
    });
}

// Event: Pilih olahraga
document.querySelectorAll('.sport').forEach(b => {
    b.addEventListener('click', function() {
        document.querySelectorAll('.sport').forEach(x => x.classList.remove('active'));
        this.classList.add('active');
        olahraga = this.dataset.sport;
        perbaruiRingkasan();
    });
});

// Event: Pilih lapangan
document.querySelectorAll('input[name="lapangan"]').forEach(r => {
    r.addEventListener('change', function() {
        lap = this.value;
        perbaruiRingkasan();
    });
});

// Event: Pilih tanggal
document.getElementById('tanggal').addEventListener('change', function() {
    tgl = this.value;
    perbaruiRingkasan();
});

// Event: Pilih jam mulai
document.querySelectorAll('#jamMulaiContainer .time').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('#jamMulaiContainer .time').forEach(x => x.classList.remove('active'));
        this.classList.add('active');
        jamMulai = this.dataset.time;
        
        // Reset jam selesai
        jamSelesai = '';
        document.querySelectorAll('#jamSelesaiContainer .time').forEach(x => x.classList.remove('active'));
        
        // Update opsi jam selesai
        updateJamSelesaiOptions();
        perbaruiRingkasan();
    });
});

// Event: Pilih jam selesai
document.querySelectorAll('#jamSelesaiContainer .time').forEach(btn => {
    btn.addEventListener('click', function() {
        if (this.disabled) {
            alert('⚠️ Pilih jam mulai terlebih dahulu!');
            return;
        }
        
        document.querySelectorAll('#jamSelesaiContainer .time').forEach(x => x.classList.remove('active'));
        this.classList.add('active');
        jamSelesai = this.dataset.time;
        perbaruiRingkasan();
    });
});

// Event: Lanjutkan ke pembayaran
document.getElementById('btnLanjutkan').addEventListener('click', async function() {
    // Validasi
    if (!tgl) {
        alert('⚠️ Pilih tanggal terlebih dahulu!');
        return;
    }
    if (!jamMulai) {
        alert('⚠️ Pilih jam mulai terlebih dahulu!');
        return;
    }
    if (!jamSelesai) {
        alert('⚠️ Pilih jam selesai terlebih dahulu!');
        return;
    }
    
    const durasi = hitungDurasi();
    if (durasi <= 0) {
        alert('⚠️ Jam selesai harus lebih besar dari jam mulai!');
        return;
    }
    
    // Tampilkan loading
    const btn = this;
    const originalText = btn.textContent;
    btn.textContent = '⏳ Memproses...';
    btn.disabled = true;
    btn.style.opacity = '0.7';
    btn.style.cursor = 'wait';
    
    const formData = new FormData();
    formData.append('olahraga', olahraga);
    formData.append('lapangan', lap);
    formData.append('tanggal', tgl);
    formData.append('jam_mulai', jamMulai);
    formData.append('jam_selesai', jamSelesai);
    
    try {
        const response = await fetch('../database/simpan-pemesanan.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        console.log('Response dari database:', result);
        
        if (result.success) {
            console.log('✅ Pemesanan berhasil disimpan!');
            console.log('Data:', result.data);
            // Redirect ke halaman pembayaran
            window.location.href = 'pembayaran.php';
        } else {
            alert('❌ ' + (result.message || 'Gagal menyimpan pemesanan. Silakan coba lagi.'));
            console.error('Error:', result);
            btn.textContent = originalText;
            btn.disabled = false;
            btn.style.opacity = '1';
            btn.style.cursor = 'pointer';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('❌ Terjadi kesalahan koneksi. Silakan coba lagi.\n\nDetail: ' + error.message);
        btn.textContent = originalText;
        btn.disabled = false;
        btn.style.opacity = '1';
        btn.style.cursor = 'pointer';
    }
});

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    buatTanggal();
    updateJamSelesaiOptions();
    perbaruiRingkasan();
    console.log('✅ Pemesanan.js loaded successfully!');
});

buatTanggal();
updateJamSelesaiOptions();
perbaruiRingkasan();