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
                    <birthday></birthday>
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
                        label="Selecciona la escola"
                    ></v-combobox>
                </v-flex>

                <v-flex>
                    <v-combobox
                        v-model="school_course"
                        :items="itemSchool_course"
                        :error-messages="school_courseErrors"
                        @input="$v.school_course.$touch()"
                        @blur="$v.school_course.$touch()"
                        label="Selcciona el nivell"

                    ></v-combobox>
                </v-flex>
            </v-layout>
            <v-divider></v-divider>
            <div class="headline font-weight-light grey--text">ACTIVITAT(s)</div>
            <v-layout>
                <v-flex>
                    <alumnes-activitats v-model="datactivitats" :alumne="alumne" :alumne-activitats="alumne.activitats" :activitats="activitats" @change="refresh(false)"></alumnes-activitats>
                </v-flex>
            </v-layout>
            <v-divider></v-divider>
            <div class="headline font-weight-light grey--text">ENTITAT</div>
            <v-layout>
                <v-flex>
                    <!--<h4>{{user.name}}</h4>-->
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
    import { required } from 'vuelidate/lib/validators'
    import AlumnesActivitats from "./AlumnesActivitats";
    import DateBirthday from "../ui/DateBirthday";
    export default {
        mixins:[validationMixin],
        validations:{
            name:{required},
            surname:{required},
            sex:{required},
            bithdate:{required},
            school:{required},
            school_course:{required}
        },
        name: "UpdateFormAlumne",
        components:{
            'alumnes-activitats':AlumnesActivitats,
            'birthday':DateBirthday
        },
        data () {
            return {
                id:this.alumne.id,
                name:this.alumne.name,
                surname:this.alumne.surname,
                sex:this.alumne.sex,
                birthdate: this.alumne.birthdate,
                phone:this.alumne.phone,
                school:this.alumne.school,
                school_course:this.alumne.school_course,
                loading : false,
                datactivitats:this.alumne.activitats,
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
                itemSchool_course:[
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
                type: Object,
                required:true
            },
            users:{
                type: Array,
                required: true
            },
            uri: {
                type: String,
                required: true
            },
            activitats:{
                type:Array,
                required: true
            },
        },
        methods:{
            update(){
                this.loading = true
                const newAlumne = {
                    name: this.name,
                    surname:this.surname,
                    sex:this.sex,
                    phone:this.phone,
                    school:this.school,
                    school_course: this.school_course,
                    // activitats :this.activitats

                }
                window.axios.put(this.uri + this.alumne.id, newAlumne).then((response) => {
                    this.$emit('updated', response.data)
                    this.$emit('close')
                    this.loading = false
                }).catch(() => {
                    console.log(this.alumne.school_course);
                    this.$emit('close')
                    this.loading = false
                })
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
            school_courseErrors(){
                const errors = []
                if(!this.$v.school_course.$dirty){
                    return errors
                }else{ !this.$v.school_course.required && errors.push('És obligatori el nivell educatiu')}
                return errors
            }
        }
    }
</script>

<style scoped>

</style>
