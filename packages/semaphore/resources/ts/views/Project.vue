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
                    <component v-bind:class="check.panel.className"
                               v-bind:id="check.id"
                               v-bind:instance="config.instance"
                               v-bind:is="check.widget"
                               v-bind:key="check.id"
                               v-bind:metric="check.metric"
                               v-bind:title="check.panel.title"
                               v-for="check in getChecksByZone('main', row)"
                               v-bind:start="1663916607"
                               v-bind:end="1663931014"
                    ></component>
                </div>
            </div>
            <div class="col-span-1">
                <component v-bind:class="check.panel.className"
                           v-bind:id="check.id"
                           v-bind:instance="config.instance"
                           v-bind:is="check.widget"
                           v-bind:key="check.id"
                           v-bind:metric="check.metric"
                           v-bind:title="check.panel.title"
                           v-for="check in getChecksByZone('sidebar')"
                           v-bind:start="1663916607"
                           v-bind:end="1663931014"
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
    import { ProjectType } from '../types/project/ProjectType';
    import ProjectRepository from "../repositories/ProjectRepository";

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
        private config: ProjectType | null = null;
        private instance =  this.$route.params.instance;
        private rows = [null];
        private projectRepository: ProjectRepository = ProjectRepository.getInstance();

        async mounted() {
            await this.getConfig();

            this.rows = [...Array(this.getNumberOfRows())].fill(null);
        }

        // Methods
        getChecksByZone(zone: string, row = null) {
            if (!this.config || !this.config.checks) {
                return [];
            }

            let checks = this.config.checks.filter((val: any) => {
                if (val.panel.zone === zone && (row === null || val.panel.row === row)) {
                    return val;
                }
            });

            return checks.sort((a: any, b: any) => a.panel.order - b.panel.order);
        }

        async getConfig() {
            this.config = await this.projectRepository.getProject(this.instance);
        }

        getNumberOfRows() {
            let maxRows = 0;

            if (!this.config || !this.config.checks) {
                return maxRows;
            }

            this.config.checks.forEach((val: any) => {
                if (typeof val.panel.row !== 'undefined' && val.panel.row > maxRows) {
                    maxRows = val.panel.row;
                }
            });

            return maxRows + 1;
        }
    }
</script>
