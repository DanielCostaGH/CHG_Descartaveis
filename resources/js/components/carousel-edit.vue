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
                                <v-file-input v-model="newImage" label="Escolher imagem" @change="uploadImage" outlined></v-file-input>
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
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>
</template>


<script>
export default {
    data() {
        return {
            isOpen: false,
            images: [],
            selectedImage: '',
            newImage: null,
            maxImages: 6,
        };
    },
    methods: {
        addImage() {
            if (this.images.length < this.maxImages && this.newImage) {
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
        selectImage(imageSrc) {
            this.selectedImage = imageSrc;
        },
        removeImage(index) {
            this.images.splice(index, 1);
            if (this.selectedImage === this.images[index].src) {
                this.selectedImage = this.images.length > 0 ? this.images[0].src : '';
            }
        },
    },
};
</script>
