class ThemeSwitcher {
    constructor(options) {
        this.lightThemeButton = document.querySelector(options.lightThemeButton);
        this.darkThemeButton = document.querySelector(options.darkThemeButton);
        this.themeKey = options.themeKey || 'theme';
        this.init();
    }

    init() {
        this.loadTheme();
        this.bindEvents();
    }

    bindEvents() {
        this.lightThemeButton.addEventListener('click', () => this.switchTheme('light'));
        this.darkThemeButton.addEventListener('click', () => this.switchTheme('dark'));
    }

    switchTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(this.themeKey, theme);

        if (theme === 'light') {
            this.lightThemeButton.classList.add('is-active');
            this.darkThemeButton.classList.remove('is-active');
        } else {
            this.darkThemeButton.classList.add('is-active');
            this.lightThemeButton.classList.remove('is-active');
        }
    }

    loadTheme() {
        const savedTheme = localStorage.getItem(this.themeKey) || 'light';
        this.switchTheme(savedTheme);
    }
}

export default ThemeSwitcher;