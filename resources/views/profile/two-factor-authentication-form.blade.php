<x-action-section>
  <x-slot name="title">
    {{ __('2FA') }}
  </x-slot>

  <x-slot name="description">
    {{ __('Add additional security to your account using two factor authentication.') }}
  </x-slot>

  <x-slot name="content">
    <h6>
      @if ($this->enabled)
        @if ($showingConfirmation)
          {{ __('You are enabling two factor authentication.') }}
        @else
          {{ __('You have enabled two factor authentication.') }}
        @endif
      @else
        {{ __('You have not enabled two factor authentication.') }}
      @endif
    </h6>

    <p class="card-text">
      {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token with an authenticator application (eg. Google Authenticator).') }}
    </p>

    @if ($this->enabled)
      @if ($showingQrCode)
        <p class="card-text mt-2">
          @if ($showingConfirmation)
            {{ __('Scan the following QR code using your phone\'s authenticator application and confirm it with the generated OTP code.') }}
          @else
            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
          @endif
        </p>

        <div class="row">
          <div class="col col-md-6">
            <div class="mt-2 twofa-qr-code">
              {!! $this->user->twoFactorQrCodeSvg() !!}
            </div>
          </div>

          <div class="col col-md-6">
            <div class="mt-2">
              <small class="fw-medium">
                {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
              </small>
            </div>

            @if ($showingConfirmation)
              <div class="mt-4">
                <x-label for="code" value="{{ __('OTP Code') }}" />
                <x-input id="code" class="d-block mt-3 w-100" type="text" inputmode="numeric" name="code"
                  autofocus autocomplete="one-time-code" wire:model="code"
                  wire:keydown.enter="confirmTwoFactorAuthentication" />
                <x-input-error for="code" class="mt-3" />
              </div>
            @endif

            <div class="d-flex justify-content-end column-gap-2 mt-4">
              <x-confirms-password wire:then="disableTwoFactorAuthentication">
                <x-danger-button wire:loading.attr="disabled">
                  {{ __('Cancel') }}
                </x-danger-button>
              </x-confirms-password>

              @if ($showingRecoveryCodes)
                <x-confirms-password wire:then="regenerateRecoveryCodes">
                  <x-secondary-button class="me-1">
                    {{ __('Regenerate Recovery Codes') }}
                  </x-secondary-button>
                </x-confirms-password>
              @elseif ($showingConfirmation)
                <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                  <x-button type="button" wire:loading.attr="disabled">
                    {{ __('Confirm') }}
                  </x-button>
                </x-confirms-password>
              @else
                <x-confirms-password wire:then="showRecoveryCodes">
                  <x-secondary-button class="me-1">
                    {{ __('Show Recovery Codes') }}
                  </x-secondary-button>
                </x-confirms-password>
              @endif
            </div>
          </div>
        </div>
      @endif

      @if ($showingRecoveryCodes)
        <p class="card-text mt-2">
          {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
        </p>

        <div class="row row-gap-2 bg-light rounded p-2">
          @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
            <div class="input-group p-0">
              <input class="form-control py-0" value="{{ $code }}" readonly></input>
              <span class="input-group-text py-0">
                <button class="btn btn-sm btn-icon d-flex align-items-center copy-recovery-code" type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M6.6 11.397c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c2.715 0 4.073 0 4.916.847c.844.847.844 2.21.844 4.936v4.82c0 2.726 0 4.089-.844 4.936c-.843.847-2.201.847-4.916.847h-2.88c-2.716 0-4.073 0-4.917-.847s-.843-2.21-.843-4.936z" />
                    <path fill="currentColor"
                      d="M4.172 3.172C3 4.343 3 6.229 3 10v2c0 3.771 0 5.657 1.172 6.828c.617.618 1.433.91 2.62 1.048c-.192-.84-.192-1.996-.192-3.66v-4.819c0-2.726 0-4.089.843-4.936c.844-.847 2.201-.847 4.917-.847h2.88c1.652 0 2.8 0 3.638.19c-.138-1.193-.43-2.012-1.05-2.632C16.657 2 14.771 2 11 2S5.343 2 4.172 3.172"
                      opacity=".5" />
                  </svg>
                </button>
              </span>
            </div>
          @endforeach
        </div>
      @endif
    @endif

    @if (!$this->enabled)
      <x-confirms-password wire:then="enableTwoFactorAuthentication">
        <x-button type="button" wire:loading.attr="disabled">
          {{ __('Enable') }}
        </x-button>
      </x-confirms-password>
    @endif

    @if ($this->enabled && !$showingRecoveryCodes && !$showingConfirmation)
      <x-confirms-password wire:then="disableTwoFactorAuthentication">
        <x-danger-button wire:loading.attr="disabled">
          {{ __('Disable 2FA') }}
        </x-danger-button>
      </x-confirms-password>
    @endif
  </x-slot>
</x-action-section>
