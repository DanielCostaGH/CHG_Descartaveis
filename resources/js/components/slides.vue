<template>
    <div class="px-10 bg-gray-100">
        <swiper :cssMode="true" :loop="true" :navigation="navigationOptions" :pagination="true" :mousewheel="true"
            :autoplay="{
                delay: 7000,
                disableOnInteraction: false,
            }" :keyboard="true" :modules="modules" class="mySwiper h-[30vh] md:h-[40vh] lg:h-[60vh]">

            <button class="hidden lg:block lg:absolute top-0 right-0 h-[30vh]">
                <swiper-button-next class="swiper-button-next custom-next hover:scale-110 hover:duration-300 p-40"></swiper-button-next>
            </button>

            <button class="hidden lg:block lg:absolute top-0 left-0 h-[30vh]" >
                <swiper-button-prev
                    class="swiper-button-prev custom-prev hover:scale-110 hover:duration-300 p-40"></swiper-button-prev>
            </button>

            <button class="lg:hidden">
                <swiper-button-next class="swiper-button-next custom-next"></swiper-button-next>
            </button>

            <button class="lg:hidden">
                <swiper-button-prev class="swiper-button-prev custom-prev"></swiper-button-prev>
            </button>

            <swiper-slide class="h-full">
                <div class=" w-full flex justify-center items-center h-5/6 lg:h-[60vh]">
                    <img class="h-5/6" :src="image1" alt="imagem">
                </div>
            </swiper-slide>

            <swiper-slide class="h-full">
                <div class=" w-full flex justify-center items-center h-5/6 lg:h-[60vh]">
                    <img class="h-5/6" :src="image2" alt="imagem">
                </div>
            </swiper-slide>

            <swiper-slide class="h-full">
                <div class=" w-full flex justify-center items-center h-5/6 lg:h-[60vh]">
                    <img class="h-5/6" :src="image3" alt="imagem">
                </div>
            </swiper-slide>

            <swiper-slide class="h-full">
                <div class=" w-full flex justify-center items-center h-5/6 lg:h-[60vh]">
                    <img class="h-5/6" :src="image4" alt="imagem">
                </div>
            </swiper-slide>

            <swiper-slide class="h-full">
                <div class=" w-full flex justify-center items-center h-5/6 lg:h-[60vh]">
                    <img class="h-5/6" :src="image5" alt="imagem">
                </div>
            </swiper-slide>

            <swiper-slide class="h-full">
                <div class=" w-full flex justify-center items-center h-5/6 lg:h-[60vh]">
                    <img class="h-5/6" :src="image3" alt="imagem">
                </div>
            </swiper-slide>




        </swiper>
    </div>
</template>

<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';



// import required modules
import { Navigation, Pagination, Mousewheel, Keyboard, Autoplay } from 'swiper/modules';

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        const navigationOptions = {
            nextEl: '.custom-next',
            prevEl: '.custom-prev',
        };

        
        return {
            modules: [Navigation, Pagination, Mousewheel, Keyboard, Autoplay],
            navigationOptions,
            image1: '/images/1/i1.png',
            image2: '/images/1/i2.png',
            image3: '/images/1/i3.png',
            image4: '/images/1/i4.png',
            image5: '/images/1/i5.png',
        };
    },
};
</script>
  

