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
                            label="Nom*"
                            hint="Nom del alumne"
                            placeholder="Nom del alumne"
                            :error-messages="nameErrors"
                            @input="$v.name.$touch()"
                            @blur="$v.name.$touch()"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 >
                        <v-text-field
                            autofocus
                            v-model="surname"
                            label="Cognoms*"
                            hint="Cognoms del alumne"
                            placeholder="Cognoms del alumne"
                            :error-messages="surnameErrors"
                            @input="$v.surname.$touch()"
                            @blur="$v.surname.$touch()"
                        ></v-text-field>
                    </v-flex>
                      <v-flex xs12 sm6 md3>
                          <birthday v-model="birthdate"
                                    :error-messages="birthdateErrors"
                                    @input="$v.birthdate.$touch()"
                                    @blur="$v.birthdate.$touch()"
                          ></birthday>
                      </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-text-field
                            autofocus
                            v-model="phone"
                            label="Telefon"
                            hint="Telefon de contacte (opcional)"
                        ></v-text-field>
                    </v-flex>
                        <span class="subheading font-weight grey--text">Genere*</span>
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
                                value="Home"
                            ></v-radio>
                            <v-radio
                                label="Dona"
                                color="pink"
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
                            label="Selecciona la escola*"
                            placeholder="Centre educatiu"
                        ></v-combobox>
                    </v-flex>

                    <v-flex>
                        <v-combobox
                            v-model="school_course"
                            :items="itemSchoolCourse"
                            label="Selcciona el nivell*"
                            placeholder="Nivell educatiu"
                            :error-messages="schoolCourseErrors"
                            @input="$v.school_course.$touch()"
                            @blur="$v.school_course.$touch()"
                        ></v-combobox>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <div class="headline font-weight-light grey--text">ACTIVITAT</div>
                <v-layout>
                    <v-flex>
                        <!--<alumnes-activitats-chip-->
                            <!--@updated="verifyActivitats"-->
                            <!--v-model="datactivitats"-->
                            <!--:selected-activitats="datactivitats"-->
                            <!--:alumne="alumne"-->
                            <!--:activitats="activitats"-->
                            <!--@change="refresh(false)"></alumnes-activitats-chip>-->
                        <v-autocomplete v-model="alumne_activitat" label="Activitats" :items="dataActivitats" item-text="name" item-value="id" multiple chips></v-autocomplete>
                    </v-flex>
                </v-layout>
                <v-divider></v-divider>
                <div class="headline font-weight-light grey--text">ENTITAT</div>
                <v-layout>
                    <v-flex>
                        <v-autocomplete v-model="user_id" label="Usari o Entitat" :items="dataUsers" item-text="name" item-value="id"></v-autocomplete>
                    </v-flex>
                </v-layout>
            </v-container>
            <span class="subheading font-weight-bold blue--text">Els camps amb (*) són obligatoris</span>
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
    import { required} from 'vuelidate/lib/validators'
    import DateBirthday from "../ui/DateBirthday";
    import AlumnesActivitatsChip from "./AlumnesActivitatsChip";

    export default {
        mixins:[validationMixin],
        validations:{
            name:{required},
            surname:{required},
            sex:{required},
            birthdate:{required},
            school:{required},
            school_course:{required}
        },
        name: "CreateFormAlumne",
        components:{
          'alumnes-activitats-chip':AlumnesActivitatsChip,
            'birthday': DateBirthday
        },
        data(){
            return  {
                id:'',
                name:'',
                surname:'',
                birthdate: '',
                age: '',
                sex:'',
                phone:'',
                school:'',
                school_course:'',
                alumne_activitat:[],
                user_id: '',
                dataActivitats: this.activitats,
                dataUsers:this.users,
                change:true,
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
            users: {
                type: Array,
                required: true
            },
            uri:{
                type:String,
                required: true,
                default: '/api/v1/alumnes'
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
                    this.age='',
                    this.school = '',
                    this.school_course = '',
                    this.phone = '',
                    this.sex = '',
                    this.alumne_activitat = '',
                    this.user_id = ''
            },
             add () {
                 this.loading = true
                 const alumne = {
                     'name': this.name,
                     'surname': this.surname,
                     'birthdate': this.birthdate,
                     'age': this.calcYear(this.birthdate),
                     'school': this.school,
                     'school_course': this.school_course,
                     'sex': this.sex,
                     'phone': this.phone,
                     'user_id': this.user_id,
                     'activitats': this.alumne_activitat,
                     'change': this.change
                 }
                 window.axios.post(this.uri,alumne).then((response) => {

                     this.$snackbar.showMessage('Alumne creat correctament')
                     this.reset()
                     this.$emit('created',response.data)
                     this.loading = false
                     this.$emit('close')
                 }).catch(()=>{
                     this.reset()
                     this.loading = false
                     this.$emit('close')
                 })
             },
            created(){
                this.selectLoggedUser()
            },
            calcYear(date) {
                if (!date) return null;
                const yearBirthdate = date.split("/")
                const dt=new Date()
                const age = yearBirthdate[2]-dt.getFullYear()
                if (age<0){
                    return Math.abs(age)
                } else {
                    return age
                }

            }
        },
        watch:{
            age(val){
                this.age=this.calcYear(this.birthdate)
                console.log(this.age);
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
                }else{ !this.$v.school.required && errors.push('És obligatori la escola')}
                return errors
            },
            schoolCourseErrors(){
                const errors = []
                if(!this.$v.school_course.$dirty){
                    return errors
                }else{ !this.$v.school_course.required && errors.push('És obligatori el nivell educatiu')}
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
