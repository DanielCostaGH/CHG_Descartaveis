import './bootstrap';

import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import App from './components/App.vue';
import Home from './pages/Home.vue';
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import store from './store'
import axios from 'axios';


const app = createApp();

app.use(createVuetify());
app.use(store);

axios.get('/api/get')
    .then(response => {
        store.dispatch('setUser', response.data);
    })
    .catch(error => {
        console.error('Erro:', error);
    });



// Dashboard
app.component('app', App);

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
import appearenceIndex from './pages/dashboard/appearence.vue'
import categoriesIndex from './pages/dashboard/categories.vue'
import productCreate from './pages/dashboard/productCreate.vue'
import categoryCreate from './pages/dashboard/categoryCreate.vue'


import shoppingCart from './pages/cart/shoppingCart.vue'
import paymentCart from './pages/cart/paymentCart.vue'
import confirmationCart from './pages/cart/confirmationCart.vue'




app.component('admin-login', adminLogin);
app.component('admin-index', adminIndex);
app.component('admin-create', adminCreate);

app.component('user-login', userLogin);
app.component('user-index', userIndex);
app.component('user-create', userCreate);
app.component('home', Home);

app.component('products' , productsIndex);
app.component('product_details', productDetails);


app.component('dashboard-index', dashboardIndex);
app.component('products-edit-list', productsList);
app.component('product-edit', productEdit);
app.component('category-edit', categoryEdit);
app.component('appearence-index', appearenceIndex);
app.component('categories-index', categoriesIndex);
app.component('product-create', productCreate);
app.component('category-create', categoryCreate);


app.component('shopping_cart', shoppingCart);
app.component('payment_cart', paymentCart);
app.component('confirmation_cart', confirmationCart);



app.mount('#app');
