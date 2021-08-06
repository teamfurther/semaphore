<template>
    <div class="view view--dashboard">

      <interval-changer class="mb-3"></interval-changer>

        <div class="flex panel">
            <table>
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Health</th>
                        <th>Uptime</th>
                        <th>CPU</th>
                        <th>Memory</th>
                        <th style="width: 20%">Disk Usage</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <router-link class="block font-bold"
                                         v-bind:to="{ name: 'project', params: { instance: 'gofurther.digital' }}"
                            >
                                gofurther.digital
                            </router-link>
                            <router-link class="text-gray-400"
                                         v-bind:to="{ name: 'project', params: { instance: 'gofurther.digital' }}"
                            >
                                https://gofurther.digital
                            </router-link>
                        </td>
                        <td>
                            <div class="highlight">
                                <span><span class="badge bg-pearl"></span>{{ __('OK') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="highlight highlight-raspberry">
                                <span><span class="badge bg-raspberry"></span>95%</span>
                            </div>
                        </td>
                        <td>
                            <canvas class="chart-line" id="gofurther_digital-cpu_usage" height="40"></canvas>
                        </td>
                        <td>
                            <canvas class="chart-line" id="gofurther_digital-memory_usage" height="40"></canvas>
                        </td>
                        <td class="flex space-x-6">
                            <div class="highlight highlight-tangerine">
                                <span class="block text-lg text-tangerine">
                                    <span class="badge bg-tangerine"></span> 82%
                                </span>
                                <span class="text-xs text-gray-400">/</span>
                            </div>
                            <div class="highlight">
                                <span class="block text-lg text-pearl">
                                    <span class="badge bg-pearl"></span>52%
                                </span>
                                <span class="text-xs text-gray-400">/var/remote_backups</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <router-link class="block font-bold"
                                         v-bind:to="{ name: 'project', params: { instance: 'centralized.me' }}"
                            >
                                centralized.me
                            </router-link>
                            <router-link class="text-gray-400"
                                         v-bind:to="{ name: 'project', params: { instance: 'centralized.me' }}"
                            >
                                https://centralized.me
                            </router-link>
                        </td>
                        <td>
                            <div class="highlight highlight-tangerine">
                                <span><span class="badge bg-tangerine"></span>{{ __('Requires attention') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="highlight">
                                <span><span class="badge bg-pearl"></span>99%</span>
                            </div>
                        </td>
                        <td>
                            <canvas class="chart-line" id="centralized_me-cpu_usage" height="40"></canvas>
                        </td>
                        <td>
                            <canvas class="chart-line" id="centralized_me-memory_usage" height="40"></canvas>
                        </td>
                        <td>
                            <div class="highlight">
                                <span class="block text-lg text-pearl">
                                    <span class="badge bg-pearl"></span>19%
                                </span>
                                <span class="text-xs text-gray-400">/</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <router-link class="block font-bold"
                                         v-bind:to="{ name: 'project', params: { instance: 'mybestparking.com' }}"
                            >
                                mybestparking.com
                            </router-link>
                            <router-link class="text-gray-400"
                                         v-bind:to="{ name: 'project', params: { instance: 'mybestparking.com' }}"
                            >
                                https://mybestparking.com
                            </router-link>
                        </td>
                        <td>
                            <div class="highlight highlight-raspberry">
                                <span><span class="badge bg-raspberry"></span>{{ __('Critical') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="highlight">
                                <span><span class="badge bg-pearl"></span>99%</span>
                            </div>
                        </td>
                        <td>
                            <div class="highlight">
                                <span><span class="badge bg-gray-400"></span>N/A</span>
                            </div>
                        </td>
                        <td>
                            <div class="highlight">
                                <span><span class="badge bg-gray-400"></span>N/A</span>
                            </div>
                        </td>
                        <td>
                            <div class="highlight">
                                <span><span class="badge bg-gray-400"></span>N/A</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script lang="ts">
    import { Component } from 'vue-property-decorator';
    import AppMixins from '../mixins';
    import Chart from 'chart.js/auto';
    import IntervalChanger from '../components/IntervalChanger.vue';

    @Component({
        IntervalChanger
    })
    export default class Dashboard extends AppMixins {
        mounted() {
            // initialize line charts with random data
            [].forEach.call(document.querySelectorAll('.chart-line'), function(e) {
                let chart = new Chart(e, {
                    data: {
                        datasets: [{
                            data: [...Array(30)].map(val => Math.random() * 100 | 0)
                        }],
                        labels: [...Array(30)].map((val, key) => key + 1)
                    },
                    options: {
                        elements: {
                            point: {
                                radius: 0
                            }
                        },
                        plugins: {
                            tooltip: {
                                enabled: false
                            }
                        },
                        scales: {
                            x: {
                                display: false,
                                max: 100,
                                min: 0
                            },
                            y: {
                                display: false,
                            }
                        },
                    },
                    type: 'line'
                });
            });
        }
    };
</script>
