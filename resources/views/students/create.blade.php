<x-layout title='FIT - Student Create'>

<div>
    <h1>Create New Student</h1>

    <form action="/students" method="POST">
        @csrf

        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            @if ($errors->has('first_name'))
                <div> {{ $errors->first('first_name') }} </div>
            @endif
        </div>

        <div>
            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name">
            @if ($errors->has('middle_name'))
                <div> {{ $errors->first('middle_name') }} </div>
            @endif
        </div>

        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
            @if ($errors->has('last_name'))
                <div> {{ $errors->first('last_name') }} </div>
            @endif
        </div>

        <div>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
            @if ($errors->has('date_of_birth'))
                <div> {{ $errors->first('date_of_birth') }} </div>
            @endif
        </div>

        <button type="submit">Create Student</button>
    </form>
</div>

</x-layout>
   