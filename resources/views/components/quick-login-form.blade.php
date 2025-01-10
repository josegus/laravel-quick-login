<form action="{{ route('quick-login.as-existing-user') }}" method="post">
    @csrf

    <input type="text" class="hidden" name="model" value="{{ $model }}">
    <input type="text" class="hidden" name="guard" value="{{ $guard }}">
    <input type="text" class="hidden" name="redirect_to" value="{{ $redirectTo }}">

    <select onchange="this.closest('form').submit()" name="selected_model" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
        <option>-- Select --</option>
        @foreach ($users as $user)
            <option value="{{ $user->{$user->getKeyName()} }}">{{ $user->{$displayedAttribute} }}</option>
        @endforeach
    </select>

    @isset ($errors)
        <span class="text-red-500 text-sm">{{ $errors->first('selected_model') }}</span>
    @endisset
</form>

<form action="{{ route('quick-login.as-new-user') }}" method="post" class="mt-2 text-right">
    @csrf

    <input type="text" class="hidden" name="model" value="{{ $model }}">
    <input type="text" class="hidden" name="guard" value="{{ $guard }}">
    <input type="text" class="hidden" name="redirect_to" value="{{ $redirectTo }}">

    @foreach ($factoryStates ?? [] as $state)
        <input type="text" class="hidden" name="factory_states[]" value="{{ $state }}">
    @endforeach

    <input type="text" class="hidden" name="model_attributes" value="{{ json_encode($modelAttributes) }}">

    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login with new user</button>
</form>
