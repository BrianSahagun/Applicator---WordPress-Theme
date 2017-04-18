(function( $ ) {
    
    var $html = $( document.documentElement ),
        $document = $( document ),
        $window = $( window );
    
    
    // Classify the built-in Search
    ( function() {
        $( '.main-header---cr' ).children( '.search-cp' ).addClass( 'arbitrary-nav' ).attr( 'id', 'arbitrary-nav' );
    }() );
    
    
    // ------------------------- Go to Content
    function initGoContent( component ) {
        
        var $goCtNaviA = $( '#go-ct-navi---a' ),
            
            goCtActCss = 'go-content-nav--active',
            goCtInactCss = 'go-content-nav--inactive',
            
            aplGoCtActCss = 'apl--go-content-nav--active',
            aplGoCtInactCss = 'apl--go-content-nav--inactive';
        
        function goCtNaviActivate() {
            component
                .addClass( goCtActCss )
                .removeClass( goCtInactCss );
            $html
                .addClass( aplGoCtActCss )
                .removeClass( aplGoCtInactCss );
        }
        
        function goCtNaviDeactivate() {
            component
                .addClass( goCtInactCss )
                .removeClass( goCtActCss );
            $html
                .addClass( aplGoCtInactCss )
                .removeClass( aplGoCtActCss );
        }
        
        // Initiate
        goCtNaviDeactivate();
        
        // Focus In > Activate
        $goCtNaviA.on( 'focusin.applicator', function () {
            goCtNaviActivate();
        } );

        // Focus Out > Deactivate
        $goCtNaviA.on( 'focusout.applicator', function () {
            goCtNaviDeactivate();
        } );
        
    }
    initGoContent( $( '#go-content-nav' ) );
    
    
    // ------------------------- Sub-Navigation
    function initSubNav( component ) {
        
        if ( ! $html.hasClass( 'applicator--sub-nav' ) ) {
			return;
		}
        
        // Create the markup of Sub-Nav Toggle
        var subnavToggle = $( '<div />', { 'class': 'cp sub-nav-toggle', 'data-name': 'Sub-Nav Toggle' } )
                .append( $( '<div />', { 'class': 'sub-nav-toggle--cr' } ) ),
            
            subnavToggleAction = $( '<button />', { 'class': 'b a sub-nav-toggle--a' } )
                .append( $( '<span />', { 'class': 'sub-nav-toggle--a-l' } ) ),
            
            subnavToggleActionLabel = $( '<span />', { 'class': 'sub-nav-toggle--a--word--l', 'text': applicatorSubnavLabel.subnavShowLabel } ),
            
            subNavActive = 'sub-nav--active',
            subNavInactive = 'sub-nav--inactive',
            
            aplSubNavActiveClass = 'applicator--sub-nav--active',
            aplSubNavInactiveClass = 'applicator--sub-nav--inactive';
        
        
        
        component.find( '.page_item_has_children > a, .menu-item-has-children > a' ).after( subnavToggle );
        
        component.find( '.sub-nav-toggle--cr' ).append( subnavToggleAction );
        
        component.find( '.sub-nav-toggle--a-l' )
            .append( subnavToggleActionLabel )
            .append( ' ' )
            .append( applicatorSubnavLabel.subnavIcon );
        
        
        
        // Set Default State of Sub-Nav Toggle
        component.find( '.page_item_has_children, .menu-item-has-children' ).addClass( subNavInactive );
        $html.addClass( aplSubNavInactiveClass );
        
        
        // Deactivate Sub-Nav
        component.find( '.page_item_has_children, .menu-item-has-children' ).each( function() {
            var _this = $( this );
            if ( _this.hasClass( subNavInactive ) ) {
                _this.find( '.sub-nav-toggle--a' ).attr( 'aria-expanded', 'false' ).attr( 'title', applicatorSubnavLabel.subnavShowLabel );
            }
        } );
        
        
        // Click Toggle Action
        component.find( '.sub-nav-toggle--a' ).click( function( e ) {
            var _this = $( this ),
                subNavLabel = _this.find( '.sub-nav-toggle--a--word--l' );
            
            e.preventDefault();
            
            // The <button> itself
            _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            
            subNavLabel.text( subNavLabel.text() === applicatorSubnavLabel.subnavShowLabel ? applicatorSubnavLabel.subnavHideLabel : applicatorSubnavLabel.subnavShowLabel );
            
            _this.attr( 'title', _this.attr( 'title' ) === applicatorSubnavLabel.subnavShowLabel ? applicatorSubnavLabel.subnavHideLabel : applicatorSubnavLabel.subnavShowLabel );
            
            // The Sub-Nav Toggle Component
            _this.closest( '.page_item, .menu-item' )
                .toggleClass( subNavActive )
                .toggleClass( subNavInactive );
            
            // Deactivate Siblings
            _this.closest( '.page_item, .menu-item' ).siblings()
                .addClass( subNavInactive )
                .removeClass( subNavActive );
            
            // Classify in <html>
            if ( _this.closest( '.page_item, .menu-item' ).hasClass( subNavInactive ) ) {
                $html
                    .addClass( aplSubNavInactiveClass )
                    .removeClass( aplSubNavActiveClass );
            } else if ( _this.closest( '.page_item, .menu-item' ).hasClass( subNavActive ) ) {
                $html
                    .addClass( aplSubNavActiveClass )
                    .removeClass( aplSubNavInactiveClass );
            }
        } );
        
    }
    initSubNav( $( '#main-nav' ) );
    initSubNav( $( '.widget_nav_menu' ) );
    initSubNav( $( '.widget_pages' ) );
    
    
    // ------------------------- Search
    function initSearch( component ) {
        
        // Create Markup
        var searchToggle = $( '<div />', { 'class': 'cp search-toggle', 'data-name': 'Search Toggle' } )
                .append( $( '<div />', { 'class': 'search-toggle--cr' } ) ),
            
            searchToggleAction = $( '<button />', { 'class': 'b a search-toggle--a' } )
                .append( $( '<span />', { 'class': 'search-toggle--a-l' } ) ),
            
            searchToggleActionLabel = $( '<span />', { 'class': 'search-toggle--a--word--l', 'text': applicatorSearchLabel.searchShowLabel } ),
            
            searchActiveClass = 'search--active',
            searchInactiveClass = 'search--inactive',
            searchInputEmptyClass = 'search-input--empty',
            
            aplSearchActiveClass = 'apl--search--active',
            aplSearchInactiveClass = 'apl--search--inactive',
            
            $searchComponent = $( '.arbitrary-nav' ),
            $searchInput = component.find( '.search-term--input--text' ),
            $searchForm = component.find( '.search-form' ),
            $searchToggleLabel,
            $searchToggleAction,
            
            $searchSubmit = component.find( '.search-form-submit--a-l' ),
            $searchReset = component.find( '.search-form-reset--a-l' );
        
        // Attach Markup
        component.find( '.search-form' ).before( searchToggle );
        component.find( '.search-toggle--cr' ).append( searchToggleAction );
        
        component.find( '.search-toggle--a-l' )
            .append( searchToggleActionLabel )
            .append( ' ' )
            .append( applicatorSearchLabel.searchIcon )
            .append( applicatorSearchLabel.searchDismissIcon );
        
        $searchSubmit.append( ' ' )
            .append( applicatorSearchLabel.searchIcon );
        
        $searchReset.append( ' ' )
            .append( applicatorSearchLabel.searchDismissIcon );
        
        
        // ------------------------- Set Defaults
        component.addClass( searchInactiveClass );
        
        
        $searchToggleLabel = component.find( '.search-toggle--a--word--l' );
        $searchToggleAction = component.find( '.search-toggle--a' );
        $searchToggleResetAction = component.find( '.search-form-reset--a' );
        
        
        // ------------------------- Search Toggle Status
        function searchStatusToggle() {
            
            // Set defaults for text label and aria-expanded based on Status Class
            if ( $searchComponent.hasClass( searchInactiveClass ) ) {
                $searchToggleAction.attr( 'aria-expanded', 'false' );
                $searchToggleAction.attr( 'title', applicatorSearchLabel.searchShowLabel );
                $searchToggleLabel.text( applicatorSearchLabel.searchShowLabel );
                $html.addClass( aplSearchInactiveClass );
                $html.removeClass( aplSearchActiveClass );
            
            } else if ( $searchComponent.hasClass( searchActiveClass ) ) {
                $searchToggleAction.attr( 'aria-expanded', 'true' );
                $searchToggleAction.attr( 'title', applicatorSearchLabel.searchHideLabel );
                $searchToggleLabel.text( applicatorSearchLabel.searchHideLabel );
                $html.addClass( aplSearchActiveClass );
                $html.removeClass( aplSearchInactiveClass );
            }
        }
        searchStatusToggle();
        
        // ------------------------- Function: Initial State of Input
        function searchInputStatus() {
        
            // Empty Input
            if ( $searchInput.val() == '' ) {
                component.addClass( 'search-input--empty' );
                component.removeClass( 'search-input--populated' );
            }

            // Populated Input (as seen in Search Results page)
            if ( ! $searchInput.val() == '' ) {
                component.addClass( 'search-input--populated' );
                component.removeClass( 'search-input--empty' );
            }
            
        }
        searchInputStatus();
        
        // ------------------------- Toggle Search
        $searchToggleAction.click( function( e ) {
            var _this = $( this );
            
            e.preventDefault();
            
            // Toggle Component Status
            $searchComponent
                .toggleClass( searchActiveClass )
                .toggleClass( searchInactiveClass );
            
            searchStatusToggle();
            
            // Focus on Input
            if ( $searchComponent.hasClass( searchActiveClass ) ) {
                $searchInput.focus();
            }
            
            
        } );
        
        // ------------------------- Reset Action
        $searchToggleResetAction.click( function( e ) {
            var _this = $( this );
            
            e.preventDefault();
            
            // Reset value and focus on Input
            $searchInput.val( '' ).focus();
            
            searchInputStatus();
        } );
        
        // ------------------------- Text Input Detection
        $searchInput.on( 'keypress.applicator input.applicator', function() {
            searchInputStatus();
        } );
        
        
        // ------------------------- Function: Deactivate Search
        function searchDeactivate() {
            $searchComponent
                .addClass( searchInactiveClass )
                .removeClass( searchActiveClass );
            
            $searchToggleAction.attr( 'aria-expanded', 'false' );
            
            $searchToggleLabel.text( applicatorSearchLabel.searchShowLabel );
            
            $html
                .addClass( aplSearchInactiveClass )
                .removeClass( aplSearchActiveClass );
        }
        
        
        // ------------------------- Deactivate Search on click outside the component itself
        $document.on( 'touchmove.applicator click.applicator', function ( e ) {
            var _this = $( this );
            if ( ! $( e.target ).closest( '.arbitrary-nav' ).length && $searchComponent.hasClass( searchActiveClass ) ) {
                searchDeactivate();
            }
        } );


        // ------------------------- Deactivate Search upon ESC key
        $window.load( function () {
            $( document ).on( 'keyup.applicator', function ( e ) {
                if ( e.keyCode == 27 && $searchComponent.hasClass( searchActiveClass ) ) {
                    searchDeactivate();
                }
            } );
        } );
        
    }
    initSearch( $( '#arbitrary-nav' ) );
    
    
    
    
    
    // ------------------------- Go to Start
    function initGoStart( component ) {
        
        var $goStartNaviA = $( '#go-start-navi---a' ),
            
            goStartActCss = 'go-start-nav--active',
            goStartInactCss = 'go-start-nav--inactive',
            
            aplGoStartActCss = 'apl--go-start-nav--active',
            aplGoStartInactCss = 'apl--go-start-nav--inactive';
        
        function goStartNaviActivate() {
            component
                .addClass( goStartActCss )
                .removeClass( goStartInactCss );
            $html
                .addClass( aplGoStartActCss )
                .removeClass( aplGoStartInactCss );
        }
        
        function goStartNaviDeactivate() {
            component
                .addClass( goStartInactCss )
                .removeClass( goStartActCss );
            $html
                .addClass( aplGoStartInactCss )
                .removeClass( aplGoStartActCss );
        }
        
        // Initiate
        goStartNaviDeactivate();
        
        // http://stackoverflow.com/a/40370876
        window.onscroll = function( ev ) {
            if ( ( window.innerHeight + window.pageYOffset ) >= document.body.offsetHeight ) {
                goStartNaviActivate();
            }
        };

        
        /*
        // Focus In > Activate
        $goStartNaviA.on( 'focusin.applicator', function () {
            goCtNaviActivate();
        } );

        // Focus Out > Deactivate
        $goStartNaviA.on( 'focusout.applicator', function () {
            goCtNaviDeactivate();
        } );
        */
        
        
    
    
        // Smooth Scroll to #start
        $( '#go-start-navi---a' ).bind( 'click', function( e ) {

            e.preventDefault();

            var target = $( this ).attr( "href" );

            $( 'html, body' ).stop().animate( {
                scrollTop: $( target ).offset().top
            }, 1000, function() {
                location.hash = target;
            } );

            return false;
        } );
        
    }
    initGoStart( $( '#go-start-nav' ) );
    
    
    
    // ------------------------- Main Nav | Header Aside - Menu
    function initMainNavHeaderAsideMenu( component ) {
        
        var mainNavHeaderAsideMenuToggle = $( '<div />', { 'class': 'cp main-nav--header-aside--menu-toggle', 'data-name': 'Main Navigation | Header Aside Toggle' } )
                .append( $( '<div />', { 'class': 'main-nav--header-aside--menu-toggle--cr' } ) ),
            
            mainNavHeaderAsideMenuToggleAction = $( '<button />', { 'class': 'b a main-nav--header-aside--menu-toggle--a' } )
                .append( $( '<span />', { 'class': 'main-nav--header-aside--menu-toggle--a-l' } ) ),
            
            mainNavHeaderAsideMenuToggleActionLabel = $( '<span />', { 'class': 'main-nav--header-aside--menu-toggle--a--word--l', 'text': applicatormainNavHeaderAsideMenuLabel.mainNavHeaderAsideMenuShowLabel } ),
            
            mainNavHeaderAsideMenuActiveClass = 'main-nav--header-aside--active',
            mainNavHeaderAsideMenuInactiveClass = 'main-nav--header-aside--inactive',
            
            aplMainNavHeaderAsideMenuActiveClass = 'apl--mnha--menu--active',
            aplMainNavHeaderAsideMenuInactiveClass = 'apl--mnha--menu--inactive',
            
            $mnhaCp = $( '.main-nav--main-header-aside' ),
            
            $mainMenuTogAxn,
            $mainMenuTogAxnL;
        
        // Attach Markup
        component.find( '.mn-mha---ct' ).before( mainNavHeaderAsideMenuToggle );
        component.find( '.main-nav--header-aside--menu-toggle--cr' ).append( mainNavHeaderAsideMenuToggleAction );
        component.find( '.main-nav--header-aside--menu-toggle--a-l' )
            .append( mainNavHeaderAsideMenuToggleActionLabel )
            .append( ' ' )
            .append( applicatormainNavHeaderAsideMenuLabel.mainNavHeaderAsideMenuIcon )
            .append( applicatormainNavHeaderAsideMenuLabel.mainNavHeaderAsideMenuDismissIcon );
        
        
        // Set Default State as Inactive
        component.addClass( mainNavHeaderAsideMenuInactiveClass );
        $html.addClass( aplMainNavHeaderAsideMenuInactiveClass );
        
        
        $mainMenuTogAxn = component.find( '.main-nav--header-aside--menu-toggle--a' );
        $mainMenuTogAxnL = $mainMenuTogAxn.find( '.main-nav--header-aside--menu-toggle--a--word--l' );
        
        
        function mnhaActivate() {
            $mnhaCp
                .addClass( mainNavHeaderAsideMenuActiveClass )
                .removeClass( mainNavHeaderAsideMenuInactiveClass );
            $mainMenuTogAxn.attr( 'aria-expanded', 'true' );
            $mainMenuTogAxn.attr( 'title', applicatormainNavHeaderAsideMenuLabel.mainNavHeaderAsideMenuHideLabel );
            $mainMenuTogAxnL.text( applicatormainNavHeaderAsideMenuLabel.mainNavHeaderAsideMenuHideLabel );
            $html.addClass( aplMainNavHeaderAsideMenuActiveClass );
            $html.removeClass( aplMainNavHeaderAsideMenuInactiveClass );
        }
        
        function mnhaDeactivate() {
            $mnhaCp
                .addClass( mainNavHeaderAsideMenuInactiveClass )
                .removeClass( mainNavHeaderAsideMenuActiveClass );
            $mainMenuTogAxn.attr( 'aria-expanded', 'false' );
            $mainMenuTogAxn.attr( 'title', applicatormainNavHeaderAsideMenuLabel.mainNavHeaderAsideMenuShowLabel );
            $mainMenuTogAxnL.text( applicatormainNavHeaderAsideMenuLabel.mainNavHeaderAsideMenuShowLabel );
            $html.addClass( aplMainNavHeaderAsideMenuInactiveClass );
            $html.removeClass( aplMainNavHeaderAsideMenuActiveClass );
        }
        
        
        // ------------------------- Main Menu Status
        function mainMenuToggle() {
            
            if ( component.hasClass( mainNavHeaderAsideMenuActiveClass ) ) {
                mnhaActivate();
                
                component.find( '.mn-mha---ct' ).attr( 'title', applicatormainNavHeaderAsideMenuLabel.mainNavHeaderAsideMenuHideLabel );
                
                component.find( '.mn-mha---ct-cr' ).attr( 'title', '' );
            
            } else if ( component.hasClass( mainNavHeaderAsideMenuInactiveClass ) ) {
                mnhaDeactivate();
            }
        }
        mainMenuToggle();
        
        
        // Click Toggle Action
        component.find( '.main-nav--header-aside--menu-toggle--a' ).click( function( e ) {
            var _this = $( this );

            e.preventDefault();

            component
                .toggleClass( mainNavHeaderAsideMenuActiveClass )
                .toggleClass( mainNavHeaderAsideMenuInactiveClass );

            mainMenuToggle();
        } );
        
        
        
        // ------------------------- Deactivate on Click Outside
        $document.on( 'touchmove.applicator click.applicator', function ( e ) {
            var _this = $( this );
            if ( ( ! $( e.target ).closest( '.main-nav--header-aside--menu-toggle' ).length && ! $( e.target ).closest( '.mn-mha---ct-cr' ).length ) && $mnhaCp.hasClass( mainNavHeaderAsideMenuActiveClass ) ) {
                mnhaDeactivate();
            }
        } );


        // ------------------------- Deactivate on ESC Key
        $window.load( function () {
            $( document ).on( 'keyup.applicator', function ( e ) {
                if ( e.keyCode == 27 && $mnhaCp.hasClass( mainNavHeaderAsideMenuActiveClass ) ) {
                    mnhaDeactivate();
                }
            } );
        } );
        
        
    }
    initMainNavHeaderAsideMenu( $( '.main-nav--main-header-aside' ) );

})( jQuery );