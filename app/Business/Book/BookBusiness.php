<?php


namespace App\Business\Book;


use App\Business\Business;
use App\Models\Book;

class BookBusiness extends Business
{
    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    private static function save(Book $book, array $data): Book
    {
        $book->fill($data);
        $book->save();

        return $book;
    }

    /**
     * @param array $data
     * @return Book
     */
    public static function create(array $data): Book
    {
        return self::save((new Book()), $data);
    }

    /**
     * @param Book $book
     * @param array $data
     * @return Book
     */
    public static function update(Book $book, array $data): Book
    {
        return self::save($book, $data);
    }

    /**
     * @param Book $book
     * @return bool|null
     */
    public static function softDelete(Book $book): ?bool
    {
        return $book->delete();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function list(array $data): mixed
    {
        $query = Book::query();

        // Search conditions.
        $data = self::listSearchConditions($data, $query);

        $query->where($data);

        return $query->get([
            'id',
            'title',
            'original_title',
            'subtitle',
            'original_subtitle',
            'publication_year',
            'number_pages',
            'edition_number',
            'synopsis',
            'height',
            'width',
            'thickness',
            'weight'
        ]);
    }

    /**
     * @param array $data
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return array
     */
    private static function listSearchConditions(array $data, \Illuminate\Database\Eloquent\Builder $query): array
    {
        if (!empty($data['title'])) {
            $query->where('title', 'like', "%{$data['title']}%");
            unset($data['title']);
        }

        if (!empty($data['original_title'])) {
            $query->where('original_title', 'like', "%{$data['original_title']}%");
            unset($data['original_title']);
        }

        if (!empty($data['subtitle'])) {
            $query->where('subtitle', 'like', "%{$data['subtitle']}%");
            unset($data['subtitle']);
        }

        if (!empty($data['original_subtitle'])) {
            $query->where('original_subtitle', 'like', "%{$data['original_subtitle']}%");
            unset($data['original_subtitle']);
        }

        if (!empty($data['synopsis'])) {
            $query->where('synopsis', 'like', "%{$data['synopsis']}%");
            unset($data['synopsis']);
        }

        return $data;
    }
}
