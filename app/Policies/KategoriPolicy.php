<?php
namespace App\Policies;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KategoriPolicy
{
    /** Tentukan apakah user dapat melihat daftar kategori (viewAny) */
    public function viewAny(User $user): bool
    {
        return true; // Semua user yang login boleh melihat daftar kategori mereka
    }

    /** Tentukan apakah user dapat melihat kategori tertentu (view) */
    public function view(User $user, Kategori $kategori): bool
    {
        return $user->id === $kategori->user_id;
    }

    /** Tentukan apakah user dapat membuat kategori (create) */
    public function create(User $user): bool
    {
        return true;
    }

    /** Tentukan apakah user dapat mengupdate kategori (update) */
    public function update(User $user, Kategori $kategori): bool
    {
        return $user->id === $kategori->user_id;
    }

    /** Tentukan apakah user dapat menghapus kategori (delete) */
    public function delete(User $user, Kategori $kategori): bool
    {
        return $user->id === $kategori->user_id;
    }
}