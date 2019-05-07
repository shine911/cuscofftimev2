export default{
    user: JSON.parse(localStorage.getItem("user"))||{},
    selected_date: "2019-02-13",
    my_assignments: [],
    class_options: [{"value": null, "text": "Chọn lớp"}],
    events:[],
    my_events: [],
    subjects: [],
    courses: [],
}