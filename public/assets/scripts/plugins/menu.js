class AdaptiveMenu {
    constructor(options) {
        this.button = document.querySelector(options.buttonSelector); // Кнопка для открытия/закрытия меню
        this.menu = document.querySelector(options.menuSelector); // Контейнер меню
        this.htmlElement = document.querySelector(options.htmlElementSelector); // HTML-элемент (например, body)
        this.init();
    }

    init() {
        if (this.button && this.menu && this.htmlElement) {
            this.setupEvents();
        } else {
            console.error('Не найдены кнопка, меню или HTML-элемент!');
        }
    }

    setupEvents() {
        // Открытие/закрытие меню при клике на кнопку
        this.button.addEventListener('click', (event) => {
            event.stopPropagation(); // Предотвращаем всплытие, чтобы не сработал клик на document
            this.toggleMenu();
        });

        // Закрытие меню при клике за его пределами
        document.addEventListener('click', (event) => {
            if (!this.menu.contains(event.target) && !this.button.contains(event.target)) {
                this.closeMenu();
            }
        });

        // Закрытие меню при нажатии клавиши Esc
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                this.closeMenu();
            }
        });
    }

    toggleMenu() {
        this.menu.classList.toggle('is-active');
        this.htmlElement.classList.toggle('is-lock');
    }

    closeMenu() {
        this.menu.classList.remove('is-active');
        this.htmlElement.classList.remove('is-lock');
    }
}

export default AdaptiveMenu;