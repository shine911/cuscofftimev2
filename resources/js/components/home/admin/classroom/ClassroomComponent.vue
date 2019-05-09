<template>
    <b-container fluid>
        <h1 class="h3 mb-4 text-gray-800">Trình quản lí lớp học</h1>
        <b-card header-bg-variant="primary" header-tag="header" header-class="py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 slot="header" class="m0 font-weight-bold text-light">Bảng lớp học</h6>
            <b-button variant="primary" class="mb-3" @click="addClick">Thêm lớp</b-button>
            <table-component @editClick="editClick" @removeClick="removeClick" :dataSource="classroom" :columnDef="fields"></table-component>
        </b-card>
        <add-component></add-component>
        <edit-component :classroom="selected"></edit-component>
    </b-container>
</template>
<script>
import TableComponent from '../../table/TableComponent';
import AddComponent from './AddComponent';
import EditComponent from './EditComponent';
export default {
    created(){
        this.$store.dispatch("fetch_classroom");
    },
    components: {TableComponent, AddComponent, EditComponent},
    methods:{
        addClick(){
            this.$bvModal.show('add');
        },
        editClick(event){
            this.selected = event;
            this.$bvModal.show('edit');
        },
        removeClick(event){
            if(confirm("Bạn có chắc chắn xóa ?")){
                var app = this;
                axios.delete('/v1/admin/classroom/'+event.id)
                .then((res)=>{
                    app.$notify({
                        group: 'notify',
                        title: '<h6>Thông báo</h6>',
                        text: res.data.message,
                        type: res.data.status,
                    });
                })
                .then((res)=>{
                    app.$store.dispatch("fetch_classroom");
                });
            }
        }
    },
    data(){
        return{
            fields:[
                {"key": "name", "label": "Tên lớp"},
                {"key": "is_overtime", "label": "Ngoài giờ"},
                {"key": "actions", "label": "Hành động"}
            ],
            selected: {},
        }
    },
    computed:{
        classroom(){
            return this.$store.getters.classroom;
        }
    }
}
</script>
