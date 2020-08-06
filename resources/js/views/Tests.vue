<template>
    <v-container fluid>
        <v-row>
            <v-col cols="12" lg="10">
                <v-card elevation="6">
                    <v-card-title>
                        {{ $bus.ChartTitle }}
                    </v-card-title>
                    <v-card-text>
                        <line-chart :chart-data="$bus.datacollection" :options="options" :height="750"></line-chart>
                    </v-card-text>
                </v-card>  
            </v-col>
            <v-col cols="12" lg="2" class="order-sm-first order-md-2">
                <v-card elevation="6" class="pa-4">
                    <v-select
                        :items="$bus.departments"
                        item-text="name"
                        item-value="code"
                        label="Département"
                        v-model="$bus.department"
                    ></v-select>
                </v-card>
                <v-card elevation="6" class="pb-2 my-4 lighten-3" color="indigo">
                    <v-card-subtitle>Dernière Mise a jour le :</v-card-subtitle>
                    <p class="display-1 text--primary text-center">{{ $bus.lastDate }}</p>
                </v-card>
                <v-card elevation="6" class="pb-2 my-4 lighten-2" :color="colorRatio">
                    <v-card-subtitle>Taux positifs sur 7 jours :</v-card-subtitle>
                    <p class="display-1 text--primary text-center">{{ $bus.ratio + ' %'}}</p>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
export default {
    name: 'Tests',
    
    data () {
        return {
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    xAxes: [{
                        ticks: {
                            maxRotation: 90
                        }
                    }]
                }
            },
            lastDate: null
        }
    },
    mounted() {
        this.$bus.getDepartments()
        this.$bus.fetchData()
    },
    computed: {
        colorRatio() {
            if(this.$bus.ratio <5) { return 'green'}
            else if(this.$bus.ratio > 5 && this.$bus.ratio < 10) { return 'orange' }
            else { return 'red' }
        }
    },
    components: {
        LineChart: () => import(/* webpackChunkName: "lineChart" */ '../components/charts/LineChart.js'),
    }
}
</script>