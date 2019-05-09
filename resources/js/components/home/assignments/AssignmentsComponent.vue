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
            <table-component :dataSource="data" :columnDef="fields"></table-component>
        </b-card>
    </b-container>
</template>
<script>
import TableComponent from '../table/TableComponent';
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
                app.data = res.data;
            });
        },
        components: { TableComponent },
        data() {
            return {
                data: [],
                month: "2019-04",
                fields: [
                {key: 'user.name', label: 'Tên CB', sortable: true},
                {key: 'subject.name', label: 'Môn Học', sortable: true},
                {key: 'class.name', label: 'Lớp', sortable: true},
                {key: 'time_start', label: 'Bắt đầu'},
                {key: 'time_end', label:'Kết thúc'},
                {key: 'month', label: 'Tháng'}
                ],
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
                    app.data = res.data;
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
        }
    }
</script>