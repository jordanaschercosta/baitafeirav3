<?php
use App\Models\Enum\TipoUsuario;

if (!function_exists('isUserOrganizador')) {
    function isUserOrganizador(): bool
    {
        return session('user.tipo') === TipoUsuario::ORGANIZADOR;
    }
}

if (!function_exists('isUserExpositor')) {
    function isUserExpositor(): bool
    {
        return session('user.tipo') === TipoUsuario::EXPOSITOR;
    }
}

if (!function_exists('isUserCliente')) {
    function isUserCliente(): bool
    {
        return session('user.tipo') === TipoUsuario::CLIENTE;
    }
}

if (!function_exists('isEventOrganizador')) {
    function isEventOrganizador($eventoUserId): bool
    {
        return session('user_id') === $eventoUserId;
    }
}

if (!function_exists('isUserDonoBanca')) {
    function isUserDonoBanca($userBancaId): bool
    {
        return session('user_id') === $userBancaId;
    }
}

if (!function_exists('isProdutoFavoritado')) {
    function isProdutoFavoritado($favoritados)
    {
        foreach ($favoritados as $favoritado) {
            if (session('user_id') === $favoritado->user_id) {
                return $favoritado->id;
            }
        }

        return false;
    }
}