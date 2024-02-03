<template>
    <navbar />
    <div class="container mx-auto my-5">
        <div class="flex h-[60vh]">
            <div class="w-4/6">

                <!-- Endereço -->
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

                <!-- Metodo de pagamento -->
                <div class="p-4 flex shadow-lg rounded-lg mx-5">
                    <div class="w-4/6">
                        <h1 class="">Método de pagamento</h1>
                        <v-label v-if="selectedPaymentMethod">{{ selectedPaymentMethod.name }}</v-label>
                        <v-label v-else>Selecione um método de pagamento</v-label>
                    </div>
                    <div class="w-full flex justify-end gap-2 items-center">
                        <v-btn text color="primary" @click="openPaymentMethod">TROCAR</v-btn>

                    </div>
                </div>

                <!-- Lista de Produtos -->
                <div class="mx-5 my-10 shadow-lg rounded-lg p-5">

                    <div v-if="empty">
                        <v-label class="text-h6">Carrinho vazio. Adicione produtos!</v-label>
                    </div>
                    <div v-for="product in products" :key="product.id"
                        class="p-5 my-5 shadow-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mx-5 mr-10 w-[10vh] flex justify-center items-center">
                                <img :src="product.imagePath" alt="Imagem do Produto" class="max-h-[10vh]">
                            </div>

                            <div>
                                <h1 class="font-weight-bold">{{ product.name }}</h1>
                                <v-label>preço: {{ product.price }}, variação: {{ product.variation }}, cor: {{
                                    product.color }}</v-label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <cartSummary :totalPrice="totalPrice" :selectedMainAddress="selectedMainAddress"
                :selectedPaymentMethod="selectedPaymentMethod" @continueToConfirmation="createOrder" />
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

    <v-dialog v-model="showPaymentMethod" max-width="500px">
        <v-card>
            <v-card-title class="headline flex justify-between align-center">
                <span class="font-weight-bold text-gray-500">Métodos de pagamento</span>
                <v-btn icon="mdi-close" variant="text" @click="showPaymentMethod = false"></v-btn>
            </v-card-title>
            <v-list>
                <v-list-item v-for="method in paymentMethods" :key="method.id" @click="selectedPaymentMethod = method"
                    :class="{ 'selected-method': selectedPaymentMethod === method }">
                    <v-list-item-content>
                        <v-list-item-title>{{ method.name }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

            </v-list>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="showAddCardDialog = true">Adicionar cartão</v-btn>
                <v-btn color="primary" @click="confirmPaymentMethod">Confirmar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>


    <!-- Formulário para adicionar cartão -->
    <v-dialog v-model="showAddCardDialog" max-width="400px">
        <v-card>
            <v-card-title class="headline">Adicionar Novo Cartão</v-card-title>
            <v-card-text>
                <v-text-field label="Número do Cartão"></v-text-field>
                <v-text-field label="Nome no Cartão"></v-text-field>
                <v-text-field label="Data de Validade"></v-text-field>
                <v-text-field label="CVC"></v-text-field>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="showAddCardDialog = false">Cancelar</v-btn>
                <v-btn color="primary" @click="addNewCard">Adicionar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import axios from 'axios';
import navbar from '../../components/navbar/navbar.vue'
import cartSummary from '../../components/cart-summary.vue'


export default {
    data() {
        return {
            address: [],
            selectedMainAddress: null,
            products: [],
            empty: false,
            showEditModal: false,
            showSelectModal: false,
            showPaymentMethod: false,
            showAddCardDialog: false,
            editAddress: {},
            selectedPaymentMethod: '',
            paymentMethods: [
                { id: 1, name: 'PIX' },
                { id: 2, name: 'Boleto Bancário' }
            ],
        };
    },


    components: {
        navbar,
        cartSummary,

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
                            color: item.color,
                            unitPrice: item.unit_price,
                            selectedColor: item.color,
                            selectedVariation: item.variation,
                            imagePath: imagePath,
                        };
                    });
                    this.emptyCart();
                })
                .catch(error => {
                    console.error("Erro ao recuperar os itens do carrinho:", error);
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
            axios.delete(`/api/remove_cart_item/${productToRemove.cartItemId}`)
                .then(response => {
                    this.products = this.products.filter(product => product.cartItemId !== productToRemove.cartItemId);
                    this.emptyCart();
                })
                .catch(error => {
                    console.error("Erro ao remover o produto do carrinho", error);
                });
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

        openPaymentMethod() {
            this.showPaymentMethod = true;
        },

        selectPaymentMethod(item) {
            this.selectedPaymentMethod = item;
        },

        confirmPaymentMethod() {
            if (this.selectedPaymentMethod) {
                this.showPaymentMethod = false;
            } else {
                alert('Por favor, selecione um método de pagamento.');
            }
        },

        handlePaymentMethodSelection() {
            if (this.selectedPaymentMethod === 'new-card') {
                this.showAddCardDialog = true;
                this.showPaymentMethod = false;
            } else {
                this.showPaymentMethod = false;
            }
        },
        addNewCard() {
            this.showAddCardDialog = false;
        },

        createOrder() {
            const id = this.userInfo ? this.userInfo.id : '';
            const order = {
                userData: this.userInfo,
                address: this.selectedMainAddress,
                paymentMethod: this.selectedPaymentMethod,
                products: this.products,
                total: this.totalPrice
            };

            localStorage.setItem('order', JSON.stringify(order));
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

.selected-method {
    background-color: #e0e0e0;
}
</style>
