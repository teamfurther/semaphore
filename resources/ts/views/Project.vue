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
                               v-bind:id="check.id"
                               v-bind:is="check.widget"
                               v-bind:key="check.id"
                               v-bind:metric="check.metric"
                               v-bind:title="check.panel.title"
                               v-for="check in getChecksByZone('main', row)"
                    ></component>
                </div>
            </div>
            <div class="col-span-1">
                <component v-bind:class="check.panel.class"
                           v-bind:id="check.id"
                           v-bind:is="check.widget"
                           v-bind:key="check.id"
                           v-bind:metric="check.metric"
                           v-bind:title="check.panel.title"
                           v-for="check in getChecksByZone('sidebar')"
                ></component>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { Component } from 'vue-property-decorator';
    import AppMixins from '../mixins';
    import Eol from "../widgets/Eol.vue";
    import Gauge from '../widgets/Gauge.vue';
    import Trend from '../widgets/Trend.vue';
    import Uptime from '../widgets/Uptime.vue';
    import Value from '../widgets/Value.vue';

    @Component({
        components: {
            Eol,
            Gauge,
            Trend,
            Uptime,
            Value,
        },
    })
    export default class Project extends AppMixins {
        private config: { [key: string]: any } = {};
        private instance =  this.$route.params.instance;
        private rows = [null];

        mounted() {
            this.getConfig();

            this.rows = [...Array(this.getNumberOfRows())].fill(null);
        }

        // Methods
        getChecksByZone(zone: string, row = null) {
            let checks = this.config.checks.filter((val: any) => {
                if (val.panel.zone === zone && (row === null || val.panel.row === row)) {
                    return val;
                }
            });

            return checks.sort((a: any, b: any) => a.panel.order - b.panel.order);
        }

        getConfig() {
            const configFile = require('@root/semaphore.config.js');

            this.config = configFile.find((val: any) => {
                if (val.instance === this.instance) {
                    return val;
                }
            });
        }

        getNumberOfRows() {
            let maxRows = 0;

            this.config.checks.forEach((val: any) => {
                if (typeof val.panel.row !== 'undefined' && val.panel.row > maxRows) {
                    maxRows = val.panel.row;
                }
            });

            return maxRows + 1;
        }
    }
</script>