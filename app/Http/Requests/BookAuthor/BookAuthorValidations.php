<?php


namespace App\Http\Requests\BookAuthor;


use App\Models\BookAuthor;

class BookAuthorValidations
{
    /**
     * @param int $bookId
     * @param int $authorId
     * @param bool $errorMessage
     * @return bool|string
     */
    public static function checkIfAuthorIsLinked(int $bookId, int $authorId, bool $errorMessage = true): bool|string
    {
        $bookAuthor = BookAuthor::where('book_id', $bookId)
            ->where('author_id', $authorId)
            ->count();

        return ($bookAuthor)
            ? ((!$errorMessage) ? $bookAuthor : 'This author is already linked to this book!')
            : $bookAuthor;
    }
}
