<template>
    <div class="alert alert-danger" role="alert">
        <p>{{ error.exception.data.error }}</p>
        <p>{{ error }}</p>
    </div>
</template>

<script>
    export default {
        name: 'errorMessage',
        props: ['error'],
    }
</script>
