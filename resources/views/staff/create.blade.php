<x-layout title='FIT - Staff Create'>

<div>
    <h1>Create New Staff</h1>

    <form action="/staff" method="POST">
        @csrf

        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>
            @if ($errors->has('name'))
                <div> {{ $errors->first('name') }} </div>
            @endif
        </div>

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

        <button type="submit">Create Staff</button>
    </form>
</div>

</x-layout>
   