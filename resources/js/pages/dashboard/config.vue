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
                <div class="flex gap-5 items-center">
                    <v-text-field v-model="accessToken" label="Token de integração Melhor Envios" variant="solo"></v-text-field>
                    <v-btn @click="saveAccessToken">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="green" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </v-btn>
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
            isConnectedToMelhorEnvios: false,
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
                const freightSetting = this.settingsData.find(setting => setting.name === 'freight');
                if (zipcodeSetting) {
                    this.zipcode = zipcodeSetting.value;
                }
                if(freightSetting){
                    this.freightValue = freightSetting.value;
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
                    this.accessToken = response.data.access_token;
                    console.log(this.accessToken)
                    this.statusCheck();
                })
        },

        saveAccessToken() {
            const data = {
                token: this.accessToken
            };

            axios.put('/dashboard/update-access-token', data)
                .then(response => {
                    this.getAccessToken(); 
                    alert('Token alterado com sucesso.');
                    console.log(response.data);
                })
                .catch(error => {
                    console.error('Erro ao atualizar o token:', error);
                    alert('Falha ao alterar o token.');
                });
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
  