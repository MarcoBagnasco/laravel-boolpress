<template>
    <section>
        <h3 class="category">{{category}}</h3>
    </section>
</template>

<script>
export default {
    name: 'Category',
    props: {
        category: String,
    }
}
</script>

<style lang="scss" scoped>
.category{
    font-style: italic;
}
</style>