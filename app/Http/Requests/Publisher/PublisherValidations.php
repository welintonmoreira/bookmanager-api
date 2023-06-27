<?php


namespace App\Http\Requests\Publisher;


use App\Models\Publisher;

class PublisherValidations
{
    /**
     * @param string $fullName
     * @param int|null $exceptPublisherId
     * @param bool $errorMessage
     * @return bool|string
     */
    public static function checkIfPublisherExistsByFullName(
        string $fullName,
        int $exceptPublisherId = null,
        bool $errorMessage = true
    ): bool|string
    {
        $query = Publisher::where('full_name', $fullName);

        if ($exceptPublisherId) {
            $query->where('id', '!=', $exceptPublisherId);
        }

        $publisher = $query->count();

        return ($publisher)
            ? ((!$errorMessage) ? $publisher : 'A publisher with that full name already exists!')
            : $publisher;
    }
}
