<template>
    <span>
        <v-dialog
            v-model="dialog"
            width="500"
            @keydown.esc.stop.prevent="dialog=false">
            <v-toolbar>
                <v-toolbar-title>Afegir activitat al usuari {{dataAlumne.name}}</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn @click="dialog=false" icon><v-icon>close</v-icon></v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-combobox
                        v-model="selectedActivitats"
                        :items="activitats"
                        item-text="name"
                        item-value="name"
                        label="Escull o tria una activitat"
                        multiple
                        chips
                        :readonly="readonly"
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
                <v-card-actions v-if="!readonly">
                    <v-spacer></v-spacer>
                    <v-btn flat @click="dialog = false">Cancel·lar</v-btn>
                    <v-btn color="grey darken-3" flat  :loading="loading" :disabled="loading" @click="add()" class="teal lighten-4">Afegir</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-chip
            v-for="activitat in dataAlumne.activitats"
            v-text="activitat.name"
            :key="activitat.id"
            class="body-1"
            @dblclick="removeActivitat(activitat)"
            color="blue lighten-4"></v-chip>
        <v-btn
            v-if="!readonly"
            icon
            @click="dialog = true"
            class="red lighten-4"
        ><v-icon>add</v-icon></v-btn>
    </span>
</template>
<script>
    export default {
        name: 'AlumnesActivitatsChip',
        data () {
            return {
                dialog: false,
                newActivitat:'',
                loading: false,
                dataselectedActivitats: this.selectedActivitats,
                data:'',
                dataAlumne:this.alumne,
            }
        },
        model:{
          prop:'selectedActivitats',
          event:'updated'
        },
        props: {
            alumne: {
                type: Object,
                default: function () {
                    return {}
                }
            },
            activitats: {
                type: Array,
                required: true
            },
            selectedActivitats: {
                type: Array,
                default: function () {
                    return []
                }
            },
            readonly:{
                type: Boolean,
                default: false
            }
        },
        methods: {
            add(){
                this.$emit('updated',this.dataselectedActivitats)
                this.dialog = false
            },
            removeActivitat(activitat){
                this.$emit('deleted',activitat)
            }

        }
    }
</script>
