<template>
    <v-menu
        ref="menu"
        lazy
        :close-on-content-click="false"
        v-model="menu"
        transition="scale-transition"
        offset-y
        full-width
        :nudge-right="40"
        min-width="290px"
    >
        <v-text-field
            ref="text"
            name="formattedBirthdate"
            hint="format DD/MM/AAAA"
            persistent-hint
            slot="activator"
            :label="label"
            prepend-icon="event"
            v-model="date"
        ></v-text-field>
        <v-date-picker
            ref="picker"
            locale="ca"
            v-model="date"
            min="1900-01-01"
            :max="new Date().toISOString().substr(0, 10)"
        ></v-date-picker>
    </v-menu>
</template>

<script>
    export default {
        name: 'BirthDateInput',
        data () {
            return {
                menu: false,
                date: null
            }
        },
        props: {
            label: {
                type: String,
                default: 'Data de naixement'
            }
        }
    }
</script>
