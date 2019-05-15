<template>
    <b-modal size="lg" id="popup-calendar" ref="popup-calendar" title="Thông tin" header-bg-variant="primary" header-text-variant="light" hide-footer>
        <b-row>
            <b-col col sm="4"><span class="font-weight-bold">Tên cán bộ</span></b-col>
            <b-col col sm="8"><label id="tenCB">{{data.name}}</label></b-col>
        </b-row>
        <b-row>
            <b-col col sm="4"><span class="font-weight-bold">Lớp:</span></b-col>
            <b-col col sm="8"><label id="lop">{{data.assignment.class.name}}</label></b-col>
        </b-row>
        <b-row>
            <b-col col sm="4"><span class="font-weight-bold">Môn học:</span></b-col>
            <b-col col sm="8"><label id="lop">{{data.assignment.subject.name}}</label></b-col>
        </b-row>
        <b-row>
            <b-col col sm="4"><span class="font-weight-bold">Thời gian nghỉ:</span></b-col>
            <b-col col sm="8"><label id="thoigian">{{data.amount}}</label></b-col>
        </b-row>
        <b-row>
            <b-col col sm="4"><span class="font-weight-bold">Ngày nghỉ:</span></b-col>
            <b-col col sm="8"><label id="ngay">{{data.date}}</label></b-col>
        </b-row>
        <b-row>
            <b-col col sm="4"><span class="font-weight-bold">Lý do:</span></b-col>
            <b-col col sm="8"><label id="lido">{{data.reason}}</label></b-col>
        </b-row>
        <b-button variant="outline-primary" class="mt-3" block @click="$bvModal.hide('popup-calendar')">Đóng</b-button>
    </b-modal>
</template>
<script>
export default {
    methods:{
    },
    props: ['data']
}
</script>
