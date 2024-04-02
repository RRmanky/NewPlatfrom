document.addEventListener("DOMContentLoaded", function() {
    // "Beli Sekarang"
    var buyButtons = document.querySelectorAll(".btn-primary");

    // Menambahkan event listener untuk setiap tombol
    buyButtons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            // Mencegah aksi default dari tombol
            event.preventDefault();
            
            // Mendapatkan informasi produk dari judul kartu
            var productTitle = button.closest(".card").querySelector(".card-title").innerText;

            // Konfirmasi pembelian dengan pengguna
            var confirmation = confirm("Anda akan membeli " + productTitle + ". Lanjutkan pembelian?");

            // Jika pengguna mengonfirmasi pembelian
            if (confirmation) {
                // Menampilkan pesan pop-up dengan informasi produk
                alert("Anda telah membeli: " + productTitle);
            } else {
                // Jika pembelian dibatalkan
                alert("Pembelian dibatalkan.");
            }
        });
    });
});
