<template>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng Nhập Hệ Thống</h1>
                                    </div>
                                    <form class="user" autocomplete="off" @submit.prevent="login" method="post">
                                        <div class="form-group">
                                            <input v-model="email" type="text" class="form-control form-control-user"
                                                id="email" aria-describedby="usernameHelp" placeholder="Nhập tài khoản">

                                        </div>
                                        <div class="form-group">
                                            <input v-model="password" type="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Mật Khẩu">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input v-model="checkRe" name="rememberMe" type="checkbox"
                                                    class="custom-control-input" id="customCheck">
                                                <label name="chbox" class="custom-control-label" for="customCheck">Ghi
                                                    nhớ phiên đăng nhập</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="btnSubmit" value="Đăng nhập"
                                            class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
</style>

<script>
    export default {
        beforeCreate: function () {
            document.body.className = 'bg-primary';
        },
        data() {
            return {
                email: null,
                password: null,
                checkRe: null,
                error: null
            }
        },

        methods: {
            login() {
                var app = this;
                this.$auth.login({
                    params: {
                        email: this.email,
                        password: this.password
                    },
                    rememberMe: this.checkRe,
                    success: function (res) {
                        localStorage.setItem("user", JSON.stringify(res.data.data));
                        app.$store.dispatch("fetchUser", res.data.data);
                        this.$notify({
                            group: 'notify',
                            title: '<h6>Đăng nhập thành công</h6>',
                            text: '<hr>Xin chào '+res.data.data.name,
                            type: 'success',
                            });
                    },
                    error: function (res) {
                        this.$notify({
                            group: 'notify',
                            title: '<h6>Đã xảy ra lỗi</h6>',
                            text: '<hr>Tài khoản hoặc mật khẩu không đúng',
                            type: 'error',
                            });
                    },
                    redirect: '/admin/dashboard'
                });
            }
        },
        computed:{
            user(){
                return this.$store.getters.user;
            }
        }
    }
</script>