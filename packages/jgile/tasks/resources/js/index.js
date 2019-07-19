import Vue from 'vue';
import "./models/Tasks";

import TasksForm from "./components/TasksForm";
import TasksTable from "./components/TasksTable";

Vue.component('tasks-table', TasksTable);
Vue.component('tasks-form', TasksForm);
