<template>
  <section class="bg-gray-600 shadow-md p-8 mb-6 rounded-lg">
      <div class="flex justify-between items-center text-white">
          <h2 class="text-2xl font-semibold ">Painel de Controle</h2>
          <div class="flex space-x-4">
              <a href="/admin/profile" class="text-white hover:text-blue-500">Perfil</a>
              <button @click="logout" class="text-white hover:text-blue-500">Sair</button>
          </div>
      </div>
  </section>
</template>

<script>
import axios from 'axios';
import UserInfo from './userProfile/user-info.vue';

export default {
  data() {
      return {
          selectedComponent: userInfo,
          userData: {},
      };
  },
  props: {
      userData: {
          type: [Object],
      },
  },
  computed: {
    userInfo() {
        return this.$store.state.user;
    },
  },

  methods: {
    async logout() {
        try {
            // Realiza uma requisição para a rota de logout
            console.log(this.userInfo);
            const response = await axios.post('/user/logout', {
                email: this.userInfo.email,
            });

            // Verifica o status da resposta
            if (response.status === 200) {
                // Se a requisição for bem-sucedida, redirecione o usuário para a página de login
                window.location.href = '/user/login'; 
            } else {
                console.error('Falha ao efetuar logout');
            }
        } catch (error) {
            console.error('Erro ao efetuar logout:', error);
        }
    }
  }
}
</script>
