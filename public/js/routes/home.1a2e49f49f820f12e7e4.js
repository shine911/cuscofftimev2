(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{SrqM:function(t,a,s){"use strict";s.r(a);var i=s("EVdn"),e=s.n(i);s("Hms0"),s("jczF");window.$=window.jQuery=e.a;var n={created:function(){this.$store.dispatch("fetch_events")},methods:{logout:function(){this.$auth.logout({makeRequest:!0,params:{},success:function(){e()("#logoutModal").modal("hide")},error:function(){},redirect:"/login"})}},mounted:function(){var t;(t=jQuery)("#sidebarToggle, #sidebarToggleTop").on("click",function(a){t("body").toggleClass("sidebar-toggled"),t(".sidebar").toggleClass("toggled"),t(".sidebar").hasClass("toggled")&&t(".sidebar .collapse").collapse("hide")}),t(window).resize(function(){t(window).width()<768&&t(".sidebar .collapse").collapse("hide")}),t("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel",function(a){if(t(window).width()>768){var s=a.originalEvent,i=s.wheelDelta||-s.detail;this.scrollTop+=30*(i<0?1:-1),a.preventDefault()}}),t(document).on("scroll",function(){t(this).scrollTop()>100?t(".scroll-to-top").fadeIn():t(".scroll-to-top").fadeOut()}),t(document).on("click","a.scroll-to-top",function(a){return t("html, body").animate({scrollTop:0},600),!1})},computed:{user:function(){return this.$store.getters.user}}},l=s("KHd+"),r=Object(l.a)(n,function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{attrs:{id:"wrapper"}},[s("ul",{staticClass:"navbar-nav bg-primary sidebar sidebar-dark accordion",attrs:{id:"accordionSidebar"}},[t._m(0),t._v(" "),s("hr",{staticClass:"sidebar-divider d-none d-md-block"}),t._v(" "),s("div",{staticClass:"sidebar-heading"},[t._v("\n            Tổng quan\n        ")]),t._v(" "),s("router-link",{staticClass:"nav-item",attrs:{tag:"li",to:"dashboard"}},[s("a",{staticClass:"nav-link"},[s("i",{staticClass:"fas fa-fw fa-tachometer-alt"}),t._v(" "),s("span",[t._v("Thống kê")])])]),t._v(" "),s("router-link",{staticClass:"nav-item",attrs:{tag:"li",to:"assignments"}},[s("a",{staticClass:"nav-link"},[s("i",{staticClass:"fas fa-fw fa-table"}),t._v(" "),s("span",[t._v("Bảng phân công")])])]),t._v(" "),s("hr",{staticClass:"sidebar-divider"}),t._v(" "),s("div",{staticClass:"sidebar-heading"},[t._v("\n            Công cụ\n        ")]),t._v(" "),s("router-link",{staticClass:"nav-item",attrs:{tag:"li",to:"calendar"}},[s("a",{staticClass:"nav-link"},[s("i",{staticClass:"fas fa-fw fa-calendar"}),t._v(" "),s("span",[t._v("Sắp xếp lịch")])])]),t._v(" "),t.user.roles?s("div",[s("hr",{staticClass:"sidebar-divider d-none d-md-block"}),t._v(" "),s("div",{staticClass:"sidebar-heading"},[t._v("\n                Công cụ cho nhà quản trị\n            ")]),t._v(" "),s("router-link",{staticClass:"nav-item",attrs:{tag:"li",to:"subjects"}},[s("a",{staticClass:"nav-link"},[s("i",{staticClass:"fas fa-fw fa-table"}),t._v(" "),s("span",[t._v("Quản lí môn học")])])]),t._v(" "),s("router-link",{staticClass:"nav-item",attrs:{tag:"li",to:"courses"}},[s("a",{staticClass:"nav-link"},[s("i",{staticClass:"fas fa-fw fa-table"}),t._v(" "),s("span",[t._v("Quản lí khóa học")])])]),t._v(" "),s("router-link",{staticClass:"nav-item",attrs:{tag:"li",to:"assign"}},[s("a",{staticClass:"nav-link"},[s("i",{staticClass:"fas fa-fw fa-users"}),t._v(" "),s("span",[t._v("Quản lí phân công")])])]),t._v(" "),s("router-link",{staticClass:"nav-item",attrs:{tag:"li",to:"classroom"}},[s("a",{staticClass:"nav-link"},[s("i",{staticClass:"fas fa-fw fa-users"}),t._v(" "),s("span",[t._v("Quản lí lớp")])])])],1):t._e(),t._v(" "),s("hr",{staticClass:"sidebar-divider d-none d-md-block"}),t._v(" "),t._m(1)],1),t._v(" "),s("div",{staticClass:"d-flex flex-column",attrs:{id:"content-wrapper"}},[s("div",{attrs:{id:"content"}},[s("nav",{staticClass:"navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"},[t._m(2),t._v(" "),s("ul",{staticClass:"navbar-nav ml-auto"},[s("div",{staticClass:"topbar-divider d-none d-sm-block"}),t._v(" "),s("li",{staticClass:"nav-item dropdown no-arrow"},[s("a",{staticClass:"nav-link dropdown-toggle",attrs:{href:"#",id:"userDropdown",role:"button","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}},[s("span",{staticClass:"mr-2 d-none d-lg-inline text-gray-600 small"},[t._v("\n                                "+t._s(t.user.name)+"\n                            ")])]),t._v(" "),t._m(3)])])]),t._v(" "),s("router-view")],1),t._v(" "),t._m(4)]),t._v(" "),t._m(5),t._v(" "),s("b-modal",{attrs:{refs:"logout-modal","hide-footer":"",title:"Bạn có chắc chắn thoát ?"}}),t._v(" "),s("div",{staticClass:"modal fade",attrs:{id:"logoutModal",tabindex:"-1",role:"dialog","aria-labelledby":"exampleModalLabel","aria-hidden":"true"}},[s("div",{staticClass:"modal-dialog",attrs:{role:"document"}},[s("div",{staticClass:"modal-content"},[t._m(6),t._v(" "),s("div",{staticClass:"modal-body"},[t._v('Chọn "Thoát" để thoát khỏi phiên làm việc.')]),t._v(" "),s("div",{staticClass:"modal-footer"},[s("button",{staticClass:"btn btn-secondary",attrs:{type:"button","data-dismiss":"modal"}},[t._v("Hủy")]),t._v(" "),s("button",{staticClass:"btn btn-primary",on:{click:t.logout}},[t._v("Thoát")])])])])])],1)},[function(){var t=this.$createElement,a=this._self._c||t;return a("a",{staticClass:"sidebar-brand d-flex align-items-center justify-content-center",attrs:{href:"#"}},[a("div",{staticClass:"sidebar-brand-icon rotate-n-15"},[a("i",{staticClass:"fas fa-laugh-wink"})]),this._v(" "),a("div",{staticClass:"sidebar-brand-text mx-3"},[this._v("CUSC Management")])])},function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"text-center d-none d-md-inline"},[a("button",{staticClass:"rounded-circle border-0",attrs:{id:"sidebarToggle"}})])},function(){var t=this.$createElement,a=this._self._c||t;return a("button",{staticClass:"btn btn-link d-md-none rounded-circle mr-3",attrs:{id:"sidebarToggleTop"}},[a("i",{staticClass:"fa fa-bars"})])},function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"dropdown-menu dropdown-menu-right shadow animated--grow-in",attrs:{"aria-labelledby":"userDropdown"}},[a("a",{staticClass:"dropdown-item",attrs:{href:"#"}},[a("i",{staticClass:"fas fa-user fa-sm fa-fw mr-2 text-gray-400"}),this._v("\n                                Hồ sơ\n                            ")]),this._v(" "),a("a",{staticClass:"dropdown-item",attrs:{href:"#"}},[a("i",{staticClass:"fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"}),this._v("\n                                Cài đặt\n                            ")]),this._v(" "),a("a",{staticClass:"dropdown-item",attrs:{href:"#","data-toggle":"modal","data-target":"#logoutModal"}},[a("i",{staticClass:"fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"}),this._v("\n                                Thoát\n                            ")])])},function(){var t=this.$createElement,a=this._self._c||t;return a("footer",{staticClass:"sticky-footer bg-white"},[a("div",{staticClass:"container my-auto"},[a("div",{staticClass:"copyright text-center my-auto"},[a("span",[this._v("Copyright © Can Tho University Software Centre 2019")])])])])},function(){var t=this.$createElement,a=this._self._c||t;return a("a",{staticClass:"scroll-to-top rounded",attrs:{href:"#page-top"}},[a("i",{staticClass:"fas fa-angle-up"})])},function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"modal-header"},[a("h5",{staticClass:"modal-title",attrs:{id:"exampleModalLabel"}},[this._v("Bạn có chắc chắn thoát?")]),this._v(" "),a("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[a("span",{attrs:{"aria-hidden":"true"}},[this._v("×")])])])}],!1,null,null,null);a.default=r.exports}}]);