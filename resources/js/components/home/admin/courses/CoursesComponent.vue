<template>
    <b-container fluid>
        <h1 class="h3 mb-4 text-gray-800">Trình quản lí khóa học</h1>
        <b-card header-bg-variant="primary" header-tag="header" header-class="py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 slot="header" class="m0 font-weight-bold text-light">Bảng khóa học</h6>
            <b-button variant="primary" class="mb-3" @click="addClick">Thêm khóa học</b-button>
            <table-component @editClick="editClick" @removeClick="removeClick" :dataSource="courses" :columnDef="fields"></table-component>
        </b-card>
        <add-component></add-component>
        <edit-component :course="selected_course"></edit-component>
    </b-container>
</template>
<script>
    import AddComponent from './AddCourseComponent';
    import EditComponent from './EditCourseComponent';
    import TableComponent from '../../table/TableComponent';
    export default {
        beforeCreate() {
            var user = this.$store.getters.user;
            if (!user.roles) {
                alert('You dont have permision');
                this.$router.go(-1);
            }
        },
        components:{TableComponent, AddComponent, EditComponent},
        data(){
            return{
                fields:[
                    {key: 'name', label: 'Tên', sortable: true},
                    {key: 'course_type.name', label: 'Loại hình', sortable: true},
                    {key: 'actions', label: 'Hành động' }
                ],
                currentPage: 1,
                perPage: 5,
                selected_course: {},
            }
        },
        created()
        {
            this.$store.dispatch("fetch_courses");
            console.log(this.courses)
        },
        computed: {
            user() {
                return this.$store.getters.user;
            },
            courses(){
                return this.$store.getters.courses;
            }
        },
        methods:{
            addClick(){
                this.$bvModal.show("add-course");
            },
            editClick(event){
                this.selected_course = event;
                this.$bvModal.show("edit-course");
            },
            removeClick(event){
                if(confirm("Bạn có chắc chắn xóa ?")){
                    var app = this;
                    axios.delete('/v1/admin/courses/'+event.id)
                    .then((res)=>{
                        app.$notify({
                            group: 'notify',
                            title: '<h6>Thông báo</h6>',
                            text: res.data.message,
                            type: res.data.status,
                        });
                    })
                    .then((res)=>{
                        app.$store.dispatch("fetch_courses");
                    });
                }
            }
        }
    }
</script>