<template>
    <div class="hidden lg:block">
        <navbar />

        <div class="container mx-auto mt-5 mb-8">

            <div class=" flex justify-between items-center border-b py-5">
                <span class="text-2xl font-bold text-[#203244]">{{ product.name }}</span>

                <div class="hidden md:block">
                    <span>ID do produto: {{ product.id }}</span>
                </div>
            </div>

            <div class="container mx-auto">
                <div class="flex">
                    <section id="product_side" class="w-4/6 ">
                        <product_images :product="product" />
                    </section>

                    <section id="side_bar" class="w-2/6 ">
                        <side_bar_product :product="product" />
                    </section>
                </div>

                <div>
                    <product_description :product="product" />
                </div>

            </div>

            <div>
                <similar_product />
            </div>

        </div>
        <footer>
            <foot />
        </footer>
    </div>




    <!-- MOBILE SECTION -->

    <div class="lg:hidden">
        <navbar />

        <div class="container mx-auto mt-5 ">
            <div class="mb-5 mx-2">
                <span class=" text-xl font-bold text-[#203244]">{{ product.name }}</span>

            </div>

            <div class="container mx-auto">
                    <section id="product_side" class="w-full">
                        <product_images :product="product" />
                    </section>

                    <section id="side_bar" class="w-full ">
                        <side_bar_product :product="product" />
                    </section>
            </div>
            <div class="w-full">
                <product_description :product="product" />
            </div>

            <div>
                <similar_product />
            </div>

        </div>
        <footer>
            <foot />
        </footer>
    </div>
</template>



<script>
import navbar from '../components/navbar/navbar.vue';
import product_description from '../components/product-description.vue';
import product_images from '../components/product-images.vue';
import side_bar_product from '../components/side-bar-product.vue';
import similar_product from '../components/similar-product.vue';
import product_reviews from '../components/product-reviews.vue';
import foot from '../components/footer.vue';

export default {
    props: {
        product: Object,
    },

    data() {
        return {
            ratedStars: 0,
        };
    },

    methods: {
        fillStars(starCount) {
            this.ratedStars = starCount;
        },

        resetStars() {
            // Reseta as estrelas quando tirar o mouse
            this.ratedStars = 0;
        },

        rateProduct(starCount) {
        },
    },

    components: {
        navbar,
        product_description,
        product_images,
        side_bar_product,
        similar_product,
        product_reviews,
        foot,
    },
};
</script>


