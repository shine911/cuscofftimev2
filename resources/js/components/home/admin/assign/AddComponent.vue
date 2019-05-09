<template>
    <b-modal size="lg" id="add" ref="add" title="Phân công mới" header-bg-variant="primary"
        header-text-variant="light"
        ok-title="Lưu thông tin"
        ok-variant="outline-primary"
        @ok = "handleOk()"
        cancel-title="Hủy"
        cancel-variant="outline-secondary"
        >
        <b-form-row>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-2" label="Tên cán bộ:" label-for="date"
                    description="Hãy gõ tên cán bộ">
                    <vue-bootstrap-typeahead v-model="user_query" @hit="assignment.user = $event" :serializer="item => item.name" :data="users"/>
                </b-form-group>
            </b-col>
            <b-col md="6">
                <b-card class="m-3" v-if="assignment.user">
                    <b-row>
                        <b-col cols="4">ID:</b-col>
                        <b-col cols="8">{{assignment.user.id}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Tên:</b-col>
                        <b-col cols="8">{{assignment.user.name}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Email:</b-col>
                        <b-col cols="8">{{assignment.user.email}}</b-col>
                    </b-row>
                </b-card>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-2" label="Môn học:" label-for="date"
                    description="Điền tên môn học">
                    <vue-bootstrap-typeahead v-model="subject_query" @hit="assignment.subject = $event" :serializer="item => item.name" :data="subjects"/>
                </b-form-group>
            </b-col>
            <b-col md="6">
                <b-card class="m-3" v-if="assignment.subject">
                    <b-row>
                        <b-col cols="4">ID:</b-col>
                        <b-col cols="8">{{assignment.subject.id}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Tên:</b-col>
                        <b-col cols="8">{{assignment.subject.name}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Số tiết:</b-col>
                        <b-col cols="8">{{assignment.subject.amount}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Học kì:</b-col>
                        <b-col cols="8">{{assignment.subject.semester}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Khóa:</b-col>
                        <b-col cols="8">{{assignment.subject.course.name}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Loại hình:</b-col>
                        <b-col cols="8">{{assignment.subject.course.course_type.name}}</b-col>
                    </b-row>
                </b-card>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-2" label="Lớp:" label-for="date"
                    description="Hãy gõ tên lớp">
                    <vue-bootstrap-typeahead v-model="classroom_query" @hit="assignment.class = $event" :serializer="item => item.name" :data="classroom"/>
                </b-form-group>
            </b-col>
            <b-col md="6">
                <b-card class="m-3" v-if="assignment.class">
                    <b-row>
                        <b-col cols="4">ID:</b-col>
                        <b-col cols="8">{{assignment.class.id}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Tên:</b-col>
                        <b-col cols="8">{{assignment.class.name}}</b-col>
                    </b-row>
                    <b-row>
                        <b-col cols="4">Loại hình:</b-col>
                        <b-col cols="8">{{assignment.class.is_overtime?"Ngoài giờ":"Trong giờ"}}</b-col>
                    </b-row>
                </b-card>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-2" label="Bắt đầu:" label-for="date"
                    description="Ngày bắt đầu">
                    <b-form-input v-model="assignment.time_start" type="number"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-2" label="Kết thúc:" label-for="date"
                    description="Ngày kết thúc">
                    <b-form-input v-model="assignment.time_end" type="number"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-2" label="Tháng:" label-for="date"
                    description="Chọn một tháng">
                    <b-form-input v-model="assignment.month" type="month"></b-form-input>
                </b-form-group>
            </b-col>
        </b-form-row>
    </b-modal>
</template>
<script>
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead';

export default {
    components:{
        VueBootstrapTypeahead
    },
    data(){
        return{
            assignment:{
            },
            users: [],
            user_query: '',
            subjects:[],
            subject_query: '',
            classroom: [],
            classroom_query:'',
            
        }
    },
    methods:{
        handleOk(){
            var assignment = this.assignment;
            var app = this;
            var params = {
                "user_id": assignment.user.id,
                "sub_id": assignment.subject.id,
                "time_start": assignment.time_start,
                "time_end": assignment.time_end,
                "month": assignment.month,
                "class_id": assignment.class.id
            }
            axios.post('/v1/admin/assign', params)
            .then((res)=>{
                app.$notify({
                    group: 'notify',
                    type: res.data.status,
                    text: res.data.message,
                    title: 'Thông báo'
                })
                app.$store.dispatch("fetch_assignments");
            })
        }
    }
    ,
    watch:{
        user_query(newQuery){
            var app = this;
            axios.get(`/v1/admin/users/?q=${newQuery}`)
                .then((res) => {
                    app.users = res.data;
                })
            
        },
        subject_query(newQuery){
            var app = this;
            axios.get(`/v1/admin/subjects/?q=${newQuery}`)
                .then((res) => {
                    app.subjects = res.data;
                })
        },
        classroom_query(newQuery){
            var app = this;
            axios.get(`/v1/admin/classroom/?q=${newQuery}`)
                .then((res) => {
                    app.classroom = res.data;
                })
        },
    },
}
</script>

