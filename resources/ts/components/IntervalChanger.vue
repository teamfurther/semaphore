<template>
  <div class="interval-changer">

    <div class="flex p-2 rounded cursor-pointer width-fit ml-auto bg-white shadow custom-border" v-on:click="showIntervalChanger = !showIntervalChanger">
      <img src="images/calendar.png" width="27">
      <span class="ml-3">{{choosedDate}}</span>
      <img v-if="!showIntervalChanger" class="ml-3" src="images/down-arrow.png" width="20">
      <img v-if="showIntervalChanger" class="ml-3" src="images/up-arrow.png" width="20">
    </div>

    <div class="bg-white shadow-md p-2 rounded absolute right-15 z-10" v-if="showIntervalChanger">
      <div class="flex">
        <div class="w-64">
          <div class="border-b-2 p-1 font-semibold mr-3">Absolute time ranges</div>
          <div class="p-1 mt-3">Select date range</div>
          <date-picker v-model="date" range></date-picker>
          <div class="p-1 mt-3">From</div>
          <div class="flex">
            <div class="date-holder">{{startDate}}</div>
            <vue-timepicker class="time-holder" format="HH:mm" v-model="startTime" hide-clear-button auto-scroll></vue-timepicker>
          </div>
          <div class="p-1">Until</div>
          <div class="flex">
            <div class="date-holder">{{endDate}}</div>
            <vue-timepicker class="time-holder" format="HH:mm" v-model="endTime" hide-clear-button auto-scroll></vue-timepicker>
          </div>
          <button class="text-white font-bold py-1 px-2 rounded choose-btn"
                  v-on:click="chooseAbsoluteTime()"
                  :disabled="disabled">
            Choose period
          </button>
        </div>
        <div class="w-64">
          <div class="border-b-2 p-1 font-semibold">Relative time ranges</div>
          <div class="h-72 overflow-auto custom-scrollbar color-semigary">
            <div v-for="item in relativeTimes">
              <div class="cursor-pointer p-1 hover-blue rounded" v-on:click="chooseRelativeTime(item)">{{item.title}}</div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</template>


<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import VueTimepicker from 'vue2-timepicker'
import 'vue2-timepicker/dist/VueTimepicker.css'

export default{
  name: 'IntervalChanger',
  components: {
    DatePicker,
    VueTimepicker
  },
  created: function (){

  },
  data: function () {
    return {
      choosedDate: 'Last 30 minutes',
      showIntervalChanger: false,
      startDate: '',
      endDate: '',
      disabled: true,
      date: null,
      startTime: '',
      endTime: '',
      relativeTimes: [
        { title: 'Last 5 minutes' },
        { title: 'Last 15 minutes' },
        { title: 'Last 30 minutes' },
        { title: 'Last 1 hour' },
        { title: 'Last 3 hours' },
        { title: 'Last 6 hours' },
        { title: 'Last 12 hours' },
        { title: 'Last 24 hours' },
        { title: 'Last 2 days' },
        { title: 'Last 7 hours' },
        { title: 'Last 30 hours' },
        { title: 'Last 90 hours' },
        { title: 'Last 6 months' },
        { title: 'Last 1 year' },
        { title: 'Last 2 years' },
        { title: 'Last 5 years' },
      ],
    }
  },

  methods: {
    hasSomeParentTheClass: function(element, classname) {
      if(element.className == undefined){
        return false;
      }
      if (element.className.split(' ').indexOf(classname)>=0) return true;
      return element.parentNode && this.hasSomeParentTheClass(element.parentNode, classname);
    },

    chooseRelativeTime: function(item){
      this.showIntervalChanger = false;
      this.choosedDate = item.title;
    },

    chooseAbsoluteTime: function(){
      this.showIntervalChanger = false;
      this.choosedDate = this.startDate + ' ' + this.startTime + ' ~ ' + this.endDate + ' ' + this.endTime;
    }
  },

  watch: {
    date: function () {
      this.startDate = this.date[0].getFullYear() + '-' + ("0" + Number(this.date[0].getMonth()+1)).slice(-2) + '-' + ("0" + (this.date[0].getDate())).slice(-2);
      this.endDate = this.date[1].getFullYear() + '-' + ("0" +  Number(this.date[1].getMonth()+1)).slice(-2) + '-' + ("0" + (this.date[1].getDate())).slice(-2);
      this.startTime = '00:00';
      this.endTime = '00:00';
      this.disabled = false;
    },

  },
}
</script>

<style>

.mx-datepicker-range{
  width: 241px !important;
}

.mx-input:hover{
  border: 1px solid rgba(110, 203, 191);
}

.mx-input:active{
  border: 1px solid rgba(110, 203, 191);
}

.mx-calendar-content .cell.in-range, .mx-calendar-content .cell.hover-in-range {
  background-color: rgba(110, 203, 191, 0.2);
}

.mx-calendar-content .cell.active {
  background-color: rgba(110, 203, 191);
}

.vue__time-picker input.display-time {
  display: inline-block;
  box-sizing: border-box;
  height: 34px;
  padding: 6px 30px;
  padding-left: 10px;
  font-size: 14px;
  line-height: 1.4;
  color: #555;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
  width: 92px;
}

.choose-btn{
  margin-top: 35px;
  font-size: 12px;
  background-color: rgb(111, 182, 175);
}

.choose-btn:hover{
  background-color: rgba(110, 203, 191);
}

.custom-border{
  border: 1px solid white;
}

.custom-border:hover{
  border: 1px solid rgba(110, 203, 191);
}

.date-holder{
  display: inline-block;
  box-sizing: border-box;
  height: 34px;
  padding: 6px 30px;
  padding-left: 10px;
  font-size: 14px;
  line-height: 1.4;
  color: #555;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
  width: 192px;
}

.time-holder{
  margin-left: 5px;
}


.custom-scrollbar::-webkit-scrollbar {
  width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background-color: #e4e4e4;
  border-radius: 100px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background-color: rgba(110, 203, 191);
  border-radius: 100px;
}

.vue__time-picker-dropdown ul li:not([disabled]).active, .vue__time-picker-dropdown ul li:not([disabled]).active:focus, .vue__time-picker-dropdown ul li:not([disabled]).active:hover, .vue__time-picker .dropdown ul li:not([disabled]).active, .vue__time-picker .dropdown ul li:not([disabled]).active:focus, .vue__time-picker .dropdown ul li:not([disabled]).active:hover {
  background-color: rgba(110, 203, 191) !important;
}

.vue__time-picker-dropdown ul li, .vue__time-picker .dropdown ul li {
  padding: 2px !important;
}

.vue__time-picker-dropdown ul, .vue__time-picker .dropdown ul::-webkit-scrollbar {
  width: 8px;
}

.vue__time-picker-dropdown ul, .vue__time-picker .dropdown ul::-webkit-scrollbar-track {
  background-color: #e4e4e4;
  border-radius: 100px;
}

.vue__time-picker-dropdown ul, .vue__time-picker .dropdown ul::-webkit-scrollbar-thumb {
  background-color: rgba(110, 203, 191);
  border-radius: 100px;
}


</style>

