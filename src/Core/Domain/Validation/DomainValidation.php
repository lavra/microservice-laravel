<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(string $value, string $exceptMessage = null)
    {
        if (empty($value))
            throw new EntityValidationException($exceptMessage ?? "É obrigatório");
    } 
    
    public static function strMaxLength(string $value, int $length = 255, string $exceptMessage = null)
    {
        if (strlen($value) > $length)
            throw new EntityValidationException($exceptMessage ?? "Deve ter no máximo {$length} caracteres");
    }

    public static function strMinLength(string $value, int $length = 3, string $exceptMessage = null)
    {
        if (strlen($value) < $length)
            throw new EntityValidationException($exceptMessage ?? "Deve ter no mínimo {$length} caracteres");
    }

    public static function strCanNullAndMaxLength(string $value = '', int $length = 255, string $exceptMessage = null)
    {
        if (!empty($value) && strlen($value) > $length)
            throw new EntityValidationException($exceptMessage ?? "Deve ser null o ter no máximo {$length} caracteres");
    }


}