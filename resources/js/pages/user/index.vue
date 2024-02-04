<template>
    <div>
        <navbar />

        <main class="flex container mx-auto  my-10  rounded-lg min-h-[75vh]">

            <section class="w-1/4 h-full flex flex-wrap border-r-2">
                <ul class="text-lg w-full">
                    <li class="my-4  w-full">
                        <a class="flex w-full items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-500"
                            @click="selectComponent('userInfo')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-6 h-6 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>

                            Informações Cadastrais</a>
                    </li>

                    <li class="my-4  w-full">
                        <a class="flex w-full items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-500"
                            @click="selectComponent('userAddress')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-6 h-6 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>

                            Meus Endereços</a>
                    </li>

                    <li class="my-4  w-full">
                        <a class="flex w-full items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-500"
                            @click="selectComponent('userFavorites')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-6 h-6 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                            </svg>

                            Favoritos</a>
                    </li>

                    <li class="my-4  w-full">
                        <a class="flex w-full items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-500"
                            @click="selectComponent('userRequests')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-6 h-6 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            Meus pedidos</a>
                    </li>

                    <li class="my-4  w-full">
                        <a :href="userInfo ? `/cart/${userInfo.id}` : '#'" class="flex w-full items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-6 h-6 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                            Meu Carrinho
                        </a>
                    </li>

                    <button @click="logout" class="flex w-full items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200 cursor-pointer text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Sair
                    </button>


                </ul>

            </section>


            <section class="w-3/4 h-full">
                <component :is="selectedComponent" :user-data="userData" />
            </section>
        </main>
    </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue';
import userInfo from '../../components/userProfile/user-info.vue';
import userAddress from '../../components/userProfile/user-address.vue';
import userFavorites from '../../components/userProfile/user-favorites.vue';
import userRequests from '../../components/userProfile/user-requests.vue';

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
        userAddresses: {
            type: Array,
        },
    },

    computed: {
        userInfo() {
            return this.$store.state.user;
        },
    },
    
    components: {
        navbar,
        userInfo,
        userAddress,
        userFavorites,
        userRequests,
    },

    methods: {
        selectComponent(componentName) {
            this.selectedComponent = componentName;
        },
        async logout() {
            try {
                // Realiza uma requisição para a rota de logout
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
    },
};
</script>
