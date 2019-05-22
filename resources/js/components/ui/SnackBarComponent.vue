<template>
    <v-snackbar
            :timeout="snackbarTimeout"
            :color="snackbarColor"
            v-model="snackbarShow"
            :multi-line="true"
            v-bind:style="{'text-align': snackbarTextAlign}"
    >
        {{ snackbarText }}<br/>
        {{ snackbarSubtext }}
        <v-btn dark flat @click.native="close">Tancar</v-btn>
    </v-snackbar>
</template>

<script>
import { mapGetters } from 'vuex'
import * as actions from '../../store/action-types'

export default {
  name: 'Snackbar',
  data () {
    return {
      styleObject: {
        'text-align': 'inherit'
      }
    }
  },
  computed: {
    ...mapGetters([
        'snackbarShow',
        'snackbarColor',
        'snackbarText',
        'snackbarSubtext',
        'snackbarTimeout',
        'snackbarTextAlign'
    ])
  },
  methods: {
    close () {
      this.$store.dispatch(actions.SET_SNACKBAR_SHOW, false)
    }
  },
  created () {
    this.styleObject = {
      'text-align': this.snackbarTextAlign
    }
  }
}
</script>
