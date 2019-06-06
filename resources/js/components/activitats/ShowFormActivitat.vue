<template>
    <span>
        <v-form>
            <v-container>
                <div class="headline font-weight-light grey--text">DADES ACTIVITAT</div>
                <v-layout row wrap>
                    <v-flex xs12 sm6 md3>
                        <v-text-field
                            v-model="name"
                            label="Nom"
                            hint="Nom de la activitat"
                            placeholder="Nom de la activitat"
                            readonly
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-text-field
                            v-model="category"
                            label="Categoria"
                            hint="nom de la categoria"
                            placeholder="A quina categoria pertany?"
                            readonly
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-text-field>
                            v-model="date_start"
                            label="Data Inici"
                            hint="MM/DD/YY format"
                            readonly
                        </v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-text-field>
                            v-model="date_final"
                            label="Data final"
                            hint="MM/DD/YY format"
                            readonly
                        </v-text-field>
                    </v-flex>
                </v-layout>
                <div class="headline font-weight-light grey--text">ALUMNES</div>
                <v-layout>
                    <v-flex>
                        <ul id="alumne">
                            <li v-for="alumne in dataActivitat.alumnes" class="body-2 m-1">
                                {{alumne.name}}
                            </li>
                        </ul>
                    </v-flex>
                </v-layout>
                 <div class="headline font-weight-light grey--text">ENTITAT</div>
                <v-layout>
                    <v-flex>
                        <v-autocomplete v-model="user_id" label="Usari o Entitat" :items="dataUsers" item-text="name" item-value="id" chips readonly></v-autocomplete>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-form>
    </span>
</template>

<script>
    export default {
        name: "ShowFormActivitat",
        data(){
            return{
                dataActivitat:this.activitat,
                name:this.activitat.name,
                category:this.activitat.category,
                user_id:this.activitat.user_id,
                dataUsers:this.users,
                date_start:this.activitat.date_start,
                date_final:this.activitat.date_final
            }
        },
        props:{
            activitat: {
                type: Object,
                required: true
            },
            alumnes:{
                type: Array,
                required: false
            },
            users: {
                type: Array,
                required: true
            }
        }

    }
</script>

<style scoped>
    #alumne{
        list-style: none;
        column-count: 3;
    }

</style>
