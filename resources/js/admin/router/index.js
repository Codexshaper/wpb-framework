import Vue from 'vue'
import Router from 'vue-router'
import Home from '../pages/Home.vue'
import Settings from '../pages/Settings.vue'
import menuFix from '../utils/admin-menu-fix'

Vue.use(Router)

const params = new URLSearchParams(window.location.search)
var page = params.get('page');
let routes = [];

menuFix(page);

switch(page) {
  case 'wpb':
    routes = [
        {
          path: '/',
          name: 'home',
          component: Home
        },
        {
          path: '/settings',
          name: 'settings',
          component: Settings
        },
      ];
    break;
  default:
    routes = [
        {
          path: '/',
          name: 'Home',
          component: Home
        }
      ];
    break;
}

export default new Router({
  routes: routes
})