<template>
    <span>
        <v-form>
            <v-container>
                <div class="headline font-weight-light grey--text">DADES ACTIVITAT</div>
                <v-layout row wrap>
                    <v-flex xs12 sm6 md3>
                        <v-text-field
                            autofocus
                            v-model="name"
                            label="Nom"
                            hint="Nom de la activitat"
                            placeholder="Nom de la activitat"
                            :error-messages="nameErrors"
                            @input="$v.name.$touch()"
                            @blur="$v.name.$touch()"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md3>
                        <v-text-field
                            autofocus
                            v-model="category"
                            label="Categoria"
                            hint="Nom de la categoria"
                            placeholder="Nom de la categoria"
                        ></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md3>
                          <v-menu
                              ref="date_start"
                              v-model="date_start"
                              :close-on-content-click="false"
                              :nudge-right="40"
                              lazy
                              transition="scale-transition"
                              offset-y
                              full-width
                              max-width="290px"
                              min-width="290px"
                          >
                              <v-text-field
                                  slot="activator"
                                  v-model="dateFormatted_start"
                                  label="Data inici"
                                  hint="MM/DD/AAAA format"
                                  persistent-hint
                                  @blur="date = parseDate(dateFormatted_start)"
                              ></v-text-field>
                              <v-date-picker v-model="date" no-title @input="date_start = false"></v-date-picker>
                          </v-menu>
                      </v-flex>
                    <v-flex xs12 sm6 md3>
                          <v-menu
                              ref="date_final"
                              v-model="date_final"
                              :close-on-content-click="false"
                              :nudge-right="40"
                              lazy
                              transition="scale-transition"
                              offset-y
                              full-width
                              max-width="290px"
                              min-width="290px"
                          >
                              <v-text-field
                                  slot="activator"
                                  v-model="dateFormatted_final"
                                  label="Data final"
                                  hint="MM/DD/AAAA format"
                                  persistent-hint
                                  @blur="date = parseDate(dateFormatted_final)"
                              ></v-text-field>
                              <v-date-picker v-model="date" no-title @input="date_final = false"></v-date-picker>
                          </v-menu>
                      </v-flex>
                </v-layout>
                 <div class="headline font-weight-light grey--text">ENTITAT</div>
                <v-layout>
                    <v-flex>
                        <v-autocomplete v-model="user_id" label="Usari o Entitat" :items="dataUsers" item-text="name" item-value="id" chips></v-autocomplete>
                    </v-flex>
                </v-layout>
            </v-container>
            <div class="text-xs-center">
                <v-btn color="grey" @click="$emit('close')">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    SORTIR
                </v-btn>
                <v-btn color="success" @click="add" :disabled="loading || $v.$invalid" :loading="loading">
                    <v-icon class="mr-1">save</v-icon>
                    GUARDAR
                </v-btn>
            </div>
        </v-form>
    </span>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required } from 'vuelidate/lib/validators'
    export default {
        mixins:[validationMixin],
        validations:{
            name:{required}
        },
        name: "CreateFormActivitat",
        data(){
            return{
                date: new Date().toISOString().substr(0, 10),
                dateFormatted_start: this.formatDate(new Date().toISOString().substr(0, 10)),
                dateFormatted_final: this.formatDate(new Date().toISOString().substr(0, 10)),
                date_start:false,
                date_final:false,
                name:'',
                category:'',
                user_id:'',
                dataUsers:this.users,
                loading:false
            }
        },
        props:{
            users: {
                type: Array,
                required: true
            },
            uri:{
                type:String,
                required: true
            }
        },
        methods: {
            selectLoggedUser () {
                if (window.laravel_user) {
                    this.user = this.users.find((user) => {
                        return parseInt(user.id) === parseInt(window.laravel_user.id)
                    })
                }
            },
            reset(){
                this.name=''
                this.category=''
                this.date_start=''
                this.date_final=''
                this.user_id=''
            },
            add(){
                this.loading = true
                const activitat = {
                    'name':this.name,
                    'category':this.category,
                    'date_start':this.date_start,
                    'date_final':this.date_final,
                    'user_id':this.user_id,
                }
                window.axios.post(this.uri,activitat).then(response =>{
                    this.$snackbar.showMessage('Activitat creat correctament')
                    this.reset()
                    this.$emit('created',response.data)
                    this.loading=false
                    this.$emit('close')
                }).catch(() =>{
                    this.reset()
                    this.loading=false
                    this.$emit('close')
                })
            },
            created(){
                this.selectLoggedUser()
            },
            formatDate:function (date) {
                if (!date) return null
                const [year, month, day] = date.split('-')
                return `${month}/${day}/${year}`
            },
            parseDate(date){
                if (!date) return null
                const [month, day, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
            }
        },
        computed:{
            nameErrors(){
                const errors = []
                if (!this.$v.name.$dirty){
                    return errors
                }  else { !this.$v.name.required && errors.push('El nom del alumne  és obligatori.') }
                    return errors
            },
            computedDateFormatted () {
                return this.formatDate(this.date)
            },
        },
        watch:{
            date(val){
                this.dateFormatted = this.formatDate(this.date)
            }
        }
    }
</script>

<style scoped>

</style>
