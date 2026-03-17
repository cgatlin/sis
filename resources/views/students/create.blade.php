<x-layout title='FIT - Student Create'>

<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>

<div>
    <h1>Create Student</h1>

    <form action="/students" method="POST">
        @csrf

        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>

        <div>
            <label for="middle_name">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name">
        </div>

        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>

        <div>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
        </div>

        <button type="submit">Create Student</button>
    </form>
</div>

</x-layout>
   