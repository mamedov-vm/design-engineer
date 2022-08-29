import { createStore } from 'vuex';

import { baseStore } from './baseStore';

export const store = createStore({
  modules: {
    base: baseStore,
  },
})