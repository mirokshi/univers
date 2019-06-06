<template>
    <v-menu
        ref="menu"
        v-model="menu"
        :close-on-content-click="false"
        :nudge-right="40"
        lazy
        transition="scale-transition"
        offset-y
        full-width
        max-width="290px"
        min-width="290px"
    >
        <template v-slot:activator="{ on }">
            <v-text-field
                v-model="dateFormatted"
                label="Data naiximent*"
                hint="DD/MM/AAAA format"
                persistent-hint
                prepend-icon="event"
                @blur="date = parseDate(dateFormatted)"
                v-on="on"
            ></v-text-field>
        </template>
        <v-date-picker
            color="green lighten-1"
            ref="picker"
            v-model="date"
            no-title
            @input="menu = false"
            :max="new Date().toISOString().substr(0, 10)"
            min="1950-01-01"
        ></v-date-picker>
    </v-menu>
</template>

<script>
    export default {
        data: vm => ({
            date: new Date().toISOString().substr(0, 10),
            dateFormatted: vm.formatDate(new Date().toISOString().substr(0, 10)),
            menu: false,
        }),
        computed: {
            computedDateFormatted () {
                return this.formatDate(this.date)
            }
        },

        watch: {
            date (val) {
                this.dateFormatted = this.formatDate(this.date)
                this.$emit('input', this.dateFormatted)
            },
            menu (val) {
                val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
            }
        },
        props:['value'],
        methods: {
            formatDate (date) {
                if (!date) return null
                const dateSplitted = date.split('-')
                return `${dateSplitted[2]}/${dateSplitted[1]}/${dateSplitted[0]}`
            },
            parseDate (date) {
                if (!date) return null

                const [month, day, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
            },
            calcYear(date){
                if (!date) return null
                const[year,month,day] = date.split('-')
                const dt = new Date()
                const age=dt.getFullYear() - `${year}`
                if (age<0) return Math.abs(age)
                return age
            }
        }
    }
</script>
