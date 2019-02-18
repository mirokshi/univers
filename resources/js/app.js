import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import './bootstrap';
import AppComponent from './components/App.vue';
import Navigation from './components/ui/Navigation.vue';
import Sparklines from './components/Sparklines.vue';
import LoginForm from './components/auth/LoginForm.vue';
import RegisterForm from './components/auth/RegisterForm.vue';


/** ENTITATS * */
import Entitats from './components/Entitats.vue';

/** ALUMNES * */
import ListAlumne from './components/alumnes/ListAlumne.vue';
import Alumnes from './components/alumnes/Alumnes.vue';
import CreateAlumne from './components/alumnes/CreateAlumne.vue';
import CreateFormAlumne from './components/alumnes/CreateFormAlumne.vue';
import ShowAlumne from './components/alumnes/ShowAlumne.vue';
import ShowFormAlumne from './components/alumnes/ShowFormAlumne.vue';
import DestroyAlumne from './components/alumnes/DestroyAlumne.vue';

/** ACTIVITATS* */
import Activitats from './components/activitats/Activitats.vue';

/** PLUGINS* */
import permissions from './plugins/permissions';
import snackbar from './plugins/snackbar';
import confirm from './plugins/confirm';


// instalacion vuetify
window.Vue = Vue;
window.Vuetify = Vuetify;
window.Vue.use(Vuetify);


window.Vue.use(permissions);
window.Vue.use(snackbar);
window.Vue.use(confirm);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

window.Vue.component('navigation', Navigation);
window.Vue.component('login-form', LoginForm);
window.Vue.component('register-form', RegisterForm);

window.Vue.component('entitats', Entitats);
window.Vue.component('sparklines', Sparklines);
/** Alumnes* */
window.Vue.component('alumnes', Alumnes);
window.Vue.component('list-alumne', ListAlumne);
window.Vue.component('create-alumne', CreateAlumne);
window.Vue.component('create-form-alumne', CreateFormAlumne);
window.Vue.component('show-alumne', ShowAlumne);
window.Vue.component('show-form-alumne', ShowFormAlumne);
window.Vue.component('destroy-alumne', DestroyAlumne);

/** Activitat* */
window.Vue.component('activitats', Activitats);
// eslint-disable-next-line no-unused-vars
const app = new Vue(AppComponent);
