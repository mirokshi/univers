<template>
    <alumne-activitats-chip
        v-model="alumne.activitats"
        :alumne="alumne"
        :activitats="activitats"
        @updated="add"
        @deleted="removeActivitat"></alumne-activitats-chip>
</template>

<script>
    import AlumnesActivitatsChip from "./AlumnesActivitatsChip";

    export default {
        name: "AlumnesActivitats",
        components:{
            'alumne-activitats-chip' : AlumnesActivitatsChip
        },
        data(){
            return{
                dialog : false,
                newActivitat : '',
                selectedActivitats:[],
                data:''
            }
        },
        props:{
            alumne:{
                type:Object,
                required:true
            },
            activitats:{
                type: Array,
                required:true
            }
        },
        methods:{
            async add(activitats){
                window.axios.post(('/api/v1/alumne/'+this.alumne.id+'/activitats/multiple'),activitats).then((response) =>{
                    this.$snackbar.showMessage('Etiquetes afegides correctament')
                    this.$emit('updated', response.data)
                }).catch((error) => {
                    this.$snackbar.showError(error.message)
                })
            },
            async  removeActivitat(activitat){
                let result = await this.$confirm('',
                    {
                        title: 'Esta seguro?',
                        buttonTrueText: 'Eliminar',
                        buttonFalseText: 'Cancelar',
                        color: 'error'
                    }
                )
                if (result) {
                    window.axios.delete(('/api/v1/alumne/'+this.alumne.id+'/activitats/'+activitat.id)).then((response) =>{
                        this.$snackbar.showMessage('Etiqueta eliminada correctament')
                    }).catch((error) => {
                        this.$snackbar.showError(error.message)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
