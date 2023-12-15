var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/place-order': {
                'Eglobe_OrderNotes/js/order/place-order-mixin': true
            },
            'Magento_Checkout/js/action/set-payment-information': {
                'Eglobe_OrderNotes/js/order/set-payment-information-mixin': true
            }
        }
    }
};