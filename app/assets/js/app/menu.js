/**
 * Manipulate touch and over events on main navigation items with children
 */
define(function () {

    /**
     * Opened sub menu state class
     */
    var opened_class = 'menu-item--opened';

    /**
     * Class that represent menu items with children
     */
    var hasChildrenClass = 'menu-item-has-children';

    /**
     * Menu elements with children
     */
    var hasChildrenItems = document.querySelector('.main-navigation').querySelectorAll('.' + hasChildrenClass);

    /**
     * Event callback to toggle menu
     *
     * @param {TouchEvent} event
     */
    function toggle_submenu_event(event) {
        // Ignore touch event when a sub item is touched
        if( ! event.target.parentElement.classList.contains('menu-item-has-children') ) {
            return true;
        }

        event.preventDefault();
        toggle_submenu(this);
        return false;
    }

    /**
     * Event callback when enter on menu item with mouse pointer
     */
    function enter_event() {
        open(this);
    }

    /**
     * Envent callback when leave the menu item with mouse pointer
     */
    function leave_event() {
        close(this);
    }

    /**
     * Toggle opened state
     *
     * @param {HTMLLIElement} menu
     */
    function toggle_submenu(item) {
        if(item.classList.contains(opened_class)){
            item.classList.remove(opened_class);
        } else {
            item.classList.add(opened_class);
        }
    }

    /**
     * Set opened state as true
     *
     * @param {HTMLLIElement} item
     */
    function open(item) {
        if(item.classList.contains(opened_class)){
            return;
        }

        item.classList.add(opened_class);
    }

    /**
     * Set opened state as true
     *
     * @param {HTMLLIElement} item
     */
    function close(item) {
        if(!item.classList.contains(opened_class)){
            return;
        }

        item.classList.remove(opened_class);
    }

    /**
     * Add event listeners for all main navigation that has children
     */
    hasChildrenItems.forEach(function (item) {
        item.addEventListener('touchstart', toggle_submenu_event);
        item.addEventListener('mouseover', enter_event);
        item.addEventListener('mouseout', leave_event);
    });
});
