export default {
  data() {
    return {
      snackbarMessage: '',
      snackbarTimeout: 3000,
      snackbarColor: 'success',
      snackbar: false,
    };
  },
  methods: {
    // SNACKNBAR
    showMessage(message) {
      this.snackbarMessage = message;
      this.snackbarColor = 'success';
      this.snackbar = true;
    },
    showError(error) {
      this.snackbarMessage = error.message;
      this.snackbarColor = 'error';
      this.snackbar = true;
    },
  },
};
