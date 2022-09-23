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
    import { TrendType } from '../types/trend/TrendType';
    import trendConfig from "../config/trendConfig";
    import {ListType} from "../types/trend/ListType";

    @Component
    export default class Trend extends Vue {
        /*private totals: number[] = [];*/
        private trends: ListType = {
            totals: [],
            values: [],
        };
        private trendRepository: TrendRepository = TrendRepository.getInstance();

        mounted() {
            this.getTrends();
        }

        get dataSet() {
             return this.trends.values.map((trend, index) => {
                const colorIndex = index % 2 == 0 ? 0 : 1;

                let values: number[] = [];

                this.timestamps.forEach((timestamp) => {
                    if (trend.values[timestamp] === undefined) {
                        values.push(0);
                        return;
                    }

                    values.push(trend.values[timestamp].value);
                });

                return {
                    borderColor: trendConfig.colors[colorIndex],
                    data: values,
                    label: trend.label,
                    pointHoverRadius: 0,
                    pointRadius: 0,
                    showLine: false
                };
            });
        }

        get labels() {
            return this.trends.totals.map((trend) => {
                return trend.datetime;
            });
        }

        get timestamps() {
            return this.trends.totals.map((trend) => {
                return Math.trunc(trend.timestamp);
            });
        }

        get totals() {
            return this.trends.totals.map((trend) => {
                return trend.total;
            });
        }

        async getTrends() {
            this.trends = await this.trendRepository.index(this.metric, this.instance, this.start, this.end);

            this.$forceUpdate();

            this.initChart();
        }

        initChart() {
            // initialize chart with random data
            new Chart(<ChartItem> document.querySelector('#' + this.id), {
                data: {
                    datasets: [...this.dataSet, ...[{
                        data: this.totals,
                        label: 'TOTAL'
                    }]],
                    labels: this.labels,
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
                            itemSort: function (a: any, b: any) {
                                if (a.dataset.label === 'TOTAL') {
                                    return -1;
                                }

                                if (b.dataset.label === 'TOTAL') {
                                    return 1;
                                }

                                return b.raw - a.raw;
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
            type: Number,
        }) end!: number;

        @Prop({
            required: true,
            type: String,
        }) id!: string;

        @Prop({
            required: true,
            type: String,
        }) instance!: string;

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
