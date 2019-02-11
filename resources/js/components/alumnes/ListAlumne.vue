<template>
    <span>
        <v-toolbar color="red accent-2">
      <v-toolbar-title class="white--text">Alumnes {{total}}</v-toolbar-title>
      <v-spacer></v-spacer>

        <v-btn icon dark class="white--text">
            <v-icon>settings</v-icon>
        </v-btn>
        <v-btn icon dark class="white--text" @click="refresh" :loading="loading" :disabled="loading">
            <v-icon>refresh</v-icon>
        </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
            <v-layout row wrap>
                <v-flex xs12>
                    <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Búsqueda"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-flex>
            </v-layout>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="dataAlumnes"
                :search="search"
                no-result-text="No hay nigun registro"
                :loading="loading"
                no-data-text=""
                rows-per-page-text="Alumnos per página"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                :pagination.sync="pagination"
                class="hidden-md-and-down"
            >
                <v-progress-linear slot="progess" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: alumne}">
                    <tr>
                        <td>{{alumne.id}}</td>
                        <td>{{alumne.name}}</td>
                        <td>{{alumne.surname}}</td>
                        <td>{{alumne.birthdate}}</td>
                        <td>{{alumne.age}}</td>
                        <td>{{alumne.school}}</td>
                        <td>{{alumne.school_course}}</td>
                        <td>{{alumne.sex}}</td>
                        <td><span :title="alumne.created_at_formatted">{{alumne.created_at_human}}</span></td>
                    </tr>
                </template>
            </v-data-table>
        </v-card></span>
</template>

<script>
    export default {
        name:'ListAlumne',
        data(){
            return {
                search:'',
                loading: false,
                dataAlumnes: this.alumnes,
                createDialog: false,
                alumneBeingCreated: {},
                items:[
                    'Home',
                    'Dona',
                    'Altres'
                ],
                headers :[
                    {text:'ID', value: 'id'},
                    {text:'NOM', value: 'name'},
                    {text:'COGNOM', value: 'surname'},
                    {text: 'DATA DE NAIXIMENT', value:'birthdate'},
                    {text:'EDAT', value: 'age'},
                    {text:'COL.LEGI', value: 'school'},
                    {text:'CURS', value: 'school_course'},
                    {text:'SEXE', value: 'sex'},
                    {text:'CREAT', value:'created_at_timestamp'},
                ],
                pagination:{
                    rowsPerPage:25
                }
            }
        },
        props:{
            alumnes:{
                type: Array,
                required:true
            },
            uri:{
                type: String,
                required: true
            }
        },
        watch:{
            alumnes(newAlumne)
            {
                this.dataAlumnes = newAlumne
            }
        },

        methods:{
            refresh(message = true){
                this.loading = true
                window.axios.get(this.uri).then(response => {
                    this.dataAlumnes = response.data
                    this.loading = false
                    if (message) this.$snackbar.showMessage('Alumnes actualizats correctament')
                }).catch(error => {
                    console.log(error)
                    this.loading = false
                })
            },
        },
        computed:{
            total(){
                return this.dataAlumnes.length
            }
        }
    }

</script>

<style scoped>

</style>
