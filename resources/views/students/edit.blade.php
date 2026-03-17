@props ([
    'student',
])

<x-layout title='FIT - EDit Student'>

<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>

<div>
    <h1>Edit Student</h1>

    <form action="/students/{{ $student->id }}" method="POST">
        @csrf

        @method('PATCH')

        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required value="{{ $student->first_name ?? '' }}">
        </div>

        <div>
            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name" value="{{ $student->middle_name ?? '' }}">
        </div>

        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required value="{{ $student->last_name ?? '' }}">
        </div>

        <div>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required value="{{ $student->date_of_birth ?? '' }}">
        </div>

        <button type="submit">Save Update</button>
    </form>
</div>

</x-layout>
   