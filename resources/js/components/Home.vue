<template>
    <v-flex xs12>
        <v-layout align-center justify-center>
            <v-flex sm12
                    md8
            >
                <h1 class="display-3 grey--text text--darken-2 mt-3">&#128075; Escolliu :</h1>
                <select-activitat :activitats="activitats"></select-activitat>
                <v-layout align-center justify-center row wrap class="mt-5">
                    <v-flex sm12
                            md4
                    >
                        <material-card class="v-card-profile ma-1 elevation-5" :style="'border-radius: 0.5em; border-bottom-style: solid; border-bottom-width: 0.4em; border-bottom-color: ' + this.$vuetify.theme.grey.base">
                            <v-avatar
                                slot="offset"
                                class="mx-auto d-block"
                                size="130"
                            >
                                <img
                                    src="/img/userTypes/students.jpg"
                                >
                            </v-avatar>
                            <v-btn
                                large
                                color="success"
                                round
                                :loading="loading"
                                :disabled="loading"
                                href="alumnes"
                            >Usuaris</v-btn>
                        </material-card>
                    </v-flex>
                    <v-flex xs12
                            sm12
                            md4
                    >
                        <material-card class="v-card-profile ma-1 elevation-5" :style="'border-radius: 0.5em; border-bottom-style: solid; border-bottom-width: 0.4em;  border-bottom-color: ' + this.$vuetify.theme.grey.base ">
                            <v-avatar
                                slot="offset"
                                class="mx-auto d-block"
                                size="130"
                            >
                                <img
                                    src="/img/userTypes/entitats.jpg"
                                >
                            </v-avatar>
                            <v-btn
                                large
                                color="error"
                                round
                                :loading="loading"
                                :disabled="loading"
                                href="entitats"
                            >Entitats</v-btn>
                        </material-card>
                    </v-flex>
                    <v-flex
                        xs12
                        sm12
                        md4
                    >
                        <material-card class="v-card-profile ma-1 elevation-5" :style="'border-radius: 0.5em; border-bottom-style: solid; border-bottom-width: 0.4em;  border-bottom-color: ' + this.$vuetify.theme.grey.base ">
                            <v-avatar
                                slot="offset"
                                class="mx-auto d-block"
                                size="130"
                            >
                                <img
                                    src="/img/userTypes/activities.jpg"
                                >
                            </v-avatar>
                            <v-btn  large
                                    color="secondary"
                                    round
                                    :loading="loading"
                                    :disabled="loading"
                                    href="activitats"
                            >Activitats</v-btn>
                        </material-card>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
    // import '../../../../resources/img/userTypes/students.jpg'
    // import '../../../../resources/img/userTypes/entitats.jpg'
    // import '../../../../resources/img/userTypes/activities.jpg'

    import MaterialCard from "./ui/MaterialCard";
    import SelectActivitat from "./SelectActivitat";

    export default {
        name: 'Home',
        components:{
          'material-card':MaterialCard,
            'select-activitat':SelectActivitat
        },
        data () {
            return {
                loading: false,
                user : window.laravel_user
            }
        },
        props:{
            activitats:{
                type:Array,
                required: true
            }
        }
    }
</script>
