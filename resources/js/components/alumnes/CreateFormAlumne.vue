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
                          <birthday></birthday>
                          <!--TODO BIRTHDAY-->
                      </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-text-field
                            autofocus
                            v-model="phone"
                            label="Telefon"
                            hint="Telefon de contacte (opcional)"
                        ></v-text-field>
                    </v-flex>
                        <span class="subheading font-weight grey--text">Genere</span>
                    <v-flex xs12 sm6 md3>
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
                            :error-messages="schoolCourseErrors"
                            @input="$v.schoolCourse.$touch()"
                            @blur="$v.schoolCourse.$touch()"
                        ></v-combobox>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <div class="headline font-weight-light grey--text">ACTIVITAT</div>
                <v-layout>
                    <v-flex>
                        <alumnes-activitats v-model="datactivitats" :alumne="alumne" :alumne-activitats="alumne.activitats" :activitats="activitats" @change="refresh(false)"></alumnes-activitats>
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
    import DateBirthday from "../ui/DateBirthday";


    export default {
        mixins:[validationMixin],
        validations:{
            name:{required},
            surname:{required},
            sex:{required},
            birthdate:{required},
            school:{required},
            schoolCourse:{required}
        },
        name: "CreateFormAlumne",
        components:{
          'alumnes-activitats':AlumnesActivitats,
            'birthday': DateBirthday
        },
        data(){
            return  {
                birthdate: false,
                id:this.alumne.id,
                name:this.alumne.name,
                surname:this.alumne.surname,
                sex:this.alumne.sex,
                phone:this.alumne.phone,
                school:this.alumne.school,
                schoolCourse:this.alumne.schoolCourse,
                datactivitats:this.alumne.activitats,
                change:this.alumne.change,
                loading:false,
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
            alumne:{
                type:Object,
                default: function () {
                    return {
                        activitats: []
                    }
                }
            },
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
        },
        methods:{
            selectLoggedUser () {
                if (window.laravel_user) {
                    this.user = this.users.find((user) => {
                        return parseInt(user.id) === parseInt(window.laravel_user.id)
                    })
                }
            },
            reset: function () {
                this.name = '',
                    this.surname = '',
                    this.birthdate = '',
                    this.school = '',
                    this.schoolCourse = '',
                    this.phone = '',
                    this.sex = '',
                    this.datactivitats = '',
                    this.user = ''
            },
             add () {
                this.loading = true
                const alumne = {
                    'name': this.name,
                    'surname': this.surname,
                    'birthdate':this.birthdate,
                    'age': this.age,
                    'school': this.school,
                    'school_course':this.schoolCourse,
                    'sex':this.sex,
                    'phone':this.phone,
                    'user_id': (this.user!==null)? this.user.id :null,
                    'activitats':this.datactivitats,
                    'change': this.change = true
                }
                window.axios.post(this.uri,alumne).then((response) => {
                    this.$snackbar.showMessage('Alumne creat correctament')
                    this.reset()
                    this.$emit('created',response.data)
                    this.loading=false
                    this.$emit('close')
                    this.verifyActivitat()
                }).catch((error) => {
                    console.log(error);
                    console.log(error.data);
                    this.loading=false
                })
            },
            verifyActivitat(){
              this.datactivitats.forEach((activitat) =>{
                  if ((!activitat.name)) {
                      window.axios.post('/api/v1/activitats',{
                          name: activitat
                      }).then((response) => {
                          this.datactivitats[this.datactivitats.indexOf(activitat)] = response.data.id
                      }).catch((error) =>{
                          this.$snackbar.showError(error.message)
                      })
                  }else {
                      this.datactivitats[this.datactivitats.indexOf(activitat)] = activitat.id
                  }
              })
            },
            created(){
                this.selectLoggedUser()
            },
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
                }else{ !this.$v.school.required && errors.push('És obligatori la escola')}
                return errors
            },
            schoolCourseErrors(){
                const errors = []
                if(!this.$v.schoolCourse.$dirty){
                    return errors
                }else{ !this.$v.schoolCourse.required && errors.push('És obligatori el nivell educatiu')}
                return errors
            }
        },
    created() {
        this.user = window.laravel_user
    }
    }
</script>

<style scoped>

</style>
