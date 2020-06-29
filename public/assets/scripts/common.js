"use strict";

(function($, window) {
    /**
     * Default overlay settings
     */
    $.LoadingOverlaySetup({
        image: "assets/img/loaders/svg-loaders/three-dots.svg",
        /*image       : "",
         fontawesome : "fa fa-refresh fa-spin",*/
        zIndex: 1,
        size: 0,
        color: '#fff'
    });

    /**
     * Show overlay for an entire page
     */
    $.LoadingOverlay("show", {
        fade: false,
        zIndex: 99999
    });

    window.Kosmo = {
        screen: {
            breakpoints: {
                xxl: 1441,
                xl: 1440,
                lg: 992,
                md: 768,
                sm: 544,
                xs: 320
            }
        },
        initSidebarScrollBar: function(ksSidebar, isSidebarFixed) {
            if (isSidebarFixed) {
                ksSidebar.find('> .wrapper').jScrollPane({
                    autoReinitialise: true,
                    autoReinitialiseDelay: 300
                });
            }
        },
        makeScrollable: function (selector) {
            $(selector).jScrollPane({
                autoReinitialise: true,
                autoReinitialiseDelay: 300
            });
        }
    };

    Response.create({
        prop : "width",
        breakpoints: [
            Kosmo.screen.breakpoints.xxl,
            Kosmo.screen.breakpoints.xl,
            Kosmo.screen.breakpoints.lg,
            Kosmo.screen.breakpoints.md,
            Kosmo.screen.breakpoints.sm,
            Kosmo.screen.breakpoints.xs,
            0
        ]
    });

    $(document).ready(function() {
        window.Kosmo.window = {
            height: $(window).height()
        };

        var ksBody = $('body');
        var ksSidebar = $('.sidebar');
        var ksSidebarToggle = $('.sidebar-toggle');
        var ksSidebarMobileToggle = $('.sidebar-mobile-toggle');
        var isSidebarFixed = ksBody.hasClass('sidebar-position-fixed');
        var isSidebarCompact = ksBody.hasClass('sidebar-compact');
        var ksMobileOverlay = $('.mobile-overlay');
        var ksNavbarMenu = $('.navbar-menu');
        var ksNavbarMenuToggle = $('.navbar-menu-toggle');
        var ksNavbarActions = $('.navbar .navbar-actions');
        var ksNavbarActionsToggle = $('.navbar-actions-toggle');
        var ksSearchOpen = $('.search-open');
        var ksSearchClose = $('.search-close');
        var ksSettingsSlideControl = $('.settings-slide-control');
        var ksSettingsSlideCloseControl = $('.settings-slide-close-control');

        Response.crossover('width', function() {
            if (Response.band(Kosmo.screen.breakpoints.xxl)) {
                if (!isSidebarCompact) {
                    ksBody.removeClass('sidebar-compact');
                }

                ksBody.removeClass('sidebar-collapsed');
            } else if (Response.band(Kosmo.screen.breakpoints.lg, Kosmo.screen.breakpoints.xl)) {
                ksBody.removeClass('sidebar-collapsed').addClass('sidebar-compact');
            } else if (Response.band(0, Kosmo.screen.breakpoints.lg)) {
                if (!isSidebarCompact) {
                    ksBody.removeClass('sidebar-compact');
                }

                ksBody.addClass('sidebar-collapsed');
            }
        });

        Response.ready(function() {
            $(window).trigger('resize');
        });

        setTimeout(function() {
            $.LoadingOverlay("hide");
            ksBody.removeClass('page-loading');
        }, 1000);

        // Replace default dropdown logic for sidebar
        ksSidebar.find('.dropdown-toggle').on('click', function() {
            if ($(this).closest('.dropdown-menu').size()) {
                if ($(this).closest('.dropdown-menu').find('.dropdown.open > .dropdown-toggle')[0] != $(this)[0]) {
                    $(this).closest('.dropdown-menu').find('.dropdown.open').removeClass('open');
                }

                $(this).closest('.dropdown').toggleClass('open');
            } else {
                if ($('.sidebar .dropdown.open > .dropdown-toggle')[0] != $(this)[0]) {
                    $('.sidebar .dropdown.open').removeClass('open');
                }

                $(this).closest('.dropdown').toggleClass('open');
            }
        });

        /**
         * Toggle sidebar to compact size
         */
        ksSidebarToggle.on('click', function() {
            if (!isSidebarCompact) {
                if (ksBody.hasClass('sidebar-compact')) {
                    ksBody.removeClass('sidebar-compact');
                } else {
                    ksBody.addClass('sidebar-compact');
                }
            }
        });

        ksSidebar.on({
            mouseenter: function () {
                if (ksBody.hasClass('sidebar-compact')) {
                    ksBody.addClass('sidebar-compact-open');
                }
            },
            mouseleave: function () {
                if (ksBody.hasClass('sidebar-compact')) {
                    ksBody.removeClass('sidebar-compact-open');
                    ksSidebar.find('.open').removeClass('open');
                }
            }
        });

        // Navbar toggle
        ksNavbarMenuToggle.on('click', function() {
            var self = $(this);

            if (ksMobileOverlay.hasClass('open') && !self.hasClass('open')) {
                ksMobileOverlay.removeClass('open');
                ksSidebar.removeClass('open');
                ksSidebarMobileToggle.removeClass('open');
                ksNavbarActions.removeClass('open');
                ksNavbarActionsToggle.removeClass('open');
            }

            self.toggleClass('open');
            ksNavbarMenu.toggleClass('open');
            ksMobileOverlay.toggleClass('open');
        });

        ksSidebarMobileToggle.on('click', function() {
            var self = $(this);

            if (ksMobileOverlay.hasClass('open') && !self.hasClass('open')) {
                ksMobileOverlay.removeClass('open');
                ksNavbarMenu.removeClass('open');
                ksNavbarMenuToggle.removeClass('open');
                ksNavbarActions.removeClass('open');
                ksNavbarActionsToggle.removeClass('open');
            }

            self.toggleClass('open');
            ksSidebar.toggleClass('open');
            ksMobileOverlay.toggleClass('open');
        });

        ksNavbarActionsToggle.on('click', function() {
            var self = $(this);

            if (ksMobileOverlay.hasClass('open') && !self.hasClass('open')) {
                ksMobileOverlay.removeClass('open');
                ksNavbarMenu.removeClass('open');
                ksNavbarMenuToggle.removeClass('open');
                ksSidebar.removeClass('open');
                ksSidebarMobileToggle.removeClass('open');
            }

            self.toggleClass('open');
            ksNavbarActions.toggleClass('open');
            ksMobileOverlay.toggleClass('open');
        });

        ksMobileOverlay.on('click', function() {
            if (ksSidebar.hasClass('open')) {
                ksSidebar.toggleClass('open');
            } else if (ksNavbarMenu.hasClass('open')) {
                ksNavbarMenu.toggleClass('open');
            } else if (ksNavbarActions.hasClass('open')) {
                ksNavbarActions.toggleClass('open');
            }

            if (ksSidebarMobileToggle.hasClass('open')) {
                ksSidebarMobileToggle.toggleClass('open');
            }

            if (ksNavbarMenuToggle.hasClass('open')) {
                ksNavbarMenuToggle.toggleClass('open');
            }

            if (ksNavbarActionsToggle.hasClass('open')) {
                ksNavbarActionsToggle.toggleClass('open');
            }

            ksMobileOverlay.toggleClass('open');
        });

        ksSearchOpen.on('click', function() {
            $(this).closest('.navbar-menu').toggleClass('open');
            $('.search-form .form-control').focus();
        });

        ksSearchClose.on('click', function() {
            $(this).closest('.navbar-menu').toggleClass('open');
            $('.search-form .form-control').val('').blur();
        });

        ksSettingsSlideControl.on('click', function() {
            $(this).closest('.settings-slide-block').toggleClass('open');
        });

        ksSettingsSlideCloseControl.on('click', function() {
            $(this).closest('.settings-slide-block').removeClass('open');
        });

        /**
         * Prevent default events for messages dropdown
         */
        $('.navbar .messages .nav-tabs .nav-link').on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).tab('show');
        });

        /**
         * Prevent default events for notifications dropdown
         */
        $('.navbar .notifications .nav-tabs .nav-link').on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).tab('show');
        });

        /**
         * Prevent default events for nested dropdown menus
         */
        $('.navbar .dropdown-menu .dropdown-toggle').on('click', function(e) {
            var self = $(this);
            var parent = self.closest('.dropdown');
            e.stopPropagation();
            e.preventDefault();

            parent.toggleClass('show');
        });

        $(document).on('change', '.btn-file :file', function(e) {
            var input = $(this);
            var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            $(e.target).closest('.btn').find('.text').text(label);
        });

        $('.document-viewer .view-toggle').on('click', function() {
            var docViewer = $(this).closest('.document-viewer');

            if (!$(this).closest('.document-viewer').hasClass('expanded')) {
                docViewer.addClass('expanded');
                $(this).find('.icon').removeClass('fa-expand').addClass('fa-compress');
            } else {
                docViewer.removeClass('expanded');
                $(this).find('.icon').removeClass('fa-compress').addClass('fa-expand');
            }
        });

        /**
         * Set fixed height to blocks
         */
        $('[data-height]').each(function() {
            $(this).height($(this).data('height'));
        });

        /**
         * Set min height to blocks
         */
        $('[data-min-height]').each(function() {
            $(this).css('min-height', $(this).data('min-height'));
        });

        /**
         * Set auto height for blocks
         */
        $('[data-auto-height]').each(function() {
            var self = $(this);
            var autoHeight = self.data('auto-height');
            var height = Kosmo.window.height - self.offset().top;
            var fixHeight = parseInt(self.data('fix-height'), 10);
            var reduceHeight = self.data('reduce-height');
            var scrollableIfHasClass = $(this).data('scrollable-if-has-class');

            if (!scrollableIfHasClass || (scrollableIfHasClass && ($(this).hasClass(scrollableIfHasClass) || (Response.band(0, Kosmo.screen.breakpoints.lg))))) {
                if (autoHeight) {
                    if (autoHeight == 'parent') {
                        height = self.parent().height();
                    } else {
                        height = self.closest(autoHeight).height();
                    }
                } else {
                    if (reduceHeight) {
                        $.each(self.parent().find(reduceHeight), function (index, element) {
                            height -= $(element).height();
                        });
                    }

                    if (fixHeight > 0 && height > 0) {
                        height -= fixHeight;
                    }

                    if (height <= 0) {
                        if (self.data('min-height')) {
                            height = parseInt(self.data('min-height'), 10);
                        } else {
                            height = 200;
                        }
                    }
                }

                self.height(height);
            }
        });

        /**
         * Add scroll to blocks
         */
        $('.scrollable').each(function(index, item) {
            var scrollableIfHasClass = $(this).data('scrollable-if-has-class');

            if (!scrollableIfHasClass || (scrollableIfHasClass && ($(this).hasClass(scrollableIfHasClass) || Response.band(0, Kosmo.screen.breakpoints.lg)))) {
                $(item).jScrollPane({
                    autoReinitialise: true,
                    autoReinitialiseDelay: 100
                });
            }
        });

        /**
         * Toggle hidden responsive menus
         */
        $('[data-block-toggle]').on('click', function() {
            var self = $(this);
            var query = $(this).data('block-toggle');
            var block = $(query);

            self.toggleClass('open');
            block.toggleClass('open');
        });

        /**
         * Make Responsive Horizontal Navigation
         * @type {*|jQuery|HTMLElement}
         */
        if ($('.navbar-horizontal').size()) {
            var ksNavbarHorizontalResponsiveDropdown = $('.navbar-horizontal > .nav > .navbar-horizontal-responsive');
            var ksNavbarHorizontalWidth = $('.navbar-horizontal > .nav').width() + 60;
            var ksNavbarHorizontalScrollWidth = $('.navbar-horizontal').get(0).scrollWidth;

            if (ksNavbarHorizontalScrollWidth > ksNavbarHorizontalWidth) {
                ksNavbarHorizontalWidth -= 220;

                var menuItems = $('.navbar-horizontal > .nav > .nav-item:not(.navbar-horizontal-responsive)');
                var menuItemsLength = menuItems.length;

                for (var i = menuItemsLength; i >= 0; i--) {
                    var element = menuItems.get(i);
                    var elementWidth = $(element).width();

                    if ((ksNavbarHorizontalScrollWidth - elementWidth) > ksNavbarHorizontalWidth) {
                        ksNavbarHorizontalScrollWidth -= elementWidth;
                        var clone = $(element).clone();

                        clone.find('.dropdown-toggle').on('click', function (e) {
                            $(this).closest('.dropdown').toggleClass('show');

                            return false;
                        });

                        clone.removeClass('nav-item').addClass('dropdown-item');
                        $('.navbar-horizontal-responsive > .dropdown-menu').prepend(clone);

                        $(element).remove();
                    }
                }

                ksNavbarHorizontalResponsiveDropdown.show();
            }
        }

        /**
         * Toggle sidebar
         */
        $('.sidebar-checkbox-toggle :checkbox').on('change', function () {
            $('.sidebar-toggle').trigger('click');
        });

        /**
         * Toggle page header to fixed or unfixed position
         */
        $('.page-header-checkbox-toggle :checkbox').on('change', function () {
            ksBody.toggleClass('page-header-fixed');
        });

        /**
         * NOTICE: DELETE IN PRODUCTION!
         *
         * Toggle sidebar dark or light style
         */
        $('.sidebar-style-checkbox-toggle :checkbox').on('change', function () {
            if (this.checked) {
                $('html head').append('<link class="sidebar-dark-style" rel="stylesheet" type="text/css" href="assets/styles/themes/sidebar-black.min.css">');
            } else {
                $('.sidebar-dark-style').remove();
            }
        });

        /**
         * NOTICE: DELETE IN PRODUCTION!
         *
         * Toggle main content gray or white style
         */
        $('.content-bg-checkbox-toggle :checkbox').on('change', function () {
            ksBody.toggleClass('content-solid-bg');
        });

        Kosmo.initSidebarScrollBar(ksSidebar, isSidebarFixed);
        $(window).trigger('resize');
    });
})(jQuery, window);
