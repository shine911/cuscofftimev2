<template>

    <div>
        <notifications group="notify" 
                position="bottom left"
                animation-type="velocity"
                :speed="500"/>
        <router-view></router-view>
    </div>
</template>

<style lang="scss">
    .notification.n-light {
    margin: 10px;
    margin-bottom: 0;
    border-radius: 3px;
    font-size: 13px;
    padding: 10px 20px;
    color: #495061;
    background: #EAF4FE;
    border: 1px solid #D4E8FD;
        .notification-title {
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 10px;
            color: #2589F3;
        }
    }
</style>
