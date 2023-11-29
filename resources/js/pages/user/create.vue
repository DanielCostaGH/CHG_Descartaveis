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
                <form @submit.prevent="submitForm" class="w-full mx-5 md:w-5/6 lg:w-[70vh]">
                    <div class="text-center mb-5 md:mb-10 lg:mb-16">
                        <span class="text-3xl text-[#727272] font-bold">CADASTRAR</span>
                    </div>

                    <div class="relative">

                        <!-- nome e email -->
                        <div class="flex">
                            <input v-model="name" class="bg-[#ECECEC] w-full h-[5vh] my-2 p-5 rounded mr-2" type="text"
                                placeholder="Insira seu nome" :class="{ 'border-red-500': emailError }">

                            <input v-model="email" class="bg-[#ECECEC] w-full h-[5vh] my-2 p-5 rounded ml-2" type="text"
                                placeholder="E-mail" :class="{ 'border-red-500': emailError }">
                        </div>

                        <div class="flex">
                            <div class="text-red-500 mr-2">{{ emailError }}</div>
                            <div class="text-red-500 ml-2">{{ emailError }}</div>
                        </div>



                        <!-- cpf e telefone -->
                        <div class="flex">
                            <input v-model="document" class="bg-[#ECECEC] w-full h-[5vh] my-2 p-5 rounded mr-2" type="text"
                                placeholder="Insira seu CPF" :class="{ 'border-red-500': emailError }">

                            <input v-model="tell" class="bg-[#ECECEC] w-full h-[5vh] my-2 p-5 rounded ml-2" type="text"
                                placeholder="Insira seu numero" :class="{ 'border-red-500': emailError }">
                        </div>

                        <div class="flex">
                            <div class="text-red-500 mr-2">{{ emailError }}</div>
                            <div class="text-red-500 ml-2">{{ emailError }}</div>
                        </div>




                        <!-- Senhas -->
                        <div class="flex">
                            <input v-model="password" class="bg-[#ECECEC] w-full h-[5vh] my-3 p-5 rounded mr-2"
                                type="password" placeholder="Senha" :class="{ 'border-red-500': passwordError }">
                            <input v-model="password" class="bg-[#ECECEC] w-full h-[5vh] my-3 p-5 rounded ml-2"
                                type="password" placeholder="Confirmar Senha" :class="{ 'border-red-500': passwordError }">
                        </div>

                        <div class="flex">
                            <div class="text-red-500 mr-2">{{ emailError }}</div>
                            <div class="text-red-500 ml-2">{{ emailError }}</div>
                        </div>

                    </div>


                    <div class="text-center text-white">
                        <button @click="submitForm" class="bg-[#007AFF] w-full h-[6vh] mt-10 rounded"
                            type="button">Registrar Conta</button>
                    </div>


                    <div class="text-center">
                        <a href="/user/login"
                            class="bg-[#F3F3F3] text-[#1A1A1A] w-full h-[6vh] my-4 rounded flex justify-center items-center"
                            type="submit">
                            <v-icon class="p-4 mr-2">mdi-key</v-icon>Ja possui uma conta? Entrar</a>
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
            passwordError: ''
        };
    },
    methods: {
        toggleSwitch() {
            this.isSwitchChecked = !this.isSwitchChecked;
        },
        submitForm() {
            this.emailError = '';
            this.passwordError = '';

            // Validar campos
            if (!this.email) {
                this.emailError = 'O campo de email deve ser preenchido.';
            }

            if (!this.password) {
                this.passwordError = 'O campo de senha deve ser preenchido.';
            }

            if (this.emailError || this.passwordError) {
                return;
            }

            axios.post('/user/login', {
                email: this.email,
                password: this.password
            })
                .then(response => {
                    if (response.data.token) {
                        window.location.href = '/dashboard';
                    } else {
                        this.emailError = 'Credenciais inválidas';
                    }
                })
                .catch(error => {
                    // Trate os erros do backend aqui, por exemplo, exiba uma mensagem de erro
                });
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
