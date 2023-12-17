<template>
    <div class="flex">
        <sidebar />
        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>

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
                    <v-form @submit.prevent="updateProduct">
                        <v-row>

                            <v-col cols="12" md="6">
                                <v-text-field label="Nome do Produto" v-model="editedProduct.name" outlined
                                    placeholder="Nome do Produto">
                                </v-text-field>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field label="Marca" v-model="editedProduct.brand" outlined placeholder="Marca">
                                </v-text-field>
                            </v-col>

                            <v-col cols="12">
                                <v-textarea label="Descrição" v-model="editedProduct.description" outlined
                                    placeholder="Descrição do Produto" rows="4">
                                </v-textarea>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field
                                    label="Preço"
                                    v-model="editedProduct.price"
                                    type="number"
                                    step="0.01"
                                    outlined
                                    placeholder="Preço"
                                    :prefix="'R$ '"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-autocomplete v-model="editedProduct.colors" :items="colors" label="Cor" item-title="name"
                                    chips small-chips multiple class="pa-0" :menu-props="{ maxHeight: '300' }" hide-details
                                    return-object></v-autocomplete>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field label="Variação" v-model="newVariation" outlined
                                    placeholder="Variação"></v-text-field>
                                <div>
                                    <div class="flex justify-between my-3 max-h-[10vh] overflow-auto"
                                        v-for="(variation, index) in productVariations" :key="index">
                                        {{ variation }}
                                        <v-btn small @click="removeVariation(index)">Remover</v-btn>
                                    </div>
                                </div>

                                <v-btn @click="addVariation" color="blue" dark>Adicionar Variação</v-btn>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-select
                                v-model="editedProduct.categoryId"
                                :items="categoryNames"
                                label="Categoria"
                                outlined
                                @change="updateCategoryId"
                                ></v-select>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field label="Quantidade" v-model="editedProduct.quantity" type="number" outlined
                                    placeholder="Quantidade">
                                </v-text-field>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-select label="Status" v-model="editedProduct.status"
                                    :items="['active', 'inactive', 'out_of_stock']" outlined>
                                </v-select>
                            </v-col>

                            <v-col cols="12">
                                <v-btn @click="updateProduct" color="blue" dark large>
                                    Salvar Alterações
                                </v-btn>
                            </v-col>

                        </v-row>
                    </v-form>
                </v-col>
            </v-row>
        </main>
    </div>

    <v-dialog v-model="dialog" persistent max-width="50%">
        <v-card color="success">
            <v-card-text class="white--text text-h5 pt-15">
                <v-row align="center" justify="center">
                    <v-icon class="mr-2" size="x-large">mdi-check-circle</v-icon>
                    O produto foi editado com sucesso.
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="white" class="text-h6" text @click="confirmProductCreation">OK</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
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
            categories: [],
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
                categoryId: null,
            },
            newVariation: '',
            productVariations: [],
            colors: [],
            deletedImages: [],
            dialog: false,
        };
    },
    created() {
        this.fetchColors();
        if (this.$props.product) {
            const product = this.$props.product;
            this.editedProduct.id = product.id;
            this.editedProduct.name = product.name;
            this.editedProduct.description = product.description;
            this.editedProduct.price = product.price;
            this.editedProduct.images = product.images.split(';').filter(imgName => imgName.trim());
            this.editedProduct.selectedImage = product.selectedImage;
            this.editedProduct.brand = product.brand;
            if (product.colors) {
                this.editedProduct.colors = product.colors.split(';').map(colorId => {
                    return { id: parseInt(colorId.trim()) };
                });
            }
            this.editedProduct.variation = product.variation;
            this.editedProduct.quantity = product.quantity;
            this.editedProduct.status = product.status;
        }
        if (this.$props.product) {
            const product = this.$props.product;
            this.editedProduct.images = product.images.split(';').filter(imgName => imgName.trim());

            this.images = product.images.split(';').filter(imgName => imgName).map(imgName => {
                return {
                    src: `/images/products/${product.id}/${imgName.trim()}`,
                    name: imgName.trim()
                };
            });

            if (this.images.length > 0) {
                this.selectedImage = this.images[0].src;
            }
        }
    },
    filters: {
        formatPrice(value) {
            if (!value) return 'R$ 0,00';

            const price = parseFloat(value).toFixed(2);
            return `R$ ${price.replace('.', ',')}`; 
        }
    },
    methods: {

        updateCategoryId() {
            const selectedCategory = this.categories.find(
                category => category.name === this.editedProduct.categoryName
            );

            if (selectedCategory) {
                this.editedProduct.categoryId = selectedCategory.id;
            }
        },


        addImage() {
            if (this.newImage && this.newImage.length > 0) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const newImageFile = this.newImage[0];

                    this.images.push({
                        src: event.target.result,
                        name: newImageFile.name,
                        file: newImageFile
                    });

                    this.editedProduct.images = [...this.images];
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
            this.selectedImage = image.src;
        },
        removeImage(index) {
            const deletedImageName = this.editedProduct.images[index];

            this.images.splice(index, 1);
            this.editedProduct.images.splice(index, 1);

            this.deletedImages.push(deletedImageName);
        },


        addVariation() {
            if (this.newVariation.trim() !== '') {
                this.productVariations.push(this.newVariation);
                this.newVariation = '';
            }
        },


        removeVariation(index) {
            this.productVariations.splice(index, 1);
        },

        updateProduct() {
            const formData = new FormData();

            formData.append('name', this.editedProduct.name);
            formData.append('description', this.editedProduct.description);
            formData.append('price', this.formattedPrice);
            formData.append('brand', this.editedProduct.brand);
            formData.append('quantity', this.editedProduct.quantity);
            formData.append('status', this.editedProduct.status);
            formData.append('category', this.editedProduct.categoryId);

            this.productVariations.forEach((variation, index) => {
                formData.append(`variation[${index}]`, variation);
            });

            if (Array.isArray(this.editedProduct.colors)) {
                const selectedColorIds = this.editedProduct.colors.map(color => color.id);
                selectedColorIds.forEach(colorId => {
                    formData.append('colors[]', colorId);
                });
            }


            if (Array.isArray(this.editedProduct.images)) {
                this.editedProduct.images.forEach(imageInfo => {
                    if (!imageInfo.toBeDeleted && !imageInfo.file) {
                        formData.append('images[]', imageInfo.src);
                    }
                });
            } else if (this.editedProduct.images) {
                formData.append('images[]', this.editedProduct.images);
            }

            if (Array.isArray(this.images)) {
                this.editedProduct.images.forEach(imageInfo => {
                    if (imageInfo.file) {
                        formData.append('newImages[]', imageInfo.file);
                    }
                });
            }

            if (Array.isArray(this.deletedImages)) {
                this.deletedImages.forEach(deletedImage => {
                    formData.append('deletedImages[]', deletedImage);
                });
            }

            axios.post(`/dashboard/update/${this.editedProduct.id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then(response => {
                    this.product = response.data;
                    this.dialog = true;
                })
                .catch(error => {
                    console.error('Erro ao atualizar produto', error);
                });
        },

        confirmProductCreation() {
            this.dialog = false; // Fecha o diálogo
            window.location.href = '/dashboard/products'; // Redireciona o usuário
        },

        fetchColors() {
            axios.get('/api/colors')
                .then(response => {
                    this.colors = response.data;

                    if (this.$props.product && this.$props.product.colors) {
                        const selectedColorIds = this.$props.product.colors.split(';').map(colorId => parseInt(colorId.trim()));
                        this.editedProduct.colors = this.colors.filter(color => selectedColorIds.includes(color.id));
                    }
                })
                .catch(error => {
                    console.error("Erro ao buscar cores", error)
                });
        },
        fetchVariations() {
            axios.get(`/api/variations/${this.editedProduct.id}`)
                .then(response => {
                    this.productVariations = response.data;
                })
                .catch(error => {
                    console.error("Erro ao buscar variações", error);
                });
        },
        fetchCategories() {
            axios.get('/api/category')
                .then(response => {
                this.categories = response.data; 
            })
            .catch(error => {
                console.error("Erro ao buscar categorias", error);
            });
        },

    },

    mounted() {
        this.fetchColors();
        this.fetchVariations();
        this.fetchCategories();
    },
    computed: {
        formattedPrice() {
          if (!this.editedProduct.price) return null; 

          const price = parseFloat(this.editedProduct.price).toFixed(2); 
            return parseFloat(price.replace(',', '.')); 
        },
        categoryNames() {
            return this.categories.map(category => category.name);
        },
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

