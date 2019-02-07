<template>
    <span>
        <h1>TODO</h1>
         <!--<v-toolbar color="secondary">-->
      <!--<v-toolbar-title class="white&#45;&#45;text">Tags {{total}}</v-toolbar-title>-->
      <!--<v-spacer></v-spacer>-->

        <!--<v-btn icon dark class="white&#45;&#45;text">-->
            <!--<v-icon>settings</v-icon>-->
        <!--</v-btn>-->
        <!--<v-btn icon dark class="white&#45;&#45;text" @click="refresh" :loading="loading" :disabled="loading">-->
            <!--<v-icon>refresh</v-icon>-->
        <!--</v-btn>-->

        <!--</v-toolbar>-->

    </span>
</template>

<script>
    export default {
        name:'Alumnes',
        data(){
            return {
                name:'',
                surname:'',
                age:'',
                school:'',
                school_course:'',
                sex:'',
                dataAlumnes: this.alumnes,
                headers :[
                    {text:'ID', value: 'id'},
                    {text:'NOM', value: 'name'},
                    {text:'COGNOM', value: 'surname'},
                    {text:'EDAT', value: 'age'},
                    {text:'COL.LEGI', value: 'school'},
                    {text:'CURS', value: 'school_course'},
                    {text:'SEXE', value: 'sex'},
                ],
                pagination:{
                    rowsPerPage:25
                }
            }
        },
        props:{
            alumnes:{
                type: Array,
                required:true
            },
            uri:{
                type: String,
                required: true
            }
        },
        methods:{
          refresh(){
              this.loading = true
              window.axios.get(this.uri).then(response => {
                  this.dataAlumnes = response.data
                  this.loading = false
              }).catch(error => {
                  console.log(error)
                  this.loading = false
              })
          }
        },
        computed:{
            total(){
                return this.dataAlumnes.length
            }
        }
    }

</script>

<style>

</style>
