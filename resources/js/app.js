/**
 * Front Office
 */
window.Vue = require('vue');
window.axios = require('axios');

// Init Vue Main Instance
import App from './App.vue';
import router from './routes';

const root = new Vue({
    el: '#root',
    router: router,
    render: h => h(App),
});