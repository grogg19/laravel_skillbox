require('./lodash')

Vue.component('notify', require('./components/Notify').default)
Vue.component('report-statistics', require('./components/ReportStatistics').default)

const app = new Vue({
    el: '#app'
})
