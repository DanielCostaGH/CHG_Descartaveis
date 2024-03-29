<template>
    <v-expansion-panels>
        <v-expansion-panel v-model="isOpen">
            <v-expansion-panel-title>
                <div class="flex justify-between">
                    <h3 class="text-xl font-semibold text-gray-500 mb-4 pt-4">Principais Marcas</h3>
                </div>
            </v-expansion-panel-title>

            <v-expansion-panel-text>
                <div class="flex w-full py-5">
                    <v-text-field label="Nome da Marca" v-model="newBrandName"></v-text-field>
                    <v-file-input label="Insira a imagem" @change="handleFileUpload"></v-file-input>

                    <v-btn class="ml-5" @click="addBrand">
                        Adicionar Marca
                    </v-btn>
                </div>

                <!-- Lista de Marcas a serem adicionadas -->
                <v-list-item v-if="editedBrands.length > 0" v-for="(brand, index) in editedBrands" :key="index">
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <v-avatar size="80">
                                <v-img :src="getImagePath(brand)"></v-img>
                            </v-avatar>

                            <v-list-item-content class="mx-10">
                                <v-list-item-title>{{ brand.name }}</v-list-item-title>
                            </v-list-item-content>
                        </div>

                        <v-list-item-action class="mx-10">
                            <v-btn icon @click="openDialog(index, false)">
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </div>
                </v-list-item>

                <!-- Lista de Marcas Atuais -->
                <v-list-item v-if="computedBrands.length > 0" v-for="(brand, index) in computedBrands" :key="index">
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <v-avatar size="80">
                                <v-img :src="getImagePath(brand)"></v-img>
                            </v-avatar>

                            <v-list-item-content class="mx-10">
                                <v-list-item-title>{{ brand.name }}</v-list-item-title>
                            </v-list-item-content>
                        </div>

                        <v-list-item-action class="mx-10">
                            <v-btn icon @click="openDialog(index, true)">
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </div>
                </v-list-item>

                <v-btn @click="saveChanges" color="primary" class="mt-10 px-4 py-2 rounded">
                    Salvar Alterações
                </v-btn>



                <v-dialog v-model="dialog" persistent max-width="290" v-if="brandToDelete">
                    <v-card>
                        <v-card-title class="text-h5">Confirmar Exclusão</v-card-title>
                        <v-card-text>
                            Tem certeza que deseja excluir a marca: {{ brandToDelete.name }}?
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDialog">Cancelar</v-btn>
                            <v-btn color="blue darken-1" text @click="confirmDelete">Confirmar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>



            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>

    <v-dialog v-model="dialogSuccess" transition="dialog-bottom-transition" persistent max-width="500">
        <v-card height="300" class="pa-3 rounded-xl">
            <v-card-text>
                <div class="flex flex-wrap justify-center items-center">
                    <div class="w-full flex justify-center my-5">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2" class="svg2">
                            <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10"
                                cx="65.1" cy="65.1" r="62.1" />
                            <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6"
                                stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                        </svg>
                    </div>

                    <div>
                        <span class="font-weight-bold text-green-darken-3">Marcas salvas com sucesso!</span>
                    </div>
                </div>


            </v-card-text>
            <v-card-actions class="justify-center">
                <v-btn class="bg-green-darken-3" color="gray darken-1" text @click="closeDialogSuccess">OK</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

</template>

<script>
export default {
    data() {
        return {
            isOpen: false,
            brands: [],
            editedBrands: [],
            computedBrands: [],
            newBrandName: '',
            newBrandImage: null,
            dialog: false,
            brandToDelete: null,
            dialogSuccess: false,
        };
    },
    methods: {
        fetchBrands() {
            axios.get('/api/brands/get')
                .then(response => {
                    this.computedBrands = response.data;
                })
                .catch(error => {
                    console.error('Erro ao buscar marcas:', error);
                });
        },

        addBrand() {
            if (this.computedBrands.length + this.editedBrands.length >= 3) {
                this.showAlert('Máximo de 3 marcas permitidas.', 'warning');
            } else if (this.newBrandName && this.newBrandImage) {
                let newBrand = {
                    name: this.newBrandName,
                    images: this.newBrandImage,
                };
                this.editedBrands.push(newBrand);
                this.newBrandName = '';
                this.newBrandImage = null;
            }
        },

        handleFileUpload(event) {
            this.newBrandImage = event.target.files[0];
        },

        getImagePath(brand) {
            let path = `/images/brands/${brand.images}`;
            return path;
        },

        saveChanges() {
            let formData = new FormData();

            this.editedBrands.forEach((brand, index) => {
                formData.append(`brands[${index}][name]`, brand.name);

                if (brand.images instanceof File) {
                    formData.append(`brands[${index}][images]`, brand.images, brand.images.name);
                }

            });

            axios.post('/api/brands/update', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.fetchBrands();
                    this.openDialogSuccess();
                })
                .catch(error => {
                    console.error('Erro ao salvar marcas:', error);
                    this.showAlert('Erro ao salvar marcas.', 'error');

                });


            this.editedBrands = [];
            this.newBrandName = '';
            this.newBrandImage = null;
        },

        openDialog(index, isComputed = false) {
            this.brandToDelete = isComputed ? this.computedBrands[index] : this.editedBrands[index];
            this.dialog = true;
        },

        closeDialog() {
            this.dialog = false;
            this.brandToDelete = null;
        },

        openDialogSuccess() {
            this.dialogSuccess = true;
        },
        closeDialogSuccess() {
            this.dialogSuccess = false;
        },

        confirmDelete() {
            if (this.brandToDelete) {
                axios.delete(`/api/brands/${this.brandToDelete.id}`)
                    .then(response => {
                        this.fetchBrands();
                        this.closeDialog();
                        this.showAlert('Marca excluída com sucesso!', 'success');

                    })
                    .catch(error => {
                        console.error('Erro ao excluir a marca:', error);
                        this.closeDialog();
                        this.showAlert('Erro ao excluir a marca.', 'error');

                    });
            }
        },

        showAlert(text, type) {
            this.alert.text = text;
            this.alert.type = type;
            this.alert.show = true;

            setTimeout(() => {
                this.alert.show = false;
            }, 2000);
        }

    },

    mounted() {
        this.fetchBrands();
    }
};
</script>




<style scoped>
.alert-container {
    position: fixed;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    width: 100%;
    padding: 4vh;
}

.v-alert {
    max-width: 600px;
}
.custom-border {
  border: 2px solid white;
}

</style>
