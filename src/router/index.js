import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/Dashboard.vue')
    },
    {
      path: '/borang',
      name: 'borang',
      component: () => import('../views/Eborang.vue')
    },
    {
      path: '/jadual',
      name: 'jadual',
      component: () => import('../views/Ejadual.vue')
    },
  ]
})

export default router
