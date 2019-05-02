<template>
    <v-switch
        v-model="dataValue"
        :label="dataValue ? activeText : unactiveText"
        :loading="loading"
    ></v-switch>
</template>

<script>
    export default {
        name: 'toggle',
        data () {
            return {
                dataValue: this.value,
                loading: false
            }
        },
        props: {
            activeText: {
                type: String,
                default: 'Active',
            },
            unactiveText: {
                type: String,
                default: 'Unactive',
            },
            snackbarMessageTrue:{
                type:String,
                default: 'Cambi passat a verdader'
            },
            snackbarMessageFalse:{
                type:String,
                default: 'Cambi passat a false'
            },
            uri: {
                type: String,
                required: true
            },
            value: {
                type: Boolean,
                required: true
            },
            resource: {
                type: Object,
                required: true
            }
        },
        watch: {
            dataValue (dataValue, oldDataValue) {
                if (dataValue !== oldDataValue) {
                    if (dataValue) this.changeAlumne()
                    else this.unchangedAlumne()
                }
            }
        },
        methods: {
            changeAlumne () {
                this.loading = true
                window.axios.post(this.uri + '/' + this.resource.id).then(() => {
                    this.$snackbar.showMessage(this.snackbarMessageTrue)
                    this.loading = false
                    this.$emit('change')
                }).catch(error => {
                    this.loading = false
                    this.$snackbar.showError(error)
                })
            },
            unchangedAlumne () {
                this.loading = true
                window.axios.delete(this.uri + '/' + this.resource.id).then(() => {
                    this.$snackbar.showMessage(this.snackbarMessageFalse)
                    this.loading = false
                    this.$emit('change')
                }).catch(error => {
                    this.loading = false
                    this.$snackbar.showError(error)
                })
            }
        }
    }
</script>
