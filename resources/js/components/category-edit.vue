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

    <v-dialog v-model="dialogDeleteSuccess" transition="dialog-bottom-transition" persistent max-width="500">
        <v-card height="300" class="pa-3 rounded-xl">
            <v-card-text>
                <div class="flex flex-wrap justify-center items-center">
                    <div class="w-full flex justify-center my-5">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2" class="svg2">
                            <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10"
                                cx="65.1" cy="65.1" r="62.1" />
                            <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6"
                                stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                        </svg>
                    </div>

                    <div>
                        <span class="font-weight-bold text-green-darken-3">Categorias atualizadas com sucesso!</span>
                    </div>
                </div>


            </v-card-text>
            <v-card-actions class="justify-center">
                <v-btn class="bg-green-darken-3" color="gray darken-1" text @click="closeDialogDeleteSuccess">OK</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

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
            dialogDeleteSuccess: false,
            alert: {
                show: false,
                text: '',
                type: '' 
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
                    this.openDialogDeleteSuccess();
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
        },

        openDialogDeleteSuccess() {
            this.dialogDeleteSuccess = true;
        },
        closeDialogDeleteSuccess() {
            this.dialogDeleteSuccess = false;
        },


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
