require('./bootstrap');

window.Vue = require('vue');
import VueAxios from 'vue-axios';
import axios from 'axios';
import VModal from 'vue-js-modal';
 
Vue.use(VModal);
Vue.use(VueAxios, axios);

//import HomeComponent from './components/HomeComponent.vue';
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('modal', {
  template: '#modal-template'
})

// const routes = [
//   {
//       name: 'home',
//       path: '/',
//       component: HomeComponent
//   }
// ];

// const router = new VueRouter({ mode: 'history', routes: routes});

const app = new Vue({
    el: '#app',
});
