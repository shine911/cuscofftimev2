<template>
    <b-container fluid>
        <b-row>
            <b-col class="d-none d-md-block" xd="12">
                <b-card class="shadow mb-4" header-bg-variant="primary" header-tag="header"
                    header-class="py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 slot="header" class="m0 font-weight-bold text-light">Lịch Nghỉ Bù</h6>
                    <b-form v-if="user.roles" @submit="exportCalendar" inline class="m-3">
                        <b-form-input v-model="inputMonth" id="amount" type="month" class="mr-2"></b-form-input>
                        <b-button type="submit" variant="primary" v-b-tooltip.hover title="Xuất thống kê"><i class="fas fa-file-excel"></i></b-button>
                    </b-form>
                    <FullCalendar :plugins="calendarPlugins" :header="calendarHeader" :events="events"
                        :navLinks=true :eventLimit=true locale="vi" @eventClick="eventClickHandle"
                        themeSystem="bootstrap"></FullCalendar>
                </b-card>
            </b-col>
            <b-col class="d-none d-sm-block d-md-none" cols="12">
                <b-card class="shadow mb-4" header-bg-variant="primary" header-tag="header"
                    header-class="py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 slot="header" class="m0 font-weight-bold text-light">Lịch Nghỉ Bù</h6>
                    <span>Full Calendar not support mobile view</span>
                </b-card>
            </b-col>
        </b-row>
        <b-row>
            <b-col cols="12">
                <b-card class="shadow mb-4" header-bg-variant="primary" header-tag="header"
                    header-class="py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 slot="header" class="m0 font-weight-bold text-light">Số giờ học từng người trong tháng</h6>
                    <single-chart-component></single-chart-component>
                </b-card>
            </b-col>
        </b-row>
        <b-row>
            <b-col cols="12" sm="6">
                <b-card class="shadow mb-4" header-bg-variant="primary" header-tag="header"
                    header-class="py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 slot="header" class="m0 font-weight-bold text-light">Số giờ học mọi người trong tháng</h6>
                    <bar-chart-component></bar-chart-component>
                </b-card>
            </b-col>
            <b-col cols="12" sm="6">
                <b-card class="shadow mb-4" header-bg-variant="primary" header-tag="header"
                    header-class="py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 slot="header" class="m0 font-weight-bold text-light">Thống kê</h6>
                    <b-list-group>
                        <b-list-group-item>Tổng cán bộ: {{summary.user}}</label></b-list-group-item>
                        <b-list-group-item>Tổng phân công: {{summary.assignments}}</b-list-group-item>
                        <b-list-group-item>Tổng ngày nghỉ: {{summary.offdays}}</b-list-group-item>
                        <b-list-group-item>Tổng loại hình: {{summary.course_type}}</b-list-group-item>
                        <b-list-group-item>Tổng chương trình: {{summary.courses}}</b-list-group-item>
                        <b-list-group-item>Tổng môn học: {{summary.subjects}}</b-list-group-item>
                        <b-list-group-item>Tổng lớp học: {{summary.classroom}}</b-list-group-item>
                    </b-list-group>
                </b-card>
            </b-col>
        </b-row>
        <dateview-component :data="eventSeleted"></dateview-component>
    </b-container>
</template>
<script>
    import FullCalendar from '@fullcalendar/vue';
    import viLocale from '@fullcalendar/core/locales/vi';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import listPlugin from '@fullcalendar/list';
    import interaction from '@fullcalendar/interaction';
    import BoostrapPlugin from '@fullcalendar/bootstrap';
    import BarChartComponent from './BarChartComponent.vue';
    import SingleChartComponent from './SingleBarChartComponent.vue';
    import DateviewComponent from './DateviewModalComponent.vue';

    export default {
        created() {
            this.getSummaryInfo();
        },
        components: {
            FullCalendar,
            BarChartComponent,
            SingleChartComponent,
            DateviewComponent
        },
        data() {
            return {
                calendarPlugins: [dayGridPlugin, timeGridPlugin, listPlugin, interaction, BoostrapPlugin],
                calendarHeader: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                calendarEvent: [],
                summary: {
                    "user": 0,
                    "assignments": 0,
                    "offdays": 0,
                    "course_type": 0,
                    "courses": 0,
                    "subjects": 0,
                    "classroom": 0
                },
                eventSeleted: {
                    "name": "Lorem isum",
                    "classroom": "Lorem isum",
                    "amount": "Lorem isum",
                    "date": "Lorem isum",
                },
                inputMonth: new Date().toISOString().slice(0,7),
            }
        },
        methods: {
            getSummaryInfo() {
                var app = this;
                axios.get('/v1/dashboard/summary')
                    .then(function (res) {
                        app.summary = res.data;
                    });
            },
            eventClickHandle(e) {
                var event = e.event;
                var prop = event.extendedProps.properties;
                var dStart = new Date(event.start);
                var dEnd = new Date(event.end);
                //Dinh dang hien thi vd: 13:00 - 14:00
                var time = dStart.toLocaleTimeString('en-GB').slice(0, 5) +
                    "-" + dEnd.toLocaleTimeString(
                        'en-GB').slice(0, 5);
                this.eventSeleted.name = event.title;
                this.eventSeleted.classroom = prop["classroom"].name;
                this.eventSeleted.reason = prop["reason"];
                this.eventSeleted.amount = time;
                this.eventSeleted.date = dStart.toLocaleDateString('vi-VN');
                this.$bvModal.show("popup-calendar");
            },
            exportCalendar(){
                var app = this;
                axios.get("/v1/calendar/export",{
                    params: {
                        "month": app.inputMonth
                    }})
                .then(function(res){
                    document.location.href = (res.data.file);
                });
            }
        },
        computed: {
            events(){
                return this.$store.getters.events;
            },
            user(){
                return this.$store.getters.user;
            }
        }
    }
</script>

<style>
    @import '~@fullcalendar/core/main.css';
    @import '~@fullcalendar/bootstrap/main.css';
    @import '~@fullcalendar/daygrid/main.css';
    @import '~@fullcalendar/timegrid/main.css';
    @import '~@fullcalendar/list/main.css';
</style>