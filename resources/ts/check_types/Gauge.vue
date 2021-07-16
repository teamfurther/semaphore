<template>
    <div class="panel">
        <div class="panel--title" v-html="title"></div>
        <div class="grid grid-cols-2 gap-4">
            <div class="relative">
                <canvas class="chart-doughnut mb-2" height="30" v-bind:id="metric"></canvas>
                <span class="absolute flex items-center left-1/2 text-tangerine text-4xl top-2/3 transform -translate-x-1/2 -translate-y-1/2">
                    82%
                </span>
                <span class="text-xs text-gray-400">/</span>
            </div>
            <div class="relative">
                <canvas class="chart-doughnut mb-2" height="50" v-bind:id="metric"></canvas>
                <span class="absolute flex items-center left-1/2 text-pearl text-4xl top-2/3 transform -translate-x-1/2 -translate-y-1/2">
                    52%
                </span>
                <span class="text-xs text-gray-400">/var/remote_backups</span>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { Prop, Vue } from 'vue-property-decorator'
    import Chart from 'chart.js/auto';

    export default class Gauge extends Vue {
        mounted() {
            // initialize donut charts with data
            [].forEach.call(document.querySelectorAll('.chart-doughnut'), function(e, i) {
                let chart = new Chart(e, {
                    data: {
                        datasets: [{
                            backgroundColor: [i === 0 ? '#ffb04e' : '#6ecbbf', '#f3f4f6'],
                            data: [i === 0 ? 82 : 52, i === 0 ? 18 : 48]
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
        }) metric!: string;

        @Prop({
            required: true,
            type: String,
        }) title!: string;
    };
</script>