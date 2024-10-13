<aside class="left-sidebar" style="background-color: #343a40; ">
    <div class="scroll-sidebar">
        <!-- User Profile Section -->
        <div class="user-profile text-center" style=" color: #ecf0f1;">
                <a class=" pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/' .Auth::user()->img) }}" alt="{{ Auth::user()->name }}" class="rounded-circle" width="100" />
                </a>
            <h5 class="mt-2">{{ Auth::user()->name }}</h5>
            <p class="mb-0">{{ Auth::user()->email }}</p>
        </div>

        <!-- Sidebar navigation -->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" >
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('posts.index') }}" aria-expanded="false">
                        <i class="mdi mdi-receipt"></i>
                        <span class="hide-menu">Posts</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('categories.index') }}" aria-expanded="false">
                        <i class="mdi mdi-label"></i>
                        <span class="hide-menu">Categories</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('comments.index') }}" aria-expanded="false">
                        <i class="mdi mdi-comment-text"></i>
                        <span class="hide-menu">Comments</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">
                        <i class="mdi fa-user"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('logout') }}" aria-expanded="false">
                        <i class="mdi mdi-logout"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll -->
</aside>

<style>
    .left-sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        z-index: 9999;
        transition: background-color 0.3s ease;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5); /* Shadow for depth */
        /* padding: 0; */
        margin:0;
        box-sizing: border-box
    }

    /* .scroll-sidebar {
        overflow-y: auto; /* Allow scrolling */
        height: calc(100vh - 100px); /* Adjust height for user profile */
    } */

    /* .user-profile {
        background-color: #34495e; /* Dark background for user profile */
        border-radius: 8px; /* Rounded corners */
        margin-bottom: 20px; /* Space below user profile */
        transition: background-color 0.3s;
    } */

    .user-profile:hover {
        background-color:#195591; /* Highlight on hover */
    }

    .sidebar-nav {
        padding-top: 5px;
    }

    .sidebar-item {
        margin-bottom: 5px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #ecf0f1;
        transition: background-color 0.3s, color 0.3s;
        border-radius: 8px; /* Rounded corners for links */
    }

    .sidebar-link:hover {
        background-color:#195591; /* Accent color on hover */
        color: #fff; /* Change text color on hover */
    }

    .mdi {
        margin-right: 15px;
        font-size: 22px; /* Slightly larger icons */
    }
</style>
