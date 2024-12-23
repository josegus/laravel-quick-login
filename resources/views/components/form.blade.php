<form action="{{ route('quick-login.login-as') }}" method="post">
    @csrf
    <select onchange="console.log(this.closest('form').submit())" name="model_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
        <option>--Select--</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->email }}</option>
        @endforeach
    </select>
</form>

<form action="{{ route('quick-login.create-user') }}" method="post" class="text-right">
    @csrf
    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login with new user</button>
</form>
