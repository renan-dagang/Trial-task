<template>
    <Header></Header>
    <div class="enrollment-course">
        <h2>Enroll within a Course</h2>

        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="student">Student:</label>
                <select
                    id="student"
                    v-model="selectedStudent"
                    required
                    @change="filterCourses"
                >
                    <option value="">Select a student</option>
                    <option
                        v-for="student in students"
                        :value="student.id"
                        :key="student.id"
                    >
                        {{ capitalizeName(student.first_name) }}
                        {{ capitalizeName(student.last_name) }}
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="course">Course:</label>
                <select id="course" v-model="selectedCourse" required>
                    <option value="">Select a course</option>
                    <option
                        v-for="course in filteredCourses"
                        :value="course.id"
                        :key="course.id"
                    >
                        {{ course.name }}
                    </option>
                </select>
            </div>

            <button type="submit">Enroll</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import Header from "./Header.vue";

export default {
    name: "EnrollmentCourse",
    components: {
        Header,
    },
    data() {
        return {
            selectedStudent: "",
            selectedCourse: "",
            students: [],
            courses: [],
            filteredCourses: [],
        };
    },
    created() {
        this.fetchStudents();
        this.fetchCourses();
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
        fetchCourses() {
            axios
                .get("http://localhost:8000/api/courses")
                .then((response) => {
                    this.courses = response.data;
                    this.filterCourses();
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        filterCourses() {
            const student = this.students.find(
                (student) => student.id === this.selectedStudent
            );
            if (student) {
                const requiredGpa = student.grade;
                this.filteredCourses = this.courses.filter((course) => {
                    return course.required_gpa <= requiredGpa;
                });
            } else {
                this.filteredCourses = [];
            }
            this.selectedCourse = "";
        },
        submitForm() {
            const student_id = this.selectedStudent;
            const course_id = this.selectedCourse;
            if (student_id && course_id) {
                const payload = {
                    student_id: this.selectedStudent,
                    course_id: this.selectedCourse,
                };
                console.log(student_id, course_id);
                axios
                    .post(
                        `http://localhost:8000/api/courses/${course_id}/enrollWithCourse`,
                        payload
                    )
                    .then((response) => {
                        // Handle successful enrollment
                        console.log(response.data);
                        alert(response.data.message);
                        this.selectedStudent = "";
                        this.selectedCourse = "";
                    })
                    .catch((error) => {
                        // Handle the error
                        console.error(error);
                        // Show an error message to the user
                        if (
                            error.response &&
                            error.response.data &&
                            error.response.data.message
                        ) {
                            alert(error.response.data.message);
                        } else {
                            alert("Enrollment failed. Please try again.");
                        }
                    });
            } else {
                // Handle form validation errors
                console.log("Please select a student and a course");
            }
        },
        capitalizeName(name) {
            return name.charAt(0).toUpperCase() + name.slice(1);
        },
    },
};
</script>

<style scoped>
.enrollment-course {
    max-width: 500px;
    margin: 0 auto;
}

h2 {
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: #4caf50;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
</style>
