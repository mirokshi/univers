<template>
    <v-form action="/register" method="post">
        <v-toolbar dark color="red darken-1">
            <v-toolbar-title>Registrar-se</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field prepend-icon="person" name="name" label="Nom" type="text" v-model="name" :error-messages="nameErrors" @input="$v.name.$touch()" @blur="$v.name.$touch()"></v-text-field>
            <v-text-field prepend-icon="person" name="email" label="Correu electrònic" type="text" v-model="dataEmail" :error-messages="emailErrors" @input="$v.dataEmail.$touch()" @blur="$v.dataEmail.$touch()"></v-text-field>
            <v-text-field id="password" prepend-icon="lock" name="Contrasenya" label="Password" type="password" v-model="password" :error-messages="passwordErrors" @input="$v.password.$touch()" @blur="$v.password.$touch()"></v-text-field>
            <v-text-field id="password_confirmation" prepend-icon="lock" name="password_confirmation" label="Confirmació de la contrasenya" type="password" v-model="password_confirmation" :error-messages="password_confirmationErrors" @input="$v.password_confirmation.$touch()" @blur="$v.password_confirmation.$touch()"></v-text-field>

        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red lighten-1" class="white--text" type="submit" :disabled="$v.$invalid">Registrar-se</v-btn>
            <v-btn color="red lighten-1"  class="white--text" href="/">Cancel·lar</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>

import { validationMixin } from 'vuelidate'
import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'

export default {
  mixins: [validationMixin],
  validations: {
    name: { required, minLength: minLength(3) },
    dataEmail: { required, email },
    password: { required, minLength: minLength(6) },
    password_confirmation: { sameAsPassword: sameAs('password') }
  },
  name: 'LoginForm',
  data () {
    return {
      dataEmail: this.email,
      name: '',
      password: '',
      password_confirmation: ''
    }
  },
  props: {
    'email': '',
    'csrfToken': ''
  },
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.required && errors.push('Es requereix el correu electrònic')
      !this.$v.dataEmail.email && errors.push('Correu electrònic es invàlid')
      return errors
    },
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors

      !this.$v.name.minLength && errors.push('El nom ha de tenir com a mínim 4 lletres.')
      !this.$v.name.required && errors.push('El nom és obligatori')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.minLength && errors.push('La contrasenya ha de tenir com a mínim 6 lletres.')
      !this.$v.password.required && errors.push('La contrasenya és obligatòria')
      return errors
    },
    password_confirmationErrors () {
      const errors = []
      if (!this.$v.password_confirmation.$dirty) return errors
      !this.$v.password_confirmation.sameAsPassword && errors.push('Les contrasenyes no són iguals')
      return errors
    }

  }
}
</script>
