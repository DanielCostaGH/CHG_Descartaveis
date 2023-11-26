<template>
    <div class="flex">
        <!-- Barra lateral -->
        <sidebar />

        <!-- Conteúdo principal -->
        <main class="w-4/5 p-6 bg-gray-100">
            <!-- Header -->
            <header>
                <painel />
            </header>

            <div class="p-4 w-full h-screen overflow-y-scroll">

                <!-- <section class="my-10 ">
                    <topics />
                </section> -->

                <section class="my-10">
                    <carousel />
                </section>

                <section class="my-10">
                    <category />
                </section>

                <section class="my-10">
                    <top_marcas />
                </section>

                <!-- <section class="my-10">
                    <about />
                </section> -->

                <section class="my-10">
                    <foot />
                </section>
            </div>
        </main>
    </div>
</template>

<script>
import filters from '../../components/filters.vue'
import sidebar from '../../components/side-bar-dashboard.vue'
import carousel from '../../components/carousel-edit.vue'
import topics from '../../components/topics-edit.vue'
import category from '../../components/category-edit.vue'
import foot from '../../components/footer-edit.vue'
import top_marcas from '../../components/top-marcas-edit.vue'
import about from '../../components/about-edit.vue'
import painel from '../../components/painel-bar.vue'

export default {
    data() {
        return {
            down_arrow: '/images/down_arrow.svg',
            images: [],
            imageOrder: 1,
            deleteConfirmation: null,
        };
    },
    components: {
        filters,
        sidebar,
        carousel,
        topics,
        category,
        foot,
        top_marcas,
        about,
        painel,
    },

};
</script>




