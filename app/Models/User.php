<?php

namespace App\Models;

class User
{
    private string $name;
    private string $email;
    private string $password;
    private string $ref;
    private ?int $ref_count;
    private ?int $id;


    public function __construct(
        string $name,
        string $email,
        string $password,
        string  $ref,
        ?int  $ref_count = null,
        ?int $id = null

    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->ref = md5($email);
        $this->ref_count = $ref_count;
        $this->id = $id;

    }

    public static function create(array $data): User
    {
        return new self(
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_BCRYPT),
            $data['reff'],
            $data['reff_count'],

        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'reff' =>$this->ref,
            'reff_count'=>$this->ref_count
        ];
    }

    public function UserID()
    {
        return $this->email;
    }

}