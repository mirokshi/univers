<template>
    <span>
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
                <v-card>
                    <v-card-title><h4>{{alumne.name}}</h4></v-card-title>
                </v-card>
            </v-flex>
            </template>
        </v-data-iterator>
    </span>
</template>
<script>
    import DestroyAlumne from "../alumnes/DestroyAlumne";
    import AlumnesActivitats from "../AlumnesActivitats";

    export default {
        name: 'DataIterator',
        components: {
            'alumnes-activitats': AlumnesActivitats,
            'alumne-destroy': DestroyAlumne,
        },
        data () {
            return {
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
