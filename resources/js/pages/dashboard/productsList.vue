<template>
    <div class="flex">
        <sidebar />

        <main class="w-4/5 p-6 border-l">
            <header>
                <painel />
            </header>

            <div>
                <div class="bg-white p-4">
                    <!-- Botão para adicionar categoria -->
                    <div class="flex justify-end">
                        <v-btn href="/dashboard/create" color="success">
                            <v-icon class="mr-3">mdi-plus</v-icon>
                            Adicionar Produto</v-btn>
                    </div>
                    <filters @filter-applied="handleFilterApplied" />


                </div>

                <section class="bg-white h-auto">
                    <v-row>
                        <v-col>
                            <div class="pa-4 rounded-lg">
                                <v-card-title class="text-h5 font-medium">Lista de Produtos</v-card-title>
                                <v-row>
                                    <v-col v-for="(product, index) in products" :key="index" cols="12" md="6" lg="3">
                                        <v-card class="pa-4">
                                            <v-card-title class="text-h6 font-medium mt-2">{{ product.name }}</v-card-title>
                                            <v-img :src="getFirstImage(product)" class="my-4" aspect-ratio="2.0"
                                                cover></v-img>
                                            <v-card-actions class="justify-around">
                                                <v-btn :href="'/dashboard/products/edit/' + product.id" color="indigo"
                                                    size="base" rounded="lg">
                                                    <v-icon class="pr-4">mdi-pencil</v-icon>
                                                    <span>Editar</span>
                                                </v-btn>

                                                <v-btn @click="confirmDelete(product.id)" prepend-icon="mdi-delete"
                                                    color="red" size="base" rounded="lg" class="">
                                                    remover
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                        <div v-if="products.length === 0" class="text-center py-10">
                                            Nenhum produto encontrado.
                                        </div>
                                    </v-col>
                                </v-row>
                            </div>
                        </v-col>
                    </v-row>
                </section>
                <v-pagination v-model="page" :length="totalPages" rounded="circle"></v-pagination>

            </div>
        </main>
    </div>

    <v-dialog v-model="dialog" persistent max-width="50%">
        <v-card color="success">
            <v-card-text class="white--text text-h5 pt-15">
                <v-row align="center" justify="center">
                    <v-icon class="mr-2" size="x-large">mdi-check-circle</v-icon>
                    O produto foi cadastrado com sucesso.
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="white" class="text-h6" text @click="confirmProductCreation">OK</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import filters from '../../components/filters.vue'
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'
import axios from 'axios';

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
            products: [],
            page: 1,
            totalPages: 0,
        };
    },

    components: {
        filters,
        sidebar,
        painel,
    },

    mounted() {
        this.fetchProducts();
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
                    console.log("dadosretornados:", response.data)
                    this.products = response.data.data;
                    this.totalPages = response.data.last_page;
                })
                .catch(error => {
                    console.error('Erro ao buscar produtos:', error);
                });
        },

        handleFilterApplied(filters) {
            this.fetchProducts(filters);
        },

        async confirmDelete(productId) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                await this.deleteProduct(productId);
            }
        },

        async deleteProduct(productId) {
            try {
                await axios.delete(`/dashboard/delete/${productId}`);
                // Recarregar a lista de produtos após a exclusão
                this.fetchProducts();
            } catch (error) {
                console.error('Erro ao excluir produto:', error);
                alert('Houve um erro ao excluir o produto. Por favor, tente novamente.');
            }
        },

        getFirstImage(product) {
            if (!product.images) return '/images/empty.png';

            const imageList = product.images.split(';');
            if (imageList[0].startsWith('/images/')) {
                return imageList[0];
            }

            return `/images/products/${product.id}/${imageList[0]}`;
        },

    },
};
</script>
