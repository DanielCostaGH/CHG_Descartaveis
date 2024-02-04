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

export default {
    data() {
        return {
            adminData: [],
        };
    },

    computed: {
        adminInfo() {
            return this.$store.state.admin;
        },
    },

    watch: {
        '$store.state.admin': {
            handler(newValue, oldValue) {
                this.setAdminData();
            },
            deep: true,
        },
    },

    methods: {
        setAdminData() {
            this.adminData = this.adminInfo;
        },

        async logout() {
            try {
                const response = await axios.post('/admin/logout', {
                    email: this.adminData.email,
                });

                // Verifica o status da resposta
                if (response.status === 200) {
                    // Se a requisição for bem-sucedida, redirecione o usuário para a página de login
                    window.location.href = '/admin/login';
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
