var admin = {
    site_url: null,
    page_url: null,
    handle_active_sidebar_menu: function(){
        const currentUrl = new URL(window.location.href);
        const pathName = currentUrl.pathname;
        const pathSegments = pathName.split('/');

        let url = currentUrl.origin;
        if(typeof pathSegments[1] == 'string'){
            url += ('/' + pathSegments[1]);
        }
        
        let active_menu = $('.sidebar-menu').find('a[href="' + url + '"]');
        if(active_menu.length > 0) active_menu.closest('li').addClass('active');

        if(active_menu.closest('li').hasClass('submenu-item')){
            active_menu.closest('ul.submenu').addClass('submenu-open');
            active_menu.closest('li.sidebar-item').addClass('active');
        }
    },
    init: function(){
        this.handle_active_sidebar_menu();

        const currentUrl = new URL(window.location.href);
        this.site_url = currentUrl.origin;
        this.page_url = currentUrl.href;
    }
}

$(document).ready(function(){
    admin.init();
})