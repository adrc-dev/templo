import { createI18n } from 'vue-i18n';

import en from './locales/en.json';
import es from './locales/es.json';
import pt from './locales/pt.json';

const inertiaPage = document.querySelector('[data-page]')?.getAttribute('data-page');
const page = inertiaPage ? JSON.parse(inertiaPage) : {};
const locale = page.props?.locale || navigator.language.slice(0, 2) || 'en';

export const i18n = createI18n({
    legacy: false,
    locale,
    fallbackLocale: 'en',
    messages: {
        es,
        en,
        pt,
    },
});
