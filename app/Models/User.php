<?php

namespace App\Models;

class User
{
    private string $name;
    private string $email;
    private string $password;
    private ?int $referredBy;
    private ?int $id;

    public function __construct(
        string $name,
        string $email,
        string $password,
        ?string $referredBy = null,
        ?int $id = null
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->referredBy = $referredBy;
        $this->id = $id;
    }

    public static function create(array $data): User
    {
        return new self(
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['referred_by']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'referred_by' => $this->referredBy,
        ];
    }
}