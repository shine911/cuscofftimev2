<template>
    <b-modal size="md" id="add" ref="add" title="Thêm lớp mới" header-bg-variant="primary"
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
    data(){
        return{
            classroom:{
                is_overtime: 1,
            },
            options_type:[
                {"value": 0, "text": "Trong giờ"},
                {"value": 1, "text": "Ngoài giờ"},
            ]
        }
    },
    methods:{
        handleOk(){
            var app = this;
            axios.post('/v1/admin/classroom', {
                name: this.classroom.name,
                is_overtime: this.classroom.is_overtime
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
