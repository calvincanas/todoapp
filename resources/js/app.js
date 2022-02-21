import { createApp } from "vue";
import { createRouter, createWebHashHistory } from 'vue-router'
import VueAxios from 'vue-axios'
import axios from 'axios'

// components
import App from './views/app'
import Home from './views/home'
import Todo from './views/Todo'



const routes = [
  { path: '/', component: Home },
  { path: '/todos', component: Todo },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

const app = createApp(App)
app.use(VueAxios, axios)
app.use(router)

app.mount('#app')
