import { loadStripe } from '@stripe/stripe-js';
import config from '../Config';

class Stripe {
    /**
     * Create a new Stripe helper instance.
     *
     * @param   {String}  apiKey
     *
     * @return  {void}
     */
    constructor(apiKey = null) {
        this.initialize(apiKey);
    }

    /**
     * Initialize Stripe API client.
     *
     * @param {String|null} apiKey
     *
     * @return  {void}
     */
    async initialize(apiKey = null) {
        if (apiKey === null) {
            apiKey = config('billing.services.stripe.key', '');
        }

        this.core = await loadStripe(apiKey);
    }

    /**
     * Get the Stripe elements instance.
     *
     * @return  {Element}
     */
    elements() {
        return this.core.elements();
    }
}

export default Stripe;
