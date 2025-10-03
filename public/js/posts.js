// Post silme onay mesajı
document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // formu direkt göndermesin
            /***swal kontrolleri yapıldı***/
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu postu silmek istediğinize emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // sadece onay verilirse gönder
                }
            });
        });
    });


    // Başarı mesajını otomatik gizleme
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess) {
        setTimeout(() => {
            alertSuccess.style.transition = 'opacity 0.5s ease';
            alertSuccess.style.opacity = '0';
            setTimeout(() => {
                alertSuccess.remove();
            }, 500);
        }, 3000);
    }
});
