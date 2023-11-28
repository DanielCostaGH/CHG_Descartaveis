<template>
    <div class="flex">
        <!-- Barra lateral -->
        <sidebar />

        <!-- Conteúdo principal -->
        <main class="w-4/5 p-6 bg-gray-100">
            <!-- Painel de controle -->
            <painel />

            <!-- Botão para adicionar categoria -->
            <div class="flex justify-end mb-4">
                <button @click="addCategory" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    <a href="/dashboard/categories/create">Adicionar Categoria</a>
                </button>
            </div>

            <!-- Lista de Categorias -->
            <section class="bg-white h-[75vh] overflow-y-scroll">
                <v-row>
                    <v-col>
                        <v-card class="pa-4 shadow-md rounded-lg">
                            <v-card-title class="text-h5 font-medium">Lista de Categorias</v-card-title>
                            <v-row>
                                <v-col v-for="(category, index) in categories" :key="index" cols="12" md="6" lg="4">
                                    <v-card class="pa-4 shadow-md rounded-lg">
                                        <v-card-title class="text-h6 font-medium mt-2">{{ category.name }}</v-card-title>
                                        <v-img :src="`/images/categories/${category.id}/${category.images}`" class="my-4"
                                            aspect-ratio="2.0" contain></v-img>
                                        <v-card-actions class="justify-around px-5">
                                            <v-btn :href="`/dashboard/categories/edit/${category.id}`"
                                                prepend-icon="mdi-pencil" color="indigo" size="large" rounded="lg"
                                                class="px-5">
                                                Editar
                                            </v-btn>
                                            <v-btn @click="confirmDelete(category.id)" prepend-icon="mdi-delete" color="red"
                                                size="large" rounded="lg" class="px-5">
                                                Excluir categoria
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                    <div v-if="categories.length === 0" class="text-center py-10">
                                        Nenhuma categoria encontrada.
                                    </div>
                                </v-col>
                            </v-row>
                        </v-card>
                    </v-col>
                </v-row>

            </section>
        </main>
    </div>
</template>

<script>
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'
import axios from 'axios';

export default {
    props: {
        categories: {
            type: Array,
            default: () => [],
        },
    },

    components: {
        sidebar,
        painel,
    },

    methods: {
        async confirmDelete(categoryId) {
            if (confirm('Tem certeza que deseja excluir esta categoria?')) {
                await this.deleteCategory(categoryId);
            }
        },

        async deleteCategory(categoryId) {
            try {
                await axios.delete(`/dashboard/category/delete/${categoryId}`);
                window.location.href = '/dashboard/categories';
            } catch (error) {
                console.error('Erro ao excluir categoria:', error);
                alert('Houve um erro ao excluir a categoria. Por favor, tente novamente.');
            }
        },
    },
};
</script>
