<template>
    <div>

        <v-card class="mb-5 w-full">
            <v-card-title class="mt-4">
                <div class="flex justify-between cursor-pointer " @click="toggleSection">
                    <h3 class="text-xl font-semibold text-gray-500 mb-4 ">Principais tópicos</h3>

                    <img :src="down_arrow" alt="">
                </div>
            </v-card-title>

            <v-collapse v-model="isOpen">
                <v-card-text>
                    <v-row>
                        <v-col v-for="(topic, index) in editedTopics" :key="index" cols="12" sm="6">
                            <v-select :items="topicOptions" v-model="editedTopics[index]" label="Selecione um tópico"
                                outlined dense></v-select>
                        </v-col>
                    </v-row>

                    <v-btn color="blue darken-1" class="white--text" @click="saveChanges">
                        Salvar Alterações
                    </v-btn>
                </v-card-text>
            </v-collapse>
        </v-card>
    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            down_arrow: '/images/down_arrow.svg',
            isOpen: true,
            topics: [],
            editedTopics: [],
            topicOptions: [],
        };
    },
    created() {
        this.loadTopics();
        this.loadTopicOptions();
    },
    methods: {
        toggleSection() {
            this.isOpen = !this.isOpen;
        },
        loadTopics() {
            // Substitua por uma chamada API real se necessário
            this.topics = Array(4).fill(null); // Representação simplificada
            this.editedTopics = [...this.topics];
        },
        async loadTopicOptions() {
            try {
                const response = await axios.get('/api/category');
                this.topicOptions = response.data.map(item => item.name); // Ajuste conforme a estrutura da sua resposta
            } catch (error) {
                console.error(error);
            }
        },
        saveChanges() {
            // Implemente a lógica para salvar as alterações
            console.log('Tópicos editados:', this.editedTopics);
            alert('Alterações salvas com sucesso!');
        },
    },
};
</script>

