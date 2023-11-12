<template>
    <div class="container mx-auto">

        <div class="mt-10">
            <v-row justify="space-between" align="center">
                <v-col>
                    <span class="text-h6 ml-2">Melhores produtos!</span>
                </v-col>
                <v-col class="text-right">
                    <v-btn text :href="'/products'">
                        Ver Todos
                        <v-icon right>
                            mdi-arrow-right
                        </v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </div>
        <hr class="border-b-2 border-[#212844] w-1/5 rounded-full my-2" />


        <div class="flex overflow-x-scroll py-8">
            <v-card v-for="(product, index) in products" :key="index" :loading="loading" class="mx-4" max-width="374">

                <v-row align="center" class="mx-2 my-3">
                    <v-rating :model-value="product.rating" color="amber" density="compact" half-increments readonly
                        size="small"></v-rating>
                    <div class="text-grey ms-4">
                        {{ product.rating }} ({{ product.reviewCount }})
                    </div>

                    <v-icon class="ml-15">mdi-heart</v-icon>
                </v-row>

                <v-img fit height="200" :src="product.image"></v-img>

                <v-card-item class="border-top my-2">
                    <v-card-title>{{ product.title }}</v-card-title>
                </v-card-item>

                <v-card-actions class="justify-center">
                    <v-btn class="my-custom-button" color="indigo" variant="flat">
                        <v-icon class="mx-2">
                            mdi-cart
                        </v-icon>
                        Adicionar ao carrinho
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
        products: [
            {
                title: 'Produto 1',
                image: '/images/products/1/i1.png',
                rating: 4.5,
                reviewCount: 413,
            },
            {
                title: 'Produto 2',
                image: '/images/products/1/i2.png',
                rating: 4.5,
                reviewCount: 413,
            },
            {
                title: 'Produto 3',
                image: '/images/products/1/i3.png',
                rating: 4.5,
                reviewCount: 413,
            },
            {
                title: 'Produto 4',
                image: '/images/products/1/i4.png',
                rating: 4.5,
                reviewCount: 413,
            },
            {
                title: 'Produto 5',
                image: '/images/products/1/i5.png',
                rating: 4.5,
                reviewCount: 413,
            },

        ],
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
