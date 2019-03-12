<template>
    <span>
        <v-form>
            <v-container>
                <div class="headline font-weight-light grey--text">DADES ACTIVITAT</div>
                <v-layout row wrap>
                    <v-flex xs12 sm6>
                        <v-text-field
                            v-model="name"
                            label="Nom"
                            hint="Nom de la activitat"
                            placeholder="Nom de la activitat"
                            readonly
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-text-field>
                            v-model="date_start"
                            label="Data Inici"
                            hint="MM/DD/YY format"
                            readonly
                        </v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-text-field>
                            v-model="date_final"
                            label="Data final"
                            hint="MM/DD/YY format"
                            readonly
                        </v-text-field>
                    </v-flex>
                </v-layout>
                <div class="headline font-weight-light grey--text">ALUMNES</div>
                <v-layout>
                    <v-flex>
                        <ul id="alumne">
                            <li v-for="alumne in dataActivitat.alumnes" class="body-2 m-1">
                                {{alumne.name}}
                            </li>
                        </ul>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-form>
    </span>
</template>

<script>
    export default {
        name: "ShowFormActivitat",
        data(){
            return{
                dataActivitat:this.activitat,
                name:this.activitat.name,
                date_start:this.activitat.date_start,
                date_final:this.activitat.date_final
            }
        },
        props:{
            alumnes:{
                type: Object,
                required: true
            },
            users: {
                type: Array,
                required: true
            },
            activitat: {
                type: Array,
                required: true
            },
            activitatAlumnes: {
                type: Array,
                required: true
            }
        }

    }
</script>

<style scoped>
    #alumne{
        list-style: none;
        column-count: 3;
    }

</style>
