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
            apiKey = config('billing.services.stripe.key', 'pk_123');
        }

        this.core = await loadStripe(apiKey);
    }

    /**
     * Create a credit card Stripe element.
     *
     * @param   {String}  elementId
     * @param   {Object}  config
     *
     * @return  {void}
     */
    createCardElement(elementId, config = {}) {
        this.card = this.elements().create('card', config);

        this.card.addEventListener('change', (event) => {
            this.cardError = event.error ? event.error.message : null;
        });

        this.card.mount(elementId);
    }

    /**
     * Get the card error message element.
     *
     * @return  {Element}
     */
    cardErrorMessage() {
        return this.cardError;
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
