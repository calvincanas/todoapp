import { createApp } from "vue";
import { createRouter, createWebHashHistory } from 'vue-router'

// components
import App from './views/app'
import Todo from './views/Todo'



const routes = [
  { path: '/', component: Todo, }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

const app = createApp(App)
app.use(router)

app.mount('#app')
