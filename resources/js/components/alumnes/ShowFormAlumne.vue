<template>
    <v-form>
        <v-text-field
            autofocus
            v-model="name"
            label="Nombre"
            hint="El nombre de la tarea..."
            placeholder="Nombre de la tarea"
            :readOnly="true"
        ></v-text-field>

    </v-form>
</template>

<script>
    export default {
        name: "ShowForm Alumne",
        data(){
            return{
                name:'',
                surname:'',
                birthdate:'',
                age:'',
                sex:'',
                school:'',
                course:'',
                school_course:'',
                phone:'',
            }
        }
    }
</script>

<style scoped>

</style>
