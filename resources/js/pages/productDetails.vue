<template>
    <div>
        <navbar />

        <div class="container mx-auto mt-16 mb-8">
            <span class="text-2xl font-bold text-[#203244]">{{ product.name }}</span>

            <div class=" flex justify-between items-center border-b py-5">

                <div class="flex items-center">
                    <span v-for="index in 5" :key="index" class="mr-1 cursor-pointer" @mouseover="fillStars(index)"
                        @mouseout="resetStars" @click="rateProduct(index)">
                        <svg v-if="index <= ratedStars" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            viewBox="0 0 16 16" fill="#FED540" class="fill-current text-yellow-500">
                            <g clip-path="url(#clip0)">
                                <path
                                    d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>

                        <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                            fill="#FED540" class="fill-current text-gray-400">
                            <g clip-path="url(#clip0)">
                                <path
                                    d="M7.9999 0C8.2359 0.000140603 8.46764 0.0629185 8.67145 0.181922C8.87525 0.300926 9.04382 0.471892 9.15994 0.677357L11.2107 4.30815L14.9201 5.02418C15.1544 5.06957 15.3721 5.17698 15.5507 5.33519C15.7292 5.4934 15.8621 5.69662 15.9353 5.92366C16.0086 6.1507 16.0196 6.39325 15.9672 6.62599C15.9149 6.85874 15.801 7.07317 15.6375 7.24692L12.9481 10.107L13.6308 14.4618C13.6681 14.7021 13.639 14.948 13.5466 15.1729C13.4543 15.3979 13.3022 15.5933 13.1068 15.738C12.9114 15.8827 12.6802 15.9712 12.4381 15.994C12.196 16.0168 11.9523 15.973 11.7334 15.8672L7.9999 14.0645L4.26643 15.8672C4.04737 15.9731 3.80352 16.0169 3.56129 15.9941C3.31907 15.9713 3.08771 15.8826 2.89227 15.7377C2.69683 15.5928 2.54476 15.3972 2.45253 15.1721C2.3603 14.947 2.33142 14.7009 2.36903 14.4605L3.05172 10.1057L0.362296 7.24692C0.19881 7.07317 0.0849343 6.85874 0.0325457 6.62599C-0.0198429 6.39325 -0.00882548 6.1507 0.0644485 5.92366C0.137722 5.69662 0.270569 5.4934 0.449134 5.33519C0.627699 5.17698 0.845442 5.06957 1.07965 5.02418L4.78912 4.30815L6.83852 0.677357C6.95475 0.471695 7.12353 0.300602 7.32759 0.181586C7.53165 0.0625705 7.76367 -9.55068e-05 7.9999 1.09255e-07Z" />
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>

                    </span> <!-- Estrelas -->

                    <a href="#" class="mx-3 text-blue-600">Avaliações desse produto</a>
                </div>

                <div>
                    <span>ID do produto: {{ product.id }}</span>
                </div>
            </div>

            <div class="container mx-auto">
                <div class="flex">

                        <section id="product_side" class="w-4/6 h-screen">
                            <div>
                                
                                <product_images :product="product"/>
                            </div>
                            
                            <product_description :product="product"/>
                        </section>

                        <section id="side_bar" class="w-2/6 h-screen">
                            <side_bar_product :product="product"/>
                        </section>

                </div>
            </div>

            <div>
                <similar_product />
            </div>

            <div>
                <product_reviews />
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
            console.log(`Rated ${starCount} stars`);
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
  

  