document.addEventListener('livewire:init', () => {
    Livewire.on('showModal', (modalId) => {
        const modal = new bootstrap.Modal(document.getElementById(modalId), {
            backdrop: 'static',
            keyboard: false
        });
        modal.show();
    });

    Livewire.on('hideModal', (modalId) => {
        const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
        if (modal) {
            modal.hide();
        }
    });
});