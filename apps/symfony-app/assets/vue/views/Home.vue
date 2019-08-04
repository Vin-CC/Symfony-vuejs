<template>
    <div>
        <section>
            <h1>Bienvenue!</h1>
            <h2>Voici la liste de vos articles.</h2>
        </section>

        <section v-if="isLoading">
            <p>Chargement...</p>
        </section>

        <section v-else-if="hasError">
            <error-message :error="error"></error-message>
        </section>

        <section v-else-if="totalArticle && articles == 0 && currentPage > 1">
            Pas d'articles pour cette page.
        </section>

        <section v-else>
            <router-link :to="{ name: 'detailArticle', params: { id: article.id }}" v-for="article in articles" href="" id="paper-link">
                <Article :article="article">
                </Article>
            </router-link>
        </section>

        <section v-else-if="!hasarticles">
            Pas d'articles.
        </section>

        <Pagination
           :total-pages="nbPages"
           :total="totalArticle"
           :per-page="itemsPerPage"
           :current-page="currentPage"
           @pagechanged="onPageChange"></Pagination>

        <router-link to="/article/add" tag="button" class="rounded-button">+</router-link>
    </div>
</template>

<script>
    import ErrorMessage from '../components/ErrorMessage';
    import Article from '../components/CarteArticle';
    import Pagination from '../components/Pagination';

    export default {
        name: 'home',
        components: {
            Article,
            ErrorMessage,
            Pagination
        },
        data () {
            return {
                message: ''
            };
        },
        created () {
            this.$store.dispatch('article/fetchArticles');
        },
        computed: {
            isLoading () {
                return this.$store.getters['article/isLoading'];
            },
            hasError () {
                return this.$store.getters['article/hasError'];
            },
            error () {
                return this.$store.getters['article/error'];
            },
            hasArticles () {
                return this.$store.getters['article/hasArticles'];
            },
            articles () {
                return this.$store.getters['article/articles'];
            },
            currentPage () {
                return this.$store.getters['article/currrentPage'];
            },
            itemsPerPage () {
                return this.$store.getters['article/itemsPerPage'];
            },
            totalArticle () {
                return this.$store.getters['article/totalArticle'];
            },
            nbPages () {
                return this.$store.getters['article/nbPages'];
            },
        },
        methods: {
            onPageChange(page) {
                this.$store.dispatch('article/fetchArticles', page);
            }
        }
    }
</script>


<style scoped>
    #paper-link {
        font-weight: inherit;
    }
    #paper-link:hover {
        text-decoration: none;
    }
    .rounded-button {
        background-color: #367bf0;
        position: fixed;
        bottom: 1.5em;
        right: 2em;
    }
</style>
