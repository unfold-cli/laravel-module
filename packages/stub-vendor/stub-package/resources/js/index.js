import Vue from 'vue';
import "./models/StubModel";

import StubModelForm from "./components/StubModelForm";
import StubModelTable from "./components/StubModelTable";

Vue.component('stub-model-table', StubModelTable);
Vue.component('stub-model-form', StubModelForm);
