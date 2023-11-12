<template>
    <div class="px-8">
        <v-card class="w-6/6">
            <v-card-title class="text-xl font-medium">Editar Perfil</v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <div class="flex">
                        <v-text-field v-model="formData.nome" label="Nome" outlined dense class="mb-4 mr-5"></v-text-field>
                        <v-text-field v-model="formData.cpf" label="CPF" outlined dense class="mb-4 ml-5"></v-text-field>
                    </div>

                    <div class="flex">
                        <v-text-field v-model="formData.telefone" label="Telefone" outlined dense
                            class="mb-4 mr-5"></v-text-field>
                        <v-text-field v-model="formData.email" label="Email" outlined dense class="mb-4 ml-5"></v-text-field>
                    </div>
                    <div class="flex">
                        <v-text-field v-model="formData.senhaAtual" label="Senha Atual" outlined dense class="mb-4 mr-5"
                            type="password"></v-text-field>
                        <v-text-field v-model="formData.novaSenha" label="Nova Senha" outlined dense class="mb-4 ml-5"
                            type="password"></v-text-field>
                    </div>


                    <v-btn @click="salvar" :disabled="!valid" class="rounded-full mt-4 bg-blue-darken-2">
                        Salvar Alterações
                    </v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                nome: '',
                cpf: '',
                telefone: '',
                email: '',
                senhaAtual: '',
                novaSenha: '',
            },
            valid: false,
        };
    },
    methods: {
        salvar() {
            if (this.$refs.form.validate()) {
                console.log('Dados do formulário:', this.formData);
            }
        },
    },
};
</script>



