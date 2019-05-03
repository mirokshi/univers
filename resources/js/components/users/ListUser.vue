<template>
    <span>
        <v-toolbar color="red accent-2">
      <v-toolbar-title class="white--text">Entitats {{total}}</v-toolbar-title>
      <v-spacer></v-spacer>
        <v-btn icon dark class="white--text" @click="refresh" :loading="loading" :disabled="loading">
            <v-icon>refresh</v-icon>
        </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
            <v-layout row wrap>
                <v-flex>
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
                no-data-text="No hay datos disponibles"
                rows-per-page-text="Entitats per página"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                :loading="loading"
                :pagination.sync="pagination"
                class="hidden-md-and-down"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: user}">
                    <tr>
                        <td>{{user.id}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>
                            <toggle
                            :value="user.admin"
                            uri="/api/v1/admin_user"
                            active-text="Admin"
                            unactive-text="No admin"
                            snackbar-message-true="El usuari es admin"
                            snackbar-message-false="El usuari ia no es admin"
                            :resource="user"
                            @change="refresh(false)"
                            ></toggle>
                        </td>
                        <td>{{user.roles}}</td>
                        <td>{{user.permissions}}</td>
                        <td><span :title="user.created_at_formatted">{{user.created_at_human}}</span></td>
                        <td>
                            <!--<show-user :user="user"></show-user>-->
                            <destroy-user
                                :user="user"
                                @removed="removeUser"
                                :uri="uri"
                            ></destroy-user>
                        </td>
                    </tr>
                </template>

            </v-data-table>
        </v-card></span>
</template>

<script>
    import ShowUser from "./ShowUser";
    import Toggle from "../helper/Toggle";
    import DestroyUser from "./DestroyUser";

    export default {
        name: "ListUser",
        components:{
            DestroyUser,
            'show-user' : ShowUser,
            'toggle' : Toggle
        },
        data (){
            return{
                search:'',
                loading: false,
                dataUsers:this.users,
                selected:[],
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
                type: Array,
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
            removeUser(user){
                this.dataUsers.splice(this.dataUsers.indexOf(user),1)
            }
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
