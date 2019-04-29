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

window.axios.interceptors.response.use(response => response, (error) => {
  if (window.disableInterceptor) return Promise.reject(error);
  if (error && error.response) {
    // Refresh CSRF TOKEN
    // dAMpDXBRrjVJ2TKewouYHgOeozZmW72EiAt5K1jY
    console.log('PROVA ###############');
    if (error.response.status === 419) {
      console.log('419 error intercepted!!!!!');
      return window.helpers.getCsrfToken().then((token) => {
        console.log('TOKEN OBTAINED:');
        console.log(token);
        window.helpers.updateCsrfToken(token);
        console.log('csrf token updated!');
        error.config.headers['X-CSRF-TOKEN'] = token;
        console.log('resend request!!!');
        return window.axios.request(error.config);
      }).catch((e) => {
        console.log("NO s'ha pogut obtenir el CSRFTOKEN");
        console.log(e);
      });
    }
    console.log('1');
    if (error.response.status === 401) {
      window.Vue.prototype.$snackbar.showError("No heu entrat al sistema o ha caducat la sessió. Renviant-vos a l'entrada del sistema");
      const loginUrl = location.pathname ? `/login?back=${location.pathname}` : '/login';
      console.log('Waiting to redirect to:');
      console.log(loginUrl);
      setTimeout(() => { window.location = loginUrl; }, 3000);
      // Break the promise chain -> https://github.com/axios/axios/issues/715
      return new Promise(() => {});
    }
    if (error.response.status === 403) {
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 403!',
        'error',
        'No teniu permisos per realitzar aquesta acció.',
        'center',
      );
    }
    console.log('2');
    if (error.response.status === 422) {
      console.log('%%%%%%%%%%%%%%%%% ERROR DE VALIDACIó %%%%%%%%%%%%%%%');
      console.log(error.response);
      console.log(error.response.data);
      console.log(error.response.data.message);
      console.log(error.response.data.errors);
      window.Vue.prototype.$snackbar.showSnackBar(
        error.response.data.message,
        'error',
        window.helpers.printObject(error.response.data.errors),
        'center',
      );
    }
    console.log('3');
    if (error.response.status === 404) {
      console.log('%%%%%%%%%%%%%%%%% NOT FOUND ERROR %%%%%%%%%%%%%%%');
      console.log(error.response);
      console.log(error.response.data);
      console.log(error.response.data.message);
      console.log(error.response.data.errors);
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 404!',
        'error',
        "No s'ha pogut trobar al servidor el recurs que demaneu.",
        'center',
      );
    }
    if (error.response.status === 405) {
      console.log('%%%%%%%%%%%%%%%%% METHOD NOT ALLOWED FOUND ERROR %%%%%%%%%%%%%%%');
      console.log(error.response);
      console.log(error.response.data);
      console.log(error.response.data.message);
      console.log(error.response.data.errors);
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 405!',
        'error',
        'Tipus de petició HTTP incorrecte.',
        'center',
      );
    }
    if (error.response.status === 500) {
      console.log('%%%%%%%%%%%%%%%%% SERVER ERROR %%%%%%%%%%%%%%%');
      console.log(error.response);
      console.log(error.response.data);
      console.log(error.response.data.message);
      console.log(error.response.data.errors);
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 500!',
        'error',
        'Error inesperat al servidor',
        'center',
      );
    }
    return Promise.reject(error);
  }
  if (error && error.request) {
    window.Vue.prototype.$snackbar.showError("Error de xarxa! No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.");
    window.Vue.prototype.$snackbar.showSnackBar('Error de xarxa!', 'error', "No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.");
    return Promise.reject(error);
  }
});

// Components
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
