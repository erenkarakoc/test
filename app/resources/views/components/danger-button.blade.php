<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-sm btn-danger text-white']) }}>
  {{ $slot }}
</button>
