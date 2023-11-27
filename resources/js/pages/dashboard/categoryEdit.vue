<template>
    <div class="flex">
        <sidebar />
        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>

            <!-- Área Principal -->
            <v-row class="bg-white rounded-lg">
                <v-col cols="12">
                    <h2 class="text-h6">Produto: {{ editedProduct.name }}</h2>
                </v-col>

                <!-- Coluna Esquerda: Upload e Visualização de Imagem -->
                <v-col cols="12" md="6">
                    <v-card>
                        <v-img :src="selectedImage || `/images/categories/${category.id}/${category.images}`" aspect-ratio="1.5"></v-img>
                        <v-card-actions>
                            <v-file-input v-model="newImage" label="Escolher imagem" @change="addImage"
                                outlined></v-file-input>
                        </v-card-actions>
                    </v-card>
                </v-col>

                <!-- Coluna Direita: Formulário de Criação de Categoria -->
                <v-col cols="12" md="6">
                    <v-form @submit.prevent="updateCategory">
                        <!-- Campos para editar categoria -->
                        <v-col cols="12">
                            <v-text-field v-model="newCategory.name" label="Nome da Categoria"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-textarea v-model="newCategory.description" label="Descrição da Categoria" rows="4"></v-textarea>
                        </v-col>
                        <v-col cols="12">
                            <v-select v-model="newCategory.status" :items="['active', 'inactive']" label="Status"></v-select>
                        </v-col>
                        <!-- Botão Atualizar Categoria -->
                        <v-col cols="12">
                            <v-btn color="blue" dark large type="submit">
                                Atualizar Categoria
                            </v-btn>
                        </v-col>
                    </v-form>
                </v-col>
            </v-row>
        </main>
    </div>
</template>
  
<script>
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'
import axios from 'axios';

export default {
    props: {
        category: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            defaultImage: '/images/empty.png',
            newImage: '',
            selectedImage: '',
            editedProduct: {
                name: '',
                image: null,
            },
            newCategory: {
                name: this.category.name,
                description: this.category.description,
                status: this.category.status
            }
        };
    },
    
    methods: {
        addImage() {
            if (this.newImage && this.newImage.length > 0) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const newImageFile = this.newImage[0];

                    this.newCategory.image = {
                        src: event.target.result,
                        name: newImageFile.name,
                        file: newImageFile
                    };
                    this.selectedImage = this.newCategory.image.src;
                    this.newImage = '';
                };
                reader.readAsDataURL(this.newImage[0]);
            } else {
                console.error('Nenhuma imagem selecionada!');
            }
        },
        updateCategory() {
            const formData = new FormData();
            formData.append('name', this.newCategory.name);
            formData.append('description', this.newCategory.description);
            formData.append('status', this.newCategory.status);

            if (this.newCategory.image !== undefined) {
                formData.append('images', this.newCategory.image.file);
            }

            axios.post(`/dashboard/category/update/${this.category.id}`, formData)
                .then(response => {
                    window.location.href = '/dashboard/categories';
                })
                .catch(error => {
                    console.error('Erro ao atualizar categoria:', error);
                });
        },

    },
    components: {
        sidebar,
        painel,
    },
};
</script>
  