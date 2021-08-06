<template>
    <div class="interval-changer">

        <div class="flex p-2 rounded cursor-pointer width-fit ml-auto bg-white shadow custom-border"
             v-on:click="showIntervalChanger = !showIntervalChanger"
        >
            <img src="images/calendar.png" alt="" width="27" />
            <span class="ml-3">{{ selectedDate }}</span>
            <img class="ml-3" src="images/down-arrow.png" alt="" v-if="!showIntervalChanger" width="20" />
            <img class="ml-3" src="images/up-arrow.png" alt="" v-if="showIntervalChanger" width="20" />
        </div>

        <div class="bg-white shadow-md p-2 rounded absolute right-15 z-10" v-if="showIntervalChanger">
            <div class="flex">
                <div class="w-64">
                    <div class="border-b-2 p-1 font-semibold mr-3">Absolute time ranges</div>
                    <div class="p-1 mt-3">Select date range</div>
                    <date-picker range 
                                 v-bind:clearable="false" 
                                 v-model="date"
                    ></date-picker>
                    <div class="p-1 mt-3">From</div>
                    <div class="flex">
                        <div class="date-holder">{{ startDate }}</div>
                        <vue-timepicker auto-scroll 
                                        class="time-holder" 
                                        format="HH:mm" 
                                        hide-clear-button 
                                        v-model="startTime"
                        ></vue-timepicker>
                    </div>
                    <div class="p-1">Until</div>
                    <div class="flex">
                        <div class="date-holder">{{ endDate }}</div>
                        <vue-timepicker v-model="endTime" auto-scroll class="time-holder" format="HH:mm" hide-clear-button></vue-timepicker>
                    </div>
                    <button class="text-white font-bold py-1 px-2 rounded choose-btn"
                            v-bind:disabled="disabled"
                            v-on:click="chooseAbsoluteTime()"
                    >
                        Choose period
                    </button>
                </div>
                <div class="w-64">
                    <div class="border-b-2 p-1 font-semibold">Relative time ranges</div>
                    <div class="h-72 overflow-auto custom-scrollbar color-semigary">
                        <div v-for="item in relativeTimes">
                            <div class="cursor-pointer p-1 hover-blue rounded" 
                                 v-on:click="chooseRelativeTime(item)">
                                {{ item.title }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>


<script lang="ts">
    import { Component, Vue, Watch } from 'vue-property-decorator';
    import DatePicker from 'vue2-datepicker';
    import VueTimepicker from 'vue2-timepicker';
    import relativeTimes from '../config/relativeTimes';

    import 'vue2-datepicker/index.css';
    import 'vue2-timepicker/dist/VueTimepicker.css';

    @Component({
        components: {
            DatePicker,
            VueTimepicker
        }
    })
    export default class IntervalChanger extends Vue {
        private selectedDate = 'Last 30 minutes';
        private showIntervalChanger = false;
        private startDate = '';
        private endDate = '';
        private disabled = true;
        private date: Date[] = [];
        private startTime = '';
        private endTime = '';
        private relativeTimes = relativeTimes;

        created() {

        }

        chooseRelativeTime(item: {title: string}) {
            this.showIntervalChanger = false;
            this.selectedDate = item.title;
        }

        chooseAbsoluteTime() {
            this.showIntervalChanger = false;
            this.selectedDate = this.startDate + ' ' + this.startTime + ' ~ ' + this.endDate + ' ' + this.endTime;
        }


        @Watch('date')
        dateWatcher() {
            this.startDate = this.date[0].getFullYear() + '-' + ("0" + Number(this.date[0].getMonth()+1)).slice(-2) + '-' + ("0" + (this.date[0].getDate())).slice(-2);
            this.endDate = this.date[1].getFullYear() + '-' + ("0" +  Number(this.date[1].getMonth()+1)).slice(-2) + '-' + ("0" + (this.date[1].getDate())).slice(-2);
            this.startTime = '00:00';
            this.endTime = '00:00';
            this.disabled = false;
        }
    }
</script>

<style lang="scss">
    @import '../../scss/components/interval-changer';
</style>