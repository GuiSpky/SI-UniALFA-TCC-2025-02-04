<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pedido;

class PedidoPolicy
{
    public function view(User $user, Pedido $pedido)
    {
        return $pedido->id_escola == $user->id_escola;
    }

    public function create(User $user)
    {
        return $user->cargo == 2; // admin não cria pedidos
    }

    public function update(User $user, Pedido $pedido)
    {
        // admin nunca edita
        if ($user->cargo == 1) {
            return false;
        }

        return $pedido->status === 'Editando' &&
               $pedido->id_escola == $user->id_escola;
    }

    public function enviar(User $user, Pedido $pedido)
    {
        return $user->cargo == 2 &&
               $pedido->status === 'Editando' &&
               $pedido->id_escola == $user->id_escola;
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
               $pedido->id_escola == $user->id_escola;
    }
}
