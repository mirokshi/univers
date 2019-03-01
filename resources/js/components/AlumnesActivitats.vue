<template>
    <span>
         <v-chip v-for="activitat in alumneActivitats" :key="activitat.id" v-text="activitat.name"  @dblclick="removeActivitat"></v-chip>
        <v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>
        <v-btn icon @click="dialog = true"><v-icon>remove</v-icon></v-btn>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title>Afegir activitat a un alumne</v-card-title>
                <v-card-text>
                    <v-combobox
                        v-model="selectedActivitats"
                        :items="activitats"
                        multiple
                        chips
                        item-text="name"
                        @change="formatActivitat"
                    >
                        <template
                            slot="selection"
                            slot-scope="data"
                        >
                            <v-chip
                                :selected="data.selected"
                                :disabled="data.disabled"
                                :key="JSON.stringify(data.item)"
                                class="v-chip--select-multi"
                                @input="data.parent.selectItem(data.item)"
                            >
                                {{ data.item.name }}
                            </v-chip>

                        </template>
                    </v-combobox>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn flat @click="dialog = false">CANCELAR</v-btn>
                    <v-btn color="grey darken-3" flat  :loading="loading" :disabled="loading" @click="addActivitat">AÑADIR</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </span>
</template>
<script>
    export default {
        name: 'AlumnesActivitats',
        data () {
            return {
                dialog: false,
                loading: false,
                selectedActivitats: [],
                dataAlumneActivitats: this.alumneActivitats
            }
        },
        props: {
            alumne: {
                type: Object
            },
            activitats: {
                type: Array,
                required: true
            },
            alumneActivitats: {
                type: Array,
                required: true
            }
        },
        watch: {
            alumneActivitats (alumneActivitats) {
                this.dataAlumneActivitats = alumneActivitats
            }
        },
        methods: {
            formatActivitat () {
                var value = this.selectedActivitats[this.selectedActivitats.length - 1]
                if (typeof value === 'string') {
                    this.selectedActivitats[this.selectedActivitats.length - 1] = {
                        'name': this.selectedActivitats[this.selectedActivitats.length - 1]
                    }
                }
            },
            removeActivitat () {
                // TODO ASYNC PRIMER EXECUTAR UN CONFIRM
                console.log('TODO REMOVE TAG')
                window.axios.delete('api/v1/alumnes/' + this.alumne.id + '/activitats/' + this.activitat).then(response => {
                    this.$snackbar.showMessage('Etiqueta eliminada correctamente')
                }).catch(error => {
                    this.$snackbar.showError(error)
                })
            },
            addActivitat () {
                // pluck collection Laravel
                //   console.log(this.selectedActivitats)
                this.loading = true
                window.axios.put('/api/v1/alumnes/' + this.alumne.id + '/activitats/', {
                    activitats: this.selectedActivitats.map((activitat) => {
                        if (activitat.id) return activitat.id
                        else return activitat.name
                    })
                }).then(response => {
                    this.$snackbar.showMessage('Etiqueta agregada correctamente')
                    this.dialog = false
                    this.loading = false
                    this.$emit('change', this.selectedActivitats)
                }).catch(error => {
                    this.$snackbar.showError(error)
                })
            }
        }
    }
</script>
