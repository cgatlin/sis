<div class="navbar bg-base-100 shadow-sm">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl" href="/">FIT</a>
  </div>
  <div class="flex-none">
    <ul class="menu menu-horizontal px-1">
        @guest
            <li><a class="btn bg-primary text-black border-[#e5e5e5]" href="/login">Login</a></li>
        @endguest
        @auth
            <li><a class="link link-secondary text-lg" href="/courses">Courses</a></li>
            <li><a class="link link-secondary text-lg" href="/students">Students</a></li>
            <li><a class="link link-secondary text-lg" href="/staff">Staff</a></li>
            <li><a class="link link-secondary text-lg" href="/dashboard">Dashboard</a></li>
            <li>
                <form action="/logout" method="POST" id="logout">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-soft btn-secondary btn-sm" type="submit">Logout</button>
                </form>
            </li>   
         @endauth
    </ul>
  </div>
</div>