/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Datepicker from 'vuejs-datepicker';
import vuejsDatepicker from 'vuejs-datepicker';



const stopwatch = new Vue({
    el: "#stopwatch",
    data: {
        times: [],
        animateFrame: 0,
        nowTime: 0,
        diffTime: 0,
        startTime: 0,
        isRunning: false
    },
    methods: {
        // 現在時刻から引数に渡した数値を startTime に代入
        setSubtractStartTime: function (time) {
            var time = typeof time !== 'undefined' ? time : 0;
            this.startTime = Math.floor(performance.now() - time);
        },
        // タイマーをスタートさせる
        startTimer: function () {
            // loop()内で this の値が変更されるので退避
            var vm = this;
            vm.setSubtractStartTime(vm.diffTime);
            // ループ処理
            (function loop() {
                vm.nowTime = Math.floor(performance.now());
                vm.diffTime = vm.nowTime - vm.startTime;
                vm.animateFrame = requestAnimationFrame(loop);
            }());
            vm.isRunning = true;
        },
        // タイマーを停止させる
        stopTimer: function () {
            this.isRunning = false;
            cancelAnimationFrame(this.animateFrame);
        },
        // 計測中の時間を配列に追加
        pushTime: function () {
            this.times.push({
                hours: this.hours,
                minutes: this.minutes,
                seconds: this.seconds,
                milliSeconds: this.milliSeconds
            });
        },
        // 初期化
        clearAll: function () {
            this.startTime = 0;
            this.nowTime = 0;
            this.diffTime = 0;
            this.times = [];
            this.stopTimer();
            this.animateFrame = 0;
        }
    },
    computed: {
        // 時間を計算
        hours: function () {
            return Math.floor(this.diffTime / 1000 / 60 / 60);
        },
        // 分数を計算 (60分になったら0分に戻る)
        minutes: function () {
            return Math.floor(this.diffTime / 1000 / 60) % 60;
        },
        // 秒数を計算 (60秒になったら0秒に戻る)
        seconds: function () {
            return Math.floor(this.diffTime / 1000) % 60;
        },
        // ミリ数を計算 (1000ミリ秒になったら0ミリ秒に戻る)
        milliSeconds: function () {
            return Math.floor(this.diffTime % 1000);
        }
    },
    filters: {
        // ゼロ埋めフィルタ 引数に桁数を入力する
        // ※ String.prototype.padStart() は IEじゃ使えない
        zeroPad: function (value, num) {
            var num = typeof num !== 'undefined' ? num : 2;
            return value.toString().padStart(num, "0");
        }
    }
});


const app = new Vue({
    el: '#app',
    components: {
        Datepicker
    },
    data: {
        defaultDate: new Date(),
        DatePickerFormat: 'yyyy-MM-dd',
        ja: {
            language: 'Japanese',
            months: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            monthsAbbr: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            days: ['日', '月', '火', '水', '木', '金', '土'],
            rtl: false,
            ymd: 'yyyy-MM-dd',
            yearSuffix: '年'
        }
    }
});