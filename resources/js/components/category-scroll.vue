<template>
    <div class="container mx-auto mt-10">
        <!-- Seção para desktop -->
        <div class="d-none d-lg-flex flex-column">
            <v-row justify="space-between" align="center">
                <v-col cols="auto">
                    <span class="text-h6 ml-2">Melhores Categorias!</span>
                </v-col>
                <v-col cols="auto" class="text-right">
                    <v-btn class="mx-2" text :href="'/products'">
                        Ver Todos
                        <v-icon right>
                            mdi-arrow-right
                        </v-icon>
                    </v-btn>
                </v-col>
            </v-row>
            <hr class="hidden lg:block border-b-2 border-[#212844] w-1/5 rounded-full my-2" />

            <div class="d-flex justify-space-between my-10">
                <div v-for="category in categories" :key="'mobile-' + category.name" class="mx-3 text-center">
                    <v-sheet class="d-flex justify-center align-center overflow-hidden" tile shaped>

                        <a :href="`products/${category.name}`">
                            <v-avatar size="208" color="grey-lighten-1 border-lg">
                                <img :src="category.image" :alt="category.name" class="fill-avatar">
                            </v-avatar>
                        </a>
                    </v-sheet>
                    <span class="font-weight-bold grey--text">{{ category.name }}</span>
                </div>
            </div>
        </div>






        <!-- Seção para mobile -->
        <div class="d-lg-none">
            <v-row justify="space-between" align="center">
                <v-col cols="auto">
                    <span class="text-h6 ml-2">Top Categorias!</span>
                </v-col>
                <v-col cols="auto" class="text-right">
                    <v-btn class="mx-2" text :href="'/products'">
                        Ver Todos
                        <v-icon right>
                            mdi-arrow-right
                        </v-icon>
                    </v-btn>
                </v-col>
            </v-row>


            <div class="d-flex overflow-x-auto py-8">
                <div v-for="category in categories" :key="'mobile-' + category.name" class="mx-3 text-center">
                    <v-sheet class="d-flex justify-center align-center overflow-hidden" tile shaped>

                        <a :href="`products/${category.name}`">
                            <v-avatar size="208" color="grey lighten-4">
                                <img :src="category.image" :alt="category.name" class="fill-avatar">
                            </v-avatar>
                        </a>
                    </v-sheet>
                    <span class="font-weight-bold grey--text">{{ category.name }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {


    data() {
        return {
            categories: [],
        };

    },
    methods: {

        fetchCategories() {
            axios.get('/api/main-categories/get')
                .then(response => {
                    this.categories = response.data.map(category => ({
                        ...category,
                        image: `/images/categories/${category.id}/${category.images}`
                    }));
                })
                .catch(error => {
                    console.error("Erro ao buscar categorias:", error);
                });
        },


        goToCategory(categoryName) {
            this.$router.push(`/products/category/${categoryName}`);
        },
    },

    mounted() {
        this.fetchCategories();
    },


};
</script>


<style>
.fill-avatar {
    object-fit: cover;
    border-radius: 50%;
    width: 100%;
    height: 100%;
    min-width: 100%;
    min-height: 100%;
    object-position: center;
}



.btn-reset {
    padding: 0;
    min-width: 0;
    margin: 0;
    box-shadow: none;
    border: none;
}

.btn-reset>.v-btn__content {
    padding: 0 !important;
    color: transparent;
    border: none;
}

.btn-no-hover::before,
.btn-no-hover::after {
    background-color: transparent !important;
}

.btn-no-hover:hover,
.btn-no-hover:focus,
.btn-no-hover:active {
    background-color: transparent !important;
    box-shadow: none !important;
    border: none;
    color: transparent;
}
</style>
