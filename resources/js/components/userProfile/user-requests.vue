<template>
    <v-card>
      <v-card-title class="text-xl font-medium">Meus Pedidos</v-card-title>
      <v-card-text>
        <v-list class="bg-gray-">
          <v-list-item-group>
            <v-list-item
              v-for="(pedido, index) in pedidos"
              :key="index"
            >
              <v-list-item-avatar>
                <v-img

                ></v-img>
              </v-list-item-avatar>
              <v-list-item-content>
                <v-list-item-title>
                  {{ pedido.nome }}
                </v-list-item-title>
                <v-list-item-subtitle>
                  Valor: R$ {{ pedido.valor }}
                </v-list-item-subtitle>
              </v-list-item-content>
              <v-list-item-action>
                <v-btn @click="avaliarPedido(index)" color="primary">Avaliar</v-btn>
                <v-btn @click="comprarNovamente(index)" color="success">Comprar Novamente</v-btn>
              </v-list-item-action>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-card-text>
    </v-card>
  </template>

  <script>
  export default {
    data() {
      return {
        pedidos: [
          { nome: 'Produto 1', valor: 50.00 },
          { nome: 'Produto 2', valor: 30.00 },
          { nome: 'Produto 3', valor: 25.00 },
        ],
      };
    },
    methods: {
      avaliarPedido(index) {
        // Lógica para avaliar o pedido
      },
      comprarNovamente(index) {
        // Lógica para comprar o mesmo produto novamente
      },
    },
  };
  </script>



<style>
.flex{
    display: flex;
}

</style>
