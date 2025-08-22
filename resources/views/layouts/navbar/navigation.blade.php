<div class="d-flex flex-column vh-100 bg-danger px-4 py-3 text-white"
    style="width: 302px; position: fixed; left: 0; top: 0;">
    <div class="d-flex justify-content-center mb-4">
        <img src="{{ asset('asset/image.png') }}" alt="Logo" class="img-fluid" style="max-width: 300px;">
    </div>
    <ul class="nav flex-column fw-normal">
        <li class="nav-item mb-2">
            <a href="{{ url('/dashboard') }}"
                class="nav-link text-white d-flex align-items-center rounded px-3 py-2
                {{ Request::is('dashboard') ? 'active bg-white bg-opacity-25' : '' }}">
                <i class="bi bi-speedometer me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white d-flex align-items-center rounded px-3 py-2 dropdown-toggle"
                data-bs-toggle="collapse" data-bs-target="#userMenu">
                <i class="bi bi-person-fill me-2"></i> User Management
            </a>
            <ul class="collapse list-unstyled ps-4 {{ Request::is('role') ? 'show' : '' }}" id="userMenu">
                <li>
                    <a href="{{ url('/role') }}"
                        class="nav-link text-white d-flex align-items-center px-2 py-1
                        {{ Request::is('/role') ? 'active bg-white bg-opacity-25' : '' }}">
                        Role
                    </a>
                </li>
                <li>
                    <a href="{{ url('/user') }}"
                        class="nav-link text-white d-flex align-items-center px-2 py-1
                        {{ Request::is('/user') ? 'active bg-white bg-opacity-25' : '' }}">
                        User
                    </a>
                </li>
                <li>
                    <a href="{{ url('/student') }}"
                        class="nav-link text-white d-flex align-items-center px-2 py-1
                        {{ Request::is('/student') ? 'active bg-white bg-opacity-25' : '' }}">
                        Student
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white d-flex align-items-center rounded px-3 py-2 dropdown-toggle"
                data-bs-toggle="collapse" data-bs-target="#financeMenu">
                <i class="bi bi-graph-up me-2"></i> Finance Management
            </a>
            <ul class="collapse list-unstyled ps-4 {{ Request::is('employee') ? 'show' : '' }}" id="financeMenu">
                <li>
                    <a href="{{ url('/employee') }}"
                        class="nav-link text-white d-flex align-items-center px-2 py-1
                        {{ Request::is('employee') ? 'active bg-white bg-opacity-25' : '' }}">
                        Employee
                    </a>
                </li>
                <li>
                    <a href="{{ url('/payroll') }}"
                        class="nav-link text-white d-flex align-items-center px-2 py-1
                        {{ Request::is('payroll') ? 'active bg-white bg-opacity-25' : '' }}">
                        Payroll
                    </a>
                </li>
                <li><a href="#" class="nav-link text-white d-flex align-items-center px-2 py-1">Budget</a></li>
                <li><a href="#" class="nav-link text-white d-flex align-items-center px-2 py-1">Reports</a></li>
            </ul>
        </li>
        <li class="nav-item mt-4 mb-2">
            <span class="small text-uppercase opacity-75">Other</span>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white d-flex align-items-center rounded px-3 py-2">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white d-flex align-items-center rounded px-3 py-2">
                <i class="bi bi-question-circle me-2"></i> Help
            </a>
        </li>
    </ul>
</div>
