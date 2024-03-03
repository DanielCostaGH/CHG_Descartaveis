<template>
    <section class="hidden w-1/4 h-full lg:flex flex-wrap border-r-2">
        <ul class="text-lg w-full mx-4">
            <li class="my-4  w-full">
                <a href="/user/info"
                    class="flex w-full items-center p-5 rounded-lg hover:bg-blue-900 hover:text-white transition duration-300 ease-in-out hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>

                    Informações Cadastrais</a>
            </li>

            <li class="my-4  w-full">
                <a href="/user/address"
                    class="flex w-full items-center p-5 rounded-lg hover:bg-blue-900 hover:text-white transition duration-300 ease-in-out hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>

                    Meus Endereços</a>
            </li>

            <li class="my-4  w-full">
                <a href="/user/favorites"
                    class="flex w-full items-center p-5 rounded-lg hover:bg-blue-900 hover:text-white transition duration-300 ease-in-out hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                    </svg>

                    Favoritos</a>
            </li>

            <li class="my-4  w-full">
                <a href="/user/orders"
                    class="flex w-full items-center p-5 rounded-lg hover:bg-blue-900 hover:text-white transition duration-300 ease-in-out hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    Meus pedidos</a>
            </li>

            <li class="my-4  w-full">
                <a :href="`/cart/${userData.id}`"
                    class="flex w-full items-center p-5 rounded-lg transition duration-300 ease-in-out hover:bg-blue-900 hover:text-white hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    Meu Carrinho
                </a>
            </li>

            <button @click="logoutDialog = true"
                class="flex w-full items-center p-5 rounded-lg hover:bg-red-600 hover:text-white transition duration-300 ease-in-out hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                Sair
            </button>

        </ul>

    </section>


    <v-dialog v-model="logoutDialog" width="500">
            <v-card title="Atenção!">
                <v-card-text>
                    Tem certeza que deseja sair?
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="blue-grey-lighten-4" text="Cancelar" @click="logoutDialog = false"></v-btn>
                    <v-btn class="bg-red-darken-4" text="Sair" @click="logout"></v-btn>
                </v-card-actions>
            </v-card>
    </v-dialog>




</template>


<script>
import axios from 'axios';


export default {
    data() {
        return {
            userData: [],
            logoutDialog: false,
        };
    },
    props: {

    },

    mounted() {
        this.getUser()
    },


    methods: {

        getUser() {
            axios.get('/api/get')
                .then(response => {
                    this.userData = response.data
                    console.log(this.userData)
                });
        },


        async logout() {
            try {
                // Realiza uma requisição para a rota de logout
                const response = await axios.post('/user/logout', {
                    email: this.userData.email,
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
    },
};
</script>