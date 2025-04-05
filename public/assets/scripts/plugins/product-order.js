export default class ProductOrder {
    constructor({ buttonSelector, inputSelector, detailButtonSelector, detailTitleSelector }) {
        console.log("ProductOrder загружен!"); // Проверяем загрузку скрипта

        this.input = document.querySelector(inputSelector);
        if (!this.input) {
            console.log("ProductOrder: Поле ввода не найдено");
            return;
        }

        this.buttons = document.querySelectorAll(buttonSelector);
        if (this.buttons.length) {
            console.log("ProductOrder: Найдены кнопки заказа в каталоге");
            this.buttons.forEach(button => {
                button.addEventListener("click", () => this.handleOrderFromCard(button));
            });
        }

        this.detailButton = document.querySelector(detailButtonSelector);
        if (this.detailButton) {
            console.log("ProductOrder: Найдена кнопка заказа на странице товара");
            this.detailButton.addEventListener("click", () => this.handleOrderFromDetail(detailTitleSelector));
        } else {
            console.log("ProductOrder: Кнопка на странице товара не найдена");
        }
    }

    handleOrderFromCard(button) {
        const productCard = button.closest(".product-card");
        const productTitleElement = productCard.querySelector(".product-card__alt-name");

        if (productTitleElement) {
            const productName = productTitleElement.textContent.trim();
            console.log("Выбран товар (из каталога):", productName);
            this.input.value = productName;
        } else {
            console.log("Ошибка: Не найден заголовок товара в карточке");
        }
    }

    handleOrderFromDetail(detailTitleSelector) {
        console.log("Клик по кнопке заказа на странице товара!");

        // Проверяем, что элемент с названием товара существует
        const productTitleElement = document.querySelector(detailTitleSelector);
        if (!productTitleElement) {
            console.log("Ошибка: Не найден заголовок товара на странице. Проверяем селектор:", detailTitleSelector);
            return;
        }

        const productName = productTitleElement.textContent.trim();
        console.log("Выбран товар (со страницы товара):", productName);

        // Проверяем, что инпут существует перед установкой значения
        if (this.input) {
            this.input.value = productName;
            console.log(`Значение инпута: ${this.input.value}`);
        } else {
            console.log("Ошибка: Инпут не найден на странице товара");
        }
    }
}
