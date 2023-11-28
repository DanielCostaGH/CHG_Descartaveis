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

    <v-alert class="alert-container text-xl elevation-5 custom-border " v-model="alert.show" :type="alert.type" dismissible>
        {{ alert.text }}
    </v-alert>
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
            alert: {
                show: false,
                text: '',
                type: ''
            },
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
                    this.showAlert('Alterações salvas com sucesso!', 'success');
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
