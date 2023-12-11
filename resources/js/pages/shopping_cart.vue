<template>
    <navbar />
    <div class="container mx-auto my-5">
        <v-stepper v-model="step" :items="items" title="items" hide-navigation hide-actions>

            <!-- Step 1 Content -->
            <template v-slot:item.1 title="Pagamento">
                <IdentificationComponent @go-next="handleGoNext" />
            </template>

            <!-- Step 2 Content -->
            <template v-slot:item.2 title="Pagamento" @test-event="handleTestEvent">
            <PaymentComponent />
        </template>

            <!-- Step 3 Content -->
            <template v-slot:item.3 title="Pagamento">
                <ConfirmationComponent />
            </template>
        </v-stepper>
    </div>
</template>

<script>
import navbar from '../components/navbar/navbar.vue'
import IdentificationComponent from '../components/shop/IdentificationComponent.vue'
import PaymentComponent from '../components/shop/PaymentComponent.vue'
import ConfirmationComponent from '../components/shop/ConfirmationComponent.vue'

export default {
    data() {
        return {
            step: 1,
            items: [
                { title: 'Identificação', component: 'IdentificationComponent' },
                { title: 'Pagamento', component: 'PaymentComponent' },
                { title: 'Confirmação', component: 'ConfirmationComponent' }
            ],
        };
    },
    components: {
        navbar,
        IdentificationComponent,
        PaymentComponent,
        ConfirmationComponent
    },

    provide() {
        return {
            handleGoNext: this.handleGoNext,
            handleGoBack: this.handleGoBack,
        };
    },
    methods: {
        handleGoNext() {
            console.log("handleGoNext triggered");
            if (this.step < this.items.length) {
                this.step++;
            }
        },

        handleGoBack() {
            console.log("handleGoBack triggered");
            if (this.step > 1) {
                this.step--;
            }
        },
    },

};
</script>
