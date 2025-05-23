<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/adminStructure.css') }}">
    @yield('headerlinks')

</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">{{ Auth::user()->name }}</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="{{ url('role') }}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Roles</span>
                </a>
                <span class="tooltip">Roles</span>
            </li>
            <li>
                <a href="{{ url('worker') }}">
                    <i class='bx bx-group'></i>
                    <span class="links_name">Workers</span>
                </a>
                <span class="tooltip">Workers</span>
            </li>
            <li>
                <a href="{{ url('department') }}">
                    <i class='bx bx-buildings'></i>
                    <span class="links_name">Departments</span>
                </a>
                <span class="tooltip">Departments</span>
            </li>
            <li>
                <a href="{{ url('equipment') }}">
                    <i class='fa fa-tools'></i>
                    <span class="links_name">Equipments</span>
                </a>
                <span class="tooltip">Equipments</span>
            </li>
            <li>
                <a href="{{ url('maintenance') }}">
                    <i class='bx bx-history'></i>
                    <span class="links_name">Maintenance</span>
                </a>
                <span class="tooltip">Maintenance</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>

        </ul>
    </div>

    <section class="home-section">
        {{-- <div class="text">Dashboard</div> --}}
        <main class="">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">{{ $heading }}</h1>

                <div class="d-flex align-items-center gap-3">
                    <div class="position-relative">
                        <a href="#" class="text-dark" id="notificationBell">
                            <i class="fas fa-bell fa-lg"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                5
                            </span>
                        </a>
                    </div>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-dark text-decoration-none" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="#">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="confirmLogout()">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <form action="" id="myform" name="myform" enctype="multipart/form-data" method="POST">
                @csrf
                @method('')
                @yield('content')
            </form>
        </main>
    </section>
</body>
@yield('footerlinks')
<script src="{{ asset('js/script.js') }}"></script>

<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    })

    searchBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange();
    })

    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    }

    menuBtnChange();

    // logout alert
    function confirmLogout() {
        Swal.fire({
            title: "Logout",
            text: "Are you sure you want to logout?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: "Confirm",
            denyButtonText: "Cancel",
            closeOnConfirm: false,
        }).then(function(t) {
            if (t.isConfirmed) {
                $('input[name="_method"]').val("POST");
                $("#myform").attr("action", "logout");
                $("#myform").submit();
            }
        });
    }
</script>

</html>
