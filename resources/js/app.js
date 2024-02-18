import './bootstrap';
import {createApp} from 'vue'

import App from './App.vue'
// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import router from './router';
import '@mdi/font/css/materialdesignicons.css'
const harperTheme = {
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
    components,
    directives,
    theme: {
        defaultTheme: 'harperTheme',
        themes: {
            harperTheme
        }
    }

});
createApp(App).use(vuetify).use(router).mount("#app")
