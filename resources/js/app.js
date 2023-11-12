import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createVuetify } from 'vuetify'
import App from './components/App.vue';
import Home from './pages/Home.vue';
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

const app = createApp();
app.use(createVuetify())

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
import productsList from './pages/dashboard/productsList.vue';
import appearenceIndex from './pages/dashboard/appearence.vue'
import productCreate from './pages/dashboard/productCreate.vue'


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
app.component('appearence-index', appearenceIndex);
app.component('product-create', productCreate);



app.mount('#app');
