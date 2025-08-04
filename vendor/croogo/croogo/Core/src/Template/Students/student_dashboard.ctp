
<style>
    @media (min-width: 768px) {
        #sidebarCollapse {
            display: none;
        }
    }

    .content-section {
        display: none;
    }

    .content-section.active {
        display: block;
    }
</style>

<div class="d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="#" id="dashboard-link" data-content="dashboard-content"><span class="fa fa-dashboard mr-3"></span>Dashboard</a>
            </li>
            <li>
                <a href="#" id="attendance-link" data-content="attendance-content"><span class="fa fa-sticky-note mr-3"></span>Attendance</a>
            </li>
            <li>
                <a href="#" id="result-link" data-content="result-content"><span class="fa fa-certificate mr-3"></span>Result</a>
            </li>
            <li>
                <a href="#" id="accounts-link" data-content="accounts-content"><span class="fa fa-money mr-3"></span>Accounts</a>
            </li>
            <li>
                <a href="#" id="personal-info-link" data-content="personal-info-content"><span class="fa fa-user-circle mr-3"></span>Personal Info</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-3 pl-4">
        <div class="content-section active" id="dashboard-content">
            <?= $this->element('user_dashboard'); ?>
        </div>
        <div class="content-section" id="attendance-content">
            <?= $this->element('user_attendance'); ?>
        </div>
        <div class="content-section" id="result-content">
            <?= $this->element('user_result'); ?>
        </div>
        <div class="content-section" id="accounts-content">
            <?= $this->element('user_accounts'); ?>
        </div>
        <div class="content-section" id="personal-info-content">
            <?= $this->element('user_informations'); ?>
        </div>
    </div>

    <script>
        (function($) {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });

            // Add click event handlers for the links
            $('.list-unstyled.components a').click(function(e) {
                e.preventDefault();
                var contentId = $(this).data('content');

                // Remove the "active" class from all li elements
                $('.list-unstyled.components li').removeClass('active');

                // Add the "active" class to the parent li element of the clicked link
                $(this).parent('li').addClass('active');

                // Remove the "active" class from all content sections
                $('.content-section').removeClass('active').hide();

                // Add the "active" class to the clicked content section and show it
                $('#' + contentId).addClass('active').show();
            });
        })(jQuery);
    </script>
</div>
