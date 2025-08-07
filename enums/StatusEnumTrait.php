<?php

trait StatusEnumTrait
{
    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public static function fromValue($value): ?string
    {
        foreach (self::cases() as $status) {
            if( $value === $status->value ){
                return $status->value;
            }
        }
        
        return null;
    }

    public static function fromName(string $name): ?string
    {
        foreach (self::cases() as $status) {
            if( $name === $status->name ){
                return $status->value;
            }
        }
        
        return null;
    }
}