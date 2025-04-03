class FieldDropdown {
  constructor() {
    this.containers = document.querySelectorAll('[data-select]'); // Все контейнеры с атрибутом data-select
    this.init();
  }

  init() {
    if (this.containers.length > 0) {
      this.setupEvents();
    } else {
      console.error('Не найдены контейнеры с атрибутом data-select!');
    }
  }

  setupEvents() {
    this.containers.forEach((container) => {
      const button = container.querySelector('[data-select-control]'); // Кнопка внутри контейнера
      const dropdown = container.querySelector('[data-select-target]'); // Dropdown внутри контейнера
      const selectField = container.querySelector('.field__select-selected'); // Элемент, в который будем вставлять значение

      if (button && dropdown && selectField) {
        // Обработка клика по кнопке
        button.addEventListener('click', (event) => {
          event.stopPropagation(); // Останавливаем всплытие
          this.toggleDropdown(button, dropdown);
        });

        // Обработка кликов на элементы checkbox внутри dropdown
        const checkboxes = dropdown.querySelectorAll('.checkbox__input');
        checkboxes.forEach(checkbox => {
          checkbox.addEventListener('change', (event) => {
            event.stopPropagation(); // Останавливаем всплытие
            this.updateSelectField(selectField); // Обновляем текст в поле
          });
        });
      } else {
        console.error('В контейнере не найдены кнопка, dropdown или field__select-selected!', container);
      }
    });

    // Закрытие dropdown при клике вне области
    document.addEventListener('click', (event) => {
      this.closeAllDropdowns(event);
    });

    // Закрытие dropdown при нажатии на Esc
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        this.closeAllDropdowns();
      }
    });
  }

  toggleDropdown(button, dropdown) {
    // Если dropdown уже открыт, закрываем его
    if (dropdown.classList.contains('is-active')) {
      dropdown.classList.remove('is-active');
    } else {
      // Закрываем все dropdown перед открытием нового
      this.closeAllDropdowns();

      // Открываем текущий dropdown
      dropdown.classList.add('is-active');
    }
  }

  closeAllDropdowns(event) {
    this.containers.forEach((container) => {
      const dropdown = container.querySelector('[data-select-target]');
      if (
        dropdown &&
        (!event ||
          !dropdown.contains(event.target) &&
          !container.querySelector('[data-select-control]').contains(event.target))
      ) {
        dropdown.classList.remove('is-active');
      }
    });
  }

  // Обновление текста в field__select-selected на основе выбранных чекбоксов
  updateSelectField(selectField) {
    const selectedLabels = [];
    const checkboxes = selectField.closest('[data-select]').querySelectorAll('.checkbox__input');
    
    checkboxes.forEach(checkbox => {
      const label = checkbox.closest('label').querySelector('.checkbox__label');
      if (checkbox.checked) {
        selectedLabels.push(label.innerText);
      }
    });

    // Если есть выбранные чекбоксы, выводим их в поле через точку с запятой
    if (selectedLabels.length > 0) {
      selectField.innerText = selectedLabels.join('; ');
    } else {
      // Если нет выбранных чекбоксов, возвращаем изначальный текст (который был в разметке)
      selectField.innerText = selectField.getAttribute('data-default');
    }
  }
}

export default FieldDropdown;
