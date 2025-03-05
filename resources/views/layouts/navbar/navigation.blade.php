<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Navigation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="{{asset('asset/image.png')}}" alt="Logo" class="img-fluid">
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="#" class="d-flex align-items-center">
                    <i class="bi bi-speedometer"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="d-flex align-items-center dropdown-toggle">
                    <i class="bi bi-person-fill"></i> User Management
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="d-flex align-items-center ">Employee</a></li>
                    <li><a href="#" class="d-flex align-items-center ">Role</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="d-flex align-items-center dropdown-toggle">
                    <i class="bi bi-graph-up"></i> Finance Management
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="d-flex align-items-center ">Budget</a></li>
                    <li><a href="#" class="d-flex align-items-center ">Reports</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let dropdownToggles = document.querySelectorAll(".dropdown-toggle");

            dropdownToggles.forEach(function (toggle) {
                toggle.addEventListener("click", function (event) {
                    event.preventDefault();
                    
                    let menu = toggle.nextElementSibling;

                    // Tutup semua dropdown kecuali yang diklik
                    document.querySelectorAll(".dropdown-menu").forEach(function (otherMenu) {
                        if (otherMenu !== menu) {
                            otherMenu.style.display = "none";
                        }
                    });

                    // Toggle tampilan dropdown yang diklik
                    menu.style.display = (menu.style.display === "block") ? "none" : "block";
                });
            });

            // Tutup dropdown saat klik di luar sidebar
            document.addEventListener("click", function (event) {
                if (!event.target.closest(".sidebar")) {
                    document.querySelectorAll(".dropdown-menu").forEach(function (menu) {
                        menu.style.display = "none";
                    });
                }
            });
        });
    </script>
</body>
</html>
