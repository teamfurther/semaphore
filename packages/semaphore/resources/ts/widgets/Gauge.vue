<template>
    <div class="panel pb-12 relative">
        <div class="panel--title" v-html="title"></div>
        <div class="grid grid-cols-2 gap-4">
            <div class="relative" v-for="gauge in gauges">
                <canvas class="chart-doughnut mb-2" height="30" v-bind:id="id"></canvas>
                <span class="absolute flex items-center left-1/2 text-tangerine text-4xl top-2/3 transform -translate-x-1/2 -translate-y-1/2">
                    {{ gauge.value }}%
                </span>
                <span class="text-xs text-gray-400">{{ gauge.name }}</span>
            </div>
        </div>
        <div class="bottom-4 absolute text-xs text-gray-400">Current data</div>
    </div>
</template>

<script lang="ts">
    import { Component, Prop, Vue } from 'vue-property-decorator';
    import Chart from 'chart.js/auto';
    import {GaugeType} from "../types/gauge/GaugeType";
    import GaugeRepository from "../repositories/GaugeRepository";

    @Component
    export default class Gauge extends Vue {
        async mounted() {
            await this.getGauges();
            const vm = this;

            // initialize donut charts with data
            [].forEach.call(document.querySelectorAll('.chart-doughnut'), function(e, i) {
                let chart = new Chart(e, {
                    data: {
                        datasets: [{
                            backgroundColor: [vm.gauges[i].color, '#f3f4f6'],
                            data: [vm.gauges[i].value, 100 - vm.gauges[i].value]
                        }]
                    },
                    options: {
                        aspectRatio: 2,
                        circumference: 180,
                        cutout: '75%',
                        plugins: {
                            tooltip: {
                                enabled: false
                            }
                        },
                        rotation: -90,
                    },
                    type: 'doughnut'
                });
            });
        }

        // Props
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
            type: String,
        }) instance!: string;

        private gaugeRepository: GaugeRepository = GaugeRepository.getInstance();
        private gauges: GaugeType[] = [];

        async getGauges() {
            this.gauges = await this.gaugeRepository.getGauge(this.metric, this.instance);
        }
    };
</script>
