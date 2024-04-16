<div x-data="{
    billing: $persist([]),
    submitForm() {
        this.billing = {
            name: $refs.billingForm.name.value,
            email: $refs.billingForm.email.value,
            phone: $refs.billingForm.phone.value,
            address: $refs.billingForm.address.value
        };
        $refs.billingForm.submit();
    },
    getOrderedProducts(){
        var products = [];
        for(var i = 0; i < this.cart.length; i++){
            products.push({
                id: this.cart[i].id,
                quantity: this.cart[i].reserve,
            });
        }
        return JSON.stringify(products);
    }
}">