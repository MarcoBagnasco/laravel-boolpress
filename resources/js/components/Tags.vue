<template>
    <section class="tags">
        <span v-for="tag in tags" :key="`tag-${tag.id}`" class="tag">{{tag.name}}</span>
    </section>
</template>

<script>
export default {
    name: 'Tags',
    props: {
        tags: Array,
    }
}
</script>

<style lang="scss">
.tag{
    display: inline-block;
    margin-right: 0.5rem;
    padding: 0.5rem;
    color: #fff;
    font-size: 0.8rem;
    background-color: rgb(17, 176, 230);
    border-radius: 10px;
}
</style>