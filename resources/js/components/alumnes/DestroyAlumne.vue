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
                let result = await this.$confirm('Los alumnos borrados ya no se podrán recuperar',
                    {
                        title: 'Esta seguro?',
                        buttonTrueText: 'Eliminar',
                        buttonFalseText: 'Cancelar',
                        color:'error'
                    })
                if (result){
                    this.removing= true
                    window.axios.delete(this.uri + alumne.id).then(() => {
                        this.$snackbar.showMessage('Se ha borrado correctamente el alumne')
                        this.$emit('removed',alumne)
                        this.removing = false
                    }).catch(error =>{
                        this.$snackbar.showError(error.message)
                        this.removing=false
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
