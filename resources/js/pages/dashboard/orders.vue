<template>
    <div class="flex">
        <sidebar />

        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>
        </main>
    </div>
                
</template>

<script>
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'
import axios from 'axios';

export default {
    data() {
        return {
        };
    },

    components: {
        sidebar,
        painel,
    },

    mounted() {
    },

    methods: {
       
    },
};
</script>
