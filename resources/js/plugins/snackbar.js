import * as mutations from '../store/mutation-types';
import store from '../store';

export default {
  install(Vue, options) {
    // Add Vue instance methods by attaching them to Vue.prototype.
    Vue.prototype.$snackbar = {
      showMessage(message) {
        this.showSnackBar(message, 'success');
      },
      showError(error) {
        // https://kapeli.com/cheat_sheets/Axios.docset/Contents/Resources/Documents/index
        // Handle errors sections
        console.log('showError:');
        console.log(error);
        if (error) {
          console.log('1');
          if (typeof error === 'string') {
            console.log('Error is string');
            this.showSnackBar(error, 'error');
            return;
          }
          if (error.response) {
            console.log('ERROR HAS A RESPONSE!');
            // The request was made and the server responded with a status code
            // that falls out of the range of 2xx
            console.log('error.response.data:');
            console.log(error.response.data);
            console.log('error.response.status:');
            console.log(error.response.status);
            this.showSnackBar(error.response.data, 'error', error.response.status);
            return;
          }
          if (error.request) {
            console.log('ERROR DOES NOT HAVE A RESPONSE ONLY A REQUEST!');
            // The request was made but no response was received
            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
            // http.ClientRequest in node.js
            console.log('Status:');
            if (navigator.onLine) {
              console.log('online');
            } else {
              console.log('offline');
            }
            console.log(error);
            console.log(error.request);
            if (navigator.onLine) {
              this.showSnackBar('Error de xarxa', 'error');
            } else {
              this.showSnackBar('Error de xarxa. Estat de la xarxa: sense connexió', 'error');
            }
            return;
          }
          // Something happened in setting up the request that triggered an Error
          if (error.message) {
            console.log('------------------');
            console.log('Error.message:');
            console.log(error.message);
            console.log('------------------');
            this.showSnackBar(error.message, 'error');
            return;
          }
          console.log('Error');
          this.showSnackBar(error, 'error');
        } else {
          console.log('ERROR IS NULL');
        }
      },
      cleanState() {
        setTimeout(() => {
          store.commit(mutations.SET_SNACKBAR_SHOW, false);
          store.commit(mutations.SET_SNACKBAR_TEXT, '');
          store.commit(mutations.SET_SNACKBAR_SUBTEXT, '');
        }, store.getters.snackbarTimeout);
      },
      showSnackBar(message, color, subtext = null, textAlign = null) {
        console.log('showSnackBar!');
        console.log('Message:');
        console.log(message);
        console.log('color:');
        console.log(color);
        console.log('subtext:');
        console.log(subtext);
        store.commit(mutations.SET_SNACKBAR_SHOW, true);
        store.commit(mutations.SET_SNACKBAR_COLOR, color || 'error');
        if (subtext) store.commit(mutations.SET_SNACKBAR_SUBTEXT, subtext);
        if (textAlign) store.commit(mutations.SET_SNACKBAR_TEXT_ALIGN, textAlign);
        store.commit(mutations.SET_SNACKBAR_TEXT, message);
        this.cleanState();
        // TODO ELIMINAR
        // if (typeof message === 'string') {
        //   console.log('Message is string')
        //   store.commit(mutations.SET_SNACKBAR_TEXT, message)
        //   this.cleanState()
        //   return
        // }
        // if (message.status) {
        //   console.log('other')
        //   store.commit(mutations.SET_SNACKBAR_TEXT, message.status + ' ' + message.statusText)
        //   if (message.data && message.data.message) store.commit(mutations.SET_SNACKBAR_SUBTEXT, message.data.message)
        //   else store.commit(mutations.SET_SNACKBAR_SUBTEXT, message.statusText)
        //   this.cleanState()
        // } else {
        //   store.commit(mutations.SET_SNACKBAR_TEXT, 'Error de xarxa')
        //   this.cleanState()
        // }
      },
    };
  },
};
