import getters from './getters';
import mutations from './mutations';
import actions from './actions';

const state = {
  show: false,
  color: 'error',
  text: 'An error occurred',
  subText: '',
  timeout: 6000,
  textAlign: 'inherit',
};

export default {
  state,
  getters,
  mutations,
  actions,
};
