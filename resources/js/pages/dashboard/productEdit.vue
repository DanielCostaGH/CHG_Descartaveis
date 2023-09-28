<template>
    <div class="flex">
        <sidebar />
        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>

            <!-- Conteúdo de edição do produto -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Editar Produto</h2>

                <!-- Formulário de edição do produto -->
                <form @submit.prevent="updateProduct">
                    <div class="flex flex-wrap justify-around">

                        <!-- CAMPO DA IMAGEM -->
                        <div class="max-h-[90vh] overflow-scroll" style="scrollbar-width: none; -ms-overflow-style: none;">
                            <label for="productImages" class="block text-gray-700 font-bold mb-2">Imagens</label>
                            <img :src="editedProduct.selectedImage" alt="imagem" class="mb-2 mx-auto h-[40vh]" />
                            <input type="file" id="productImages" class="w-full p-2 border rounded" accept="image/*"
                                @change="onImageChange" multiple />
                            <div>
                                <span class="font-semibold text-gray-700">Imagens do produto:</span>
                                <ul>
                                    <li v-for="(image, index) in editedProduct.images" :key="index"
                                        class="flex items-center justify-between my-3 px-1 py-2 border-b hover hover:shadow">


                                        <div>
                                            <button @click="moveImageUp(index)" type="button" class="text-blue-500 mx-1">
                                                <img :src="up_arrow" alt="seta subir">
                                            </button>

                                            <button @click="moveImageDown(index)" type="button" class="text-blue-500 mx-1">
                                                
                                                <img :src="down_arrow" alt="seta descer">
                                            </button>

                                            <img :src="image" alt="Imagem do produto"
                                                class="inline-block w-10 h-10 mx-4 cursor-pointer"
                                                @click="selectImage(image)" />

                                            <span class="text-gray-800">{{ getImageName(image) }}</span>
                                        </div>

                                        <div>
                                            <button @click="removeImage(index)" type="button"
                                                class="ml-2">
                                                 <img :src="close" alt="">
                                            </button>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- CAMPOS DO FORMULARIO -->
                        <div class="w-2/6">
                            <div class="mb-4">
                                <label for="productName" class="block text-gray-700 font-bold mb-2">Nome do Produto</label>
                                <input type="text" id="productName" v-model="editedProduct.name"
                                    class="w-full p-2 border rounded" placeholder="Nome do Produto" />
                            </div>

                            <div class="mb-4">
                                <label for="productDescription" class="block text-gray-700 font-bold mb-2">Descrição</label>
                                <textarea id="productDescription" v-model="editedProduct.description"
                                    class="w-full p-2 border rounded" rows="4"
                                    placeholder="Descrição do Produto"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="productPrice" class="block text-gray-700 font-bold mb-2">Preço</label>
                                <input type="number" step="0.01" id="productPrice" v-model="editedProduct.price"
                                    class="w-full p-2 border rounded" placeholder="Preço" />
                            </div>

                            <div class="mb-4">
                                <label for="productBrand" class="block text-gray-700 font-bold mb-2">Marca</label>
                                <input type="text" id="productBrand" v-model="editedProduct.brand"
                                    class="w-full p-2 border rounded" placeholder="Marca" />
                            </div>

                            <div class="mb-4">
                                <label for="productColors" class="block text-gray-700 font-bold mb-2">Cores
                                    Disponíveis</label>
                                <input type="text" id="productColors" v-model="editedProduct.color"
                                    class="w-full p-2 border rounded" placeholder="Cores Disponíveis" />
                            </div>

                            <div class="mb-4">
                                <label for="productVariation" class="block text-gray-700 font-bold mb-2">Variação</label>
                                <input type="text" id="productVariation" v-model="editedProduct.variation"
                                    class="w-full p-2 border rounded" placeholder="Variação" />
                            </div>

                            <div class="mb-4">
                                <label for="productQuantity" class="block text-gray-700 font-bold mb-2">Quantidade</label>
                                <input type="number" id="productQuantity" v-model="editedProduct.quantity"
                                    class="w-full p-2 border rounded" placeholder="Quantidade" />
                            </div>

                            <div class="mb-4">
                                <label for="productStatus" class="block text-gray-700 font-bold mb-2">Status</label>
                                <select id="productStatus" v-model="editedProduct.status" class="w-full p-2 border rounded">
                                    <option value="active">Ativo</option>
                                    <option value="inactive">Inativo</option>
                                    <option value="out_of_stock">Sem Estoque</option>
                                </select>
                            </div>
                            <div class="flex my-10 justify-center">
                                <button type="submit" class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 rounded">
                                    Salvar Alterações
                                </button>
                            </div>
                        </div>

                    </div>


                </form>
            </div>
        </main>
    </div>
</template>
  
<script>
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'


export default {
    data() {
        return {
            down_arrow: '/images/down_arrow.svg',
            up_arrow: '/images/up_arrow.svg',
            close: '/images/close.svg',
            
            editedProduct: {
                name: '',
                description: '',
                price: null,
                images: [],
                selectedImage: '',
                brand: '',
                color: '',
                variation: '',
                quantity: null,
                status: 'active',
            },
        };
    },
    methods: {
        updateProduct() {
            // Lógica para enviar as alterações do produto para o servidor aqui
            console.log('Produto atualizado:', this.editedProduct);
        },
        moveImageUp(index) {
            if (index > 0) {
                const tempImage = this.editedProduct.images[index];
                this.editedProduct.images[index] = this.editedProduct.images[index - 1];
                this.editedProduct.images[index - 1] = tempImage;
            }
        },
        moveImageDown(index) {
            if (index < this.editedProduct.images.length - 1) {
                const tempImage = this.editedProduct.images[index];
                this.editedProduct.images[index] = this.editedProduct.images[index + 1];
                this.editedProduct.images[index + 1] = tempImage;
            }
        },
        onImageChange(event) {
            const files = event.target.files;
            if (files && files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const imageUrl = URL.createObjectURL(files[i]);
                    this.editedProduct.images.push(imageUrl);
                }
                if (!this.editedProduct.selectedImage) {
                    this.editedProduct.selectedImage = this.editedProduct.images[0];
                }
            }
        },
        removeImage(index) {
            this.editedProduct.images.splice(index, 1);
            if (this.editedProduct.selectedImage === this.editedProduct.images[index]) {
                this.editedProduct.selectedImage = '';
            }
        },
        selectImage(image) {
            this.editedProduct.selectedImage = image;
        },
        getImageName(imageUrl) {
            // Extrai o nome da imagem do URL (última parte após a última barra)
            const parts = imageUrl.split('/');
            return parts[parts.length - 1];
        },
    },
    components: {
        sidebar,
        painel,
    },
};
</script>
  