/**
 * Copyright © Iksanika, Inc. All rights reserved.
 * See IKS-COPYING.txt for license details.
 */

/**
 * @api
 */
define([
    'jquery',
    'mage/template',
    'text!Iksanika_Productmanage/templates/ui/image-preview.html',
    'underscore',
    'Magento_Ui/js/modal/modal',
    'mage/translate'
], function (Column, $, mageTemplate, imagePreviewTemplate, _) {
    'use strict';

    return Element.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/thumbnail',
            fieldClass: {
                'data-grid-thumbnail-cell': true
            }
        },

        /**
         * Get image source data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getSrc: function (row) {
            return row[this.index + '_src'];
        },

        /**
         * Get original image source data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getOrigSrc: function (row) {
            return row[this.index + '_orig_src'];
        },

        /**
         * Get link data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getLink: function (row) {
            return row[this.index + '_link'];
        },

        /**
         * Get alternative text data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getAlt: function (row) {
            return _.escape(row[this.index + '_alt']);
        },

        /**
         * Check if preview available.
         *
         * @returns {Boolean}
         */
        isPreviewAvailable: function () {
            return this['has_preview'] || false;
        },

        /**
         * Build preview.
         *
         * @param {Object} row
         */
        preview: function (row) {
            var modalHtml = mageTemplate(
                imagePreviewTemplate,
                {
//                    src: this.getOrigSrc(row), alt: this.getAlt(row), link: this.getLink(row),
                    linkText: $.mage.__('Go to Details Page')
                }
                ),
                previewPopup = $('<div/>').html(modalHtml);

            previewPopup.modal({
                title: this.getAlt(row),
                innerScroll: true,
                modalClass: '_image-box',
                buttons: []
            }).trigger('openModal');
        },
    });



    return Column.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/thumbnail',
            fieldClass: {
                'data-grid-thumbnail-cell': true
            }
        },

        /**
         * Get image source data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getSrc: function (row) {
            return row[this.index + '_src'];
        },

        /**
         * Get original image source data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getOrigSrc: function (row) {
            return row[this.index + '_orig_src'];
        },

        /**
         * Get link data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getLink: function (row) {
            return row[this.index + '_link'];
        },

        /**
         * Get alternative text data per row.
         *
         * @param {Object} row
         * @returns {String}
         */
        getAlt: function (row) {
            return _.escape(row[this.index + '_alt']);
        },

        /**
         * Check if preview available.
         *
         * @returns {Boolean}
         */
        isPreviewAvailable: function () {
            return this['has_preview'] || false;
        },

        /**
         * Build preview.
         *
         * @param {Object} row
         */
        preview: function (row) {
            var modalHtml = mageTemplate(
                    thumbnailPreviewTemplate,
                    {
                        src: this.getOrigSrc(row), alt: this.getAlt(row), link: this.getLink(row),
                        linkText: $.mage.__('Go to Details Page')
                    }
                ),
                previewPopup = $('<div/>').html(modalHtml);

            previewPopup.modal({
                title: this.getAlt(row),
                innerScroll: true,
                modalClass: '_image-box',
                buttons: []
            }).trigger('openModal');
        },

        /**
         * Get field handler per row.
         *
         * @param {Object} row
         * @returns {Function}
         */
        getFieldHandler: function (row) {
            if (this.isPreviewAvailable()) {
                return this.preview.bind(this, row);
            }
        }
    });
});
