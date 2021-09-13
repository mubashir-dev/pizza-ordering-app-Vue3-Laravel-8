import { createRouter, createWebHashHistory } from 'vue-router'
import Dashboard from '../views/Dashboard'

const routes = [
  {
    meta: {
      title: 'Pizza Ordering App'
    },
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
  {
    meta: {
      title: "Pizza's"
    },
    path: '/pizzas',
    name: 'pizzas',
    component: () => import(/* webpackChunkName: "tables" */ '../views/Pizza')
  },
  {
    meta: {
      title: 'Create Pizza'
    },
    path: '/create-category',
    name: 'Create Pizza Category',
    component: () => import(/* webpackChunkName: "tables" */ '../views/CreatePizzaCategory')
  },
  {
    meta: {
      title: 'Pizza Categories'
    },
    path: '/pizza-categories',
    name: 'Pizza Categories',
    component: () => import(/* webpackChunkName: "tables" */ '../views/PizzaCategories')
  },
  {
    meta: {
      title: 'Create Pizza'
    },
    path: '/create-pizza',
    name: 'Create Pizza',
    component: () => import(/* webpackChunkName: "tables" */ '../views/CreatePizza')
  },
  {
    meta: {
      title: 'Forms'
    },
    path: '/forms',
    name: 'forms',
    component: () => import(/* webpackChunkName: "forms" */ '../views/Forms')
  },
  {
    meta: {
      title: 'Profile'
    },
    path: '/profile',
    name: 'profile',
    component: () => import(/* webpackChunkName: "profile" */ '../views/Profile')
  },
  {
    meta: {
      title: 'Ui'
    },
    path: '/ui',
    name: 'ui',
    component: () => import(/* webpackChunkName: "ui" */ '../views/Ui')
  },
  {
    meta: {
      title: 'Responsive layout'
    },
    path: '/responsive',
    name: 'responsive',
    component: () => import(/* webpackChunkName: "responsive" */ '../views/Responsive')
  },
  {
    meta: {
      title: 'Login',
      formScreen: true
    },
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '../views/Login')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes,
  scrollBehavior (to, from, savedPosition) {
    return savedPosition || { top: 0 }
  }
})

export default router
