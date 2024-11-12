<x-base-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-logos.main class="w-32" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Field -->
            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Email Field -->
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Username Field -->
            <div class="mt-4">
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block w-full mt-1" type="text" name="username" :value="old('username')" required />
                <button type="button" class="mt-2 text-blue-500" data-toggle="modal" data-target="#usernameModal">Check Username Availability</button>
            </div>

            <!-- Password Field -->
            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password Field -->
            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm text-gray-600 underline hover:text-gray-900">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm text-gray-600 underline hover:text-gray-900">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-buttons.primary class="ml-4">
                    {{ __('Register') }}
                </x-buttons.primary>
            </div>
        </form>
    </x-jet-authentication-card>

    <!-- Username Check Modal -->
    <div class="modal fade" id="usernameModal" tabindex="-1" role="dialog" aria-labelledby="usernameModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usernameModalLabel">Check Username Availability</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="check_username">Enter Username:</label>
                    <input type="text" class="form-control" id="check_username">
                    <button class="btn btn-primary mt-3" id="check_username_btn">Check</button>
                    <p id="username_status"></p>
                </div>
            </div>
        </div>
    </div>

</x-base-layout>

<script>
    // Check Username Availability
    document.getElementById('check_username_btn').addEventListener('click', function() {
        var username = document.getElementById('check_username').value;

        if (username) {
            // Make AJAX request to check if username exists
            fetch('/check-username/' + username)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        document.getElementById('username_status').innerText = "Username is already taken!";
                        document.getElementById('username_status').style.color = 'red';
                    } else {
                        document.getElementById('username_status').innerText = "Username is available!";
                        document.getElementById('username_status').style.color = 'green';
                        document.getElementById('username').value = username;  // Set username input field
                    }
                });
        }
    });
</script>
