<template>
    <transition name="event-classes-transition"
                enter-active-class="animated fadeInUpBig"
                leave-active-class="animated fadeOutDownBig"
                ontimeupdate="">
        <div class="position-fixed bottom-0 end-0 p-3 notify" style="z-index: 11" v-if="showBox" v-on:click="blockHide">
            <h6>{{ headNotify }}</h6>
            <p>{{ updatedFields }}</p>
            <a v-bind:href="linkToArticle">Посмотреть</a>
        </div>
    </transition>
</template>

<style>
    .notify {
        background-color: #60cd8e;
        border: 1px #2a5164 solid;
        border-radius: 10px;
        box-shadow: 1px 1px 10px 10px rgba(50, 50, 50, 0.1);
        min-width: 320px;
        margin: 20px;

    }

</style>

<script>
export default {

    data() {
        return {
            showBox: false,
            channel: null,
            headNotify: '',
            updatedFields: '',
            linkToArticle: ''
        }
    },
    mounted() {
        if (typeof Echo !== 'undefined') {
            Echo.private('articles')
                .listen('ArticleUpdated', (data) => {
                    this.showBox = true
                    this.headNotify = data.article.title
                    this.updatedFields = data.updatedFields
                    this.linkToArticle = data.linkToArticle
                })
        }
    },

    updated() {
        setTimeout( () => {
            this.blockHide()
        }, 5000)
    },

    methods: {
        blockHide() {
            this.showBox = false
        }
    }
}
</script>
