<x-layout title='FIT - Login'>

<div>
    <h1>Login</h1>

    <form action="/login" method="POST">
        @csrf

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            @if ($errors->has('email'))
                <div> {{ $errors->first('email') }} </div>
            @endif
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @if ($errors->has('password'))
                <div> {{ $errors->first('password') }} </div>
            @endif
        </div>

        <button type="submit">Login</button>
    </form>
</div>

</x-layout>
   