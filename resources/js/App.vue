<template>
    <div>
        <Header />

        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import Header from './components/Header.vue';

export default {
    name: 'App',
    components:{
        Header,
    },
}
</script>

<style lang="scss">
@import '../sass/frontoffice/utilities';

.navigation{
    margin-top: 20px;
    .active-page{
        background-color: lightblue;
    }
}
</style>