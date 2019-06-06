<template>
    <span>
        <v-dialog v-model="dialog"
                  :fullscreen="$vuetify.breakpoint.smAndDown"
                  @keydown.esc="dialog=false"
        >
            <v-toolbar color="red darken-3" class="white--text">
                <v-btn flat icon class="white--text" @click="dialog=false">
                    <v-icon class="mr-1">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Editar Alumne</v-toolbar-title>
                <v-btn flat class="white--text" @click="dialog=false">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    SORTIR
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <update-form-alumne
                        :alumne="alumne"
                        :uri="uri"
                        :users="users"
                        :activitats="activitats"
                        @close="dialog=false"
                        @updated="updated"
                    ></update-form-alumne>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn
            v-if="$can('alumnes.update', alumne)"
            icon
            color="pink"
            flat
            title="Modificar un alumne"
            @click="dialog=true"
        >
            <v-icon>edit</v-icon>
        </v-btn>
    </span>
</template>

<script>
    import UpdateFormAlumne from "./UpdateFormAlumne";

    export default {
        name: "UpdateAlumne",
        components:{
            'update-form-alumne':UpdateFormAlumne
        },
        data () {
            return {
                dialog:false
            }
        },
        props :{
            alumne :{
                type: Object,
                required: true
            },
            users:{
                type: Array,
                required: true
            },
            uri:{
                type: String,
                required: true
            },
            activitats:{
                type:Array,
                required: true
            },
        },
        methods:{
            updated(alumne){
                console.log(alumne);
                this.$emit('updated', alumne)
            }
        },
        created() {
            this.user = window.laravel_user
        },

    }

</script>

<style scoped>

</style>
