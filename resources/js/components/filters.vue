<template>
    <!-- SEÇÃO DESKTOP -->
    <div class="my-5 py-3 border-y d-none d-lg-block">
        <v-row class="align-center justify-space-between">
            <v-col cols="12" md="3">
                <v-btn-toggle v-model="priceSort" mandatory borderless color="blue lighten-5" class="pa-0">
                    <v-btn value="lower">Menor Preço</v-btn>
                    <v-btn value="higher">Maior Preço</v-btn>
                </v-btn-toggle>
            </v-col>

            <v-col cols="12" md="3">
                <v-autocomplete v-model="selectedCategories" :items="categories" item-title="name" item-value="id"
                    label="Categorias" variant="solo" chips small-chips multiple class="pa-0"
                    :menu-props="{ maxHeight: '300' }" hide-details return-object></v-autocomplete>
            </v-col>

            <v-col cols="12" md="3">
                <v-autocomplete v-model="selectedColors" :items="colors" label="Cor" item-title="name" variant="solo" chips small-chips
                    multiple class="pa-0" :menu-props="{ maxHeight: '300' }" hide-details return-object></v-autocomplete>
            </v-col>

            <v-col cols="12" md="1">
                <v-btn color="error" size="large" dark class="width-100" @click="clearFilters">
                    <v-icon class="mr-3">mdi-filter-remove</v-icon>
                </v-btn>
            </v-col>

            <v-col cols="12" md="2">
                <v-btn color="indigo" size="large" dark class="width-100" @click="applyFilter">
                    <v-icon class="mr-3">mdi-layers-search</v-icon>
                    Pesquisar</v-btn>
            </v-col>
        </v-row>
    </div>
    <!-- FINAL DA SEÇÃO DESKTOP -->





    <!-- SEÇÃO MOBILE -->

    <div class="my-5 py-3 border-y d-lg-none ">
        <v-btn class="d-md-none mx-5" color="indigo" @click="dialog = true">Filtros</v-btn>

        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card>
                <v-toolbar dark color="indigo">
                    <v-btn icon @click="dialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn dark text @click="clearFilters">Limpar</v-btn>
                    <v-btn dark text @click="applyFilter">Aplicar</v-btn>
                </v-toolbar>

                <!-- Conteúdo da Modal -->
                <div class="my-5 py-3 border-y">
                    <v-row class="align-center justify-space-between">
                        <v-col cols="12" md="3">
                            <v-btn-toggle v-model="priceSort" mandatory borderless color="blue lighten-5" class="pa-0">
                                <v-btn value="lower">Menor Preço</v-btn>
                                <v-btn value="higher">Maior Preço</v-btn>
                            </v-btn-toggle>
                        </v-col>

                        <v-col cols="12" md="3">
                            <v-autocomplete v-model="selectedCategories" :items="categories" item-title="name" label="Categorias"
                                variant="solo" chips small-chips multiple class="pa-0" :menu-props="{ maxHeight: '300' }"
                                hide-details return-object></v-autocomplete>
                        </v-col>

                        <v-col cols="12" md="3">
                            <v-autocomplete v-model="selectedColors" :items="colors" label="Cor" item-title="name" variant="solo" chips
                                small-chips multiple class="pa-0" :menu-props="{ maxHeight: '300' }" hide-details
                                return-object></v-autocomplete>
                        </v-col>

                    </v-row>
                </div>


            </v-card>
        </v-dialog>


    </div>

    <!-- FINAL DA SEÇÃO MOBILE -->
</template>

<script>
export default {
    data() {
        return {
            selectedCategories: [],
            selectedColors: [],
            categories: [],
            colors: [],
            priceSort: null,
            dialog: false,
        };
    },
    methods: {
        applyFilter() {
            const filters = {
                selectedCategories: this.selectedCategories.map(cat => cat.id),
                selectedColors: this.selectedColors.map(cat => cat.id),
                priceSort: this.priceSort,
            };

            this.$emit('filter-applied', filters);
            this.dialog = false;
        },


        fetchCategory() {
            axios.get('/api/category')
                .then(response => {
                    this.categories = response.data
                })
                .catch(error => {
                    console.error('Erro ao buscar categorias:', error);
                });
        },

        fetchColors(){
            axios.get('/api/colors')
            .then(response => {
                this.colors = response.data
            })
            .catch(error =>{
                console.error("Erro ao buscar cores", error)
            });
        },


        clearFilters() {
            this.selectedCategories = [];
            this.selectedColors = [];
            this.priceSort = null;
            this.applyFilter();
        },
    },

    mounted() {
        this.fetchCategory();
        this.fetchColors();
    },

};
</script>


