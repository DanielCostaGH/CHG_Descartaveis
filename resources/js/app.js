import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue';
import Home from './pages/Home.vue';

const app = createApp();

// Dashboard
app.component('app', App);

// Bloco de templates do admin
import adminLogin from './components/admin/login.vue';
import adminIndex from './components/admin/index.vue'; 
import adminCreate from './components/admin/create.vue'; 

// Bloco de templates do user
import userLogin from './components/user/login.vue';
import userIndex from './components/user/index.vue'; 
import userCreate from './components/user/create.vue'; 

// Bloco de produtos
import productsIndex from './pages/products.vue'
import productDetails from './pages/productDetails.vue';


app.component('admin-login', adminLogin); 
app.component('admin-index', adminIndex);
app.component('admin-create', adminCreate);

app.component('user-login', userLogin); 
app.component('user-index', userIndex); 
app.component('user-create', userCreate); 
app.component('home', Home); 

app.component('products' , productsIndex);
app.component('productDetails', productDetails);


app.mount('#app');
