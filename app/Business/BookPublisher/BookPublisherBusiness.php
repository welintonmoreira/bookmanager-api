<?php


namespace App\Business\BookPublisher;


use App\Business\Business;
use App\Models\BookPublisher;
use Illuminate\Support\Facades\DB;

class BookPublisherBusiness extends Business
{
    /**
     * @param BookPublisher $bookPublisher
     * @param array $data
     * @return BookPublisher
     */
    private static function save(BookPublisher $bookPublisher, array $data): BookPublisher
    {
        $bookPublisher->fill($data);
        $bookPublisher->save();

        return $bookPublisher;
    }

    /**
     * @param array $data
     * @return BookPublisher
     */
    public static function create(array $data): BookPublisher
    {
        return self::save((new BookPublisher()), $data);
    }

    /**
     * @param BookPublisher $bookPublisher
     * @return bool|null
     */
    public static function softDelete(BookPublisher $bookPublisher): ?bool
    {
        return $bookPublisher->delete();
    }

    /**
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public static function list(array $data): \Illuminate\Support\Collection
    {
        $query = DB::table('book_publishers AS bp')
            ->select([
                'bp.id',
                'bp.book_id',
                'b.title AS book_title ',
                'b.original_title As book_original_title',
                'bp.publisher_id',
                'p.name AS publisher_name',
                'p.full_name AS publisher_full_name'
            ])
            ->join('books AS b', function ($join) {
                $join->on('bp.book_id', '=', 'b.id')
                    ->whereNull('b.deleted_at');
            })
            ->join('publishers AS p', function ($join) {
                $join->on('bp.publisher_id', '=', 'p.id')
                    ->whereNull('p.deleted_at');
            })
            ->whereNull('bp.deleted_at');

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

        // Publishers.
        if (!empty($data['publisher_name'])) {
            $query->where(function ($query) use ($data) {
                $query->where('p.name', 'like', "%{$data['publisher_name']}%")
                    ->orWhere('p.full_name', 'like', "%{$data['publisher_name']}%");
            });
        }

        if (!empty($data['publisher_id'])) {
            $query->where('p.id', $data['publisher_id']);
        }

        return $query->get();
    }
}
