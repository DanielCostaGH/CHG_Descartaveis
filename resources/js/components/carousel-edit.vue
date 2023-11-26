<template>
    <v-expansion-panels>
        <v-expansion-panel v-model="isOpen">
            <v-expansion-panel-title>
                <div class="flex justify-between cursor-pointer">
                    <h3 class="text-xl font-semibold text-gray-500 mb-4 pt-4">Carrossel de Imagens</h3>
                </div>
            </v-expansion-panel-title>

            <v-expansion-panel-text class="mt-5">
                <v-row>
                    <!-- Coluna Esquerda: Upload e Visualização de Imagem -->
                    <v-col cols="12" md="6">
                        <v-card>
                            <v-img :src="selectedImage" aspect-ratio="1.5"></v-img>
                            <v-card-actions>
                                <v-file-input v-model="newImage" accept="image/*" label="Escolher imagem"
                                    outlined></v-file-input>
                                <v-btn color="primary" @click="addImage" class="ml-2">Adicionar Imagem</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>

                    <!-- Coluna Direita: Lista de Imagens editadas -->
                    <v-col cols="12" md="6">
                        <v-list v-if="editedImages" dense>
                            <v-subheader>Novas imagens</v-subheader>
                            <v-list-item v-for="(image, index) in editedImages" :key="index" @click="selectImage(image)">
                                <!-- Conteúdo do Item da Lista -->
                            </v-list-item>
                        </v-list>
                        <!-- Coluna Direita: Lista de Imagens computadas -->

                        <v-list dense>
                            <v-subheader>Imagens do slide</v-subheader>
                            <v-list-item v-for="(image, index) in computedImages" :key="index" @click="selectImage(image)">
                                <!-- Conteúdo do Item da Lista -->
                            </v-list-item>
                        </v-list>

                    </v-col>
                </v-row>
                <!-- Botão para Salvar Alterações -->
                <v-btn @click="uploadNewImages" color="primary" class="mt-10 px-4 py-2 rounded">
                    Salvar Imagens
                </v-btn>
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>

    <!-- Alerta para feedback -->
    <v-alert class="alert-container text-xl" v-model="alert.show" :type="alert.type" dismissible>
        {{ alert.text }}
    </v-alert>
</template>


<script>
export default {
    data() {
        return {
            isOpen: false,
            computedImages: [], // Imagens já existentes
            editedImages: [],   // Imagens recém-adicionadas
            newImage: null,     // Imagem selecionada para adição
            maxImages: 8,       // Máximo de imagens permitidas
            alert: {
                show: false,
                text: '',
                type: ''
            },
        };
    },

    mounted() {
        this.fetchImages();
    },

    methods: {
        fetchImages() {
            axios.get('/api/slides/get')
                .then(response => {
                    this.computedImages = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.error('Erro ao buscar imagens', error);
                });
        },

        addImage() {
            if (this.computedImages.length + this.editedImages.length >= this.maxImages) {
                this.showAlert(`Máximo de ${this.maxImages} imagens permitidas.`, 'warning');
                return;
            }

            if (this.newImage && this.newImage) {
                let newImage = {
                    name: this.newImage.name,
                    file: this.newImage
                };
                this.editedImages.push(newImage);
                this.newImage = null;
            } else {
                this.showAlert("Nenhuma imagem válida selecionada!", 'error');
            }
        },


        uploadNewImages() {
            if (this.editedImages.length === 0) {
                this.showAlert("Nenhuma imagem nova para enviar!", 'warning');
                return;
            }

            this.editedImages.forEach(image => {
                const formData = new FormData();
                formData.append('image', image.file);

                axios.post('/api/slides', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                    .then(response => {
                        console.log('Imagem enviada com sucesso', response);
                        this.computedImages.push(image);
                        this.showAlert("Imagem(ns) enviada(s) com sucesso!", 'success');
                    })
                    .catch(error => {
                        console.error('Erro ao enviar imagem', error);
                        this.showAlert("Erro ao enviar imagem(ns)!", 'error');
                    });
            });

            // Limpa a lista de imagens editadas após o envio
            this.editedImages = [];
        },


        selectImage(image) {
            this.selectedImage = image.src;
        },

        removeImage(index) {
            if (this.selectedImage === this.computedImages[index].src) {
                this.selectedImage = '';
            }
            this.computedImages.splice(index, 1);
        },

        showAlert(text, type) {
            this.alert.text = text;
            this.alert.type = type;
            this.alert.show = true;

            setTimeout(() => {
                this.alert.show = false;
            }, 3000);
        },
    },
};

</script>



<style scoped>
/* Seus estilos existentes */
.alert-container {
    position: fixed;
    top: 10%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    width: 100%;
    padding: 4vh;
}

.v-alert {
    max-width: 600px;
}
</style>
