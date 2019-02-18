<template>
    <v-btn  icon color="error" flat title="Eliminar un alumne"
           :loading="removing" :disabled="removing"
           @click="destroy(alumne)"
    >
        <v-icon>delete</v-icon>
    </v-btn>
</template>

<script>
    export default {
        name: "DestroyAlumne",
        data(){
            return{
                removing:false
            }
        },
        props:{
            alumne:{
                type:Object,
                required:true
            },
            uri:{
                type:String,
                required: true
            }
        },
        methods:{
            async destroy(alumne) {
                let result = await this.$confirm('Els alumnes esborrats ja no es podran recuperar',
                    {
                        title: 'Esta seguro?',
                        buttonTrueText: 'Eliminar',
                        buttonFalseText: 'Cancelar',
                        color:'error'
                    })
                if (result){
                    this.removing= true
                    window.axios.delete(this.uri + alumne.id).then(() => {
                        this.$snackbar.showMessage("S'ha esborrat correctament el alumne")
                        this.$emit('removed',alumne)
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
