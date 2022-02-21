<template>
    <div>
        {{ message }}
    </div>
</template>
<script>

export default {
    data() {
        return {
            message: 'About component'
        }
    },
    mounted() {
        this.fetchTodos()
    },
    methods: {
        fetchTodos() {
            this.message = 'Calvin'
        }
    }
}
</script>
