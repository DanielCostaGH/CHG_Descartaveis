<template>
    <div class="lg:px-8">
      <v-card class="w-6/6">
        <v-card-title class="text-xl font-medium">Editar Perfil</v-card-title>
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <div class="lg:flex">
              <v-text-field v-model="formData.nome" label="Nome" outlined dense class="lg:mb-4 lg:mr-5"></v-text-field>
              <v-text-field v-model="formData.cpf" label="CPF" outlined dense class="lg:mb-4 lg:ml-5"></v-text-field>
            </div>
            <div class="lg:flex">
              <v-text-field v-model="formData.telefone" label="Telefone" outlined dense class="lg:mb-4 lg:mr-5"></v-text-field>
              <v-text-field v-model="formData.email" label="Email" outlined dense class="lg:mb-4 lg:ml-5"></v-text-field>
            </div>
            <div class="lg:flex">
              <v-text-field v-model="formData.senhaAtual" label="Senha Atual" outlined dense class="lg:mb-4 lg:mr-5" type="password"></v-text-field>
              <v-text-field v-model="formData.novaSenha" label="Nova Senha" outlined dense class="lg:mb-4 lg:ml-5" type="password"></v-text-field>
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
    props: {
      userData: {
        type: Object,
        default: () => ({})
      },
    },
    data() {
      return {
        formData: {
          nome: this.userData.name ?? '',
          cpf: this.userData.document ?? '',
          telefone: this.userData.phonenumber ?? '',
          email: this.userData.email ?? '',
          senhaAtual: '',
          novaSenha: '',
        },
        valid: false,
      };
    },
    methods: {
      salvar() {
        if (this.$refs.form.validate()) {
          this.formData.id = this.userData.id;

          axios.put(`/user/update_basic/${this.formData.id}`, this.formData)
            .then(response => {
            })
            .catch(error => {
              console.error('Erro ao enviar a solicitação:', error);
            });
        }
      },
    },
  };
  </script>
