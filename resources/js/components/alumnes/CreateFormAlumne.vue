<template>
    <span>
        <v-form>
            <v-container>
                <v-layout row wrap>
                    <v-flex xs12 sm6 >
                        <v-text-field
                            autofocus
                            v-model="name"
                            label="Nom"
                            hint="Nom del alumne"
                            placeholder="Nom del alumne "
                            :error-messages="nameErrors"
                            @input="$v.name.$touch()"
                            @blur="$v.name.$touch()"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 >
                        <v-text-field
                            autofocus
                            v-model="surname"
                            label="Cognon"
                            hint="Cognom del alumne"
                            :error-messages="surnameErrors"
                            @input="$v.surname.$touch()"
                            @blur="$v.surname.$touch()"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 >
                        <v-text-field
                            v-model="age"
                            label="Edat"
                            hint="Edat del alumne"
                            :error-messages="ageErrors"
                            @input="$v.age.$touch()"
                            @blur="$v.age.$touch()"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 >
                        <v-text-field
                            v-model="school"
                            label="Escola"
                            hint="Escola del alumne"
                            :error-messages="schoolErrors"
                            @input="$v.school.$touch()"
                            @blur="$v.school.$touch()"
                        ></v-text-field>
                    </v-flex>
                    <v-flex>
                        <!--TODO ASIGNAR UNA ACTIVIDAD-->
                        <!--<activat-select></activat-select>-->
                    </v-flex>
                    <v-flex xs12 sm6 >
                        <v-radio-group v-model="sex" column>
                            <v-radio
                                color="red"
                                value="Home"
                            ><v-icon>save</v-icon></v-radio>
                            <v-radio
                                label="Dona"
                                color="blue"
                                value="Dona"
                            ></v-radio>
                            <v-radio
                                label="Altre"
                                color="green"
                                value="Altre"
                            ></v-radio>
                        </v-radio-group>
                    </v-flex>
                </v-layout>
            </v-container>
            <div class="text-xs-center">
                <v-btn color="grey" @click="$emit('close')">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    SORTIR
                </v-btn>
                <v-btn color="success" @click="add" :disabled="loading || $v.$invalid" :loading="loading">
                    <v-icon class="mr-1">save</v-icon>
                    GUARDAR
                </v-btn>
            </div>
        </v-form>
    </span>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required } from 'vuelidate/lib/validators'

    export default {
        mixins:[validationMixin],
        validations:{
          name:{required},
          surname:{required},
          age:{required},
          school:{required}
        },
        name: "CreateFormAlumne",
        data(){
            return{
                name:'',
                surname:'',
                age:'',
                school:'',
                sex:'',
                dataAlumnes: this.alumnes,
                loading:false,

            }
        },
        props:{
            uri:{
                type:String,
                default:'/api/v1/alumnes'
            }
        },
        methods:{
            selectLoggedUser () {
                if (window.laravel_user) {
                    this.user = this.users.find((user) => {
                        return parseInt(user.id) === parseInt(window.laravel_user.id)
                    })
                }
            },
            add () {
                this.loading = true
                const alumne = {
                    'name': this.name,
                    'surname': this.surname,
                    'age': this.age,
                    'school': this.school
                }
                window.axios.post(this.uri,alumne).then(response => {
                    this.$snackbar.showMessage('Alumne creat correctament')
                    this.reset()
                    this.$emit('created',response.data)
                    this.loading=false
                    this.$emit('close')
                }).catch(error => {
                    this.$snackbar.showError(error.data)
                    this.loading=false
                })
            },
            created(){
                this.selectLoggedUser()
            }
        },
        computed:{
            nameErrors(){
                const errors = []
                if (!this.$v.name.$dirty) {
                    return errors
                } else { !this.$v.name.required && errors.push('El nom del alumne  és obligatori.') }
                return errors
            },
            surnameErrors(){
                const errors = []
                if (!this.$v.name.$dirty) {
                    return errors
                } else { !this.$v.name.required && errors.push('El cognom del alumne  és obligatori.') }
                return errors
            },
            ageErrors(){
                const errors = []
                if (!this.$v.name.$dirty) {
                    return errors
                } else { !this.$v.name.required && errors.push('La edat del alumne  és obligatori.') }
                return errors
            },
            schoolErrors(){
                const errors = []
                if (!this.$v.name.$dirty) {
                    return errors
                } else { !this.$v.name.required && errors.push('Aquest camp és obligatori.') }
                return errors
            }
        }
    }
</script>

<style scoped>

</style>
