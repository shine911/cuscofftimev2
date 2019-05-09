<template>
    <b-modal size="md" id="edit-course" ref="edit-course" title="Chỉnh sửa chương trình" header-bg-variant="primary"
        header-text-variant="light"
        ok-title="Lưu thông tin"
        ok-variant="outline-primary"
        @ok = "handleOk()"
        cancel-title="Hủy"
        cancel-variant="outline-secondary"
        >
        <b-form-row>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-1" label="Tên chương trình:" label-for=""
                    description="Tên Chương Trình">
                    <b-form-input v-model="course.name" type="text">
                    </b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group label="Loại hình" description="Chọn loại hình">
                    <b-form-select v-model="course.type_id" :options="options_type"></b-form-select>
                </b-form-group>
            </b-col>
        </b-form-row>
    </b-modal>
</template>
<script>
export default {
    props: {
        course:{
            type: Object,
            default: ()=>({
                id: null,
                name:'',
                type_id: ''
            }),
        }
    },
    data(){
        return {
                options_type:[
                {"value": null, "text": "Chọn loại hình"},
                {"value": 1, "text": "Dài hạn"},
                {"value": 2, "text": "Ngắn hạn"},
                ]
        }
    },
    methods:{
        handleOk(){
            var app = this;
            axios.put('/v1/admin/courses/'+app.course.id,{
                "name": app.course.name,
                "type_id": app.course.type_id
            })
            .then((res)=>{
                app.$notify({
                    group: "notify",
                    title: "Thông báo",
                    type: res.data.status,
                    text: res.data.message
                })
            })
            .then(()=>{
                app.$store.dispatch("fetch_courses");
            });
        }
    }

}
</script>
