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

                <v-row>
                    <!-- Coluna Esquerda: Upload e Visualização de Imagem -->
                    <v-col cols="12" md="6">
                        <v-card>
                            <v-img :src="selectedImage" aspect-ratio="1.5"></v-img>
                            <v-card-actions>
                                <v-file-input v-model="newImage" label="Escolher imagem" @change="uploadImage"
                                    outlined></v-file-input>
                                <v-btn color="primary" @click="addImage" class="ml-2">Adicionar Imagem</v-btn>
                            </v-card-actions>

                        </v-card>
                    </v-col>

                    <!-- Coluna Direita: Lista de Imagens Selecionadas -->
                    <v-col cols="12" md="6">
                        <v-list dense>
                            <v-subheader>Imagens Selecionadas</v-subheader>
                            <v-list-item v-for="(image, index) in images" :key="index" @click="selectImage(image)">

                                <div class="flex justify-between">
                                    <div class="flex items-center">
                                        <v-avatar size="80"><v-img :src="image.src"></v-img></v-avatar>

                                        <v-list-item-content class="mx-10">
                                            <v-list-item-title>{{ image.name }}</v-list-item-title>
                                        </v-list-item-content>
                                    </div>

                                    <v-list-item-action class="mx-10">
                                        <v-btn icon @click="removeImage(index)">
                                            <v-icon>mdi-delete</v-icon>
                                        </v-btn>
                                    </v-list-item-action>
                                </div>


                            </v-list-item>

                        </v-list>
                    </v-col>
                </v-row>


                <v-col cols="12 my-15 border-t-2">
                    <!-- Formulário -->
                    <v-form @submit.prevent="updateProduct">
                        <v-row>

                            <!-- Nome do Produto -->
                            <v-col cols="12" md="6">
                                <v-text-field label="Nome do Produto" v-model="editedProduct.name" outlined
                                    placeholder="Nome do Produto">
                                </v-text-field>
                            </v-col>

                            <!-- Marca -->
                            <v-col cols="12" md="6">
                                <v-text-field label="Marca" v-model="editedProduct.brand" outlined placeholder="Marca">
                                </v-text-field>
                            </v-col>

                            <!-- Descrição -->
                            <v-col cols="12">
                                <v-textarea label="Descrição" v-model="editedProduct.description" outlined
                                    placeholder="Descrição do Produto" rows="4">
                                </v-textarea>
                            </v-col>

                            <!-- Preço -->
                            <v-col cols="12" md="6">
                                <v-text-field label="Preço" v-model="editedProduct.price" type="number" step="0.01" outlined
                                    placeholder="Preço">
                                </v-text-field>
                            </v-col>

                            <!-- Cores Disponíveis (Autocomplete) -->
                            <v-col cols="12" md="6">
                                <v-autocomplete v-model="editedProduct.colors" :items="colors" label="Cor" item-title="name"
                                    variant="solo" chips small-chips multiple class="pa-0"
                                    :menu-props="{ maxHeight: '300' }" hide-details return-object></v-autocomplete>
                            </v-col>

                            <!-- Variação -->
                            <!-- Campo de Input para Variação -->
                            <v-col cols="12" md="6">
                                <v-text-field label="Variação" v-model="newVariation" outlined
                                    placeholder="Variação"></v-text-field>
                                <div>
                                    <div class="flex justify-between my-3 max-h-[10vh] overflow-auto" v-for="(variation, index) in productVariations" :key="index">
                                        {{ variation }}
                                        <!-- Botão para remover variação (opcional) -->
                                        <v-btn small @click="removeVariation(index)">Remover</v-btn>
                                    </div>
                                </div>

                                <!-- Botão Adicionar Variação -->
                                <v-btn @click="addVariation" color="blue" dark>Adicionar Variação</v-btn>
                            </v-col>


                            <!-- Quantidade -->
                            <v-col cols="12" md="6">
                                <v-text-field label="Quantidade" v-model="editedProduct.quantity" type="number" outlined
                                    placeholder="Quantidade">
                                </v-text-field>
                            </v-col>

                            <!-- Status -->
                            <v-col cols="12" md="6">
                                <v-select label="Status" v-model="editedProduct.status"
                                    :items="['active', 'inactive', 'out_of_stock']" outlined>
                                </v-select>
                            </v-col>

                            <!-- Botão Salvar Alterações -->
                            <v-col cols="12">
                                <v-btn @click="updateProduct" color="blue" dark large>
                                    Salvar Alterações
                                </v-btn>
                            </v-col>

                        </v-row>
                    </v-form>
                </v-col>
            </v-row>

            <!-- Área de Imagens -->
            <v-row>
                <v-col cols="12" md="6">
                    <!-- Visualização e Upload de Imagem -->
                    <!-- ... -->
                </v-col>
                <v-col cols="12" md="6">
                    <!-- Lista de Imagens Selecionadas -->
                    <!-- ... -->
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
    data() {
        return {
            down_arrow: '/images/down_arrow.svg',
            up_arrow: '/images/up_arrow.svg',
            defaultImage: '/images/empty.png',
            newImage: '',
            selectedImage: '',
            images: [],
            editedProduct: {
                name: '',
                description: '',
                price: null,
                images: [],
                selectedImage: '',
                brand: '',
                colors: [],
                variation: '',
                quantity: null,
                status: 'active',
            },
            newVariation: '',
            productVariations: [],
            colors: []
        };
    },
    created() {
        // Verifique se selectedProduct está disponível e carregado corretamente
        if (this.$props.product) {
            const product = this.$props.product;
            this.editedProduct.id = product.id;
            this.editedProduct.name = product.name;
            this.editedProduct.description = product.description;
            this.editedProduct.price = product.price;
            this.editedProduct.images = product.images;
            this.editedProduct.selectedImage = product.selectedImage;
            this.editedProduct.brand = product.brand;
            this.editedProduct.colors = product.colors;
            this.editedProduct.variation = product.variation;
            this.editedProduct.quantity = product.quantity;
            this.editedProduct.status = product.status;
            console.log("ID do produto após carregar:", this.editedProduct.id);
        }
        if (this.$props.product) {
            const product = this.$props.product;
            // ...outras atribuições...
            this.editedProduct.images = product.images;

            // Dividindo a string de imagens e criando a lista de imagens
            this.images = product.images.split(';').filter(imgName => imgName).map(imgName => {
                return {
                    src: `/images/products/${product.id}/${imgName.trim()}`,
                    name: imgName.trim()
                };
            });

            // Se houver imagens, defina a primeira como a imagem selecionada
            if (this.images.length > 0) {
                this.selectedImage = this.images[0].src;
            }
        }
    },
    methods: {

        addImage() {
            if (this.newImage && this.newImage.length > 0) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.images.push({
                        src: event.target.result,
                        name: this.newImage[0].name
                    });
                    this.newImage = '';
                };
                reader.readAsDataURL(this.newImage[0]);
            } else {
                console.error("Nenhuma imagem selecionada!");
            }
        },

        uploadImage() {
        },
        selectImage(image) {
            console.log("Imagem selecionada:", image.src);
            this.selectedImage = image.src;
        },
        removeImage(index) {
            this.images.splice(index, 1);
        },

        // Método para adicionar uma variação à lista de variações
        addVariation() {
            if (this.newVariation.trim() !== '') {
                this.productVariations.push(this.newVariation);
                this.newVariation = ''; // Limpa o campo de entrada após adicionar a variação
            }
        },


        removeVariation(index) {
            this.productVariations.splice(index, 1);
        },

        updateProducts() {
            const formData = new FormData();

            formData.append('name', this.editedProduct.name);
            formData.append('description', this.editedProduct.description);
            formData.append('price', this.editedProduct.price);
            formData.append('brand', this.editedProduct.brand);
            formData.append('quantity', this.editedProduct.quantity);
            formData.append('status', this.editedProduct.status);
            formData.append('variation', this.editedProduct.variation);

            this.editedProduct.colors.forEach(color => {
                formData.append('colors[]', color);
            });

            if (Array.isArray(this.editedProduct.images)) {
                this.editedProduct.images.forEach(imageInfo => {
                    if (imageInfo.file) {
                        formData.append('images[]', imageInfo.file);
                    }
                });
            }

            axios.put(`/dashboard/update/${this.editedProduct.id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then(response => {
                    this.product = response.data;
                })
                .catch(error => {
                    console.error('Erro ao atualizar produto', error);
                });
        },

        fetchColors() {
            axios.get('/api/colors')
                .then(response => {
                    this.colors = response.data
                })
                .catch(error => {
                    console.error("Erro ao buscar cores", error)
                });
        }

    },

    mounted() {
        this.fetchColors();
    },

    components: {
        sidebar,
        painel,
    },
    props: {
        product: Object,
    },
};
</script>

