class CatalogMenu {
    constructor(options) {
        this.button = document.querySelector(options.buttonSelector); // Кнопка для открытия/закрытия мегаменю
        this.menu = document.querySelector(options.menuSelector); // Контейнер мегаменю
        this.init();
    }

    init() {
        if (this.button && this.menu) {
            this.setupEvents();
        } else {
            console.error('Кнопка или мегаменю не найдены!');
        }
    }

    setupEvents() {
        // Открытие/закрытие мегаменю при клике на кнопку
        this.button.addEventListener('click', (event) => {
            event.stopPropagation(); // Предотвращаем всплытие, чтобы не сработал клик на document
            this.menu.classList.toggle('is-active');
        });

        // Закрытие мегаменю при клике за его пределами
        document.addEventListener('click', (event) => {
            if (!this.menu.contains(event.target) && !this.button.contains(event.target)) {
                this.menu.classList.remove('is-active');
            }
        });
    }
}

export default CatalogMenu;