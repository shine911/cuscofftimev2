<template>
    <b-container fluid>
        <h1 class="h3 mb-4 text-gray-800">Sắp xếp lịch nghỉ bù của {{user.name}}</h1>
        <b-card header-bg-variant="primary" header-tag="header" header-class="py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 slot="header" class="m0 font-weight-bold text-light">Lịch nghỉ bù</h6>
            <FullCalendar :plugins="calendarPlugins" :header="calendarHeader" :events="my_events"
                        :navLink=true :eventLimit=true locale="vi" @eventClick="eventClickHandle"
                        @dateClick="dateClickHandle"
                        themeSystem="bootstrap"></FullCalendar>
        </b-card>
        <add-modal-component></add-modal-component>
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
import AddModalComponent from './AddModalComponent.vue';

export default {
    components:{
        FullCalendar,
        AddModalComponent
    },
    data(){
        return {
            calendarPlugins: [dayGridPlugin, timeGridPlugin, listPlugin, interaction, BoostrapPlugin],
            calendarHeader: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
        };
    },
    methods: {
        eventClickHandle(e) {
                // var event = e.event;
                // var prop = event.extendedProps.properties;
                // var dStart = new Date(event.start);
                // var dEnd = new Date(event.end);
                // //Dinh dang hien thi vd: 13:00 - 14:00
                // var time = dStart.toLocaleTimeString('en-GB').slice(0, 5) +
                //     "-" + dEnd.toLocaleTimeString(
                //         'en-GB').slice(0, 5);
                // this.eventSeleted.name = event.title;
                // this.eventSeleted.classroom = prop["classroom"];
                // this.eventSeleted.reason = prop["reason"];
                // this.eventSeleted.amount = time;
                // this.eventSeleted.date = dStart.toLocaleDateString('vi-VN');
                this.$bvModal.show("add-calendar");
        },
        dateClickHandle(e){
            this.$store.dispatch("set_selected_date", e.dateStr);
            this.$store.dispatch("fetchMyAssignments", e.dateStr.slice(0,7));
            this.$bvModal.show("add-calendar");
        }
    },
    computed:{
        user(){
            return this.$store.getters.user;
        },
        selected_date(){
            return this.$store.getters.selected_date;
        },
        my_events(){
            return this.$store.getters.my_events;
        }
    }
}
</script>
