<template>
    <div class="px-10 border-b">
        <swiper :cssMode="true" :loop="true" :navigation="navigationOptions" :pagination="true" :mousewheel="true"
            :autoplay="{
                delay: 7000,
                disableOnInteraction: false,
            }" :keyboard="true" :modules="modules" class="mySwiper h-[30vh] md:h-[40vh] lg:h-[60vh]">

            <button class="hidden lg:block lg:absolute top-0 right-0 h-[30vh]">
                <swiper-button-next
                    class="swiper-button-next custom-next hover:scale-110 hover:duration-300 p-40"></swiper-button-next>
            </button>

            <button class="hidden lg:block lg:absolute top-0 left-0 h-[30vh]">
                <swiper-button-prev
                    class="swiper-button-prev custom-prev hover:scale-110 hover:duration-300 p-40"></swiper-button-prev>
            </button>

            <button class="lg:hidden">
                <swiper-button-next class="swiper-button-next custom-next"></swiper-button-next>
            </button>

            <button class="lg:hidden">
                <swiper-button-prev class="swiper-button-prev custom-prev"></swiper-button-prev>
            </button>

            <swiper-slide v-for="(image, index) in slides" :key="index" class="h-full">
                <div class="w-full flex justify-center items-center h-5/6 lg:h-[60vh]">
                    <img class="h-5/6" :src="image" :alt="'Imagem ' + index">
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
import { Navigation, Pagination, Mousewheel, Keyboard, Autoplay } from 'swiper/modules';
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
            modules: [Navigation, Pagination, Mousewheel, Keyboard, Autoplay],
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


