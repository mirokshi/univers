<template>
    <span>
         <v-chip v-for="activitat in dataAlumne.activitats" :key="activitat.id" v-text="activitat.name"  @dblclick="removeActivitat(activitat)" color="#9575CD"></v-chip>
        <v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>
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
                                color="#9575CD"
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
                dataAlumneActivitats: this.alumneActivitats,
                dataAlumne:this.alumne
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
            addActivitat () {
                // pluck collection Laravel
                  console.log(this.selectedActivitats)
                let ids = []
                this.selectedActivitats.map((activitat)=>{
                    if (activitat.id){
                        this.alumneActivitats.map((actividad)=>{
                            if (actividad.id === activitat.id){
                                ids.push(activitat)
                            }
                        })
                    } else {
                        this.alumneActivitats.map((actividad)=>{
                            if (actividad.name === activitat.name){
                                ids.push(activitat)
                            }
                        })
                    }
                })
                for (var id in ids){
                    this.selectedActivitats = this.selectedActivitats.filter(function (e) {
                        return e!==ids[id]
                    })
                }
                this.loading = true
                window.axios.put('/api/v1/alumnes/'+this.alumne.id+'/activitats',{
                    activitats: this.selectedActivitats.map((activitat)=>{
                        if (activitat.id){
                            return activitat.id
                        } else return activitat.name
                    })
                }).then(response =>{
                    this.$snackbar.showMessage('Actvitat/s afegida/es correctament')
                    this.dialog=false
                    this.loading = false
                    this.$emit('change',this.selectedActivitats)
                }).catch(()=>{
                    this.$snackbar.showError('Error, seleccioni o crei una actvitat no existent ja en el alumne')
                    this.loading = false
                })

            },
            async removeActivitat (activitat) {
                let result
                if ((activitat == null || this.alumne.activitats == null)){
                    this.$snackbar.showError('No hi ha activitats a esborrar')
                }else {
                    result = await this.$confirm('Les activitats esborrades no es poden recuperar',
                        {
                            title: 'Esteu segurs?',
                            buttonTrueText: 'Eliminiar',
                            buttonFalseText: 'Cancel·lar',
                            color: 'blue'
                        })
                }
                if (result) {
                    console.log('TODO REMOVE TAG')
                    this.removing = true
                    window.axios.delete('api/v1/alumnes/' + this.alumne.id + '/activitats/' + activitat.id).then((response) => {
                        console.log(activitat)
                        this.$snackbar.showMessage('Activitat eliminada correctament')
                        this.$emit('removed')
                        this.removing = false
                    }).catch(error => {
                        this.$snackbar.showError(error.message)
                        this.removing = false

                    })
                    this.selectedActivitats = null
                }
            },
        }
    }
</script>
