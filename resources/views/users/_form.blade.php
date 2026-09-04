@php
    $isEdit = isset($user);
@endphp

<form action="{{ $isEdit ? route('users.update', $user) : route('users.store') }}" method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
               id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror"
               id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">
            Contraseña {{ $isEdit ? '(opcional)' : '' }}
        </label>
        <div class="input-group">
            <input type="text" class="form-control @error('password') is-invalid @enderror"
                   id="password" name="password" minlength="12" {{ $isEdit ? '' : 'required' }}
                   autocomplete="new-password" placeholder="Mínimo 12 caracteres">
            <button type="button" class="btn btn-outline-secondary" id="generate-password"
                    title="Generar contraseña robusta" aria-label="Generar contraseña robusta">🔐</button>
            <button type="button" class="btn btn-outline-secondary" id="copy-password"
                    title="Copiar contraseña" aria-label="Copiar contraseña">📋</button>
        </div>
        <div id="copy-feedback" class="form-text" role="status" aria-live="polite"></div>
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
        @if($isEdit)
            <small class="text-muted">Déjala vacía para conservar la contraseña actual.</small>
        @else
            <small class="text-muted">Usa el botón 🔐 para generar una contraseña segura.</small>
        @endif
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
        <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror"
               id="password_confirmation" name="password_confirmation" minlength="12"
               {{ $isEdit ? '' : 'required' }} autocomplete="new-password">
        @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <button type="submit" class="btn btn-gold">
            <i class="bi bi-save"></i> {{ $isEdit ? 'Actualizar usuario' : 'Crear usuario' }}
        </button>
    </div>
</form>

<script>
    (() => {
        const passwordInput = document.getElementById('password');
        const confirmationInput = document.getElementById('password_confirmation');
        const feedback = document.getElementById('copy-feedback');
        const alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%^&*()_+-=[]{}';

        function randomCharacter(characters) {
            const values = new Uint32Array(1);
            crypto.getRandomValues(values);
            return characters[values[0] % characters.length];
        }

        function generatePassword() {
            const groups = [
                'ABCDEFGHJKLMNPQRSTUVWXYZ',
                'abcdefghijkmnopqrstuvwxyz',
                '23456789',
                '!@#$%^&*()_+-=[]{}'
            ];
            const password = groups.map(randomCharacter);

            while (password.length < 16) {
                password.push(randomCharacter(alphabet));
            }

            for (let index = password.length - 1; index > 0; index -= 1) {
                const swapIndex = new Uint32Array(1);
                crypto.getRandomValues(swapIndex);
                const randomPosition = swapIndex[0] % (index + 1);
                [password[index], password[randomPosition]] = [password[randomPosition], password[index]];
            }

            return password.join('');
        }

        document.getElementById('generate-password').addEventListener('click', () => {
            const generatedPassword = generatePassword();
            passwordInput.value = generatedPassword;
            confirmationInput.value = generatedPassword;
            feedback.textContent = 'Contraseña generada. Cópiala antes de guardar si la necesitas.';
            feedback.className = 'form-text text-success';
        });

        document.getElementById('copy-password').addEventListener('click', async () => {
            if (!passwordInput.value) {
                feedback.textContent = 'Genera o escribe una contraseña primero.';
                feedback.className = 'form-text text-warning';
                return;
            }

            try {
                await navigator.clipboard.writeText(passwordInput.value);
                feedback.textContent = 'Contraseña copiada al portapapeles.';
                feedback.className = 'form-text text-success';
            } catch (error) {
                feedback.textContent = 'No se pudo copiar automáticamente. Selecciona la contraseña y cópiala manualmente.';
                feedback.className = 'form-text text-warning';
            }
        });
    })();
</script>
