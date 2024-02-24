<template>
    <div>
        <navbar />


        <main class="hidden lg:flex container mx-auto my-10  rounded-lg min-h-[75vh]">
            <sidebar :user-data="userData"/>

            <div class="w-3/4 h-full">
                <info :user-data="userData"/>
            </div>

        </main>

       
    </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue';
import sidebar from '../../components/userProfile/user-sidebar.vue';
import info from '../../components/userProfile/user-info.vue';

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
        userAddresses: {
            type: Array,
        },
    },

    computed: {

    },
    
    components: {
        navbar,
        sidebar,
        info,
    },

    methods: {
       
    },
};
</script>
