class Accordion {
    constructor() {
      this.accordions = document.querySelectorAll('[data-accordion]'); // Все контейнеры аккордеона
      this.init();
    }
  
    init() {
      if (this.accordions.length > 0) {
        this.setupEvents();
      } else {
        console.error('Не найдены аккордеоны!');
      }
    }
  
    setupEvents() {
      this.accordions.forEach((accordion) => {
        const control = accordion.querySelector('[data-accordion-control]'); // Кнопка управления
        const content = accordion.querySelector('[data-accordion-content]'); // Контент аккордеона
  
        if (control && content) {
          // Обработка клика по кнопке управления
          control.addEventListener('click', () => {
            this.toggleAccordion(control, content);
          });
        } else {
          console.error('В аккордеоне не найдены control или content!', accordion);
        }
      });
    }
  
    toggleAccordion(control, content) {
      // Если аккордеон уже открыт, закрываем его
      if (control.classList.contains('is-active')) {
        this.closeAccordion(control, content);
      } else {
        // Закрываем все аккордеоны перед открытием текущего
        this.closeAllAccordions();
  
        // Открываем текущий аккордеон
        this.openAccordion(control, content);
      }
    }
  
    openAccordion(control, content) {
      // Устанавливаем высоту контента
      content.style.height = `${content.scrollHeight}px`;
  
      // Добавляем класс is-active для кнопки управления
      control.classList.add('is-active');
  
      // Добавляем атрибут для стилей или анимации
      content.setAttribute('aria-expanded', 'true');
    }
  
    closeAccordion(control, content) {
      // Убираем высоту контента
      content.style.height = '0';
  
      // Убираем класс is-active для кнопки управления
      control.classList.remove('is-active');
  
      // Убираем атрибут для стилей или анимации
      content.setAttribute('aria-expanded', 'false');
    }
  
    closeAllAccordions() {
      this.accordions.forEach((accordion) => {
        const control = accordion.querySelector('[data-accordion-control]');
        const content = accordion.querySelector('[data-accordion-content]');
  
        if (control && content && control.classList.contains('is-active')) {
          this.closeAccordion(control, content);
        }
      });
    }
  }
  
  export default Accordion;