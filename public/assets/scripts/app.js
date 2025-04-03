import initBannerSlider from "./modules/banner-slider.js";
import initProductSlider from "./modules/product-slider.js";
import Accordion from "./plugins/accordion.js";
import CatalogMenu from "./plugins/catalog.js";
import Dropdown from "./plugins/dropdown-menu.js";
import FieldDropdown from "./plugins/field-dropdown.js";
import AdaptiveMenu from "./plugins/menu.js";
import ThemeSwitcher from "./plugins/theme-switcher.js";
import ModalPlugin from "./plugins/modal-plugin.js";
import TabsPlugin from "./plugins/tabs-plugin.js";
import ProductOrder from "./plugins/product-order.js";

console.log("app.js загружен"); // Проверка загрузки app.js

document.addEventListener('DOMContentLoaded', () => {
    console.log("DOMContentLoaded сработал"); // Проверяем, что DOM полностью загружен

    const themeSwitcher = new ThemeSwitcher({
        lightThemeButton: '[data-theme-light]',
        darkThemeButton: '[data-theme-dark]',
        themeKey: 'color-theme',
    });

    const dropdownMenu = new Dropdown({
        selector: '.dropdown',
        breakpoint: 768,
    });

    const catalogMenu = new CatalogMenu({
        buttonSelector: '[data-catalog-button]',
        menuSelector: '[data-catalog-menu]',
    });

    const mobileMenu = new AdaptiveMenu({
        buttonSelector: '[data-menu-toggler]', // Селектор кнопки
        menuSelector: '[data-menu-overlay]', // Селектор меню
        htmlElementSelector: 'html' // Селектор HTML-элемента (например, body)
    });

    const modal = new ModalPlugin({
        targetSelector: '[data-modal-target]',
        pathSelector: '[data-modal-path]',
        closeSelector: '[data-modal-close]'
    });

    const tabsPlugin = new TabsPlugin({
        containerSelector: '[data-tabs]',
        controlSelector: '[data-tab-control]',
        panelSelector: '[data-tab-panel]'
    });

    // Проверяем, есть ли на странице кнопки заказа
    if (document.querySelector('.product-card__order-btn') || document.querySelector('.product-detail__info-callbackButton')) {
        console.log("Кнопки заказа найдены, инициализируем ProductOrder");
        const productOrder = new ProductOrder({
            buttonSelector: ".product-card__order-btn",
            inputSelector: "#product-name",
            detailButtonSelector: ".product-detail__info-callbackButton",
            detailTitleSelector: ".product-detail__info-name"
        });
    } else {
        console.log("Кнопки заказа не найдены, ProductOrder не инициализирован");
    }

    const fieldDropdown = new FieldDropdown();
    const accordion = new Accordion();

    initBannerSlider();
    initProductSlider();
});
