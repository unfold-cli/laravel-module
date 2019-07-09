<template>
    <div class="stub-vendor-stub-package-form" v-loading="loadedStubPackage.busy">
        <form class="form" @submit.prevent="save">
            <t-form-fields v-model="loadedStubPackage" :fields="fields" :busy="loadedStubPackage.busy"></t-form-fields>
            <button class="btn btn-secondary" type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    import StubPackage from "../models/StubPackage";

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
                loadedStubPackage: null,
            };
        },
        methods: {
            save() {
                this.loadedStubPackage.save();
            }
        },
        watch: {
            stubPackage: {
                deep: true,
                immediate: true,
                handler(newVal) {
                    Vue.set(this, "loadedStubPackage", new StubPackage(newVal));
                }
            }
        }
    };
</script>

<style lang="scss">

</style>
