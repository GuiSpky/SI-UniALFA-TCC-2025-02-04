<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pedido;

class PedidoPolicy
{
    public function view(User $user, Pedido $pedido)
    {
        return $pedido->escola_id == $user->escola_id || $user->cargo == 1;
    }

    public function create(User $user)
    {
        return $user->cargo == 2;
    }

    public function update(User $user, Pedido $pedido)
    {
        if ($user->cargo == 1) return false;

        return $pedido->status === 'Editando' &&
               $pedido->escola_id == $user->escola_id;
    }

    public function enviar(User $user, Pedido $pedido)
    {
        return $user->cargo == 2 &&
               $pedido->status === 'Editando' &&
               $pedido->escola_id == $user->escola_id;
    }

    public function confirmar(User $user, Pedido $pedido)
    {
        return $user->cargo == 1 &&
               $pedido->status === 'Enviado';
    }

    public function recebido(User $user, Pedido $pedido)
    {
        return $user->cargo == 2 &&
               $pedido->status === 'Confirmado' &&
               $pedido->escola_id == $user->escola_id;
    }
}
