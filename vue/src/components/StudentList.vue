<template>
    <Header></Header>
    <div class="student-list">
        <h2>Student List</h2>
        <div class="student-cards">
            <div
                class="student-card"
                v-for="student in students"
                :key="student.id"
            >
                <div class="name">
                    {{ capitalizeName(student.first_name) }}
                    {{ capitalizeName(student.last_name) }}
                </div>
                <div class="grade">GPA: {{ student.grade }}%</div>
                <div class="scholarship">
                    Scholarship: {{ student.has_scholarship ? "Yes" : "No" }}
                </div>
                <div class="enrolled-courses">
                    <p>Enrolled Courses:</p>
                    <ul>
                        <li v-for="course in student.courses" :key="course.id">
                            {{ course.name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Header from "./Header.vue";

export default {
    name: "StudentList",
    components: {
        Header,
    },
    data() {
        return {
            students: [],
        };
    },
    created() {
        this.fetchStudents();
    },
    methods: {
        fetchStudents() {
            axios
                .get("http://localhost:8000/api/students")
                .then((response) => {
                    this.students = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        capitalizeName(name) {
            return name.charAt(0).toUpperCase() + name.slice(1);
        },
    },
};
</script>

<style scoped>
h2 {
    text-align: center;
}

.student-list {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.student-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.student-card {
    width: 300px;
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.student-card .name {
    font-size: 24px;
    font-weight: bold;
    margin: 10px 0;
    text-transform: capitalize;
}
</style>
