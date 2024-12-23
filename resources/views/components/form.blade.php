<form action="{{ route('quick-login.login-as') }}" method="post">
    @csrf
    <select onchange="console.log(this.closest('form').submit())" name="model_id">
        <option>--Select--</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->email }}</option>
        @endforeach
    </select>
</form>

<form action="{{ route('quick-login.create-user') }}" method="post">
    @csrf
    <button type="submit">New user</button>
</form>
