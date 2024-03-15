import './bootstrap';
import {createApp,markRaw} from 'vue'

import App from './App.vue'
import { createPinia } from 'pinia';
const pinia = createPinia()
pinia.use(({ store }) => {
    store.router = markRaw(router)
})
// Vuetify
import 'vuetify/styles'
import '../css/app.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import * as labsComponents from 'vuetify/labs/components'
import router from './router';
import '@mdi/font/css/materialdesignicons.css'
const loreTheme = {
    dark: false,
    colors: {
        background: '#F5F5F5FF',
        surface: '#FFFFFF',
        primary: '#657686',
        secondary: '#10E49C',
        error: '#F14668',
        info: '#3E8ED0',
        success: '#48C78EFF',
        warning: '#ffdd80',
        lorevera: '#EC878D',
    }
}
const vuetify = createVuetify({
    components:{
        ...components,
        ...labsComponents
    },
    directives,
    theme: {
        defaultTheme: 'loreTheme',
        themes: {
            loreTheme
        }
    }

});
createApp(App).use(pinia).use(vuetify).use(router).mount("#app")

axios.interceptors.request.use(
    config => {
        const token = localStorage.getItem('authToken');
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    error => {
        Promise.reject(error)
    });