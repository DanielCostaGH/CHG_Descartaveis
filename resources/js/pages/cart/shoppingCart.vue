<template>
    <navbar />
    <div class="container mx-auto my-5 hidden lg:block">
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
                        <v-btn text color="indigo" @click="openEditModal">EDITAR</v-btn>
                        <v-btn text color="indigo" @click="openSelectModal">SELECIONAR OUTRO</v-btn>

                    </div>
                </div>
                <div v-else class="p-4 flex shadow-lg rounded-lg mx-5 my-10 justify-between">
                    <v-label>Nenhum endereço principal definido.</v-label>
                    <v-btn @click="openNewAddress" text color="primary">Adicionar Endereço</v-btn>
                </div>

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
                                <a :href="`/products/${product.id}`" class="product-link">{{ product.name }}</a> <br>
                                <v-label>preço: {{ product.price }}, variação: {{ product.variation }}, cor: {{
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
                                <v-icon size="25" class="hover hover:bg-indigo">mdi-delete-outline</v-icon>
                            </button>
                        </div>


                    </div>
                </div>

            </div>


            <cartSummary :totalPrice="totalPrice" :products="products" :selectedMainAddress="selectedMainAddress" />
        </div>
    </div>


    <!-- MOBILE SECTION -->
    <div class="lg:hidden">
        <div class="flex flex-wrap">
            <div class="w-full">
                <div v-if="selectedMainAddress" class="p-4 flex flex-wrap shadow-lg rounded-lg my-5 mx-3">
                    <div class="my-5">
                        <h1 class="">Endereço Principal</h1>
                        <v-label class="break-line">{{ selectedMainAddress.street }} - {{ selectedMainAddress.number }} - 
                            {{selectedMainAddress.zipcode }} - {{selectedMainAddress.neighborhood }} - {{ selectedMainAddress.city }} - 
                            {{selectedMainAddress.state }} 
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
                                <v-label class="break-line">preço: {{ product.price }}, variação: {{ product.variation }}, cor: {{
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
                <cartSummary :totalPrice="totalPrice" :products="products" :selectedMainAddress="selectedMainAddress" />
            </div>
        </div>
    </div>

    <!-- Editar endereço -->
    <v-dialog v-model="showEditModal">
        <v-card class="container mx-auto w-full sm:w-4/5 md:w-3/5">
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

    <!-- Selecionar Endereço -->
    <v-dialog v-model="showSelectModal">
        <v-card class="container mx-auto w-full sm:w-4/5 md:w-3/5">
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


    <!-- Adicionar endereço -->
    <v-dialog v-model="showNewAddressModal">
        <v-card class="container mx-auto w-full sm:w-4/5 md:w-3/5">
            <v-card-title class="text-xl font-medium">Adicionar Endereço</v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <div class="flex flex-wrap">

                        <div class="flex flex-wrap w-full">
                            <v-text-field v-model="formData.zipcode" label="CEP" outlined dense class="sm:mb-4 sm:mr-5 w-full sm:w-1/3"
                                @blur="buscarEnderecoPorCEP"></v-text-field>
                            <v-text-field v-model="formData.street" label="Rua" outlined dense
                                class="sm:mb-4 w-2/3"></v-text-field>
                        </div>

                        <div class="flex flex-wrap w-full">
                            <v-text-field v-model="formData.neighborhood" label="Bairro" outlined dense
                                class="sm:mb-4 w-full sm:w-2/6"></v-text-field>
                            <v-text-field v-model="formData.number" label="Número" outlined dense
                                class="sm:mb-4 w-full sm:ml-5 sm:w-1/6"></v-text-field>

                            <v-text-field v-model="formData.city" label="Cidade" outlined dense
                                class="sm:mb-4 w-full sm:ml-5 sm:w-3/6"></v-text-field>
                        </div>

                        <div class="flex flex-wrap w-full">
                            <v-text-field v-model="formData.state" label="Estado" outlined dense
                                class="sm:mb-4 sm:mr-5 w-full"></v-text-field>

                            <v-btn @click="adicionarEndereco" class="w-full sm:w-auto rounded-full bg-blue-darken-2 pt-5 pb-9">
                                <v-icon class="sm:mr-2">mdi-plus</v-icon>
                                Adicionar Endereço
                            </v-btn>
                        </div>

                    </div>
                </v-form>
            </v-card-text>
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
            showNewAddressModal: false,
            editAddress: {},

            formData: {
                street: '',
                number: '',
                city: '',
                state: '',
                zipcode: '',
                neighborhood: '',
            },
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
                            color: item.color,
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

        selectAddress(address) {
            this.selectedMainAddress = address;
            this.showSelectModal = false;
        },

        openNewAddress() {
            console.log('aqui');
            this.showNewAddressModal = true;
        },


        adicionarEndereco() {
            const { street, number, city, state, zipcode, neighborhood } = this.formData;

            axios.post(`/user/add_address/${this.userInfo.id}`, {
                street,
                number,
                city,
                state,
                zipcode,
                neighborhood
            })
                .then(response => {
                    console.log('Endereço salvo com sucesso:', response);
                    this.fetchAddresses();
                    this.showNewAddressModal = false;
                })
                .catch(error => {
                    console.error('Erro ao salvar endereço:', error);
                });


        },

        buscarEnderecoPorCEP() {
            if (/^\d{5}[-]?\d{3}$/.test(this.formData.zipcode)) {
                axios.get(`https://viacep.com.br/ws/${this.formData.zipcode}/json/`)
                    .then(response => {
                        this.formData.street = response.data.logradouro || '';
                        this.formData.city = response.data.localidade || '';
                        this.formData.state = response.data.uf || '';
                        this.formData.neighborhood = response.data.bairro || '';
                    })
                    .catch(error => {
                        alert('Erro ao buscar endereço por CEP:', error);
                    });
            } else {
                console.warn('CEP inválido');
            }
        },

    },

    mounted() {
        this.fetchAddresses(),
            this.fetchProducts()
    }


};
</script>


<style>
.product-link {
    font-weight: bold;
    /* Negrito */
}

.product-link:hover {
    color: #0861c0;
    text-decoration: underline;

}

.break-line {
    white-space: normal;
    word-wrap: break-word;
}

</style>
