@props ([
    'user',
])

<x-layout title='FIT - EDit Staff'>

<div>
    <h1>Edit Staff</h1>

    <form action="/staff/{{ $user->id }}" method="POST">
        @csrf

        @method('PATCH')

        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required value="{{ $user->name ?? '' }}">
            @if ($errors->has('name'))
                <div> {{ $errors->first('name') }} </div>
            @endif
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email ?? '' }}">
            @if ($errors->has('email'))
                <div> {{ $errors->first('email') }} </div>
            @endif
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="{{ $user->password ?? '' }}">
            @if ($errors->has('password'))
                <div> {{ $errors->first('password') }} </div>
            @endif
        </div>

        <button type="submit">Save Update</button>
    </form>
</div>

</x-layout>
   