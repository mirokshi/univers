<template>
    <span>
        <list-user :users="users"  :uri="uri"></list-user>
    </span>
</template>

<script>

    import ListUser from "./ListUser";

    export default {
        name: "Users",
        components :{
            'list-user':ListUser,
        },
        data(){
            return {
                dataUsers: this.users,
            }
        },
        props:{
            users:{
                type:Object,
                required:true
            },
            uri:{
                type:String,
                required: true
            }

        }

    }
</script>

<style scoped>

</style>
