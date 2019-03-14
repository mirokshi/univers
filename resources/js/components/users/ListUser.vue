<template>
    <span>
        <v-toolbar color="red accent-2">
      <v-toolbar-title class="white--text">Entitats {{total}}</v-toolbar-title>
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
                :items="dataUsers"
                :search="search"
                no-result-text="No hay nigun registro"
                :loading="loading"
                no-data-text="hola"
                rows-per-page-text="Alumnes per página"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                :pagination.sync="pagination"
                class="hidden-md-and-down"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: user}">
                    <tr>
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.admin}}</td>
                        <td>{{user.roles}}</td>
                        <td>{{user.permissions}}</td>
                        <td><span :title="user.created_at_formatted">{{user.created_at_human}}</span></td>
                        <td>
                            <show-user :user="user"></show-user>
                        </td>
                    </tr>
                </template>

            </v-data-table>
        </v-card></span>
</template>

<script>
    import ShowUser from "./ShowUser";

    export default {
        name: "ListUser",
        components:{
            'show-user' : ShowUser
        },
        data (){
            return{
                search:'',
                loading: false,
                dataUsers:this.users,
                selected:'',
                headers:[
                    {text:'ID',value: 'id'},
                    {text:'NOM',value: 'name'},
                    {text:'EMAIL',value: 'email'},
                    {text:'ADMIN',value: 'admin'},
                    {text:'ROLS',value: 'roles'},
                    {text:'PERMISOS',value: 'permissions'},
                    {text:'CREAT',value: 'created_at_timestamp'},
                    {text:'ACCIONS',sorteable:false,value: 'full_search'},
                ],
                pagination:{
                    rowsPerPage:25,
                    sortBy:'id'
                }
            }
        },
        props:{
            users:{
                type: Object,
                required:true
            },
            uri:{
                type:String,
                required: true
            }
        },
        methods:{
            refresh(message = true){
                this.loading = true;
                window.axios.get(this.uri).then(response => {
                    this.dataUsers = response.data;
                    this.loading = false;
                    console.log('OK');
                    if (message) this.$snackbar.showMessage('Entitats actualizats correctament')
                }).catch(error => {
                    console.log(error);
                    this.loading = false
                })
            },
        },
        computed:{
            total(){
                return this.dataUsers.length
            }
        }
    }
</script>

<style scoped>

</style>
