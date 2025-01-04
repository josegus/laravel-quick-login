<form action="{{ route('quick-login.login-as') }}" method="post">
    @csrf

    <input type="text" class="hidden" name="model" value="{{ $model }}">
    <input type="text" class="hidden" name="guard" value="{{ $guard }}">
    <input type="text" class="hidden" name="redirect_to" value="{{ $redirectTo }}">

    <select onchange="this.closest('form').submit()" name="selected-model" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
        <option>-- Select --</option>
        @foreach ($users as $user)
            <option value="{{ $user->{$primaryKey} }}">{{ $user->{$displayedAttribute} }}</option>
        @endforeach
    </select>

    @isset ($errors)
        <span class="text-red-500 text-sm">{{ $errors->first('selected-model') }}</span>
    @endisset
</form>

<form action="{{ route('quick-login.create-user') }}" method="post" class="mt-2 text-right">
    @csrf

    <input type="text" class="hidden" name="model" value="{{ $model }}">
    <input type="text" class="hidden" name="guard" value="{{ $guard }}">
    <input type="text" class="hidden" name="redirect_to" value="{{ $redirectTo }}">

    @foreach ($factoryStates ?? [] as $state)
        <input type="text" class="hidden" name="factory_states[]" value="{{ $state }}">
    @endforeach

    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login with new user</button>
</form>
