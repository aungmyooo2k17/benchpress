class Repository {
    /**
     * Create new instance of config repository.
     *
     * @param   {Object}  items
     */
    constructor(items = {}) {
        this.items = items;
    }

    /**
     * Get specific value from config repository.
     *
     * @param {String} key
     * @return {Any}
     */
    get(key, defaultValue = null) {
        try {
            const value = key.split('.').reduce((object, item) => {
                return object[item];
            }, this.items);

            if (value === undefined) {
                return defaultValue;
            }

            return value;
        } catch (error) {
            return defaultValue;
        }
    }

    /**
     * Get all config items from repository.
     *
     * @return  {Any}
     */
    all() {
        return this.items;
    }
}

export default Repository;
