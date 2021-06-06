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
        this.attributes = attributes;
    }

    /**
     * Get the presentable format of the price of the product.
     *
     * @return  {String}
     */
    presentablePrice() {
        if (this.attributes.hasOwnProperty('amount')) {
            const amount = this.attributes.amount;

            return typeof amount !== 'string' ? amount : this.format(amount);
        }

        return this.format(this.attributes.price);
    }

    /**
     * Format the given integer amount to a presentable currency format.
     *
     * @param   {Integer}  amount
     *
     * @return  {String}
     */
    format(amount) {
        const money = new Money();

        return money.format(amount);
    }
}

export default Product;
