<template>
    <v-btn  icon color="error" flat title="Eliminar una activitat"
            :loading="removing" :disabled="removing"
            @click="destroy(activitat)"
    >
        <v-icon>delete</v-icon>
    </v-btn>
</template>

<script>
    export default {
        name: "DestroyActivitat",
        data(){
            return{
                removing:false
            }
        },
        props:{
            activitat:{
                type:Object,
                required:true
            },
            uri:{
                type:String,
                required: true
            }
        },
        methods:{
            async destroy(activitat) {
                let result = await this.$confirm('Els activitats esborrats ja no es podran recuperar',
                    {
                        title: 'Esta seguro?',
                        buttonTrueText: 'Eliminar',
                        buttonFalseText: 'Cancelar',
                        color:'error'
                    })
                if (result){
                    this.removing= true
                    window.axios.delete(this.uri + activitat.id).then(() => {
                        this.$snackbar.showMessage("S'ha esborrat correctament el activitat")
                        this.$emit('removed',activitat)
                        this.removing = false
                        console.log('OK');
                    }).catch(error =>{
                        this.$snackbar.showError(error.message)
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
