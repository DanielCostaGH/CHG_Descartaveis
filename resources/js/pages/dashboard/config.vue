<template>
    <div class="flex">
        <sidebar />
        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>
            <div class="">
                <h2 class="text-xl font-weight-bold text-gray-700">Integração Melhor Envios</h2>
                <v-btn @click="connectToMelhorEnvio"><v-icon class="mr-3">mdi-plus</v-icon>Nova Integração</v-btn>

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
        };
    },

    components: {
        sidebar,
        painel,
    },

    mounted() {
        this.getSettings()
    },

    methods: {
        getSettings() {
            axios.post('/api/get-config', {
                settings: ['MELHOR_ENVIO_CLIENT_ID', 'MELHOR_ENVIO_REDIRECT_URI']
            })
                .then(response => {
                    console.log(response.data);
                    this.settingsData = response.data
                })
                .catch(error => {
                    console.error('Erro ao obter as configurações:', error);
                });
        },


        connectToMelhorEnvio() {
            axios.get('/api/redirect-to-melhor-envio')
                .then(response => {
                    window.open(response.data.authUrl, '_blank');
                })
                .catch(error => {
                    console.error('Erro ao conectar com o Melhor Envio:', error);
                });
        },

        saveSettings() {
        },
    },
};
</script>
