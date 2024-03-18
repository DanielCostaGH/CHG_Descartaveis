<template>
    <div>
        <navbar />


        <main class="hidden lg:flex container mx-auto my-10 rounded-lg ">
            <sidebar :user-data="userData"/>

            <div class="w-3/4 h-full">
                <orders :user-data="userData"/>
            </div>

        </main>

        <!-- MOBILE SECTION -->
        <section class="lg:hidden">
            <div class="h-full">
                <orders :user-data="userData" />
            </div>
        </section>

       
    </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue';
import sidebar from '../../components/userProfile/user-sidebar.vue';
import orders from '../../components/userProfile/user-requests.vue';

export default {
    data() {
        return {
            userData: {},
        };
    },
    props: {
        userData: {
            type: [Object],
        },
    },

    computed: {

    },
    
    components: {
        navbar,
        sidebar,
        orders,
    },

    methods: {
       
    },
};
</script>
