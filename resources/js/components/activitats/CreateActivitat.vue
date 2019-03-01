<template>
     <span>
        <v-dialog v-model="dialog" @keydown.esc="dialog = false">
            <v-toolbar color="red" class="white--text">
                <v-btn color="white" flat icon @click="dialog = false">
                    <v-icon class="mr-1">
                        close
                    </v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Crear Activitat </v-toolbar-title>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <create-form-actvitat :users="users" :uri="uri" @close="dialog = false" @created="created"></create-form-actvitat>
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
    import CreateFormActivitat from "./CreateFormActivitat";

    export default {
        name: "CreateActivitat",
        components :{
            'create-form-actvitat' : CreateFormActivitat
        },
        data(){
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
            created(activitat){
                this.$emit('created',activitat)
            }
        }


    }
</script>

<style scoped>

</style>
