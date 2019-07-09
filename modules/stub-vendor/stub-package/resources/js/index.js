import Vue from 'vue';
import "./models/StubPackage";

import StubPackageForm from "./components/StubPackageForm";
import StubPackageTable from "./components/StubPackageTable";

Vue.component('stub-package-table', StubPackageTable);
Vue.component('stub-package-form', StubPackageForm);
