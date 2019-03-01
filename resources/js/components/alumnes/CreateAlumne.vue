<template>
    <span>
        <v-dialog v-model="dialog" @keydown.esc="dialog = false">
            <v-toolbar color="red" class="white--text">
                <v-btn color="white" flat icon @click="dialog = false">
                    <v-icon class="mr-1">
                        close
                    </v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Crear Alumne </v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <create-form-alumne :users="users" :uri="uri" @close="dialog = false" @created="created"></create-form-alumne>
                </v-card-text>
            </v-card>
        </v-dialog>
         <v-btn
             fab
             bottom
             right
             color="pink"
             fixed
             class="white--text"
             @click="dialog = true"
         >
            <v-icon>add</v-icon>
        </v-btn>
    </span>
</template>

<script>
    import CreateFormAlumne from "./CreateFormAlumne";

    export default {
        name: 'CreateAlumne',
        components:{
            'create-form-alumne' : CreateFormAlumne
        },
        data () {
            return {
                dialog: false,
            }
        },
        props:{
            users: {
                type: Array,
                required: true
            },
            uri:{
                type: String,
                required:true
            }
        },
        methods:{
            created(alumne){
                this.$emit('created',alumne)
            }
        }
    }
</script>
<style scoped>

</style>
