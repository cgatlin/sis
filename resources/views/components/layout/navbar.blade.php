<div class="navbar bg-base-100 shadow-sm p-4">
  <div class="flex-1"> 
    <a class="btn btn-ghost text-xl" href="/">
      <img class="w-auto h-20" src="{{ asset('build/assets/img/mascot.png') }}" alt="logo">
      <div>
        <p>Fantasy Institute of Technology</p>
        <p>Home of the Griffins!!!</p>
      </div>
    </a>
  </div>
  <div class="flex-none">
    <ul class="menu menu-horizontal px-1">
        @guest
            <li><a class="btn btn-soft btn-secondary" href="/login">Login</a></li>
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