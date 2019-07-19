<template>
    <div class="stub-vendor-stub-model-form" v-loading="loadedStubModel.busy">
        <form class="form" @submit.prevent="save">
            <t-form-fields v-model="loadedStubModel" :fields="fields" :busy="loadedStubModel.busy"></t-form-fields>
            <button class="btn btn-secondary" type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    import StubModel from "../models/StubModel";

    export default {
        props: {
            stubModel: {
                type: Object
            },
            fields: {
                required: true
            }
        },
        data() {
            return {
                loadedStubModel: null,
            };
        },
        methods: {
            save() {
                this.loadedStubModel.save();
            }
        },
        watch: {
            stubModel: {
                deep: true,
                immediate: true,
                handler(newVal) {
                    Vue.set(this, "loadedStubModel", new StubModel(newVal));
                }
            }
        }
    };
</script>

<style lang="scss">

</style>
