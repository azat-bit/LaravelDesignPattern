<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\UserServiceInterface;
use App\Repositories\UserRepository;
use App\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Tüm kullanıcıları getir
     */
    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    /**
     * ID ile kullanıcıyı getir, yoksa hata fırlat
     */
    public function getById($id)
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new UserNotFoundException(); // Lang dosyasından mesaj alır
        }

        return $user;
    }

    /**
     * Yeni kullanıcı oluştur
     */
    public function store(array $data)
    {
        return $this->userRepository->create($data);
    }

    /**
     * Kullanıcıyı güncelle
     */
    public function update($id, array $data)
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $this->userRepository->update($id, $data);
    }

    /**
     * Kullanıcıyı sil
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $this->userRepository->delete($id);
    }

    /**
     * Giriş işlemi (login)
     */
    public function attemptLogin(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }
}
