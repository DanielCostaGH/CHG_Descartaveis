<template>
    <div class="container mx-auto ">

        <div class="mt-10 max-w-fit md:max-w-full">
            <v-row justify="space-between" align="center">
                <v-col cols="auto">
                    <span class="text-h6 ml-2">Melhores produtos!</span>
                </v-col>
                <v-col cols="auto" class="text-right">
                    <v-btn class="mr-2" text :href="'/products'">
                        Ver Todos
                        <v-icon right>
                            mdi-arrow-right
                        </v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </div>
        <hr class="hidden lg:block border-b-2 border-[#212844] w-1/5 rounded-full my-2" />


        <div class="flex overflow-x-scroll py-8">
            <v-card v-for="(product, index) in products" :key="index" :loading="loading" class="card my-4 mx-4" width="320">

                <v-img :src="product.imagePath" fit height="200"></v-img>

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
</template>

<script>
export default {
    data: () => ({
        loading: false,
        products: [],
    }),

    methods: {
        reserve() {
            this.loading = true;

            setTimeout(() => (this.loading = false), 2000);
        },

        fetchProducts(filters = {}) {
        axios.get('/api/products', { params: filters })
            .then(response => {
                this.products = response.data.map(product => {
                    const firstImage = product.images.split(';')[0];
                    const imagePath = `/images/products/${product.id}/${firstImage}`;
                    return { ...product, imagePath };
                });
                this.products = this.products.slice(0, 5);
            })
            .catch(error => {
                console.error('Erro ao buscar produtos:', error);
            });
    },

    },

    mounted() {
        this.fetchProducts();
    }
};
</script>

<style scoped>
.container {
    width: 100%;
}

.flex {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
}

.v-card {
    flex: 0 0 auto;
    width: 300px;
}

@media (max-width: 600px) {
    .v-card {
        width: 100%;
    }
}


.border-top {
    border-top: 1px solid rgba(0, 0, 0, 0.12);
}
</style>
