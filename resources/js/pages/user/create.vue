<template>
    <div class="container mx-auto">
        <div class="flex justify-around items-center h-screen w-full bg-red-">
            <div class="">
                <v-icon>
                    <img class="w-[55vh]" :src="logo_light" alt="Logo" />
                </v-icon>
                <a class="flex justify-center items-center font-bold" href="/">
                    <img :src="back_arrow" alt="" />
                    <span class="mx-5">Página inicial</span>
                </a>
            </div>

            <div class="flex justify-center">
                <form action="">
                    <div class="text-center mb-16">
                        <span class="text-3xl text-[#727272] font-bold"
                            >REGISTRE SUA CONTA</span
                        >
                    </div>

                    <div class="relative w-[60vh]">
                        <div class="flex justify-between items-center">
                            <input
                                class="bg-[#ECECEC] w-full h-[5vh] my-2 mr-5 p-5 rounded"
                                type="text"
                                placeholder="Nome completo"
                            />
                            <input
                                class="bg-[#ECECEC] w-full h-[5vh] my-2 p-5 rounded"
                                type="number"
                                placeholder="Telefone (31) 00000-0000"
                            />
                        </div>
                        <div class="flex justify-between items-center">
                            <input
                                class="bg-[#ECECEC] w-full h-[5vh] my-2 mr-5 p-5 rounded"
                                type="number"
                                placeholder="CPF (11 dígitos, apenas números)"
                            />
                            <input
                                class="bg-[#ECECEC] w-full h-[5vh] my-2 p-5 rounded"
                                type="text"
                                placeholder="E-mail"
                            />
                        </div>
                        <div class="flex justify-between items-center">
                            <input
                                class="bg-[#ECECEC] w-full h-[5vh] my-3 mr-5 p-5 rounded"
                                type="password"
                                placeholder="Senha(mínimo 8 digitos)"
                            />
                            <input
                                class="bg-[#ECECEC] w-full h-[5vh] my-3 p-5 rounded"
                                type="password"
                                placeholder="Confirme sua senha"
                            />
                        </div>
                    </div>

                    <div class="text-center text-white">
                        <button
                            class="bg-[#007AFF] w-full h-[6vh] mt-10 rounded"
                            type="submit"
                        >
                            Cadastrar
                        </button>
                    </div>

                    <div class="text-center">
                        <button
                            class="bg-[#F3F3F3] text-[#1A1A1A] w-full h-[6vh] my-4 rounded flex justify-center items-center"
                            type="submit"
                        >
                            <v-icon class="p-4"
                                ><img :src="google_icon" alt=""
                            /></v-icon>
                            Cadastrar com sua conta Google
                        </button>
                    </div>

                    <div class="text-center">
                        <span
                            >Já tem uma conta?
                            <a class="text-[#007AFF]" href="/user/login"
                                >Entre agora</a
                            ></span
                        >
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
            logo_light: "/images/logo_light.svg",
            google_icon: "/images/google_icon.svg",
            back_arrow: "/images/back_arrow.svg",
            isSwitchChecked: false,
        };
    },
};
</script>
