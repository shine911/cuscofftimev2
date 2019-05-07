<template>
    <b-container fluid>
        <h1 class="h3 mb-4 text-gray-800">Thông tin bảng phân công</h1>
        <b-form inline class="mb-3">
            <label class="sr-only" for="inline-form-input-month">Month</label>
            <b-input v-model="month" id="inline-form-input-month" class="mb-2 mr-sm-2 mb-sm-0" type="month"></b-input>
            <b-button variant="primary" title="Xác nhận" @click="onSubmit()"><i class="fas fa-check fa-sm fa-fw"></i></b-button>
            <b-button variant="info" title="Xuất file" @click="onExport()" class="ml-2"><i class="fas fa-file-excel fa-sm fa-fw"></i>
            </b-button>
        </b-form>
        <b-card header-bg-variant="primary" header-tag="header" header-class="py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 slot="header" class="m0 font-weight-bold text-light">Bảng phân công</h6>
            <ejs-grid :allowSorting='true' :dataSource="data" :allowPaging="true" :pageSettings="pageSettings">
                <e-columns>
                    <e-column field="user_name" headerText='Tên CB' width=90></e-column>
                    <e-column field="subject_name" headerText='Tên Môn' width=120></e-column>
                    <e-column field="date_from" headerText='Ngày bắt đầu' width=90></e-column>
                    <e-column field="date_to" headerText='Ngày kết thúc' width=90></e-column>
                    <e-column field="month" headerText='Tháng' width=90></e-column>
                    <e-column field="amount" headerText='Số tiết' width=90></e-column>
                </e-columns>
            </ejs-grid>
        </b-card>
    </b-container>
</template>
<script>
    import Vue from 'vue';
    import { GridPlugin, Page, Sort } from "@syncfusion/ej2-vue-grids";
    Vue.use(GridPlugin);
    export default {
        created(){
            this.month = new Date().toISOString().slice(0,7)
            var app = this;
            axios.get("/v1/assignments",{
                params: {
                    "month": app.month,
                }
            })
            .then(function(res){
                //Parse dữ liệu sang dạng bảng lấy các thông tin cần thiết từ api
                var custom = [];
                res.data.forEach(assignment=>{
                    custom.unshift(
                        {
                            "user_name": assignment.user.name,
                            "subject_name": assignment.subject.name,
                            "date_from": assignment.time_start,
                            "date_to": assignment.time_end,
                            "month": assignment.month,
                            "amount": assignment.subject.amount
                        }
                    );
                });
                app.data = [...custom];
            });
        },
        components: {
        },
        data() {
            return {
                data: [],
                pageSettings: { pageSize: 5 },
                month: "2019-04"
            }
        },
        methods: {
            onSubmit() {
                var app = this;
                axios.get("/v1/assignments",{
                    params: {
                        "month": app.month
                    }
                })
                .then(function(res){
                    //Parse dữ liệu sang dạng bảng lấy các thông tin cần thiết từ api
                    var custom = [];
                    res.data.forEach(assignment=>{
                        custom.unshift(
                            {
                                "user_name": assignment.user.name,
                                "subject_name": assignment.subject.name,
                                "date_from": assignment.time_start,
                                "date_to": assignment.time_end,
                                "month": assignment.month,
                                "amount": assignment.subject.amount
                            }
                        );
                    });
                    app.data = [...custom];
                });
            },
            onExport: function() {
                var app = this;
                axios.get("/v1/assignments/export",{
                    params: {
                        "month": app.month
                    }})
                .then(function(res){
                    document.location.href = (res.data.file);
                });
            }
        },
        provide: {
            grid: [Page, Sort]
        }
    }
</script>