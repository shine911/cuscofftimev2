<template>
    <b-modal size="lg" id="edit-subject" ref="edit-subject" title="Sửa môn học" header-bg-variant="primary"
        header-text-variant="light"
        ok-title="Lưu thông tin"
        ok-variant="outline-primary"
        @ok = "handleOk()"
        cancel-title="Hủy"
        cancel-variant="outline-secondary"
        >
        <b-form-row>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-1" label="Tên môn học:" label-for=""
                    description="Tên môn học mới">
                    <b-form-input v-model="data.name" type="text">
                    </b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-2" label="Chương trình:" label-for="date"
                    description="Không thay đổi để trống">
                    <vue-bootstrap-typeahead placeholder="(Không thay đổi)" v-model="courses_query" @hit="data.course_id = $event.id" :serializer="item => item.name" :data="courses"/>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group label="Học kì" description="Chọn một học kì">
                    <b-form-select v-model="data.semester" :options="options_semester"></b-form-select>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group label="Số tiết:" description="Nhập số tiết học">
                    <b-form-input v-model="data.amount" id="amount" type="text"></b-form-input>
                </b-form-group>
            </b-col>
        </b-form-row>
    </b-modal>
</template>
<script>
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead';

export default {
    components:{VueBootstrapTypeahead},
    props:{
        data:{
            type: Object,
            default: ()=>({
                "id": null,
                "name": "",
                "amount": null,
                "semester": null,
                "course_id": null,
                "course": {
                    "id": null,
                    "name": "",
                    "type_id": null,
                    "course_type": {
                        "id": null,
                        "name": ""
                    }
                }
            })
        }
    },
    data(){
        return{
                courses_query: '',
                courses: [],
                options_semester: [
                    {
                        "value": null,
                        "text": "Chọn học kì",
                    },
                    {
                        "value": 1,
                        "text": "Học kì I"
                    },
                    {
                        "value": 2,
                        "text": "Học kì II"
                    },
                    {
                        "value": 3,
                        "text": "Học kì III"
                    },
                    {
                        "value": 4,
                        "text": "Học kì IV"
                    },

                ],
        }
    },
    methods:{
        handleOk(){
            var app = this;
                axios.put('/v1/admin/subjects/'+this.data.id, {
                        "name": app.data.name,
                        "amount": app.data.amount,
                        "semester": app.data.semester,
                        "course_id": app.data.course_id,
                })
                .then((res)=>{
                    app.$notify({
                        group: 'notify',
                        title: '<h6>Thông báo</h6>',
                        text: res.data.message,
                        type: res.data.status
                    });
                })
                .then((res)=>{
                    app.$store.dispatch("fetch_subjects");
                })
        }
    },
    watch:{
        courses_query(newQuery){
            var app = this;
            axios.get(`/v1/admin/courses?q=${newQuery}`)
                .then((res) => {
                    app.courses = res.data;
                })
            
        },
    },
}
</script>
