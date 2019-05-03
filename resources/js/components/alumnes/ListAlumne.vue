<template>
    <span>
        <v-toolbar color="red accent-2">
      <v-toolbar-title class="white--text">Usuaris {{total}}</v-toolbar-title>
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
                            appedn-icon="search"
                            label="Buscar"
                            v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                v-model="selected"
                :headers="headers"
                :items="filteredDesserts"
                item-key="id"
                select-all
                :search="search"
                no-result-text="No hi ha cap registre"
                :loading="loading"
                no-data-text="No hi ha res per mostrar aquí :("
                rows-per-page-text="Alumnes per página"
                :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                :pagination.sync="pagination"
                class="hidden-md-and-down elevation-1"

            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="headers" slot-scope="props">
                    <tr>
                        <th>
                            <v-checkbox
                                :input-value="props.all"
                                :indeterminate="props.indeterminate"
                                primary
                                hide-details
                                @click.native="toggleAll"
                            ></v-checkbox>
                        </th>
                        <th
                            v-for="header in props.headers"
                            :key="header.text"
                            :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
                            @click="changeSort(header.value)"
                        >
                            <v-icon small>arrow_upward</v-icon>
                            {{ header.text }}
                        </th>
                    </tr>
                    <tr class="grey lighten-3">
                        <th>
                            <v-icon>filter_list</v-icon>
                        </th>
                        <th
                            v-for="header in props.headers"
                            :key="header.text"
                        >
                            <div v-if="filters.hasOwnProperty(header.value)">
                                <v-select flat hide-details small multiple clearable :items="columnValueList(header.value)" v-model="filters[header.value]"></v-select>
                            </div>
                        </th>
                    </tr>
                </template>
                <template slot="items" slot-scope="{item: alumne}">
                    <tr :class="{'red': alumne.change === false}" :active="alumne.selected" @click="alumne.selected = !alumne.selected">
                        <td>
                            <v-checkbox
                                :input-value="alumne.selected"
                                primary
                                hide-details
                            ></v-checkbox>
                        </td>
                        <td>{{alumne.id}}</td>
                        <td>{{alumne.name}}</td>
                        <td>{{alumne.surname}}</td>
                        <!--TODO SEX- add icons (font awesome)-->
                        <td v-if="alumne.sex === 'home'" ><i class="fas fa-male fa-2x"></i></td>
                        <td v-if="alumne.sex === 'dona'"><i class="fas fa-female fa-2x"></i></td>
                        <td v-if="alumne.sex === 'altre'"><i class="fas fa-neuter fa-2x"></i></td>
                        <td>{{alumne.birthdate}}</td>
                        <td>{{alumne.age}}</td>
                        <td>{{alumne.school}}</td>
                        <td>{{alumne.course}}</td>
                        <td>{{alumne.school_course}}</td>
                        <td>
                            <alumnes-activitats :alumne="alumne" :alumne-activitats="alumne.activitats" :activitats="activitats" @change="refresh(false)"></alumnes-activitats>
                        </td>
                        <!--<td><span :title="alumne.created_at_formatted">{{alumne.created_at_human}}</span></td>-->
                        <td>
                            <show-alumne :users="users" :alumne="alumne" :activitats="activitats"></show-alumne>
                            <destroy-alumne
                                :alumne="alumne"
                                @removed="removeAlumne"
                                :uri="uri"
                            ></destroy-alumne>
                            <update-alumne
                                :users="users"
                                :alumne="alumne"
                                @updated="updateAlumne"
                                :uri="uri"
                                :activitats="activitats"
                            ></update-alumne>
                             <toggle
                                 :value="alumne.change"
                                 uri="/api/v1/change_alumne"
                                 active-text="Alta"
                                 unactive-text="Baja"
                                 :resource="alumne"
                                 snackbar-message-true="El alumne se ha donat de alta"
                                 snackbar-message-false="El alumne se ha donat de baixa"
                                 @change="refresh(false)"
                             ></toggle>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <!--<data-iterator :users="users" :uri="uri" :activitats="activitats" :alumnes="alumnes"></data-iterator>-->
        </v-card>
    </span>
</template>
<script>
    import ShowAlumne from "./ShowAlumne";
    import DestroyAlumne from "./DestroyAlumne";
    import AlumnesActivitats from "../AlumnesActivitats";
    import Toggle from "../helper/Toggle";
    import DataIterator from "../helper/DataIterator";
    import UpdateAlumne from "./UpdateAlumne";

    export default {
        name:'ListAlumne',
        components:{
            'toggle':Toggle,
            'show-alumne' :ShowAlumne,
            'destroy-alumne':DestroyAlumne,
            'update-alumne':UpdateAlumne,
            'alumnes-activitats':AlumnesActivitats,
            'data-iterator':DataIterator,
        },
        data(){
            return {
                search:'',
                course:'',
                loading: false,
                dataAlumnes: this.alumnes,
                dataUsers: this.users,
                selected:[],
                pagination:{
                    sortBy: 'id'
                },
                headers :[
                    {text:'ID', value: 'id'},
                    {text:'NOM', value: 'name'},
                    {text:'COGNOMS', value: 'surname'},
                    {text:'SEXE', value: 'sex'},
                    {text:'DATA DE NAIXIMENT', value:'birthdate'},
                    {text:'EDAT', value: 'age'},
                    {text:'CENTRE EDUCATIU', value: 'school'},
                    {text:'CURS', value:'course'},
                    {text:'NIVELL', value: 'school_course'},
                    {text:'ACTIVITAS', value:'activitats'},
                    // {text:'CREAT', value:'created_at_timestamp'},
                    {text:'ACCIONS',sorteable:false, value:'full_search'},
                ],
                filters: {
                    name: [],
                    surname: [],
                    sex: [],
                    birthdate: [],
                    age:[],
                    school:[],
                    course:[],
                    school_course:[],
                    activitats:[]
                },
            }
        },
        props:{
            alumnes:{
                type: Array,
                required:true
            },
            activitats:{
                type: Array,
                required: true
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
                this.loading = true;
                window.axios.get(this.uri).then(response => {
                    this.dataAlumnes = response.data;
                    this.loading = false;
                    console.log('ok');
                    if (message) this.$snackbar.showMessage('Alumnes actualizats correctament')
                }).catch(error => {
                    console.log(error);
                    this.loading = false
                })
            },
            removeAlumne(alumne){
                this.dataAlumnes.splice(this.dataAlumnes.indexOf(alumne),1)
            },
            updateAlumne(alumne){
                this.refresh()
            },
            toggleAll () {
                if (this.selected.length) this.selected = []
                else this.selected = this.alumnes.slice()
            },
            columnValueList(val) {
                return this.alumnes.map(d => d[val])
            }
        },
        computed:{
            total(){
                return this.dataAlumnes.length
            },
            filteredDesserts() {
                return this.alumnes.filter(d => {
                    return Object.keys(this.filters).every(f => {
                        return this.filters[f].length < 1 || this.filters[f].includes(d[f])
                    })
                })
            }
        }
    }

</script>

<style scoped>

</style>
