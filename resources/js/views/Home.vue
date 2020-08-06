<template>
    <v-container fluid>
        <v-row>
            <v-col cols="12">
                <v-card elevation="6" class="mx-auto pa-5" max-width="1000">
                    <v-img src="images/home_banniere.jpg">
                    </v-img>
                    <v-card-text>{{ text }} <a :href="link" target="_blank">www.data.gouv.fr</a></v-card-text>
                    <v-card-actions>
                        <v-col class="text-center">
                            <v-btn color="orange" elevation="3" @click="click">{{ btn.text }}</v-btn>
                        </v-col>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
export default {
    name: 'Home',

    data() {
        return {
            text: 'Source : Santé publique France est l’agence nationale de santé publique. ' +
            'Créée en mai 2016 par ordonnance et décret, c’est un établissement public administratif sous tutelle du ministère…',
            link: 'https://www.data.gouv.fr/fr/datasets/donnees-relatives-aux-resultats-des-tests-virologiques-covid-19/',
            btn: {
                text: 'Résultats Tests',
                link: 'tests'
            }
        }
    },
    methods: {
        click() {
            this.$router.push({path: 'tests'})
        }
    }
}
</script>