<template>
    <navbar />
    <div class="container mx-auto my-5">
        <div class="flex h-[60vh]">
            <div class="w-4/6">
                <div v-if="selectedMainAddress" class="p-4 flex shadow-lg rounded-lg mx-5 my-10">
                    <div>
                        <h1 class="">Endereço Principal</h1>
                        <v-label>{{ selectedMainAddress.street }}, {{ selectedMainAddress.number }}, {{
                            selectedMainAddress.neighborhood }} </v-label><br>
                        <v-label>{{ selectedMainAddress.zipcode }} - {{ selectedMainAddress.city }} - {{
                            selectedMainAddress.state }}</v-label>
                    </div>
                    <div class="w-full flex justify-end gap-2 items-center">
                        <v-btn text color="primary" @click="openEditModal">EDITAR</v-btn>
                        <v-btn text color="primary" @click="openSelectModal">SELECIONAR OUTRO</v-btn>

                    </div>
                </div>
                <div v-else class="p-4 flex shadow-lg rounded-lg mx-5 my-10 justify-between">
                    <v-label>Nenhum endereço principal definido.</v-label>
                    <v-btn text color="primary">Adicionar Endereço</v-btn>
                </div>

                <div class="mx-5 my-10 shadow-lg rounded-lg p-5">

                    <div v-if="empty">
                        <v-label class="text-h6">Carrinho vazio. Adicione produtos!</v-label>
                    </div>
                    <div v-for="product in products" :key="product.id"
                        class="p-5 my-5 shadow-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mx-5 mr-10">
                                <img :src="product.imagePath" alt="Imagem do Produto" class="avatar-img">
                            </div>

                            <div>
                                <h1>{{ product.name }}</h1>
                            <v-label class="my-1">preço: {{ product.price }}</v-label>


                            <div class="flex">
                                <div class="flex gap-4">
                                    <button @click="decreaseQuantity(product)">
                                        <v-icon>mdi-minus-circle-outline</v-icon>
                                    </button>

                                    <div>
                                        <span v-text="product.quantity"></span>
                                    </div>

                                    <button @click="increaseQuantity(product)">
                                        <v-icon>mdi-plus-circle-outline</v-icon>
                                    </button>
                                </div>
                            </div>
                            </div>

                        </div>

                        <div>
                            <button @click="removeProduct(product)">
                                <v-icon size="25" class="hover hover:bg-indigo">mdi-delete-outline</v-icon>
                            </button>
                        </div>


                    </div>
                </div>
            </div>

            <div class="w-2/6 mx-5 my-10 rounded-lg shadow-lg">
                <!-- Resumo -->

                <div>

                </div>
                <div class="p-7 text-h5 font-weight-bold flex items-center">
                    <v-icon color="#2B9D44">mdi-file-search</v-icon>
                    <span class="text-gray-600 mx-4">Resumo</span>
                </div>

                <div class="p-7">
                    <span class="font-weight-bold">Valor dos Produtos: <span class="p-2 text-white rounded bg-primary">R$ {{
                        totalPrice }}</span></span>
                    <hr class="my-5">
                    <div class="py-5">
                        <v-label class="font-weight-bold">Frete: <span class="p-2">R$ 00,00</span></v-label> <br>
                    </div>
                    <span class="font-weight-bold">Valor com frete: <span class="p-2 text-white rounded bg-warning">R$ {{
                        totalPrice
                    }}</span> </span>
                </div>

                <div class="w-5/6 mx-auto px-5">
                    <v-btn :href="userInfo ? `/cart/payment/${userInfo.id}` : '#'" color="#2B9D44" block large dark
                        class="my-5 text-h6" rounded="lg" style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
                        <v-icon left class="mr-3 text-h4">
                            mdi-cash
                        </v-icon>
                        Ir para pagamento
                    </v-btn>

                    <v-btn href="/" color="primary" block large dark class="my-5 text-h6" rounded="lg"
                        style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
                        <v-icon left class="mr-3 text-h4">
                            mdi-arrow-left
                        </v-icon>
                        Continuar comprando
                    </v-btn>
                </div>

            </div>
        </div>
    </div>


    <v-dialog v-model="showEditModal">
        <v-card class="container mx-auto w-3/5">
            <v-card-title>Editar Endereço</v-card-title>
            <v-card-text>
                <v-text-field v-model="editAddress.street" label="Rua"></v-text-field>
                <v-text-field v-model="editAddress.number" label="Número"></v-text-field>
                <v-text-field v-model="editAddress.neighborhood" label="Bairro"></v-text-field>
                <v-text-field v-model="editAddress.zipcode" label="CEP"></v-text-field>
                <v-text-field v-model="editAddress.city" label="Cidade"></v-text-field>
                <v-text-field v-model="editAddress.state" label="Estado"></v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="updateAddress">Salvar</v-btn>
                <v-btn color="grey" @click="showEditModal = false">Cancelar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-dialog v-model="showSelectModal">
        <v-card class="container mx-auto w-3/5">
            <v-card-title>Selecionar Novo Endereço</v-card-title>
            <v-card-text>
                <v-list>
                    <v-list-item v-for="address in address" :key="address.id" @click="selectAddress(address)">
                        <v-list-item-content>{{ address.street }}, {{ address.number }}</v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import axios from 'axios';
import navbar from '../../components/navbar/navbar.vue'


export default {
    data() {
        return {
            address: [],
            selectedMainAddress: null,
            products: [],
            empty: false,
            showEditModal: false,
            showSelectModal: false,
            editAddress: {},
        };

    },

    components: {
        navbar,
    },

    computed: {
        totalPrice() {
            return this.products.reduce(
                (total, product) => total + product.price * product.quantity,
                0
            ).toFixed(2);
        },
        userInfo() {
            return this.$store.state.user;
        },

    },


    methods: {
        fetchAddresses() {
            axios.get(`/user/get_address`)
                .then(response => {
                    const addresses = response.data.addresses;
                    const mainAddress = response.data.main_address;

                    this.address = addresses;

                    this.selectedMainAddress = mainAddress || (addresses.length > 0 ? addresses[0] : null);
                })
                .catch(error => {
                    console.error('Erro ao buscar endereços:', error);
                });
        },

        fetchProducts() {
            axios.get('/api/get_cart')
                .then(response => {
                    this.products = response.data.map(item => {
                        const firstImageName = item.product.images.split(';')[0];
                        const imagePath = `/images/products/${item.product.id}/${firstImageName}`;

                        return {
                            ...item.product,
                            cartItemId: item.id,
                            quantity: item.quantity,
                            unitPrice: item.unit_price,
                            selectedColor: item.color,
                            selectedVariation: item.variation,
                            imagePath: imagePath,
                        };
                    });
                    this.emptyCart();
                })
                .catch(error => {
                    console.log("Erro ao recuperar os itens do carrinho", error);
                })
        },


        updateAddress() {
            const data = {
                ...this.editAddress
            };

            axios.put('/user/edit_address', data)
                .then(response => {
                    this.selectedMainAddress = response.data.address;
                    this.showEditModal = false;
                    this.fetchAddresses();
                })
                .catch(error => {
                    alert('Erro ao atualizar o endereço: ', error)
                })

        },

        updateCartItemQuantity(cartItemId, newQuantity) {
        axios.put(`/api/update_cart_item/${cartItemId}`, { quantity: newQuantity })
            .catch(error => {
                console.error("Erro ao atualizar a quantidade", error);
            });
    },

    increaseQuantity(product) {
        const newQuantity = product.quantity + 1;
        this.updateCartItemQuantity(product.cartItemId, newQuantity);
        product.quantity = newQuantity;
    },

    decreaseQuantity(product) {
        if (product.quantity > 1) {
            const newQuantity = product.quantity - 1;
            this.updateCartItemQuantity(product.cartItemId, newQuantity);
            product.quantity = newQuantity;
        }
    },
        removeProduct(productToRemove) {
            this.products = this.products.filter(
                (product) => product.id !== productToRemove.id
            );
            this.emptyCart()
        },
        emptyCart() {
            if (this.products.length == 0) {
                this.empty = true;
            }

        },

        openEditModal() {
            this.editAddress = { ...this.selectedMainAddress };
            this.showEditModal = true;
        },

        openSelectModal() {
            this.showSelectModal = true;
        },

        selectAddress(address) {
            this.selectedMainAddress = address;
            this.showSelectModal = false;
        }


    },

    mounted() {
        this.fetchAddresses(),
            this.fetchProducts()
    }


};
</script>


<style>
.avatar-img {
    width: 50px;
    margin-right: 10px;
}


</style>
