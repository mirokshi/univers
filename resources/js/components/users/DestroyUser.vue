<template>
    <v-btn  icon color="error" flat title="Eliminar un user"
            :loading="removing" :disabled="removing"
            @click="destroy(user)"
    >
        <v-icon>delete</v-icon>
    </v-btn>
</template>

<script>
    export default {
        name: "DestroyUser",
        data(){
            return{
                removing:false
            }
        },
        props:{
            user:{
                type:Object,
                required:true
            },
            uri:{
                type:String,
                required: true
            }
        },
        methods:{
            async destroy(user) {
                let result = await this.$confirm('Els users esborrats ja no es podran recuperar',
                    {
                        title: 'Esta seguro?',
                        buttonTrueText: 'Eliminar',
                        buttonFalseText: 'Cancelar',
                        color:'error'
                    })
                if (result){
                    this.removing= true
                    window.axios.delete(this.uri + user.id).then(() => {
                        this.$snackbar.showMessage("S'ha esborrat correctament el user")
                        this.$emit('removed',user)
                        this.removing = false
                        console.log('OK');
                    }).catch((error) =>{
                        this.removing=false
                        console.log(error);
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
