<template>
    <v-expansion-panels>
        <v-expansion-panel v-model="isOpen">
            <v-expansion-panel-title>
                <div class="flex justify-between">
                    <h3 class="text-xl font-semibold text-gray-500 mb-4 pt-4">Principais Categorias</h3>
                </div>
            </v-expansion-panel-title>

            <v-expansion-panel-text>
                <!-- Lista de Categorias Atuais -->
                <div>
                    <div class="flex w-1/2 py-5">
                        <v-select v-model="selectedCategories" :items="categories" item-title="name" label="Categorias"
                            variant="solo" class="pa-0" :menu-props="{ maxHeight: '300' }" hide-details
                            return-object></v-select>


                        <v-btn class="ml-5" @click="addCategory">
                            Adicionar Categoria
                        </v-btn>


                    </div>


                    <v-list-item v-for="(category, index) in editedCategories" :key="index">

                        <div class="flex justify-between">
                            <div class="flex items-center">

                                <v-avatar size="80">
                                    <v-img :src="getImagePath(category)"></v-img>
                                </v-avatar>

                                <v-list-item-content class="mx-10">
                                    <v-list-item-title>{{ category.name }}</v-list-item-title>
                                </v-list-item-content>
                            </div>

                            <v-list-item-action class="mx-10">
                                <v-btn icon @click="removeCategory(index)">
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </v-list-item-action>
                        </div>


                    </v-list-item>




                    <!-- Botão para Salvar Alterações -->
                    <v-btn @click="saveChanges" color="primary" class="mt-10 px-4 py-2 rounded">
                        Salvar Alterações
                    </v-btn>
                </div>
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>

    <v-alert class="alert-container text-xl elevation-5 custom-border " v-model="alert.show" :type="alert.type" dismissible>
        {{ alert.text }}
    </v-alert>
</template>


<script>
export default {
    data() {
        return {
            down_arrow: '/images/down_arrow.svg',
            isOpen: false,
            categories: [],
            editedCategories: [],
            selectedCategories: [],
            alert: {
                show: false,
                text: '',
                type: '' // 'success' para sucesso e 'error' para erro
            },
        };
    },
    methods: {

        fetchMainCategories() {
            axios.get('/api/main-categories/get')
                .then(response => {
                    this.editedCategories = response.data;
                })
                .catch(error => {
                    console.error('Erro ao buscar categorias principais:', error);
                });
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

        addCategory() {
            if (this.selectedCategories) {
                this.editedCategories.push({
                    ...this.selectedCategories,
                    category_id: this.selectedCategories.id
                });

                this.selectedCategories = null;
            }
        },



        getImagePath(category) {
            let path = `/images/categories/${category.category_id}/${category.images}`;
            return path;
        },



        removeCategory(index) {
            this.editedCategories.splice(index, 1);
        },

        saveChanges() {
            axios.post('/api/main-categories/update', { categories: this.editedCategories })
                .then(response => {
                    this.showAlert('Principais categorias atualizadas com sucesso!', 'success');
                })
                .catch(error => {
                    console.error('Erro ao salvar categorias:', error);
                    this.showAlert('Erro ao atualizar categorias', 'error');
                });
        },

        showAlert(text, type) {
            this.alert.text = text;
            this.alert.type = type;
            this.alert.show = true;

            setTimeout(() => {
                this.alert.show = false;
            }, 2000); // 3000 milissegundos = 3 segundos
        }


    },

    mounted() {
        this.fetchMainCategories();
        this.fetchCategory();
    }
};
</script>



<style scoped>
.alert-container {
    position: fixed;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    width: 100%;
    padding: 4vh;
}

.v-alert {
    max-width: 600px;
}
.custom-border {
  border: 2px solid white;
}

</style>
