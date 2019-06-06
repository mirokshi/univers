<template>
    <span>
        <v-dialog v-model="dialog" scrollable persistent max-width="400px">
      <template v-slot:activator="{ on }">
        <v-btn color="primary" v-on="on">Open Dialog</v-btn>
      </template>
      <v-card>
        <v-card-title class="headline font-weight-light">Seleccioneu una activitat</v-card-title>
        <v-card-text style="height: 300px;">
          <v-radio-group
              column
              v-model="radioActivitat"
              :error-messages="radioActivitatErrors"
              @input="$v.radioActivitat.$touch()"
              @blur="$v.radioActivitat.$touch()"

          >
              <span v-for="activitat in dataActivitat">
                    <v-radio :label="activitat.name" :value="activitat.name"></v-radio>
              </span>
          </v-radio-group>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions class="justify-center">
          <v-btn color="blue darken-1" flat @click="selectActivat" :disabled="$v.$invalid" >Acceptar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </span>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required} from 'vuelidate/lib/validators'
    export default {
        mixins:[validationMixin],
        validations:{
            radioActivitat: {required}
        },
        name: "SelectActivitat",
        data(){
            return{
                radioActivitat: '',
                dialog: false,
                dataActivitat: this.activitats
            }
        },
        props:{
            activitats:{
                type:Array,
                required:true
            }
        },
        computed:{
            radioActivitatErrors(){
                const errors =[]
                if (!this.$v.radioActivitat.$dirty){
                    return errors
                } else { !this.$v.radioActivitat.required && errors.push('Es obligatori marca una opció')}
                return errors
            }
        },
        methods:{
            selectActivat(){
                console.log(this.radioActivitat);
                this.dialog=false;
            }
        }
    }
</script>

<style scoped>

</style>
