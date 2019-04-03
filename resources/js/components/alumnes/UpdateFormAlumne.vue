<template>
    <v-form>
        <v-text-field
            v-model="name"
            label="Nom"
            hint="El nom del alumne"
            placeholder="El nom del alumne"
        ></v-text-field>

        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancelar
            </v-btn>
            <v-btn color="success" @click="update" :disabled="loading" :loading="loading">
                <v-icon class="mr-1">save</v-icon>
                Actualizar
            </v-btn>
        </div>
    </v-form>
</template>

<script>
    export default {
        name: "UpdateFormAlumne",
        data () {
            return {
                name: this.alumne.name,
                loading : false
            }
        },
        props:{
            alumne:{
                type: Object,
                required: true
            },
            users:{
                type: Array,
                required: true
            },
            uri: {
                type: String,
                required: true
            }
        },
        methods:{
            update(){
                this.loading = true
                const newAlumne = {
                    name: this.name
                }
                window.axios.put(this.uri + this.alumne.id, newAlumne).then((response) => {
                    this.$emit('updated', response.data)
                    this.$emit('close')
                    this.loading = false
                }).catch((error) => {
                    this.loading = false
                    console.log(error);
                })
            }
        }
    }
</script>

<style scoped>

</style>
