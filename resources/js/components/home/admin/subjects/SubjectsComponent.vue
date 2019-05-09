<template>
    <b-container fluid>
        <h1 class="h3 mb-4 text-gray-800">Trình quản lí môn học</h1>
        <b-card header-bg-variant="primary" header-tag="header" header-class="py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 slot="header" class="m0 font-weight-bold text-light">Bảng môn học</h6>
            <b-button variant="primary" class="mb-3" @click="addClick">Thêm môn</b-button>
            <table-component @editClick="editClick" @removeClick="removeClick" :dataSource="subjects" :columnDef="fields"></table-component>
        </b-card>
        <add-component></add-component>
        <edit-component :data="selected_subject"></edit-component>
    </b-container>
</template>
<script>
    import AddComponent from './AddSubjectComponent';
    import EditComponent from './EditSubjectcomponent';
    import TableComponent from '../../table/TableComponent';
    export default {
        beforeCreate() {
            var user = this.$store.getters.user;
            if (!user.roles) {
                alert('You dont have permision');
                this.$router.go(-1);
            }
        },
        components:{ AddComponent, EditComponent, TableComponent},
        data(){
            return{
                fields:[
                    {key: 'name', label: 'Tên', sortable: true},
                    {key: 'amount', label: 'Số tiết', sortable: true},
                    {key: 'semester', label: 'Học kì', sortable: true},
                    {key: 'course.name', label: 'Tên khóa học', sortable: true},
                    {key: 'course.course_type.name', label: 'Tên loại hình', sortable: true},
                    {key: 'actions', label: 'Hành động' }
                ],
                currentPage: 1,
                perPage: 5,
                selected_subject: {},
            }
        },
        created()
        {
            this.$store.dispatch("fetch_subjects");
        },
        computed: {
            user() {
                return this.$store.getters.user;
            },
            subjects_table(){
                return this.$store.getters.subjects_table;
            },
            subjects(){
                return this.$store.getters.subjects;
            }
        },
        methods:{
            addClick(){
                this.$bvModal.show("add-subject");
            },
            editClick(event){
                this.selected_subject = event;
                this.$bvModal.show("edit-subject");
            },
            removeClick(event){
                if(confirm("Bạn có chắc chắn xóa ?")){
                    var app = this;
                    axios.delete('/v1/admin/subjects/'+event.id)
                    .then((res)=>{
                        app.$notify({
                            group: 'notify',
                            title: '<h6>Thông báo</h6>',
                            text: res.data.message,
                            type: res.data.status,
                        });
                    })
                    .then((res)=>{
                        app.$store.dispatch("fetch_subjects");
                    });
                }
            }
        }
    }
</script>