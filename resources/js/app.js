import Chart from 'chart.js/auto';
import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './router';
import { __ } from './helpers';
import App from './layout/App.vue';

// console.log(Chart.defaults);
Chart.defaults.backgroundColor = '#f3f4f6';
Chart.defaults.borderColor = '#6ecbbf';
Chart.defaults.elements.line.borderWidth = 1;
Chart.defaults.scale.grid.borderColor = '#9ca3af';
Chart.defaults.scale.grid.color = '#f3f4f6';
Chart.defaults.plugins.legend.display = false;
Chart.defaults.plugins.tooltip.boxHeight = 1;
Chart.defaults.plugins.tooltip.multiKeyBackground = 'transparent';

Vue.mixin({
    methods: {
        __: function (key) {
            return __(key);
        }
    },
});

Vue.use(VueRouter);

new Vue({
    render: h => h(App),
    router: router,
}).$mount('#app');