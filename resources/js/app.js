import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import './bootstrap';
import AppComponent from './components/App.vue';
import Navigation from './components/ui/Navigation.vue';
import Sparklines from './components/Sparklines.vue';
import Home from './components/Home.vue';
import LoginForm from './components/auth/LoginForm.vue';
import RegisterForm from './components/auth/RegisterForm.vue';

/** PLUGINS* */
import permissions from './plugins/permissions';
import snackbar from './plugins/snackbar';
import confirm from './plugins/confirm';


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
import ListActivitat from './components/activitats/ListActivitat.vue';
import CreateActivitat from './components/activitats/CreateActivitat.vue';
import CreateFormActivitat from './components/activitats/CreateFormActivitat.vue';

/** USERS * */
import Users from './components/users/Users.vue';
import ListUser from './components/users/ListUser.vue';
import ShowUser from './components/users/ShowUser.vue';


// instalacion vuetify
window.Vue = Vue;
window.Vuetify = Vuetify;
window.Vue.use(Vuetify);


window.Vue.use(permissions);
window.Vue.use(snackbar);
window.Vue.use(confirm);


window.Vue.component('navigation', Navigation);
window.Vue.component('login-form', LoginForm);
window.Vue.component('register-form', RegisterForm);

window.Vue.component('sparklines', Sparklines);
window.Vue.component('home', Home);
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
window.Vue.component('list-activitat', ListActivitat);
window.Vue.component('create-activitat', CreateActivitat);
window.Vue.component('create-form-activitat', CreateFormActivitat);


/** Users * */
window.Vue.component('users', Users);
window.Vue.component('list-user', ListUser);
window.Vue.component('show-user', ShowUser);


// eslint-disable-next-line no-unused-vars
const app = new Vue(AppComponent);
