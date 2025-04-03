class ModalPlugin {
    constructor(options) {
        this.options = options || {};
        this.init();
    }

    init() {
        this.modalButtons = document.querySelectorAll(this.options.targetSelector || '[data-modal-target]');
        this.modals = document.querySelectorAll(this.options.pathSelector || '[data-modal-path]');
        this.openModal = modalId => {
            const modal = document.getElementById(modalId);

            if (!modal) return;

            modal.classList.add('is-active');
            document.querySelector('html').classList.add('is-lock');
        };

        this.closeModal = modalId => {
            const modal = document.getElementById(modalId);

            if (!modal) return;

            modal.classList.remove('is-active');
            document.querySelector('html').classList.remove('is-lock');
        };

        this.modalButtons.forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();

                const target = button.dataset.modalTarget;
                this.openModal(target);
            });
        });

        document.querySelectorAll(this.options.closeSelector || '[data-modal-close]').forEach(closeButton => {
            closeButton.addEventListener('click', event => {
                event.preventDefault();

                const modal = closeButton.closest('.modal');
                if (!modal) return;

                const modalId = modal.id;
                this.closeModal(modalId);
            });
        });
    }
}

export default ModalPlugin;