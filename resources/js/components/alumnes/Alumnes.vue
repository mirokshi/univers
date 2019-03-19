<template>
    <span>
        <list-alumne :users="users" :uri="uri" :alumnes="dataAlumnes" :activitats="activitats"></list-alumne>
        <create-alumne :users="users" :uri="uri" :activitats="activitats" :alumne="dataAlumnes" @created="add"></create-alumne>
    </span>
</template>

<script>
    import ListAlumne from "./ListAlumne";
    import CreateAlumne from "./CreateAlumne";

    export default {
        name: 'Alumnes',
        components: {
            'list-alumne': ListAlumne,
            'create-alumne': CreateAlumne
        },
        data() {
            return {
                dataAlumnes: this.alumnes,
            }
        },
        props: {
            alumnes: {
                type: Array,
                required: true
            },
            activitats:{
              type:Array,
              required:true
            },
            users: {
                type: Array,
                required: true
            },
            uri: {
                type: String,
                required: true
            }
        },
        methods: {
            add(alumne){
                this.dataAlumnes.push(alumne)
            }
        }
    }
</script>

<style>

</style>
