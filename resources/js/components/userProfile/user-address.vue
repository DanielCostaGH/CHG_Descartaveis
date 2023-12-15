<template>
    <div class="px-8">
        <v-card class="w-6/6">
            <v-card-title class="text-xl font-medium">Gerenciar Endereços</v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <div class="flex flex-wrap">

                        <div class="flex w-full">
                            <v-text-field v-model="formData.street" label="Rua" outlined dense
                                class="mb-4 mr-5 w-1/2"></v-text-field>
                            <v-text-field v-model="formData.neighborhood" label="Bairro" outlined dense
                                class="mb-4 ml-5 w-1/2"></v-text-field>
                        </div>

                        <div class="flex w-full">
                            <v-text-field v-model="formData.zipcode" label="CEP" outlined dense class="mb-4  w-2/6"
                                @blur="buscarEnderecoPorCEP"></v-text-field>
                                <v-text-field v-model="formData.number" label="Número" outlined dense
                                class="mb-4 ml-5 w-1/6"></v-text-field>

                            <v-text-field v-model="formData.city" label="Cidade" outlined dense
                                class="mb-4 ml-5 w-3/6"></v-text-field>
                        </div>

                        <div class="flex w-full">
                            <v-text-field v-model="formData.state" label="Estado" outlined dense
                                class="mb-4 mr-5"></v-text-field>

                            <v-btn @click="adicionarEndereco" class="rounded-full bg-blue-darken-2 pt-5 pb-9">
                                <v-icon class="mr-2">mdi-plus</v-icon>
                                Adicionar Endereço
                            </v-btn>
                        </div>

                    </div>
                </v-form>

                <v-divider class="my-4"></v-divider>

                <!-- Lista de endereços cadastrados -->
                <div class="flex w-full">
                    <v-card v-for="(endereco, index) in userAddresses" :key="index" class="mb-4">
                        <v-card-text>
                            <v-row>
                                <v-col cols="10">
                                    <div>{{ endereco.street }}, {{ endereco.number }}, {{ endereco.city }}, {{
                                        endereco.state }}, {{ endereco.zipcode }}</div>
                                </v-col>
                                <v-col cols="2">
                                    <v-radio v-model="enderecoSelecionado" :value="index" name="endereco-radio"></v-radio>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                </div>

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
    },
    data() {
        return {
            formData: {
                street: '',
                number: '',
                city: '',
                state: '',
                zipcode: '',
                neighborhood: '',
            },

            userAddresses: [],
            valid: false,
            enderecoSelecionado: null,
        };
    },
    methods: {
        adicionarEndereco() {
            const { street, number, city, state, zipcode } = this.formData;

            axios.post(`/user/add_address/${this.userData.id}`, {
                street,
                number,
                city,
                state,
                zipcode
            })
                .then(response => {
                    console.log('Endereço salvo com sucesso:', response);
                })
                .catch(error => {
                    console.error('Erro ao salvar endereço:', error);
                });
        },


        buscarEnderecoPorCEP() {
            if (/^\d{5}[-]?\d{3}$/.test(this.formData.zipcode)) {
                axios.get(`https://viacep.com.br/ws/${this.formData.zipcode}/json/`)
                    .then(response => {
                        this.formData.street = response.data.logradouro || '';
                        this.formData.city = response.data.localidade || '';
                        this.formData.state = response.data.uf || '';
                        this.formData.neighborhood = response.data.bairro || '';
                    })
                    .catch(error => {
                        console.error('Erro ao buscar endereço por CEP:', error);
                    });
            } else {
                console.warn('CEP inválido');
            }
        },


        fetchAddresses() {
            axios.get(`/user/get_address/${this.userData.id}`)
            .then(response => {
                console.log(response.data);
                this.userAddresses = response.data;
            })
        }
    },

    mounted(){
        this.fetchAddresses();
    }
};
</script>
