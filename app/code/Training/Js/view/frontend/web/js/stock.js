define([
    'uiComponent',
    'jquery',
    'ko'
], function(Component, $, ko) {
    'use strict';

    return Component.extend({
        stockObservable: ko.observable(''),
        countObservable: ko.observable(''),
        url: '',
        id: '',

        showStock: function () {

            var self = this;


            $.ajax({
                url: self.url,
                type: 'POST',
                dataType: 'json',
                data: { productId: self.id },
            }).done(function (data) {
                data = JSON.parse(data);
                if(data.stock){
                    self.stockObservable(data.stock);
                    self.countObservable(Math.random());
                }
            })
        }
    });
});
