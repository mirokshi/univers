<template>
    <v-form action="/login" method="POST">
        <v-toolbar dark color="red darken-1">
            <v-toolbar-title>Iniciar Sessió</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    prepend-icon="person"
                    name="email"
                    label="Correu electrònic"
                    type="text"
                    v-model="dataEmail"
                    :error-messages="emailErrors"
                    @input="$v.dataEmail.$touch()"
                    @blur="$v.dataEmail.$touch()"
            ></v-text-field>
            <v-text-field
                    id="password"
                    prepend-icon="lock"
                    name="password"
                    label="Contrasenya"
                    type="password"
                    v-model="password"
                    :error-messages="passwordErrors"
                    @input="$v.password.$touch()"
                    @blur="$v.password.$touch()"
            ></v-text-field>
            <span>No tens usuari? <a href="/register">Registrar-se!</a></span>
        </v-card-text>
        <v-divider light></v-divider>
        <v-card-actions>
            <v-btn color="red lighten-1" type="submit" disable="true" class="white--text" :disabled="$v.$invalid">Inicia sessió</v-btn>
            <v-btn color="red lighten-1"  class="white--text" href="/">cancel·la</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, email, minLength } from 'vuelidate/lib/validators'

export default {
  name: 'LoginForm',
  mixins: [validationMixin],
  validations: {
    dataEmail: { email, required },
    password: { required, minLength: minLength(6) }
  },
  data () {
    return {
      dataEmail: this.email,
      password: ''
    }
  },
  props: ['email', 'csrfToken'],
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) {
        return errors
      } else { !this.$v.dataEmail.email && errors.push('Correu electrònic es invàlid') }
      !this.$v.dataEmail.required && errors.push('Es requereix correu electrònic')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.required && errors.push('Es requereix contrasenya')
      !this.$v.password.minLength && errors.push('La contrasenya ha de ser superior a 6 digits')
      return errors
    }
  }
}
</script>
