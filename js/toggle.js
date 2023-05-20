
    function toggleSidebar() {
        var sidebar = document.querySelector('.sidebar');
        var right = document.querySelector('.right');
        sidebar.classList.toggle('collapsed');
        right.classList.toggle('uncollapsed');

    }