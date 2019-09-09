require('./bootstrap');
window.Vue = require('vue');

import Vuex from 'vuex';

Vue.use(Vuex);

import storeData from './store/index';

const store = new Vuex.Store(
    storeData
);


import VueRouter from 'vue-router';
 Vue.use(VueRouter);

 import master from './components/master';
 import {routes} from './routes'
 
 
 const router = new VueRouter({
     routes,
     mode: 'hash',
 });

 new Vue({
     el: '#app',
     router,
     store,
     components:{master}
 });