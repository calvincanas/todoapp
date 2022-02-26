<template>
    <div>
        <div id="myDIV" class="header">
            <h2>My To Do List</h2>
            <input type="text" v-model="newTodoContent" placeholder="Task...">
            <span @click="addNewTodoItem" class="addBtn" :disabled="v$.newTodoContent.$invalid">Add</span>
        </div>
        <ul>
            <li @click="toggleTodoItem(index)" :class="{ 'checked': todo.is_done  }" v-for="(todo, index) in todos">
                {{ todo.content }}
                <span @click="deleteTodoItem(index)" class="close">×</span>
            </li>
        </ul>
    </div>
</template>
<script>
import axios from "axios";
import useVuelidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'

export default {
    setup () {
        return { v$: useVuelidate() }
    },
    data() {
        return {
            newTodoContent: '',
            todos: []
        }
    },
    validations() {
      return {
          newTodoContent: { required }
      }
    },
    created() {
        this.fetchTodos()
    },
    methods: {
        fetchTodos() {
            axios.get('/api/todos')
                .then((response) => {
                    this.todos = response.data
                })
        },
        toggleTodoItem(index) {
            const item = this.todos[index]
            axios.patch(`/api/todos/${item.id}`, {
                is_done: !item.is_done
            }).then(response => this.todos[index].is_done = response.data.item.is_done)
        },
        deleteTodoItem(index) {
            const item = this.todos[index]
            axios.delete(`/api/todos/${item.id}`)
                .then(response => this.todos.splice(index, 1))
        },
        addNewTodoItem() {
            this.v$.newTodoContent.$touch()
            if (this.v$.newTodoContent.$error) return false;

            axios.post('/api/todos', {
                new_content: this.newTodoContent
            }).then((response) => {
                this.todos.push(response.data.item)
            })
        }
    }
}
</script>
