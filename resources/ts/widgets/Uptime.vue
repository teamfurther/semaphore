<template>
    <div class="panel pb-12 relative">
        <div class="panel--title" v-html="title"></div>
        <div class="mb-4 text-tangerine text-4xl">
            <span class="badge bg-tangerine"></span> 97%
        </div>
        <canvas class="chart-line" height="60" v-bind:id="id"></canvas>
        <div class="bottom-4 absolute text-xs text-gray-400">Period: 16.07.2020 - 23.07.2020</div>
    </div>
</template>

<script lang="ts">
    import { Component, Prop, Vue } from 'vue-property-decorator';
    import Chart, { ChartItem } from 'chart.js/auto';

    @Component
    export default class Uptime extends Vue {
        mounted() {
            // initialize chart with random data
            let chart = new Chart(<ChartItem> document.querySelector('#' + this.id), {
                data: {
                    datasets: [{
                        data: [...Array(30)].map((val, key) => key !== 17),
                        label: 'Uptime'
                    }],
                    labels: [...Array(30)].map((val, key) => key + 1)
                },
                options: {
                    elements: {
                        line: {
                            borderWidth: 1
                        },
                        point: {
                            radius: 0
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    plugins: {
                        tooltip: {
                            enabled: false
                        }
                    },
                    scales: {
                        y: {
                            display: false,
                            max: 1.1,
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
        }) id!: string;

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