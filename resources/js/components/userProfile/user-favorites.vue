<template>
    <div class="h-[70vh] overflow-scroll">
      <v-card-title class="text-xl font-medium my-5">Meus Favoritos</v-card-title>
      <v-card-text>
        <v-row class="flex flex-wrap">
            <v-card v-for="(product, index) in productsWithImagePaths" :key="index" :loading="loading" class="card my-4 mx-5"
                width="320" > 
                <div class="flex justify-between items-center p-2 border-b-2 mb-4">
                    <div class="flex items-center">
                        <v-rating hover :length="5" :size="27" :model-value="3" active-color="warning" readonly />
                        <v-label>(544)</v-label>
                    </div>

                    <div>
                        <button @click="favoriteProduct(product)" class="ma-2">
                            <v-icon :color="favorites.includes(product.id) ? 'red' : ''">
                                mdi-heart{{ favorites.includes(product.id) ? '' : '-outline' }}
                            </v-icon>
                        </button>
                    </div>
                </div>         

                <a :href="`/products/${product.id}`">
                  <v-img :src="product.imagePath" cover height="200"></v-img>
                </a>
                 

                <v-card-item class="border-top my-2">
                    <v-card-title class="text-h6 overflow-hidden text--secondary">{{ product.name }}</v-card-title>
                    <span class="font-weight-bold" style="color: #38a169;">{{ product.price }}</span>
                </v-card-item>

            </v-card>
        </v-row>
      </v-card-text>
    </div>
  </template>

  <script>
import axios from 'axios';

  export default {
    data() {
      return {
        products: [],
        favorites: [],
      };
    },

    computed: {
        productsWithImagePaths() {
            return this.products.map(product => {
                const firstImage = product.images.split(';')[0];
                const imagePath = `/images/products/${product.id}/${firstImage}`;
                return { ...product, imagePath };
            });
        }
    },

    mounted(){
      this.fetchFavorites();
      this.fetchFavoriteProducts();
    },

    methods:{
      fetchFavoriteProducts(){
        axios.get('/user/favorite-products')
        .then(response=>{
          console.log(response.data)
          this.products = response.data
        })
      },

      fetchFavorites() {
            axios.get('/user/get-favorites')
                .then(response => {
                    this.favorites = response.data.map(favorite => favorite.product_id);
                })
                .catch(error => console.error("Erro ao buscar favoritos:", error));
        },

        favoriteProduct(product) {
            axios.post('/user/favorite', { productId: product.id })
                .then(response => {
                    this.fetchFavorites();
                    this.fetchFavoriteProducts();
                })
                .catch(error => console.error("Erro ao favoritar produto:", error));
        },
    }
  };
  </script>
