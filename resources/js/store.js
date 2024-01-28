import { createStore } from 'vuex';

const store = createStore({
    state() {
        return {
            // currentPerPage: 25
        };
    },
    mutations: {
        // setCurrentPerPage(state, number) {
        //     state.currentPerPage = number;
        // }
    },
});

export default store;
