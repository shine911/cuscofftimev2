(window.webpackJsonp=window.webpackJsonp||[]).push([[3],{BSOc:function(t,s,e){"use strict";e.r(s);var a=e("UfsI"),n=e("1F/t"),r={components:{VueBootstrapTypeahead:n.a},data:function(){return{assignment:{},users:[],user_query:"",subjects:[],subject_query:"",classroom:[],classroom_query:""}},methods:{handleOk:function(){var t=this.assignment,s=this,e={user_id:t.user.id,sub_id:t.subject.id,time_start:t.time_start,time_end:t.time_end,class_id:t.class.id};axios.post("/v1/admin/assign",e).then(function(t){s.$notify({group:"notify",type:t.data.status,text:t.data.message,title:"Thông báo"}),s.$store.dispatch("fetch_assignments")})}},watch:{user_query:function(t){var s=this;axios.get("/v1/admin/users/?q=".concat(t)).then(function(t){s.users=t.data})},subject_query:function(t){var s=this;axios.get("/v1/admin/subjects/?q=".concat(t)).then(function(t){s.subjects=t.data})},classroom_query:function(t){var s=this;axios.get("/v1/admin/classroom/?q=".concat(t)).then(function(t){s.classroom=t.data})}}},o=e("KHd+"),c=Object(o.a)(r,function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("b-modal",{ref:"add",attrs:{size:"lg",id:"add",title:"Phân công mới","header-bg-variant":"primary","header-text-variant":"light","ok-title":"Lưu thông tin","ok-variant":"outline-primary","cancel-title":"Hủy","cancel-variant":"outline-secondary"},on:{ok:function(s){return t.handleOk()}}},[e("b-form-row",[e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Tên cán bộ:","label-for":"date",description:"Hãy gõ tên cán bộ"}},[e("vue-bootstrap-typeahead",{attrs:{serializer:function(t){return t.name},data:t.users},on:{hit:function(s){t.assignment.user=s}},model:{value:t.user_query,callback:function(s){t.user_query=s},expression:"user_query"}})],1)],1),t._v(" "),e("b-col",{attrs:{md:"6"}},[t.assignment.user?e("b-card",{staticClass:"m-3"},[e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("ID:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.user.id))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Tên:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.user.name))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Email:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.user.email))])],1)],1):t._e()],1),t._v(" "),e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Môn học:","label-for":"date",description:"Điền tên môn học"}},[e("vue-bootstrap-typeahead",{attrs:{serializer:function(t){return t.name},data:t.subjects},on:{hit:function(s){t.assignment.subject=s}},model:{value:t.subject_query,callback:function(s){t.subject_query=s},expression:"subject_query"}})],1)],1),t._v(" "),e("b-col",{attrs:{md:"6"}},[t.assignment.subject?e("b-card",{staticClass:"m-3"},[e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("ID:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.id))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Tên:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.name))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Số tiết:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.amount))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Học kì:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.semester))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Khóa:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.course.name))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Loại hình:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.course.course_type.name))])],1)],1):t._e()],1),t._v(" "),e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Lớp:","label-for":"date",description:"Hãy gõ tên lớp"}},[e("vue-bootstrap-typeahead",{attrs:{serializer:function(t){return t.name},data:t.classroom},on:{hit:function(s){t.assignment.class=s}},model:{value:t.classroom_query,callback:function(s){t.classroom_query=s},expression:"classroom_query"}})],1)],1),t._v(" "),e("b-col",{attrs:{md:"6"}},[t.assignment.class?e("b-card",{staticClass:"m-3"},[e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("ID:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.class.id))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Tên:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.class.name))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Loại hình:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.class.is_overtime?"Ngoài giờ":"Trong giờ"))])],1)],1):t._e()],1),t._v(" "),e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Bắt đầu:","label-for":"date",description:"Ngày bắt đầu"}},[e("b-form-input",{attrs:{type:"date"},model:{value:t.assignment.time_start,callback:function(s){t.$set(t.assignment,"time_start",s)},expression:"assignment.time_start"}})],1)],1),t._v(" "),e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Kết thúc:","label-for":"date",description:"Ngày kết thúc"}},[e("b-form-input",{attrs:{type:"date"},model:{value:t.assignment.time_end,callback:function(s){t.$set(t.assignment,"time_end",s)},expression:"assignment.time_end"}})],1)],1)],1)],1)},[],!1,null,null,null).exports,i={components:{VueBootstrapTypeahead:n.a},data:function(){return{users:[],user_query:"",subjects:[],subject_query:"",classroom:[],classroom_query:""}},methods:{handleOk:function(){var t=this.assignment,s=this,e={user_id:t.user.id,sub_id:t.subject.id,time_start:t.time_start,time_end:t.time_end,class_id:t.class.id};axios.put("/v1/admin/assign/"+t.id,e).then(function(t){s.$notify({group:"notify",type:t.data.status,text:t.data.message,title:"Thông báo"}),s.$store.dispatch("fetch_assignments")})}},computed:{assignment:function(){return this.$store.getters.selected_assignment}},watch:{user_query:function(t){var s=this;axios.get("/v1/admin/users/?q=".concat(t)).then(function(t){s.users=t.data})},subject_query:function(t){var s=this;axios.get("/v1/admin/subjects/?q=".concat(t)).then(function(t){s.subjects=t.data})},classroom_query:function(t){var s=this;axios.get("/v1/admin/classroom/?q=".concat(t)).then(function(t){s.classroom=t.data})}}},l=Object(o.a)(i,function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("b-modal",{ref:"edit",attrs:{size:"lg",id:"edit",title:"Phân công mới","header-bg-variant":"primary","header-text-variant":"light","ok-title":"Lưu thông tin","ok-variant":"outline-primary","cancel-title":"Hủy","cancel-variant":"outline-secondary"},on:{ok:function(s){return t.handleOk()}}},[e("b-form-row",[e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Tên cán bộ:","label-for":"date",description:"Hãy gõ tên cán bộ"}},[e("vue-bootstrap-typeahead",{attrs:{placeholder:"(Không thay đổi)",serializer:function(t){return t.name},data:t.users},on:{hit:function(s){t.assignment.user=s}},model:{value:t.user_query,callback:function(s){t.user_query=s},expression:"user_query"}})],1)],1),t._v(" "),e("b-col",{attrs:{md:"6"}},[t.assignment.user?e("b-card",{staticClass:"m-3"},[e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("ID:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.user.id))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Tên:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.user.name))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Email:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.user.email))])],1)],1):t._e()],1),t._v(" "),e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Môn học:","label-for":"date",description:"Điền tên môn học"}},[e("vue-bootstrap-typeahead",{attrs:{placeholder:"(Không thay đổi)",serializer:function(t){return t.name},data:t.subjects},on:{hit:function(s){t.assignment.subject=s}},model:{value:t.subject_query,callback:function(s){t.subject_query=s},expression:"subject_query"}})],1)],1),t._v(" "),e("b-col",{attrs:{md:"6"}},[t.assignment.subject?e("b-card",{staticClass:"m-3"},[e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("ID:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.id))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Tên:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.name))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Số tiết:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.amount))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Học kì:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.semester))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Khóa:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.course.name))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Loại hình:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.subject.course.course_type.name))])],1)],1):t._e()],1),t._v(" "),e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Lớp:","label-for":"date",description:"Hãy gõ tên lớp"}},[e("vue-bootstrap-typeahead",{attrs:{placeholder:"(Không thay đổi)",serializer:function(t){return t.name},data:t.classroom},on:{hit:function(s){t.assignment.class=s}},model:{value:t.classroom_query,callback:function(s){t.classroom_query=s},expression:"classroom_query"}})],1)],1),t._v(" "),e("b-col",{attrs:{md:"6"}},[t.assignment.class?e("b-card",{staticClass:"m-3"},[e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("ID:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.class.id))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Tên:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.class.name))])],1),t._v(" "),e("b-row",[e("b-col",{attrs:{cols:"4"}},[t._v("Loại hình:")]),t._v(" "),e("b-col",{attrs:{cols:"8"}},[t._v(t._s(t.assignment.class.is_overtime?"Trong giờ":"Ngoài giờ"))])],1)],1):t._e()],1),t._v(" "),e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Bắt đầu:","label-for":"date",description:"Ngày bắt đầu"}},[e("b-form-input",{attrs:{type:"date"},model:{value:t.assignment.time_start,callback:function(s){t.$set(t.assignment,"time_start",s)},expression:"assignment.time_start"}})],1)],1),t._v(" "),e("b-col",{attrs:{cols:"12",md:"6"}},[e("b-form-group",{attrs:{id:"input-group-2",label:"Kết thúc:","label-for":"date",description:"Ngày kết thúc"}},[e("b-form-input",{attrs:{type:"date"},model:{value:t.assignment.time_end,callback:function(s){t.$set(t.assignment,"time_end",s)},expression:"assignment.time_end"}})],1)],1)],1)],1)},[],!1,null,null,null).exports,u={beforeCreate:function(){0==this.$store.getters.user.roles&&(alert("You dont have permision"),this.$router.go(-1))},created:function(){this.$store.dispatch("fetch_assignments")},components:{TableComponent:a.a,AddComponent:c,EditComponent:l},data:function(){return{fields:[{key:"user.name",label:"Tên CB",sortable:!0},{key:"subject.name",label:"Môn Học",sortable:!0},{key:"class.name",label:"Lớp",sortable:!0},{key:"time_start",label:"Bắt đầu"},{key:"time_end",label:"Kết thúc"},{key:"actions",label:"Hành động"}]}},methods:{addClick:function(){this.$bvModal.show("add")},editClick:function(t){this.$store.dispatch("selected_assignment_setter",t),this.$bvModal.show("edit")},removeClick:function(t){if(confirm("Bạn có chắc chắn xóa ?")){var s=this;axios.delete("/v1/admin/assign/"+t.id).then(function(t){s.$notify({group:"notify",title:"<h6>Thông báo</h6>",text:t.data.message,type:t.data.status})}).then(function(t){s.$store.dispatch("fetch_assignments")})}}},computed:{user:function(){return this.$store.getters.user},assignments:function(){return this.$store.getters.assignments}}},m=Object(o.a)(u,function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("b-container",{attrs:{fluid:""}},[e("h1",{staticClass:"h3 mb-4 text-gray-800"},[t._v("Phân công")]),t._v(" "),e("b-card",{attrs:{"header-bg-variant":"primary","header-tag":"header","header-class":"py-3 d-flex flex-row align-items-center justify-content-between"}},[e("h6",{staticClass:"m0 font-weight-bold text-light",attrs:{slot:"header"},slot:"header"},[t._v("Phân công")]),t._v(" "),e("b-button",{staticClass:"mb-3",attrs:{variant:"primary"},on:{click:t.addClick}},[t._v("Thêm phân công")]),t._v(" "),e("table-component",{attrs:{dataSource:t.assignments,columnDef:t.fields},on:{editClick:t.editClick,removeClick:t.removeClick}})],1),t._v(" "),e("add-component"),t._v(" "),e("edit-component")],1)},[],!1,null,null,null);s.default=m.exports},UfsI:function(t,s,e){"use strict";var a={props:{dataSource:{type:Array,default:function(){return[]}},columnDef:{type:Array,default:function(){return[]}}},data:function(){return{currentPage:1,perPage:5}},methods:{editClick:function(t){this.$emit("editClick",t)},removeClick:function(t){this.$emit("removeClick",t)}}},n=e("KHd+"),r=Object(n.a)(a,function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",[e("b-table",{attrs:{striped:"",bordered:"",outlined:"",hover:"","current-page":t.currentPage,"per-page":t.perPage,items:t.dataSource,fields:t.columnDef},scopedSlots:t._u([{key:"actions",fn:function(s){return[e("b-button",{staticClass:"mr-1",attrs:{variant:"outline-primary",size:"sm"},on:{click:function(e){return t.editClick(s.item)}}},[e("i",{staticClass:"fas fa-edit"})]),t._v(" "),e("b-button",{attrs:{variant:"outline-secondary",size:"sm"},on:{click:function(e){return t.removeClick(s.item)}}},[e("i",{staticClass:"fas fa-trash"})])]}},{key:"is_overtime",fn:function(s){return[s.value?e("i",{staticClass:"text-primary fas fa-check"}):t._e()]}}])}),t._v(" "),e("b-row",[e("b-col",{staticClass:"my-1",attrs:{md:"6"}},[e("b-pagination",{staticClass:"my-0",attrs:{"total-rows":t.dataSource.length,"per-page":t.perPage},model:{value:t.currentPage,callback:function(s){t.currentPage=s},expression:"currentPage"}})],1)],1)],1)},[],!1,null,null,null);s.a=r.exports}}]);