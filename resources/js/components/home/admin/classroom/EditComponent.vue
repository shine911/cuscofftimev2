<template>
    <b-modal size="md" id="edit" ref="edit" title="Thêm lớp mới" header-bg-variant="primary"
        header-text-variant="light"
        ok-title="Lưu thông tin"
        ok-variant="outline-primary"
        @ok = "handleOk()"
        cancel-title="Hủy"
        cancel-variant="outline-secondary"
        >
        <b-form-row>
            <b-col cols="12" md="6">
                <b-form-group id="input-group-1" label="Tên lớp:" label-for=""
                    description="Tên lớp">
                    <b-form-input v-model="classroom.name" type="text">
                    </b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="12" md="6">
                <b-form-group label="Loại hình" description="Chọn loại hình">
                    <b-form-select v-model="classroom.is_overtime" :options="options_type"></b-form-select>
                </b-form-group>
            </b-col>
        </b-form-row>
    </b-modal>
</template>
<script>
export default {
    props:{
        classroom: {
            type: Object,
            default: ()=>({})
        }
    },
    data(){
        return{
            options_type:[
                {"value": 0, "text": "Trong giờ"},
                {"value": 1, "text": "Ngoài giờ"},
            ]
        }
    },
    methods:{
        handleOk(){
            var app = this;
            axios.put('/v1/admin/classroom/'+app.classroom.id, {
                name: app.classroom.name,
                is_overtime: app.classroom.is_overtime
            })
            .then((res)=>{
                app.$notify({
                    group: "notify",
                    title: "Thông báo",
                    type: res.data.status,
                    text: res.data.message,
                })
                app.$store.dispatch("fetch_classroom");
            });
        }
    }
}
</script>
