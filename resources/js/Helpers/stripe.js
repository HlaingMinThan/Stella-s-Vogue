import { loadStripe } from '@stripe/stripe-js';
const stripePromise = loadStripe(import.meta.env.VITE_STRIPE_KEY);

export const getStripe = () => {
    return stripePromise;
};
