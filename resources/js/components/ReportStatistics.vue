<template>
    <transition name="event-classes-transition"
                enter-active-class="animated fadeInRightBig"
                leave-active-class="animated fadeOutRightBig"
                ontimeupdate="">
        <div class="position-fixed bottom-0 end-0 p-3 notify" title="Нажмите чтобы закрыть" v-if="showBox" v-on:click="blockHide">
            <h4>Отчет по сайту</h4>
            <div v-for="item in report">
                <p><b>{{ item.title }}</b>: {{ item.value }}</p>
            </div>
        </div>
    </transition>
</template>

<style>
.notify {
    background-color: #eaeeeb;
    border: 1px #1b3431 solid;
    border-radius: 10px;
    box-shadow: 3px 3px 10px 10px rgba(50, 50, 50, 0.2);
    min-width: 320px;
    max-width: 70%;
    margin: 20px;
    z-index: 11;
}

</style>

<script>
export default {

    props: ['uId'],

    data() {
        return {
            showBox: false,
            report: [],
        }
    },
    mounted() {
        if (typeof Echo !== 'undefined') {
            Echo.private('reports.user.' + this.uId)
                .listen('ReportGenerated', (data) => {
                    this.report = data.report
                    this.showBox = true
                })
        }
    },

    updated() {

    },

    methods: {
        blockHide() {
            this.showBox = false
        }
    }
}
</script>
