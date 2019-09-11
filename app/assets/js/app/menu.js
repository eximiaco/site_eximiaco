define(function () {
    var class_submenu = 'sub-menu--open',
        class_prefix = 'menu-item-has-children',
        class_opened = 'menu-item-has-children--opened';


    function onclick_toogle_menu(event, menu) {
        if (event.target.classList.contains('menu-item-has-children')){
            event.preventDefault();
        }
        toggle_menu(menu);
    }

    function toggle_menu(menu){
        var submenu = menu.querySelectorAll('.sub-menu')[0],
            a = menu.getElementsByTagName('a')[0];


        if(submenu.classList.contains(class_submenu)){
            submenu.classList.remove(class_submenu);
            a.classList.remove(class_opened);
        } else {
            submenu.classList.add(class_submenu);
            a.classList.add(class_opened);
        }
    }

    function open_current_submenu(menu){
        var current_submenu = menu.querySelectorAll('.current_page_item'),
            a = menu.getElementsByTagName('a')[0];

        a.classList.add(class_prefix);

        if(jQuery(window).width() < 897 && current_submenu.length > 0){
            toggle_menu(menu);
        } else if(current_submenu.length > 0) {
            menu.classList.add('current-menu-item');
        }
    }

    var elements = document.querySelectorAll('.menu-item-has-children');

    elements.forEach(function (item) {
        item.addEventListener('click', function(event){
            onclick_toogle_menu(event, this);
        });

        // item.addEventListener('mouseover', function(){
        //     var ul = this.querySelector('.sub-menu');

        //     ul.classList.add(class_submenu);

        //     ul.addEventListener('mouseout', function(event){
        //         console.log(event.target);
        //     });
        //  });

        open_current_submenu(item);
    });
});
