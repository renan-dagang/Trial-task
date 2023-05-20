<template>
    <header>
        <router-link to="/" class="header-link">JD Life Trial Task</router-link>
    </header>
</template>

<script>
export default {
    name: "Header",
};
</script>

<style>
header {
    background-color: #284abb;
    padding: 15px;
    display: flex;
    justify-content: center;
}

.header-link {
    color: white; /* Replace with your desired color */
    font-size: 24px;
    text-decoration: none;
}
</style>
