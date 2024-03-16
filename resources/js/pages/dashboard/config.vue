<template>
    <div class="flex">
        <sidebar />
        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>
            <div class="bg-white p-10 rounded-lg">
                <h2 class="text-xl font-weight-bold text-gray-600">Melhor Envios</h2>

                <div class="my-5">
                    <div class="flex items-center">
                        <h2 class="font-weight-bold text-gray-500 mr-5">Status:</h2>
                        <div>
                            <v-icon size="30" :color="isConnectedToMelhorEnvios ? 'green darken-2' : 'red'">
                                {{ isConnectedToMelhorEnvios ? 'mdi-check-circle-outline' : 'mdi-alert-circle-outline' }}
                            </v-icon>
                        </div>
                        <div>
                            <span
                                :class="isConnectedToMelhorEnvios ? 'ml-2 font-weight-bold text-green darken-2' : 'ml-2 font-weight-bold text-red'">
                                {{isConnectedToMelhorEnvios ? 'Conectado ao Melhor Envios':'Não conectado ao Melhor Envios'}}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- <v-btn @click="connectToMelhorEnvio">
                    <v-icon class="mr-3">mdi-plus</v-icon>Nova Integração
                </v-btn> -->

                <v-form class="w-2/6" @submit.prevent="saveFreight">
                    <div class="flex gap-5">
                        <v-text-field v-model="zipcode" label="Cep de origem" variant="solo"></v-text-field>
                        <v-text-field v-model="freightValue" label="Frete (valor fixo)" variant="solo"></v-text-field>
                    </div>
                    <v-btn type="submit" >Salvar</v-btn>
                </v-form>

            </div>

            <div class="bg-white p-10 rounded-lg my-10">
                <h2 class="text-xl font-weight-bold text-gray-600 mb-5">Editar termos de serviço</h2>

                <v-btn href="/dashboard/condition-terms">
                    <v-icon class="mr-3">mdi-plus</v-icon>Adicionar / Editar
                </v-btn>

            </div>
        </main>
    </div>
</template>
  
<script>
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'
import axios from 'axios';

export default {
    data() {
        return {
            originZip: '',
            settingsData: [],
            accessToken: '',
            isConnectedToMelhorEnvios: Boolean,
            freightValue: '',
            zipcode: '',
        };
    },

    components: {
        sidebar,
        painel,
    },

    mounted() {
        this.getSettings(),
        this.getAccessToken()
    },

    methods: {
        getSettings() {
            axios.get('/dashboard/get-config')
            .then(response => {
                this.settingsData = response.data;
                const zipcodeSetting = this.settingsData.find(setting => setting.name === 'zipcode');
                if (zipcodeSetting) {
                    this.zipcode = zipcodeSetting.value;
                }
                console.log(this.zipcode);
            })
            .catch(error => {
                console.error('Houve um erro ao obter as configurações:', error);
            });
        },


        getAccessToken() {
            axios.get('/api/get-access-token')
                .then(response => {
                    this.accessToken = response.data;
                    this.statusCheck();
                })
        },

        statusCheck() {
            if (Object.keys(this.accessToken).length === 0) {
                this.isConnectedToMelhorEnvios = false;
            } else {
                this.isConnectedToMelhorEnvios = true;
            }
        },

        connectToMelhorEnvio() {
            axios.get('/api/redirect-to-melhor-envio')
                .then(response => {
                    window.open(response.data.authUrl, '_blank');
                })
        },

        saveFreight() {
            axios.put('/dashboard/freight-config', {
                zipcode: this.zipcode,
                freight: this.freightValue 
            })
            .then(response => {
                alert('Configurações de frete atualizadas com sucesso!')
            })
            .catch(error => console.error('Não foi possível atualizar as configurações de frete.', error))
        }
    },
};
</script>
  