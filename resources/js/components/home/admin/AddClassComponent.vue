<template>
    <b-container fluid>
        AddClass
    </b-container>
</template>
<script>
export default {
    beforeCreate(){
        var user = this.$store.getters.user;
        if(user.roles == 0){
            alert('You dont have permision');
            this.$router.go(-1);
        }
    },
    computed:{
        user(){
            return this.$store.getters.user;
        }
    }
}
</script>
