<template>
    <navbar />
    <div class="container mx-auto my-5 hidden lg:block">
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
                        <v-label v-if="selectedPaymentMethod">{{ selectedPaymentMethod }}</v-label>
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


            <cartSummary :products="products" :selectedMainAddress="selectedMainAddress"
                :selectedPaymentMethod="selectedPaymentMethod" @continueToConfirmation="createOrder" />
        </div>
    </div>


    <!-- MOBILE SECTION -->
    <div class="lg:hidden">
        <div class="flex flex-wrap">
            <div class="w-full">
                <div v-if="selectedMainAddress" class="p-4 flex flex-wrap shadow-lg rounded-lg my-5 mx-3">
                    <div class="my-5">
                        <h1 class="">Endereço Principal</h1>
                        <v-label class="break-line">{{ selectedMainAddress.street }} - {{ selectedMainAddress.number }}
                            -
                            {{ selectedMainAddress.zipcode }} - {{ selectedMainAddress.neighborhood }} - {{
                    selectedMainAddress.city }} -
                            {{ selectedMainAddress.state }}
                        </v-label>
                    </div>
                    <div class="w-full flex justify-end gap-2 items-center">
                        <v-btn text color="indigo" @click="openEditModal">EDITAR</v-btn>
                        <v-btn text color="indigo" @click="openSelectModal">SELECIONAR OUTRO</v-btn>

                    </div>
                </div>
                <div v-else class="p-4 flex shadow-lg rounded-lg mx-5 my-10 justify-between">
                    <v-label>Nenhum endereço principal definido.</v-label>
                    <v-btn @click="openNewAddress" text color="primary">Adicionar Endereço</v-btn>
                </div>

                <!-- Metodo de pagamento -->
                <div class="p-4 flex shadow-lg rounded-lg mx-2">
                    <div class="w-4/6">
                        <h1 class="">Método de pagamento</h1>
                        <v-label v-if="selectedPaymentMethod">{{ selectedPaymentMethod }}</v-label>
                        <p v-else class="whitespace-pre-line text-gray-600">Selecione um método de pagamento</p>
                    </div>
                    <div class="w-2/6 flex items-center">
                        <v-btn text color="primary" @click="openPaymentMethod">TROCAR</v-btn>
                    </div>
                </div>

                <div class="my-10 p-2">

                    <div v-if="empty">
                        <v-label class="text-h6 break-line">Carrinho vazio. Adicione produtos!</v-label>
                    </div>

                    <div v-for="product in products" :key="product.id"
                        class="py-5 shadow-lg flex items-center justify-between">

                        <div class="flex items-center">
                            <div class="mx-5 mr-10 w-[10vh] flex justify-center items-center">
                                <img :src="product.imagePath" alt="Imagem do Produto" class="max-h-[10vh]">
                            </div>

                            <div>
                                <a :href="`/products/${product.id}`" class="product-link">{{ product.name }}</a> <br>
                                <v-label class="break-line">preço: {{ product.price }}, variação: {{ product.variation
                                    }}, cor: {{
                    product.color }}</v-label>

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
                                <v-icon size="25" class="hover hover:bg-indigo mx-4">mdi-delete-outline</v-icon>
                            </button>
                        </div>


                    </div>
                </div>

            </div>

            <div class="lg:block flex mx-auto w-full">
                <cart-summary ref="cartSummary" :products="products" :selectedMainAddress="selectedMainAddress"
                    :selectedPaymentMethod="selectedPaymentMethod" :initialTotalPrice="totalPrice" />

            </div>
        </div>
    </div>

    <!-- Formulário para editar endereço -->
    <v-dialog v-model="showEditModal">
        <v-card class="container mx-auto lg:w-3/5">
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

    <!-- Formulário para selecionar endereço -->
    <v-dialog v-model="showSelectModal">
        <v-card class="container mx-auto lg:w-3/5">
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

    <!-- Formulário para selecionar método -->
    <v-dialog v-model="showPaymentMethod" max-width="500px">
        <v-card>
            <div class="flex justify-between align-center p-3">
                <div>
                    <span class="font-weight-bold text-gray-500">Métodos de pagamento</span>
                </div>
                <div>
                    <v-btn size="small" icon @click="showPaymentMethod = false"><v-icon>mdi-close</v-icon></v-btn>
                </div>
            </div>
            <v-list>
                <!-- Opção PIX -->
                <v-list-item @click="selectPaymentMethod('PIX')">
                    <v-list-item-content>
                        <v-list-item-title>PIX</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <!-- Opção Boleto Bancário -->
                <v-list-item @click="selectPaymentMethod('Boleto Bancário')">
                    <v-list-item-content>
                        <v-list-item-title>Boleto Bancário</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <!-- Opção Cartões de Crédito -->

                <v-select label="Cartões de Crédito"
                    :items="cards.map(card => `${card.cardtype.toUpperCase()} ${card.display}`)" v-model="selectedCard">
                </v-select>


            </v-list>
            <v-card-actions class="flex flex-wrap justify-end">
                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="showAddCardDialog = true">Adicionar Novo Cartão</v-btn>
                <v-btn color="primary" @click="confirmPaymentMethod">Confirmar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <!-- Formulário para adicionar cartão -->
    <v-dialog v-model="showAddCardDialog" max-width="400px">
        <v-card>
            <v-card-title class="headline">Adicionar Novo Cartão</v-card-title>
            <v-card-text>
                <v-text-field v-model="cardNumber" label="Número do Cartão"></v-text-field>
                <v-text-field v-model="cardHolder" label="Nome no Cartão"></v-text-field>
                <v-text-field v-model="cardExpiration" label="Data de Validade"></v-text-field>
                <v-text-field v-model="cardCvv" label="CVV"></v-text-field>
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
            selectedCard: '',
            selectedPaymentMethod: '',
            selectedPayMode: '',
            cardNumber: '',
            cardHolder: '',
            cardExpiration: '',
            cardCvv: '',
            cards: [],

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

        fetchCards() {
            axios.post('/user/get-cards')
                .then(response => {
                    this.cards = response.data.map(card => ({
                        id: card.id,
                        cardtype: card.cardtype,
                        display: `**** **** **** ${card.last_four}`,
                        last_four: card.last_four
                    }));
                })
                .catch(error => {
                    console.error('Erro ao buscar cartões:', error);
                });
        },


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
            this.selectedPaymentMethod = '';
            this.selectedCard = '';
            this.showPaymentMethod = true;
        },

        selectPaymentMethod(selection) {
            this.selectedPayMode = selection;
        },

        confirmPaymentMethod() {
            // Verifica se existe uma seleção de cartão.
            if (this.selectedCard) {
                // Atualiza o método de pagamento para o cartão selecionado.
                this.selectedPaymentMethod = this.selectedCard;
            } else if (this.selectedPayMode) {
                // Se não houver cartão selecionado, mas outro método de pagamento foi selecionado (PIX ou Boleto).
                this.selectedPaymentMethod = this.selectedPayMode;
            } else {
                // Se nenhum método de pagamento foi selecionado.
                alert('Por favor, selecione um método de pagamento.');
            }
            // Fecha o diálogo de método de pagamento se um método foi selecionado.
            if (this.selectedPaymentMethod) {
                this.showPaymentMethod = false;
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

            const expirationParts = this.cardExpiration.split('/');
            const expirationMonth = expirationParts[0]; // Mês
            const expirationYear = expirationParts[1]; // Ano

            const cardData = {
                card_number: this.cardNumber,
                card_holder: this.cardHolder,
                expiration_mouth: expirationMonth,
                expiration_year: expirationYear,
                card_cvv: this.cardCvv,
                user_id: this.userInfo ? this.userInfo.id : '',
            };

            axios.post('/user/createcard', cardData)
                .then(response => {
                    console.log(response.data);
                    this.fetchCards();
                })
                .catch(error => {
                    console.error(error);
                });
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
        this.fetchCards(),
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
