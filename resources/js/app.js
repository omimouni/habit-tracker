import './bootstrap';

Alpine.store('darkMode', {
    isDarkMode: localStorage.getItem('darkMode') === null 
        ? window.matchMedia('(prefers-color-scheme: dark)').matches 
        : localStorage.getItem('darkMode') === 'true',

    toggleDarkMode() {
        this.isDarkMode = !this.isDarkMode;
        localStorage.setItem('darkMode', this.isDarkMode);
    },
});
