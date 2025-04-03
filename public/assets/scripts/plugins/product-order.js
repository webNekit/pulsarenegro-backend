export default class ProductOrder {
    constructor({ buttonSelector, inputSelector, detailButtonSelector, detailTitleSelector }) {
        console.log("ProductOrder загружен!");

        // Находим поле ввода
        this.input = document.querySelector(inputSelector);
        if (!this.input) {
            console.error("ProductOrder: Поле ввода не найдено");
            return;
        }

        // Обработка кнопок в каталоге
        this.buttons = document.querySelectorAll(buttonSelector);
        if (this.buttons.length > 0) {
            console.log(`ProductOrder: Найдено ${this.buttons.length} кнопок заказа в каталоге`);
            this.buttons.forEach(button => {
                button.addEventListener("click", () => this.handleOrderFromCard(button));
            });
        }

        // Обработка кнопки на странице товара
        this.detailButton = document.querySelector(detailButtonSelector);
        if (this.detailButton) {
            console.log("ProductOrder: Найдена кнопка заказа на странице товара");
            this.detailButton.addEventListener("click", (e) => {
                e.preventDefault();
                this.handleOrderFromDetail(detailTitleSelector);
            });
        }
    }

    handleOrderFromCard(button) {
        const productCard = button.closest(".product-card");
        const productTitleElement = productCard.querySelector(".product-card__alt-name");

        if (productTitleElement) {
            const productName = productTitleElement.textContent.trim();
            console.log("Выбран товар (из каталога):", productName);
            this.setProductName(productName);
        } else {
            console.error("Ошибка: Не найден заголовок товара в карточке");
        }
    }

    handleOrderFromDetail(detailTitleSelector) {
        console.log("Клик по кнопке заказа на странице товара");

        const productTitleElement = document.querySelector(detailTitleSelector);
        if (!productTitleElement) {
            console.error("Ошибка: Не найден заголовок товара на странице. Проверяем селектор:", detailTitleSelector);
            return;
        }

        const productName = productTitleElement.textContent.trim();
        console.log("Выбран товар (со страницы товара):", productName);
        this.setProductName(productName);
    }

    setProductName(name) {
        if (this.input) {
            this.input.value = name;
            console.log(`Установлено значение инпута: ${this.input.value}`);
            
            // Если есть модальное окно, открываем его
            const modal = document.querySelector("#modal-callback-product");
            if (modal) {
                modal.classList.add("modal--active");
                console.log("Модальное окно открыто");
            }
        } else {
            console.error("Ошибка: Инпут не найден");
        }
    }
}