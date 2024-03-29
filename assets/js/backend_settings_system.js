/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2018, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

(function () {

    'use strict';

    /**
     * "System Settings" Tab Helper Class
     *
     * @class SystemSettings
     */
    var SystemSettings = function () {
    };

    /**
     * Save the system settings.
     *
     * This method is run after changes are detected on the tab input fields.
     *
     * @param {Array} settings Contains the system settings data.
     */
    SystemSettings.prototype.save = function (settings) {
        var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_save_settings';
        var postData = {
            csrfToken: GlobalVariables.csrfToken,
            settings: JSON.stringify(settings),
            type: BackendSettings.SETTINGS_SYSTEM
        };

        $.post(postUrl, postData, function (response) {
            if (!GeneralFunctions.handleAjaxExceptions(response)) {
                return;
            }

            Backend.displayNotification(EALang.settings_saved);

            // Update the logo title on the header.
            $('#header-logo span').text($('#company-name').val());

            // We need to refresh the working plan.
            var workingPlan = BackendSettings.wp.get();
            $('.breaks tbody').empty();
            BackendSettings.wp.setup(workingPlan);
            BackendSettings.wp.timepickers(false);
        }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    };

    /**
     * Prepare the system settings array.
     *
     * This method uses the DOM elements of the backend/settings page, so it can't be used in another page.
     *
     * @return {Array} Returns the system settings array.
     */
    SystemSettings.prototype.validate = function () {
        var valid = true;
        $('#general').find('input, select').each(function () {
            if ($(this).hasClass('required') && !$(this).val()) {
                $(this).addClass('has-error');
                valid = false;
            }
        });
        return valid;
    };
    
    SystemSettings.prototype.get = function () {
        var settings = [];

        // General Settings Tab
        $('#general').find('input, select').each(function () {
            settings.push({
                name: $(this).attr('data-field'),
                value: $(this).val()
            });
        });

        settings.push({
            name: 'customer_notifications',
            value: $('#customer-notifications').hasClass('active') === true ? '1' : '0'
        });

        settings.push({
            name: 'require_captcha',
            value: $('#require-captcha').hasClass('active') === true ? '1' : '0'
        });

        // Business Logic Tab
        settings.push({
            name: 'company_working_plan',
            value: JSON.stringify(BackendSettings.wp.get())
        });

        settings.push({
            name: 'book_advance_timeout',
            value: $('#book-advance-timeout').val()
        });

        // Legal Contents Tab
        settings.push({
            name: 'display_cookie_notice',
            value: $('#display-cookie-notice').prop('checked') ? '1' : '0'
        });

        settings.push({
            name: 'cookie_notice_content',
            value: $('#cookie-notice-content').trumbowyg('html')
        });

        settings.push({
            name: 'display_terms_and_conditions',
            value: $('#display-terms-and-conditions').prop('checked') ? '1' : '0'
        });

        settings.push({
            name: 'terms_and_conditions_content',
            value: $('#terms-and-conditions-content').trumbowyg('html')
        });

        settings.push({
            name: 'display_privacy_policy',
            value: $('#display-privacy-policy').prop('checked') ? '1' : '0'
        });

        settings.push({
            name: 'privacy_policy_content',
            value: $('#privacy-policy-content').trumbowyg('html')
        });

        return settings;
    };

    /**
     * Validate the settings data.
     *
     * If the validation fails then display a message to the user.
     *
     * @return {Boolean} Returns the validation result.
     */
    SystemSettings.prototype.validate = function () {
        $('#general .has-error').removeClass('has-error');

        try {
            // Validate required fields.
            var missingRequired = false;
            $('#general .required').each(function () {
                if ($(this).val() == '' || $(this).val() == undefined) {
                    $(this).closest('.form-group').addClass('has-error');
                    missingRequired = true;
                }
            });

            if (missingRequired) {
                throw EALang.fields_are_required;
            }

            // Validate company email address.
            /*if (!GeneralFunctions.validateEmail($('#company-email').val())) {
                $('#company-email').closest('.form-group').addClass('has-error');
                throw EALang.invalid_email;
            }*/

            return true;
        } catch (message) {
            Backend.displayNotification(message);
            return false;
        }
    };

    window.SystemSettings = SystemSettings;
})();
