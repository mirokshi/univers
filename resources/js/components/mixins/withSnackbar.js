import { mapGetters } from 'vuex';
import * as mutations from '../../store/mutation-types';

export default {
  computed: {
    ...mapGetters([
      'snackbarTimeout',
    ]),
  },
  methods: {
    showMessage(message) {
      this.showSnackBar(message, 'success');
    },
    showError(error) {
      this.showSnackBar(error, 'error');
    },
    cleanState() {
      setTimeout(() => {
        this.$store.commit(mutations.SET_SNACKBAR_SHOW, false);
        this.$store.commit(mutations.SET_SNACKBAR_TEXT, '');
        this.$store.commit(mutations.SET_SNACKBAR_SUBTEXT, '');
      }, this.snackbarTimeout);
    },
    showSnackBar(message, color) {
      this.$store.commit(mutations.SET_SNACKBAR_SHOW, true);
      this.$store.commit(mutations.SET_SNACKBAR_COLOR, color || 'error');
      if (typeof message === 'string') {
        this.$store.commit(mutations.SET_SNACKBAR_TEXT, message);
        this.cleanState();
        return;
      }
      if (message.status) {
        this.$store.commit(mutations.SET_SNACKBAR_TEXT, `${message.status} ${message.statusText}`);
        if (message.data && message.data.message) this.$store.commit(mutations.SET_SNACKBAR_SUBTEXT, message.data.message);
        else this.$store.commit(mutations.SET_SNACKBAR_SUBTEXT, message.statusText);
        this.cleanState();
      } else {
        this.$store.commit(mutations.SET_SNACKBAR_TEXT, 'Error de xarxa');
        this.cleanState();
      }
    },
  },
};
