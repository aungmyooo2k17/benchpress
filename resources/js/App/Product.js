import Money from './Money';

class Product {
    /**
     * Create new Product instance.
     *
     * @param   {Object}  attributes
     *
     * @return  {void}
     */
    constructor(attributes = {}) {
        this.attributes = {};
    }

    /**
     * Get the presentable format of the price of the product.
     *
     * @return  {String}
     */
    price() {
        if (this.attributes.hasOwnProperty('amount')) {
            return this.attributes.amount;
        }

        return new Money().format(this.attributes.price);
    }
}

export default Product;
