require('./lodash')

import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
});

Vue.component('notify', require('./components/Notify').default)

const app = new Vue({
    el: '#app'
})
