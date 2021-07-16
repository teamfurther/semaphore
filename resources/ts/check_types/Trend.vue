<template>
    <div class="panel">
        <div class="panel--title" v-html="title"></div>
        <canvas class="chart-line" height="100" v-bind:id="metric"></canvas>
    </div>
</template>

<script lang="ts">
    import { Component, Prop, Vue } from 'vue-property-decorator';
    import Chart, { ChartItem } from 'chart.js/auto';

    @Component
    export default class Trend extends Vue {
        mounted() {
            // initialize chart with random data
            let chart = new Chart(<ChartItem> document.querySelector('#' + this.metric), {
                data: {
                    datasets: [{
                        borderColor: '#ffb04e',
                        data: [...Array(30)].map(val => Math.random() * 100 | 0),
                        label: 'prometheus',
                        pointHoverRadius: 0,
                        pointRadius: 0,
                        showLine: false
                    }, {
                        borderColor: '#f7086e',
                        data: [...Array(30)].map(val => Math.random() * 100 | 0),
                        label: 'top',
                        pointHoverRadius: 0,
                        pointRadius: 0,
                        showLine: false
                    }, {
                        data: [...Array(30)].map(val => Math.random() * 100 | 0),
                        label: 'TOTAL'
                    }],
                    labels: [...Array(30)].map((val, key) => key + 1)
                },
                options: {
                    elements: {
                        line: {
                            borderWidth: 1
                        },
                        point: {
                            radius: 2
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    plugins: {
                        tooltip: {
                            bodyFont: {
                                family: 'monospace'
                            },
                            callbacks: {
                                label: function(chart) {
                                    return String(chart.parsed.y).padStart(3, ' ') + '% - ' + chart.dataset.label;
                                }
                            },
                            position: 'nearest'
                        }
                    },
                    scales: {
                        y: {
                            max: 100,
                            min: 0
                        },
                    },
                },
                type: 'line'
            });
        }

        // Props
        @Prop({
            required: true,
            type: String,
        }) metric!: string;

        @Prop({
            required: true,
            type: String,
        }) title!: string;
    };
</script>