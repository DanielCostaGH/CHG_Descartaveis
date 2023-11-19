<template>
    <div class="px-8">
        <v-card class="w-6/6">
            <v-card-title class="text-xl font-medium">Gerenciar Endereços</v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <div class="flex flex-wrap">

                        <div class="flex w-full">
                            <v-text-field v-model="formData.rua" label="Rua" outlined dense class="mb-4 mr-5 w-1/2"></v-text-field>
                            <v-text-field v-model="formData.numero" label="Número" outlined dense class="mb-4 ml-5 w-1/2"></v-text-field>
                        </div>

                        <div class="flex w-full">
                            <v-text-field v-model="formData.cep" label="CEP" outlined dense class="mb-4 mr-5"></v-text-field>
                            <v-text-field v-model="formData.cidade" label="Cidade" outlined dense class="mb-4 ml-5 w-1/2"></v-text-field>
                        </div>

                        <div class="flex w-full">
                            <v-text-field v-model="formData.estado" label="Estado" outlined dense class="mb-4 mr-5"></v-text-field>

                            <v-btn @click="adicionarEndereco" class="rounded-full bg-blue-darken-2 pt-5 pb-9">
                                <v-icon class="mr-2">mdi-plus</v-icon>
                                Adicionar Endereço
                            </v-btn>
                        </div>

                    </div>
                </v-form>

                <v-divider class="my-4"></v-divider>

                <v-card v-for="(endereco, index) in userAddresses" :key="index" class="mb-4">
                    <v-card-text>
                        <v-row>
                            <v-col cols="10">
                                <div>{{ endereco.rua }}, {{ endereco.numero }}, {{ endereco.cidade }}, {{ endereco.estado }}, {{ endereco.cep }}</div>
                            </v-col>
                            <v-col cols="2">
                                <v-radio v-model="enderecoSelecionado" :value="index" name="endereco-radio"></v-radio>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>

                <v-divider class="my-4"></v-divider>

                <v-btn @click="salvarEndereco" class="rounded-full bg-blue-darken-2">
                    Salvar Endereço Selecionado
                </v-btn>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        userData: {
            type: Object,
            default: () => ({})
        },
        userAddresses: {
            type: Array,
            default: () => []
        },
    },
    data() {
        return {
            formData: {
                rua: '',
                numero: '',
                cidade: '',
                estado: '',
                cep: '',
            },
            valid: false,
            enderecoSelecionado: null,
        };
    },
    methods: {
        adicionarEndereco() {
            this.userAddresses.push({ ...this.formData, user_id: this.userData.id });
            this.formData = {
                rua: '',
                numero: '',
                cidade: '',
                estado: '',
                cep: '',
            };
        },
        salvarEndereco() {
            if (this.enderecoSelecionado !== null) {
                const enderecoSelecionado = this.userAddresses[this.enderecoSelecionado];

                axios.post(`/add_address/${enderecoSelecionado.user_id}`, enderecoSelecionado)
                    .then(response => {
                        console.log('Resposta do servidor:', response.data);
                    })
                    .catch(error => {
                        console.error('Erro ao enviar a solicitação:', error);
                    });
            }
        },
    },
};
</script>
