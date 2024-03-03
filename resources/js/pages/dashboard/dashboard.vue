<template>
    <div class="flex">
        <sidebar />

        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>

            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="bg-gradient-to-br from-blue_gradient-light to-blue_gradient-dark p-4 text-white rounded-lg">
                        <h3 class="text-xl font-semibold">Total de Produtos</h3>
                        <p class="text-3xl font-bold">{{ totalProducts }}</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue_gradient-light to-blue_gradient-dark p-4 text-white rounded-lg text-white p-4 rounded-lg">
                        <h3 class="text-xl font-semibold">Total de Categorias</h3>
                        <p class="text-3xl font-bold">{{ this.totalCategories }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <div class="grid grid-cols-2 gap-4">


                    <a href="/dashboard/create" class="flex justify-center items-center p-7 border rounded-lg text-center  text-xl font-bold
            hover:bg-[#F3F4F5] hover:border-[#2A4178] hover:shadow-md text-[#4864A7] hover:text-[#2A4178] ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span class="mx-5">Adicionar Produto</span>
                    </a>


                    <a href="/dashboard/products" class="flex justify-center items-center p-4 border rounded-lg text-center  text-xl font-bold
            hover:bg-[#F3F4F5] hover:border-[#2A4178] hover:shadow-md text-[#4864A7] hover:text-[#2A4178] ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span class="mx-5">Editar Produto</span>

                    </a>


                </div>
            </div>



            <div class="bg-white p-6 rounded-lg shadow mb-6">

                <h3 class="text-xl mb-4 px-4">Produtos Recentes</h3>
                <v-table class="custom-table-body">
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left">Nome do produto</th>
                                <th class="text-left">Preço</th>
                                <th class="text-left">Estoque</th>
                                <th class="text-left">Categoria</th>
                                <th class="text-left">Status</th>
                                <th class="text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in products" :key="item.id">
                                <td>{{ item.name }}</td>
                                <td>{{ item.price }}</td>
                                <td>{{ item.quantity }}</td>
                                <td>{{ item.category_id }}</td>
                                <td>{{ item.status }}</td>
                                <td><a :href="'/dashboard/products/edit/' + item.id"><svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg></a></td>
                            </tr>
                        </tbody>
                    </template>
                </v-table>
                <div class="flex w-full">
                    <v-pagination class="w-full" v-model="page" :length="totalPages" @input="changePage"></v-pagination>
                </div>
            </div>

        </main>
    </div>
</template>

<script>

import sidebar from '../../components/side-bar-dashboard.vue';
import painel from '../../components/painel-bar.vue'

export default {
    data() {
        return {
            logo_light: '/images/logo_light.svg',
            dashboard: '/images/dashboard_icon.svg',
            product: '/images/product_icon.svg',
            appearance: '/images/appearance_icon.svg',
            product_sent: '/images/car_icon.svg',
            order_pending: '/images/shopCart_icon.svg',
            payment: '/images/pay_icon.svg',
            config: '/images/config_icon.svg',
            totalProducts: 0,
            totalCategories: 0,
            page: 1,
            totalPages: 0,
            headers: [
                { text: 'Nome do produto', value: 'name' },
                { text: 'Preço', value: 'price' },
                { text: 'Estoque', value: 'stock' },
                { text: 'Categoria', value: 'category' },
                { text: 'Status', value: 'status' }
            ],
            products: [],
        };

    },

    mounted() {
        this.fetchProducts();
        this.fetchTotalProducts();
        this.fetchTotalCategories();
    },

    watch: {
        page(newVal, oldVal) {
            if (newVal !== oldVal) this.fetchProducts(); // Recarregar os dados quando a página mudar
        }
    },

    methods: {
        fetchProducts(filters = {}) {
            axios.get(`/api/products?page=${this.page}`, { params: filters })
                .then(response => {
                    this.products = response.data.data;
                    this.totalPages = response.data.last_page;
                })
                .catch(error => {
                    console.error('Erro ao buscar produtos:', error);
                });
        },
        changePage(page) {
            this.page = page;
            this.fetchProducts();
        },

        async fetchTotalProducts() {
            try {
                const response = await axios.get('/api/products/count');
                this.totalProducts = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async fetchTotalCategories() {
            try {
                const response = await axios.get('/api/categories/count');
                this.totalCategories = response.data;
            } catch (error) {
                console.error(error);
            }
        }
    },

    components: {
        sidebar,
        painel,

    }
};
</script>



<style>
.custom-table-body {
    max-height: 40vh !important;
    overflow-y: auto;
}
</style>
