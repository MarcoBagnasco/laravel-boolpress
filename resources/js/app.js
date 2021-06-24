/**
 * Front Office
 */
window.Vue = require('vue');
window.axios = require('axios');

// Init Vue Main Instance
import App from './App.vue';

const root = new Vue({
    el: '#root',
    render: h => h(App),
});