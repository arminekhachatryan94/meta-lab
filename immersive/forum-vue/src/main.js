// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuex from 'vuex'
import VueSession from 'vue-session'

Vue.use(Vuex)
Vue.use(VueSession)

const store = new Vuex.Store({
  state: {
    auth: false,
    user: {
      id: '',
      first_name: '',
      last_name: '',
      username: '',
      email: '',
      role: '',
      biography: ''
    }
  },
  mutations: {
    logout (state) {
      state.auth = false
      state.user.id = ''
      state.user.first_name = ''
      state.user.last_name = ''
      state.user.username = ''
      state.user.email = ''
      state.user.role = ''
      state.user.biography = ''
    },
    login (state, user) {
      state.auth = true
      state.user.id = user.id
      state.user.first_name = user.first_name
      state.user.last_name = user.last_name
      state.user.username = user.username
      state.user.email = user.email
      state.user.role = user.role
      state.user.biography = user.biography
    },
    username (state, username) {
      state.username = username
    },
    biography (state, biography) {
      state.biography = biography
    }
  }
})

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>',
  store: store,
  render: h => h(App)
})
