import { router } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    addToCart: (state, payload) => {
        let isAlreadyExist = state.cart.some((item) => item.price.id === payload.price.id);

        if (isAlreadyExist) {
            console.log('already exist.');
            return;
        }
        const existPlan = state.cart.find(item => item.id == payload.id);

        if (existPlan) {
            let updatedCart = state.cart.filter(item => item.id !== existPlan.id);
            state.cart = [...updatedCart,payload];
        } else {
            state.cart = [...state.cart, payload];
        }
        localStorage.setItem('cart', JSON.stringify(state.cart));
        axios.post(route('cart.save'), {
            cart: state.cart
        }).then(() => {
            router.get(route('auth.account'));
        });

    },
    deleteCartItem: (state, payload) => {
        state.cart = state.cart.filter((cart) => cart.id !== payload.id);
        if (state.cart.length == 0) {
            router.get(route('get-started'));
        }
        localStorage.setItem('cart', JSON.stringify(state.cart));

        // router.post(route('cart.save'), { cart: state.cart });
        axios.post(route('cart.save'), {
            cart: state.cart
        });

    },
    clearCartItems: (state) => {
        state.cart = [];
        localStorage.setItem('cart',JSON.stringify(state.cart));

        // router.post(route('cart.save'), { cart: state.cart });
        axios.post(route('cart.save'), {
            cart: state.cart
        });

    },
    toggleCart:(state,payload) => {
        state.isCartOpen = payload;
    },
    toggleRegionModalBox :(state,payload) => {
        state.isRegionModalBoxOpen = payload;
    },
    nationality : (state,payload) => {
        state.nationality = payload;
    },
    toggleSideNav:(state,payload) => {
        state.isSideNavOpen = payload;
    },
    setVerifyCountDown:(state,payload) => {
        state.verifyCountDown = payload;
    },
    decrementVerifyCountDown(state) {
        state.verifyCountDown--;
    },
    setEmailVerifyTimerInterval(state,payload){
        state.emialVerifyTimerInterval = payload;
    }
};
