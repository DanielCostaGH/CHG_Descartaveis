<template>
    <div class="container mx-auto">
        <div class="flex py-8">
            <v-card v-for="(product, index) in products" :key="index" :loading="loading" class="card my-4" width="320">

                <v-row align="center" class="mx-3 my-3">
                    <v-rating :model-value="product.rating" color="amber" density="compact" half-increments readonly
                        size="base"></v-rating>
                    <div class="text-grey ms-4">
                        {{ product.rating }} ({{ product.reviewCount }})
                    </div>

                </v-row>

                <v-img fit height="200" :src="product.image"></v-img>

                <v-card-item class="border-top my-2">
                    <v-card-title class="text-h6 overflow-hidden text--secondary">{{ product.name }}</v-card-title>
                    <span class="font-weight-bold" style="color: #38a169;">{{ product.price }}</span>
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
        products: [],
    }),

    methods: {
        reserve() {
            this.loading = true;

            setTimeout(() => (this.loading = false), 2000);
        },

        fetchProducts() {
            axios.get('http://localhost/api/products/active')
                .then(response => {
                    // Supondo que a resposta seja um array de produtos
                    this.products = response.data.map(product => {
                        const firstImage = product.images.split(';')[0]; // Pega a primeira imagem se houver múltiplas
                        return {
                            id: product.id,
                            name: product.name,
                            description: product.description,
                            price: product.price,
                            image: `/images/products/${product.id}/${firstImage}`, // Caminho pré-configurado da imagem
                            category_id: product.category_id,
                            brand: product.brand,
                            color: product.color,
                            quantity: product.quantity,
                        };
                    });
                    console.log(this.products);
                })
                .catch(error => {
                    console.error('There was an error fetching the products:', error);
                })
                .finally(() => {
                    this.loading = false; // Certifique-se de definir 'loading' como false após a conclusão da solicitação
                });
        },
    },

    mounted() {
        this.fetchProducts();
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
    /* Alterado de nowrap para wrap */
    /* Centraliza cards no eixo principal */
    gap: 16px;
    /* Espaçamento entre cards */
}

.card {
    min-width: 300px;
    /* Define uma largura mínima para os cards */
    max-width: 100%;
    /* Impede que os cards cresçam além do seu contêiner */
    margin-bottom: 16px;
    margin-right: 2vh;
    /* Espaçamento abaixo de cada card */
}

@media (max-width: 600px) {
    .card {
        min-width: 100%;
        /* Os cards ocupam toda a largura em telas pequenas */
        max-width: 100%;
        margin-top: 2vh;
    }
}

.border-top {
    border-top: 1px solid rgba(0, 0, 0, 0.12);
}

/* Impede que os cards cresçam além do seu contêiner */</style>
