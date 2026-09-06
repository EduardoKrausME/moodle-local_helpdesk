const menuButton = document.querySelector('.menu-button');
const navigation = document.querySelector('.header-inner nav');
menuButton.addEventListener('click', () => {
    const open = menuButton.getAttribute('aria-expanded') !== 'true';
    menuButton.setAttribute('aria-expanded', String(open));
    menuButton.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
    navigation.classList.toggle('open', open)
});
navigation.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
    navigation.classList.remove('open');
    menuButton.setAttribute('aria-expanded', 'false');
    menuButton.setAttribute('aria-label', 'Abrir menu')
}));
document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && navigation.classList.contains('open')) {
        menuButton.click();
        menuButton.focus()
    }
});
const sectionLinks = [...document.querySelectorAll('.section-nav a')];
if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => {
        for (const entry of entries) {
            if (entry.isIntersecting) {
                sectionLinks.forEach(a => {
                    const active = a.hash === '#' + entry.target.id;
                    a.classList.toggle('active', active);
                    if (active) a.setAttribute('aria-current', 'location'); else a.removeAttribute('aria-current')
                })
            }
        }
    }, {rootMargin: '-18% 0px -55% 0px', threshold: 0});
    sectionLinks.forEach(a => {
        const section = document.querySelector(a.hash);
        if (section) observer.observe(section)
    })
}

const themeStorageKey = 'kopere-helpdesk-theme';
const themeTranslations = {
    ar: {
        light: 'فاتح',
        dark: 'داكن',
        toLight: 'التبديل إلى الوضع الفاتح',
        toDark: 'التبديل إلى الوضع الداكن'
    },
    de: {
        light: 'Hell',
        dark: 'Dunkel',
        toLight: 'Zum hellen Modus wechseln',
        toDark: 'Zum dunklen Modus wechseln'
    },
    en: {
        light: 'Light',
        dark: 'Dark',
        toLight: 'Switch to light mode',
        toDark: 'Switch to dark mode'
    },
    es: {
        light: 'Claro',
        dark: 'Oscuro',
        toLight: 'Cambiar al modo claro',
        toDark: 'Cambiar al modo oscuro'
    },
    es_mx: {
        light: 'Claro',
        dark: 'Oscuro',
        toLight: 'Cambiar al modo claro',
        toDark: 'Cambiar al modo oscuro'
    },
    fr: {
        light: 'Clair',
        dark: 'Sombre',
        toLight: 'Passer au mode clair',
        toDark: 'Passer au mode sombre'
    },
    id: {
        light: 'Terang',
        dark: 'Gelap',
        toLight: 'Beralih ke mode terang',
        toDark: 'Beralih ke mode gelap'
    },
    it: {
        light: 'Chiaro',
        dark: 'Scuro',
        toLight: 'Passa alla modalità chiara',
        toDark: 'Passa alla modalità scura'
    },
    ja: {
        light: 'ライト',
        dark: 'ダーク',
        toLight: 'ライトモードに切り替える',
        toDark: 'ダークモードに切り替える'
    },
    pt: {
        light: 'Claro',
        dark: 'Escuro',
        toLight: 'Mudar para o modo claro',
        toDark: 'Mudar para o modo escuro'
    },
    pt_br: {
        light: 'Claro',
        dark: 'Escuro',
        toLight: 'Mudar para o modo claro',
        toDark: 'Mudar para o modo escuro'
    },
    ru: {
        light: 'Светлая',
        dark: 'Тёмная',
        toLight: 'Переключить на светлую тему',
        toDark: 'Переключить на тёмную тему'
    },
    sk: {
        light: 'Svetlý',
        dark: 'Tmavý',
        toLight: 'Prepnúť na svetlý režim',
        toDark: 'Prepnúť na tmavý režim'
    },
    uk: {
        light: 'Світла',
        dark: 'Темна',
        toLight: 'Перемкнути на світлу тему',
        toDark: 'Перемкнути на темну тему'
    }
};
const themeLanguage = document.documentElement.dataset.language || 'en';
const themeLabels = themeTranslations[themeLanguage] || themeTranslations.en;
let savedTheme = 'light';
try {
    savedTheme = localStorage.getItem(themeStorageKey) === 'dark' ? 'dark' : 'light'
} catch (error) {
}
document.documentElement.dataset.theme = savedTheme;

const themeToggle = document.createElement('button');
themeToggle.type = 'button';
themeToggle.className = 'theme-toggle';
themeToggle.innerHTML = '<span class="theme-toggle-icon" aria-hidden="true"></span><span class="theme-toggle-label"></span>';

const sunIcon = '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="3.5"></circle><path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42"></path></svg>';
const moonIcon = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 14.4A8.3 8.3 0 0 1 9.6 3.5 8.5 8.5 0 1 0 20.5 14.4Z"></path></svg>';

function renderThemeToggle() {
    const dark = document.documentElement.dataset.theme === 'dark';
    themeToggle.setAttribute('aria-pressed', String(dark));
    themeToggle.setAttribute('aria-label', dark ? themeLabels.toLight : themeLabels.toDark);
    themeToggle.title = dark ? themeLabels.toLight : themeLabels.toDark;
    themeToggle.querySelector('.theme-toggle-icon').innerHTML = dark ? moonIcon : sunIcon;
    themeToggle.querySelector('.theme-toggle-label').textContent = dark ? themeLabels.dark : themeLabels.light
}

themeToggle.addEventListener('click', () => {
    const nextTheme = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
    document.documentElement.dataset.theme = nextTheme;
    try {
        localStorage.setItem(themeStorageKey, nextTheme)
    } catch (error) {
    }
    renderThemeToggle()
});

const languagePicker = document.querySelector('.language-picker');
if (languagePicker) {
    languagePicker.before(themeToggle);
    renderThemeToggle()
}
