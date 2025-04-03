class Dropdown {
    constructor(options) {
        this.dropdowns = document.querySelectorAll(options.selector);
        this.breakpoint = options.breakpoint || 768; // Значение по умолчанию для breakpoint
        this.init();
    }

    init() {
        this.dropdowns.forEach(dropdown => {
            const dropdownList = dropdown.querySelector('.dropdown__list');

            if (dropdownList) {
                this.setupEvents(dropdown, dropdownList);
            }
        });
    }

    setupEvents(dropdown, dropdownList) {
        const handleMouseEnter = () => {
            if (window.innerWidth >= this.breakpoint) {
                dropdownList.classList.add('is-active');
            }
        };

        const handleMouseLeave = () => {
            if (window.innerWidth >= this.breakpoint) {
                dropdownList.classList.remove('is-active');
            }
        };

        const handleClick = () => {
            if (window.innerWidth < this.breakpoint) {
                dropdownList.classList.toggle('is-active');
            }
        };

        dropdown.addEventListener('mouseenter', handleMouseEnter);
        dropdown.addEventListener('mouseleave', handleMouseLeave);
        dropdown.addEventListener('click', handleClick);

        // Закрытие dropdown при клике вне области
        document.addEventListener('click', (event) => {
            if (!dropdown.contains(event.target)) {
                dropdownList.classList.remove('is-active');
            }
        });
    }
}

export default Dropdown;