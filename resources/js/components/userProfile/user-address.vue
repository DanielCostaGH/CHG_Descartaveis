<template>
    <div class="px-8">
        <v-card class="w-6/6">
            <v-card-title class="text-xl font-medium">Gerenciar Endereços</v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <div class="flex flex-wrap">

                        <div class="flex w-full">
                            <v-text-field v-model="formData.rua" label="Rua" outlined dense
                                class="mb-4 mr-5 w-1/2"></v-text-field>
                            <v-text-field v-model="formData.numero" label="Número" outlined dense
                                class="mb-4 ml-5 w-1/2"></v-text-field>
                        </div>

                        <div class="flex w-full">
                            <v-text-field v-model="formData.cep" label="CEP" outlined dense class="mb-4"></v-text-field>
                            <v-text-field v-model="formData.cidade" label="Cidade" outlined dense
                                class="mb-4 mr-5 w-1/2"></v-text-field>
                        </div>

                        <div class="flex w-full">

                            <v-text-field v-model="formData.estado" label="Estado" outlined dense
                                class="mb-4 ml-5 w-1/2"></v-text-field>
                        </div>



                        <v-btn @click="adicionarEndereco" class="rounded-full bg-blue-darken-2 w-1/2">
                            Adicionar Endereço
                        </v-btn>
                    </div>
                </v-form>

                <v-divider class="my-4"></v-divider>

                <v-card v-for="(endereco, index) in enderecos" :key="index" class="mb-4">
                    <v-card-text>
                        <v-row>
                            <v-col cols="10">
                                <div>{{ endereco.rua }}, {{ endereco.numero }}, {{ endereco.cidade }}, {{ endereco.estado
                                }}, {{ endereco.cep }}</div>
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
export default {
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
            enderecos: [], // Array para armazenar endereços cadastrados
            enderecoSelecionado: null, // Índice do endereço selecionado
        };
    },
    methods: {
        adicionarEndereco() {
            this.enderecos.push({ ...this.formData });
            // Limpar o formulário após adicionar o endereço
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
                // Fazer algo com o endereço selecionado
                console.log('Endereço selecionado:', this.enderecos[this.enderecoSelecionado]);
            }
        },
    },
};
</script>
