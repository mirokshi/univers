import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import Navigation from './components/Navigation.vue'
import Alumnes from "./components/Alumnes.vue";
import Entitats from "./components/Entitats.vue";


// instalacion vuetify
window.Vue = Vue
window.Vuetify = Vuetify
window.Vue.use(Vuetify)

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
window.Vue.component('navigation', Navigation)
window.Vue.component('alumnes', Alumnes)
window.Vue.component('entitats', Entitats)

// eslint-disable-next-line no-unused-vars
const app = new Vue(AppComponent)
