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
                no-data-text="hola"
                rows-per-page-text="Alumnos per página"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                :pagination.sync="pagination"
                class="hidden-md-and-down"
                select-all
                v-model="selected"
                item-key="id"
            >
                <v-progress-linear slot="progess" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: alumne}">
                    <tr>
                        <td>
                            <v-checkbox
                                :input-value="alumne.selected"
                                primary
                                hide-details
                            ></v-checkbox>
                        </td>
                        <td>{{alumne.id}}</td>
                        <td>{{alumne.user_name}}</td>
                        <td>{{alumne.name}}</td>
                        <td>{{alumne.surname}}</td>
                        <td>{{alumne.sex}}</td>
                        <td>{{alumne.birthdate}}</td>
                        <td>{{alumne.age}}</td>
                        <td>{{alumne.school}}</td>
                        <td>{{alumne.course}}</td>
                        <td>{{alumne.school_course}}</td>
                        <td><span :title="alumne.created_at_formatted">{{alumne.created_at_human}}</span></td>
                        <td>
                            <show-alumne :users="users" :alumne="alumne"></show-alumne>
                            <destroy-alumne :alumne="alumne" @removed="removeAlumne" :uri="uri"></destroy-alumne>
                        </td>
                    </tr>
                </template>

            </v-data-table>
        </v-card></span>
</template>

<script>
    import ShowAlumne from "./ShowAlumne";
    import DestroyAlumne from "./DestroyAlumne";

    export default {
        name:'ListAlumne',
        components:{
          'show-alumne' :ShowAlumne,
          'destroy-alumne':DestroyAlumne
        },
        data(){
            return {
                search:'',
                course:'',
                loading: false,
                dataAlumnes: this.alumnes,
                dataUsers: this.users,
                selected:'',
                headers :[
                    {text:'ID', value: 'id'},
                    {text:'USER', value: 'user_id'},
                    {text:'NOM', value: 'name'},
                    {text:'COGNOMS', value: 'surname'},
                    {text:'SEXE', value: 'sex'},
                    {text:'DATA DE NAIXIMENT', value:'birthdate'},
                    {text:'EDAT', value: 'age'},
                    {text:'CENTRE EDUCATIU', value: 'school'},
                    {text:'CURS', value:'course'},
                    {text:'NIVELL', value: 'school_course'},
                    {text:'CREAT', value:'created_at_timestamp'},
                    {text:'ACCIONS',sorteable:false, value:'full_search'},
                ],
                pagination:{
                    rowsPerPage:25,
                    sortBy:'name'
                }
            }
        },
        props:{
            alumnes:{
                type: Array,
                required:true
            },
            users: {
                type: Array,
                required: true
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
                    console.log('ok');
                    if (message) this.$snackbar.showMessage('Alumnes actualizats correctament')
                }).catch(error => {
                    console.log(error)
                    this.loading = false
                })
            },
            removeAlumne(alumne){
                this.dataAlumnes.splice(this.dataAlumnes.indexOf(alumne),1)
            }
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
