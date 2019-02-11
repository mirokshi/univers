<template>
    <span>
        <v-dialog v-model="createDialog" @keydown.esc="createDialog = false">
            <v-toolbar color="red" class="white--text">
                <v-btn color="white" flat icon @click="createDialog = false">
                    <v-icon class="mr-1">
                        close
                    </v-icon>
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn color="white" flat @click="createDialog = false ">
                    <v-icon>exit_to_app</v-icon>
                    SALIR
                </v-btn>
                <v-btn color="white" flat @click="createDialog = false">
                    <v-icon class="mr-1">save</v-icon>
                    GUARDAR
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="alumneBeingCreated.name" label="Nom" hint="Nom del alumne"></v-text-field>
                        <v-text-field v-model="alumneBeingCreated.surname" label="Cognon" hint="Cognom del alumne"></v-text-field>
                        <v-dialog
                            ref="dialog"
                            v-model="modal"
                            :return-value.sync="date"
                            persistent
                            lazy
                            full-width
                            width="290px"
                        >
          <v-text-field
              slot="activator"
              v-model="date"
              label="Picker in dialog"
              prepend-icon="event"
              readonly
          ></v-text-field>
          <v-date-picker v-model="date" scrollable>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="modal = false">Cancel</v-btn>
            <v-btn flat color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
          </v-date-picker>
        </v-dialog>
                        <v-text-field v-model="alumneBeingCreated.age" label="Edat" hint="Edat del alumne"></v-text-field>
                        <v-text-field v-model="alumneBeingCreated.school" label="Escola" hint="Escola del alumne"></v-text-field>
                        <v-combobox
                            v-model="alumneBeingCreated.sex"
                            :items="items"
                            label="Sexe"
                        ></v-combobox>
                    <div>
                        <v-btn color="grey" @click="createDialog = false"><v-icon class="mr-1">exit_to_app</v-icon>SALIR</v-btn>
                        <v-btn color="success" @click="create"><v-icon class="mr-1">save</v-icon>GUARDAR</v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
         <v-btn
             fab
             bottom
             right
             color="pink"
             fixed
             class="white--text"
             @click="showCreate"
         >
            <v-icon>add</v-icon>
        </v-btn>
    </span>
</template>

<script>
    export default {
        name: 'CreateAlumne',
        data: () => ({
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            modal: false,
            menu2: false
        })
    }
</script>
<style scoped>

</style>
