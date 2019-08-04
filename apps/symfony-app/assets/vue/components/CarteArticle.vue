<template>
    <div class="paper">
        <div v-if="update" id="update">
                <label for="title">Titre</label>
                <input type="text" name="title" v-model="articleToUpdate.title">
                <label for="title">Description</label>
                <textarea name="description" v-model="articleToUpdate.description"></textarea>
                <label for="title">Auteur</label>
                <input type="text" name="autor" v-model="articleToUpdate.autor">
                <label for="title">Date de modification</label>
                <input type="date" name="modification" v-model="articleToUpdate.modification">
        </div>
        <div v-else class="content">
            <h4 id="title">{{ article.title }}</h4>
            <p>{{ article.description }}</p>
            <h5 id="autor">{{ article.autor }}</h5>
            <h6 id="modification">{{ formatedModificationDate }}</h6>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'carteArticle',
        props: [
            'article',
            'update'
        ],
        computed: {
            formatedModificationDate () {
                if (this.article.modification) {
                    let date = new Date(this.article.modification);
                    let options = { year: 'numeric', month: 'numeric', day: 'numeric' };
                    return date.toLocaleDateString('fr-FR', options);
                } else {
                    return "";
                }
            },
            articleToUpdate () {
                return this.$store.getters['article/articleToUpdate'];
            }
        }
    }
</script>

<style scoped>
    #update input, #update textarea {
        width: 100%;
        margin: 0 0 1em;
    }
    #update label {
        padding: 0;
        cursor: default;
    }
    #button {
        margin: 0 auto;
        width: 95%;
    }
    #title {
        margin-top: 0;
        margin-bottom: 0;
    }
    #autor {
        margin-top: 0;
        margin-bottom: 0;
    }
    #modification {
        padding-left: 0;
        margin-top: 0;
        margin-bottom: 0;
    }
</style>
