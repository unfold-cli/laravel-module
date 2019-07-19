<template>
    <div class="stub-vendor-stub-model-table" v-loading="busy">
        <with-data :source="getTableData" :query.sync="query" :history="mergedConfig.history" :query-string-defaults="{}">
            <div slot-scope="{ result, isLoaded, isLoading, queryString }" :class="{'table-empty': !Number(result.total), 'table-loading':isLoading, 'table-loaded': isLoaded}">
                <portal to="tableData">
                    <template slot-scope="{path}">
                        <span class="table-data-item">\{{ _get(result, path) }}</span>
                    </template>
                </portal>
                <portal to="tableSearch">
                    <input type="text" class="form-control" v-model="query.filter.search" :placeholder="mergedConfig.searchPlaceholder">
                </portal>
                <portal to="tablePaginator">
                    <b-pagination size="md" :hide-goto-end-buttons="true" :total-rows="result.total" v-model="computedPage" :per-page="result.perPage"/>
                </portal>
                <portal to="tablePerPage">
                    <form class="form-inline">
                        <div class="form-group">
                            <select v-model.number="query.perPage" class="form-control mr-2 pr-5">
                                <option v-for="perPage in mergedConfig.perPage" :key="'perPage' + perPage" :value="perPage">\{{ perPage }}</option>
                            </select>
                        </div>
                    </form>
                </portal>

                <div class="d-flex my-2">
                    <div class="mr-2">
                        <portal-target name="tableSearch" slim></portal-target>
                    </div>
                    <div class="ml-auto">
                        <portal-target name="tablePerPage" slim></portal-target>
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th v-for="column in mergedConfig.columns" :key="column.key" :class="column.classes" :style="column.style">
                            <template v-if="column.sortable">
                                <data-sort-toggle :for="column.key" v-model="query.sort">
                                    <template slot-scope="{ isSortedAsc, isSortedDesc }">
                                        \{{ column.label }}
                                        <span v-if="isSortedAsc" class="fas fa-fw fa-sort-up"></span>
                                        <span v-if="isSortedDesc" class="fas fa-fw fa-sort-down">️</span>
                                        <span v-if="!isSortedDesc && !isSortedAsc" class="fas fa-fw fa-sort"></span>
                                    </template>
                                </data-sort-toggle>
                            </template>
                            <template v-else>
                                <span class="column-title">\{{ column.label }}</span>
                            </template>
                        </th>
                    </tr>
                    </thead>
                    <template v-if="hasDefaultSlot">
                        <template v-for="(item, item_key) in result.data">
                            <slot :row="item" :row-key="item_key" :query="query" :columns="mergedConfig.columns" name="row"></slot>
                        </template>
                    </template>
                    <template v-else>
                        <template v-for="(item, item_key) in result.data">
                            <tr>
                                <td v-for="column in mergedConfig.columns">
                                    <slot :name="column.key" :row="item" :row-key="item_key" :query="query" :columns="mergedConfig.columns">
                                        \{{ item[column.key] }}
                                    </slot>
                                </td>
                            </tr>
                            <template v-if="result.total === 0">
                                <slot name="noResults">
                                    <tr>
                                        <td :colspan="columns.length">No Results</td>
                                    </tr>
                                </slot>
                            </template>
                        </template>
                    </template>
                </table>

                <div class="d-flex my-2">
                    <div class="ml-auto">
                        <portal-target name="tablePaginator" slim></portal-target>
                    </div>
                </div>

            </div>
        </with-data>
    </div>
</template>

<script>
    import _ from 'lodash';

    export default {
        props: {
            url: {
                type: String,
                required: true
            },
            config: {
                type: Object
            },
            transformer: {
                default: null
            }
        },
        data() {
            return {
                busy: false,
                query: {
                    page: 1,
                    perPage: 10,
                    filter: {
                        search: null
                    }
                },
                defaultConfig: {
                    history: false,
                    perPage: [10, 25, 50],
                    columns: [
                        { key: 'id', label: 'ID', sortable: true, },
                        { key: 'name', label: 'Name', sortable: true, },
                        { key: 'created_at', label: 'Created', sortable: true, },
                        { key: 'updated_at', label: 'Updated', sortable: true, },
                        { key: 'action', label: '', sortable: false, },
                    ],
                    searchPlaceholder: 'Search'
                },
                mergedConfig: {},
            };
        },
        computed: {
            hasDefaultSlot() {
                return !!this.$slots.default;
            },
            computedPage: {
                get() {
                    return _.toInteger(_.get(this, "query.page", 1));
                },
                set(newVal) {
                    return Vue.set(this.query, "page", _.toInteger(newVal));
                },
            },
        },
        created() {
            this.mergedConfig = _.merge({}, this.defaultConfig, this.config);
        },
        methods: {
            _get: _.get,
            defaultTransformer(response) {
                return {
                    data: _.get(response, 'data.data', _.get(response, 'data', null)),
                    total: _.toInteger(_.get(response, 'data.meta.total', 0)),
                    perPage: _.toInteger(_.get(response, 'data.meta.per_page', 15)),
                };
            },
            getTableData({ queryString }) {
                this.busy = true;
                return new Promise(resolve => {
                    axios.get(`${this.url}?${queryString}`).then(response => {
                        this.busy = false;
                        resolve(this.transformer ? this.transformer(response) : this.defaultTransformer(response));
                    });
                });
            },
        },
    };
</script>

<style lang="scss">
</style>
