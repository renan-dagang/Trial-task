<template>
    <Header></Header>
    <div class="course-list">
        <h2>Course List</h2>
        <div class="course-cards">
            <div class="course-card" v-for="course in courses" :key="course.id">
                <div class="title">{{ course.name }}</div>
                <div class="description">{{ course.description }}</div>
                <div class="req_gpa">
                    Required GPA: {{ course.required_gpa }}
                </div>
                <div class="limit">
                    Available Slot: {{ course.max_students }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Header from "./Header.vue";

export default {
    name: "CourseList",
    components: {
        Header,
    },
    data() {
        return {
            courses: [],
        };
    },
    created() {
        this.fetchCourses();
    },
    methods: {
        fetchCourses() {
            axios
                .get("http://localhost:8000/api/courses")
                .then((response) => {
                    this.courses = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>

<style scoped>
h2 {
    text-align: center;
}

.course-list {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.course-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.course-card {
    width: 300px;
    margin: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
}

.course-card .title {
    font-size: 24px;
    font-weight: bold;
    margin: 10px;
}

.course-card .req_gpa {
    font-size: 24px;
    font-weight: bold;
    margin: 10px;
}

.course-card .limit {
    font-size: 24px;
    font-weight: bold;
    margin: 10px;
}

.course-card .description {
    font-size: 24px;
    font-weight: bold;
    margin: 10px;
}

.course-card .enroll-button {
    display: block;
    margin: 10px;
    padding: 10px;
    border-radius: 5px;
    background-color: #4caf50;
    color: white;
    text-align: center;
    text-decoration: none;
}

.course-card .enroll-button:hover {
    background-color: #3e8e41;
}
</style>
