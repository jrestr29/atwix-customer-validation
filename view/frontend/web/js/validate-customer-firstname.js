/**
 * @author Jose Restrepo
 */
define([
    'jquery',
    'mage/url'
], function($, url) {
    'use strict';

    return function(validation) {
        $.validator.addMethod(
            'validate-customer-firstname',

            function(value, element) {
                let isValid;

                $.ajax({
                    async: false,
                    method: "GET",
                    url: url.build('rest/V1/atwix-customer-validate/' + value),
                    data: { firstname: value }
                }).done(function( result ) {
                    isValid = result;
                });

                return isValid;
            },

            $.mage.__('Firstname can\'t contain whitespaces')
        )
        return validation;
    }
});
