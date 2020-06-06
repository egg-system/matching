<div class="position-absolute" style="top: 0;left:0;"></div>
<nav class="navbar navbar-dark align-items-start vh-100 bg-secondary position-sticky" style="top: 0;">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-text mx-3">
                <span>{{ config('app.name') }}</span>
            </div>
        </a>
        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ route('gym.trainerList') }}">
                    <i class="fas fa-home"></i>
                    <span>トレーナー一覧</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
