<template>
<div>
    <FullCalendar :options='calendarOptions'>
        <!-- <template v-slot:eventContent='arg'>
                                        <b>{{ arg.event.date }}</b>
                                        <i>{{ arg.event.title }}</i>
                                    </template> -->
    </FullCalendar>

</div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'

// window.$ = window.jQuery = require('jquery')
export default {
    name: '',
    props: ['ruta', 'usuario'],
    data() {
        return {

            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Dia',
                    list: 'Lista'
                },
                initialView: 'dayGridMonth',
                weekends: true,
                selectable: true,
                events:[],
                //  [
                //     {
                //         title: 'event 1',
                //         date: '2023-08-06'
                //     },
                //     {
                //         title: 'event 2',
                //         date: '2023-08-05'
                //     },
                //     {
                //         title: 'All Day Event',
                //         start: '2023-08-09',
                //         backgroundColor: '#f56954', //red
                //         borderColor: '#f56954', //red
                //         allDay: true
                //     },
                //     {
                //         title: 'Meeting',
                //         start: '2023-08-09 10:30',
                //         allDay: false,
                //         backgroundColor: '#0073b7', //Blue
                //         borderColor: '#0073b7' //Blue
                //     },
                //     {
                //         title: 'Lunch',
                //         start: '2023-08-09 12:00',
                //         end: '2023-08-09 14:00',
                //         allDay: false,
                //         backgroundColor: '#00c0ef', //Info (aqua)
                //         borderColor: '#00c0ef' //Info (aqua)
                //     },
                //     {
                //         title: 'vacaciones',
                //         start: '2023-08-16',
                //         end: '2023-08-18',
                //         allDay: true,
                //         backgroundColor: '#f39c12', //yellow
                //         borderColor: '#f39c12' //yellow
                //     },
                // ]
            }

        }
    },
    components: {
        FullCalendar
    },
    created() {
        this.cargacalendaio();
    },
    computed: {

    },
    mounted() {

        //this.formData.idadmin = this.usuario.id

    },
    methods: {
        cargacalendaio()
        {
            var url='/listacitas';
            axios.get(url).then(res=>{
                this.calendarOptions.events=res.data;
            });
        }

    }
}
</script>

<style lang="css" scoped>
.hideUpload>div {
    display: none;
}
</style>
