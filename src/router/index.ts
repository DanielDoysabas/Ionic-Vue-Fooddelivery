import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import Dashboard from '../views/dashboard.vue';
import Login from '../views/login.vue';
import Register from '../views/register.vue';
import FoodList from '../views/foodList.vue';
import Admin from '../views/loginAdmin.vue';
import BeverageList from '../views/beverageList.vue';
import AdminDashboard from '../views/admin/dashboard.vue';
import AdminBeverage from '../views/admin/beverageManage.vue';
import AdminFood from '../views/admin/foodManage.vue';
import AdminOrder from '../views/admin/orderManage.vue';
import AdminFoodAdd from '../views/admin/foodmanager/foodAdd.vue';
import AdminFoodList from '../views/admin/foodmanager/foodList.vue';
import AdminBeverageAdd from '../views/admin/beveragemanager/beverageAdd.vue';
import AdminBeverageList from '../views/admin/beveragemanager/beverageList.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    redirect: '/login',
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/login_admin',
    name: 'Admin',
    component: Admin
  },
  {
    path: '/admin_dashboard',
    name: 'AdminDashboard',
    component: AdminDashboard
  },
  {
    path: '/admin_beverage',
    name: 'AdminBeverage',
    component: AdminBeverage
  },
  {
    path: '/admin_food',
    name: 'AdminFood',
    component: AdminFood
  },
  {
    path: '/admin_foodadd',
    name: 'AdminFoodAdd',
    component: AdminFoodAdd
  },
  {
    path: '/admin_foodlist',
    name: 'AdminFoodList',
    component: AdminFoodList
  },
  {
    path: '/admin_order',
    name: 'AdminOrder',
    component: AdminOrder
  },
  {
    path: '/admin_beveragelist',
    name: 'AdminBeverageList',
    component: AdminBeverageList
  },
  {
    path: '/admin_beverageadd',
    name: 'AdminBeverageAdd',
    component: AdminBeverageAdd
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/home',
    name: 'Home',
    component: Dashboard
  },
  {
    path: '/foodlist',
    name: 'FoodList',
    component: FoodList
  },
  {
    path: '/beveragelist',
    name: 'Beveragelist',
    component: BeverageList
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
