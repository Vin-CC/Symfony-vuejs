import Vue from 'vue';
import Vuex from 'vuex';
import ArticleModule from './article';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        article: ArticleModule,
    }
});
