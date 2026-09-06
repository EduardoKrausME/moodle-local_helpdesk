(() => {
    const pages = {
        ar: 'ar.html',
        de: 'de.html',
        en: 'index.html',
        es: 'es.html',
        es_mx: 'es_mx.html',
        fr: 'fr.html',
        id: 'id.html',
        it: 'it.html',
        ja: 'ja.html',
        pt: 'pt.html',
        pt_br: 'pt_br.html',
        ru: 'ru.html',
        sk: 'sk.html',
        uk: 'uk.html'
    };

    const names = {
        ar: 'العربية', de: 'Deutsch', en: 'English', es: 'Español', es_mx: 'Español (México)',
        fr: 'Français', id: 'Bahasa Indonesia', it: 'Italiano', ja: '日本語', pt: 'Português',
        pt_br: 'Português (Brasil)', ru: 'Русский', sk: 'Slovenčina', uk: 'Українська'
    };

    const bannerText = {
        ar: ['يبدو أن متصفحك مضبوط على', 'عرض هذه الصفحة باللغة'],
        de: ['Ihr Browser scheint auf', 'Diese Seite anzeigen auf'],
        en: ['Your browser appears to be set to', 'View this page in'],
        es: ['Parece que tu navegador está configurado en', 'Ver esta página en'],
        es_mx: ['Parece que tu navegador está configurado en', 'Ver esta página en'],
        fr: ['Votre navigateur semble être configuré en', 'Afficher cette page en'],
        id: ['Browser Anda tampaknya menggunakan', 'Lihat halaman ini dalam'],
        it: ['Il tuo browser sembra essere impostato su', 'Visualizza questa pagina in'],
        ja: ['ブラウザーの言語は', 'このページを次の言語で表示'],
        pt: ['O seu navegador parece estar configurado para', 'Ver esta página em'],
        pt_br: ['Seu navegador parece estar configurado para', 'Ver esta página em'],
        ru: ['Похоже, язык вашего браузера —', 'Открыть эту страницу на'],
        sk: ['Zdá sa, že váš prehliadač je nastavený na', 'Zobraziť túto stránku v jazyku'],
        uk: ['Схоже, мова вашого браузера —', 'Відкрити цю сторінку мовою']
    };


    const menuLabels = {
        ar: ['فتح القائمة', 'إغلاق القائمة'],
        de: ['Menü öffnen', 'Menü schließen'],
        en: ['Open menu', 'Close menu'],
        es: ['Abrir menú', 'Cerrar menú'],
        es_mx: ['Abrir menú', 'Cerrar menú'],
        fr: ['Ouvrir le menu', 'Fermer le menu'],
        id: ['Buka menu', 'Tutup menu'],
        it: ['Apri menu', 'Chiudi menu'],
        ja: ['メニューを開く', 'メニューを閉じる'],
        pt: ['Abrir menu', 'Fechar menu'],
        pt_br: ['Abrir menu', 'Fechar menu'],
        ru: ['Открыть меню', 'Закрыть меню'],
        sk: ['Otvoriť menu', 'Zavrieť menu'],
        uk: ['Відкрити меню', 'Закрити меню']
    };

    const normalize = raw => {
        if (!raw) return null;
        const value = raw.toLowerCase().replace('_', '-');
        if (value === 'pt-br' || value.startsWith('pt-br-')) return 'pt_br';
        if (value === 'es-mx' || value.startsWith('es-mx-')) return 'es_mx';
        const base = value.split('-')[0];
        return Object.prototype.hasOwnProperty.call(pages, base) ? base : null;
    };

    const current = document.documentElement.dataset.language || normalize(document.documentElement.lang) || 'en';
    const select = document.querySelector('.language-select');

    if (select) {
        select.value = current;
        select.addEventListener('change', event => {
            const target = pages[event.target.value];
            if (!target) return;
            window.location.href = target + window.location.hash;
        });
    }

    const menuButton = document.querySelector('.menu-button');
    const navigation = document.querySelector('.header-inner nav');
    const syncMenuLabel = () => {
        if (!menuButton) return;
        const labels = menuLabels[current] || menuLabels.en;
        const open = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-label', open ? labels[1] : labels[0]);
    };

    if (menuButton) {
        syncMenuLabel();
        menuButton.addEventListener('click', syncMenuLabel);
        if (navigation) navigation.querySelectorAll('a').forEach(link => link.addEventListener('click', syncMenuLabel));
    }

    const preferred = (navigator.languages || [navigator.language])
        .map(normalize)
        .find(code => code && pages[code]);

    if (!preferred || preferred === current) return;

    const text = bannerText[preferred] || bannerText.en;
    const banner = document.createElement('div');
    banner.className = 'language-alert';
    banner.setAttribute('role', 'status');
    banner.innerHTML = `<div class="shell language-alert-inner"><span>${text[0]} <strong>${names[preferred]}</strong>.</span><a href="${pages[preferred]}${window.location.hash}">${text[1]} ${names[preferred]} →</a></div>`;
    document.body.insertBefore(banner, document.body.firstChild);
})();
