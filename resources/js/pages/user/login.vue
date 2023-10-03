<template>
    <div class="container mx-auto">
        <div class="flex justify-around items-center h-screen w-full bg-red-">
            <div class="">
                <v-icon>
                    <img class="w-[55vh]" :src="logo_light" alt="Logo">
                </v-icon>
                <a class="flex justify-center items-center font-bold" href="/">
                    <img :src="back_arrow" alt="">
                    <span class="mx-5">Página inicial</span>
                </a>
            </div>

            <div class=" flex justify-center">
                <form action="">
                    <div class="text-center mb-16">
                        <span class="text-3xl text-[#727272] font-bold">LOGIN</span>
                    </div>

                    <div class="relative w-[60vh]">
                        <input class="bg-[#ECECEC] w-full h-[5vh] my-2 p-5 rounded" type="text" placeholder="E-mail">
                        <input class="bg-[#ECECEC] w-full h-[5vh] my-3 p-5 rounded" type="password" placeholder="Senha">
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="switch mr-3">
                                <input type="checkbox" class="sr-only">
                                <div :class="{'slider': true, 'checked': isSwitchChecked}" @click="toggleSwitch"></div>
                            </div>
                            <a class="text-[#1A1A1A]" href="#"> Salvar senha</a>
                        </div>


                        <a class="text-[#007AFF]" href="/admin/cadastro">Esqueci minha senha</a>
                    </div>

                    <div class="text-center text-white">
                        <button class="bg-[#007AFF] w-full h-[6vh] mt-10 rounded" type="submit">Entrar</button>
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
            back_arrow: '/images/back_arrow.svg',
            isSwitchChecked: false
        }
    },
    methods: {
        toggleSwitch() {
            this.isSwitchChecked = !this.isSwitchChecked;
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
