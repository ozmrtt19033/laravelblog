// Post silme onay mesajı
document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Bu postu silmek istediğinize emin misiniz?')) {
                e.preventDefault();
            }
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
