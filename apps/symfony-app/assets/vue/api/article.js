import axios from 'axios';

export default {
    getAll (page) {
        let url = '/api/articles';
        if (page) {
            url += "/?page=" + page;
        }
        return axios.get(url);
    },
    getById(id) {
        return axios.get('/api/articles/' + id);
    },
    update(article) {
        return axios.post('/api/articles/' + article.id, article);
    },
    create(article) {
        return axios.post('/api/articles', article);
    }
}
