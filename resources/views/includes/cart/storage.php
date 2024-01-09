<body class="font-sans bg-xbg-800 text-gray-50" x-data='{
    cart: $persist([]),
    addCart(product, quantity = 1) {
        (product.reserve = quantity > product.quantity ? product.quantity : quantity),
        (!this.hasCart(product.id) ? this.cart.unshift(product) : this.cart = this.cart.filter((pd) => (pd.id == product.id ? product : pd)));
    },
    hasCart(id) {
        return this.getCart(id) != null;
    },
    removeCart(id) {
        this.cart = this.cart.filter((pid) => pid.id != id);
    },
    getCart(id) {
        return this.cart.filter((pid) => pid.id == id)[0] ?? null;
    },
    getQuantity(id) {
        return parseInt(this.hasCart(id) ? this.getCart(id).reserve : 1);
    }
}'>