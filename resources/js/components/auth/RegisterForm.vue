<template>
    <v-form action="/register" method="post">
        <v-toolbar dark color="red darken-1">
            <v-toolbar-title>Registrar-se</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text>
            <input
                type="hidden"
                name="_token"
                :value="csrfToken">
            <v-text-field
                prepend-icon="person"
                name="name"
                label="Nom"
                type="text"
                v-model="dataName"
                :error-messages="nameErrors"
                @input="$v.dataEmail.$touch()"
                @blur="$v.dataEmail.$touch()"
            ></v-text-field>
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
                name="Contrasenya"
                label="Contrasenya"
                type="password"
                v-model="dataPassword"
                :error-messages="passwordErrors"
                @input="$v.dataPassword.$touch()"
                @blur="$v.dataPassword.$touch()"
            ></v-text-field>
            <v-text-field
                id="password_confirmation"
                prepend-icon="lock"
                name="password_confirmation"
                label="Confirmació de la contrasenya"
                type="password"
                v-model="dataPassword_confirmation"
                :error-messages="password_confirmationErrors"
                @input="$v.dataPassword_confirmation.$touch()"
                @blur="$v.dataPassword_confirmation.$touch()"
            ></v-text-field>
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
      dataName: this.name,
      dataPassword: this.password,
      dataPassword_confirmation: this.password_confirmation
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
      if (!this.$v.dataName.$dirty) return errors

      !this.$v.dataName.minLength && errors.push('El nom ha de tenir com a mínim 4 lletres.')
      !this.$v.dataName.required && errors.push('El nom és obligatori')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.dataPassword.$dirty) return errors
      !this.$v.dataPassword.minLength && errors.push('La contrasenya ha de tenir com a mínim 6 lletres.')
      !this.$v.dataPassword.required && errors.push('La contrasenya és obligatòria')
      return errors
    },
    password_confirmationErrors () {
      const errors = []
      if (!this.$v.dataPassword_confirmation.$dirty) return errors
      !this.$v.dataPassword_confirmation.sameAsPassword && errors.push('Les contrasenyes no són iguals')
      return errors
    }

  }
}
</script>
