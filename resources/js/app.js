import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import VueTimeago from 'vue-timeago';
import TreeView from 'vue-json-tree-view';
import DateFnsLocalCa from 'date-fns/locale/ca';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import './bootstrap';
import ca from './i18n/ca';
import AppComponent from './components/App.vue';
import Navigation from './components/Navigation.vue';
import NavigationRight from './components/NavigationRight.vue'
import Toolbar from './components/Toolbar.vue'
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

/** OTHERS * */
import SnackBarComponent from './components/ui/SnackBarComponent.vue';
import helpers from './utils/helpers';


// ABANS
import 'typeface-montserrat/index.css';
import 'typeface-roboto/index.css';
import '@fortawesome/fontawesome-free/css/all.css';
import 'font-awesome/css/font-awesome.min.css';


// instalacion vuetify
window.Vue = Vue;
window.eventBus = new Vue();
window.Vue.use(snackbar);
window.Vue.use(permissions);
window.Vue.use(confirm);
window.Vue.use(TreeView);
window.Vue.use(VueTimeago, {
  locale: 'ca', // Default locale
  locales: {
    ca: DateFnsLocalCa,
  },
});

window.helpers = helpers;
window.disableInterceptor = false;

window.axios.interceptors.response.use(response => response, (error) => {
  console.log('ERROR INTERCEPTED!!!!!!!!!!!!!!');
  console.log(error);
  if (window.disableInterceptor) {
    console.log('INTERCEPTOR DISABLED!');
    return Promise.reject(error);
  }
  console.log('INTERCEPTOR ENABLED!');
  if (error && error.response) {
    // Refresh CSRF TOKEN
    // dAMpDXBRrjVJ2TKewouYHgOeozZmW72EiAt5K1jY
    console.log('############3 ERROR RESPONSE EXISTS ###############');
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
      if (location.pathname !== '/login') {
        window.Vue.prototype.$snackbar.showError("No heu entrat al sistema o ha caducat la sessió. Renviant-vos a l'entrada del sistema");
        const loginUrl = location.pathname ? `/login?back=${location.pathname}` : '/login';
        console.log('Waiting to redirect to:');
        console.log(loginUrl);
        setTimeout(() => { window.location = loginUrl; }, 3000);
      }
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
      let data = '';
      if (error.response.data.errors) {
        data = window.helpers.printObject(error.response.data.errors);
      }
      window.Vue.prototype.$snackbar.showSnackBar(
        error.response.data.message,
        'error',
        data,
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
    console.log('ERROR EXISTS BUT NO RESPONSE!');
    window.Vue.prototype.$snackbar.showError("Error de xarxa! No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.");
    window.Vue.prototype.$snackbar.showSnackBar('Error de xarxa!', 'error', "No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.");
    return Promise.reject(error);
  }
});

// Components
window.Vue.component('navigation', Navigation);
window.Vue.component('navigation-right', NavigationRight)
window.Vue.component('toolbar', Toolbar)
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


window.Vue.component('snackbar', SnackBarComponent);

window.Vuetify = Vuetify;
window.Vue.use(window.Vuetify, {
  lang: {
    locales: { ca },
    current: 'ca',
  },
  theme: {
    primary: {
      base: '#911111',
      lighten1: '#D64545',
      lighten2: '#E66A6A',
      lighten3: '#F29B9B',
      lighten4: '#FACDCD',
      lighten5: '#FFEEEE',
      darken1: '#BA2525',
      darken2: '#A61B1B',
      darken3: '#780A0A',
      darken4: '#610404',
    },
    secondary: {
      base: '#CB6E17',
      lighten1: '#F7C948',
      lighten2: '#FADB5F',
      lighten3: '#FCE588',
      lighten4: '#FFF3C4',
      lighten5: '#FFFBEA',
      darken1: '#F0B429',
      darken2: '#DE911D',
      darken3: '#B44D12',
      darken4: '#8D2B0B',
    },
    accent: {
      base: '#507712',
      lighten1: '#94C843',
      lighten2: '#ABDB5E',
      lighten3: '#C7EA8F',
      lighten4: '#E2F7C2',
      lighten5: '#F2FDE0',
      darken1: '#7BB026',
      darken2: '#63921A',
      darken3: '#42600C',
      darken4: '#2B4005',
    },
    error: {
      base: '#BA2525',
      lighten1: '#D64545',
      lighten2: '#E66A6A',
      lighten3: '#F29B9B',
      lighten4: '#FACDCD',
      lighten5: '#FFEEEE',
      darken1: '#A61B1B',
      darken2: '#911111',
      darken3: '#780A0A',
      darken4: '#610404',
    },
    // Taken from palete 3
    success: {
      base: '#27AB83',
      lighten1: '#3EBD93',
      lighten2: '#65D6AD',
      lighten3: '#8EEDC7',
      lighten4: '#C6F7E2',
      lighten5: '#EFFCF6',
      darken1: '#199473',
      darken2: '#147D64',
      darken3: '#0C6B58',
      darken4: '#014D40',
    },
    grey: {
      base: '#627D98',
      lighten1: '#829AB1',
      lighten2: '#9FB3C8',
      lighten3: '#BCCCDC',
      lighten4: '#D9E2EC',
      lighten5: '#F0F4F8',
      darken1: '#486581',
      darken2: '#334E68',
      darken3: '#243B53',
      darken4: '#102A43',
    },
  },
  iconfont: ['fa', 'fa4', 'md'],
});

// eslint-disable-next-line no-unused-vars
const app = new  window.Vue(AppComponent);
