<template>
    <div>
        <navbar />


        <main class="hidden lg:flex container mx-auto my-10  rounded-lg min-h-[75vh]">
            <sidebar :user-data="userData"/>

            <div class="w-3/4 h-full">
                <favorites :user-data="userData"/>
            </div>

        </main>

        <!-- MOBILE SECTION -->
        <section>
            <div class="lg:hidden h-full">
                <favorites :user-data="userData" />
            </div>
        </section>

       
    </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue';
import sidebar from '../../components/userProfile/user-sidebar.vue';
import favorites from '../../components/userProfile/user-favorites.vue';

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
        favorites,
    },

    methods: {
       
    },
};
</script>
