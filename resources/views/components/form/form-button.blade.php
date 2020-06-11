<form method="POST" action="{{ $action }}">
    @csrf
    @method($method ?? 'POST')
        <button
            type="submit"
            class="btn {{ $class ?? 'btn-teal' }}"
        >
            {{ $slot }}
        </button>
</form>
