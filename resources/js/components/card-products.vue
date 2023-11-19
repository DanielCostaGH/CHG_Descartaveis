<template>
    <div class="container mx-auto">
        <div class="flex py-8">
            <v-card v-for="(product, index) in productsWithImagePaths" :key="index" :loading="loading" class="card my-4"
                width="320">

                <v-row align="center" class="mx-3 my-3">
                    <v-rating :model-value="product.rating" color="amber" density="compact" half-increments readonly
                        size="base"></v-rating>
                    <div class="text-grey ms-4">
                        {{ product.rating }} ({{ product.reviewCount }})
                    </div>
                </v-row>

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
    }),

    methods: {
        reserve() {
            this.loading = true;

            setTimeout(() => (this.loading = false), 2000);
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
        min-width: 100%;
        max-width: 100%;
        margin-top: 2vh;
    }
}

.border-top {
    border-top: 1px solid rgba(0, 0, 0, 0.12);
}
</style>
