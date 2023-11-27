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
                                <v-file-input v-model="newImage" label="Escolher imagem" @change="uploadImage"
                                    outlined></v-file-input>
                                <v-btn color="primary" @click="addImage" class="ml-2">Adicionar Imagem</v-btn>
                            </v-card-actions>

                        </v-card>
                    </v-col>

                    <!-- Coluna Direita: Lista de Imagens Selecionadas -->
                    <v-col cols="12" md="6" class="overflow-y-scroll max-h-[55vh]">
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

                        <v-list>
                            <v-title>Imagens existentes</v-title>
                            <v-list-item v-for="(image, index) in computedImages" :key="index" @click="selectImage(image)">
                                <div class="flex justify-between">
                                    <div class="flex items-center">
                                        <v-avatar size="80"><v-img :src="getImagePath(image)"></v-img></v-avatar>

                                        <v-list-item-content class="mx-10">
                                            <v-list-item-title>{{ image.name }}</v-list-item-title>
                                        </v-list-item-content>
                                    </div>

                                    <v-list-item-action class="mx-10">
                                        <v-btn icon @click="openDialog(index)">
                                            <v-icon>mdi-delete</v-icon>
                                        </v-btn>
                                    </v-list-item-action>
                                </div>
                            </v-list-item>
                        </v-list>
                    </v-col>
                </v-row>
                <v-btn @click="uploadNewImages" color="primary" class="mt-10 px-4 py-2 rounded">
                    Salvar Imagens
                </v-btn>
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>

    <v-dialog v-model="dialog" persistent max-width="290" v-if="slideToDelete">
        <v-card>
            <v-card-title class="text-h5">Confirmar Exclusão</v-card-title>
            <v-card-text>
                Tem certeza que deseja excluir o slide: {{ slideToDelete.name }}?
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDialog">Cancelar</v-btn>
                <v-btn color="blue darken-1" text @click="confirmDelete">Confirmar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-alert class="alert-container text-xl" v-model="alert.show" :type="alert.type" dismissible>
        {{ alert.text }}
    </v-alert>
</template>


<script>
export default {
    data() {
        return {
            isOpen: false,
            computedImages: [],
            images: [],
            newImages: [],
            selectedImage: '',
            slideToDelete: null,
            dialog: false,
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
                })
                .catch(error => {
                });
        },

        getImagePath(image) {
            let path = `/images/slides/${image.images}`;
            return path;
        },

        selectImage(image) {
            this.selectedImage = this.getImagePath(image);
        },

        addImage() {
            if (this.computedImages.length + this.images.length >= 8) {
                this.showAlert('Máximo de 8 imagens permitidas.', 'warning');
            } else if (this.newImage && this.newImage.length > 0) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const newImageFile = this.newImage[0];

                    this.images.push({
                        src: event.target.result,
                        name: newImageFile.name,
                        file: newImageFile
                    });

                    this.newImage = '';
                };
                reader.readAsDataURL(this.newImage[0]);
            } else {
                console.error("Nenhuma imagem selecionada!");
            }
        },

        uploadNewImages() {
            if (this.images.length === 0) {
                this.showAlert("Nenhuma imagem nova para enviar!", 'warning');
                return;
            }

            this.images.forEach(image => {
                const formData = new FormData();
                formData.append('images', image.file);

                axios.post('/api/slides', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                    .then(response => {
                        this.showAlert("Imagem(ns) enviada(s) com sucesso!", 'success');
                        this.fetchImages();
                    })
                    .catch(error => {
                        console.error('Erro ao enviar imagem', error);
                        this.showAlert("Erro ao enviar imagem!", 'error');
                    });


            });

            this.images = [];
        },

        confirmDelete() {
            if (this.slideToDelete) {
                axios.delete(`/api/slides/${this.slideToDelete.id}`)
                    .then(response => {
                        this.fetchImages();
                        this.closeDialog();
                        this.showAlert('Slide excluído com sucesso!', 'success');
                    })
                    .catch(error => {
                        console.error('Erro ao excluir o slide:', error);
                        this.closeDialog();
                        this.showAlert('Erro ao excluir o slide.', 'error');
                    });
            }
        },


        removeImage(index) {
            if (this.selectedImage === this.images[index].src) {
                this.selectedImage = '';
            }
            this.images.splice(index, 1);
        },


        openDialog(index) {
            this.slideToDelete = this.computedImages[index];
            this.dialog = true;
        },


        closeDialog() {
            this.dialog = false;
            this.slideToDelete = null;
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
