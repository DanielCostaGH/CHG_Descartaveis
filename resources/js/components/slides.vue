<template>
    <div class="hidden md:block px-10 border-b ">
        <swiper :cssMode="true" :loop="true" :navigation="navigationOptions" :mousewheel="true"
            :autoplay="{
                delay: 7000,
                disableOnInteraction: false,
            }" :keyboard="true" :modules="modules" class="mySwiper w-full lg:h-[60vh] ">

            <button class="hidden lg:block lg:absolute top-0 right-0 h-[30vh]">
                <swiper-button-next
                    class="swiper-button-next custom-next hover:scale-110 hover:duration-300 p-40"></swiper-button-next>
            </button>

            <button class="hidden lg:block lg:absolute top-0 left-0 h-[30vh]">
                <swiper-button-prev
                    class="swiper-button-prev custom-prev hover:scale-110 hover:duration-300 p-40"></swiper-button-prev>
            </button>

            <swiper-slide v-for="(image, index) in slides" :key="index" class="">
                <div class="w-full flex justify-center items-center lg:h-[60vh] overflow-hidden">
                    <img class="w-4/6 image-desk " :src="image" :alt="'Imagem ' + index">
                </div>
            </swiper-slide>

        </swiper>
    </div>



    <!-- Mobile component -->
    <div class=" md:hidden">
    <swiper
    :grabCursor="true"
    :effect="'creative'"
    :pagination="true"
    :loop="true"
    :creativeEffect="{
      prev: {
        shadow: true,
        translate: [0, 0, -400],
      },
      next: {
        translate: ['100%', 0, 0],
      },
    }"
    :modules="modules"
    class="mySwiper pb-10 "
  >

            <swiper-slide v-for="(image, index) in slides" :key="index" class="h-full">
                <div class="w-full flex justify-center items-center">
                    <img class="image-mob no-shadow" :src="image" :alt="'Imagem ' + index">
                </div>
            </swiper-slide>

        </swiper>
    </div>
</template>

<script>
// Importações
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-creative';

import { Navigation, Pagination, Mousewheel, Keyboard, Autoplay, EffectCreative } from 'swiper/modules';
import axios from 'axios';

export default {
    components: {
        Swiper,
        SwiperSlide,
    },

    data() {
        return {
            slides: [],
            navigationOptions: {
                nextEl: '.custom-next',
                prevEl: '.custom-prev',
            },
            modules: [Navigation, Pagination, Mousewheel, Keyboard, Autoplay, EffectCreative],
        };
    },
    mounted() {
        this.fetchImages();
    },
    methods: {
        fetchImages() {
            axios.get('/api/slides/get')
                .then(response => {
                    this.slides = response.data.map(slide => `/images/slides/${slide.images}`);
                })
                .catch(error => console.error('Erro ao buscar imagens', error));
        },
    },
};
</script>


<style>
.no-shadow {
    box-shadow: none !important;
}

.image-mob {
    width: 100%;
    height: auto;
    object-fit: cover;
    aspect-ratio: 16 / 9;
}

.image-desk {
    width: 75%;
    height: auto;
    object-fit: cover;
    aspect-ratio: 16 / 9;
}

</style>
