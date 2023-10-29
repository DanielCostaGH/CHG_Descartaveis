import Vue from 'vue';
import VueRouter from 'vue-router';

import userInfo from './components/userProfile/user-info.vue';
import userAddress from './components/userProfile/user-address.vue';
import userFavorites from './components/userProfile/user-favorites.vue';
import userRequests from './components/userProfile/user-requests.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/info-cadastrais', component: userInfo },
        { path: '/user-address', component: userAddress },
        { path: '/user-favorites', component: userFavorites },
        { path: '/user-requests', component: userRequests },
    ],
});

export default router;
