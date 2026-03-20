
<a class="btn btn-ghost text-xl" href="/">FIT</a>

<div class="navbar-end hidden lg:flex">
    @guest
        <a href="/login">Login</a>
    @endguest
    
    @auth
        <form action="/logout" method="POST" id="logout">
            @csrf
            @method('DELETE')
            <button type="submit">Logout</button>
        </form>
    @endauth
</div>