<?php


namespace App\Business\BookAuthor;


use App\Business\Business;
use App\Models\BookAuthor;
use Illuminate\Support\Facades\DB;

class BookAuthorBusiness extends Business
{
    /**
     * @param BookAuthor $bookAuthor
     * @param array $data
     * @return BookAuthor
     */
    private static function save(BookAuthor $bookAuthor, array $data): BookAuthor
    {
        $bookAuthor->fill($data);
        $bookAuthor->save();

        return $bookAuthor;
    }

    /**
     * @param array $data
     * @return BookAuthor
     */
    public static function create(array $data): BookAuthor
    {
        return self::save((new BookAuthor()), $data);
    }

    /**
     * @param BookAuthor $bookAuthor
     * @return bool|null
     */
    public static function softDelete(BookAuthor $bookAuthor): ?bool
    {
        return $bookAuthor->delete();
    }

    /**
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public static function list(array $data): \Illuminate\Support\Collection
    {
        $query = DB::table('book_authors AS ba')
            ->select([
                'ba.id',
                'ba.book_id',
                'b.title AS book_title ',
                'b.original_title As book_original_title',
                'ba.author_id',
                'a.name AS author_name'
            ])
            ->join('books AS b', function ($join) {
                $join->on('ba.book_id', '=', 'b.id')
                    ->whereNull('b.deleted_at');
            })
            ->join('authors AS a', function ($join) {
                $join->on('ba.author_id', '=', 'a.id')
                    ->whereNull('a.deleted_at');
            })
            ->whereNull('ba.deleted_at');

        // Books.
        if (!empty($data['book_title'])) {
            $query->where(function ($query) use ($data) {
                $query->where('b.title', 'like', "%{$data['book_title']}%")
                    ->orWhere('b.original_title', 'like', "%{$data['book_title']}%");
            });
        }

        if (!empty($data['book_id'])) {
            $query->where('b.id', $data['book_id']);
        }

        // Authors.
        if (!empty($data['author_name'])) {
            $query->where('a.name', 'like', "%{$data['author_name']}%");
        }

        if (!empty($data['author_id'])) {
            $query->where('a.id', $data['author_id']);
        }

        return $query->get();
    }
}
