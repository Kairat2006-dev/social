<script>
import axios from "axios";
import {Link} from "@inertiajs/vue3";
export default {
    name: "Create",
    methods: {},
    components:{
      Link
    },
    props: {
        posts: Array
    },
    data() {
        return {}
    }
}
</script>

<template>
    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1>Посты</h1>
        <div v-for="post in posts" :key="post.id" class="mb-6">
            <!-- Wrap the entire post content in a Link -->
            <Link :href="route('posts.show', post.id)" class="block p-4 bg-white rounded-lg shadow-sm transition-transform transform hover:scale-105">
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ post.title }}</h3>

                <div v-if="post.image_url" class="mb-2">
                    <img :src="post.image_url" alt="preview" class="w-full h-auto rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <p class="text-gray-700">{{ post.content }}</p>
                </div>


            </Link>
            <a :href="route('personal.show',post.user)" class="text-blue-500 hover:underline">{{ post.user_name }}</a>
        </div>
    </div>
</template>

<style scoped>
/* Additional styles can be added here if necessary */
</style>
