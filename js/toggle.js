
    function toggleSidebar() {
        var sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');
        var right = document.querySelector('.right');
        right.classList.toggle('uncollapsed');
        var right_product = document.querySelector('.right_product');
        right_product.classList.toggle('uncollapsed');

    }