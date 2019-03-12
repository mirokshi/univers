<template>
    <span>
        <v-dialog v-model="dialog" @keydown.esc.stop.prevent="dialog=false">
            <v-toolbar color="red darken-3" class="white--text">
                <v-toolbar-title class="white--text">Activitat detallat</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="dialog=false">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    Sortir
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <show-form-activitat :users="users" :activitat="activitat" :alumnes="alumnes" :activitat-alumnes="activitat.alumnes"></show-form-activitat>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn icon color="primary" flat title="Mostar l'activitat"
                @click="dialog=true">
            <v-icon>visibility</v-icon>
        </v-btn>
    </span>
</template>

<script>
    import ShowFormActivitat from "./ShowFormActivitat";

    export default {
        name: "ShowActivitat",
        components:{
            'show-form-activitat':ShowFormActivitat
        },
        data(){
            return{
                dialog:false
            }
        },
        props:{
            alumnes:{
                type:Object,
                required:true
            },
            users: {
                type: Array,
                required: true
            },
            activitat: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
