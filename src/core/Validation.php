<?php

class Validation
{
    private const MAX_WANT_STR = 2000;

    public function validateWant($want)
    {
        $errors = [];
        if (empty($want)) {
            $errors[] = 'やりたいことを入力してください';
            } elseif (mb_strlen($want) > self::MAX_WANT_STR) {
            $errors[] = 'やりたいことは2000文字以内で入力してください';
        }
        return $errors;
    }
}
