<template>
    <div class="jgile-tasks-form" v-loading="loadedTasks.busy">
        <form class="form" @submit.prevent="save">
            <t-form-fields v-model="loadedTasks" :fields="fields" :busy="loadedTasks.busy"></t-form-fields>
            <button class="btn btn-secondary" type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    import Tasks from "../models/Tasks";

    export default {
        props: {
            stubPackage: {
                type: Object
            },
            fields: {
                required: true
            }
        },
        data() {
            return {
                loadedTasks: null,
            };
        },
        methods: {
            save() {
                this.loadedTasks.save();
            }
        },
        watch: {
            stubPackage: {
                deep: true,
                immediate: true,
                handler(newVal) {
                    Vue.set(this, "loadedTasks", new Tasks(newVal));
                }
            }
        }
    };
</script>

<style lang="scss">

</style>
