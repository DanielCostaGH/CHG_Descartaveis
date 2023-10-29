<template>
    <div class="flex">
        <!-- Barra lateral -->
        <sidebar />

        <!-- Conteúdo principal -->
        <main class="w-4/5 p-6 bg-gray-100">
            <!-- Header -->
            <header>
                <painel />
            </header>

            <div>
                <dashboard_filters />
                <!-- Lista de Produtos -->
                <div class="flex flex-wrap">
                    <v-card>
                        <v-card-title class="text-xl font-medium">Lista de Produtos</v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col v-for="(product, index) in products" :key="index" cols="3">
                                    <a :href="'/products/' + product.id">
                                        <v-card class="mx-auto">
                                            <v-img src="https://via.placeholder.com/150" max-height="80%"></v-img>
                                            <v-card-title class="text-h6 mt-2">{{ product.name }}</v-card-title>
                                        </v-card>
                                    </a>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>

                </div>
            </div>

        </main>
    </div>
</template>

<script>
import dashboard_filters from '../../components/dashboard-filters.vue'
import sidebar from '../../components/side-bar-dashboard.vue'
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
        };
    },

    components: {
        dashboard_filters,
        sidebar,
        painel,
    },

    props: {
        products: Array, // Espera um array de produtos
    },

    methods:{
        getImageUrls(imagePaths) {
            // Use a URL base para construir as URLs completas

            const baseUrl = '/storage'; // Substitua pela URL do seu servidor Laravel

            // Divida o campo de imagens em uma lista usando ponto e vírgula como delimitador
            const paths = imagePaths.split(';');

            // Construa as URLs completas
            const imageUrls = paths.map(path => baseUrl + '/' + path);
            console.log(imageUrls);
            return imageUrls;
        },
    }
};
</script>
