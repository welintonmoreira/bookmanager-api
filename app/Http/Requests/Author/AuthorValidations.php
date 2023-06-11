<?php


namespace App\Http\Requests\Author;


use App\Models\Author;

class AuthorValidations
{
    /**
     * @param string $name
     * @param int|null $exceptAuthorId
     * @param bool $errorMessage
     * @return bool|string
     */
    public static function checkIfAuthorExistsByName(
        string $name,
        int $exceptAuthorId = null,
        bool $errorMessage = true
    ): bool|string
    {
        $query = Author::where('name', $name);

        if ($exceptAuthorId) {
            $query->where('id', '!=', $exceptAuthorId);
        }

        $author = $query->count();

        return ($author)
            ? ((!$errorMessage) ? $author : 'An author with that name already exists!')
            : $author;
    }
}
