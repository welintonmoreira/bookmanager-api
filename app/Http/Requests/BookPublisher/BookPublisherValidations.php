<?php


namespace App\Http\Requests\BookPublisher;


use App\Models\BookPublisher;

class BookPublisherValidations
{
    /**
     * @param int $bookId
     * @param int $publisherId
     * @param bool $errorMessage
     * @return bool|string
     */
    public static function checkIfPublisherIsLinked(int $bookId, int $publisherId, bool $errorMessage = true): bool|string
    {
        $bookPublisher = BookPublisher::where('book_id', $bookId)
            ->where('publisher_id', $publisherId)
            ->count();

        return ($bookPublisher)
            ? ((!$errorMessage) ? $bookPublisher : 'This publisher is already linked to this book!')
            : $bookPublisher;
    }
}
