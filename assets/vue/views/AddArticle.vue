<template>
    <div>
        <div>
            <h1>Ajouter un article</h1>
        </div>

        <div v-if="hasError">
            Erreur
            <error-message :error="error"></error-message>
        </div>

        <div>
            <div class="paper update">
                    <label for="title">Titre</label>
                    <input type="text" name="title" v-model="article.title">
                    <label for="title">Description</label>
                    <textarea name="description" v-model="article.description"></textarea>
                    <label for="title">Auteur</label>
                    <input type="text" name="autor" v-model="article.autor">
                    <label for="title">Date de modification</label>
                    <input type="date" name="modification" v-model="article.modification">
            </div>
            <div class="center">
                <button v-on:click="saveModification" class="green-button">Sauvegarder</button>
                <router-link to="/home" tag="button" class="red-button">retour</router-link>
            </div>
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
                update: true,
            };
        },
        created () {
        },
        computed: {
            hasError () {
                return this.$store.getters['article/hasError'];
            },
            error () {
                return this.$store.getters['article/error'];
            },
            article () {
                return this.$store.getters['article/newArticle'];
            }
        },
        methods: {
            saveModification () {
                this.$store.dispatch('article/createArticle', this.article);
            }
        },
    }
</script>

<style scoped>
    .center {
        text-align: center;
    }
    button.green-button, button.red-button {
        display: inline-block;
        margin: 1em;
    }
    .update input, .update textarea {
        width: 100%;
        margin: 0 0 1em;
    }
    .update label {
        padding: 0;
        cursor: default;
    }
</style>
