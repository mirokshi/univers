<template>
    <span>
        <v-toolbar color="red accent-2">
      <v-toolbar-title class="white--text">Activitats {{total}}</v-toolbar-title>
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
                :items="dataActivitats"
                :search="search"
                no-result-text="No hay nigun registro"
                :loading="loading"
                no-data-text="hola"
                rows-per-page-text="Alumnes per página"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                :pagination.sync="pagination"
                class="hidden-md-and-down"

            >
                <v-progress-linear slot="progess" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: activitat}">
                    <tr>
                        <td>{{activitat.id}}</td>
                        <td>{{activitat.name}}</td>
                        <td>{{activitat.category}}</td>
                        <td>{{activitat.date_start}}</td>
                        <td>{{activitat.date_final}}</td>
                        <td>{{activitat.course}}</td>
                        <td><span :title="activitat.created_at_formatted">{{activitat.created_at_human}}</span></td>
                        <td>
                            <show-activitat :users="users" :activitat="activitat" :alumnes="alumnes"></show-activitat>
                            <destroy-activitat :activitat="activitat" @removed="removeActivitat" :uri="uri"></destroy-activitat>
                        </td>
                    </tr>
                </template>

            </v-data-table>
        </v-card></span>
</template>

<script>
    import ShowActivitat from "./ShowActivitat";
    import DestroyActivitat from "./DestroyActivitat";

    export default {
        name: "ListActivitat",
        components:{
            'show-activitat' : ShowActivitat,
            'destroy-activitat' :DestroyActivitat
        },
        data (){
            return{
                search :'',
                loading: false,
                dataActivitats: this.activitats,
                dataUsers: this.users,
                headers:[
                    {text:'ID',value: 'id'},
                    {text:'NOM',value: 'name'},
                    {text: 'CATEGORIA', value: 'category'},
                    {text:'DATA INICI',value: 'date_start'},
                    {text:'DATA FINAL',value: 'date_final'},
                    {text:'CURS',value: 'course'},
                    {text:'CREAT',value: 'created_at_timestamp'},
                    {text:'ACCIONS',sorteable: false,value: 'full_search'},
                ],
                pagination:{
                    rowsPerPage:25,
                    sortBy:'id'
                }
            }
        },
        props:{
            activitats:{
                type:Array,
                required:true
            },
            users:{
                type:Array,
                required: true
            },
            uri:{
                type: String,
                required: true
            },
            alumnes:{
                type:Array,
                required:true
            }
        },
        watch:{
            activitats(newActivitat){
                this.dataActivitats = newActivitat
            }
        },
        methods:{
            refresh(message = true){
                this.loading = true;
                window.axios.get(this.uri).then(response => {
                    this.dataActivitats = response.data;
                    this.loading = false;
                    console.log('OK');
                    if (message) this.$snackbar.showMessage('Activitats actualizats correctament')
                }).catch(error => {
                    console.log(error);
                    this.loading = false
                })
            },
            removeActivitat(actvitat){
                this.dataActivitats.splice(this.dataActivitats.indexOf(actvitat),1)
            }
        },
        computed:{
            total(){
                return this.dataActivitats.length
            }
        }
    }
</script>

<style scoped>

</style>
