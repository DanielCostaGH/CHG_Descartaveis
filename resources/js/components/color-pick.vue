<template>
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
        <button @click="addColor" class="bg-blue-500 text-white hover:bg-blue-600 py-2 px-4 rounded">
            Adicionar Cor
        </button>
    </div>


    <!-- Modal para adicionar cores -->
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-md w-1/3">
            <h3 class="text-xl font-semibold mb-4">Adicionar Cores</h3>
            <!-- Valor especifico -->
            <div class="mb-4">
                <label for="hexColor" class="block text-gray-700 font-bold mb-2">Cor
                    Específica</label>
                <input type="text" id="hexColor" v-model="hexValue" class="w-full p-2 border rounded"
                    placeholder="#RRGGBB" />
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
            <div class="flex justify-end mt-4">
                <button @click="closeModal" class="bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded">
                    Fechar
                </button>
                <button @click="addSelectedColors" class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 ml-2 rounded">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    data() {
        return {
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
                colors: [], 
            },
        };
    },
    methods: {
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
        addSelectedColors() {
            this.selectedColors.forEach(color => {
                this.editedProduct.colors.push(color);
            });
            this.closeModal();
            this.selectedColors = [];
        },
    },
};
</script>