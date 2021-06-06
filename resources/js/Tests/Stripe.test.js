import Stripe from '@/App/Stripe';

describe('Stripe Tests', () => {
    test('it can be instantiated', () => {
        let stripe = new Stripe();

        expect(stripe).toBeInstanceOf(Stripe);
    });

    test('it can load Stripe client', () => {
        async () => {
            const stripe = new Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');

            expect(stripe.core).toBeInstanceOf(Client);
        };
    });
});
