<template>
    <b-container fluid>
        <h1 class="h3 mb-4 text-gray-800">Phân công</h1>
        <b-card header-bg-variant="primary" header-tag="header" header-class="py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 slot="header" class="m0 font-weight-bold text-light">Phân công</h6>
            
        </b-card>
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
