<script>   
   function dateIndo(data) {
        if (!data) return '-';
        
        const months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        // Pecah string tanggal '2026-01-02'
        const parts = data.split('-');
        if (parts.length !== 3) return data;
        
        const year = parts[0];
        const monthIndex = parseInt(parts[1], 10) - 1; // Array JS mulai dari 0
        const day = parseInt(parts[2], 10); // Menghilangkan angka 0 di depan (02 -> 2)
        
        return `${day} ${months[monthIndex]} ${year}`;
    }

    function formatCurrency(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0 // Menghilangkan ,00 di belakang
        }).format(angka);
    }

    function formatNumber(number){

        return new Intl.NumberFormat('id-ID').format(number);

    }

    function formatDouble(number){

        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 3}).format(number);

    }
    $(".amount").on("keyup", function () {

        let value = $(this).val().replace(/\D/g, "");

        $(this).val(Number(value).toLocaleString("id-ID"));

    });

    function formatDateIndonesia(dateStr) {
        if (!dateStr) return '';
        const date = new Date(dateStr);

        const formatted = date.toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
        return formatted;
    }

</script>