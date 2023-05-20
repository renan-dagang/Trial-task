<template>
    <Header></Header>
    <div class="enrollment">
        <h2>Enroll a Student</h2>

        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input
                    type="text"
                    id="firstName"
                    v-model="firstName"
                    required
                />
            </div>

            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" v-model="lastName" required />
            </div>

            <div class="form-group">
                <label for="grade">Percentage Grade or GPA:</label>
                <input type="decimal" id="grade" v-model="grade" required />
            </div>

            <button type="submit">Enroll</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import Header from "./Header.vue";

export default {
    name: "Enrollment",
    components: {
        Header,
    },
    data() {
        return {
            firstName: "",
            lastName: "",
            grade: null,
        };
    },
    created() {
        // Add any additional initialization logic here
    },
    methods: {
        submitForm() {
            // Check if the grade is a negative number or lower than 75%
            if (this.grade < 0 || this.grade < 75) {
                // Show an error message to the user
                alert(
                    "Invalid grade. Please enter a non-negative value greater than or equal to 75."
                );
                return; // Exit the method to prevent further processing
            }

            // Form submission logic
            const formData = {
                first_name: this.firstName,
                last_name: this.lastName,
                grade: this.grade,
                has_scholarship: this.grade >= 90, // Set has_scholarship based on grade
            };

            axios
                .post("http://localhost:8000/api/enrollment", formData)
                .then((response) => {
                    // Handle the successful response
                    console.log(response.data);
                    // Show a success message to the user
                    alert(response.data.message);
                    // Reset form fields
                    this.firstName = "";
                    this.lastName = "";
                    this.grade = null;
                })
                .catch((error) => {
                    // Handle the error
                    console.error(error);
                    // Show an error message to the user
                    alert("Enrollment failed. Please try again.");
                });
        },
    },
};
</script>

<style scoped>
.enrollment {
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

input[type="text"],
input[type="decimal"] {
    width: 96%;
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
