<template>
    <div class="flex">
        <sidebar />
        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>
            <div class="bg-white h-[80vh] p-5 rounded-lg">
                <div class="my-5 flex justify-between items-center">
                    <span class="font-weight-bold text-h4 text-gray-600">Termos de serviço:</span>
                    <v-btn @click="saveTerms" color="success">Salvar</v-btn>
                </div>
                <QuillEditor class="overflow-scroll max-h-[60vh] bg-white border" v-model="content" :options="editorOptions" contentType="html" />
            </div>

            <div v-html="content"></div>        
        </main>
    </div>
</template>

<script>
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'
import axios from 'axios';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    data() {
        return {
            content: '', 
            editorOptions: {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        [{ indent: '-1' }, { indent: '+1' }],
                        [{ align: [] }],
                        ['clean']
                    ]
                }
            }
        }
    },
    components: {
        sidebar,
        painel,
        QuillEditor,
    },

    mounted() {
        this.fetchTerms();
    },

    methods: {
        fetchTerms() {
            axios.get('/dashboard/get-terms/')
                .then(response => {
                    this.content = response.data.content;
                });
        },
        saveTerms() {
            axios.post('/dashboard/update-terms', { content: this.content })
                .then(response => {
                    alert(response.data.message);
                })
                .catch(error => {
                    console.error("Erro ao salvar os termos:", error.response.data);
                });
        },
    },
};
</script>
