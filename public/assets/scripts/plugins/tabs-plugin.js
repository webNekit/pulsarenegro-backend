class TabsPlugin {
    constructor(options) {
        this.options = options || {};
        this.init();
    }

    init() {
        // Получаем контейнер табов
        this.tabContainer = document.querySelector(this.options.containerSelector || '[data-tabs]');

        // Проверяем наличие контейнера табов
        if (!this.tabContainer) {
            console.warn("Табы не найдены");
            return; // Прерываем выполнение плагина
        }

        // Получаем все кнопки табов
        this.tabControls = Array.from(document.querySelectorAll(this.options.controlSelector || '[data-tab-control]'));

        // Проверяем наличие кнопок табов
        if (this.tabControls.length === 0) {
            console.warn("Кнопки табов не найдены");
            return; // Прерываем выполнение плагина
        }

        // Получаем все панели табов
        this.tabPanels = Array.from(document.querySelectorAll(this.options.panelSelector || '[data-tab-panel]'));

        // Проверяем наличие панелей табов
        if (this.tabPanels.length === 0) {
            console.warn("Панели табов не найдены");
            return; // Прерываем выполнение плагина
        }

        // Определяем начальную активную вкладку
        let initialActivePanel = null;
        for (let i = 0; i < this.tabPanels.length; i++) {
            if (this.tabPanels[i].classList.contains('is-active')) {
                initialActivePanel = this.tabPanels[i];
                break;
            }
        }

        // Если не найдена активная панель, выбираем первую
        if (!initialActivePanel) {
            initialActivePanel = this.tabPanels[0];
        }

        // Определяем начальную активную кнопку
        const activeControl = this.tabControls.find(control => {
            return control.dataset.tabControl === initialActivePanel.dataset.tabPanel;
        });

        // Добавляем класс активной кнопки и панели
        if (activeControl && initialActivePanel) {
            activeControl.classList.add('is-active');
            initialActivePanel.classList.add('is-active'); // Добавили этот код
        } else {
            // Если не найдена активная панель или кнопка, добавляем класс к первой панели и кнопке
            this.tabPanels[0].classList.add('is-active');
            this.tabControls[0].classList.add('is-active');
        }

        // Добавляем обработчики событий для каждой кнопки
        this.tabControls.forEach(control => {
            control.addEventListener('click', () => {
                this.activateTab(control.dataset.tabControl);
            });
        });
    }

    activateTab(tabName) {
        // Находим соответствующую панель
        const tabPanel = this.tabPanels.find(panel => {
            return panel.dataset.tabPanel === tabName;
        });

        // Проверяем наличие панели
        if (!tabPanel) return;

        // Деактивируем все панели и кнопки
        this.tabPanels.forEach(panel => panel.classList.remove('is-active'));
        this.tabControls.forEach(control => control.classList.remove('is-active'));

        // Активируем нужную панель и кнопку
        tabPanel.classList.add('is-active');
        const matchingControl = this.tabControls.find(control => {
            return control.dataset.tabControl === tabName;
        });
        if (matchingControl) {
            matchingControl.classList.add('is-active');
        }
    }
}

// Экспорт класса для использования в другом файле
export default TabsPlugin;