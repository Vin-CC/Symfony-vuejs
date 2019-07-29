import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';
import Home from '../views/Home';
import DetailArticle from '../views/DetailArticle';
import AddArticle from '../views/AddArticle';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', component: Home },
        { path: '/addArticle', component: AddArticle},
        { path: '/article/:id', component: DetailArticle, name: 'detailArticle'},
        { path: '*', redirect: '/home' }
    ],
});

export default router;
