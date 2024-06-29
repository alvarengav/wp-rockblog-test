import './scss/index.scss';

jQuery(document).ready(function($) {
    const $menuToggle = $('#menu-toggle');
    const $menu = $('#header__menu');
    const $searchToggle = $('#search-toggle');
    const $searchForm = $('#search-form');

    $menuToggle.on('click', function() {
        $menu.toggleClass('header__menu--open');
    });

    $searchToggle.on('click', function() {
        $searchForm.toggleClass('active');
    });
});
