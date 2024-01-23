<template>
    <v-container fluid class="my-5 py-3 border-y">

        <!-- MODELO DESKTOP -->
        <v-row class="d-none d-lg-flex justify-center align-center text-lg overflow-hidden">
            <v-col cols="auto" class="text-center">
                <v-menu open-on-hover offset-y>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn href="/products" color="#212844" text dark v-bind="attrs" v-on="on">
                            Todos os Produtos
                        </v-btn>
                    </template>
                </v-menu>
            </v-col>

            <v-col cols="auto" v-for="topic in topicOptions" :key="topic.id">
                <v-btn :href="`/products?categoryId=${topic.id}`" text color="blue-grey-lighten-4" class="mx-2">
                    {{ topic.name }}
                </v-btn>
            </v-col>


            <v-col cols="auto">
                <v-btn color="green-accent-4" class="mx-2 text-white" :href="'/'">
                    <span class="pr-2 ">Falar com vendedor</span>
                    <v-icon>
                        mdi-whatsapp
                    </v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <!-- MODELO MOBILE -->
        <v-row class="d-lg-none justify-center align-center text-lg overflow-x-auto">
            <v-col cols="12" class="d-flex justify-space-between">
                <v-menu open-on-hover offset-y>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn href="/products" color="#212844" text dark v-bind="attrs" v-on="on">
                            Ver Produtos
                        </v-btn>
                    </template>
                </v-menu>

                <v-btn text color="green-accent-4" class="mx-2 white--text" :href="'/'">
                    <span class="pr-2 text-white">Whatsapp</span>
                    <v-icon class="text-white">
                        mdi-whatsapp
                    </v-icon>
                </v-btn>
            </v-col>
        </v-row>

    </v-container>
</template>

<script>
export default {
    data() {
        return {
            topicOptions: []
        };
    },

    methods: {
        async loadTopicOptions() {
            try {
                const response = await axios.get('/api/category');
                this.topicOptions = response.data.slice(0, 4);
            } catch (error) {
                console.error(error);
            }
        },
    },

    mounted() {
        this.loadTopicOptions();
    }
};
</script>
