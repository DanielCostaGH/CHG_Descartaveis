<template>
    <div class="flex">
        <sidebar />
        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>

            <!-- Conteúdo de edição do produto -->
            <div class="bg-white p-4 rounded  max-h-[80vh] overflow-scroll">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Adicionar Produto</h2>

                <!-- Formulário de edição do produto -->
                <form @submit.prevent="updateProduct" action="/dashboard/store" method="POST">
                    <div class="flex flex-wrap justify-around">

                        <!-- CAMPO DA IMAGEM -->
                        <div class="max-h-[90vh] max-w-[60vh]" style="scrollbar-width: none; -ms-overflow-style: none;">
                            <label for="productImages" class=" text-gray-700 font-bold mb-2">Imagens</label>
                            <img :src="editedProduct.selectedImage ? editedProduct.selectedImage : defaultImage"
                                alt="imagem" class="mb-2 mx-auto h-[40vh]" />
                            <input type="file" id="productImages" class="w-full p-2  rounded" accept="image/*"
                                @change="onImageChange" multiple />
                            <div>
                                <span class="font-semibold text-gray-700">Imagens do produto:</span>
                                <ul>
                                    <li v-for="(image, index) in editedProduct.images" :key="index"
                                        class="flex items-center justify-between my-3 px-1 py-2 border-b hover hover:shadow">
                                        <div>
                                            <button @click="moveImageUp(index)" type="button" class="text-blue-500 mx-1">
                                                <img :src="up_arrow" alt="seta subir" />
                                            </button>

                                            <button @click="moveImageDown(index)" type="button" class="text-blue-500 mx-1">
                                                <img :src="down_arrow" alt="seta descer" />
                                            </button>

                                            <img :src="image.url" alt="Imagem do produto"
                                                class="inline-block w-10 h-10 mx-4 cursor-pointer"
                                                @click="selectImage(image.url)" />
                                            <span class="text-gray-800">{{ image.name }}</span>
                                        </div>

                                        <div>
                                            <button @click="removeImage(index)" type="button" class="ml-2">
                                                <img :src="close" alt="" />
                                            </button>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <!-- CAMPOS DO FORMULÁRIO -->
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

                            <!-- Nova seção para adicionar cores -->
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2">Cores Disponíveis</label>
                                <div v-for="(color, index) in editedProduct.colors" :key="index"
                                    class="flex items-center mb-2 max-h-[10vh] overflow-scroll">
                                    <div class="w-8 h-8 mr-2" :style="{ backgroundColor: color }"></div>
                                    <span class="text-gray-800">{{ color }}</span>
                                    <button @click="removeColor(index)" type="button" class="ml-2 text-red-500">
                                        <img :src="close" alt="" />
                                    </button>
                                </div>
                                <button @click="addColor"
                                    class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 rounded">
                                    Adicionar Cor
                                </button>
                            </div>


                            <div class="mb-4">
                                <div>
                                    <label for="productVariation"
                                        class="block text-gray-700 font-bold mb-2">Variação</label>
                                    <div class="flex justify-between">
                                        <input type="text" id="productVariation" v-model="newVariation"
                                            class="p-2 border rounded" placeholder="Variação" />
                                        <button @click="addVariation"
                                            class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 rounded">
                                            Adicionar Variação
                                        </button>
                                    </div>
                                </div>

                                <!-- Lista de Variações -->
                                <div class="mt-4">
                                    <ul class="border-b w-4/6 ">
                                        <li class="flex justify-between p-2" v-for="(variation, index) in productVariations"
                                            :key="index">
                                            {{ variation }}
                                            <!-- Botão para remover a variação -->
                                            <button @click="removeVariation(index)" class="text-red-500 ml-2">
                                                <img :src="close" alt="" />
                                            </button>
                                        </li>
                                    </ul>
                                </div>

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


    <!-- Modal para adicionar cores -->
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-md w-1/3">
            <h3 class="text-xl font-semibold mb-4">Adicionar Cores</h3>

            <!-- Valor especifico -->
            <div class="mb-4">
                <label for="hexColor" class="block text-gray-700 font-bold mb-2">Cor Específica</label>
                <input type="text" id="hexColor" v-model="hexValue" class="w-full p-2 border rounded"
                    placeholder="#999999" />
            </div>

            <!-- Lista de cores -->
            <div class="mb-4 max-h-[40vh] overflow-scroll">
                <label class="block text-gray-700 font-bold mb-2">Cores</label>
                <div v-for="(color, index) in colors" :key="index" class="flex items-center mb-2 w-2/5 justify-between">
                    <div class="flex">
                        <div class="w-8 h-8 mr-2" :style="{ backgroundColor: color.code }"></div>
                        <span class="text-gray-800">{{ color.name }}</span>
                    </div>
                    <input type="checkbox" v-model="selectedColors" :value="color.code" class="ml-2" />
                </div>
            </div>

            <!-- Adicione o botão "Adicionar" aqui -->
            <div class="flex justify-end mt-4">
                <button @click="closeModal" class="bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded">
                    Fechar
                </button>
                <button @click="addSelectedColorsAndInput"
                    class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 ml-2 rounded">
                    Adicionar
                </button>
            </div>
        </div>
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
            defaultImage: '/images/empty.png',
            imageUrlBase: '',
            close: '/images/close.svg',
            showModal: false,
            hexValue: '',
            colors: [
                { name: 'Vermelho', code: '#FF0000' },
                { name: 'Verde', code: '#00FF00' },
                { name: 'Azul', code: '#0000FF' },
                { name: 'Amarelo', code: '#FFFF00' },
                { name: 'Preto', code: '#000000' },
                { name: 'Branco', code: '#FFFFFF' },
                { name: 'Laranja', code: '#FFA500' },
                { name: 'Roxo', code: '#800080' },
                { name: 'Rosa', code: '#FFC0CB' },
                { name: 'Marrom', code: '#8B4513' },
                { name: 'Verde Limão', code: '#32CD32' },
                { name: 'Turquesa', code: '#40E0D0' },
                { name: 'Dourado', code: '#FFD700' },
                { name: 'Prateado', code: '#C0C0C0' },
                { name: 'Aqua', code: '#00FFFF' },
                { name: 'Salmon', code: '#FA8072' },
                { name: 'Azul Marinho', code: '#000080' },
                { name: 'Verde Oliva', code: '#808000' },
                { name: 'Roxo Escuro', code: '#9400D3' },
                { name: 'Violeta', code: '#EE82EE' },
                { name: 'Cinza Claro', code: '#D3D3D3' },
            ],
            selectedColors: [],
            editedProduct: {
                name: '',
                description: '',
                price: null,
                images: [],
                selectedImage: '',
                brand: '',
                colors: [],
                variation: [],
                quantity: null,
                status: 'active',
            },
            newVariation: '',
            productVariations: [],

        };
    },
    methods: {
        onImageChange(event) {
            const files = event.target.files;
            if (files && files.length > 0) {
                for (let i = 0; i < files.length; i++) {
                    const imageName = files[i].name;
                    const imageUrl = URL.createObjectURL(files[i]);
                    const imageInfo = {
                        name: imageName,
                        url: imageUrl,
                    };
                    this.editedProduct.images.push(imageInfo);
                }

                if (!this.editedProduct.selectedImage && this.editedProduct.images.length > 0) {
                    this.editedProduct.selectedImage = this.editedProduct.images[0].url;
                }
            }
        },
        updateProduct() {
            // Mapeie os objetos de imagem para URLs completas
            const imagesWithUrls = this.editedProduct.images.map(imageInfo => {
                return imageInfo.name + this.imageUrlBase; // Certifique-se de que this.imageUrlBase seja definida
            });

            axios.post('/dashboard/store', {
                name: this.editedProduct.name,
                description: this.editedProduct.description,
                price: this.editedProduct.price,
                images: imagesWithUrls,
                brand: this.editedProduct.brand,
                color: this.editedProduct.colors,
                variation: this.editedProduct.variation,
                quantity: this.editedProduct.quantity,
                status: this.editedProduct.status
            })
                .then(response => {
                    console.log('Produto atualizado com sucesso', response.data);
                })
                .catch(error => {
                    console.error('Erro ao atualizar o produto', error);
                });
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
            const parts = imageUrl.split('/');
            const fileName = parts[parts.length - 1];
            const fileNameWithExtension = fileName.split('?')[0]; // Remove parâmetros da URL, se houver
            return fileNameWithExtension;
        },
        addColor() {
            this.showModal = true;
        },
        removeColor(index) {
            this.editedProduct.colors.splice(index, 1);
        },
        openModal() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
            this.hexValue = '';
        },
        // Método para adicionar cores selecionadas e/ou a cor específica
        addSelectedColorsAndInput() {
            // Adicionar cores selecionadas
            if (this.selectedColors.length > 0) {
                this.selectedColors.forEach(color => {
                    this.editedProduct.colors.push(color);
                });
                this.selectedColors = [];
            }

            // Adicionar a cor específica se houver um valor
            if (this.hexValue) {
                this.editedProduct.colors.push(this.hexValue);
                this.hexValue = ''; // Limpar o valor após adicionar a cor
            }

            this.closeModal();
        },

        // Método para adicionar uma variação a lista de variações
        addVariation() {
            if (this.newVariation.trim() !== '') {
                this.productVariations.push(this.newVariation);
                this.newVariation = '';
                this.editedProduct.variation = [...this.productVariations];
            }
        },

        removeVariation(index) {
            this.productVariations.splice(index, 1);
        },
    },

    components: {
        sidebar,
        painel,
    },
};
</script>