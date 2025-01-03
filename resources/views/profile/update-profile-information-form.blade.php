<x-form-section submit="updateProfileInformation">
  <x-slot name="title">
    {{ __('Profile Information') }}
  </x-slot>

  <x-slot name="description">
    {{ __('Update your account\'s profile information.') }}
  </x-slot>

  <x-slot name="form">
    <div class="row">
      <!-- Username -->
      <div class="col col-md-6">
        <x-label class="form-label" for="username" value="{{ __('Username') }}" />
        <x-input id="username" type="text" class="{{ $errors->has('username') ? 'is-invalid' : '' }}"
          wire:model="state.username" autocomplete="username" />
        <x-input-error for="username" />
      </div>

      <!-- Email -->
      <div class="col col-md-6">
        <x-label class="form-label" for="email" value="{{ __('E-mail Address') }}" />
        <x-input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
          wire:model="state.email" />
        <x-input-error for="email" />
      </div>
    </div>
  </x-slot>

  <x-slot name="actions">
    <div class="d-flex align-items-baseline mt-6">
      <x-button>
        {{ __('Save') }}
      </x-button>
    </div>
  </x-slot>

  <x-action-message on="saved">
    {{ __('Saved.') }}
  </x-action-message>
</x-form-section>
