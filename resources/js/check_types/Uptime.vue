<template>
    <div class="panel">
        <div class="panel--title" v-html="title"></div>
        <div class="mb-4 text-tangerine text-4xl">
            <span class="badge bg-tangerine"></span> 97%
        </div>
        <canvas class="chart-line" height="60" v-bind:id="metric"></canvas>
    </div>
</template>

<script>
    import Chart from 'chart.js/auto';

    export default {
        mounted: function() {
            // initialize chart with random data
            let chart = new Chart(document.querySelector('#' + this.metric), {
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
        },
        props: {
            metric: {
                required: true,
                type: String
            },
            title: {
                required: true,
                type: String
            }
        }
    }
</script>