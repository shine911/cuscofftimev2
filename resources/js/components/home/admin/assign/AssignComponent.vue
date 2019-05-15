<template>
    <b-container fluid>
        <h1 class="h3 mb-4 text-gray-800">Phân công</h1>
        <b-card header-bg-variant="primary" header-tag="header" header-class="py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 slot="header" class="m0 font-weight-bold text-light">Phân công</h6>
            <b-button variant="primary" class="mb-3" @click="addClick">Thêm phân công</b-button>
            <table-component @editClick="editClick" @removeClick="removeClick" :dataSource="assignments" :columnDef="fields"></table-component>
        </b-card>
        <add-component></add-component>
        <edit-component></edit-component>
    </b-container>
</template>
<script>
import TableComponent from '../../table/TableComponent.vue';
import AddComponent from'./AddComponent';
import EditComponent from './EditComponent';
export default {
    beforeCreate(){
        var user = this.$store.getters.user;
        if(user.roles == 0){
            alert('You dont have permision');
            this.$router.go(-1);
        }
    },
    created(){
        this.$store.dispatch("fetch_assignments");
    },
    components: {
        TableComponent, AddComponent, EditComponent
    },
    data(){
        return{
            fields: [
                {key: 'user.name', label: 'Tên CB', sortable: true},
                {key: 'subject.name', label: 'Môn Học', sortable: true},
                {key: 'class.name', label: 'Lớp', sortable: true},
                {key: 'time_start', label: 'Bắt đầu'},
                {key: 'time_end', label:'Kết thúc'},
                {key: 'actions', label: 'Hành động'}
            ],
        }
    },
    methods: {
        addClick(){
            this.$bvModal.show("add");
        },
        editClick(event){
            this.$store.dispatch("selected_assignment_setter", event);
            this.$bvModal.show("edit");
        },
        removeClick(event){
            if(confirm("Bạn có chắc chắn xóa ?")){
                var app = this;
                axios.delete('/v1/admin/assign/'+event.id)
                .then((res)=>{
                    app.$notify({
                        group: 'notify',
                        title: '<h6>Thông báo</h6>',
                        text: res.data.message,
                        type: res.data.status,
                    });
                })
                .then((res)=>{
                    app.$store.dispatch("fetch_assignments");
                });
            }
        }
    },
    computed:{
        user(){
            return this.$store.getters.user;
        },
        assignments(){
            return this.$store.getters.assignments;
        }
    }
}
</script>
