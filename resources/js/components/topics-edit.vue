<template>
    <v-expansion-panels>
        <v-expansion-panel v-model="isOpen">
            <v-expansion-panel-title>
                <div class="flex justify-between cursor-pointer">
                    <h3 class="text-xl font-semibold text-gray-500 mb-4 pt-4">Principais tópicos</h3>
                </div>
            </v-expansion-panel-title>

            <v-expansion-panel-text>
                <v-row class="py-4">
                    <v-col v-for="(topic, index) in editedTopics" :key="index" cols="12" sm="6">
                        <span class="font-bold text-gray-500">Tópico {{ index + 1 }}: {{ topic }}</span>

                        <v-select :items="topicOptions" v-model="editedTopics[index]" label="Selecione um tópico" outlined
                            dense></v-select>
                    </v-col>
                </v-row>

                <v-btn color="blue darken-1" class="white--text" @click="saveChanges">
                    Salvar Alterações
                </v-btn>
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            isOpen: false,
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
