<template>
    <!-- VERSÃO DESKTOP -->
    <v-container fluid class="hidden lg:block">
        <v-row>
            <!-- Coluna para imagens secundárias -->
            <v-col cols="12" md="3" class="pa-2">
                <v-img :src="up_arrow" class="my-2 mx-auto h-5"></v-img>

                <v-container class="overflow-y-auto" style="height: 60vh;">
                    <v-row>
                        <v-col cols="12" v-for="(image, index) in productImages" :key="index">
                            <v-img :src="`/images/products/${product.id}/${image}`" class="mx-auto my-2 h-28"
                                aspect-ratio="1" @click="displayImage(image)"></v-img>
                        </v-col>

                    </v-row>
                </v-container>

                <v-img :src="down_arrow" class="my-2 mx-auto h-5"></v-img>
            </v-col>

            <!-- Coluna para imagem principal -->
            <v-col cols="12" md="9" class="d-flex align-center">
                <v-img :src="selectedImage" class="mx-auto" style="height: 50vh;"></v-img>
            </v-col>
        </v-row>
    </v-container>



    <!-- VERSÃO MOBILE -->
    <v-container fluid class="lg:hidden border-y">
        <v-row>

            <!-- Coluna para imagem principal -->
            <v-col cols="12" md="9" class="d-flex align-center border-b">
                <v-img :src="selectedImage" class="mx-auto" style="height: 40vh;"></v-img>
            </v-col>

            <!-- Coluna para imagens secundárias -->
            <v-col cols="12" md="3" class="pa-2">
                <div class="overflow-y-auto">
                    <div class="flex-container">
                        <div v-for="(image, index) in productImages" :key="index" class="flex-item">
                            <v-img :src="`/images/products/${product.id}/${image}`" class="image-style" aspect-ratio="1"
                                @click="displayImage(image)"></v-img>
                        </div>
                    </div>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            up_arrow: '/images/up_arrow.svg',
            down_arrow: '/images/down_arrow.svg',
            selectedImage: '',
        };
    },
    props: {
        product: Object,
    },
    computed: {
        productImages() {
            return this.product.images.split(';').filter(image => image !== '');
        },
    },
    mounted() {
        if (this.productImages.length > 0) {
            this.selectedImage = `/images/products/${this.product.id}/${this.productImages[0]}`;
        }
    },
    methods: {
        displayImage(image) {
            this.selectedImage = `/images/products/${this.product.id}/${image}`;
        },
    },
};
</script>

<style>
.flex-container {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
}

.flex-item {
    flex: 0 0 auto;
    margin: 5px;
    width: 100px;
}

.image-style {
    width: 100%;
    height: auto;
}
</style>
