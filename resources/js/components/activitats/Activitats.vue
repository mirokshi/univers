<template>
    <span>
        <list-activitat :users="users" :uri="uri" :activitats="dataActivitats" :alumnes="dataAlumnes"></list-activitat>
        <create-activitat :users="users" :uri="uri" @created="add"></create-activitat>
    </span>
</template>

<script>
    import ListActivitat from "./ListActivitat";
    import CreateActivitat from "./CreateActivitat";

    export default {
        name: "Activitats",
        components :{
            'list-activitat':ListActivitat,
            'create-activitat':CreateActivitat
        },
        data(){
            return {
                dataActivitats: this.activitats,
                dataAlumnes:this.alumnes
            }
        },
        props:{
            alumnes: {
                type: Array,
                required: false
            },
            activitats:{
                type:Array,
                required: true

            },
            users:{
                type:Array,
                required:true
            },
            uri:{
                type:String,
                required: true
            }

        },
        methods :{
            add(activitat){
                this.dataActivitats.push(activitat)
            }
        }

    }
</script>

<style scoped>

</style>
