<template>
    <div>
        <div>
            <h1>Article</h1>
        </div>

        <div v-if="isLoading">
            <p>Chargement...</p>
        </div>

        <div v-else-if="hasError">
            Erreur
            <error-message :error="error"></error-message>
        </div>

        <div v-else-if="hasArticle">
            <Article :article="article"
                    :update="update">
            </Article>
            <div class="center">
                <button v-if="update" v-on:click="saveModification" class="green-button">Sauvegarder</button>
                <button v-on:click="toggleForm" class="blue-button">{{ labelButton }}</button>
                <router-link to="/home" tag="button" class="red-button">retour</router-link>
            </div>
        </div>

        <div v-else-if="!hasArticle">
            Pas d'article!
        </div>
    </div>
</template>

<script>
import Article from '../components/CarteArticle';
    import ErrorMessage from '../components/ErrorMessage';

    export default {
        name: 'detailArticle',
        components: {
            Article,
            ErrorMessage,
        },
        data () {
            return {
                message: '',
                id: this.$route.params.id,
                update: false,
                labelButton: 'Modifier'
            };
        },
        created () {
            this.$store.dispatch('article/fetchArticle', this.$data.id);
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
            hasArticle () {
                return this.$store.getters['article/hasArticle'];
            },
            article () {
                return this.$store.getters['article/anArticle'];
            }
        },
        methods: {
            toggleForm () {
                this.update = !this.update;
                this.labelButton = this.update ? "Annuler" : "Modifier";
                this.$store.dispatch('article/changeUpdatingArticle', this.article);
            },
            saveModification () {
                this.$store.dispatch('article/updateArticle');
                this.toggleForm();
            }
        },
    }
</script>

<style>
    .center {
        text-align: center;
    }
    button.blue-button, button.green-button, button.red-button {
        display: inline-block;
        margin: 1em;
    }
</style>
