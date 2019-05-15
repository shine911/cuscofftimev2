<template>
    <b-modal size="lg" id="add-calendar" ref="add-calendar" title="Đăng ký lịch nghỉ" header-bg-variant="primary"
        header-text-variant="light"
        ok-title="Lưu thông tin"
        ok-variant="outline-primary"
        @ok = "handleOk()"
        cancel-title="Hủy"
        cancel-variant="outline-secondary"
        >
        <b-form-row>
            <b-col cols="12">
                <b-form-group id="input-group-1" label="Ngày đăng ký:" label-for="date"
                    description="Ngày không thể thay đổi">
                    <b-form-input v-model="selected_date" id="date" type="text" readonly>
                    </b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="12" lg="6">
                <b-form-group id="input-group-2" label="Từ" label-for="time_start"
                    description="Chọn giờ bắt đầu">
                    <vue-timepicker format="HH:mm" v-model="event.time_start" @change="changeEvent"></vue-timepicker>
                </b-form-group>
            </b-col>
            <b-col cols="12" lg="6">
                <b-form-group id="input-group-2" label="Đến" label-for="time_end"
                    description="Chọn giờ kết thúc">
                    <vue-timepicker format="HH:mm" v-model="event.time_end" @change="changeEvent"></vue-timepicker>
                </b-form-group>
            </b-col>
            <b-col cols="12">
                <b-form-group id="input-group-4" label="Số giờ" label-for="amount" description="Bắt buộc">
                    <b-form-input v-model="event.amount"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="12">
                <b-form-group id="input-group-3" label="Lớp" label-for="classroom"
                description="Chọn lớp dạy">
                    <b-form-select v-model="event.assign_id" :options="my_class_options"></b-form-select>
                </b-form-group>
            </b-col>
            <b-col cols="12">
                <b-form-group id="input-group-4" label="Lý do" label-for="reason" description="Bắt buộc">
                    <b-form-input v-model="event.reason"></b-form-input>
                </b-form-group>
            </b-col>
        </b-form-row>
    </b-modal>
</template>
<script>
import VueTimepicker from 'vue2-timepicker';

    export default {
        components:{
            VueTimepicker
        },
        data(){
            return{
                event: {
                    "date": this.selected_date,
                    "assign_id": null,
                    "time_start": {
                        "HH": "00",
                        "mm": "00"
                    },
                    "time_end": {
                        "HH": "00",
                        "mm": "00"
                    },
                    "reason": "",
                    "amount": 0,
                }
            }
        },
        methods: {
            changeEvent(){
                this.event.amount = this.event.time_end.HH - this.event.time_start.HH;
                if(this.event.amount < 0){
                        this.$notify({
                            group: 'notify',
                            title: '<h6>Thông báo</h6>',
                            text: "Giờ bắt đầu và kết thúc không hợp lệ",
                            type: "error",
                            });
                }
            },
            showModal() {
                this.$refs['add-calendar'].show()
            },
            hideModal() {
                this.$refs['add-calendar'].hide()
            },
            handleOk(){
                var app = this;
                axios.post("/v1/calendar",{
                        "date": app.selected_date,
                        "assign_id": app.event.assign_id,
                        "time_start": app.event.time_start.HH +":"+ app.event.time_start.mm,
                        "time_end": app.event.time_end.HH +":"+ app.event.time_end.mm,
                        "reason": app.event.reason,
                        "amount": app.event.amount,
                }).then(res=>{
                        this.$notify({
                            group: 'notify',
                            title: '<h6>Thông báo</h6>',
                            text: res.data.message,
                            type: res.data.status,
                            });
                }).then(res=>{
                    app.$store.dispatch("fetch_events");
                });
            }
        },
        computed:{
            selected_date(){
                return this.$store.getters.selected_date;
            },
            my_assignments(){
                return this.$store.getters.my_assignments;
            },
            my_class_options(){
                return this.$store.getters.my_class_options;
            }
        },
    }
</script>
