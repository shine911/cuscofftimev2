export default{
    set_selected_date({commit}, date){
        commit('selected_date', date)
    },
    fetchUser({commit}, data){
        commit('fetchUser', data);
    },
    fetchMyAssignments({commit}, month){
        axios.get("/v1/assignments/me", {
            params:{
                "month": month
            }
        })
        .then((res)=>{
            commit('fetch_my_assignments', res.data);
        }).then(()=>{
            commit('fetch_my_classroom');
        });
        
    },
    fetch_events({commit}){
        commit("fetch_events");
        commit("fetch_my_events");
    },
    fetch_subjects({commit}){
        commit("fetch_subjects");
    },
    fetch_courses({commit}){
        commit("fetch_courses");
    }
}