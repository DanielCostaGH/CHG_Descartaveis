<template>
    <div>
        <navbar />


        <main class="hidden lg:flex container mx-auto my-10  rounded-lg min-h-[75vh]">
            <sidebar :user-data="userData"/>

            <div class="w-3/4 h-full">
                <addresses :user-data="userData"/>
            </div>

        </main>

       
    </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue';
import sidebar from '../../components/userProfile/user-sidebar.vue';
import addresses from '../../components/userProfile/user-address.vue';

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
        addresses,
    },

    methods: {
       
    },
};
</script>
