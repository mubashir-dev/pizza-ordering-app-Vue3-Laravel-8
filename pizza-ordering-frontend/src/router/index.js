import { createRouter, createWebHashHistory } from 'vue-router'
import Dashboard from '../views/Dashboard'
import Home from '../views/Index'

const routes = [
  {
    meta: {
      title: 'Pizza Ordering App'
    },
    path: '/',
    name: 'Home Page',
    component: Home
  },
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
      title: 'Pizza Detail'
    },
    path: '/pizza-detail/:id',
    name: 'Pizza Detail',
    component: () => import(/* webpackChunkName: "tables" */ '../views/PizzaDetail')
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
      title: 'Edit Pizza'
    },
    path: '/edit-pizza/:id',
    name: 'Edit Pizza',
    component: () => import(/* webpackChunkName: "tables" */ '../views/EditPizza')
  },
  {
    meta: {
      title: 'Create Pizza Category'
    },
    path: '/create-category',
    name: 'Create Pizza Category',
    component: () => import(/* webpackChunkName: "tables" */ '../views/CreatePizzaCategory')
  },
  {
    meta: {
      title: 'Edit Pizza Category'
    },
    path: '/edit-category/:id',
    name: 'Edit Pizza Category',
    component: () => import(/* webpackChunkName: "tables" */ '../views/EditPizzaCategory')
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
      title: 'Customers'
    },
    path: '/customers',
    name: 'Customers',
    component: () => import(/* webpackChunkName: "tables" */ '../views/Customers')
  },
  {
    meta: {
      title: 'Orders'
    },
    path: '/orders',
    name: 'Orders',
    component: () => import(/* webpackChunkName: "tables" */ '../views/Orders')
  },
  {
    meta: {
      title: 'Order Detail'
    },
    path: '/orders-details/:id',
    name: 'Order Detail',
    component: () => import(/* webpackChunkName: "tables" */ '../views/OrderDetails')
  },
  {
    meta: {
      title: 'Create User'
    },
    path: '/create-user',
    name: 'Create User',
    component: () => import(/* webpackChunkName: "tables" */ '../views/CreateUser')
  },
  {
    meta: {
      title: 'Edit User'
    },
    path: '/edit-user/:id',
    name: 'Edit User',
    component: () => import(/* webpackChunkName: "tables" */ '../views/EditUser')
  },
  {
    meta: {
      title: 'Users List'
    },
    path: '/user_list',
    name: 'Users List',
    component: () => import(/* webpackChunkName: "tables" */ '../views/RegisteredUsers')
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
