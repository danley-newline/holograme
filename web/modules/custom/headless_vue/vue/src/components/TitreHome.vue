<template>
 <div>
    <h1 class="font-weight-bold redart">{{title}}</h1>

 </div>
    
</template>

<script>
export default {
    props:{
        title: String,
    },  
}
</script>
<style scoped>
    .redart{
        color: red;
    }
</style>