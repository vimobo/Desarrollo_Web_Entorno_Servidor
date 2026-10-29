<?php

declare(strict_types = 1);

namespace Models;

// ----------------------------------------------------------
// CLASSES
// ----------------------------------------------------------

class Contact
{
    // ----------------------------------------------------------
    // CLASSES
    // ----------------------------------------------------------

    public function __construct(
        public private(set) string $name = '',
        public private(set) string $lastname = '',
        public private(set) string $mail = '',
        public private(set) string $birth = '',
        public private(set) bool $accepted = false,
    )
    {}

    // ----------------------------------------------------------
    // METHODS
    // ----------------------------------------------------------

    public static function fromArray(array $data) : self
    {
        return new self(
            name: $data['username'],
            lastname: $data['lastname'],
            mail: $data['mail'],
            birth: $data['birth'],
            accepted: isset($data['check']),
        );
    }
}