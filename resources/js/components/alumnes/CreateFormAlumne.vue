<template>
    <span>
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
                          <v-menu
                              ref="birthdate"
                              v-model="birthdate"
                              :close-on-content-click="false"
                              :nudge-right="40"
                              lazy
                              transition="scale-transition"
                              offset-y
                              full-width
                              max-width="290px"
                              min-width="290px"
                              :error-messages="birthdateErrors"
                              @input="$v.birthdate.$touch()"
                              @blur="$v.birthdate.$touch()"
                          >
                              <v-text-field
                                  slot="activator"
                                  v-model="dateFormatted"
                                  label="Data naixement"
                                  hint="MM/DD/AAAA format"
                                  persistent-hint
                                  @blur="date = parseDate(dateFormatted)"
                              ></v-text-field>
                              <v-date-picker v-model="date" no-title @input="birthdate = false"></v-date-picker>
                          </v-menu>
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
                            v-model="selectSchool"
                            :items="itemSchool"
                            label="Selecciona la escola"
                        >
                        </v-combobox>
                    </v-flex>

                    <v-flex>
                        <v-combobox
                            v-model="selectSchoolCourse"
                            :items="itemSchoolCourse"
                            label="Selcciona el nivell"
                        >
                        </v-combobox>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <div class="headline font-weight-light grey--text">ACTIVITAT</div>
                <v-layout>
                    <v-flex>
                        <alumnes-activitats :alumne="alumnes" :alumne-activitats="alumnes.activitats" :activitats="activitats" @change="refresh(false)"></alumnes-activitats>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <div class="headline font-weight-light grey--text">ENTITAT</div>
                <v-layout>
                    <v-flex>
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
    import { required , minLength,maxLength} from 'vuelidate/lib/validators'
    import AlumnesActivitats from "../AlumnesActivitats";

    export default {
        mixins:[validationMixin],
        validations:{
          name:{required},
          surname:{required},
            sex:{required},
            birthdate:{required},
        },
        name: "CreateFormAlumne",
        components:{
          'alumnes-activitats':AlumnesActivitats
        },
        data(){
            return  {
                date: new Date().toISOString().substr(0, 10),
                dateFormatted: this.formatDate(new Date().toISOString().substr(0, 10)),
                birthdate: false,
                name:'',
                surname: '',
                age:'',
                sex:'',
                phone:'',
                dataAlumnes: this.alumnes,
                dataActivitats:this.activitats,
                dataUsers:this.users,
                loading:false,
                selectSchool:'',
                itemSchool:
                    [
                        'Bitem',
                        'Centre Educatiu',
                        'Centre Educatiu Girona',
                        'CFA',
                        'Cinta Curto',
                        'Consolació',
                        'Daniel Mangrané',
                        'Dertosa',
                        'Despuig',
                        'El Temple',
                        'Ferreries',
                        'IES Ebre',
                        'IES Montsia',
                        'La Mercè',
                        'La Mercè/St Jordi',
                        'Marcel-lí Domingo',
                        'Montsià',
                        'no escolarizat',
                        'PTT',
                        'Remolins',
                        'Sagrada Familia',
                        'Sant Jordi',
                        'St. Llatzer',
                        'Temple',
                        'Teresianes',
                        'UEC',
                        'URV',
                        'Verge de la Cinta',
                        'Altres'
                    ],
                selectSchoolCourse:'',
                itemSchoolCourse:[
                    'P3',
                    'P4',
                    'P5',
                    '1r',
                    '2n',
                    '3r',
                    '5è',
                    '6è',
                    '1r ESO',
                    '2n ESO',
                    '1r BATX',
                    '2n BATX',
                    'CFGM',
                    'CFGMS',
                    'CEE',
                    'CFA',
                    'Universitat',
                    'Altres',
                ]
            }
        },
        props:{
            users: {
                type: Array,
                required: true
            },
            uri:{
                type:String,
                required: true
            },
            activitats:{
                type:Array,
                required: true
            },
            alumnes:{
                type: Array,
                required:true
            },
        },
        methods:{
            selectLoggedUser () {
                if (window.laravel_user) {
                    this.user = this.users.find((user) => {
                        return parseInt(user.id) === parseInt(window.laravel_user.id)

                    })
                }
            },
            reset () {
                this.name = '',
                this.surname = '',
                this.age = '',
                this.selectSchool = '',
                this.selectSchoolCourse='',
                this.age='',
                this.phone='',
                this.sex=''
                this.user_id=''
            },
            add () {
                this.loading = true
                const alumne = {
                    'name': this.name,
                    'surname': this.surname,
                    'birthdate':this.birthdate,
                    'age': this.age,
                    'school': this.selectSchool,
                    'school_course':this.selectSchoolCourse,
                    'sex':this.sex,
                    'phone':this.phone
                }
                window.axios.post(this.uri,alumne).then(response => {
                    this.$snackbar.showMessage('Alumne creat correctament')
                    this.reset()
                    this.$emit('created',response.data)
                    this.loading=false
                    this.$emit('close')

                }).catch(error => {
                    console.log(error);
                    console.log(error.data);
                    this.$snackbar.showError(error.data)
                    this.loading=false
                })
            },
            created(){
                this.selectLoggedUser()
            },
            formatDate: function(date) {
                if (!date) return null
                const [year, month, day] = date.split('-')
                return `${month}/${day}/${year}`
            },
            parseDate (date) {
                if (!date) return null
                const [month, day, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
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
            sexErrors(){
                const errors = []
                if(!this.$v.sex.$dirty){
                    return errors
                }else{ !this.$v.sex.required && errors.push('És obligatori marcar un gènere')}
                return errors
            },
            birthdateErrors(){
                const errors = []
                if(!this.$v.birthdate.$dirty){
                    return errors
                }else{ !this.$v.birthdate.required && errors.push('És obligatori la data de naiximent')}
                return errors
            },
            schoolErrors(){
                const errors = []
                if(!this.$v.school.$dirty){
                    return errors
                }else{ !this.$v.school.required && errors.push('És obligatori la data de naiximent')}
                return errors
            },
            computedDateFormatted () {
                return this.formatDate(this.date)
            },
        },
        watch:{
            date (val) {
                this.dateFormatted = this.formatDate(this.date)
            }
        }
    }
</script>

<style scoped>

</style>
