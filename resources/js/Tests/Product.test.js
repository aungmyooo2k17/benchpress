import Product from '@/App/Product';

describe('Product Tests', () => {
    test('it can be instantiated', () => {
        let product = new Product({});

        expect(product).toBeInstanceOf(Product);
    });

    test('it formats price values to a presentable currency format', () => {
        let product = new Product({ price: 1000 });

        expect(product.presentablePrice()).toEqual('$10.00');
    });
});
