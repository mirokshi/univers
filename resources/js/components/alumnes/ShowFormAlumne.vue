<template>
    <span>
        <v-form>
            <v-container>
                <div class="headline font-weight-light grey--text">DADES DEL ALUMNE</div>
                <v-layout row wrap>
                    <v-flex>
                        <v-text-field
                            autofocus
                            v-model="name"
                            label="Nom"
                            hint="El nom del alumne..."
                            placeholder="Nom del alumne"
                            :readOnly="true"
                        ></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-text-field
                            autofocus
                            v-model="surname"
                            label="Cognoms"
                            hint="Els cognoms del alumne..."
                            placeholder="Cognoms del alumne"
                            :readOnly="true"
                        ></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-text-field
                            autofocus
                            v-model="birthdate"
                            label="Data naiximente"
                            hint="MM/DD/YY format"
                            :readOnly="true"
                        ></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-text-field
                            autofocus
                            v-model="phone"
                            label="Telefon"
                            hint="Telefon de contacte.."
                            :readOnly="true"
                        ></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-text-field
                            autofocus
                            v-model="age"
                            label="Edat"
                            hint="Edat del alumne"
                            :readOnly="true"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-radio-group :disabled="true" row v-model="sex">
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
                <div class="headline font-weight-light grey--text">CENTRE EDUCATIU</div>
                <v-layout>
                    <v-flex xs12 sm6 >
                        <v-combobox
                            v-model="school"
                            label="Escola"
                            :readOnly="true"
                        >
                        </v-combobox>
                    </v-flex>
                    <v-flex>
                        <v-combobox
                            :readOnly="true"
                            v-model="school_course"
                            label="Selcciona el nivell"
                        >
                        </v-combobox>
                    </v-flex>
                    <v-flex>
                        <v-text-field
                            autofocus
                            v-model="course"
                            label="Curs escolar"
                            hint="Curs escolar"
                            placeholder="Curs escolar"
                            :readOnly="true"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-form>
    </span>
</template>

<script>
    export default {
        name: "ShowFormAlumne",
        data(){
            return{
                name:this.alumne.name,
                surname:this.alumne.surname,
                birthdate:this.alumne.birthdate,
                age:this.alumne.age,
                sex:this.alumne.sex,
                school:this.alumne.school,
                course:this.alumne.course,
                school_course:this.alumne.school_course,
                phone:this.alumne.phone,

            }
        },
        props:{
            alumne:{
                type: Object,
                required: true
            },
            users: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
