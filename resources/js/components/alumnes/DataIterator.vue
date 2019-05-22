<template>
    <v-container fluid grid-list-md>
        <v-data-iterator
            class="hidden-lg-and-up"
            :items="dataAlumnes"
            :search="search"
            no-results-text="No se ha encontrado ninguna coincidencia"
            no-data-text="No hay datos disponibles"
            rows-per-page-text="Treas por pagina"
            :rows-per-page-items="[5,10,25,50,100,{'text':'Totes','value':-1}]"
            :loading="loading"
            :pagination.sync="pagination"
            content-tag="v-layout"
            :expand="expand"
            row
            wrap
        >
            <template
                slot="item"
                slot-scope="{item:alumne}">
            <v-flex
                xs12
                sm6
                md4
                lg3
                class="pb-2"
            >
                <v-card color="red lighten-4">
                    <v-card-title>
                        <h4>{{alumne.name}} {{alumne.surname}}</h4>
                        <v-spacer></v-spacer>
                        <v-switch  class="pl-3 mt-0" v-model="alumne.expanded"></v-switch>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-list dense v-if="alumne.expanded">
                        <v-list-tile>
                            <v-list-tile-content>Sexe :</v-list-tile-content>
                            <v-list-tile-content v-if="alumne.sex === 'Home'"><i class="fas fa-male fa-2x"></i></v-list-tile-content>
                            <v-list-tile-content v-if="alumne.sex === 'Dona'"><i class="fas fa-female fa-2x"></i></v-list-tile-content>
                            <v-list-tile-content v-if="alumne.sex === 'Altre'"><i class="fas fa-neuter fa-2x"></i></v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                            <v-list-tile-content>Edat :</v-list-tile-content>
                            <v-list-tile-content>{{alumne.age}}</v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                            <v-list-tile-content>Any escolar :</v-list-tile-content>
                            <v-list-tile-content>{{alumne.course}}</v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                            <v-list-tile-content>Escola :</v-list-tile-content>
                            <v-list-tile-content>{{alumne.school}}</v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                            <v-list-tile-content>Curs :</v-list-tile-content>
                            <v-list-tile-content>{{alumne.school_course}}</v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                            <alumnes-activitats :alumne="alumne" :alumne-activitats="alumne.activitats" :activitats="activitats" @change="refresh(false)"></alumnes-activitats>
                        </v-list-tile>
                    </v-list>
                </v-card>
            </v-flex>
            </template>
        </v-data-iterator>
    </v-container>
</template>
<script>
    import DestroyAlumne from "./DestroyAlumne";
    import AlumnesActivitats from "./AlumnesActivitats";

    export default {
        name: 'DataIterator',
        components: {
            'alumnes-activitats': AlumnesActivitats,
            'alumne-destroy': DestroyAlumne,
        },
        data () {
            return {
                expand: true,
                loading: false,
                search: '',
                dialog: false,
                dataAlumnes: this.alumnes,
                pagination: {
                    rowsPerPage: 25
                }
            }
        },
        props: {
            alumnes: {
                type: Array,
                required: true
            },
            activitats: {
                type: Array,
                required: true
            },
            users: {
                type: Array,
                required: true
            },
            uri: {
                type: String,
                required: true
            }
        },
        methods: {
            removeAlumne (alumne) {
                this.dataAlumnes.splice(this.dataAlumnes.indexOf(alumne), 1)
            },
            refresh (message = true) {
                this.loading = true
                window.axios.get(this.uri).then(response => {
                    this.dataAlumnes = response.data
                    this.loading = false
                    if (message) this.$snackbar.showMessage('Tareas actualizadas correctamente')
                }).catch(() => {
                    this.loading = false
                })
            }
        }
    }
</script>
