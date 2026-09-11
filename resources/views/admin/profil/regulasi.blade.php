@php
    $type = 'regulasi';
    $profil = $profil ?? (\App\Models\ProfilPpid::where('type', $type)->first() ?? new \App\Models\ProfilPpid(['type' => $type]));
    $pfx = str_replace('-', '_', $type);
    $settings = $settings ?? (\App\Models\Dashboard::where('key', 'like', $pfx . '_%')
        ->pluck('value', 'key')
        ->mapWithKeys(function($value, $key) use ($pfx) {
            return [str_replace($pfx . '_', '', $key) => $value];
        })->toArray());
@endphp
@include('admin.profil.edit', ['profil' => $profil, 'type' => $type, 'settings' => $settings])
