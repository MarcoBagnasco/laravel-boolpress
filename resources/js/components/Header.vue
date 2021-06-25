<template>
    <header class="main-header">
        <h1><a href="">BoolPress</a></h1>

        <nav>
            <ul class="links">
                <li>
                    <router-link :to="{name: 'home'}">Home</router-link>
                </li>
                <li>
                    <router-link :to="{name: 'about'}">About</router-link>
                </li>
                <li>
                    <router-link :to="{name: 'blog'}">Blog</router-link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header',
}
</script>

<style lang="scss" scoped>
.main-header{
    background-color: #aaa;
    text-align: center;

    .links{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;

        li{
            list-style: none;
            margin: 1rem;

            .active{
                color: #f00;
            }
        }
    }
}
</style>