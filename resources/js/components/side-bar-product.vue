<template>
  <div class="mx-auto w-5/6 border-2 my-14 p-8 rounded-md">
    <div class="flex justify-between">
      <div class="p-2 bg-[#5AC15C] text-white font-bold text-2xl rounded">
        <span>R${{ product.price }}</span>
      </div>

      <div class="p-2 text-gray-700 font-bold text-xl rounded cursor-pointer border-2">
        <span> {{ product.brand }}</span>
      </div>
    </div>

    <div class="p-3 bg-[#F1F3F9] text-gray-700 rounded-lg cursor-pointer my-4">
      <span>Parcele por <span class="bg-[#FED540] p-1 font-bold">R$00,00</span> até 5x sem juros</span>
    </div>

    <div>
      <span>Cores disponíveis</span>
      <div class="flex flex-wrap my-4">
        <div class="border border-gray-500 p-2 cursor-pointer rounded mr-4">
          <div class=" rounded-full p-5 bg-[#CAE5FB]"></div>
        </div>

        <div class="border border-gray-500 p-2 cursor-pointer rounded mr-4">
          <div class=" rounded-full p-5 bg-[#407847]"></div>
        </div>

        <div class="border border-gray-500 p-2 cursor-pointer rounded ">
          <div class=" rounded-full p-5 bg-[#000000]"></div>
        </div>
      </div>

      <div>
        <span>Variações</span>
        <div class="my-4">
          <select
            class="p-4 w-full rounded-lg cursor-pointer appearance-none text-center bg-white border border-gray-300 hover:border-gray-400 focus:outline-none focus:border-indigo-500">
            <option value="" selected class="text-gray-600">Selecione uma variação</option>

            <option v-for="(variation, index) in productVariations" :key="index" :value="variation" class="text-gray-600">
              {{ variation }}
            </option>
            
          </select>

        </div>

        <div>
          <button class="w-full p-4 bg-[#005BFF] rounded-lg text-white text-xl flex items-center justify-center my-5"><img
              class="mx-3" :src="PlusSquare" alt="">Adicionar ao carrinho</button>
          <button class="w-full p-4 bg-[#2B9D44] rounded-lg text-white text-xl flex items-center justify-center my-5"><img
              class="mx-3" :src="CashCoin" alt="">Comprar</button>
        </div>

        <div class="w-full">
          <div class="w-full p-4 border border-gray-300 shadow-lg text-gray-700 rounded-lg my-4">
            <span class="text-lg">Calcular Frete</span>

            <div class="flex items-center my-3">

              <input class="p-3 border-b border-gray-600 rounded-lg focus:outline-none" type="text" inputmode="numeric"
                pattern="[0-9]*" placeholder="Digite o CEP">

              <img class="mx-auto h-[3vh]" :src="Search" alt="">

            </div>
          </div>
        </div>

      </div>
    </div>


  </div>
</template>

<script>
export default {
  data() {
    return {
      PlusSquare: '/images/PlusSquare.svg',
      CashCoin: '/images/CashCoin.svg',
      Search: '/images/search.svg',
    }

  },
  props: {
    product: Object,
  },
  computed: {
    productVariations() {
      return this.product.variation.split(';').filter(variation => variation.trim() !== '');
    },
  },
}
</script>