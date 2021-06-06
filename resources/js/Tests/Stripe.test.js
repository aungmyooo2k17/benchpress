import Stripe from '@/App/Stripe';

describe('Stripe Tests', () => {
    test('it can be instantiated', () => {
        let stripe = new Stripe();

        expect(stripe).toBeInstanceOf(Stripe);
    });
});
