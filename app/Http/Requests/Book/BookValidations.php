<?php


namespace App\Http\Requests\Book;


use App\Models\Book;

class BookValidations
{
    /**
     * @param string $title
     * @param int|null $exceptBookId
     * @param bool $errorMessage
     * @return bool|string
     */
    public static function checkIfBookExistsByTitle(
        string $title,
        int    $exceptBookId = null,
        bool   $errorMessage = true
    ): bool|string
    {
        $query = Book::where('title', $title);

        if ($exceptBookId) {
            $query->where('id', '!=', $exceptBookId);
        }

        $book = $query->count();

        return ($book)
            ? ((!$errorMessage) ? $book : 'There is already a book with that title!')
            : $book;
    }
}
