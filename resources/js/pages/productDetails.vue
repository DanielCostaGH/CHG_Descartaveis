<template>
    <div>
        <h1>{{ product.name }}</h1>
        <p>Descrição: {{ product.description }}</p>
        <p>Preço: ${{ product.price }}</p>
        <!-- Adicione outras informações do produto aqui -->
    </div>
</template>

<script>
export default {
    props: {
        product: Object,
    },
   
}
</script>

  