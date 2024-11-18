<script>
import {Link} from "@inertiajs/vue3";
import axios from "axios";


export default {
    name: "Index",
    props:{
        posts: Array,
        user: Object
    },
    components:{
        Link
    },
    data(){
        return{
            userData: this.user.data
        }
    },
    methods:{
        toogleFollowing(user){
            axios.get(`/users/${user.id}/toogleFollowing`)
                .then(res=>{
                    this.userData.following = res.data.
                        following

                })
        }
    }
}
</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-gray-50 rounded-lg shadow-md">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-800">{{ userData.name }}</h2>
            <button
                @click.prevent="toogleFollowing(userData)"
                class="px-4 py-2 rounded transition-colors duration-200 hover:bg-red-600 hover:text-white"
            >
                {{ userData.following ? 'Отписаться' : 'Подписаться' }}
            </button>
        </div>

        <div class="mb-4">
            <Link :href="route('posts.index')" class="text-blue-500 hover:underline">
                На главную
            </Link>
        </div>

        <div>
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Посты {{ user.name }}</h3>
            <div v-for="post in posts" :key="post.id" class="bg-white p-4 rounded-lg shadow-sm mb-4 transition-transform transform hover:scale-105">
                <!-- Wrap the entire post content in a Link -->
                <Link :href="route('posts.show', post.id)" class="block">
                    <div class="mb-2">
                        <span class="font-medium text-gray-600">Название:</span>
                        <h4 class="text-xl font-bold text-gray-800">{{ post.title }}</h4>
                    </div>
                    <div v-if="post.image_url" class="mb-2">
                        <img :src="post.image_url" alt="preview" class="w-full h-auto rounded-md shadow-sm">
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Content:</span>
                        <p class="text-gray-700">{{ post.content }}</p>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
