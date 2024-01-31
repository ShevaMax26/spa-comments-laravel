<?php

namespace App\Helpers;

class CheckCommentHtml
{
    public static function check($html): string
    {
        // Дозволені теги та атрибути
        $allowedTags = ['a', 'code', 'i', 'strong'];
        $allowedAttributes = ['href', 'title'];

        // Видаляємо всі теги, крім дозволених
        $html = strip_tags($html, '<' . implode('><', $allowedTags) . '>');

        // Екрануємо спеціальні символи HTML
        $html = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');

        return $html;
    }
}
