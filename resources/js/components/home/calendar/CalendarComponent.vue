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
        <edit-modal-component :event="selected_event"></edit-modal-component>
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
import EditModalComponent from './EditModalComponent.vue';

export default {
    components:{
        FullCalendar,
        AddModalComponent,
        EditModalComponent
    },
    data(){
        return {
            calendarPlugins: [dayGridPlugin, timeGridPlugin, listPlugin, interaction, BoostrapPlugin],
            calendarHeader: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            selected_event:{}
        };
    },
    methods: {
        eventClickHandle(e) {
                var info = e.event;
                var prop = info.extendedProps.properties;
                var dStart = new Date(info.start);
                var dEnd = new Date(info.end);
                //Dinh dang hien thi vd: 13:00 - 14:00
                dStart = dStart.toLocaleTimeString('en-GB').slice(0, 5);
                dEnd = dEnd.toLocaleTimeString('en-GB').slice(0, 5);
                this.$store.dispatch("fetchMyAssignments", info.start.toISOString().slice(0,7));
                var event = {
                    "date": info.start.toISOString().slice(0,10),
                    "class_id": prop["classroom"].id,
                    "time_start": {
                        "HH": dStart.slice(0,2),
                        "mm": dStart.slice(3,5)
                    },
                    "time_end": {
                        "HH": dEnd.slice(0,2),
                        "mm": dEnd.slice(3,5)
                    },
                    "reason": prop["reason"],
                    "amount": prop["amount"],
                    "id" : prop["id"],
                };
                this.selected_event = event;
                this.$bvModal.show("edit-calendar");
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
