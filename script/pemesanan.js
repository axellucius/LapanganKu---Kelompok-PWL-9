
let olahraga = 'Basket';
let lap = 'Lapangan 1';
let tgl = '';
let waktu = '';


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


function perbaruiRingkasan() {
    document.getElementById('s-sport').textContent = olahraga + ' -';
    document.getElementById('s-lapangan').textContent = lap;
    document.getElementById('s-tanggal').textContent = tgl || '-';
    
    if (waktu) {
        const akhir = (parseInt(waktu) + 1).toString().padStart(2, '0');
        document.getElementById('s-jam').textContent = `${waktu} - ${akhir}.00`;
    } else {
        document.getElementById('s-jam').textContent = '-';
    }
}


document.querySelectorAll('.sport').forEach(b => {
    b.addEventListener('click', function() {
        document.querySelectorAll('.sport').forEach(x => x.classList.remove('active'));
        this.classList.add('active');
        olahraga = this.dataset.sport;
        perbaruiRingkasan();
    });
});


document.querySelectorAll('input[name="lapangan"]').forEach(r => {
    r.addEventListener('change', function() {
        lap = this.value;
        perbaruiRingkasan();
    });
});


document.getElementById('tanggal').addEventListener('change', function() {
    tgl = this.value;
    perbaruiRingkasan();
});


document.querySelectorAll('.time').forEach(b => {
    b.addEventListener('click', function() {
        document.querySelectorAll('.time').forEach(x => x.classList.remove('active'));
        this.classList.add('active');
        waktu = this.dataset.time;
        perbaruiRingkasan();
    });
});


document.querySelector('.btn').addEventListener('click', function() {
    if (!tgl) {
        alert('Pilih tanggal terlebih dahulu!');
        return;
    }
    if (!waktu) {
        alert('Pilih jam terlebih dahulu!');
        return;
    }
    
    const akhir = (parseInt(waktu) + 1).toString().padStart(2, '0');
    const pesan = `Konfirmasi Pemesanan:\n\nOlahraga: ${olahraga}\nLapangan: ${lap}\nTanggal: ${tgl}\nJam: ${waktu} - ${akhir}.00\n\nLanjutkan ke pembayaran?`;
    
    if (confirm(pesan)) {
        alert('Terima kasih! Fitur pembayaran akan segera tersedia.');
    }
});


buatTanggal();
perbaruiRingkasan();