<template>
    <Header></Header>
    <div>
        <nav class="navbar">
            <ul class="navbar-menu">
                <li>
                    <router-link to="/students">View Students</router-link>
                </li>
                <li>
                    <router-link to="/courses">View Courses</router-link>
                </li>
                <li>
                    <router-link to="/enrollment">Enroll a Student</router-link>
                </li>
                <li>
                    <router-link to="/enrollment-course"
                        >Course Enrollment</router-link
                    >
                </li>
            </ul>
        </nav>

        <!-- Rest of the Dashboard template code here -->
    </div>
</template>

<script>
import Header from "./Header.vue";

export default {
    name: "Dashboard",
    components: {
        Header,
    },
};
</script>

<style scoped>
.navbar {
    background-color: #333;
    color: #fff;
    padding: 10px;
}

.navbar-menu {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.navbar-menu li {
    margin-right: 10px;
}

.navbar-menu li a {
    color: #fff;
    text-decoration: none;
}

.navbar-menu li a:hover {
    color: #ccc;
}
</style>
