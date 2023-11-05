<template>
    <div class="container mx-auto">
        <div class="lg:flex justify-around items-center h-screen w-full bg-red-">
            <div class="w-full text-center">
                    <img class="w-[55vh] mx-auto" :src="logo_light" alt="Logo">
                <div class="mb-5">
                    <a href="/" class="text-blue-500 ">Voltar para pagina inicial?</a>
                </div>
            </div>

            <div class=" flex justify-center w-full">
                <form @submit.prevent="submitForm" class="w-full mx-5 md:w-4/6 lg:w-[60vh] ">
                    <div class="text-center mb-5 md:mb-10 lg:mb-16">
                        <span class="text-3xl text-[#727272] font-bold">LOGIN</span>
                    </div>

                    <div class="relative">
                        <input v-model="email" class="bg-[#ECECEC] w-full h-[5vh] my-2 p-5 rounded" type="text" placeholder="E-mail" :class="{ 'border-red-500': emailError }">
                        <div class="text-red-500">{{ emailError }}</div>
                        <input v-model="password" class="bg-[#ECECEC] w-full h-[5vh] my-3 p-5 rounded" type="password" placeholder="Senha" :class="{ 'border-red-500': passwordError }">
                        <div class="text-red-500">{{ passwordError }}</div>
                        <input type="hidden" name="_token" :value="csrfToken">
                    </div>

                    <div class="flex flex-wrap lg:justify-between items-center">
                        <div class="flex items-center w-full lg:w-auto">
                            <div class="switch mr-3">
                                <input type="checkbox" class="sr-only">
                                <div :class="{'slider': true, 'checked': isSwitchChecked}" @click="toggleSwitch"></div>
                            </div>
                            <a class="text-[#1A1A1A]" href="#"> Salvar senha</a>
                        </div>


                        <a class="text-[#007AFF] my-2 lg:my-0" href="/admin/cadastro">Esqueci minha senha</a>
                    </div>

                    <div class="text-center text-white">
                        <button @click="submitForm" class="bg-[#007AFF] w-full h-[6vh] mt-10 rounded" type="button">Entrar</button>
                    </div>


                    <div class="text-center">
                        <button class="bg-[#F3F3F3] text-[#1A1A1A] w-full h-[6vh] my-4 rounded flex justify-center items-center" type="submit">
                            <v-icon class="p-4"><img :src="google_icon" alt=""></v-icon> Entre com sua conta Google</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            logo_light: '/images/logo_light.svg',
            google_icon: '/images/google_icon.svg',
            isSwitchChecked: false,
            email: '',
            password: '',
            emailError: '',
            passwordError: '',
            csrfToken: '',
        };
    },
    mounted() {
            this.fetchCsrfToken();
    },
    methods: {
        toggleSwitch() {
            this.isSwitchChecked = !this.isSwitchChecked;
        },

        async fetchCsrfToken() {
            try {
                const response = await axios.get('/get-csrf-token');

                axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.csrfToken;

                this.csrfToken = response.data.csrfToken;
            } catch (error) {
                console.error('Erro ao buscar o token CSRF:', error);
            }
        },
        async submitForm() {
            this.emailError = '';
            this.passwordError = '';

            // Validar campos
            if (!this.email) {
                this.emailError = 'O campo de email deve ser preenchido.';
                return;
            }

            if (!this.password) {
                this.passwordError = 'O campo de senha deve ser preenchido.';
                return;
            }

            try {
                // Realizar a requisição POST
                const response = await axios.post('/admin/login', {
                    email: this.email,
                    password: this.password,
                    _token: this.csrfToken,
                });

                // Verificar a resposta do backend
                // if (response.data.token) {
                //     // Definir o cabeçalho "X-CSRF-TOKEN" na solicitação de redirecionamento
                //     axios.get('/dashboard', {
                //         headers: {
                //             'X-CSRF-TOKEN': response.data.token
                //         }
                //     });
                // } else {
                //     // Credenciais inválidas
                //     this.emailError = 'Credenciais inválidas';
                // }
            } catch (error) {
                // Tratar erros de conexão com o backend
                console.error('Erro na requisição:', error);
                // Exiba uma mensagem de erro adequada ao usuário, se necessário
            }
        }
    }
}

</script>

<style scoped>
.switch-container {
    display: flex;
    align-items: center;
}

.switch {
    position: relative;
    width: 40px;
    height: 20px;
    background-color: #F2F2F2;
    border-radius: 10px;
    border: 1px solid #E5E5E5;
    cursor: pointer;
}

.slider {
    position: absolute;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background-color: #FFFFFF;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease-in-out;
}

.slider.checked {
    transform: translateX(20px);
    background-color: #007AFF; 
}

.switch-label {
    margin-right: 10px;
}
</style>
