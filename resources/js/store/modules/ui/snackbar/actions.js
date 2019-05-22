import * as actions from '../../../action-types'
import * as mutations from '../../../mutation-types'

export default {
  [ actions.SET_SNACKBAR_SHOW ] (context, show) {
    context.commit(mutations.SET_SNACKBAR_SHOW, show)
  }
}
