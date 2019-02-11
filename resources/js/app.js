import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import './bootstrap';
import AppComponent from './components/App.vue';
import Navigation from './components/Navigation.vue';
import Sparklines from './components/Sparklines.vue';

/* ENTITATS */
import Entitats from './components/Entitats.vue';

/* ALUMNES */
import ListAlumne from './components/alumnes/ListAlumne.vue';
import Alumnes from './components/alumnes/Alumnes.vue';
import CreateAlumne from './components/alumnes/CreateAlumne.vue';


// PLUGINS
import permissions from './plugins/permissions';
import snackbar from './plugins/snackbar';
import confirm from './plugins/confirm';
import CreateFormAlumne from './components/alumnes/CreateFormAlumne.vue';

// instalacion vuetify
window.Vue = Vue;
window.Vuetify = Vuetify;
window.Vue.use(Vuetify);


window.Vue.use(permissions);
window.Vue.use(snackbar);
window.Vue.use(confirm);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

window.Vue.component('navigation', Navigation);
window.Vue.component('alumnes', Alumnes);
window.Vue.component('entitats', Entitats);
window.Vue.component('sparklines', Sparklines);
window.Vue.component('create-alumne', CreateAlumne);
window.Vue.component('list-alumne', ListAlumne);
window.Vue.component('create-form-alumne', CreateFormAlumne);
// eslint-disable-next-line no-unused-vars
const app = new Vue(AppComponent);
