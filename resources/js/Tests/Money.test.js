import Money from '@/App/Money';

describe('Money Utility Tests', () => {
    test('it formats integer values to a presentable currency format', () => {
        const money = new Money();

        expect(money.format(1000)).toEqual('$10.00');
    });
});
