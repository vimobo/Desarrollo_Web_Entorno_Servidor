<?php
declare(strict_types=1);


class ContactRequest {

    public function __construct(
        public private(set) string $name = '',
        public private(set) string $lastname = '',
        public private(set) string $mail = '',
        public private(set) string $birth = '',
        public private(set) bool $accepted = false,
    )
    {}

    function validar ($data) {

    }

    public static function sanearYValidar(array $data) : self
    {
        return new self(
            name: e($data['username']),
            lastname: e($data['lastname']),
            mail: e($data['mail']),
            birth: e($data['birth']),
            accepted: isset($data['check']),
        );


    }

    public function sanearYValidar(): ReturnType {}
    

}

?>




    // ----------------------------------------------------------
    // METHODS
    // ----------------------------------------------------------

    
}