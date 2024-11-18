<script>
import axios from "axios";
import {Link} from "@inertiajs/vue3";
export default {
    name: "Create",
    methods: {
        toogleFollowing(user){
            axios.get(`/users/${user.id}/toogleFollowing`)
                .then(res=>{
                    console.log(res);
                    post.users.following = res.data.following
                })
        }
    },
    components:{
      Link
    },
    props: {
        post: Array
    },
    data() {
        return {

        }
    },

}
</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-gray-50 rounded-lg shadow-md">
        <div class="mb-4">
            <a :href="route('posts.index')" class="text-blue-500 hover:underline">ГЛАВНАЯ</a>
        </div>
            <div>
                <button
                    @click.prevent="toogleFollowing(post.users)"
                    class="px-4 py-2 rounded transition-colors duration-200 hover:bg-red-600 hover:text-white"
                >
                    {{  post.users.following ? 'Отписаться' : 'Подписаться' }}
                </button>
            </div>
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="mb-2">
                <h2 class="text-xl font-bold text-gray-800">Author:</h2>
                <Link :href="route('personal.show', post.user)" class="text-blue-500 hover:underline">{{ post.user_name }}</Link>
            </div>

            <div class="mb-4">
                <h3 class="text-2xl font-semibold text-gray-800">{{ post.title }}</h3>
            </div>

            <div class="mb-4">
                <p class="text-gray-700">{{ post.content }}</p>
            </div>

            <div v-if="post.image_url" class="mb-4">
                <img :src="post.image_url" alt="preview" class="w-full h-auto rounded-md shadow-sm">
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Additional styles can be added here if necessary */
</style>


