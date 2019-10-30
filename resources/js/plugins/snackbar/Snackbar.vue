<template>
    <v-snackbar :timeout="timeout" :color="color" v-model="show" top right vertical>
        <h1>{{type}}</h1>
        {{ message }}
        <v-btn flat @click="show=false">CERRAR</v-btn>
    </v-snackbar>
</template>

<script>
import EventBus from '../../eventBus'
export default {
  data () {
    return {
        type:'text',
      message: 'Prova',
      timeout: 4000,
      color: 'success',
      show: false
    }
  },
  methods: {
    showMessage (message) {
      this.type = 'Notificació'
      this.message = message
      this.color = 'success'
      this.show = true
    },
    showError (error) {
        this.type = 'Error'
        this.message = error
        this.color = 'error'
        this.show = true
      console.log(error.response)
    },
     showSnackbar(type, message){
        this.type = type
         this.message = message
         this.color = 'error'
         this.show = true
     }
  },
  mounted () {
    EventBus.$on('showSnackbarError', (error) => {
      this.showError(error)
    })
    EventBus.$on('showSnackbarMessage', (message) => {
      this.showMessage(message)
    })
      EventBus.$on('showSnackbarPersonalized',(type,message) =>{
        this.showSnackbar(type,message)
      })
  }
}
</script>
