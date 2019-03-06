<template>
    <v-flex xs12>
        <v-layout align-center justify-center>
            <v-flex sm12
                    md8
            >
                <h1 class="display-3 grey--text text--darken-2 mt-3">&#128075; Benvingut!</h1>
                <h3 class="headline grey--text mt-5">Escolliu quin tipus de relació voleu tenir amb la nostra comunitat educativa:</h3>
                <v-layout align-center justify-center row wrap class="mt-5">
                    <v-flex sm12
                            md4
                    >
                        <material-card class="v-card-profile ma-1 elevation-5" :style="'border-radius: 0.5em; border-bottom-style: solid; border-bottom-width: 0.4em; border-bottom-color: ' + this.$vuetify.theme.accent.base">
                            <v-avatar
                                slot="offset"
                                class="mx-auto d-block"
                                size="130"
                            >
                                <img
                                    src="/img/students.jpg"
                                >
                            </v-avatar>
                            <v-btn
                                large
                                color="success"
                                round
                                :loading="loading[2]"
                                :disabled="loading[2]"
                                @click="setUserType(2)"
                            >Alumne</v-btn>
                        </material-card>
                    </v-flex>
                    <v-flex xs12
                            sm12
                            md4
                    >
                        <material-card class="v-card-profile ma-1 elevation-5" :style="'border-radius: 0.5em; border-bottom-style: solid; border-bottom-width: 0.4em;  border-bottom-color: ' + this.$vuetify.theme.accent.base ">
                            <v-avatar
                                slot="offset"
                                class="mx-auto d-block"
                                size="130"
                            >
                                <img
                                    src="/img/gg.jpg"
                                >
                            </v-avatar>
                            <v-btn
                                large
                                color="accent"
                                round
                                :loading="loading[1]"
                                :disabled="loading[1]"
                                @click="setUserType(1)"
                            >Professor</v-btn>
                        </material-card>
                    </v-flex>
                    <v-flex sm12
                            md4
                    >
                        <material-card class="v-card-profile ma-1 elevation-5" :style="'border-radius: 0.5em; border-bottom-style: solid; border-bottom-width: 0.4em;  border-bottom-color: ' + this.$vuetify.theme.accent.base ">
                            <v-avatar
                                slot="offset"
                                class="mx-auto d-block"
                                size="130"
                            >
                                <img
                                    src="/img/gg.jpg"
                                >
                            </v-avatar>
                            <v-btn  large
                                    color="secondary"
                                    round
                                    :loading="loading[3]"
                                    :disabled="loading[3]"
                                    @click="setUserType(3)"
                            >Personal</v-btn>
                        </material-card>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>

    export default {
        name: 'Welcome',
        data () {
            return {
                loading: []
            }
        },
        methods: {
            setUserType (type) {
                this.loading[type] = true
                window.axios.post('/api/v1/user/type', { type }).then(() => {
                    this.loading[type] = false
                    location.reload()
                }).catch(error => {
                    this.$snackbar.showError(error)
                    this.loading[type] = false
                })
            }
        }
    }
</script>
