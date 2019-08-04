import ArticleAPI from '../api/article';
import router from '../router'

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        articles: [],
        anArticle: null,
        hasArticles: false,
        hasArticle: false,
        currrentPage: 1,
        itemsPerPage: 4,
        totalArticle: 0,
        nbPages: 0,
        articleToUpdate: null,
        newArticle: {},
    },
    getters: {
        isLoading (state) {
            return state.isLoading;
        },
        hasError (state) {
            return state.error !== null;
        },
        error (state) {
            return state.error;
        },
        hasArticles (state) {
            return state.articles.length > 0;
        },
        hasArticle (state) {
            return state.anArticle !== null;
        },
        articles (state) {
            return state.articles;
        },
        anArticle (state) {
            return state.anArticle;
        },
        currrentPage (state) {
            return state.currrentPage;
        },
        itemsPerPage (state) {
            return state.itemsPerPage;
        },
        totalArticle (state) {
            return state.totalArticle;
        },
        nbPages (state) {
            return state.nbPages;
        },
        articleToUpdate(state) {
            return state.articleToUpdate;
        },
        newArticle(state) {
            return state.newArticle;
        },
    },
    mutations: {
        ['CREATING_ARTICLE'](state) {
            state.isLoading = true;
            state.error = null;
        },
        ['CREATING_ARTICLE_SUCCESS'](state, article) {
            state.isLoading = false;
            state.error = null;
            state.articles.unshift(article);
            state.newArticle = {};
            router.push('home');
        },
        ['CREATING_ARTICLE_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.articles = [];
        },
        ['UPDATING_ARTICLE'](state) {
            state.isLoading = true;
            state.error = null;
        },
        ['UPDATING_ARTICLE_SUCCESS'](state, article) {
            state.isLoading = false;
            state.error = null;
            state.anArticle = article;
        },
        ['UPDATING_ARTICLE_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
        },
        ['FETCHING_ARTICLES'](state) {
            state.isLoading = true;
            state.error = null;
            state.articles = [];
        },
        ['FETCHING_ARTICLES_SUCCESS'](state, articles) {
            state.isLoading = false;
            state.error = null;
            state.articles = articles.data;
            state.hasArticles = articles > 0;
            state.currrentPage = articles.currentPage;
            state.itemsPerPage = articles.itemsPerPage;
            state.totalArticle = articles.totalItems;
            state.nbPages = Math.ceil(articles.totalItems / articles.itemsPerPage);
        },
        ['FETCHING_ARTICLES_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.articles = [];
        },
        ['FETCHING_ARTICLE'](state) {
            state.isLoading = true;
            state.error = null;
            state.anArticle = null;
        },
        ['FETCHING_ARTICLE_SUCCESS'](state, article) {
            state.isLoading = false;
            state.error = null;
            state.anArticle = article;
            state.hasArticle = article !== null;
        },
        ['FETCHING_ARTICLE_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.anArticle = null;
        },
        ['CHANGE_UPDATING_ARTICLE'](state, article) {
            state.articleToUpdate = article;
        },
    },
    actions: {
        createArticle ({commit}, article) {
            commit('CREATING_ARTICLE');
            return ArticleAPI.create(article)
                .then(res => commit('CREATING_ARTICLE_SUCCESS', res.data))
                .catch(err => commit('CREATING_ARTICLE_ERROR', err));
        },
        updateArticle ({commit}) {
            commit('UPDATING_ARTICLE');
            return ArticleAPI.update(this.state.article.articleToUpdate)
                .then(res => commit('UPDATING_ARTICLE_SUCCESS', res.data))
                .catch(err => commit('UPDATING_ARTICLE_ERROR', err));
        },
        fetchArticles ({commit}, page) {
            commit('FETCHING_ARTICLES');
            return ArticleAPI.getAll(page)
                .then(res => commit('FETCHING_ARTICLES_SUCCESS', res.data))
                .catch(err => commit('FETCHING_ARTICLES_ERROR', err));
        },
        fetchArticle ({commit}, id) {
            commit('FETCHING_ARTICLE');
                return ArticleAPI.getById(id)
                .then(res => commit('FETCHING_ARTICLE_SUCCESS', res.data))
                .catch(err => commit('FETCHING_ARTICLE_ERROR', err));
        },
        changeUpdatingArticle ({commit}, article) {
            commit('CHANGE_UPDATING_ARTICLE', article);
        }
    },
}
