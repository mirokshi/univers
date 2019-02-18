<template>
    <span>
        <v-dialog v-model="dialog"  @keydown.esc.stop.prevent="dialog=false">
            <v-toolbar color="red darken-3" class="white--text">
            <v-btn flat icon class="white--text" @click="dialog=false">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title class="white--text">Mostrar Alumne</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat class="white--text" @click="dialog=false">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Sortir
            </v-btn>
        </v-toolbar>
            <v-card>
                <v-card-text>
                    <show-form-alumne :users="users" :alumne="alumne"></show-form-alumne>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-btn icon color="primary" flat title="Mostrar el alumne"
               @click="dialog=true">
            <v-icon>visibility</v-icon>
        </v-btn>
    </span>
</template>

<script>
    import ShowFormAlumne from "./ShowFormAlumne";

    export default {
        name: "ShowAlumne",
        components:{
            'show-form-alumne':ShowFormAlumne
        },
        data(){
            return{
                dialog:false
            }
        },
        props:{
            alumne:{
                type:Object,
                required:true
            },
            users: {
                type: Array,
                required: true
            }

        }
    }
</script>

<style scoped>

</style>
