document.addEventListener("DOMContentLoaded", function() {
    const sportButtons = document.querySelectorAll(".sport");
    const tanggalInput = document.getElementById("tanggal");
    const lapanganRadios = document.querySelectorAll("input[name='lapangan']");
    const jamMulaiSelect = document.getElementById("jam_mulai");
    const jamSelesaiSelect = document.getElementById("jam_selesai");
    const inputSport = document.getElementById("inputSport");
    const sSport = document.getElementById("s-sport");
    const sLapangan = document.getElementById("s-lapangan");
    const sTanggal = document.getElementById("s-tanggal");
    const sJam = document.getElementById("s-jam");

    const jamArray = ["09.00","10.00","11.00","12.00","13.00","14.00","15.00","16.00","17.00","18.00","19.00","20.00","21.00","22.00","23.00"];

    jamArray.forEach(j => {
        const opt1 = document.createElement("option");
        opt1.value = j;
        opt1.textContent = j;
        jamMulaiSelect.appendChild(opt1);
    });

    function updateJamSelesai() {
        jamSelesaiSelect.innerHTML = "<option value=''>Pilih jam selesai</option>";
        const startIndex = jamArray.indexOf(jamMulaiSelect.value);
        if (startIndex !== -1) {
            for (let i = startIndex + 1; i < jamArray.length; i++) {
                const opt = document.createElement("option");
                opt.value = jamArray[i];
                opt.textContent = jamArray[i];
                jamSelesaiSelect.appendChild(opt);
            }
        }
    }

    jamMulaiSelect.addEventListener("change", updateJamSelesai);

    sportButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            sportButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            inputSport.value = btn.dataset.sport;
            sSport.textContent = btn.dataset.sport;
        });
    });

    lapanganRadios.forEach(r => {
        r.addEventListener("change", () => {
            sLapangan.textContent = r.value;
        });
    });

    tanggalInput.addEventListener("change", () => {
        sTanggal.textContent = tanggalInput.value;
    });

    jamMulaiSelect.addEventListener("change", () => {
        if (jamSelesaiSelect.value) {
            sJam.textContent = jamMulaiSelect.value + " - " + jamSelesaiSelect.value;
        }
    });

    jamSelesaiSelect.addEventListener("change", () => {
        sJam.textContent = jamMulaiSelect.value + " - " + jamSelesaiSelect.value;
    });
});
