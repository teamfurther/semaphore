<template>
    <div class="view view--project">
        <div class="mb-8">
            <h1 class="text-2xl">gofurther.digital</h1>
            <h2 class="text-gray-400 text-sm">https://gofurther.digital</h2>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <div class="grid grid-cols-6 gap-4 mb-12">
                    <uptime class="col-span-3" metric="semaphore_global_uptime" v-bind:title="__('Global Uptime')"></uptime>
                    <gauge class="col-span-3" metric="semaphore_disk_usage" v-bind:title="__('Disk Usage')"></gauge>
                    <trend class="col-span-3" metric="semaphore_cpu_usage" v-bind:title="__('CPU Usage')"></trend>
                    <trend class="col-span-3" metric="semaphore_memory_usage" v-bind:title="__('Memory Usage')"></trend>
                    <trend class="col-span-3" metric="semaphore_response_time" v-bind:title="__('Server Response Time')"></trend>
                    <trend class="col-span-3" metric="semaphore_disk_io" v-bind:title="__('Disk IO')"></trend>
                </div>
                <div class="grid grid-cols-6 gap-4">
                    <uptime class="col-span-2" metric="semaphore_ssl_status" v-bind:title="__('SSL Status')"></uptime>
                    <uptime class="col-span-2" metric="semaphore_nginx_status" v-bind:title="__('nginx Status')"></uptime>
                    <uptime class="col-span-2" metric="semaphore_mysql_status" v-bind:title="__('MySQL Status')"></uptime>
                </div>
            </div>
            <div class="col-span-1">
                <eol class="mb-4" metric="semaphore_end_of_life" v-bind:title="__('End of Life')"></eol>
                <value class="mb-4" metric="semaphore_last_db_backup" v-bind:title="__('Last Backup (DB)')"></value>
                <value metric="semaphore_last_file_backup" v-bind:title="__('Last Backup (Files)')"></value>
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
        }
    }
</script>