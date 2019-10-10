import axios from 'axios';

export default {
    all(params) {
        return axios.get('/api/users', { params });
    },
    find(id) {
        return axios.get(`/api/users/${id}`);
    },
    update(id, data) {
        return axios.put(`/api/users/${id}`, data);
    },
};