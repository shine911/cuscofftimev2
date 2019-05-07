<template>
    <b-modal size="lg" id="add-subject" ref="add-subject" title="Thêm môn học mới" header-bg-variant="primary"
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
                    <b-form-input v-model="subject.name" type="text">
                    </b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-2" label="Chương trình:" label-for="date"
                    description="Chọn chương trình học">
                    <vue-bootstrap-typeahead v-model="courses_query" @hit="subject.course_id = $event.id" :serializer="item => item.name" :data="courses"/>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group label="Học kì" description="Chọn một học kì">
                    <b-form-select v-model="subject.semester" :options="options_semester"></b-form-select>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group label="Số tiết:" description="Nhập số tiết học">
                    <b-form-input v-model="subject.amount" id="amount" type="text"></b-form-input>
                </b-form-group>
            </b-col>
        </b-form-row>
    </b-modal>
</template>
<script>
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead';
    export default {
        components:{VueBootstrapTypeahead},
        computed: {
            user() {
                return this.$store.getters.user;
            }
        },
        data(){
            return {
                subject: {
                    "name": null,
                    "amount": null,
                    "semester": null,
                    "course_id": null,
                },
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

                ]
            }
        },
        methods:{
            handleOk(){
                var app = this;
                axios.post('/v1/admin/subjects', {
                    subject: app.subject
                }).then((res)=>{
                    app.$notify({
                            group: 'notify',
                            title: '<h6>Thông báo</h6>',
                            text: res.data.message,
                            type: res.data.status,
                    });
                }).then((res)=>{
                    app.$store.dispatch("fetch_subjects");
                });
            }
        },
        watch:{
            courses_query(newQuery){
                var app = this;
                axios.get(`/v1/admin/courses?q=${newQuery}`)
                    .then((res) => {
                        app.courses = res.data;
                    })
                
            }
        },
    }
</script>