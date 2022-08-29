import { createApp } from 'vue';
import axios from 'axios';
import vuex from 'vuex';

import Directives from './_directives/_index.js';
import Filters from './_filters/_index.js';

import cUI from './_components/UI/_index.js';
import cTools from './_components/Tools/_index.js';

import { store } from './_store/_index.js'

import magic from './magic';

window.app = createApp({});

/**
 * Магические строки
 */
window.app.config.globalProperties.magic = magic;

/**
 *  Глобальные функции
 */
window.app.newNoty = () => null;
window.app.addTip = () => null;


/**
 * Глобальные модули
 */
window.app.config.globalProperties.axios = axios;
window.app.config.globalProperties.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.vuex = vuex;
/**
 * Подключение хранилищ
 */
window.app.use(store);
/**
 * Директивы
 */
Directives.forEach(directive => {
  window.app.directive(
      directive.name,
      directive,
  );
})
/**
 * Фильтры
 */
window.app.config.globalProperties.$filters = Filters;


/**
 * Компоненты
 */

/* Компоненты полей ввода */
cUI.forEach(ui => {
  window.app.component(
      ui.name,
      ui,
  );
});
/* Компоненты-инструменты, расширяют Blade */
cTools.forEach(tool => {
  window.app.component(
      tool.name,
      tool,
  );
});