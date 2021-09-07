require('./lodash')

Vue.component('notify', require('./components/Notify').default)

const app = new Vue({
    el: '#app'
})
