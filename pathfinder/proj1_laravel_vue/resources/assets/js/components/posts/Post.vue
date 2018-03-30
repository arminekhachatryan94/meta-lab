<template>
<div class="card margin-0-50-20-50 padding-30">
    <div class="text-center">
        <a :href="link">
            {{ title }}
        </a>
    </div>
    <br class="display-block border-bottom-dashed">
    <div>
        <div class="text-right">{{ user_id }}</div>
        <div class="text-right">
            <i>{{ created_at }} at {{ created_at }}</i>
        </div>
        <div>
            {{ body }}
        </div>
    </div>
</div>
</template>

<script>
export default{
    props: ['id', 'user_id', 'title', 'body', 'created_at', 'updated_at'],
    created() {
        // console.log('created');
    },
    computed: {
        link() {
            return "/post/" + this.id;
        }
    }
}
</script>

<style>
</style>