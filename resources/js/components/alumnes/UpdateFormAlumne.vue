<template>
    <v-form>
        <v-container>
            <div class="headline font-weight-light grey--text">DADES DEL ALUMNE</div>
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
                        label="Cognoms"
                        hint="Cognoms del alumne"
                        :error-messages="surnameErrors"
                        @input="$v.surname.$touch()"
                        @blur="$v.surname.$touch()"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md3>
                    <!--<data-picker date=""></data-picker>-->
                </v-flex>
                <v-flex xs12 sm6 md3>
                    <v-text-field
                        autofocus
                        v-model="phone"
                        label="Telefon"
                        hint="Telefon de contacte"
                    ></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md3>
                    <span class="subheading font-weight grey--text">Genere</span>
                    <v-radio-group row
                                   v-model="sex"
                                   :error-messages="sexErrors"
                                   @input="$v.sex.$touch()"
                                   @blur="$v.sex.$touch()"
                    >
                        <v-radio
                            label="Home"
                            color="blue"
                            value="home"
                        ></v-radio>
                        <v-radio
                            label="Dona"
                            color="pink"
                            value="dona"
                        ></v-radio>
                        <v-radio
                            label="Altre"
                            color="green"
                            value="altre"
                        ></v-radio>
                    </v-radio-group>
                </v-flex>
            </v-layout>
            <v-divider></v-divider>
            <div class="headline font-weight-light grey--text">CENTRE EDUCATIU</div>
            <v-layout>
                <v-flex xs12 sm6 >
                    <v-combobox
                        v-model="school"
                        :items="itemSchool"
                        :error-messages="schoolErrors"
                        @input="$v.school.$touch()"
                        @blur="$v.school.$touch()"
                        label="Selecciona la escola"
                    ></v-combobox>
                </v-flex>

                <v-flex>
                    <v-combobox
                        v-model="schoolCourse"
                        :items="itemSchoolCourse"
                        label="Selcciona el nivell"
                    ></v-combobox>
                </v-flex>
            </v-layout>
            <v-divider></v-divider>
            <div class="headline font-weight-light grey--text">ACTIVITAT</div>
            <v-layout>
                <v-flex>
                    <alumnes-activitats v-model="datactivitats" :alumne="alumne" :alumne-activitats="alumne.activitats" :activitats="activitats" @change="refresh(false)"></alumnes-activitats>
                    <!--<v-combobox-->
                    <!--v-model="datactivitats"-->
                    <!--:items="activitats"-->
                    <!--&gt;-->
                    <!--</v-combobox>-->
                </v-flex>
            </v-layout>
            <v-divider></v-divider>
            <div class="headline font-weight-light grey--text">ENTITAT</div>
            <v-layout>
                <v-flex>
                    <h4>{{user.name}}</h4>
                </v-flex>
            </v-layout>
        </v-container>
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancelar
            </v-btn>
            <v-btn color="success" @click="update" :disabled="loading" :loading="loading">
                <v-icon class="mr-1">save</v-icon>
                Actualizar
            </v-btn>
        </div>
    </v-form>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required , minLength,maxLength} from 'vuelidate/lib/validators'
    export default {
        mixins:[validationMixin],
        validations:{
          name:{required},
          surname:{required},
          sex:{required},
          bithdate:{required},
          school:{required},
        },
        name: "UpdateFormAlumne",
        data () {
            return {
                name: this.alumne.name,
                loading : false
            }
        },
        props:{
            alumne:{
                type: Object,
                required: true
            },
            users:{
                type: Array,
                required: true
            },
            uri: {
                type: String,
                required: true
            }
        },
        methods:{
            update(){
                this.loading = true
                const newAlumne = {
                    name: this.name
                }
                window.axios.put(this.uri + this.alumne.id, newAlumne).then((response) => {
                    this.$emit('updated', response.data)
                    this.$emit('close')
                    this.loading = false
                }).catch((error) => {
                    this.loading = false
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>
