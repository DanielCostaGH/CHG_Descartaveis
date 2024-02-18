<template>
    <div class="container mx-auto hidden md:block lg:block">
        <div class="flex py-8">
            <v-card v-for="(product, index) in productsWithImagePaths" :key="index" :loading="loading" class="card my-4"
                width="320">


                <div class="flex justify-between items-center p-2 border-b-2 mb-4">
                    <div class="flex items-center">
                        <v-rating hover :length="5" :size="27" :model-value="3" active-color="warning" readonly />
                        <v-label>(544)</v-label>
                    </div>

                    <div>
                        <!-- Botão de favorito -->
                        <button @click="favoriteProduct(product)" class="ma-2">
                            <v-icon :color="favorites.includes(product.id) ? 'red' : ''">
                                mdi-heart{{ favorites.includes(product.id) ? '' : '-outline' }}
                            </v-icon>
                        </button>
                    </div>
                </div>



                <v-img :src="product.imagePath" cover height="200"></v-img>

                <v-card-item class="border-top my-2">
                    <v-card-title class="text-h6 overflow-hidden text--secondary">{{ product.name }}</v-card-title>
                    <span class="font-weight-bold" style="color: #38a169;">{{ product.price }}</span>
                </v-card-item>

                <v-card-actions class="justify-center">
                    <v-btn :href="`products/${product.id}`" class="my-custom-button text-white" color="green-accent-4"
                        variant="flat">
                        <v-icon class="mx-2">
                            mdi-eye
                        </v-icon>
                        Ver Detalhes do Produto
                    </v-btn>
                </v-card-actions>
            </v-card>
        </div>
    </div>



    <!-- Mobile version -->
    <div class="mobile-container mx-auto md:hidden lg:hidden">
        <div class="mobile-flex py-8">
            <v-card v-for="(product, index) in productsWithImagePaths" :key="`product-${index}-${product.isFavorite}`"
                :loading="loading" class="card my-4" width="200">


                <div class="flex justify-between items-center p-2 border-b-2 mb-4">
                    <div class="flex items-center">
                        <v-rating hover :length="5" :size="27" :model-value="3" active-color="warning" readonly />
                        <v-label>(544)</v-label>
                    </div>

                    <div>
                        <!-- Botão de favorito -->
                        <button @click="favoriteProduct(product)" class="ma-2">
                            <v-icon :color="favorites.includes(product.id) ? 'red' : ''">
                                mdi-heart{{ favorites.includes(product.id) ? '' : '-outline' }}
                            </v-icon>
                        </button>
                    </div>
                </div>

                <v-img :src="product.imagePath" fit height="130" class="mb-2"></v-img>

                <v-card-item class="mobile-border-top">
                    <v-card-title class="overflow-hidden text--secondary">{{ product.name }}</v-card-title>
                    <span class="font-weight-bold" style="color: #38a169;">{{ product.price }}</span>
                </v-card-item>

                <v-card-actions class="justify-center">
                    <v-btn :href="`products/${product.id}`" class="my-custom-button text-white" color="green-accent-4"
                        variant="flat">
                        <v-icon class="mx-2">
                            mdi-eye
                        </v-icon>
                        Ver Produto
                    </v-btn>
                </v-card-actions>
            </v-card>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['products'],
    computed: {
        productsWithImagePaths() {
            return this.products.map(product => {
                const firstImage = product.images.split(';')[0];
                const imagePath = `/images/products/${product.id}/${firstImage}`;
                return { ...product, imagePath };
            });
        }
    },

    data: () => ({
        loading: false,
        favorites: [],
    }),

    mounted() {
        this.fetchFavorites();
    },

    methods: {
        reserve() {
            this.loading = true;

            setTimeout(() => (this.loading = false), 2000);
        },

        fetchFavorites() {
            axios.get('/user/get-favorites')
                .then(response => {
                    this.favorites = response.data.map(favorite => favorite.product_id);
                })
                .catch(error => console.error("Erro ao buscar favoritos:", error));
        },

        favoriteProduct(product) {
            axios.post('/user/favorite', { productId: product.id })
                .then(response => {
                    this.fetchFavorites();
                })
                .catch(error => console.error("Erro ao favoritar produto:", error));
        },
    },
};
</script>

<style scoped>
.container {
    width: 100%;
    overflow-x: auto;
}

.flex {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}

.card {
    min-width: 300px;
    max-width: 100%;
    margin-bottom: 16px;
    margin-right: 2vh;
}

@media (max-width: 600px) {
    .card {
        max-width: 70%;
        margin-top: 2vh;
    }
}

.border-top {
    border-top: 1px solid rgba(0, 0, 0, 0.12);
}



/* mobile */
.mobile-container {
    width: 100%;
    overflow-x: auto;
}

.mobile-flex {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.mobile-border-top {
    border-top: 1px solid rgba(0, 0, 0, 0.12);
}
</style>
