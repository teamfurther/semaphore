<template>
    <div class="view view--project" v-if="config">
        <div class="mb-8">
            <h1 class="text-2xl" v-html="config.name"></h1>
            <h2 class="text-gray-400 text-sm" v-html="config.url"></h2>
        </div>
        <div class="grid grid-cols-3 gap-4" v-if="config.checks">
            <div class="col-span-2">
                <div class="grid grid-cols-6 gap-4"
                     v-bind:class="{ 'mb-12' : row < rows.length - 1 }"
                     v-for="(val, row) in rows"
                >
                    <component v-bind:class="check.panel.class"
                               v-bind:is="check.type"
                               v-bind:key="check.metric"
                               v-bind:metric="check.metric"
                               v-bind:title="check.panel.title"
                               v-for="check in getChecksByZone('main', row)"
                    ></component>
                </div>
            </div>
            <div class="col-span-1">
                <component v-bind:class="check.panel.class"
                           v-bind:is="check.type"
                           v-bind:key="check.metric"
                           v-bind:metric="check.metric"
                           v-bind:title="check.panel.title"
                           v-for="check in getChecksByZone('sidebar')"
                ></component>
            </div>
        </div>
    </div>
</template>

<script>
    import Eol from '../check_types/Eol';
    import Gauge from '../check_types/Gauge';
    import Trend from '../check_types/Trend';
    import Uptime from '../check_types/Uptime';
    import Value from '../check_types/Value';

    export default {
        components: {
            Eol, Gauge, Trend, Uptime, Value
        },
        data: function() {
            return {
                config: {},
                instance: this.$route.params.instance,
                rows: [null]
            }
        },
        methods: {
            getChecksByZone: function (zone, row = null) {
                let checks = Object.values(this.config.checks).filter((val) => {
                    if (val.panel.zone === zone && (row === null || val.panel.row === row)) {
                        return val;
                    }
                });

                return checks.sort((a, b) => a.panel.order - b.panel.order);
            },
            getConfig: function () {
                const configFile = require('@root/semaphore.config.js');

                this.config = configFile.find((val) => {
                    if (val.instance === this.instance) {
                        return val;
                    }
                });
            },
            getNumberOfRows: function () {
                let maxRows = 0;

                Object.values(this.config.checks).forEach((val) => {
                    if (typeof val.panel.row !== 'undefined' && val.panel.row > maxRows) {
                        maxRows = val.panel.row;
                    }
                });

                return maxRows + 1;
            }
        },
        mounted: function() {
            this.getConfig();

            this.rows = [...Array(this.getNumberOfRows())].fill(null);
        }
    }
</script>