

/*WOW Animation*/
wow = new WOW({
//	boxClass:     'wow',
//	animateClass: 'animated',
//	offset:       0,
    mobile:       true
//	live:         true
});
wow.init();

/*Footer Overall page*/
$("#tek-footer").load("footer.html");
$(document).ready(function () {
    $("#tek-header").load("/header.html", function () {
        let currentPage = window.location.pathname; // Get current page
        let isSubPage = false;

        // Check and add 'active' class to the main nav-link
        $('.nav-link').each(function () {
            if ($(this).attr('href') === currentPage) {
                $(this).addClass('jmi-active');
                isSubPage = true;
            }
        });

        // Handle subpages for multiple dropdowns (e.g., Services and Who We Serve)
        if (!isSubPage) { // If no direct match, check subpages
            ['#jmi-techno-serv-nav', '#jmi-finan-serv-nav', '#jmi-digi-trans-nav', '#jmi-industries-nav'].forEach(function (dropdownId) {
                $(dropdownId).siblings('.dropdown-menu').find('a').each(function () {
                    if ($(this).attr('href') === currentPage) {
                        $(this).addClass('jmi-active'); // Highlight the subpage
                        $(dropdownId).addClass('jmi-active'); // Highlight the parent dropdown
                        isSubPage = true;
                    }
                });
            });
        }
    });

});