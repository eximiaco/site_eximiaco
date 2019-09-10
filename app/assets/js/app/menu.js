define(function () {
    var class_icon_open = 'menu-item-has-children--icon-open',
        class_icon_close = 'menu-item-has-children--icon-close',
        class_menu_open = 'menu-item-has-children--open',
        class_submenu = 'sub-menu--open';

    function onclick_toogle_menu() {
        toggle_menu(this);
    }

    function toggle_menu(menu){
        var submenu = menu.querySelectorAll('.sub-menu')[0];

        if(submenu.classList.contains(class_submenu)){
            submenu.classList.remove(class_submenu);

            menu.classList.add(class_icon_open);
            menu.classList.remove(class_menu_open);
            menu.classList.remove(class_icon_close);
        } else {
            submenu.classList.add(class_submenu);

            menu.classList.remove(class_icon_open);
            menu.classList.add(class_menu_open);
            menu.classList.add(class_icon_close);
        }
    }

    function open_current_submenu(menu){
        var current_submenu = menu.querySelectorAll('.current_page_item');
        if(current_submenu.length > 0){
            toggle_menu(menu);
        } else {
            menu.classList.add(class_icon_open);
        }
    }


    var elements = document.querySelectorAll('.menu-item-has-children');

    elements.forEach(function (item) {
        item.addEventListener('click', onclick_toogle_menu);
        open_current_submenu(item);
    });
});
