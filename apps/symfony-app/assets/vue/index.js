import Vue from 'vue';
import App from './App';
import router from './router';
import store from './store';

require('../css/flat-remix.min.css');
require('../css/app.css');

new Vue({
    template: '<App/>',
    components: { App },
    router,
    store,
}).$mount('#app');
