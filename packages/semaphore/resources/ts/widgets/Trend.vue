<template>
    <div class="panel pb-12 relative">
        <div class="panel--title" v-html="title"></div>
        <canvas class="chart-line" height="100" v-bind:id="id"></canvas>
        <div class="bottom-4 absolute text-xs text-gray-400">Period: 16.07.2020 - 23.07.2020</div>
    </div>
</template>

<script lang="ts">
    import { Component, Prop, Vue } from 'vue-property-decorator';
    import Chart, { ChartItem } from 'chart.js/auto';
    import TrendRepository from "../repositories/TrendRepository";
    import TrendModel from '../models/trend/Trend';
    import trendConfig from "../config/trendConfig";

    @Component
    export default class Trend extends Vue {
        private trends: TrendModel[] = [];
        private trendRepository: TrendRepository = TrendRepository.getInstance();

        mounted() {
            this.getTrends();

            // initialize chart with random data
            let chart = new Chart(<ChartItem> document.querySelector('#' + this.id), {
                data: {
                    datasets: this.dataSet,
                    labels: this.labels
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

        get dataSet() {
            return this.trends.map((trend, index) => {
                const colorIndex = index % 2 == 0 ? 0 : 1;

                return {
                    borderColor: trendConfig.colors[colorIndex],
                    data: trend.values.map(value => {
                        return {
                            val: value.value,
                        };
                    }),
                    label: trend.processName,
                    pointHoverRadius: 0,
                    pointRadius: 0,
                    showLine: false
                };
            });
        }

        get labels() {
            return this.trends.map((trend) => {
                return {
                    val: trend.processName
                };
            });
        }

        async getTrends() {
            this.trends = await this.trendRepository.getTrend(this.metric, this.start, this.end);
        }

        // Props
        @Prop({
            required: true,
            type: Number,
        }) end!: number;

        @Prop({
            required: true,
            type: String,
        }) id!: string;

        @Prop({
            required: true,
            type: String,
        }) metric!: string;

        @Prop({
            required: true,
            type: String,
        }) title!: string;

        @Prop({
            required: true,
            type: Number,
        }) start!: number;
    };
</script>
