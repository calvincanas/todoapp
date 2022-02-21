<template>
    <div>
        <router-link to="/">Go to Home</router-link>
        <router-link to="/todos">Go to Todos</router-link>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>

export default {
    computed: {},
    data() {
        return {
            message: 'Hello World!'
        }
    }
}
</script>
