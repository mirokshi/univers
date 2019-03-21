<template>
    <span>
        <v-menu
            ref="menu"
            :close-on-content-click="false"
            v-model="menu"
            :nudge-right="40"
            :return-value.sync="date"
            lazy
            transition="scale-transition"
            offset-y
            full-width
            min-width="290px"
            @keydown.esc.stop.prevent="menu = false"
            style="display: inline-block"
        >
            <v-text-field
                :error-messages="errorMessages"
                ref="text"
                :name="name"
                slot="activator"
                :value="formatted_date" @change.native="formatted_date = $event.target.value"
                :label="label"
                hint="format DD/MM/AAAA"
                persistent-hint
                prepend-icon="event"
            ></v-text-field>
            <v-date-picker v-model="internalDate" @input="input" locale="ca" color="red"></v-date-picker>
        </v-menu>
        <v-icon @click="clear()">cancel</v-icon>
    </span>
</template>

<script>
    export default {
        name: 'DatePicker',
        data () {
            return {
                menu: false,
                internalDate: this.date
            }
        },
        model: {
            prop: 'date',
            event: 'input'
        },
        props: {
            errorMessages: {
                required: false
            },
            date: {
                required: true
            },
            label: {
                type: String,
                default: 'Escolliu una data'
            },
            name: {
                type: String,
                default: 'date'
            }
        },
        watch: {
            date (newValue) {
                this.internalDate = newValue
            },
            internalDate (newValue) {
                this.input()
            }
        },
        computed: {
            formatted_date: {
                get: function () {
                    return this.formatDate(this.internalDate)
                },
                set: function (value) {
                    console.log('HEY!')
                    this.internalDate = this.unformatDate(value)
                }
            }
        },
        methods: {
            clear () {
                this.internalDate = null
            },
            input () {
                this.$refs.menu.save(this.internalDate)
                this.$emit('input', this.internalDate)
            },
            formatDate (date) {
                if (!date) return null
                try {
                    const [year, month, day] = date.split('-')
                    return `${day}/${month}/${year}`
                } catch (error) {
                    return null
                }
            },
            unformatDate (date) {
                if (!date) return null
                try {
                    const [day, month, year] = date.split('/')
                    return `${year}-${month}-${day}`
                } catch (error) {
                    return null
                }
            }
        }
    }
</script>
