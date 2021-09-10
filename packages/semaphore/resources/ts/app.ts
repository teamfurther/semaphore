import Chart from 'chart.js/auto';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import router from './router';
import store from './store';
import App from "./layout/App.vue";

// console.log(Chart.defaults);
Chart.defaults.backgroundColor = '#f3f4f6';
Chart.defaults.borderColor = '#6ecbbf';
Chart.defaults.elements.line.borderWidth = 1;
Chart.defaults.scale.grid.borderColor = '#9ca3af';
Chart.defaults.scale.grid.color = '#f3f4f6';
Chart.defaults.plugins.legend.display = false;
Chart.defaults.plugins.tooltip.boxHeight = 1;
Chart.defaults.plugins.tooltip.multiKeyBackground = 'transparent';

const mountEl = document.querySelector('#app') as HTMLElement;

new Vue({
    created() {
        store.state.appUrl = this.appUrl;
    },
    props: ['appUrl'],
    propsData: { ...mountEl?.dataset },
    render: h => h(App),
    router: router,
    store: store,
}).$mount('#app');