document.addEventListener('DOMContentLoaded', function () {
    const flashModalEl = document.getElementById('flashModal');
    if (flashModalEl) {
        const flashModal = new bootstrap.Modal(flashModalEl);
        flashModal.show();

        // Automatically hide after 3 seconds
        setTimeout(() => flashModal.hide(), 1500);
    }
});