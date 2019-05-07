export default {
    fetchUser(state, data) {
        state.user = data;
    },

    selected_date(state, date) {
        state.selected_date = date;
    },

    fetch_my_assignments(state, assignments) {
        state.my_assignments = assignments;
    },
    fetch_my_classroom(state) {
        let new_class_options = [{
            "value": null,
            "text": "Chọn lớp"
        }];
        state.my_assignments.forEach(assign => {
            new_class_options.unshift({
                "value": assign.class.id,
                "text": assign.class.name
            });
        });
        state.class_options = new_class_options;
    },
    fetch_events(state) {
        axios.get('/v1/calendar')
            .then(function (res) {
                // handle success
                state.events = res.data;
            });
    },

    fetch_my_events(state){
        axios.get('/v1/calendar/me')
            .then((res)=>{
                state.my_events = res.data;
            });
    },

    fetch_subjects(state){
        axios.get('/v1/admin/subjects')
            .then((res)=>{
                state.subjects = res.data;
            })
    },

    fetch_courses(state){
        axios.get('/v1/admin/courses')
        .then((res)=>{
            state.courses = res.data;
        })
    }
}