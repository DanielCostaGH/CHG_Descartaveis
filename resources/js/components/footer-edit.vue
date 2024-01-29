<template>
    <v-expansion-panels>
        <v-expansion-panel>
            <v-expansion-panel-title>
                <div class="flex justify-between">
                    <h3 class="text-xl font-semibold text-gray-500 mb-4 pt-4">Editar Rodapé</h3>
                </div>
            </v-expansion-panel-title>

            <v-expansion-panel-text>
                <div class="my-5">
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-text-field label="Whatsapp" v-model="whatsapp" outlined dense></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field label="Telefone" v-model="phone" outlined dense></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field label="Instagram" v-model="instagram" outlined dense></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field label="Email" v-model="email" outlined dense></v-text-field>
                        </v-col>
                    </v-row>

                    <v-file-input label="Logo (Imagem)" @change="onLogoInputChange" outlined dense></v-file-input>

                    <div v-if="logoImagePreview" class="mb-4">
                        <label class="block text-gray-700">Pré-visualização da Logo:</label>
                        <v-img :src="logoImagePreview" class="h-[30vh] p-5 border" alt="Logo"></v-img>
                    </div>

                    <v-btn color="blue" @click="saveChanges" class="mt-4">
                        Salvar Alterações
                    </v-btn>
                </div>
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
                        <span class="font-weight-bold text-green-darken-3">Alterações salvas com sucesso!</span>
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
            whatsapp: '',
            phone: '',
            instagram: '',
            email: '',
            logoImage: null,
            logoImageName: '',
            logoImagePreview: '',
            dialogSuccess: false,
        };
    },
    methods: {

        fetchFooterData() {
            axios.get('/api/footer/get')
                .then(response => {
                    const footerData = response.data[0];
                    if (footerData) {
                        this.whatsapp = footerData.whatsapp_num;
                        this.phone = footerData.call_num;
                        this.instagram = footerData.instagram;
                        this.email = footerData.email;
                        this.logoImageName = footerData.image;
                        this.logoImagePreview = footerData.image ? `/images/footer/${footerData.image}` : null;
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar dados do rodapé:', error);
                });
        },


        onLogoInputChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.logoImage = file; // Armazene o arquivo real
                this.logoImageName = file.name;
                this.logoImagePreview = URL.createObjectURL(file); // Para pré-visualização
            } else {
                this.logoImage = null;
                this.logoImageName = null;
                this.logoImagePreview = null; // Reset
            }
        },

        saveChanges() {
            const formData = new FormData();
            formData.append('whatsapp_num', this.whatsapp);
            formData.append('call_num', this.phone);
            formData.append('instagram', this.instagram);
            formData.append('email', this.email);
            formData.append('image_name', this.logoImageName);


            // Supondo que 'this.logoImage' seja um objeto File
            if (this.logoImage) {
                formData.append('image', this.logoImage);
            }

            axios.post('/api/footer', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.openDialogSuccess();
                })
                .catch(error => {
                    this.showAlert('Erro ao salvar alterações.', 'error');
                });
        },

        showAlert(text, type) {
            this.alert.text = text;
            this.alert.type = type;
            this.alert.show = true;

            setTimeout(() => {
                this.alert.show = false;
            }, 2000);
        },

        openDialogSuccess() {
            this.dialogSuccess = true;
        },
        closeDialogSuccess() {
            this.dialogSuccess = false;
        },
    },

    mounted() {
        this.fetchFooterData();
    },
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
