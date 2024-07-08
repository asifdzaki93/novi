<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.1
    </div>
    <strong> &copy; 2024 <a href="#">Absensi Karyawan QR Code</a>.</strong> by <a href='https://nvm.my.id/' title='nvm.my.id' target='_blank'>Novi Masrokhatul Fu'adah.</a>

</footer>
<script type="text/javascript">
    var d = new Date();
    var hours = d.getHours();
    var minutes = d.getMinutes();
    var seconds = d.getSeconds();
    var hari = d.getDay();
    var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    hariIni = namaHari[hari];
    var tanggal = ("0" + d.getDate()).slice(-2);
    var month = new Array();
    month[0] = "Januari";
    month[1] = "Februari";
    month[2] = "Maret";
    month[3] = "April";
    month[4] = "Mei";
    month[5] = "Juni";
    month[6] = "Juli";
    month[7] = "Agustus";
    month[8] = "September";
    month[9] = "Oktober";
    month[10] = "Nopember";
    month[11] = "Desember";
    var bulan = month[d.getMonth()];
    var tahun = d.getFullYear();
    var date = Date.now(),
        second = 1000;

    function pad(num) {
        return ('0' + num).slice(-2);
    }

    function updateClock() {
        var clockEl = document.getElementById('clock'),
            shiftInfoEl = document.getElementById('shift-info'),
            shiftInfoE2 = document.getElementById('shift-info2'),
            dateObj;
        date += second;
        dateObj = new Date(date);
        clockEl.innerHTML = '' + hariIni + '.  ' + tanggal + ' ' + bulan + ' ' + tahun + '. ' + pad(dateObj.getHours()) + ':' + pad(dateObj.getMinutes()) + ':' + pad(dateObj.getSeconds());

        // Display shift information
        var hours = dateObj.getHours();
        if (hours >= 8 && hours < 19) {
            shiftInfoEl.innerHTML = 'SHIFT 1 (08:00 - 19:00 WIB)';
            shiftInfoE2.innerHTML = 'SHIFT 1 (08:00 - 19:00 WIB)';
        } else {
            shiftInfoEl.innerHTML = 'SHIFT 2 (19:00 - 08:00 WIB)';
            shiftInfoE2.innerHTML = 'SHIFT 2 (19:00 - 08:00 WIB)';
        }
    }
    setInterval(updateClock, second);

    // Initial call to display time and shift information immediately
    updateClock();
</script>