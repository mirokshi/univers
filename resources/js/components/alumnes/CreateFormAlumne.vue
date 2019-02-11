<template>
    <span>
        <v-form>
            <v-text-field
                autofocus
                v-model="name"
                label="Nom"
                hint="Nom del alumne"
                placeholder="Nom del alumne "
                :error-messages="nameErrors"
                @input="$v.name.$touch()"
                @blur="$v.name.$touch()"
            ></v-text-field>

            <v-text-field
                autofocus
                v-model="surname"
                label="Cognon"
                hint="Cognom del alumne"
                :error-messages="nameErrors"
                @input="$v.surname.$touch()"
                @blur="$v.surname.$touch()"
            ></v-text-field>
            <v-text-field
                v-model="age"
                label="Edat"
                hint="Edat del alumne"
                :error-messages="nameErrors"
                @input="$v.age.$touch()"
                @blur="$v.age                                                   .$touch()"
            ></v-text-field>
                        <v-text-field v-model="alumneBeingCreated.school" label="Escola" hint="Escola del alumne"></v-text-field>
                        <v-combobox
                            v-model="alumneBeingCreated.sex"
                            :items="items"
                            label="Sexe"
                        ></v-combobox>
                    <div>
                        <v-btn color="grey" @click="dialog = false"><v-icon class="mr-1">exit_to_app</v-icon>SALIR</v-btn>
                        <v-btn color="success" @click="create"><v-icon class="mr-1">save</v-icon>GUARDAR</v-btn>
                        </div>
                    </v-form></span>
</template>

<script>
    export default {
        name: "CreateFormAlumne"
    }
</script>

<style scoped>

</style>
