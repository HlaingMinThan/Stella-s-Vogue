<template>
    <div>
        <h2>Visa Information</h2>
        <p>{{ data.info }}</p>
    </div>
</template>

<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    }
};
</script>

  <style scoped>
  </style>
