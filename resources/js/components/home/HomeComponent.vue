<template>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">CUSC Management</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">
                Tổng quan
            </div>

            <!-- Nav Item - Dashboard -->
            <router-link class="nav-item" tag="li" to="dashboard">
                <a class="nav-link">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Thống kê</span>
                </a>
            </router-link>

            <router-link class="nav-item" tag="li" to="assignments">
                <a class="nav-link">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Bảng phân công</span></a>
            </router-link>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Công cụ
            </div>

            <!-- Nav Item - Calendar -->
            <router-link class="nav-item" tag="li" to="calendar">
                <a class="nav-link">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Sắp xếp lịch</span></a>
            </router-link>
            <div v-if="user.roles">
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                <div class="sidebar-heading">
                    Công cụ cho nhà quản trị
                </div>

                    <router-link class="nav-item" tag="li" to="subjects">
                        <a class="nav-link">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Quản lí môn học</span></a>
                    </router-link>

                    <router-link class="nav-item" tag="li" to="courses">
                        <a class="nav-link">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Quản lí khóa học</span></a>
                    </router-link>

                    <router-link class="nav-item" tag="li" to="assign">
                        <a class="nav-link">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Quản lí phân công</span></a>
                    </router-link>

                    <router-link class="nav-item" tag="li" to="classroom">
                        <a class="nav-link">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Quản lí lớp</span></a>
                    </router-link>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{user.name}}
                                </span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Hồ sơ
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cài đặt
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thoát
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Can Tho University Software Centre 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            <!-- End of Content Wrapper -->
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal by Vue-Boostrap -->
        <b-modal refs="logout-modal" hide-footer title="Bạn có chắc chắn thoát ?">

        </b-modal>

        <!-- Logout Modal by Vue-Bootstrap -->
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn thoát?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Chọn "Thoát" để thoát khỏi phiên làm việc.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <button class="btn btn-primary" @click="logout">Thoát</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import $ from 'jquery';
    window.$ = window.jQuery = $;
    import 'jquery-easing';
    import 'bootstrap/js/src';
    export default {
        created(){
            this.$store.dispatch("fetch_events");
        },
        methods: {
            logout() {
                this.$auth.logout({
                    makeRequest: true,
                    params: {}, // data: {} in axios
                    success: function () {
                        $('#logoutModal').modal('hide');
                    },
                    error: function () {},
                    redirect: '/login',
                    // etc...
                });
            }
        },
        mounted: function () {
            (function ($) {
                "use strict"; // Start of use strict

                // Toggle the side navigation
                $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
                    $("body").toggleClass("sidebar-toggled");
                    $(".sidebar").toggleClass("toggled");
                    if ($(".sidebar").hasClass("toggled")) {
                        $('.sidebar .collapse').collapse('hide');
                    };
                });

                // Close any open menu accordions when window is resized below 768px
                $(window).resize(function () {
                    if ($(window).width() < 768) {
                        $('.sidebar .collapse').collapse('hide');
                    };
                });

                // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
                $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
                    if ($(window).width() > 768) {
                        var e0 = e.originalEvent,
                            delta = e0.wheelDelta || -e0.detail;
                        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                        e.preventDefault();
                    }
                });

                // Scroll to top button appear
                $(document).on('scroll', function () {
                    var scrollDistance = $(this).scrollTop();
                    if (scrollDistance > 100) {
                        $('.scroll-to-top').fadeIn();
                    } else {
                        $('.scroll-to-top').fadeOut();
                    }
                });

                // Smooth scrolling using jQuery easing
                $(document).on('click', 'a.scroll-to-top', function (e) {
                    $("html, body").animate({
                        scrollTop: 0
                    }, 600);
                    return false;
                });
            })(jQuery); // End of use strict
        },
        computed: {
            user(){
                return this.$store.getters.user;
            }
        }
    }
</script>
<style>
.fade-enter-active{
    transition: opacity .8s;
    }
.fade-enter/* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>
