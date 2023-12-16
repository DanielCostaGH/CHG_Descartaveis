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

                <v-radio-group class="flex flex-wrap justify-center w-full" v-model="selectedMainAddress">
                    <v-card v-for="(endereco, index) in userAddresses" :key="index" class="mb-4 w-[90vh]">
                        <v-card-text>
                            <v-row>
                                <v-col cols="9" class="flex items-center">
                                    <div>{{ endereco.street }}, {{ endereco.number }}, {{ endereco.neighborhood }}, {{
                                        endereco.city }},
                                        {{ endereco.state }}, {{ endereco.zipcode }}</div>
                                </v-col>
                                <v-col cols="2" class="flex items-center ">
                                    <v-col>
                                        <v-radio :value="index"></v-radio>
                                    </v-col>
                                    <v-btn @click="openEditModal(index)">
                                        <v-icon>mdi-home-edit-outline</v-icon>
                                    </v-btn>

                                    <v-btn
                                        @click="deleteAddress(endereco.id)"><v-icon>mdi-delete-alert-outline</v-icon></v-btn>
                                </v-col>

                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-radio-group>

                <v-divider class="my-4"></v-divider>

                <v-btn @click="salvarEnderecoPrincipal" class="rounded-full bg-blue-darken-2">
                    Salvar Endereço Selecionado
                </v-btn>
            </v-card-text>
        </v-card>
    </div>


    <v-dialog v-model="showEditModal">
        <v-card>
            <v-card-title>Editar Endereço</v-card-title>
            <v-card-text>
                <v-text-field v-model="editAddress.street" label="Rua"></v-text-field>
                <v-text-field v-model="editAddress.number" label="Número"></v-text-field>
                <v-text-field v-model="editAddress.neighborhood" label="Bairro"></v-text-field>
                <v-text-field v-model="editAddress.zipcode" label="CEP"></v-text-field>
                <v-text-field v-model="editAddress.city" label="Cidade"></v-text-field>
                <v-text-field v-model="editAddress.state" label="Estado"></v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="updateAddress">Salvar</v-btn>
                <v-btn color="grey" @click="showEditModal = false">Cancelar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
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
            selectedMainAddress: null,
            showEditModal: false,
            editAddress: {},
        };
    },
    methods: {
        adicionarEndereco() {
            const { street, number, city, state, zipcode, neighborhood } = this.formData;

            axios.post(`/user/add_address/${this.userData.id}`, {
                street,
                number,
                city,
                state,
                zipcode,
                neighborhood
            })
                .then(response => {
                    console.log('Endereço salvo com sucesso:', response);
                    this.fetchAddresses();
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
                        alert('Erro ao buscar endereço por CEP:', error);
                    });
            } else {
                console.warn('CEP inválido');
            }
        },


        fetchAddresses() {
            axios.get(`/user/get_address`)
                .then(response => {
                    const addresses = response.data.addresses;
                    const mainAddress = response.data.main_address;

                    this.userAddresses = addresses;

                    if (mainAddress) {
                        const mainAddressIndex = addresses.findIndex(address => address.id === mainAddress.id);
                        this.selectedMainAddress = mainAddressIndex !== -1 ? mainAddressIndex : null;
                    } else {
                        this.selectedMainAddress = null;
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar endereços:', error);
                });
        },

        updateAddress() {
            const data = {
                ...this.editAddress
            };
            axios.put('/user/edit_address', data)
                .then(response => {
                    this.selectedMainAddress = response.data.address;
                    this.showEditModal = false;
                    this.fetchAddresses();
                })
                .catch(error => {
                    alert('Erro ao atualizar o endereço: ', error)
                })

        },


        deleteAddress(addressId) {
            if (confirm("Tem certeza que deseja deletar este endereço?")) {
                axios.delete(`/user/delete_address/${addressId}`)
                    .then(response => {
                        alert("Endereço deletado com sucesso!");
                        this.fetchAddresses();
                    })
                    .catch(error => {
                        alert("Erro ao deletar endereço");
                        console.error('Erro ao deletar endereço:', error);
                    });
            }
        },



        salvarEnderecoPrincipal() {
            if (this.selectedMainAddress !== null) {
                const enderecoPrincipal = this.userAddresses[this.selectedMainAddress];

                if (enderecoPrincipal && enderecoPrincipal.id) {
                    console.log('Endereço Principal:', enderecoPrincipal);

                    axios.post(`/user/set_main_address`, { addressId: enderecoPrincipal.id })
                        .then(response => {
                            alert("Endereço principal atualizado com sucesso!");
                            this.fetchAddresses();
                        })
                        .catch(error => {
                            alert("Erro ao atualizar endereço principal");
                        });

                } else {
                    alert('ID do endereço não encontrado.');
                }

            } else {
                alert('Nenhum endereço selecionado.');
            }
        },

        openEditModal(index) {
            if (index !== null && this.userAddresses.length > index) {
                this.editAddress = { ...this.userAddresses[index] };
                this.showEditModal = true;
            } else {
                console.error("Índice de endereço inválido");
                console.log(this.userAddresses, index);
            }
        }





    },

    mounted() {
        this.fetchAddresses();
    }
};
</script>
