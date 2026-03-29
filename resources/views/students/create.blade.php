<x-layout title='FIT - Student Create'>

<div class="flex items-center justify-center bg-gray-100">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-2" action="/students" method="POST">
        <h1 class="block text-sm font-bold mb-2">Create New Student:</h1>
        @csrf

            <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="text" id="first_name" name="first_name" placeholder="First Name:" required>
            </label>
            @if ($errors->has('first_name'))
                <div> {{ $errors->first('first_name') }} </div>
            @endif

            <label class="block text-gray-700 text-sm font-bold mb-2" for="middle_name">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="text" id="middle_name" name="middle_name" placeholder="Middle Name:">
            </label>
            @if ($errors->has('middle_name'))
                <div> {{ $errors->first('middle_name') }} </div>
            @endif

            <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="text" id="last_name" name="last_name" placeholder="Last Name:" required>
            </label
            @if ($errors->has('last_name'))
                <div> {{ $errors->first('last_name') }} </div>
            @endif

            <label class="block text-gray-700 text-sm font-bold mb-2" for="date_of_birth">
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"  type="date" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth:" required>
            </label>
            @if ($errors->has('date_of_birth'))
                <div> {{ $errors->first('date_of_birth') }} </div>
            @endif

        <button class="btn btn-soft btn-secondary" type="submit">Create Student</button>
    </form>
</div>

</x-layout>
   