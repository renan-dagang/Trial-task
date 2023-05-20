import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "./components/Dashboard.vue";
import CourseList from "./components/CourseList.vue";
import StudentList from "./components/StudentList.vue";
import Enrollment from "./components/Enrollment.vue";
import EnrollmentCourse from "./components/EnrollmentCourse.vue";

const routes = [
    {
        path: "/",
        name: "dashboard",
        component: Dashboard,
    },
    {
        path: "/courses",
        name: "courses",
        component: CourseList,
    },
    {
        path: "/students",
        name: "students",
        component: StudentList,
    },
    {
        path: "/enrollment",
        name: "enrollment",
        component: Enrollment,
    },
    {
        path: "/enrollment-course",
        name: "enrollment-course",
        component: EnrollmentCourse,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
