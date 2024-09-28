export default {
    emailVerifyTimer({ state, commit }) {
        commit('setVerifyCountDown', localStorage.getItem('verifyInterval'));

        if (!state.verifyCountDown) {
            commit('setEmailVerifyTimerInterval',null);
            return;
        }

        let interval = setInterval(() => {
            if (state.verifyCountDown <= 1) {
                commit('setVerifyCountDown', null);
                localStorage.removeItem('verifyInterval', state.verifyCountDown);
                clearInterval(interval);
                return;
            }

            commit('decrementVerifyCountDown');
            localStorage.setItem('verifyInterval', state.verifyCountDown);
        }, 1000);
        commit('setEmailVerifyTimerInterval',interval);
    },
};
