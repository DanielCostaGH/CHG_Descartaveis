import './bootstrap';
import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import App from './components/App.vue';
import Home from './pages/Home.vue';
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import store from './store'
import axios from 'axios';
import { createRouter, createWebHistory } from 'vue-router';


// Bloco de templates do admin
import adminLogin from './pages/admin/login.vue';
import adminIndex from './pages/admin/index.vue';
import adminCreate from './pages/admin/create.vue';
// Bloco de templates do user
import userLogin from './pages/user/login.vue';
import userIndex from './pages/user/index.vue';
import userCreate from './pages/user/create.vue';
// Bloco de produtos
import productsIndex from './pages/products.vue'
import productDetails from './pages/productDetails.vue';
// Bloco dashboard
import dashboardIndex from './pages//dashboard/dashboard.vue';
import productEdit from './pages/dashboard/productEdit.vue';
import categoryEdit from './pages/dashboard/categoryEdit.vue';
import productsList from './pages/dashboard/productsList.vue';
import appearenceIndex from './pages/dashboard/appearence.vue';
import categoriesIndex from './pages/dashboard/categories.vue';
import productCreate from './pages/dashboard/productCreate.vue';
import categoryCreate from './pages/dashboard/categoryCreate.vue';
import config from './pages/dashboard/config.vue';
import ConditionTerms from './pages/dashboard/ConditionTerms.vue';
// Bloco de pedidos (orders)
import orders from './pages/dashboard/orders.vue'
import ShippedOrders from './pages/dashboard/ShippedOrders.vue'
import orderDetails from './pages/user/orderDetails.vue'
// Bloco do carrinho de compras
import shoppingCart from './pages/cart/shoppingCart.vue'
import paymentCart from './pages/cart/paymentCart.vue'
import confirmationCart from './pages/cart/confirmationCart.vue'
import cartLocal from './pages/cart/cartLocal.vue'

// Configurações do Router
const routes = [
    {
        path: '/cart/:id',
        name: 'shopping_cart',
        component: shoppingCart
    },
    {
        path: '/cart/payment/:id',
        name: 'payment_cart',
        component: paymentCart
    },
    {
        path: '/cart/confirmation/:id',
        name: 'confirmation_cart',
        component: confirmationCart
    },
    {
        path: '/products',
        name: 'getProducts',
        component: productsIndex
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


const app = createApp();
app.use(createVuetify());
app.use(store);
app.use(router);

// Definindo usuário global
axios.get('/api/get')
    .then(response => {
        store.dispatch('setUser', response.data);
    })
    .catch(error => {
    });

// Definindo admin global
axios.get('/api/get-admin')
.then(response => {
    store.dispatch('setAdmin', response.data);
})
.catch(error => {
});

app.component('app', App);
// Bloco de templates do admin
app.component('admin-login', adminLogin);
app.component('admin-index', adminIndex);
app.component('admin-create', adminCreate);
// Bloco de templates do user
app.component('user-login', userLogin);
app.component('user-index', userIndex);
app.component('user-create', userCreate);
app.component('home', Home);
// Bloco de produtos
app.component('products', productsIndex);
app.component('product_details', productDetails);
// Bloco dashboard
app.component('dashboard-index', dashboardIndex);
app.component('products-edit-list', productsList);
app.component('product-edit', productEdit);
app.component('category-edit', categoryEdit);
app.component('appearence-index', appearenceIndex);
app.component('categories-index', categoriesIndex);
app.component('product-create', productCreate);
app.component('category-create', categoryCreate);
app.component('Config', config);
app.component('condition-terms', ConditionTerms);
// Bloco de pedidos (orders)
app.component('Orders', orders);
app.component('shipped-orders', ShippedOrders);
app.component('order-details', orderDetails)
// Bloco do carrinho de compras
app.component('shopping_cart', shoppingCart);
app.component('payment_cart', paymentCart);
app.component('confirmation_cart', confirmationCart);
app.component('cart_local', cartLocal);




app.mount('#app');
